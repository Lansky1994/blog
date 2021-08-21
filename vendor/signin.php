<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $password = hash(sha512, $_POST['password']);


    $check_user = "SELECT SQL_CALC_FOUND_ROWS * FROM blogs WHERE login = :login AND password = :password > 0";
    $statement = $connect->prepare($check_user);
    $statement->bindParam(":login", $login);
    $statement->bindParam(":password", $password);
    $statement->execute();

//    $check_user = mysqli_query($connect, "SELECT * FROM `blogs` WHERE `login` = '$login' AND `password` = '$password'");

//    echo mysqli_num_rows($statement);die();
    if ($statement > 0) {
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user'] = [
            "avatar" => $user['avatar'],
            "id" => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ];
        header('Location: ../profile.php');
    } else {
        $_SESSION['message'] = 'Не верный логин или пароль';
        header('Location: ../login.php');
    }
?>

<!--<pre>-->
<!--    --><?php
//        print_r($check_user);
//        print_r($user);
//    ?>
<!--</pre>-->

