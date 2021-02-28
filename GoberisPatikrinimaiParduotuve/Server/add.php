<?php
session_start();
include_once('conn.php');
$user = $_COOKIE['id'];
$id = $_GET['id'];
$sql = "INSERT INTO Cart (userId, itemId) VALUES ($user, $id)";

$res = $conn->query($sql);
$_SESSION['msg'] = "Prekė pridėta!";
header("Location: ../main.php");
?>