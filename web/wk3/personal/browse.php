<?php 
    session_start();
    $defaultCart = array('itemOne' => array('price' => 50, 'quantity' => 0 ),
        'itemTwo' => array('price' => 200, 'quantity' => 0));

    // var_dump(session_id());
    if (!isset($_SESSION['existingSession'])) {
        // so I know if it's a new session or not.
        $_SESSION['existingSession'] = true;
        $_SESSION['cart'] = $defaultCart;
    } 

    
    $cart = $_SESSION['cart'];
    
    $enabledCart = true;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Browse Items</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script>
        function addItem(element) {
            document.forms['addItem'].submit();
        }
    </script>
</head>
<body>
    <header class="flex-wrapper space-between">
        <h1>Browse Items</h1>
        <nav>
            <a class="button" href="../../index.php#assignments">Home</a>
            <?php 
            if ($enabledCart === true) {
                echo "<a class='button' href='./cart.php'>Cart</a>";
            } else {
                echo "<a class='button disabled'>Cart</a>";
            } ?>
        </nav>
</header>
    <div class="flex-wrapper">
        <form action='control.php' method='POST' name='addItem'>
            <?php 
            var_dump($cart);
            // foreach ($cart as $itemName => $item) {
            //     var_dump($item);
            //     echo "<div class='flex-wrapper space-around'><p>".$itemName."</p><p>$".$item['price']."</p><p>".$item['quantity']."</p><button class='button'>Add Item</button></div>";
            // }
            ?>
            <!-- <div class='flex-wrapper space-around'>
                <p>Name</p>
                <p>Price</p>
                <p>Quantity</p>
                <button class='button' onclick='addItem(this)'>Add Item</button>
                <input value='itemOne' type='hidden' name='name'>
            </div> -->
        </form>
    </div>
</body>
</html>