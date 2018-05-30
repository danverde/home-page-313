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

$message = $_SESSION['message'];
$items = $_SESSION['items'];
$itemType = $_SESSION['itemType'];

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
        <?php if(isset($message)) {
            echo "<div style='width:100%;'><p>$message</p></div>";
        }
        ?>
        <div id='itemList' class='flex-wrapper space-around'>
            <?php 
            foreach ($items as $item) {
                $itemName = $item['name'];
                $itemId = $_SESSION['item_id'];
                
                echo "<div class='item-container' class='flex-wrapper space-around'>
                <img src='".$item['image_location']."'>
                <h4>$itemName</h4>
                <p class='price'>$".$item['price']."</p>
                <p>".$item['description']."</p>
                <div>
                    <form method='POST' action='controller.php'>
                        <input type='hidden' name='action' value='addToBuild'>
                        <input type='hidden' name='itemName' value='$itemName'>
                        <input type='hidden' name='itemType' value='$itemType'>
                        <input type='hidden' name='itemId' value='$itemId'>
                        <input type='submit' class='button' value='Add to Build'>
                    </form>
                </div>
                </div>";
            }
            ?>
        </div>
    </main>
    <?php require 'footer.php'; ?>
</body>
</html>