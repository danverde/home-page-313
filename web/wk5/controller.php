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
        $stmt = $db->prepare('SELECT name, description, price, image_location FROM items AS i 
        JOIN item_type AS it
        ON i.item_type_id = it.item_type_id
        WHERE it.item_type_name = :itemName');
        $stmt->bindValue(':itemName', $item, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['items'] = $rows;
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
        $stmt = $db->prepare('SELECT i.name, i.price, it.item_type_name
        FROM items AS i
        INNER JOIN builds AS bu ON (bu.user_id=:userId)
        INNER JOIN item_type AS it ON (it.item_type_id = i.item_type_id)
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
        $_SESSION['message'] = "Unable to get items: $err";
    }

    header("location: ./build.php");
    exit();
}

/* chose action */
switch ($action) {
    case 'getItemTypes':
    getItemTypes($db);
    break;

    case 'browse':
    browse($db);
    break;

    case: 'getBuild':
    getBuild($db);
    break;
}
/* Go to home page by default */
header("location: ./index.php");
exit();

?>