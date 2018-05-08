<?php
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $major = test_input($_POST["major"]);
    $comments = test_input($_POST["comments"]);
    $continents = $_POST["continents"];

    function test_input($data) {
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>

<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <a href="../index.php">Home</a>
    <?php echo "<p>Your Name: {$name}</p>";?>
    <?php echo "<a href='mailto:{$email}'>Your email: {$email}</a>";?>
    <?php echo "<p>Your Major: {$major}</p>";?>
    <?php echo "<p>Your Comments: {$comments}</p>";?>
    <?php 
    echo "<p>You have visited the following continent(s):</p><ul>";
    foreach ($continents as $continent) {
        $continentClean = test_input($continent);
        echo "<li>{$continentClean}</li>";
    }
    echo "</ul>";
    ?>
    
</body>

</html>