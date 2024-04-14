
<?phP 
/*$dsn = "mysql:host = localhost; dbname = shallotdb";
$dbusername = "root";
$dbpass = "jerryton123";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpass); //Actually used to connect to the DB
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //If we get an error, we will throw an exception
} catch(PDOException $e) { //$e is a variable
    echo "Connection Failed:" . $e->getMessage();
};*/

$host = "localhost";
$user = "root";
$password = "jerryton123";
$database = "shallotdb";

// Create a database connection
$db = new mysqli($host, $user, $password, $database);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Select the database
if (!mysqli_select_db($db, $database)) {
    die("Database selection failed: " . mysqli_error($db));
}