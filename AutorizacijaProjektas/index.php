<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Open Sans', sans-serif;">
    <div class="container d-flex flex-column min-vh-100 text-dark">
        <header class="d-flex align-items-center justify-content-between bg-dark text-light">
        <h2><i class="bi bi-cup-straw"></i> Elektroninė vaisių parduotuvė</h2>
        <div><?php include_once("functions/auth.php"); login();?></div>
        </header>
        <p class='bg-dark text-light text-right'><?= @$_SESSION['authMsg']; unset($_SESSION['authMsg'])?></p>
        <main class="bg-light d-flex flex-wrap justify-content-center">
            <?php include_once('functions/items.php');?>
        </main>
        <footer class="bg-dark text-light text-center">Projekto autorius: Justinas Goberis | Pasitelkta <i class="bi bi-bootstrap"></i> Bootstrap</footer>
    </div>
</body>
</html>