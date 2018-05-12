<?php
session_start();
if (!isset($_SESSION['existingSession'])) {
    header("Location: ./browse.php");
    exit();
    return;
}

$cart = $_SESSION['cart'];
$total = "\${$_SESSION['total']}";

$name = $_SESSION['name'];
$email = $_SESSION['email'];
$address = $_SESSION['address'];
$state = $_SESSION['state'];
$apt = $_SESSION['apt'];
$zip = $_SESSION['zip'];
$shipping = "{$_SESSION['shipping']} Days";


?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Confirm</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    </head>

    <body>
        <header class="flex-wrapper space-between">
            <h1>Invoice</h1>
            <nav>
                <a class='button primary' href='./control.php?action=endSession'>Done</a>
            </nav>
        </header>
        <h2 class='section'>Item Summary</h2>
        <div class="flex-wrapper" id='summary'>
            <?php 
            foreach ($cart as $itemName => $item) {
                echo "
                <div class='flex-wrapper space-around'>
                    <p>".$itemName."</p>
                    <p>$".$item['price']."</p>
                    <p>".$item['quantity']."</p>
                </div>";
            }
        ?>
        </div>
        <h2 class='section'>Shipping Info</h2>
        <div id='shipping'>
            <p>Name: <?php echo $name; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>State: <?php echo $state; ?></p>
            <p>Address: <?php echo "{$address} "; if (!empty($apt)) echo "$apt"; ?></p>
            <p>ZIP Code: <?php echo $zip; ?></p>
            <p>Shipping: <?php echo $shipping; ?></p>
        </div>
        <h2 class='section'>Total</h2>
        <div class='flex-wrapper space-between'>
            <h3><?php echo $total; ?></h3>
            <a class='button primary' href='./control.php?action=endSession'>Done</a>
        </div>
        <?php 
            include_once './footer.php';
        ?>
    </body>

    </html>