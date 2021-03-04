<?php session_start();
if (!isset($_COOKIE['vardas'])){
    $_SESSION['msg'] = "Turite pirmiau prisijungti!";
    header('Location: index.php');
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krepšelis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body class="container d-flex flex-column mt-5 align-items-center justify-content-center border p-0">
    <header class="d-flex justify-content-between w-100 border-bottom bg-light">
        <h1 class="ms-3">Brangu.lt</h1>
        <div class="d-flex align-items-center">
            <span>Sveiki, <?php echo $_COOKIE['vardas'];?></span>
            <a href="" class="btn btn-sm btn-danger ms-3">🛒 Krepšelis</a>
            <a href="Server/logout.php" class="btn btn-sm btn-secondary mx-1">Atsijungti</a></div>
    </header>
    <main class="w-75">
    <table class="table table-striped my-5">
        <tr>
            <th class="col">#</th>
            <th class="col"></th>
            <th class="col">Pavadinimas</th>
            <th class="col">Kaina</th>
            <td class="col" style="width: 2em"></td>
        </tr>
            <?php include_once('Server/cart.php');?>
        </table>
        <a class="btn btn-primary my-5" href="Server/finalization.php">Patvirtinti pirkinius</a>
        <a class="btn btn-secondary my-5" href="main.php">< Grįžti atgal</a>
    </main>
    <!-- Message bar -->
    <p class="alert alert-warning position-absolute top-0 w-50 text-center <?php if(!isset($_SESSION['msg'])) echo 'invisible';?>"><?php
        if (isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }?></p>
</body>
</html>