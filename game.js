let myBoard = [];

$( document ).ready(function() {
    for (let i = 1; i < 20; i++) {
        let name = "p" + i.toString();
        myBoard.push(new place(name, "empty"));
    }
});

function place (name, piece) {
    this.name = name;
    this.piece = piece;
}

function placePiece (e) {
    let id = e.target.id;
    if (recentPiece != placedPiece && checkIfEmpty(id)) {
        placedPiece = recentPiece;
        $("#" + id).attr('src', "assets/" + recentPiece + ".png");
        updateBoard(id, placedPiece);
        addMyTurn();
    }
}

function updateBoard (name, piece) {
    for (let i = 0; i < myBoard.length; i++) {
        if (myBoard[i].name == name) {
            myBoard[i].piece = piece;
            return;
        }
    }
}

function checkIfEmpty (name) {
    for (let i = 0; i < myBoard.length; i++) {
        if (myBoard[i].name == name) {
            if (myBoard[i].piece == "empty") {
                return true;
            }
        }
    }
    return false;
}
