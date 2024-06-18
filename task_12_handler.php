<?session_start();

$mail = $_POST['email'];
$pass = $_POST['password'];


if(!empty($mail) && !empty($pass)) {
    $serverName = 'localhost';
    $userName = 'root';
    $dbPassword = '';
    $dbName = 'cg_db';
    $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $dbPassword);
    $sql = "SELECT * FROM users2 WHERE login = :mail";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rowCount = $stmt->rowCount();

    if($rowCount > 0) {
        $_SESSION['message'] = 'Этот эл адрес уже занят другим пользователем';
    }else{
        $sql = "INSERT INTO users2 (login, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        
        $passHash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt->execute([$mail, $passHash]);
    }
}

header("Location: /task_12.php");