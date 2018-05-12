<?php 
session_start();
if (!isset($_SESSION['existingSession'])) {
    header("Location: ./browse.php");
    exit();
    return;
}
$cart = $_SESSION['cart'];
$total = 0;
foreach ($cart as $item) {
    $total += ($item['price'] * $item['quantity']) ;
}
$_SESSION['total'] = $total;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <!-- <script src="main.js"></script> -->
</head>

<body>
    <header class="flex-wrapper space-between">
        <h1>Cart</h1>
        <nav>
            <a class='button warning' href='./destroy.php'>EMPTY CART</a>
            <a class="button" href="./browse.php">browse</a>
        </nav>
    </header>
    <div class="flex-wrapper" id='cart'>
        <?php 
            foreach ($cart as $itemName => $item) {
                echo "
                <div class='flex-wrapper space-around'>
                    <p>".$itemName."</p>
                    <p>$".$item['price']."</p>
                    <p>".$item['quantity']."</p>
                </div>";
            }
            echo "
            <div class='flex-wrapper flex-end' id='checkout'>
                <p>Total: \${$total}</p>
                <a class='button primary' href='./checkout.php'>Checkout</a>
            </div>";
            ?>
    </div>
    <footer>
        <a class="button" href="../../index.php#assignments">Assignments</a>
    </footer>
</body>

</html>