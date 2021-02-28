<?php 
session_start();
if(@$_SESSION['user']){
    header('Location: profile.php');
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
    <form action="vendor/signup.php" method="POST" enctype="multipart/form-data">
    <label for="name" class="form-label">Vardas Pavardė:</label>
    <input type="text" name="name" placeholder="Įveskite savo vardą ir pavardę" class="form-control">
    <label for="login">Login:</label>
    <input type="text" name="login" placeholder="Įveskite savo Login vardą" class="form-control">
    <label for="email">El. pašto adresas:</label>
    <input type="email" name="email" placeholder="Įveskite savo el. pašto adresą" class="form-control">
    <label for="avatar">Profilio nuotrauka:</label>
    <input type="file" name="avatar" class="form-control">
    <label for="pass">Spaltažodis:</label>
    <input type="password" name="pass" placeholder="Įveskite savo slaptažodį" class="form-control">
    <label for="repeatPass">Pakartokite slaptažodį:</label>
    <input type="pass" name="repeatPass" placeholder="Pakartokite slaptažodį" class="form-control">
    
    <button class="btn btn-primary">Registruotis</button>
    <p>Jūs jau turite paskyrą? - <a href="index.php">Prisijunkite</a></p>
    
    <?php
        if(@$_SESSION['message']){
            echo "<p class='msg alert alert-info'>$_SESSION[message]</p>";
        }
        unset($_SESSION['message']);
    ?>
</form>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html> 
