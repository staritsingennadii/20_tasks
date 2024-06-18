<?
$login = $_POST["login"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cg_db";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$query = "INSERT INTO users (login) VALUES (:login)";
$statement = $conn->prepare($query);
$statement->execute(['login' => $login]);

header("Location: /task_10.php");