<!DOCTYPE html>
<html lang="en">
<head>
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRIEF MESSAGE</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="get">
        <fieldset>
            <legend>Message:</legend>
            <!-- <label for="mes">Message:</label> -->
            <textarea name="mes" id="mes" cols="60" rows="10"></textarea>
            <input type="reset" value="Clear">
            <input type="submit" value="Send">
            <input type="hidden" name="yes" value="1">
            <button onClick="window.open('ReadMail.php','_blank')">To inbox ></button>
        </fieldset>
    </form>
    <?php
        if(!empty($_GET['yes'])) {
            if(!empty($_GET['mes'])){
                $mes = $_GET['mes'];
            } else {
                exit("Input message!");
            }
            if(!file_exists("n.txt")){
                $fp = fopen("n.txt", "w");
                fputs($fp, 1);
                fclose($fp);
                $n[0] = 1;
            } else {
                $fp = fopen("n.txt", "r");
                $n = file("n.txt");
                $n[0]++;
                fputs($fp, $n[0]);
                fclose($fp);
            }
            $dat = date("d m y H:i");
            $fp = fopen("m.txt", "a");
            fwrite($fp, $n[0].". [".$dat."] ".$mes."\n");
            fclose($fp);
            exit("Your message is accepted.");
        }
    ?>
          
</body>
</html>