<?php 
session_start();

if (isset($_SESSION['users'])) {
    /* if you're already logged in then you don't need to be here */
    // header("Location: ./index.php");
    // exit();
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="style/login.css" />
</head>
<body>
    <?php require 'header.php' ?>
    <main>
        <div class='main-banner'></div>
        <div id="login">
        <h1>Login</h1>
        <?php
            // message is defined in the header
            if (isset($message)) {
                echo $message;
            }
        ?>
            <div class="form-wrapper">
                <form method="POST" action="controller.php">
                <input type='hidden' name='action' value='login'>
                    <div class="flex-wrapper space-between">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="flex-wrapper space-between">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <input type="submit" class="button" value="Login">
                </form>
            </div>
        </div>
    </main>
    <?php require 'footer.php' ?>
</body>
</html>