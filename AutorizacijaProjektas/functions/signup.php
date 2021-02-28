<?php
session_start();
require_once "connect.php";
$name = $_POST['login'];
$password = $_POST['pass'];
$repeatPass = $_POST['repeatPass'];

if ($password === $repeatPass) {
    $password = md5($password);
    mysqli_query($connect, "INSERT INTO shopUsers (name, pass, cartId) VALUES ('$name', '$password', 0)" );
    $_SESSION['authMsg'] = "Registracija sekminga";
    header("Location: ../index.php");
} else {
    $_SESSION['authMsg'] = "Slaptazodziai nesutampa";
    header("Location: ../register.php");
}
?>
