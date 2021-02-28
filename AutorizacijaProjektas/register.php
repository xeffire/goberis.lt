<?php 
session_start();
if(@$_SESSION['user']){
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <form action="functions/signup.php" method="POST" class="container w-50 d-flex flex-column my-5">
    <label for="login">Login:</label>
    <input type="text" name="login" placeholder="Įveskite savo Login vardą" class="form-control">
    <label for="pass">Spaltažodis:</label>
    <input type="password" name="pass" placeholder="Įveskite savo slaptažodį" class="form-control">
    <label for="repeatPass">Pakartokite slaptažodį:</label>
    <input type="password" name="repeatPass" placeholder="Pakartokite slaptažodį" class="form-control">
    
    <button class="btn btn-primary">Registruotis</button>
    <p><a href="index.php">Grįžti į pagrindinį</a></p>
    
    <?php
        if(@$_SESSION['authMsg']){
            echo "<p class='msg alert alert-info'>$_SESSION[authMsg]</p>";
        }
        unset($_SESSION['authMsg']);
    ?>
</form>