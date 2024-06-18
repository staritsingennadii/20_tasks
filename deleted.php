<? if(isset($_GET["id"])) {
    $id = $_GET["id"];

    $host = 'localhost';
    $db = 'cg_db';
    $user = 'root';
    $pass = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $query = "SELECT * FROM photos WHERE ID = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$id]);
    $photo = $statement->fetch(PDO::FETCH_ASSOC);
    $photoName = $photo["name"];

    if(file_exists('upload/' . $photoName)) {
        unlink('upload/' . $photoName);
    }

    $query = "DELETE FROM photos WHERE ID = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$id]);
}

header("Location: /task_17.php");