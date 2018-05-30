<?php
session_start();

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

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
        <a class='button btn-warning' href='./controller.php?action=clearBuild'>Clear Build</a>
        <?php
        // message is defined in the header
        if (isset($message)) {
            echo "<div id='message'><p>$message</p></div>";
        }
        ?>
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
                    $itemPrice = $item['price'];
                    $itemName = $item['name'];
                    $itemType = $item['item_type_name'];
                    $id = $item['item_id'];
                    $total += $itemPrice;

                    if ($itemType === 'cpu' || $itemType === 'gpu' || $itemType === 'psu') {
                        $itemType = strtoupper($itemType);
                    } else {
                        $itemType = ucfirst($itemType);
                    }

                    echo "<tr>
                        <td>$itemType</td>
                        <td>$itemName</td>
                        <td>
                            <form method='POST' action='controller.php'>
                                <input type='hidden' name='action' value='removeFromBuild'>
                                <input type='hidden' name='itemType' value='$itemType'>
                                <input type='hidden' name='itemName' value='$itemName'>
                                <input type='hidden' name='itemId' value='$id'>
                                <input type='submit' value='Remove' class='button btn-warning'>
                            </form>
                        </td>
                        <td>$$itemPrice</td>
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