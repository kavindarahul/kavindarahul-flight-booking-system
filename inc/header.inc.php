<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyBooker<?php if(isset($page_name)){echo "-$page_name";}?></title>
    <link rel="icon" type="image/x-icon" href="img/icons8-flight-100.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-2">

    <div class="header bg">
        <nav>
            <div class="nav_logo"><a href="index.php">SkyBooker.</a></div>
            <ul class="nav_links">
                <li class="link"><a href="index.php">Home</a></li>
                <li class="link"><a href="about.php">About</a></li>
                <li class="link"><a href="contact.php">Contact</a></li>
            </ul>
            <?php
                if(!isset($_SESSION['user_id'])){
                    ?> <a class="btn-login" href="login.php">Login</a> <?php
                }else{
                    ?><div style="color:#fff"><a class="btn-login" href="profile.php">Profile</a>|<a class="btn-login" href="logout.php">Logout</a></div><?php
                }
            ?>
            
        </nav>
    </div>