<?php
require("../../config_take_it_easy.php");
$database = "u169689266_easy";

    function getAllMessages ($gameHash){
        $notice = '<p>';
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("SELECT senderName, message FROM messages WHERE gameHash = ?");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        $stmt->bind_result($name, $message);
        $stmt->execute();
        while($stmt->fetch()){
            $notice .= '<span style="color: red; font-weight: bold;">' .$name .': </span>' .$message .'<br>';
        }
        $stmt->close();
        $mysqli->close();
        $notice .= '</p>';
        return $notice;
    }

    function addMessage ($playerHash, $gameHash, $message, $playerName) {
        $notice = "";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("INSERT INTO messages (playerHash, gameHash, message, senderName) VALUES(?, ?, ?, ?)");
        echo $mysqli->error;
        $stmt->bind_param("ssss", $playerHash, $gameHash, $message, $playerName);
        if ($stmt->execute()){
            $notice = 'message added';
        } else {
            $notice = "error: " .$stmt->error;
        }
        $stmt->close();
        $mysqli->close();
        return $notice;
    }

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

    function addPlayer ($name, $gameHash, $playerHash) {
        $notice = "";
        if (getMaxPlayers($gameHash) > getPlayerCount($gameHash)) {
            $score = 0;
            $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
            $stmt = $mysqli->prepare("INSERT INTO players (name, playerHash, gameHash, score) VALUES(?, ?, ?, ?)");
            echo $mysqli->error;
            $stmt->bind_param("sssi", $name, $playerHash, $gameHash, $score);
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
