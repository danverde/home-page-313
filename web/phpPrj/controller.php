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

/* if no user is provided, go to login/ register page */
if (!isset($_SESSION['userId']) && ($action !== 'login' && $action !== 'register')) {
    header("location: ./login.php");
    exit();
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
        $_SESSION['message'] = "Unable to get availible item types";
        $_SESSION['messageType'] = 'error';
    } finally {
        header("location: ./index.php");
        exit();
    }
}

/*********************************************
 * Get all items of a given type from the DB
 ********************************************/
function browse($db) {
    $userId = $_SESSION['userId'];
    $itemType = filter_input(INPUT_GET, 'itemType', FILTER_SANITIZE_STRING);
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
        $_SESSION['message'] = "Unable to get items";
        $_SESSION['messageType'] = 'error';
    } finally {
        header("location: ./browse.php?itemType=$itemType");
        exit();
    }
}

/*******************************************
 * Get the current user's build from the DB
 ******************************************/
function getBuild($db) {
    $userId = $_SESSION['userId'];
    
    /* UserId must not be empty */
    if (!isset($userId)) {
        return;
    }

    try {
        // TODO
        // loop through each item type & get the corresponding build item
        // OR
        // loop through itemTypes & build to match items 

        $stmt = $db->prepare('SELECT i.item_id, i.name, i.price, it.item_type_name, it.item_type_id
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
        $build = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $_SESSION['build'] = $build;
        
    } catch(PDOException $err) {
        $_SESSION['message'] = "Unable to get items";
        $_SESSION['messageType'] = 'error';
        // var_dump($err); //TESTING
        // die(); /TESTING
    }

    header("location: ./build.php?action=getBuild");
    exit();
}

/***********************************************
 * Add a given item to the current user's build
 ***********************************************/
function addToBuild($db) {
    $userId = $_SESSION['userId'];

    $itemId = filter_input(INPUT_POST, 'itemId', FILTER_SANITIZE_STRING);
    $itemType = filter_input(INPUT_POST, 'itemType', FILTER_SANITIZE_STRING);
    $itemName = filter_input(INPUT_POST, 'itemName', FILTER_SANITIZE_STRING);
    
    try {
        $itemTypeIdSelector = formatColId($itemType);
        if ($itemTypeIdSelector === NULL) {
            throw new Exception("Invalid Column Id: $itemTypeIdSelector");
        }

        $stmt = $db->prepare("UPDATE builds SET ".$itemTypeIdSelector."=:itemId WHERE user_id=:userId");
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':itemId', $itemId, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['message'] = "Successfully added $itemName To build";

    } catch(Exception $err) {
        $_SESSION['message'] = "Unable to add $itemName To build";
        $_SESSION['messageType'] = 'error';
        var_dump($err); // TESTING
        die(); //TESTING
    } finally {
        browse($db);
    }
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
        $_SESSION['messageType'] = 'error';
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
    $caller = filter_input(INPUT_POST, 'caller', FILTER_SANITIZE_STRING);
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

        /* Column must be dynamically generated, so PDO bind cannot be used. */
        $stmt = $db->prepare("UPDATE builds SET ".$itemTypeIdSelector." = null WHERE user_id=:userId");
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $_SESSION['message'] = "$itemName Successfully removed from build";
        
    } catch(Exception $err) {
        $_SESSION['message'] = "Something went wrong while removing that item";
        $_SESSION['messageType'] = 'error';
        // var_dump($err); // TESTING
        // die(); // TESTING
    } finally {
        if ($caller === "build") {
            getBuild($db);
        } else {
            browse($db);
        }
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

/*********************************
 * Authenticate a user. Saves 
 * user_id to the session variable
 *********************************/
function login($db) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $rawPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    try {
        $stmt = $db->prepare("SELECT user_id, password FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData === false || password_verify($rawPassword, $userData['password']) === false) {
            // nothing returned, we're good to go
            $_SESSION['message'] = "Invalid username or password";
            $_SESSION['messageType'] = 'error';
            header('location: ./login.php');
            exit();
        } else {
            $_SESSION['userId'] = $userData['user_id'];

            var_dump($userData);
            var_dump(password_verify($rawPassword, $userData['password']));

            exit();
            header('location: ./index.php');
        }

    } catch(Exception $err) {
        $_SESSION['message'] = "We were unable to log you in.";
        $_SESSION['messageType'] = 'error';
        // var_dump($err); // TESTING
        header("location: ./login.php");
        exit();
    }
}

/**********************************************
 * Create a new user in the users table
 * & a corresponding build in the build table.
 ***********************************************/
function register($db) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $rawPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirmPassword = filter_input(INPUT_POST, 'confirmpassword', FILTER_SANITIZE_STRING);
    $firstName = filter_input(INPUT_POST, 'fName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lName', FILTER_SANITIZE_STRING);

    if ($rawPassword !== $confirmPassword) {
        $_SESSION['message'] = "Passwords must match";
        $_SESSION['messageType'] = 'error';
        header('location: ./register.php');
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        /* make sure email isn't already used */
        $stmt = $db->prepare("SELECT email FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($users !== false){
            $_SESSION['message'] = "That email is already in use";
            $_SESSION['messageType'] = 'error';
            header("location: ./register.php");
            exit();
        } else {
            $stmt = $db->prepare("INSERT INTO users(first_name, last_name, email, password) VALUES(:firstName, :lastName, :email, :password)");
            $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $passwordHash, PDO::PARAM_STR);
            $stmt->execute();

            $newUserId = $db->lastInsertId(users_user_id_seq);

            $stmt = $db->prepare("INSERT INTO builds(user_id) VALUES(:userId)");
            $stmt->bindValue(':userId', $newUserId, PDO::PARAM_STR);
            $stmt->execute();


            $_SESSION['userId'] = $newUserId;
            $_SESSION['message'] = "You have successfully Registered";
            header('location: ./controller.php');
            exit();
        }

    } catch(Exception $err) {
        $_SESSION['message'] = "We were unable to log you in.";
        $_SESSION['messageType'] = 'error';
        var_dump($err); // TESTING
        exit();
        header("location: ./login.php");
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

    case 'login':
    login($db);
    break;

    case 'register':
    register($db);
    break;

    /* Go to home page by default */
    default:
    header("location: ./index.php");
    exit();
    break;
}
?>