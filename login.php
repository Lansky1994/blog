<?php
    session_start();
    function session(){
        if($_SESSION['user']) {
            header('Location: profile.php');
        }
    }
    session();
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
        <input type="text" name="login" placeholder="Введите совй логин">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите свой пароль">
        <button type="submit">Войти</button>
        <p>
            У вас нет аккаунта? - <a href="register.php">Регистрация</a> | <a href="asdf.php">Закрыть</a>
        </p>
        <?php
        function ss2(){
            if ($_SESSION['message']){
                echo '<p class="msg"> ' . $_SESSION['message'] . '</p>';
            }
        }
        ss2();
        unset($_SESSION['message']);
        ?>
    </form>
</body>
</html>