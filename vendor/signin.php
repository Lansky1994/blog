<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['login'];
    $password = hash(sha512, $_POST['password']);



    $check_user = mysqli_query($connect, "SELECT * FROM `blogs` WHERE `login` = '$login' AND `password` = '$password'");
    echo mysqli_num_rows($check_user);


