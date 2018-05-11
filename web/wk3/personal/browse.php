<?php 
    session_start();
    // var_dump(session_id());
    if (!isset($_SESSION['existingSession'])) {
        // so I know if it's a new session or not.
        $_SESSION['existingSession'] = true;
    } else {

    }

    $defaultCart = array(array('name' => 'Item One', 'price' => 50, 'quantity' => 0 ),
    array('name' => 'item Two', 'price' => 200, 'quantity' => 0));
    
    $cart;
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
    <!-- <script src="main.js"></script> -->
    <script src="main.js">
        function addItem(element) {
            
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
            foreach ($defaultCart as $item) {
                // echo "<div class='flex-wrapper space-around'><p>".$item['name']."</p><p>$".$item['price']."</p><p>".$item['quantity']."</p><button class='button'>Add Item</button></div>";
            }
            ?>
            <div class='flex-wrapper space-around'><p>Name</p><p>Price</p><p>Quantity</p><button class='button' onclick='addItem(this)'>Add Item</button><input value='1' input='hidden' name='itemOne'></div>
        </form>
    </div>
</body>
</html>