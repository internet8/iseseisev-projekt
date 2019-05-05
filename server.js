let gameHash = "";
let playerName = "";
let playerHash = "";
let chatText = "";

$( document ).ready(function() {
    gameHash = getGameHash();
    setInterval(function () {
        getPlayers();
    }, 1000);
    setInterval(function () {
        readMessages();
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
