<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="css.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap"
      rel="stylesheet"
    />
    <script src="js.js"></script>
  </head>
  <body>
    <div>Vibrating</div>
    <div>colors</div>
    <div>makes</div>
    <div>your</div>
    <div>eyes</div>
    <div>hurt</div>
    <?php 
      include ($_SERVER['DOCUMENT_ROOT'].'/gitTag.php'); 
      git(str_replace($_SERVER['DOCUMENT_ROOT'], "", __DIR__)); 
      ?>
  </body>
</html>
