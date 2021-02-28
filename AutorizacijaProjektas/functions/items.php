<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once "connect.php";

    $sql = "SELECT * FROM items WHERE 1";
    $rez = mysqli_query($connect, $sql);
    while ($item = mysqli_fetch_row($rez)) {
        item($item);
    }

    function item($item) {
        echo
        "<div class='card m-2' style='width: 18rem;'>
        <div class='card-img-top' style='background: url(\"$item[3]\") center/contain no-repeat; height: 9rem'></div>
        <div class='card-body'>
          <h5 class='card-title'>$item[1]</h5>
          <p class='card-text'>".($item[2]/100 )." €</p>
          <a href='functions/add.php?id=$item[0]' class='btn btn-primary'>Dėti į krepšelį</a>
        </div>
      </div>";
    }
?>