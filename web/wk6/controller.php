<?php
require './db.php';

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

// TODO finish me
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
    $item = filter_input(INPUT_GET, 'item', FILTER_SANITIZE_STRING);
    if (empty($item)) {
        $item = 'motherboard';
    }
    $item = strtolower($item);
    $_SESSION['itemType'] = $item;

    try {
        /* get all items of a specific type */
        $stmt = $db->prepare('SELECT item_id, name, description, price, image_location FROM items AS i 
        JOIN item_type AS it USING(item_type_id)
        WHERE it.item_type_name = :itemName');
        $stmt->bindValue(':itemName', $item, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $_SESSION['items'] = $rows;
        
        $idToGrab = $item."_id";
        
        // TODO there's got to be a better way to do this...
        // ERROR will break
        // $stmt = $db->prepare('SELECT :itemId  FROM builds WHERE user_id=:userID');
        // $stmt->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_INT);
        // $stmt->bindValue(':itemId', $idToGrab, PDO::PARAM_INT);
        // $stmt->execute();
        // $buildItem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION['buildItem'] = $buildItem;
    } catch(PDOException $err) {
        $_SESSION['message'] = "Unable to get items: $err";
    }

    header("location: ./browse.php?item=$item");
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
        $_SESSION['build'] = "Error getting build";
        $_SESSION['message'] = "Unable to get items: $err";
    }

    header("location: ./build.php");
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

function clearBuild($db) {

    try {

    } catch(Exception $err) {

    }
}

function removeFromBuild($db, $itemType) {

    try {

    } catch(Exception $err) {

    }
}

/* chose action */
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