<?php 
require 'index.php';
if(isset($_POST['submit'])){
    $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    // Errors 
    $errors = [];
    // Validate Name 
    if (empty($name)){
        $errors[]='<span style="color:red" >you must put a name</span>';
    }elseif(strlen($name)>30){
        $errors[]='<span style="color:yellow" > name must less than 30 char</span>';
    }

    if(empty($errors)){
        echo'<h3>Successfully inserted</h3>';
    }else{
        var_dump($errors);
    }
}
?>
<div style="text-align: center">Register
    <h1>Sign Up </h1>
    <form method="post" action="register.php">
        <label>Name </label>
        <input type="text" name="name" placeholder="write your name">
        <br><br>
        <label>Email </label>
        <input type="email" name="email" placeholder="write your email">
        <br><br>
        <label>Password </label>
        <input type="password" name="password" placeholder="write your password">
        <br><br>
        <label>Confirm Password </label>
        <input type="password" name="cpassword" placeholder="confirm your password">
        <br><br>
        <input type="submit" name="submit" value="SUBMIT">
    </form>
    <br>
    <div>
        <p> you have an email already? sign in here
            <a href="login.php">Login</a>
        </p>
    </div>
</div>