<?php
include_once("conn.php");
session_start();
$itemId = $_GET['id'];
$userId = $_COOKIE['id'];

$sql = "DELETE FROM Cart WHERE userId=$userId AND itemId=$itemId";
$conn->query($sql);
if ($conn->error) $_SESSION['msg'] = "Kažkas negerai!";
header("Location: ../cart.php");
?>