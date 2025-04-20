<?php
    $password = '';
    $username = 'root';
    $dbname = 'coursework';
    $hostname = 'localhost';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    try{
        $link = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password, $options);
    }
    catch(PDOException $error){
        echo "Ошибка подключения: " . $error->getMessage();
    }
?>