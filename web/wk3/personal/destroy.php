<?php 
session_start();
session_destroy();

header("Location: ./browse.php");
exit();
?>