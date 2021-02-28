<?php
include_once('conn.php');
$vardas = $_COOKIE['vardas'];
$sql = "SELECT Items.id, name, price, img FROM Items
INNER JOIN Cart
ON Cart.itemId=Items.id";

$res = $conn->query($sql)->fetch_all();
$sum = 0;
for ($i = 0; $i<=count($res); $i++) {
    if ($i < count($res)) {
        $sum+=$res[$i][2];
        echo "
        <tr>
            <td class='row text-center m-0'>".($i+1)."</td>
            <td class='text-end'>".$res[$i][3]."</td>
            <td>".$res[$i][1]."</td>
            <td>".($res[$i][2]/100)." €</td>
            <td><a class='text-decoration-none' href='Server/delete.php?id=".$res[$i][0]."'>❌</a></td>
        </tr>
        ";
    } else {
        echo "
        <tr class='table-primary'>
            <td colspan=3 class='text-end'>Viso:</td>
            <td colspan=2>".($sum/100)." €</td>
        </tr>
        ";
    }
}

?>