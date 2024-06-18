<?if(isset($_FILES['image']['name'])) {
    $filetype = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $name = uniqid() . '.' . $filetype;
    $uploaddir = 'upload/';
    $uploadfile = $uploaddir . $name;
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);

    $host = 'localhost';
    $dbname = 'cg_db';
    $dbuser = 'root';
    $dbpassword = '';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
    $query = 'INSERT INTO photos (name) VALUES (?)';
    $statement = $pdo->prepare($query);
    $statement->execute([$name]);
}

header("Location: /task_17.php");