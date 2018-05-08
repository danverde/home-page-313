<?php
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $major = test_input($_POST["major"]);
    $comments = test_input($_POST["comments"]);
    $continents = $_POST["continents"];

    // var_dump($_POST);
    // print_r($continents);
    // var_dump($continents);

    function test_input($data) {
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
    <?php //var_dump($_POST) ?>
    <?php echo "<p>Your Name: {$name}</p>";?>
    <?php echo "<a href='mailto:{$email}'>Your email: {$email}</a>";?>
    <?php echo "<p>Your Major: {$major}</p>";?>
    <?php echo "<p>Your Comments: {$comments}</p>";?>
    <?php 
    echo "You have visited the following continent(s):";
    foreach ($continents as $continent) {
        var_dump($continent);
        $continentClean = test_input($continent);
        echo "<p>{$continentClean}</p>";
    }?>
    
</body>

</html>