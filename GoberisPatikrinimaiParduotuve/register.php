<?php session_start();
if (isset($_COOKIE['user'])){
    header('location: index.php');
    $_SESSION['msg'] = 'Pirmiau atsijunkite!';
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registruotis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body class="container d-flex vh-100 align-items-center justify-content-center">
    <form action="Server/regist.php" method="POST" class="d-flex flex-column">
        <label class="form-label">Vardas:</label>
        <input class="form-control" type="text" name="vardas">
        <label class="form-label">Pavard4s:</label>
        <input class="form-control" type="text" name="pavarde">
        <label class="form-label">Slaptazodis:</label>
        <input class="form-control" type="password" name="slaptazodis">
        <label class="form-label">Pakartoti slaptazod5:</label>
        <input class="form-control" type="password" name="repeat">
        <input class="btn btn-primary my-3" type="submit" value="Prisijungti">
        <p class="text-muted">Jei esate prisiregistraves - <a href="login.php">Prisijunkite</a></p>
    </form>
    <!-- Message bar -->
    <p class="alert alert-warning position-absolute top-0 w-50 text-center <?php if(!isset($_SESSION['msg'])) echo 'invisible';?>"><?php
        if (isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }?></p>
</body>
</html>