<?php
session_start();

//TODO enable me
if (!isset($_SESSION['items'])) {
    header("Location: ./controller.php?action=browse");
    exit();
}

//TODO enable me
$items = $_SESSION['items'];

$name = $items[0]['name'];
$imgLocation = $items[0]['image_location'];
$price = $items[0]['price'];
$description = $items[0]['description'];

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
            <!-- <div class="item-container">
                <img src="./images/z97ar.jpg">
                <h4>Asus Z97-AR</h4>
                <p class='price'>$99</p>
                <p>Description</p>
                <div>
                    <a class="button" href="">Add to build</a>
                </div>
            </div> -->
            <?php 
            foreach ($items as $item) {
                echo "<div class='item-container' class='flex-wrapper space-around'>
                <img src='$imgLocation'>
                <h4>$name</h4>
                <p class='price'>$$price</p>
                <p>$description</p>
                <div>
                    <a class='button' href=''>Add to Build</a>
                </div>
                </div>";
            }
            ?>
        </div>
    </main>
    <?php require 'footer.php'; ?>
</body>
</html>