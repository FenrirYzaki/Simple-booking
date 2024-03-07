<?php
session_start();

if(!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Paget</title>

    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <div class="container">

        <div class= "content">
            <a href="order_form.php">Order Ticket</a>
        </div>

    </div>
    
</body>
</html>