<?php
require 'index.php';
if (isset($_POST['submit'])) {
    include 'conn-db.php';
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);

    // Errors
    $errors = [];
    // Validate Name
    if (empty($name)) {
        $errors[] = '<span style="color:red" >you must put a name</span>';
    } elseif (strlen($name) > 30) {
        $errors[] = '<span style="color:#FFD133" > name must less than 30 char</span>';
    }
    // validate Email
    if (empty($email)) {
        $errors[] = '<span style="color:red" >you must put a valid email</span>';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $errors[] = '<span style="color:#FFD133" > That is not a validate email </span>';
    }

    $stm = "SELECT email FROM users WHERE email ='$email'";
    $q = $conn->prepare($stm);
    $q->execute();
    $data = $q->fetch();

    if ($data) {
        $errors[] = '<span style="color:#FFD133" >That email is already token</span>';
    }
    // validate password
    if (empty($password)) {
        $errors[] = '<span style="color:red" >you must put a valid password</span>';
    } elseif ($password !== $cpassword) {
        $errors[] = '<span style="color:red" >your password and confirm does not match</span>';
    }

    // validate Errors
    if (empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stm = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
        $conn->prepare($stm)->execute();
        $_POST['name'] = '';
        $_POST['email'] = '';

        $_SESSION['user'] = [
            "name" => $name,
            "email" => $email,
        ];
        echo '<h3>Successfully inserted</h3>';
        header('location:profile.php');
    } else {
        var_dump($errors);
    }
}
?>
<div style="text-align: center">Register
    <h1>Sign Up </h1>
    <form method="post" action="register.php">
        <label>Name </label>
        <input type="text" name="name" value="<?php if (isset($_POST['name'])) {echo $_POST['name'];}?>"
            placeholder="write your name">
        <br><br>
        <label>Email </label>
        <input type="text" name="email" value="<?php if (isset($_POST['email'])) {echo $_POST['email'];}?>"
            placeholder="write your email">
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