<!DOCTYPE html>
<html>

<head>
    <style>
        .red {
            color:red;
        }
    </style>
</head>

<body>
    <?php 
    /* generate 10 divs, with evens colored in red */
    for ($i = 1; $i <= 10; $i++) {
        if ($i % 2 == 0) {
            echo "<div id='$i' class='red'>div num $i</div>";
        } else {
            echo "<div id='$i'>div num $i</div>";
        }
    }

    var_dump($url);
    ?>
</body>

</html>