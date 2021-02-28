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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rungtynės</title>
    <link rel="stylesheet" href="css.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&display=swap"
      rel="stylesheet"
    />
    <script src="js/zaidejai.js"></script>
  </head>
  <body>
    <?php include("functions/Players.php");?>
    <div class="cont teams">
      <div class="team">
        <h2>Namų komanda:</h2>
        <h3><?php team($pdo, $_GET['id'], true)?></h3>
        <table class="teamTable">
          <thead>
            <tr>
                <th></th>
              <th>Vardas</th>
              <th>Pavardė</th>
              <th>Įmesta taškų</th>
            </tr>
          </thead>
          <tbody>
            <?php tablePlayers($pdo, $_GET['id'], true)?>
          </tbody>
        </table>
      </div>
      <div class="team">
        <h2>Svečiuose:</h2>
        <h3><?php team($pdo, $_GET['id'], false)?></h3>
        <table class="teamTable">
          <thead>
            <tr>
              <th colspan="2">Vardas</th>
              <th>Pavardė</th>
              <th>Įmesta taškų</th>
            </tr>
          </thead>
          <tbody>
            <?php tablePlayers($pdo, $_GET['id'], false)?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
