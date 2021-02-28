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
    <title>Autorizacija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <form action="vendor/signin.php" method="POST">
        <label for="login" class="form-label">Login:</label>
        <input type="text" name="login" placeholder="Įveskite savo login" class="form-control">
        <label for="pass"  class="form-label">Slaptažodis:</label>
        <input type="text" name="pass" placeholder="Įveskite savo slaptažodį" class="form-control">
        <button class="btn btn-primary">Pateikti</button>
        <p>Jus neturite paskyros? - <a href="register.php">Registruokitės</a></p>
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