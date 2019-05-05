let myBoard = [];
let points = 0;

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
        points = calculateScore();
        addTurn();
        updateScore();
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

function calculateScore()
    {
        let score = 0;
        //Up to down
        if (myBoard[0].piece.substring(0, 1) == (myBoard[2].piece.substring(0, 1)) && myBoard[0].piece.substring(0, 1) == (myBoard[1].piece.substring(0, 1)))
        {
            if (!isNaN((myBoard[0].piece.substring(0, 1)))) {
                score += parseInt(myBoard[0].piece.substring(0, 1)) * 3;
            }
        }
        if (myBoard[3].piece.substring(0, 1) == (myBoard[4].piece.substring(0, 1)) && myBoard[3].piece.substring(0, 1) == (myBoard[5].piece.substring(0, 1)) && myBoard[3].piece.substring(0, 1) == (myBoard[6].piece.substring(0, 1)))
        {
            if (!isNaN((myBoard[3].piece.substring(0, 1)))) {
                score += parseInt(myBoard[3].piece.substring(0, 1)) * 4;
            }
        }
        if (myBoard[7].piece.substring(0, 1) == (myBoard[8].piece.substring(0, 1)) && myBoard[7].piece.substring(0, 1) == (myBoard[9].piece.substring(0, 1)) && myBoard[7].piece.substring(0, 1) == (myBoard[10].piece.substring(0, 1)) && myBoard[7].piece.substring(0, 1) == (myBoard[11].piece.substring(0, 1)))
        {
            if (!isNaN((myBoard[7].piece.substring(0, 1)))) {
                score += parseInt(myBoard[7].piece.substring(0, 1)) * 5;
            }
        }
        if (myBoard[12].piece.substring(0, 1) == (myBoard[13].piece.substring(0, 1)) && myBoard[12].piece.substring(0, 1) == (myBoard[14].piece.substring(0, 1)) && myBoard[12].piece.substring(0, 1) == (myBoard[15].piece.substring(0, 1)))
        {
            if (!isNaN((myBoard[12].piece.substring(0, 1)))) {
                score += parseInt(myBoard[12].piece.substring(0, 1)) * 4;
            }
        }
        if (myBoard[16].piece.substring(0, 1) == (myBoard[17].piece.substring(0, 1)) && myBoard[16].piece.substring(0, 1) == (myBoard[18].piece.substring(0, 1)))
        {
            if (!isNaN((myBoard[16].piece.substring(0, 1)))) {
                score += parseInt(myBoard[16].piece.substring(0, 1)) * 3;
            }
        }
        //left/down to right/up
        if (myBoard[0].piece.substring(1, 2) == (myBoard[3].piece.substring(1, 2)) && myBoard[0].piece.substring(1, 2) == (myBoard[7].piece.substring(1, 2)))
        {
            if (!isNaN((myBoard[0].piece.substring(0, 1)))) {
                score += parseInt(myBoard[0].piece.substring(1, 2)) * 3;
            }
        }
        if (myBoard[1].piece.substring(1, 2) == (myBoard[4].piece.substring(1, 2)) && myBoard[1].piece.substring(1, 2) == (myBoard[8].piece.substring(1, 2)) && myBoard[1].piece.substring(1, 2) == (myBoard[12].piece.substring(1, 2)))
        {
            if (!isNaN((myBoard[1].piece.substring(0, 1)))) {
                score += parseInt(myBoard[1].piece.substring(1, 2)) * 4;
            }
        }
        if (myBoard[2].piece.substring(1, 2) == (myBoard[5].piece.substring(1, 2)) && myBoard[2].piece.substring(1, 2) == (myBoard[9].piece.substring(1, 2)) && myBoard[2].piece.substring(1, 2) == (myBoard[13].piece.substring(1, 2)) && myBoard[2].piece.substring(1, 2) == (myBoard[16].piece.substring(1, 2)))
        {
            if (!isNaN((myBoard[2].piece.substring(0, 1)))) {
                score += parseInt(myBoard[2].piece.substring(1, 2)) * 5;
            }
        }
        if (myBoard[6].piece.substring(1, 2) == (myBoard[10].piece.substring(1, 2)) && myBoard[6].piece.substring(1, 2) == (myBoard[14].piece.substring(1, 2)) && myBoard[6].piece.substring(1, 2) == (myBoard[17].piece.substring(1, 2)))
        {
            if (!isNaN((myBoard[6].piece.substring(0, 1)))) {
                score += parseInt(myBoard[6].piece.substring(1, 2)) * 4;
            }
        }
        if (myBoard[11].piece.substring(1, 2) == (myBoard[15].piece.substring(1, 2)) && myBoard[11].piece.substring(1, 2) == (myBoard[18].piece.substring(1, 2)))
        {
            if (!isNaN((myBoard[11].piece.substring(0, 1)))) {
                score += parseInt(myBoard[11].piece.substring(1, 2)) * 3;
            }
        }
        //left/up to right/down
        if (myBoard[7].piece.substring(2, 3) == (myBoard[12].piece.substring(2, 3)) && myBoard[7].piece.substring(2, 3) == (myBoard[16].piece.substring(2, 3)))
        {
            if (!isNaN((myBoard[7].piece.substring(0, 1)))) {
                score += parseInt(myBoard[7].piece.substring(2, 3)) * 3;
            }
        }
        if (myBoard[3].piece.substring(2, 3) == (myBoard[8].piece.substring(2, 3)) && myBoard[3].piece.substring(2, 3) == (myBoard[13].piece.substring(2, 3)) && myBoard[3].piece.substring(2, 3) == (myBoard[17].piece.substring(2, 3)))
        {
            if (!isNaN((myBoard[3].piece.substring(0, 1)))) {
                score += parseInt(myBoard[3].piece.substring(2, 3)) * 4;
            }
        }
        if (myBoard[0].piece.substring(2, 3) == (myBoard[4].piece.substring(2, 3)) && myBoard[0].piece.substring(2, 3) == (myBoard[9].piece.substring(2, 3)) && myBoard[0].piece.substring(2, 3) == (myBoard[14].piece.substring(2, 3)) && myBoard[0].piece.substring(2, 3) == (myBoard[18].piece.substring(2, 3)))
        {
            if (!isNaN((myBoard[0].piece.substring(0, 1)))) {
                score += parseInt(myBoard[0].piece.substring(2, 3)) * 5;
            }
        }
        if (myBoard[1].piece.substring(2, 3) == (myBoard[5].piece.substring(2, 3)) && myBoard[1].piece.substring(2, 3) == (myBoard[10].piece.substring(2, 3)) && myBoard[1].piece.substring(2, 3) == (myBoard[15].piece.substring(2, 3)))
        {
            if (!isNaN((myBoard[1].piece.substring(0, 1)))) {
                score += parseInt(myBoard[1].piece.substring(2, 3)) * 4;
            }
        }
        if (myBoard[2].piece.substring(2, 3) == (myBoard[6].piece.substring(2, 3)) && myBoard[2].piece.substring(2, 3) == (myBoard[11].piece.substring(2, 3)))
        {
            if (!isNaN((myBoard[2].piece.substring(0, 1)))) {
                score += parseInt(myBoard[2].piece.substring(2, 3)) * 3;
            }
        }
        return score;
    }
