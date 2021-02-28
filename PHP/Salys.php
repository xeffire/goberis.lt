<!DOCTYPE html>
<html lang="lt">
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
    <title>Šalys</title>
</head>
<body>
    <?php
    $arr = array(
        "Europa" => array(
            "Lietuva", "Latvija", "Estija",
        ),
        "Azija" => array(
            "Kinija", "Japonija", "Vietnamas",
        ),
        "Afrika" => array(
            "Kenija", "Alžyras", "Libija",
        )
        );

    foreach($arr as $key => $value) {
        echo ("<h2>$key<h2><ul>");
        foreach($value as $country) {
            echo "<li><span>$country</span></li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>