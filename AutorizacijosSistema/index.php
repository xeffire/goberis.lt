<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <form action="" method="POST">
        <label class="form-label">Vardas:</label>
        <input class="form-control" type="text" name="first" value="<?= @$_SESSION['first']?>">
        <label class="form-label">Slaptazodis:</label>
        <input class="form-control" type="text" name="password" value="<?= @$_SESSION['password']?>">
        <button class="btn btn-primary my-5">Siusti</button>
    </form>

<?php

if(!empty($_POST['name']) && !empty($_POST['password'])) {
    require_once("config.php");

    // if(!get_magic_quotes_gpc()) {
    //     $_POST['name'] = mysql_escape_string($_POST['name']);
    //     $_POST['password'] = mysql_escape_string($_POST['password']);
    // }

    $query = "SELECT COUNT(*) FROM userlist WHERE name='$_POST[name]' AND pass='$_POST[password]'";
    $usr = mysql_query($query);
    if(!$usr) {
        exit("Klaida autorizacijoje");
    }

    $total = count(mysqli_fetch_all($usr));

    if(@$total > 0) {
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['password'] = $_POST['password'];
    }

    if(!isset($_SESSION['name'])) {
        require_once("config.php");

        echo 
        "<p>Labas, $_SEESION[name]!
        Prieiga prie Jusu slaptu duomenu</p>";

        $query = "SELECT * FROM userlist WHERE name='$_SESSION[name]'";
        $usr = mysql_query($query);
        if(!$usr) {
            exit(mysql_error());
        }
        $user = mysql_fetch_array($usr);
        echo "<p>Jusu el. pastas: $user[email]
        Jusu URL: $user[url]</p>";
    }

}

?>
</body>
</html>