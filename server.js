let gameHash = "";
let playerName = "";
let playerHash = "";
let recentPiece = "empty";
let placedPiece = "empty";
let gameFinished = false;

$( document ).ready(function() {
    gameHash = getGameHash();
    setInterval(function () {
        getPlayers();
    }, 1000);
    setInterval(function () {
        readMessages();
    }, 1000);
    setInterval(function () {
        getPiece();
    }, 1000);
    setInterval(function () {
        getPieceCount();
    }, 1000);
});

function setName () {
    playerName = $("#playerName").val();
    playerHash = Math.random().toString(36).substring(2);
    // add player to database
    $.ajax({
        url: 'ajaxReceiver.php',
        type: 'POST',
        data: {
            playerName: playerName,
            gameHash: gameHash,
            playerHash: playerHash
        },
        success: function(response) {
            console.log(response);
            $("#playerNameButton").prop("disabled", true);
            $(".chat").prop("disabled", false);
        }
        //error: function(error){ console.log(error.responseText);}
    });
}

function sendMessage (message) {
    // add message to database
    $.ajax({
        url: 'ajaxReceiver.php',
        type: 'POST',
        data: {
            playerNameSM: playerName,
            gameHashSM: gameHash,
            playerHashSM: playerHash,
            message: message
        },
        success: function(response) {
            console.log(response);
        }
    });
}

function addTurn () {
    // add turn to database
    $.ajax({
        url: 'ajaxReceiver.php',
        type: 'POST',
        data: {
            gameHashTurn: gameHash,
            playerHashTurn: playerHash
        },
        success: function(response) {
            console.log(response);
        }
    });
}

function updateScore () {
    // add turn to database
    $.ajax({
        url: 'ajaxReceiver.php',
        type: 'POST',
        data: {
            gameHashScore: gameHash,
            playerHashScore: playerHash,
            score: points
        },
        success: function(response) {
            console.log(response);
        }
    });
}

function getGameHash () {
    let query = window.location.search.substring(1);
        let vars = query.split("&");
        for (let i=0;i<vars.length;i++) {
               let pair = vars[i].split("=");
               if(pair[0] == "gameHash"){return pair[1];}
        }
        return "";
}


// sending message
jQuery(document).on('keydown', 'input.chat', function(e) {
    if(e.which === 13) {
        let message = $(".chat").val();
        //console.log(message);
        $(".chat").val("");
        if (message.length > 0) {
            sendMessage(message);
        }
        return false;
    }
});

// interval functions
function getPlayers () {
    // get all players
    $.ajax({
        url: 'ajaxReceiver.php',
        type: 'POST',
        data: {
            gameHashPlayers: gameHash,
        },
        success: function (response) {
            $('#playerList').html(response);
        }
    });
}

function readMessages () {
    // get all messages
    $.ajax({
        url: 'ajaxReceiver.php',
        type: 'POST',
        data: {
            gameHashMessages: gameHash,
        },
        success: function (response) {
            let chat = $('#chatArea');
            chat.html(response);
            if (!(chat.is(":hover"))) {
                chat.scrollTop(chat[0].scrollHeight);
            }
        }
    });
}

function getPiece () {
    // get all players
    if (gameFinished == false) {
        $.ajax({
            url: 'ajaxReceiver.php',
            type: 'POST',
            data: {
                gameHashPiece: gameHash,
                playerHashPiece: playerHash
            },
            success: function (response) {
                if (response.length == 3 && response != recentPiece) {
                    recentPiece = response;
                    let html = '<p style="text-align: center; font-size: 0.8vw;">CURRENT PIECE</p><img src="assets/' + response + '.png" style="margin-left: 12%;" width="75%">';
                    $('#currentPiece').html(html);
                    let id = "#" + response;
                    $(id).remove();
                }
            }
        });
    }
}

function getPieceCount () {
    // get all players
    $.ajax({
        url: 'ajaxReceiver.php',
        type: 'POST',
        data: {
            gameHashPieceCount: gameHash
        },
        success: function (response) {
            if (response.toString() == "8") {
                gameFinished = true;
            }
        }
    });
}
