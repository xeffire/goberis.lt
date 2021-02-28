<?php
    $host = 'localhost';
    $db   = 'goislt_goislt';
    $user = 'goislt';
    $pass = 'bhfjuHWfzG';
    $charset = 'utf8';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
         $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    function gameTable($pdo) {
        $stmt = $pdo->query("SELECT * FROM RUNGTYNES");
        while ($row = $stmt->fetch()) {
            echo "<tr class='row' data-gameid='$row[id]'>";
            echo 
            "<td class='center'>$row[date]</td>
            <td class='right'>$row[home]</td>
            <td class='right'>$row[homeScore] -</td>
            <td>$row[visitorsScore]</td>
            <td>$row[visitors]</td>";
            echo "</tr>";
        }
        
    }
?>