<?php
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $major = test_input($_POST["major"]);
    $comments = test_input($_POST["comments"]);
    $continents = $_POST["continents"];

    // var_dump($_POST);
    var_dump($continents);
    var_dump($continents);

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
    foreach ($contients as &$continent) {
        echo "<p>{$continent}</p>";
    }?>
    
</body>

</html>