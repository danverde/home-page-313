<?php
// require './db.php';
// $dbUrl = getenv('DATABASE_URL');

// $dbopts = parse_url($dbUrl);

// $dbHost = $dbopts["host"];
// $dbPort = $dbopts["port"];
// $dbUser = $dbopts["user"];
// $dbPassword = $dbopts["pass"];
// $dbName = ltrim($dbopts["path"],'/');

// $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));

$db = $pdo;


// var_dump($dbHost);
// var_dump($dbPort);
// var_dump($dbName);
// var_dump($dbUser);
// var_dump($dbPassword);
var_dump($db);
exit();

session_start();

/* get action */
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if (empty($action)) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
if ($action == null) {
    $action = 'getItemTypes';
}

/* set default reedirect location */
$location = './index.php';


/* Start functions */
function getItemTypes() {
    // $_SESSION['itemTypes'] = null;
    try {
        $stmt = $db->prepare('SELECT item_type_name FROM item_type');
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['itemTypes'] = $rows;
    } catch (PDOException $err) {
        $_SESSION['message'] = "Unable to get availible item types: $err";
        $_SESSION['itemTypes'] = null;
    }

    $location = './index.php';
    return;
}

/* chose action */
switch ($action) {
    case 'getItemTypes':
    getItemTypes();
    break;
}

header("location: $location");
exit();

?>