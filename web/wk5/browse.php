<?php
session_start();

//TODO enable me
// if (!isset($_SESSION['items'])) {
//     header("Location: ./controller.php?action=browse");
//     exit();
// }

//TODO enable me
// $items = $_SESSION['items'];
// var_dump($items);

// $items = 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/browse.css" />
</head>
<body>
    <?php require 'header.php'; ?>
    <main>
        <div id='itemList' class='flex-wrapper space-around'>
            <div class="item-container">
                <img src="./images/z97ar.jpg">
                <h4>Asus Z97-AR</h4>
                <p class='price'>$99</p>
                <p>Description</p>
                <div>
                    <a class="button" href="">Add to build</a>
                </div>
            </div>
            <div class="item-container">
                <h4>Name</h4>
                <p>Description</p>
                <p>$400</p>
                <!-- <img> -->
                <a class="button" href="">Add to build</a>
            </div>
            <div class="item-container">
                <h4>Name</h4>
                <p>Description</p>
                <p>$400</p>
                <!-- <img> -->
                <a class="button" href="">Add to build</a>
            </div>
            <div class="item-container">
                <h4>Name</h4>
                <p>Description</p>
                <p>$400</p>
                <!-- <img> -->
                <a class="button" href="">Add to build</a>
            </div>
        </div>
    </main>
    <?php require 'footer.php'; ?>
</body>
</html>