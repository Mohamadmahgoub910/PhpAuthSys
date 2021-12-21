<?php 
require 'index.php';
session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
    exit();
}
echo 'welcome '. $_SESSION['user']['name']; 
    
?>

<a href="logout.php">logout</a>