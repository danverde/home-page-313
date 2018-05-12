<?php 
session_start();
if (!isset($_SESSION['existingSession'])) {
    header("Location: ./browse.php");
    exit();
    return;
}
$cart = $_SESSION['cart'];
$total = $_SESSION['total'];
$checkoutInfo;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>

<body>
    <header class="flex-wrapper space-between">
        <h1>Checkout</h1>
        <nav>
            <a class='button' href='./cart.php'>CART</a>
        </nav>
    </header>
    <h2>Summary</h2>
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
    <h2>Shipping Info</h2>
    <div id='shipping'>
        <form action='control.php' method='POST' name='checkout'>
            <fieldset>
                <legend>Shipping Address</legend>
                <input type='hidden' name='action' value='checkout'>
                <label for='name'>Name</label>
                <input type='text' id='name' name='name' required>
                <br>
                <label for='address'>Address</label>
                <input type='text' id='address' name='address' required>
                <label for='apt'>Apt, Suite, etc.</label>
                <input type='number' id='apt' name='apt'>
                <br>
                <label for='zip'>ZIP Code</label>
                <input type='number' id='zip' name='zip' required>
                <br>
            </fieldset>
            <fieldset>
                <legend>Shipping Method</legend>
                <input type='radio' id='shipping1' name='shipping' value='3' required>
                <label for='shipping1'>3 Days</label>
                <br>
                <input type='radio' id='shipping2' name='shipping' value='5' required checked>
                <label for='shipping2'>5 Days</label>
                <br>
                <input type='radio' id='shipping3' name='shipping' value='7' required>
                <label for='shipping3'>7 Days</label>
            </fieldset>
            <div class='flex-wrapper flex-end' id='checkout'>
                <?php echo "<h3>Total: \${$total}</h3>"; ?>
                <input type='submit' class='button primary' value='Confirm Checkout'>
            </div>
        </form>
    </div>
    <footer>
        <a class="button" href="../../index.php#assignments">Assignments</a>
    </footer>
</body>

</html>