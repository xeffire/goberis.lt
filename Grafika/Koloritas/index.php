<!DOCTYPE html>
<html>
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
        <title>Koloritas</title>
        <link rel="stylesheet" href="css.css">
        <script src="./js.js"></script>
    </head>
    <body>
        <h1>Grass</h1>
        <div class="cont">
            <img src="./img/Grass.jpg" alt="Grass">
            <div class="pallet">
                <div style="background: rgb(188,212,3);"></div>
                <div style="background: #183B02;"></div>
                <div style="background: #E4DE60;"></div>
                <div style="background: #1D1607;"></div>
            </div>
        </div>
        <span class="left" onclick="change(-1)"><</span>
        <span class="right" onclick="change(1)">></span>
    </body>
</html>