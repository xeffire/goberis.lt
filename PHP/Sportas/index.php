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
    <script src="/control.js" defer></script>
    <!--  -->    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportas</title>
    <link rel="stylesheet" href="css.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="js/index.js"></script>
</head>
<body>
    <?php include("functions/Games.php");?>
    <div class="cont">
        <h1>Vykusiu rungtyniu lentele</h1>
        <table class="index">
            <thead>
                <tr><th>Data</th><th class="right">Namų komanda</th><th colspan="2">Rezultatas</th><th class="left">Svečių komanda</th></tr>
            </thead>
            <tbody><?php gameTable($pdo)?></tbody>
        </table>
    </div>
    <div class="cont">
        <p>
            Demonstracinis puslapis, parodantis vykusias rungtynes, išsamesnę informaciją ir atskiro žaidėjo statistiką. Informacija išdėliota lentelėse, navigacija į kitą puspalį vyksta paspaudus lentelės eilutę. 
        </p>
        <p>
            Visa informacija yra keičiama. Galima įvesti naujas ir ištrinti esamas rungtynes. Naujos rungtynės sugeneruojamos dalinai atsitiktinai. <a href="koreguotiRungtynes.php">Nuoroda į koregacijos puslapį.</a>
        </p>
    </div>
</body>
</html>