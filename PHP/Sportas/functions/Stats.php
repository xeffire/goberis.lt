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

    function tableStats($pdo, $gameId, $playerId) {
        $stmt = $pdo->query(
            "SELECT * 
            FROM STATS
            WHERE gameId = '$gameId' AND playerId = '$playerId'"
        );
        $data = $stmt->fetch();
        $stats = array(
            'Pataikymai' => preg_match_all("/(?<!-)\d/", $data['throws']),
            'Metimai' => preg_match_all("/2|3/", $data['throws']),
            'Pataikymo %' => 0,
            'Pataikymai 2tš.' => preg_match_all("/(?<!-)2/", $data['throws']),
            'Metimai 2tš.' => preg_match_all("/2/", $data['throws']),
            'Pataikymo 2tš. %' => 0,
            'Pataikymai 3tš.' => preg_match_all("/(?<!-)3/", $data['throws']),
            'Metimai 3tš.' => preg_match_all("/3/", $data['throws']),
            'Pataikymo 3tš. %' => 0,
            'Efektyvus pataikymo %' => 0,
            'Taškai' => $data['score']
        );
        $stats['Pataikymo %'] = number_format($stats['Pataikymai'] / $stats['Metimai'], 2);
        $stats['Pataikymo 2tš. %'] = number_format($stats['Pataikymai 2tš.'] / $stats['Metimai 2tš.'], 2);
        $stats['Pataikymo 3tš. %'] = number_format($stats['Pataikymai 3tš.'] / $stats['Metimai 3tš.'], 2);
        $stats['Efektyvus pataikymo %'] = number_format(($stats['Pataikymai'] + (0.5 *$stats['Pataikymai 3tš.'])) / $stats['Metimai'], 2);

        foreach ($stats as $key => $value) {
            echo "<tr><td>$key</td><td class='center'>$value</td></tr>";
        }
        echo "<p class='center'>Pažymėti metimai: ".preg_replace("/-2|-3/", "0", $data['throws'])."</p>";
    }

    function playerInfo ($pdo, $playerId) {
        $stmt = $pdo->query(
            "SELECT * 
            FROM ZAIDEJAI
            WHERE Id = '$playerId'"
        );
        $player = $stmt->fetch();
        echo "<div class='player'><img src='$player[image]'><br>";
        echo "<span>$player[first]</span><br>";
        echo "<span>$player[last]</span></div>";
    }
?>