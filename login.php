<?php
    session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <link rel="stylesheet" href="css/blog_login.css">

</head>
<body>

    <form action="vendor/signin.php" method="post">
        <label>Логин</label>
        <input type="text" placeholder="Введите совй логин">
        <label>Пароль</label>
        <input type="password" placeholder="Введите свой пароль">
        <button type="submit">Войти</button>
        <p>
            У вас нет аккаунта? - <a href="register.php">Регистрация</a> | <a href="index.php">Закрыть</a>
        </p>
        <?php
        if ($_SESSION['message']){
            echo '<p class="msg"> ' . $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message']);
        ?>
    </form>
</body>
</html>