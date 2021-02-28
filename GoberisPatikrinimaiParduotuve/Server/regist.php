<?php session_start();

include_once('conn.php');

if(!isset($_POST)) header('location: index.php');
$vardas = $_POST['vardas'];
$pavarde = $_POST['pavarde'];
$slaptazodis = $_POST['slaptazodis'];
$repeat = $_POST['repeat'];
var_dump($vardas);
if($vardas == '' || $pavarde == '' || $slaptazodis == '' || $repeat == '') {
    $_SESSION['msg'] = 'Visi laukai turi būti užpildyti!';
    header("Location: ../register.php");
    exit();
}
if($slaptazodis != $repeat) {
    $_SESSION['msg'] = 'Slaptažodžiai nesutampa!';
    header("Location: ../register.php");
    exit();
}

$slaptazodis = hash('sha512', $slaptazodis);

$sql = "SELECT vardas FROM Vartotojai WHERE vardas='$vardas' AND pavarde='$pavarde'";
if ($conn->query($sql)->num_rows > 0) {
    $_SESSION['msg'] = 'Vartotojo vardas jau egzistuoja!';
    header("Location: ../register.php");
    exit();
}
$sql = "INSERT INTO Vartotojai (vardas, pavarde, slaptazodis) VALUES ('$vardas', '$pavarde', '$slaptazodis')";
$res = $conn->query($sql);
if ($res) {
    $_SESSION['msg'] = "Registacija sėkminga!";
    header("Location: ../login.php");
    exit();
}
$_SESSION['msg'] = "Registracija nepavyko! ";
header('Location: ../register.php');

?>