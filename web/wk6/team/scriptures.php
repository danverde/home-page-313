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

    $book = filter_input(INPUT_POST, 'book', FILTER_SANITIZE_STRING);
    $chapter = filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_STRING);
    $verse = filter_input(INPUT_POST, 'verse', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $topics = filter_input(INPUT_POST, 'topics', FILTER_SANITIZE_STRING);

    
    try {
        $stmt = $db->prepare('INSERT INTO scriptures(book, chapter, verse, content) VALUES(:book, :chapter, :verse, :content)');
        $stmt->bindValue(':book', $book, PDO::PARAM_STR);
        $stmt->bindValue(':chapter', $chapter, PDO::PARAM_STR);
        $stmt->bindValue(':verse', $verse, PDO::PARAM_STR);
        $stmt->bindValue(':content', $contents, PDO::PARAM_STR);
        $stmt->execute();
        $scriptureId = $pdo->lastInsertId('scripture_id_seq');

        var_dump($scriptureId);
        var_dump($topics);
        die();
        // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

        // var_dump($topics);
    } catch (Exception $err) {
        echo "I died";
        echo $err;
        die();
    }


?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Scripture Display</title>

</head>

    <body>
    </body>
</html>

