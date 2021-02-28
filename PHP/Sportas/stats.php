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
    <title>Statistika</title>
    <link rel="stylesheet" href="css.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <?php include("functions/Stats.php");?>
    <div class="cont">
        <h1>Statistika:</h1>
            <?php playerInfo($pdo, $_GET['playerId']);?>
            <table class="statsTable">
                <?php tableStats($pdo, $_GET['id'], $_GET['playerId'])?>
            </table>
    </div>
</body>
</html>