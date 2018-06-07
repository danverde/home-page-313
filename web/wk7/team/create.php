<!--To process the submitted files-->

<?php

session_start();

require("dbConnect.php");
$db = get_db();

$username = $_POST["username"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];

if ($password !== $cpassword) {
    $_SESSION["pMatch"] = false;
    header("Location: /ta07/sup.php");
    die();
} else {
    $_SESSION["pMatch"] = true;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

 try {
        $query = "INSERT INTO tausers(username, password) VALUES(:username, :password)";

        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $passwordHash);
     
        $statement->execute();
} catch (Exception $ex) {
        echo "Error with DB. Details: $ex";
        die();
} 
    
    header("Location: /ta07/sin.php");
    die();
    
?>