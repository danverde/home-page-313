<?php
require './db.php';
// $dbUrl = getenv('DATABASE_URL');

// $dbopts = parse_url($dbUrl);

// $dbHost = $dbopts["host"];
// $dbPort = $dbopts["port"];
// $dbUser = $dbopts["user"];
// $dbPassword = $dbopts["pass"];
// $dbName = ltrim($dbopts["path"],'/');

// $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


session_start();

/* get action */
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if (empty($action)) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
if ($action == null) {
    $action = 'getItemTypes';
}

/* set default reedirect location */
$location = './index.php';


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

    $location = './index.php';
    return;
}

function browse($db) {
    $item = filter_input(INPUT_GET, 'item', FILTER_SANITIZE_STRING);
    if (empty($item)) {
        $item = 'motherboard';
    }

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

    $location = './browse.php';
    return;
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

header("location: $location");
exit();

?>