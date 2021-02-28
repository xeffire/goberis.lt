<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=G-TTPDDPY2VX"
    ></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());
      gtag("config", "G-TTPDDPY2VX");
    </script>
    <!-- Kontroliniu mygtuku generavimas (Git nuoroda, Komentaras) -->
    <script src="/control.js"></script>
    <!--  -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Spalvos Įskaitomumas</title>
    <link rel="stylesheet" href="css.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap"
      rel="stylesheet"
    />
    <script src="js.js"></script>
  </head>
  <body>
    <div>
      <button onClick="handleDisp('kontrastas')">Kontrastas</button>
      <button onClick="handleDisp('vibracija')">Vibracija</button>
      <button onClick="handleDisp('geras')">Geras skaitomumas</button>
      <button onClick="handleDisp('blogas')">Blogas skaitomumas</button>
      <button onClick="handleDisp('geras2')">
        Geras skaitomumas, analoginės spalvos
      </button>
      <button onClick="handleDisp('blogas2')">
        Blogas skaitomumas, analoginės spalvos
      </button>
    </div>
    <div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
      <div class="box"></div>
    </div>
  </body>
</html>
