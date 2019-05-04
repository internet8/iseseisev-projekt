<?php
    require("serverFunctions.php");
    $gameUrl = "";

    if (isset($_POST["createGame"])) {
        $hash = uniqid();
        createGame($hash, $_POST["playerCount"]);
        $gameUrl .= "Send this url to your friends:<br> https://www.kentpirma.eu/takeiteasy/game.php?gameHash=" .$hash;
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>TakeItEasy!</title>
</head>
<body>
    <h1 style="text-align: center;">TAKE IT EASY!</h1>
    <p style="text-align: center;">CREATE A GAME BY TYPING THE NUMBER OF PLAYERS:</p>
    <div id="mainContainer">
        <form action="index.php" method="post" style="text-align: center;">
            <input style="margin-left: 0.7%;" type="number" name="playerCount" value="2" min="2" max="6">
            <input class="button" type="submit" name="createGame" value="GENERATE">
        </form>
        <p style="text-align: center;"><?php echo $gameUrl; ?></p>
    </div>
</body>
</html>
