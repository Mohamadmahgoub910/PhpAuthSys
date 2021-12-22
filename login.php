<?php
require 'index.php';
if (isset($_SESSION['user'])) {
    header('location:profile.php');
    exit();
}
if (isset($_POST['submit'])) {
    include 'conn-db.php';
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $errors = [];
    $_SESSION['user'] = [
        "name" => $name,
        "email" => $email,
    ];

    // validate email
    if (empty($email)) {
        $errors[] = '<span style="color:red" >you must put ur email</span>';
    }


    // validate password
    if (empty($password)) {
        $errors[] = '<span style="color:red" >you must put a password</span>';
    }
    // insert or errors 
    if (empty($errors)) {

        // echo "check db";

        $stm = "SELECT * FROM users WHERE email ='$email'";
        $q = $conn->prepare($stm);
        $q->execute();
        $data = $q->fetch();
        if (!$data) {
            $errors[] = '<span style="color:red" >Email Error</span>';
        } else {

            $password_hash = $data['password'];

            if (!password_verify($password, $password_hash)) {
                $errors[] = '<span style="color:red" >Error in password </span>';
            } else {
                $_SESSION['user'] = [
                    "name" => $data['name'],
                    "email" => $email,
                ];
                $_SESSION['prev']=$data['prev'];
                    // header('location:home.php');
                    if(isset($_SESSION['user'])){
                        if ($_SESSION['prev']== 'user'){
                            header('location:profile.php');
                        }
                        if ($_SESSION['prev']=='admin'){
                            header('location:dashboard.php');
                            }
                        if ($_SESSION['prev']=='manager'){
                            header('location:mnager.php');
                            }
                    }

                }
                
        }
    }
}

?>


<br><br>
<div style="text-align: center;">
    <form action="login.php" method="POST">
        <?php
    if (isset($errors)) {
        if (!empty($errors)) {
            foreach ($errors as $msg) {
                echo $msg . "<br>";
            }
        }
    }
    ?>

        <label>write your Email </label>
        <input type="text" value="<?php if (isset($_POST['email'])) {
                                    echo $_POST['email'];
                                } ?>" name="email" placeholder="email"><br><br>
        <label>write your password </label>
        <input type="password" name="password" placeholder="password"><br><br>
        <input type="submit" name="submit" value="Login">
    </form>
    <br><br>
    create a new account <a href="register.php">register</a><br><br><br>
</div>