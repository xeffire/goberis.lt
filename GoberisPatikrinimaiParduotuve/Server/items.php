<?php
include_once("conn.php");
$sql = "SELECT * FROM Items";

$res = $conn->query($sql);
foreach($res as $row) {
    echo "
    <div class='card' style='width:25%'>
        <div class='card-top-img text-center' style='font-size:5em;'>$row[img]</div>
        <div class='card-body'>
            <h5 class='card-title text-center'>$row[name]</h5>
            <p class='card-text text-center'>".($row['price']/100)." €</p>
            <a href='Server/add.php?id=$row[id]' class='btn btn-primary'>Įdėti į krepšelį</a>
        </div>
    </div>
    ";
}
?>