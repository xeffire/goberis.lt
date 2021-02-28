<?php
session_start();
include_once('conn.php');

$vardas = $_POST['vardas'];
$slaptazodis = $_POST['slaptazodis'];

if ($vardas == '' || $slaptazodis == '') {
    $_SESSION['msg'] = "Visi laukai turi būti užpildyti!";
    header("Location: ../login.php");
    exit();
}

$slaptazodis = hash('sha512', $slaptazodis);

$sql = "SELECT * FROM Vartotojai WHERE vardas='$vardas' AND slaptazodis='$slaptazodis'";
$res = $conn->query($sql)->fetch_assoc();
foreach ($res as $key => $value) {
    if ($key != 'slaptazodis')
    setcookie("$key", "$value", time()+60*60*4, "/");
}

$sql = "SELECT vertinimas FROM Vertinimas WHERE userId=$_COOKIE[id]";
$res = $conn->query($sql);
if(isset($res[0])) setcookie($res[0]);
header("Location: ../main.php");
?>