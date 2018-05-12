<?php

session_start();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if (empty($action)) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

$location = './browse.php';


function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if ($action === 'endSession') {
    session_destroy();
}

/* IF they are adding an item */
if (isset($_SESSION['existingSession']) && $action == 'addItem') {
    /* set redirect location */
    $location = './browse.php';

    $addedItem = $_POST['name']; // save item name
    
    /* increate quantity by 1 */
    $_SESSION['cart'][$addedItem]['quantity']++;
}

/* IF they are checking out */
if (isset($_SESSION['existingSession']) && $action == 'checkout') {
    /* set redirect location */
    $location ='./confirm.php';
    
    /* save address */
    $_SESSION['name'] = testInput($_POST['name']);
    $_SESSION['email'] = testInput($_POST['email']);
    $_SESSION['address'] = testInput($_POST['address']);
    $_SESSION['state'] = testInput($_POST['state']);
    $_SESSION['zip'] = testInput($_POST['zip']);
    $_SESSION['shipping'] = testInput($_POST['shipping']);

    /* save APT/ Suite if given */
    if (isset($_POST['apt']) && $_POST['apt'] !== '') $_SESSION['apt'] = testInput($_POST['apt']);
}

header("Location: {$location}");
exit();
return;
?>