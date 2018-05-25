<?php
require './db.php';

session_start();


/* get action */
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if (empty($action)) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

/* set default reedirect location */
$location = './index.php';


/* Start functions */
function getItemTypes() {
    // $_SESSION['itemTypes'] = null;
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

/* chosee action */
switch ($action) {
    case 'getItemTypes':
    getItemTypes();
    break;
}

header("location $location");
exit();

?>