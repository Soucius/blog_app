<?php session_start();

    $dbName = "user_registration";
    $host = "localhost";
    $port = 3306;
    $user = "root";
    $password = "";

    $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8mb4";

    try {
        $connection = new PDO($dsn, $user, $password);
    } catch (PDOException $error) {
        echo $error->getMessage();
    }