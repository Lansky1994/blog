<?php

//    $connect = mysqli_connect('127.0.0.1', 'root', 'root', 'blog', '3307');
//
//    if (!$connect) {
//        die('Error connect to DataBase');
//    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    //    $connect = mysqli_connect('127.0.0.1', 'root', 'root', 'blog', '3307');
    $connect = new PDO("mysql:host=127.0.0.1:3307;dbname=blog", "root", "root");

