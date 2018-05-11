<?php 
if (session_status() === 1) {
    session_start();
}
if (!isset($_SESSION["count"])) {
    $_SESSION["count"] = 1;
} else {
    $_SESSION["count"]++;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <a href="../index.php">go home</a>
    <h1>Counter</h1>
    <?php echo "<p>You have been here ".$_SESSION["count"]." times</p>";?>
</body>
</html>