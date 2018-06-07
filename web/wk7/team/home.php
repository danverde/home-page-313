<!--Homepage-->

<?php

session_start();

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
} else {
    header("Location: /ta07/sin.php");
    die();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sign-In</title>
        <link rel="stylesheet" href="home.css">
        <script src="home.js"></script>
    </head>
    
    <body>
        <h1>Welcome <?php echo $user; ?></h1>
        
    </body>
</html>