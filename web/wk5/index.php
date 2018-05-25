<?php 
session_start();

/* Redirecto to controller, get items from DB, return them to here */
if (!isset($_SESSION['itemTypes'])) {
    header("Location: ./controller.php?action=getItemTypes");
    exit();
}

// $itemTypes = $_SESSION['itemTypes'];
$itemTypes = array('Motherboard', 'CPU', 'GPU');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="home.css" />
</head>
<body>
    <?php require 'header.php' ?>
    <main>
        <div class='main-banner'></div>
        <div id="about">
            <h1>Landing Message</h1>
            <p>This is a super cool &amp; important message all about this website, computers, tacos, and other nerdy stuff. Yay! (Just kidding about the 🌮's... Sorry...)</p>
        </div>
        <div class='message'><p>This is a message!</p></div>
        <div id="parts" class="flex-wrapper space-around">
            <?php foreach ($itemTypes as $item) {
                echo "<a class='button button-lg' href='./browse.php?item=$item'>$item</a>";  
            }?>
        </div>
    </main>
    <?php require 'footer.php' ?>
</body>
</html>