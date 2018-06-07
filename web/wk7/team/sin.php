<!--Sign in page-->

<?php

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
        <h1>Sign-in</h1>
        
        <form action="authenticate.php" method="post">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username">
            <label for="password">Password: </label>
            <input type="password" id="password" name="password">
            <button type="submit">Sign-in</button>
        </form>
    </body>
</html>