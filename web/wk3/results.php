<?php
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $major = test_input($_POST["major"]);
    $comments = test_input($_POST["comments"]);


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
    
</body>

</html>