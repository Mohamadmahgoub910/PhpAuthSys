<?php 
// session_start();

require 'index.php';
if(!isset($_SESSION['user'])){
    header('location:login.php');
    exit();
}
echo 'welcome '. $_SESSION['user']['name']; 
    
?>

<a href="logout.php">logout</a>