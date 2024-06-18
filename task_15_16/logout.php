<?session_start();

unset($_SESSION["user"]);
unset($_SESSION["message"]);

header("Location: /task_15_16/index.php");