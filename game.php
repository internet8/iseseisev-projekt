<?php
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
            <img src="assets/empty.png" width="21.3%" style="transform: translate(3vw, 8vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(3vw, 14.3vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(3vw, 20.6vw);">
            <!-- second column -->
            <img src="assets/empty.png" width="21.3%" style="transform: translate(8.4vw, 4.85vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(8.4vw, 11.15vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(8.4vw, 17.45vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(8.4vw, 23.75vw);">
            <!-- third column -->
            <img src="assets/empty.png" width="21.3%" style="transform: translate(13.8vw, 1.7vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(13.8vw, 8vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(13.8vw, 14.3vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(13.8vw, 20.6vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(13.8vw, 26.9vw);">
            <!-- fourth column -->
            <img src="assets/empty.png" width="21.3%" style="transform: translate(19.2vw, 4.85vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(19.2vw, 11.15vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(19.2vw, 17.45vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(19.2vw, 23.75vw);">
            <!-- fifth column -->
            <img src="assets/empty.png" width="21.3%" style="transform: translate(24.6vw, 8vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(24.6vw, 14.3vw);">
            <img src="assets/empty.png" width="21.3%" style="transform: translate(24.6vw, 20.6vw);">
        </div>
        <div id="info">
            <div id="chat">
                <p style="text-align: center; font-size: 0.8vw;">CHAT</p>
                <textarea readonly></textarea>
                <input type="text" maxlength="750">
            </div>
            <div id="currentPiece">
                <p style="text-align: center; font-size: 0.8vw;">CURRENT PIECE</p>
                <img src="assets/123.png" style="margin-left: 12%;" width="75%">
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
        </div>
    </div>
</body>
</html>
