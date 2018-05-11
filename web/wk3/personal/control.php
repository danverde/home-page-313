<?php

session_start();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
$location = './browse.php';

if (isset($_SESSION['existingSession']) && $action == 'addItem') {
    $location = './browse.php';
    

    $addedItem = $_POST['name'];
    
    $_SESSION['cart'][$addedItem]['quantity']++;
    
    var_dump($_SESSION['cart']);
    var_dump($addedItem);
}

header("Location: {$location}");
exit();
return;
?>