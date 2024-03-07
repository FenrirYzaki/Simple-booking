<?php

@include 'config.php' ;

if(isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $Cpass = md5($_POST['Cpassword']);

    $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0) {
        $error[] = 'User already exist';
    } else {
        if($pass != $Cpass) {
            $error[] = 'Password not match';
        } else {
            $insert = "INSERT INTO user(name, email, password) VALUES('$name', '$email', '$pass') ";
            mysqli_query($conn, $insert);
            header('location:login_form.php');
        }
    }
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>

    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <div class="form-container">

        <form action="" method="post">
            <h3>Register</h3>
            <?php
                if(isset($error)) {
                    foreach($error as $error) {
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>
            <input type="text" name="name" required placeholder="Your Name">
            <input type="email" name="email" required placeholder="Your email">
            <input type="Password" name="password" required placeholder="Your Password">
            <input type="Password" name="Cpassword" required placeholder="Confirm Your Password">
            <input type="submit" name="submit" value="register" class="form-btn">
            <p>Have an account ? <a href="login_form.php">Login</a></p>
        </form>

    </div>

</body>
</html>