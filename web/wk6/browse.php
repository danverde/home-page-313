<?php
session_start();

$item = filter_input(INPUT_GET, 'item', FILTER_SANITIZE_STRING);

if (!isset($item)) {
    header("Location: ./controller.php?action=browse");
    exit();
} else if (!isset($_SESSION['items']) || $_SESSION['itemType'] !== $item){
    header("Location: ./controller.php?action=browse&item=$item");
    exit();
}

$items = $_SESSION['items'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Browse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/browse.css" />
</head>
<body>
    <?php require 'header.php'; ?>
    <main>
        <h1> Browse </h1>
        <div id='itemList' class='flex-wrapper space-around'>
            <?php 
            foreach ($items as $item) {
                $name = $item['name'];
                
                echo "<div class='item-container' class='flex-wrapper space-around'>
                <img src='".$item['image_location']."'>
                <h4>$name</h4>
                <p class='price'>$".$item['price']."</p>
                <p>".$item['description']."</p>
                <div>
                    <p class='button btn-disabled' >Add to Build</p>
                </div>
                </div>";
            }
            ?>
        </div>
    </main>
    <?php require 'footer.php'; ?>
</body>
</html>