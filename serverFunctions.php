<?php
require("../../config_take_it_easy.php");
$database = "u169689266_easy";

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
