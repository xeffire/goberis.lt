<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $filename = array("all.php", "auth.php",
    "auth.txt", "base.txt",
    "chat.txt", "config.php",
    "count.txt", "count_new.txt",
    "counter.dat", "create.txt", "dat.db");
    // praeiname masyva ir nustatome kiek simboliu
    // yra paciame ilgiausiame failo vard
    $max_lenght = 0;
    foreach($filename as $name){
        $lenght = strlen($name);
        if($lenght > $max_lenght){
            $max_lenght = $lenght;
        }
    }
    // isvedame failu vardus, islygintus is desines
    echo "<pre>";
    foreach ($filename as $name){
        printf("%{$max_lenght}s\n",$name);
    }
    echo "</pre>";
?>
</body>
</html>