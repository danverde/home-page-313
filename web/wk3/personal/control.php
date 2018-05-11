<?php
session_start();
// don't let you come here first!
if (isset($_SESSION['existingSession'])) {
    // $cart = $_SESSION['cart'];
    $addedItem = $_POST['name'];
    $_SESSION['cart'][$addedItem]['quantity']++;

    var_dump($_SESSION['cart']);
    // var_dump($_POST);
}

header('Location: ./browse.php');
exit();
return;
?>