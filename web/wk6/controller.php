<?php
require './db.php';

// TODO extract ALL redirection to the switch statement.

session_start();

/* get action */
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if (empty($action)) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
if ($action == null) {
    $action = 'getItemTypes';
}

// if no user is provided, log in as default user
if (!isset($_SESSION['userId'])) {
    $_SESSION['userId'] = 1;
}

/* Start functions */

/***********************************
 * Gets each itemType name.
 * Often used to populate the browse
 * list
 **********************************/
function getItemTypes($db) {
    $_SESSION['itemTypes'] = null;
    try {
        $stmt = $db->prepare('SELECT item_type_name FROM item_type');
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['itemTypes'] = $rows;
    } catch (PDOException $err) {
        $_SESSION['message'] = "Unable to get availible item types: $err";
    }

    header("location: ./index.php");
    exit();
}

function browse($db) {
    $userId = $_SESSION['userId'];
    $itemType = filter_input(INPUT_GET, 'item', FILTER_SANITIZE_STRING);
    if (empty($itemType)) {
        $itemType = 'motherboard';
    }
    $itemType = strtolower($itemType);
    $_SESSION['itemType'] = $itemType;

    try {
        /* get all items of a specific type */
        $stmt = $db->prepare('SELECT item_id, name, description, price, image_location FROM items AS i 
        JOIN item_type AS it USING(item_type_id)
        WHERE it.item_type_name = :itemName');
        $stmt->bindValue(':itemName', $itemType, PDO::PARAM_STR);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $_SESSION['items'] = $items;
        
        $itemTypeIdSelector = formatColId($itemType);

        if ($itemTypeIdSelector === NULL) {
            throw new Exception("Invalid Column Id: $itemTypeIdSelector");
        }
        
        /* PDO inserts aren't used for itemTypeIdSelector because the column must be set dynamically */
        $stmt = $db->prepare("SELECT item_id
        FROM items AS i 
        JOIN builds AS bu ON user_id=:userId
        AND bu.".$itemTypeIdSelector."=i.item_id");
        $stmt->bindValue(':userId', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $buildItemId = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['buildItemId'] = $buildItemId['item_id'];

    } catch(PDOException $err) {
        $_SESSION['message'] = "Unable to get items: $err";
    }

    header("location: ./browse.php?item=$itemType");
    exit();
}

function getBuild($db) {
    $userId = $_SESSION['userId'];
    
    /* UserId must not be empty */
    if (!isset($userId)) {
        return;
    }

    try {
        $stmt = $db->prepare('SELECT i.item_id, i.name, i.price, it.item_type_name
        FROM items AS i
        INNER JOIN builds AS bu ON (bu.user_id=:userId)
        INNER JOIN item_type AS it USING(item_type_id)
        WHERE bu.motherboard_id = i.item_id
        OR bu.cpu_id = i.item_id
        OR bu.gpu_id = i.item_id
        OR bu.storage_id = i.item_id
        OR bu.memory_id = i.item_id
        OR bu.tower_id = i.item_id
        OR bu.fan_id = i.item_id
        OR bu.psu_id = i.item_id;');
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['build'] = $rows;
        
    } catch(PDOException $err) {
        $_SESSION['message'] = "Unable to get items";
        var_dump($err);
        die();
    }

    header("location: ./build.php?action=getBuild");
    exit();
}

function addToBuild($db) {
    $itemId = filter_input(INPUT_POST, 'itemId', FILTER_SANITIZE_STRING);
    $itemType = filter_input(INPUT_POST, 'itemType', FILTER_SANITIZE_STRING);
    $itemName = filter_input(INPUT_POST, 'itemName', FILTER_SANITIZE_STRING);
    $itemTypeIdSelector = $itemType."_id";

    
    /* check to see if the item needs to be removed first */
    try {
        $stmt = $db->prepare('SELECT :itemId FROM builds WHERE user_id=:userId');
        $stmt->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_INT);
        $stmt->bindValue(':itemId', $itemTypeIdSelector, PDO::PARAM_STR);
        $stmt->execute();
        $buildItem = $stmt->fetch(PDO::FETCH_ASSOC);

        // TODO  I don't think this is correct...
        if ($buildItems != false) {
            $_SESSION['message'] = "Must sremove existing $itemType from build first";
            header("location: ./browse.php?item=$itemType");
            exit();
            return;    
        }

        // $_SESSION['message'] = "$itemName successfully added to build";
        $_SESSION['message'] = "Successfully queried the DB for that Item";


    } catch(Exception $err) {
        var_dump($err);
        die();
    }

    header("location: ./browse.php?item=$itemType");
    exit();
}

/*************************************************
 * Removes all items rom the current user's build
 *************************************************/
function clearBuild($db) {
    $userId = $_SESSION['userId'];
    
    /* UserId must not be empty */
    if (!isset($userId)) {
        return;
    }

    try {
        $stmt = $db->prepare("UPDATE builds 
        SET (motherboard_id, cpu_id, gpu_id, fan_id, memory_id, storage_id, tower_id, psu_id)= (null, null, null, null, null, null, null, null)
        WHERE user_id=:userId");
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        
        getBuild($db);
        
    } catch(Exception $err) {
        $_SESSION['message'] = "Something went wrong while removing that item";
        // var_dump($err); // TESTING
        // die(); // TESTING
        getBuild($db);
    }
}

/*******************************************************
 * Removes a single item from the current user's build 
 *******************************************************/
function removeFromBuild($db) {
    $userId = $_SESSION['userId'];
    
    /* UserId must not be empty */
    if (!isset($userId)) {
        return;
    }

    try {
        $itemType = filter_input(INPUT_POST, 'itemType', FILTER_SANITIZE_STRING);
        $itemId = filter_input(INPUT_POST, 'itemId', FILTER_SANITIZE_STRING);
        $itemName = filter_input(INPUT_POST, 'itemName', FILTER_SANITIZE_STRING);
    
        $itemTypeIdSelector = formatColId($itemType);

        if ($itemTypeIdSelector === NULL) {
            throw new Exception("Invalid Column Id: $itemTypeIdSelector");
        }

        // TODO explain lack of PDO bindValue
        $stmt = $db->prepare("UPDATE builds SET ".$itemTypeIdSelector." = null WHERE user_id=:userId");
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $_SESSION['message'] = "$itemName Successfully removed from build";
        getBuild($db);
        
    } catch(Exception $err) {
        $_SESSION['message'] = "Something went wrong while removing that item";
        // var_dump($err); // TESTING
        // die(); // TESTING
        getBuild($db);
    }

    
}

/************************************************
 *  Takes an itemType & converts it to the 
 * corresponding column in the builds table.
 * Returns NULL if unable to do so correctly
 ***********************************************/
function formatColId($itemType) {
    $id = strtolower($itemType)."_id";
    $validIds = array('motherboard_id', 'cpu_id', 'gpu_id', 'fan_id', 'memory_id', 'storage_id', 'tower_id', 'psu_id');
    if (in_array($id, $validIds)) {
        return $id;
    } else {
        return NULL;
    }
}

/****************************************
 * Chose which function to call based
 * off the action property
 **************************************/
switch ($action) {
    case 'getItemTypes':
    getItemTypes($db);
    break;

    case 'browse':
    browse($db);
    break;

    case 'getBuild':
    getBuild($db);
    break;

    case 'addToBuild':
    addToBuild($db);
    break;

    case 'clearBuild':
    clearBuild($db);
    break;

    case 'removeFromBuild':
    removeFromBuild($db);
    break;
}
/* Go to home page by default */
header("location: ./index.php");
exit();

?>