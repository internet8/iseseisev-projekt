let gameHash = "";
let playerName = "";

$( document ).ready(function() {
    gameHash = getGameHash();
    setInterval(function () {
        getPlayers();
    }, 1000);
});

function setName () {
    playerName = $("#playerName").val();
    $("#playerNameButton").prop("disabled", true);

    // add player to database
    $.ajax({
        url: 'ajaxReceiver.php',
        type: 'POST',
        data: {
            playerName: playerName,
            gameHash: gameHash
        },
        success: function(response) {
            console.log(response);
        },
        error: function(error){ console.log(error.responseText);}
    });
    getPlayers();
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

// interval functions
function getPlayers () {
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
