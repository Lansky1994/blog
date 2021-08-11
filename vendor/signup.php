<?php

    session_start();
    require_once 'connect.php';

    $name = $_POST['name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password === $password_confirm) {

        $path = '/img/' . time() . $_FILES['avatar']['name'];
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $path)) {
            $_SESSION['message'] = 'Ошибка при загрузке сообщения';
            header('Location: ../register.php');
        }
        
        $password = hash(sha512, $password);
        
        mysqli_query($connect, "INSERT INTO `blogs` (`name`, `login`, `email`, `password`, `avatar`) VALUES ('$name', '$login', '$email', '$password', '$path')");
        $_SESSION['message'] = 'Регистрация прошла успешно';
        header('Location: ../login.php');

    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../register.php');
    }



    