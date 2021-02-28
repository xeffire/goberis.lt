<?php 
session_start();
if (!isset($_SESSION['avg'])) header('Location: main.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezultatas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>
<body class="d-flex flex-column vh-100 align-items-center justify-content-center">
    <p class="fs-3">Pagal jūsų atliktą testą, jūs mus vertinate <?php echo $_COOKIE['avg']/100?> iš 5 balų!</p>
    <div class="text-center  position-relative" style="font-size: 40px; width: 275px; ">⭐⭐⭐⭐⭐<div class="bg-white position-absolute top-0 end-0 h-100" style="width: calc(100% * <?php echo (5 -($_COOKIE['avg']/100));?> / 5)"></div></div>
    <p class="fs-3">Ačiū už jūsų laiką!</p>
    <a class="btn btn-primary" href="main.php">< Grįžti į pagrindinį</a>
    <a class="btn btn-secondary" href="Server/resetTest.php">Spręsti klausimyną iš naujo</a>
        <!-- Message bar -->
        <p class="alert alert-warning position-absolute top-0 w-50 text-center <?php if(!isset($_SESSION['msg'])) echo 'invisible';?>"><?php
        if (isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }?></p>
</body>
</html>