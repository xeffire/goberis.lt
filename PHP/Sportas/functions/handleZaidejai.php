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

    function team($pdo, $id, $home) {
        if ($home) {
            $team = "home";
        } else {
            $team = "visitors";
        }
        $teamName = $pdo->query("SELECT $team FROM RUNGTYNES WHERE id = $id")->fetch();
        echo $teamName[$team];
    }

    function tablePlayers($pdo, $id, $home) {
        if ($home) {
            $whichTeam = "home";
        } else {
            $whichTeam = "visitors";
        }
        
        $teamNameScore = $pdo->query(
            "SELECT $whichTeam, ".$whichTeam."Score AS score
            FROM RUNGTYNES WHERE id = $id"
            )->fetch();
        $stmt = $pdo->query(
            "SELECT * 
            FROM ZAIDEJAI AS Z 
            INNER JOIN STATS AS S
            ON Z.id = S.playerId AND S.gameId = $id AND Z.team = '$teamNameScore[$whichTeam]'"
        );
        
        while ($row = $stmt->fetch()) {
            echo "<tr class='row' data-gameid='$id' data-playerid='$row[playerId]'>";
            echo 
            "<td class='center'><img src='$row[image]'></td>
            <td>$row[first]</td>
            <td>$row[last]</td>
            <td class='center'>$row[score]</td>";
            echo "</tr>";
        }

        echo "<tr><td colspan='3' class='right'>Bendri taškai:</td><td class='center'>$teamNameScore[score]</td></tr>";
    }

    function tableStats($pdo, $gameId, $playerId) {
        $stmt = $pdo->query(
            "SELECT * 
            FROM STATS
            WHERE gameId = '$gameId' AND playerId = '$playerId'"
        );
        $data = $stmt->fetch();
        // $data['throws'] = explode(" ", $data['throws']);
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