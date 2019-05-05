<?php
    require("serverFunctions.php");

    if (isset($_POST["playerName"])) {
        addPlayer($_POST["playerName"], $_POST["gameHash"], $_POST["playerHash"]);
    }

    if (isset($_POST["gameHashPlayers"])) {
        echo getAllPlayers($_POST["gameHashPlayers"]);
    }

    if (isset($_POST["message"])) {
        addMessage($_POST["playerHashSM"], $_POST["gameHashSM"], $_POST["message"], $_POST["playerNameSM"]);
    }

    if (isset($_POST["gameHashMessages"])) {
        echo getAllMessages($_POST["gameHashMessages"]);
    }
?>
