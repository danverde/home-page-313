<?php
if (session_status() === 1) {
    header('Location: ./browse.php');
    exit();
    return;
}
$cart = $_SESSION['cart'];
var_dump($_POST);

?>