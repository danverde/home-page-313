<?php
session_start();


if (!isset($_SESSION['build'])) {
    header("location: ./controller.php?action=getBuild");
exit();
}


$build = $_SESSION['build'];
$total = 0;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Build</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./style/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="./style/build.css" />
</head>
<body>
    <?php require 'header.php'; ?>    
    <main>
        <h1>My Build</h1>
        <table>
            <thead>
                <tr>
                    <th>Component Type</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($build as $item) {
                    $price = $item['price'];
                    $name = $item['name'];
                    $component = $item['item_type_name'];
                    $total += $price;

                    if ($$component === 'cpu' || $$component === 'gpu' || $$component === 'psu') {
                        $$component = strtoupper($$component);
                    } else {
                        $$component = ucfirst($$component);
                    }

                    echo "<tr>
                        <td>$component</td>
                        <td>$name</td>
                        <td>1x</td>
                        <td>$$price</td>
                    </tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <th>Total:</th>
                    <td>$<?php echo $total;?></td>
                </tr>
            </tfoot>
        </table>
    </main>
    <?php require 'footer.php'; ?>    
</body>
</html>