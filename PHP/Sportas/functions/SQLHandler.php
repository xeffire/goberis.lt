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

    $team = file(".env");
    $team[0] = str_replace("team=", "", $team[0]);

    function getRungtynes($pdo) {
        $stmt = $pdo->query('SELECT * FROM RUNGTYNES');
        while ($row = $stmt->fetch())
        {
            echo $row['home'] . "\n";
        }
    }

    function getRungtynesTable($pdo) {
        $stmt = $pdo->query('SELECT * FROM RUNGTYNES');
        while($row = $stmt->fetch()) {
            echo "<tr>";
                echo 
                "<td>$row[date]</td>
                <td>$row[home]</td>
                <td>$row[visitors]</td>
                <td>$row[homeScore]-$row[visitorsScore]</td>
                <td><a href='koreguotiRungtynes.php?action=delete&id=$row[id]'><i class='fa fa-trash'></i></a></td>";
                echo "</tr>";
            }
    }
    function deleteRungtynes($pdo, $id) {
        $stmt = "DELETE FROM RUNGTYNES WHERE id = $id";
        $pdo->prepare($stmt)->execute();
    }
    
    function postRungtynes($pdo){
        
            $stmt = "INSERT INTO RUNGTYNES (date, home, visitors, homeScore, visitorsScore) VALUES ('$_GET[date]', '$_GET[home]', '$_GET[visitors]', $_GET[homeScore], $_GET[visitorsScore])";
            $pdo->prepare($stmt)->execute();
            $gameId = $pdo->lastInsertId();
            $game = $pdo->query("SELECT * FROM RUNGTYNES WHERE id = '$gameId'")->fetch();
            createStats($pdo, $game);
            truncateParams();
    }

    function getTeamsTable($pdo) {
        $stmt = $pdo->query("SELECT * FROM KOMANDOS");
        while($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td><a href='koreguotiRungtynes.php?action=changeTeam&team=".str_replace(' ', '+', $row['team'])."'>$row[team]</a></td>";
            echo "<td><a href='koreguotiRungtynes.php?action=deleteTeam&id=$row[id]&team=$row[team]'><i class='fa fa-trash'></i></a></td>";
            echo "</tr>";
        }
    }

    function getTeamsOptions($pdo) {
        $stmt=$pdo->query("SELECT team FROM KOMANDOS");
        $rows = $stmt->fetchAll();
        $selected = rand(0, count($rows)-1);
        for($i = 0; $i < count($rows);$i++) {
            echo "<option";
            if ($i == $selected){echo " selected";}; 
            echo ">";
            echo $rows[$i]['team'] . "</option>";
        }
    }

    function getTeamScore() {
        $score = (rand(10, 30)) * 5;
        echo $score;
    }

    function deleteTeam($pdo, $id, $team) {
        $res = $pdo->query("Select image FROM ZAIDEJAI WHERE id = $id");
        while($row = $res->fetch()) {
            unlink($row['image']);
        }

        $pdo->query("DELETE FROM KOMANDOS WHERE id = $id"); 
        $pdo->query("DELETE FROM ZAIDEJAI WHERE team = '$team'");
    }

    function postTeam($pdo) {
        $stmt = "INSERT INTO KOMANDOS (team) VALUES ('$_GET[newTeam]')";
        $pdo->prepare($stmt)->execute();
        postPlayers($pdo, $_GET['newTeam']);
    }
    
    function getNewTeamOptions() {
        $teams = file("Teams.txt");
        $teamIndex = rand(0, count($teams) - 1);
        echo $teams[$teamIndex];
    }

    function changeTeam() {
        $fp = fopen(".env", "w");
        fwrite($fp, "team=".$_GET['team']);
        truncateParams();
    }
    
    function postPlayers($pdo, $team) {
        $json = (object) array('error' => "1");
        while(isset($json->error)){
            $response = file_get_contents("https://randomuser.me/api/?results=5&gender=male&inc=name,picture");
            $json = json_decode($response);
            sleep(1);
        }
        function filterPlayers($json) {
            $res = array();
            for ($i = 0; $i < 5; $i++) {
                $temp = array(
                    'first' => $json->results[$i]->name->first,
                    'last' => $json->results[$i]->name->last,
                    'image' => $json->results[$i]->picture->large 
                );
                $res[] = $temp;
            }
            // nukopijuoti is nuotolinio i localhost nuotraukas
            for($i = 0; $i<5; $i++) {
                $location = "images/".uniqid("IMG").".jpg";
                copy($res[$i]['image'], $location);
                $res[$i]['image'] = $location;
            }
            return $res;
        }
        function buildStmt($players, $team) {
            $tmp = array();
            for($i = 0; $i < 5; $i++) {
                $tmp[] = "('".$players[$i]['first']."', '".$players[$i]['last']."', '".$team."', '".$players[$i]['image']."')";
            }
            return "INSERT INTO ZAIDEJAI (first, last, team, image) VALUES $tmp[0], $tmp[1], $tmp[2], $tmp[3], $tmp[4]";
        }
        $players = filterPlayers($json);
        $stmt = buildStmt($players, $team);
        $pdo->prepare($stmt)->execute();
        truncateParams();
    }

    function getPlayersTable($pdo, $team) {
        $stmt = $pdo->query("SELECT * FROM ZAIDEJAI WHERE team = '$team'");
        while($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>$row[first]</td><td>$row[last]</td><td><img src='$row[image]'></td>";
            echo "</tr>";
        }
    }

    function createStats($pdo, $game) {
        $stats = array();
        $players = $pdo->query("SELECT id FROM ZAIDEJAI WHERE team = '$game[home]' OR team = '$game[visitors]'");
        while ($row = $players->fetch()) {
            $stats[] = array('playerId'=>$row['id'], 'throws'=>"", 'score'=>0);
        }

        $pointSum = $game['homeScore'] + $game['visitorsScore'];
        while ($pointSum > 5) {
            if (rand(1, 7) < 5) {
                if (rand(0,1) > 0) {
                    $stats[rand(0,count($stats)-1)]['throws'] .= "2 ";
                    $pointSum -= 2;
                } else {
                    $stats[rand(0,count($stats)-1)]['throws'] .= "-2 ";
                }
            } else {
                if (rand(1,3) > 2){
                    $stats[rand(0,count($stats)-1)]['throws'] .= "3 ";
                    $pointSum -= 3;
                } else {
                    $stats[rand(0,count($stats)-1)]['throws'] .= "-3 ";
                }
            }
        }
        $remainder = (function () use ($pointSum) {
            switch ($pointSum) {
                case 5:
                    return "3 2";
                case 4:
                    return "2 2";
                case 3:
                    return "3";
                case 2:
                    return "2";
                default:
                    break;
            }
        });
        $stats[rand(0,count($stats)-1)]['throws'] .= $remainder();

        for ($i = 0; $i < count($stats); $i++) {
            $stats[$i]['score'] = array_sum(explode(" ", preg_replace("/-2|-3/","0",$stats[$i]['throws'])));
        }

        $tmp = "";
        for ($i = 0; $i < count($stats); $i++) {
            $tmp .= "(".$game['id'].", ".$stats[$i]['playerId'].", '".$stats[$i]['throws']."', ".$stats[$i]['score'].")";
            if ($i < count($stats)-1) {$tmp .= ", ";}
        }
        $stmt = "INSERT INTO STATS (gameId, playerId, throws, score) VALUES $tmp";
        $pdo->prepare($stmt)->execute();
    }

    function truncateParams() {
        echo "<>window.location = window.location.pathname;</>";
    }

    if (isset($_GET['action'])){
        if ($_GET['action'] == 'delete'){
            deleteRungtynes($pdo, $_GET['id']);   
        }
        if ($_GET['action'] == 'deleteTeam') {
            deleteTeam($pdo, $_GET['id'], $_GET['team']);
        }
        if($_GET['action'] == 'post'){
            postRungtynes($pdo);
        }
        if($_GET['action'] == 'postTeam') {
            postTeam($pdo);
        }
        if($_GET['action'] == 'changeTeam') {
            changeTeam();
        }
    }
?>