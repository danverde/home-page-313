<?php 
session_start();
$message = $_SESSION['message'];
if (isset($message)) {
    $messageType = $_SESSION['messageType'];
    $message = "<div class='message $messageType'><p>$message</p></div>";
}
$_SESSION['message'] = null;
$_SESSION['messageType'] = null;

$loggedIn = isset($_SESSION['userId']);

?>

<header>
    <div class='body-width'>
        <h1><a href='./index.php'>PC Builder</a></h1>
        <nav>
            <?php
            if ($loggedIn === true) {
                echo "<a class='button' href='controller.php?action=logout'>Logout</a>
                    <a class='button btn-primary' href='./build.php?'>My Build</a>";
            } else {
                echo "<a class='button' href='./login.php'>Login</a>
                <a class='button primary' href='./register.php'>Register</a>";
            }
            ?>
        </nav>
    </div>
</header>