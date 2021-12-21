<?php
    $dbHost = 'localhost';
    $dbUser='root';
    $dbPass='';
    $dbName='auth';

    try {
        //code...
        $conn= new PDO("mysql:host=$dbHost;port=3308;dbname=$dbName",$dbUser,$dbPass);
        // echo "connected db successfully ";
    } catch (Exception $ex) {
        echo 'Error: '.$ex->getMessage();
        exit();
    }
?>