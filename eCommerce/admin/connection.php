<?php

    $dsn = 'mysql:host=localhost;dbname=eCommerce';
    $user = 'root';
    $pass = '';
    $option = array(
        'PDO::MYSQL_ATTR_INIT_COMMAND' => 'SET_NAMES_utf8'
    );

    try{
        $conn = new PDO($dsn,$user,$pass,$option);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e) {
        echo 'Failed Connection: ' . $e->getMessage();
    }