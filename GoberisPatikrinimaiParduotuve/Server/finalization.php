<?php
include_once("conn.php");
session_start();

$id = $_COOKIE['id'];
$sql = "DELETE FROM Cart WHERE userId=$id";
$conn->query($sql);
if ($conn->error) {
    $_SESSION['msg'] = "Kažkas negerai!";
    header("Location: ../cart.php");
    exit();
}
header("Location: ../finalization.php");
?>