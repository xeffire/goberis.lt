<!DOCTYPE html>
<html>
<head lang="en">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-TTPDDPY2VX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-TTPDDPY2VX');
    </script>
    <!-- Kontroliniu mygtuku generavimas (Git nuoroda, Komentaras) -->
    <script src="/control.js"></script>
    <!--  -->
    <title>Data form</title>
    <meta charset="utf-8">
</head>
<body>
<?php
if (isset($_POST['act']) && $_POST['act'] == 'act') {
    if(!empty($_POST['email'])) {
        $fp = fopen("email.txt", "a");
        fwrite($fp, $_POST['email']."\n");
        fclose($fp);
    }
    echo "Vardas: ".$_POST['name'];
    echo "<br>E_mailas: ".$_POST['email'];
    echo "<br><u>Isrinkta elementu - ".(count($_POST) - 6)."</u>";

    for ($j = 0; $j < 4; $j++) {
        if (isset ($_POST['chk'.$j])) {
            echo "<br>Isrinkta - ".$_POST['chk'.$j];
        }
    }
    echo "<br>Vienintelis isrinkimas - ".$_POST['rad'];
    echo "<br>Komentaras - ".$_POST['comment'];
    echo "<br><br><a href=".$_SERVER['PHP_SELF'].">Dar karta</a>";
    exit;
} else {
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        Vardas: <input type="text" name="name"><br>
        Emailas: <input type="text" name="email"><br><br>
        Galima pasirinkti daug<br>
        <?php
        for ($i = 1; $i < 4; $i++) {
            echo "<INPUT TYPE='checkbox' NAME='chk$i' VALUE='pasirinkti $i'> Pasirinkimas $i<br>";
        }
        ?>
        <br>Vienintelis pasirinkimas: <br>
        <INPUT TYPE="radio" NAME="rad" VALUE="Pasirinkimas 1" CHECKED>1 Pasirinkimas <br>
        <INPUT TYPE="radio" NAME="rad" VALUE="Pasirinkimas 2">2 Pasirinkimas <br>
        <INPUT TYPE="radio" NAME="rad" VALUE="Pasirinkimas 3">3 Pasirinkimas <br>
        Komentaras:<br>
        <textarea name="comment" rows="5" cols="20">Cia komentaras</textarea>
        <br><br>
        <input type="hidden" name="act" value="act">
        <input type="submit" name="submit" value="Issiusti">
        <input type="reset" name="reset" value="Isvalyti">
    </from>
    
    <a href="read.php">Į read.php >>></a>
    </body>

</html>

<?php
}