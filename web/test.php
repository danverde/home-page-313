<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php echo 'hello there my friend'; ?>

    <?php 
    for ($i = 0; $i <= 10; $i++) {
        if ($i % 2 == 0) {
            echo "<div id='$i' style='color:red'>div num $i</div>";
        } else {
            echo "<div id='$i'>div num $i</div>";
        }
    }
    ?>
</body>
</html>