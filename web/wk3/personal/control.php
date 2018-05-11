<?php
session_start();
if (!isset($_SESSION['existingSession'])) {
    header('Location: ./browse.php');
    exit();
    return;
} else {
    $cart = $_SESSION['cart'];
    var_dump($_POST);
}
?>