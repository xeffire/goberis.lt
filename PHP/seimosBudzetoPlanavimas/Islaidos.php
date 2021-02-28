<?php
    $json = file_get_contents("islaidos.json");
    $islaidos = json_decode($json, true);
    $suma = 0;
?>
<html lang="lt">
<head>
    <meta charset="utf-8"> 
    <title><?php echo $_GET['name'];?></title>
    <link rel="stylesheet" href="./css/css.css">
</head>
<body>
    <h1><?php echo $_GET['name'];?> išlaidos</h1>
    <table>
        <tr>
            <th>Data</th>
            <th>Pirkinys</th>
            <th>Vienetai</th>
            <th>Vieneto kaina</th>
            <th>Bendra suma</th>
        </tr>
            <?php
            for ($i = 0; $i < count($islaidos); $i++){
                if($islaidos[$i][0] == $_GET['name']) {
                    echo "<tr><td>".$islaidos[$i][1]."</td>";
                    echo "<td>".$islaidos[$i][2]."</td>";
                    echo "<td>".$islaidos[$i][3]." vnt.</td>";
                    echo "<td>".$islaidos[$i][4]." $</td>";
                    echo "<td>".$islaidos[$i][3]*$islaidos[$i][4]." $</td></tr>";
                    $suma += $islaidos[$i][3]*$islaidos[$i][4];
                }
            }
            ?>
        <tr>
            <th colspan="4">Bendros islaidos</th>
            <td><?php echo $suma?> $</td>
        </tr>
    </table>
</body>
<?php

?>

</html>