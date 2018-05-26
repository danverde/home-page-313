<?php 
session_start();
$message = $_SESSION['message'];
?>
<header>
    <div class='body-width'>
        <h1><a href='./index.php'>PC Builder</a></h1>
        <nav>
            <p class="button btn-disabled">Login</p>
            <a class="button btn-primary" href="./build.php">My Build</a>
        </nav>
    </div>
</header>
<?php
    if(!isset($meessage)) {
        echo "<h2>$message</h2>";
    }
?>