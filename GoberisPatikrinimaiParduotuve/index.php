<?php session_start();

if (isset($_COOKIE['vardas'])) {
    header("location: main.php");
} 
header("location: login.php");
?>