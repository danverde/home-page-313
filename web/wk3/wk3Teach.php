<?php 
    $majors = array("WDD"=>"Web Development", "CS"=>"Computer Science", "CIT"=>"Computer Information Technology", "CE"=>"Computer Engineering");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Week 3 Teach</title>
</head>

<body>
    <h1>Week 3 Teach one another Form Submission</h1>
    <a href="../index.php">Home</a>
    <form action="results.php" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <br>

        <?php 
        foreach ($majors as $i => $major) {
            echo "<lable for='{$i}'>{$major}</label><input type='radio' name='major' id='{$i}' value='{$major}' required><br>";
        }
        ?>


        <label for="NA">North America</label>
        <input name="continents[]" type="checkbox" id="NA" value="NA">
        <br>
        <label for="SA">South America</label>
        <input name="continents[]" type="checkbox" id="SA" value="SA">
        <br>
        <label for="AU">Australia</label>
        <input name="continents[]" type="checkbox" id="AU" value="AU">
        <br>
        <label for="AN">Antartica</label>
        <input name="continents[]" type="checkbox" id="AN" value="AN">
        <br>
        <label for="AS">Asia</label>
        <input name="continents[]" type="checkbox" id="AS" value="AS">
        <br>
        <label for="EU">Europe</label>
        <input name="continents[]" type="checkbox" id="EU" value="EU">
        <br>
        <label for="AF">Africa</label>
        <input name="continents[]" type="checkbox" id="AF" value="AF">
        <br>


        
        <input type="submit" value="Submit">
    </form>
</body>

</html>