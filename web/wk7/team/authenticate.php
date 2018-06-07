<?php

session_start();

require("dbConnect.php");
$db = get_db();

$username = $_POST["username"];
$password = $_POST["password"];

 try {
    $query = "SELECT * FROM tausers WHERE username = :username";

    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);

    $statement->execute();
     
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    
     if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
     } else {
        header("Location: /ta07/sin.php");
        die();
     }
     
} catch (Exception $ex) {
    header("Location: /ta07/sin.php");
    die();
     
} 
    header("Location: /ta07/home.php");
    die();
    
?>
