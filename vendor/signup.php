<?php

    session_start();
    require_once 'connect.php';

    $name = $_POST['name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    if ($password === $password_confirm and !empty($password)) {

        $path = '../img/' . time() . $_FILES['avatar']['name'];
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $path)) {
            $_SESSION['message'] = 'Ошибка при загрузке сообщения';
            header('Location: /signup');
        }
        
        $password = hash(sha512, $password);
        $sql = "INSERT INTO blogs (name, login, email, password, avatar) VALUES (:name, :login, :email, :password, :path)";
        $statement = $connect->prepare($sql);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":login", $login);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":path", $path);
        $statement->execute();
//        mysqli_query($connect, "INSERT INTO `blogs` (`name`, `login`, `email`, `password`, `avatar`) VALUES ('$name', '$login', '$email', '$password', '$path')");
        $_SESSION['message'] = 'Регистрация прошла успешно';
        header('Location: /signin');

    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: /signup');
    }



    