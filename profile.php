<?php 
// session_start();

require 'index.php';
if(!isset($_SESSION['user'])){
    if ($_SESSION['prev']=='user'){
    echo 'welcome '. $_SESSION['user']['name'];
    }
    header('location:login.php');
    exit();
}
?>

<a href="logout.php">logout</a>