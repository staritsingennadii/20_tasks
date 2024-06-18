<? session_start();
$host = 'localhost';
$db = 'cg_db';
$dbuser = 'root';
$dbpassword = '';

$login = $_POST["mail"];
$password = $_POST["password"];

if(!empty($login) && !empty($password)) {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpassword);
    $query = 'SELECT * FROM users2 WHERE login = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $verif = password_verify($password, $user["password"]);

    if(empty($user) || empty($verif)) {
        $_SESSION["message"] = 'Неверный логин или пароль';
    }else{
        $_SESSION["user"] = [
            "id" => $user["id"], 
            "login" => $user["login"]
        ];
        $_SESSION["message"] = 'Здравствуйте, ' . $user["login"] . '.';
    }
}else{
    $_SESSION["message"] = 'Заполните поля логин и пароль';
}

header("Location: /task_15_16/index.php");