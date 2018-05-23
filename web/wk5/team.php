<!doctype html>

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
    if(isset($_GET['book_search'])) {
        $search = $_GET['book_search'];        
    }

?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Scripture Resources</title>

</head>

    <body>
        <h1>Scripture Resources</h1>
        <h2>Stretch Challenges</h2>
        <h2>1</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <select name="book_search">
                <?php
                foreach ($db->query('SELECT DISTINCT book FROM scriptures') as $row) {
                    echo '<option value="' . $row['book'] . '">' . $row['book'] . '</option>';
                }
                ?>
            </select>
            <input type="submit" value="search">
        </form>
        
        <?php
    if(isset($_GET['book_search'])) {
        echo '<p>You searched!</p>';
        foreach ($db->query("SELECT * FROM scriptures WHERE book = '$search'") as $row)
        {
          echo '<p><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong> - "' . $row['content'] . '"</p>';
        }
    }
        else {
            echo '<p>Please search.</p>';
        }
        ?>
        
        <h2>2 and 3</h2>
        <?php
        foreach ($db->query('SELECT * FROM scriptures') as $row)
        {
          echo '<p><strong><a href="scripture_details.php?id=' . $row['id'] . '">' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</a></strong></p>';
        }
        ?>
        
        <h2>Core Requirements</h2>
        <?php
        foreach ($db->query('SELECT * FROM scriptures') as $row)
        {
          echo '<p><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong> - "' . $row['content'] . '"</p>';
        }
        ?>
    </body>
</html>

