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

    if (isset($_POST["gameHashPiece"])) {
        echo getFirstPiece($_POST["gameHashPiece"]);
    }

    if (isset($_POST["gameHashTurn"])) {
        addTurn($_POST["gameHashTurn"]);
    }

    if (isset($_POST["gameHashPieceCount"])) {
        echo getPieceCount($_POST["gameHashPieceCount"]);
    }

    if (isset($_POST["gameHashTurn"])) {
        updateScore($_POST["gameHashTurn"], $_POST["score"], $_POST["playerHashTurn"]);
    }
?>
