<?php
session_start();
if (!isset($_COOKIE['vardas'])) {
    header('Location: index.php');
    exit();
}
if (isset($_COOKIE['avg'])) {
    header('Location: result.php');
    exit();
}
if (!isset($_SESSION['question'])) $_SESSION['question'] = '1';
if ($_SESSION['question']==6) $_SESSION['question'] = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body class="container d-flex vh-100 align-items-center justify-content-center">
    <div class="d-flex flex-column">
    <p class="fs-3"><?php
        switch ($_SESSION['question']) {
            case '1': echo "1. Ar lengva buvo registracija į mūsų puslapį?";
            break;
            case '2': echo "2. Ar patinka bendras puslapio stilius?";
            break;
            case '3': echo "3. Ar patinka mūsų pirkinių selekcija?";
            break;
            case '4': echo "4. Ar rekomenduotumėte mus savo draugams?";
            break;
            case '5': echo "5. Ar iki dabar mėgaujatės mūsų teikiamomis paslaugomis?";
            break;
            default;
        }
    ?></p>
    <form class="d-flex flex-column" action="Server/test.php" method="POST">
        <input type="hidden" name="question" value="<?php echo $_SESSION['question']?>">
        <div class="d-flex">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name='question<?php echo $_SESSION['question']?>' value='1'>
                <label class="form-check-label" for="1">Visiškai nepritariu</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name='question<?php echo $_SESSION['question']?>' value="2">
                <label class="form-check-label" >Nepritariu</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name='question<?php echo $_SESSION['question']?>' value="3"> 
                <label class="form-check-label">Neutraliai</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name='question<?php echo $_SESSION['question']?>' value="4">
                <label class="form-check-label">Pritariu</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name='question<?php echo $_SESSION['question']?>' value="5">
                <label class="form-check-label">Visiškai pritariu</label>
            </div>
        </div>
        <input class="btn btn-primary btn-sm align-self-start mt-3" type="submit" value="<?php echo $_SESSION['question']==5 ? 'Baigti' : 'Kitas'; ?>">
    </form>
        <!-- Message bar -->
        <p class="alert alert-warning position-absolute top-0 w-50 text-center <?php if(!isset($_SESSION['msg'])) echo 'invisible';?>"><?php
        if (isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }?></p>
</body>
</html>