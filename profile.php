<?php
session_start();
if(!$_SESSION['user']) {
    header('Location: login.twig');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль</title>
    <link rel="stylesheet" href="css/blog_login.css">
</head>
<body>
    <form>
        <img src="<?= $_SESSION['user']['avatar'] ?>" width="100" alt="">
        <h2><?= $_SESSION['user']['name']?></h2>
        <a href="#"><?= $_SESSION['user']['email']?></a>
        <a href="vendor/logout.php" class="logout">Выход</a>
    </form>
</body>
</html>