<?php session_start(); ?>
<?php
    # this only works for Heroku
    # but it's really nice
    $dbUrl = getenv('DATABASE_URL');

    $dbopts = parse_url($dbUrl);

    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php 
    $scrip = htmlspecialchars($_GET['id']); 
    
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Scripture</title>
</head>
    <body>
        <?php 
        #$row = $db->query("SELECT * FROM scriptures WHERE id = '$scrip'");
        #echo '<p><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong> - "' . $row['content'] . '"</p>';
        
        foreach ($db->query("SELECT * FROM scriptures WHERE id = '$scrip'") as $row)
        {
          echo '<p><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong> - "' . $row['content'] . '"</p>';
        }
        ?>
    </body>
</html>