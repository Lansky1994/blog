<?php
    session_start();
    if($_SESSION['user']) {
        header('Location: profile.php');
    }
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
<form action="vendor/signup.php" method="post" enctype="multipart/form-data">
    <label>Имя</label>
    <input type="text" name="name" placeholder="Введите свое имя">
    <label>Логин</label>
    <input type="text" name="login" placeholder="Придумайте логин">
    <label>Потча</label>
    <input type="email" name="email" placeholder="Укажите свой email">
    <label>Изображение профиля</label>
    <input type="file" name="avatar">
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите свой пароль">
    <label>Подтверждение пароля</label>
    <input type="password" name="password_confirm" placeholder="подтвердите пароль">
    <button type="submit">Зарегистрироваться</button>
    <p>
        У вас уже есть аккаунт? - <a href="login.php">Авторизация</a> | <a href="asdf.php">Закрыть</a>
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