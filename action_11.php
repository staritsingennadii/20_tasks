<?session_start();

$login = $_POST["login"];

if(!empty($login)) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cg_db";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $query = "SELECT * FROM users WHERE login = :login";
    $statement = $conn->prepare($query);
    $statement->execute(['login' => $login]);
    $countLogin = $statement->rowCount();
    $_SESSION['count_login'] = $countLogin;

    if($countLogin == 0) {
        $query = "INSERT INTO users (login) VALUES (:login)";
        $statement = $conn->prepare($query);
        $statement->execute(['login' => $login]);
    }
}

header("Location: /task_11.php");