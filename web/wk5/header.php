<?php 
session_start();
$message = $_SESSION['message'];
?>
<header>
    <div class='body-width'>
        <h1>PC Builder</h1>
        <nav>
            <a class="button btn-primary" href="">My Build</a>
        </nav>
    </div>
</header>
<?php
    if(!isset($meessage)) {
        echo "<h2>$message</h2>";
    }
?>