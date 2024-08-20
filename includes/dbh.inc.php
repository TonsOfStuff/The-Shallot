
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

function loadEnv($path) {
    if (!file_exists($path)) {
        die("Error: .env file not found.");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Skip comments
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!array_key_exists($name, $_ENV)) {
            $_ENV[$name] = $value;
        }
    }
}

loadEnv(__DIR__ . '/../.env');

$host = $_ENV['DB_HOST'] ?? 'localhost';
$user = $_ENV['DB_USER'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';
$database = $_ENV['DB_DATABASE'] ?? '';

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