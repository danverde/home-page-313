<?php
session_start();

if (!isset($_SESSION['items'])) {
    header("Location: ./controller.php?action=browse");
    exit();
}

$items = $_SESSION['items'];
var_dump($items);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="browse.css" />
</head>
<body>
    <?php require 'header.php'; ?>
    <main>

    </main>
    <?php require 'footer.php'; ?>
</body>
</html>