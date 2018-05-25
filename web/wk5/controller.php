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
    $_SESSION['itemTypes'] = null;
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