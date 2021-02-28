<?php
session_start();
include_once('conn.php');
$id = $_COOKIE['id'];

$_SESSION['question'] = 1;
setcookie('avg', '0', time()-1, '/');

$sql = "DELETE FROM Vertinimas WHERE vartotojoId=$id";
$conn->query($sql);
if ($conn->error) {
    $_SESSION['msg'] = "error: $conn->error";   
}

header('Location: ../test.php');
die();
?>