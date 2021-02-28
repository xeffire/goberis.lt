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
?>