<?php
    function getUserIP() {    
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
          $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
      }
          
      if(isset($_POST)){
        $ip = getUserIP();
        $sql = "insert into feedback (comment, vote, ip) values ('$_POST[comment]', $_POST[vote], '$ip')";
        $conn = new PDO("mysql:host=localhost;dbname=goislt_goislt", "goislt", "bhfjuHWfzG");
        try {
            if($conn->query($sql) === FALSE) {
                exit ("Kažkas ne to. Po perkrovimo, bandykite dar kartą.");
            } else {
                exit("Ačiū :)");
            }
        } catch (\Throwable $th) {
            exit ("Fatal error");
        }
        $conn = null;
        exit();
    }
?>