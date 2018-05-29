<!doctype html>
<?php 
session_start();

    $dbUrl = getenv('DATABASE_URL');
    $dbopts = parse_url($dbUrl);
    $dbHost = $dbopts["host"];
    $dbPort = $dbopts["port"];
    $dbUser = $dbopts["user"];
    $dbPassword = $dbopts["pass"];
    $dbName = ltrim($dbopts["path"],'/');
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    try {
        $stmt = $db->prepare('SELECT name, topic_id FROM topics');
        $stmt->execute();
        $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($topics);
    } catch (Exception $err) {
        echo "I died";
        die();
    }


?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Scriptureness</title>

</head>

    <body>
        <form method="POST" action="scriptures.php">
        <label for='book'>Book</label>
        <input id='book' type='text' name='book'>
        <br>
        <label for='chapter'>Chapter</label>
        <input id='chapter' type='text' name='chapter'>
        <br>
        <label for='verse'>Verse</label>
        <input id='verse' type='text' name='verse'>
        <br>
        <label for='content'>Content</label>
        <textarea id='content' name='content'></textarea>
        <br>
        <?php
        // var_dump($topics);
        foreach ($topics as $topic) {
            $topicName = $topic['name'];
            $topicId = $topic['topic_id'];
            echo "<input type='checkbox' name='topics[]' value='$topicId'> $topicName <br>";
        }

        ?>
        
        
        <input type='submit' value='Add'>
        </form>
    </body>
</html>

