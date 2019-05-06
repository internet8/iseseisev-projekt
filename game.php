<?php
    session_start();
    require("serverFunctions.php");
    if (getMaxPlayers($_GET["gameHash"]) == getPlayerCount($_GET["gameHash"])) {
        header("Location: index.php");
    }
    //echo $_GET["gameHash"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="server.js"></script>
    <script src="game.js"></script>

    </script>
    <title>TakeItEasy!</title>
</head>
<body>
    <div id="main">
        <div id="game">
            <p id="gameName">TAKE IT <br> EASY</p>
            <!-- first column -->
            <img src="assets/empty.png" width="21.3%" style="transform: translate(3vw, 8vw);" id="p1" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(3vw, 14.3vw);" id="p2" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(3vw, 20.6vw);" id="p3" onclick="placePiece(event);">
            <!-- second column -->
            <img src="assets/empty.png" width="21.3%" style="transform: translate(8.4vw, 4.85vw);" id="p4" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(8.4vw, 11.15vw);" id="p5" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(8.4vw, 17.45vw);" id="p6" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(8.4vw, 23.75vw);" id="p7" onclick="placePiece(event);">
            <!-- third column -->
            <img src="assets/empty.png" width="21.3%" style="transform: translate(13.8vw, 1.7vw);" id="p8" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(13.8vw, 8vw);" id="p9" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(13.8vw, 14.3vw);" id="p10" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(13.8vw, 20.6vw);" id="p11" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(13.8vw, 26.9vw);" id="p12" onclick="placePiece(event);">
            <!-- fourth column -->
            <img src="assets/empty.png" width="21.3%" style="transform: translate(19.2vw, 4.85vw);" id="p13" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(19.2vw, 11.15vw);" id="p14" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(19.2vw, 17.45vw);" id="p15" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(19.2vw, 23.75vw);" id="p16" onclick="placePiece(event);">
            <!-- fifth column -->
            <img src="assets/empty.png" width="21.3%" style="transform: translate(24.6vw, 8vw);" id="p17" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(24.6vw, 14.3vw);" id="p18" onclick="placePiece(event);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(24.6vw, 20.6vw);" id="p19" onclick="placePiece(event);">
        </div>
        <div id="info">
            <div id="chat">
                <p style="text-align: center; font-size: 0.8vw;">CHAT</p>
                <div id="chatArea"></div>
                <input type="text" maxlength="750" class="chat" disabled>
            </div>
            <div id="currentPiece">
                <p style="text-align: center; font-size: 0.8vw;">CURRENT PIECE</p>
                <img src="assets/empty.png" style="margin-left: 12%;" width="75%">
            </div>
            <div id="playerList">
                <p style="text-align: center; font-size: 0.8vw;">PLAYERS:</p>
            </div>
            <div id="changeName">
                <p style="text-align: center; font-size: 0.8vw;">SET YOUR NAME</p>
                <input id="playerName" type="text" maxlength="20">
                <button id="playerNameButton" class="button" onclick="setName();">SET</button>
            </div>
        </div>
        <div id="remainingPieces">
            <p style="margin-left: 10px; font-size: 0.8vw;">REMAINING PIECES:</p>
            <?php
            $files = scandir('assets/');
            foreach($files as $file) {
                if (strlen(basename($file)) == 7) {
                    echo '<img src="assets/' .basename($file) .'" width="5%" style="position: relative;" id="' .substr(basename($file), 0, 3) .'">';
                }
            }
            ?>
        </div>

    </div>
    <div style="margin-left: 1%; font-size: 1vw;" id="endMessage"></div>
</body>
</html>
