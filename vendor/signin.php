<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $password = hash(sha512, $_POST['password']);


    $check_user = "SELECT * FROM blogs WHERE login = :login AND password = :password";
    $statement = $connect->prepare($check_user);
    $statement->bindParam(":login", $login);
    $statement->bindParam(":password", $password);
    $statement->execute();
    $statement = $connect->prepare()
//    $check_user = mysqli_query($connect, "SELECT * FROM `blogs` WHERE `login` = '$login' AND `password` = '$password'");
    $row_count =$statement->fetchColumn();
    echo $row_count;die();
//    echo mysqli_num_rows($statement);die();
    if (mysqli_num_rows($statement) > 0) {
        $user = mysqli_fetch_assoc($statement);
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

