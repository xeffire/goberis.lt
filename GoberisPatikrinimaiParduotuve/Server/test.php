<?php
session_start();
include_once('conn.php');

// Tikrina ar dar ne visi klausimai atsakyti, iraso buvusi atsakyma i session.
if ($_SESSION['question'] <= 5) {
    $questionNR = "question$_SESSION[question]";
    $_SESSION[$questionNR] = $_POST[$questionNR];
    $_SESSION['question'] += 1;
} 

// Jei visi klausimai atsakyti - vidurkina ir iraso i duombaze, keliauja i result.php
if ($_SESSION['question'] > 5) {
    $sum = 0;
    for($i=1; $i<6; $i++){
        $qst = "question$i";
        $sum += $_SESSION[$qst];
        unset($_SESSION[$qst]);
    }
    $avg = round(($sum / 5) * 100);
    
    $sql = "INSERT INTO Vertinimas (vartotojoId, vertinimas) VALUES ('$_COOKIE[id]', $avg)";
    $conn->query($sql);
    if ($conn->error) {
        $_SESSION['msg'] = "Atsakymo pateikti nepavyko: $conn->error";   
    }
    
    setcookie('avg', "$avg", time()+60*60*4, '/');
    header('Location: ../result.php');
    exit();
}

// Jei dar ne visi klausimai atsakyti - keliauja i test.php
header("Location: ../test.php");
die();

?>