<?php
require("../../config_take_it_easy.php");
$database = "u169689266_easy";

    function getAllPlayers ($gameHash){
        $notice = '<p style="text-align: center; font-size: 0.8vw;">PLAYERS:<br><br>';
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("SELECT name, score FROM players WHERE gameHash = ? ORDER BY score DESC");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        $stmt->bind_result($name, $score);
        $stmt->execute();
        while($stmt->fetch()){
            $notice .= $name .': ' .$score .' points.<br>';
        }
        $stmt->close();
        $mysqli->close();
        $notice .= "</p>";
        return $notice;
    }

    function getPlayerCount ($gameHash) {
        $result;
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("SELECT COUNT(*) AS players FROM players WHERE gameHash = ?");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        $stmt->bind_result($count);
        $stmt->execute();
        $stmt->fetch();
        $result = $count;
        $stmt->close();
        $mysqli->close();
        return $result;
    }

    function getMaxPlayers ($gameHash) {
        $result;
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("SELECT playerCount FROM games WHERE hash = ?");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        $stmt->bind_result($count);
        $stmt->execute();
        $stmt->fetch();
        $result = $count;
        $stmt->close();
        $mysqli->close();
        return $result;
    }

    function addPlayer ($name, $gameHash) {
        $notice = "";
        if (getMaxPlayers($gameHash) > getPlayerCount($gameHash)) {
            $score = 0;
            $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
            $stmt = $mysqli->prepare("INSERT INTO players (name, gameHash, score) VALUES(?, ?, ?)");
            echo $mysqli->error;
            $stmt->bind_param("ssi", $name, $gameHash, $score);
            if ($stmt->execute()){
                $notice = 'player added';
            } else {
                $notice = "error: " .$stmt->error;
            }
            $stmt->close();
            $mysqli->close();
        }
        return $notice;
    }

    function createGame ($hash, $playerCount) {
        $notice = "";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("INSERT INTO games (hash, playerCount) VALUES(?, ?)");
        echo $mysqli->error;
        $stmt->bind_param("si", $hash, $playerCount);
        if ($stmt->execute()){
            $notice = 'game created';
        } else {
            $notice = "error: " .$stmt->error;
        }
        $stmt->close();
        $mysqli->close();
        return $notice;
    }
 ?>
