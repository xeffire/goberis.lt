<!DOCTYPE html>
<html lang="lt">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css.css">
        <title>POSITION</title>
    </head>
    <body>
        <h1>Position: static, absolute, relative, fixed and sticky</h1>
        <div class="cont">
            <div class="pirmas"></div>
            <div class="antras"></div>
            <div class="trecias"></div>
            <div class="ketvirtas"></div>
        </div>
        <div class="cont">
            <div></div>
        </div>
        <?php 
      include ($_SERVER['DOCUMENT_ROOT'].'/gitTag.php'); 
      git(str_replace($_SERVER['DOCUMENT_ROOT'], "", __DIR__)); 
      ?>
    </body>
</html>