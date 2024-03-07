<?php

@include 'config.php' ;

session_start();

if(isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);

        if ($row['role'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');
        } elseif ($row['role'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');
        }
    } else {
        $error[] = 'Incorrect Email or Password';
    }
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <div class="form-container">

        <form action="" method="post">
            <h3>Login</h3>
            <?php
                if(isset($error)) {
                    foreach($error as $error) {
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>
            <input type="email" name="email" required placeholder="Your email">
            <input type="Password" name="password" required placeholder="Your Password">
            <input type="submit" name="submit" value="login" class="form-btn">
            <p>Dont have an account ? <a href="register_form.php">Register</a></p>
        </form>

    </div>

</body>
</html>