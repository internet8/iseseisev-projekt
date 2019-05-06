<?php
require("../../config_take_it_easy.php");
require("serverFunctions.php");
$database = "u169689266_easy";
function GetGames();
    // database functions
    function getGames () {
        $notice = '';
        $mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("SELECT dateCreated, hash FROM games");
        echo $mysqli->error;
        $stmt->bind_result($date, $gameHash);
        if($stmt->execute()){
            while($stmt->fetch()){
                $curDate = date();
                $dif = strtotime($curdate) - strtotime($date);
                if ($dif < 1) {
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
?>
