<?php
require("../../config_take_it_easy.php");
$database = "u169689266_easy";

    function addPiecesToDatabase ($gameHash) {
        $pieces = array("123", "124", "128", "163", "164", "168", "173", "174", "178", "523", "524", "528", "563", "564", "568", "573", "574", "578", "923", "924", "928", "963", "964", "968", "973", "974", "978");
        shuffle($pieces);
        foreach ($pieces as $piece) {
            addPiece($piece, $gameHash);
        }
    }

    // database functions
    function getFirstPiece ($gameHash) {
        $notice = '';
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("SELECT name FROM pieces WHERE gameHash = ?");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        $stmt->bind_result($name);
        $stmt->execute();
        $stmt->fetch();
        $notice = $name;
        $stmt->close();
        $mysqli->close();
        return $notice;
    }

    function deletePiece ($gameHash) {

    }

    function addPiece ($piece, $gameHash) {
        $notice = "";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("INSERT INTO pieces (name, gameHash) VALUES(?, ?)");
        echo $mysqli->error;
        $stmt->bind_param("ss", $piece, $gameHash);
        if ($stmt->execute()){
            $notice = 'piece added';
        } else {
            $notice = "error: " .$stmt->error;
        }
        $stmt->close();
        $mysqli->close();
        return $notice;
    }

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
            $notice .= $name .': <span style="color: red; font-family: arial; font-size: 26px;">' .$score .'</span> points.<br>';
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
        $maxPlayers = getMaxPlayers($gameHash);
        $playerCount = getPlayerCount($gameHash);
        if ($maxPlayers > $playerCount) {
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
        if ($maxPlayers-1 == $playerCount) {
            addPiecesToDatabase($gameHash);
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
