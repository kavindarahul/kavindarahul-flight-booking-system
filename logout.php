<?php 
session_start(); 
$_SESSION = array();

if(isset($_COOKIE[session_name()])){
    setcookie(session_name(), '', time(), '/');
}

session_destroy();

header('Location: login.php')
?> 