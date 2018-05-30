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
        <?php 
        // message is defined in the header
        if (isset($message)) {
            echo "<div id='message'><p>$message</p></div>";
        }
        ?>
        <div id='itemList' class='flex-wrapper space-around'>
            <?php 
            foreach ($items as $item) {
                $itemName = $item['name'];
                $itemId = $_SESSION['item_id'];
                
                $action = 'addToBuild';
                $warning = '';
                if ($item['buildItem'] === true) {
                    $action = 'removeFromBuild';
                    $warning = 'btn-warning';
                }

                echo "<div class='item-container' class='flex-wrapper space-around'>
                <img src='".$item['image_location']."'>
                <h4>$itemName</h4>
                <p class='price'>$".$item['price']."</p>
                <p>".$item['description']."</p>
                <div>
                    <form method='POST' action='controller.php'>
                        <input type='hidden' name='action' value='$action'>
                        <input type='hidden' name='itemName' value='$itemName'>
                        <input type='hidden' name='itemType' value='$itemType'>
                        <input type='hidden' name='itemId' value='$itemId'>
                        <input type='submit' class='button $warning' value='Add to Build'>
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