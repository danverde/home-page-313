<?php 
session_start();
$message = $_SESSION['message'];
if (isset($message)) {
    $messageType = $_SESSION['messageType'];
    $message = "<div id='message' class='$messageType'><p>$message</p></div>";
}
$_SESSION['message'] = null;

if(!isset($_SESSION['userId'])) {
    header("location: ./controller.php");
    exit();
}
?>

<header>
    <div class='body-width'>
        <h1><a href='./index.php'>PC Builder</a></h1>
        <nav>
            <p class="button btn-disabled">Login</p>
            <a class="button btn-primary" href="./build.php?">My Build</a>
        </nav>
    </div>
</header>