<?php
//session_start();

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
                <tr>
                    <td>Motherboard</td>
                    <td>Asus Z97-AR</td>
                    <td>1x</td>
                    <td>$100</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <th>Total:</th>
                    <td>$900</td>
                </tr>
            </tfoot>
        </table>
    </main>
    <?php require 'footer.php'; ?>    
</body>
</html>