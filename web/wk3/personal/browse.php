<?php 
    session_start();
    $defaultCart = array('Right Kidney' => array('price' => 145, 'quantity' => 0 ),
        'Left Kidney' => array('price' => 150, 'quantity' => 0),
        'Liver' => array('price' => 750, 'quantity' => 0),
        'Heart' => array('price' => 4999, 'quantity' => 0),
        'Band-Aid' => array('price' => .5, 'quantity' => 0),
        'Spleen' => array('price' => 75, 'quantity' => 0));

    if (!isset($_SESSION['existingSession'])) {
        // so I know if it's a new session or not.
        $_SESSION['existingSession'] = true;
        $_SESSION['cart'] = $defaultCart;
    } 

    
    $cart = $_SESSION['cart'];
    
    $enabledCart = false;

    foreach ($cart as $itemName => $item) {
        if ($item['quantity'] > 0) {
            $enabledCart = true;
            break;
        }
    }
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
            <a class='button warning' href='./control.php?action=endSession'>Empty Cart</a>
        </nav>
    </header>
    <div class="flex-wrapper">
        <?php 
            foreach ($cart as $itemName => $item) {
                echo "
                <form action='control.php' method='POST' name='addItem'>
                <input type='hidden' value='addItem' name='action'>
                <input type='hidden' value='{$itemName}' name='name'>
                <div class='flex-wrapper space-around'>
                    <p>".$itemName."</p>
                    <p>$".$item['price']."</p>
                    <p>".$item['quantity']."</p>
                    <button class='button' onclick='addItem()'>Add Item</button>
                </div>
                </form>";
            }
        ?>
        <div class='flex-wrapper row-reverse borderless' id='browse'>
            <p>
            <?php 
            if ($enabledCart === true) {
                echo "<a class='button primary' href='./cart.php'>Cart</a>";
            } else {
                echo "<a class='button disabled'>Cart</a>";
            } ?>
            </p>
        </div>
    </div>
    <h2>!IMPORTANT! WE DON'T ACTUALLY SELL, OR OFFICIATE WITH ANYONE WHO DOES SELL BODY PARTS OF ANY KIND!</h2>
    <?php 
        include_once './footer.php';
    ?>
</body>

</html>