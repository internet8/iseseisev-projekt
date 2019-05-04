<?php
    require("serverFunctions.php");

    if (isset($_POST["playerName"])) {
        addPlayer($_POST["playerName"], $_POST["gameHash"]);
    }

    if (isset($_POST["gameHashPlayers"])) {
        echo getAllPlayers($_POST["gameHashPlayers"]);
    }
?>
