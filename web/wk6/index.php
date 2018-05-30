<?php 
session_start();

/* Redirecto to controller, get items from DB, return them to here */
if (!isset($_SESSION['itemTypes'])) {
    header("Location: ./controller.php?action=getItemTypes");
    exit();
}

$itemTypes = $_SESSION['itemTypes'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/home.css" />
</head>
<body>
    <?php require 'header.php' ?>
    <main>
        <div class='main-banner'></div>
        <div id="about">
            <h1>Landing Message</h1>
            <?php
            // message is defined in the header
            if (isset($message)) {
                echo "<div id='message'><p>$message</p></div>";
            }
            ?>
            <p>This is a super cool &amp; important message all about this website, computers, tacos, and other nerdy stuff. Yay! (Just kidding about the 🌮's... Sorry...)</p>
        </div>
        <!-- <div class='message'><p>This is a message!</p></div> -->
        <div id="parts" class="flex-wrapper">
            <?php foreach ($itemTypes as $item) {
                $item = $item['item_type_name'];
                if ($item === 'cpu' || $item === 'gpu' || $item === 'psu') {
                    $itemTitle = strtoupper($item)."s";
                } else {
                    $itemTitle = ucfirst($item);
                    if ($itemTitle !== 'Storage' && $itemTitle !== 'Memory') {
                        $itemTitle = ucfirst($item).'s';
                    }
                }

                echo "<a class='button button-lg' href='./controller.php?action=browse&itemType=$item'>".$itemTitle."</a>";  
            }?>
        </div>
    </main>
    <?php require 'footer.php' ?>
</body>
</html>