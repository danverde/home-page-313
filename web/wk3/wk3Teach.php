<?php 
    $majors = array("WDD"=>"Web Dev", "CS"=>"Computer Science", "CIT"=>"Computer Information Technology", "CE"=>"Computer Engineering");

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

        <!-- <label for="CS">Computer Science</label>
        <input type="radio" name="major" id="CS" value="CS" required>
        <br>
        <label for="WDD">Web Design &amp; Development</label>
        <input type="radio" name="major" id="WDD" value="WDD" required>
        <br>
        <label for="CIT">Computer Information Technology</label>
        <input type="radio" name="major" id="CIT" value="CIT" required>
        <br>
        <label for="CE">Computer Engineering</label>
        <input type="radio" name="major" id="CE" value="CE" required>
        <br>
        <label for="comments">Comments</label>
        <textarea name="comments" wrap="hard" required></textarea>
        <br> -->

        <label for="NA">North America</label>
        <input name="continents[]" type="checkbox" value="North America">
        <br>
        <label for="SA">South America</label>
        <input name="continents[]" type="checkbox" value="South America">
        <br>
        <label for="Australia">Australia</label>
        <input name="continents[]" type="checkbox" value="Australia">
        <br>
        <label for="Antartica">Antartica</label>
        <input name="continents[]" type="checkbox" value="Antartica">
        <br>
        <label for="Asia">Asia</label>
        <input name="continents[]" type="checkbox" value="Asia">
        <br>
        <label for="Europe">Europe</label>
        <input name="continents[]" type="checkbox" value="Europe">
        <br>
        <label for="Africa">Africa</label>
        <input name="continents[]" type="checkbox" value="Africa">
        <br>


        
        <input type="submit" value="Submit">
    </form>
</body>

</html>