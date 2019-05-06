<?php
require("../../config_take_it_easy.php");
$database = "u169689266_easy";

    function addPiecesToDatabase ($gameHash) {
        if (getPieceCount($gameHash) < 10) {
            $pieces = array("123", "124", "128", "163", "164", "168", "173", "174", "178", "523", "524", "528", "563", "564", "568", "573", "574", "578", "923", "924", "928", "963", "964", "968", "973", "974", "978");
            shuffle($pieces);
            foreach ($pieces as $piece) {
                addPiece($piece, $gameHash);
            }
        }
    }

    // database functions
    function getGames () {
        $notice = '';
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("SELECT dateCreated, hash FROM games");
        echo $mysqli->error;
        $stmt->bind_result($date, $gameHash);
        if($stmt->execute()){
            while($stmt->fetch()){
                $dif = time() - strtotime($date);
                echo $dif;
                if ($dif > 3600) {
                    deleteGame($gameHash);
                    deleteMessages($gameHash);
                    deletePieces($gameHash);
                    deletePlayers($gameHash);
                    deleteTurns($gameHash);
                    addPiecesToDatabase($gameHash);
                }
            }
    	}
        $stmt->close();
        $mysqli->close();
        return $notice;
    }

    function deleteGame ($gameHash) {
        $notice = "";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("DELETE FROM games WHERE hash=?;");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        if ($stmt->execute()){
            $notice = 'game deleted';
        } else {
            $notice = "error: " .$stmt->error;
        }
        $stmt->close();
        $mysqli->close();
        return $notice;
    }

    function deleteMessages ($gameHash) {
        $notice = "";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("DELETE FROM messages WHERE gameHash=?;");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        if ($stmt->execute()){
            $notice = 'messages deleted';
        } else {
            $notice = "error: " .$stmt->error;
        }
        $stmt->close();
        $mysqli->close();
        return $notice;
    }

    function deletePieces ($gameHash) {
        $notice = "";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("DELETE FROM pieces WHERE gameHash=?;");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        if ($stmt->execute()){
            $notice = 'pieces deleted';
        } else {
            $notice = "error: " .$stmt->error;
        }
        $stmt->close();
        $mysqli->close();
        return $notice;
    }

    function deletePlayers ($gameHash) {
        $notice = "";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("DELETE FROM players WHERE gameHash=?;");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        if ($stmt->execute()){
            $notice = 'players deleted';
        } else {
            $notice = "error: " .$stmt->error;
        }
        $stmt->close();
        $mysqli->close();
        return $notice;
    }

    function deleteTurns ($gameHash) {
        $notice = "";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("DELETE FROM turns WHERE gameHash=?;");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        if ($stmt->execute()){
            $notice = 'turns deleted';
        } else {
            $notice = "error: " .$stmt->error;
        }
        $stmt->close();
        $mysqli->close();
        return $notice;
    }

    function updateScore ($score, $gameHash, $playerHash) {
        $notice = "";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("UPDATE players SET score=? WHERE gameHash=? AND playerHash=?");
        echo $mysqli->error;
        $stmt->bind_param("iss", $score, $gameHash, $playerHash);
        if ($stmt->execute()){
            $notice = 'score updated';
        } else {
            $notice = "error: " .$stmt->error;
        }
        $stmt->close();
        $mysqli->close();
        return $notice;
    }

    function addTurn ($gameHash) {
        $notice = "";
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("INSERT INTO turns (gameHash) VALUES(?)");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        if ($stmt->execute()){
            $notice = 'turn added';
        } else {
            $notice = "error: " .$stmt->error;
        }
        $stmt->close();
        $mysqli->close();
        $turnCount = intval(getTurnCount($gameHash));
        $playerCount = intval(getPlayerCount($gameHash));
        if ($turnCount % $playerCount == 0 && $turnCount != 0) {
            deletePiece($gameHash);
        }
        return $notice;
    }

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
        $notice = '';
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("DELETE FROM pieces WHERE gameHash = ? LIMIT 1");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
        return $notice;
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

    function getPieceCount ($gameHash) {
        $result;
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("SELECT COUNT(*) AS pieces FROM pieces WHERE gameHash = ?");
        echo $mysqli->error;
        $stmt->bind_param("s", $gameHash);
        $stmt->bind_result($count);
        $stmt->execute();
        $stmt->fetch();
        $result = $count;
        $stmt->close();
        $mysqli->close();
        /*if ($result == 8) {
            deleteMessages($gameHash);
            deletePieces($gameHash);
            deletePlayers($gameHash);
            deleteTurns($gameHash);
            addPiecesToDatabase($gameHash);
        }*/
        return $result;
    }

    function getTurnCount ($gameHash) {
        $result;
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("SELECT COUNT(*) AS turns FROM turns WHERE gameHash = ?");
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
            $_SESSION["playerHash"] = $playerHash;
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
