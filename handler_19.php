<?if(isset($_FILES['photo'])) {
    $host = 'localhost';
    $dbname = 'cg_db';
    $dbuser = 'root';
    $dbpassword = '';
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
    $query = 'INSERT INTO photos2 (name) VALUES (?)';
    
    foreach($_FILES['photo']['name'] as $key => $photoName) {
        $filetype = pathinfo($photoName, PATHINFO_EXTENSION);
        $name = uniqid() . '.' . $filetype;
        $uploaddir = 'upload2/';
        $uploadfile = $uploaddir . $name;
        move_uploaded_file($_FILES['photo']['tmp_name'][$key], $uploadfile);

        $statement = $pdo->prepare($query);
        $statement->execute([$name]);
    }
}

header("Location: /task_19.php");