<!--Sign up page-->

<?php

session_start();

if (isset($_SESSION["pMatch"])) {
    $pMatch = $_SESSION["pMatch"];
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sign-Up</title>
        <link rel="stylesheet" href="home.css">
        <script src="home.js"></script>
    </head>
    
    <body>
        <h1>Sign-up</h1>
        
        <?php 
            if ($pMatch === false) {
                echo "<p class='red'>Passwords do not match.</p>";
            }
        ?>
        
        <form action="create.php" method="post">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username">
            
            <label for="password">Password: 
                <?php 
                if ($pMatch === false) {
                    echo "<span class='red'>*</span>";
                }
                ?>
            </label>
            <input type="password" id="password" name="password">
            
            <label for="cpassword">Confirm Password: 
                <?php 
                if ($pMatch === false) {
                    echo "<span class='red'>*</span>";
                }
                ?>
            </label>
            <input type="password" id="cpassword" name="cpassword">
            
            <button type="submit">Sign-up</button>
        </form>
    </body>
</html>