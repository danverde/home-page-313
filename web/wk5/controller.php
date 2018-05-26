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


/* chose action */
switch ($action) {
    case 'getItemTypes':
    getItemTypes($db);
    break;

    case 'browse':
    browse($db);
    break;
}
/* Go to home page by default */
header("location: ./index.php");
exit();

?>