var players = {
    X: { prev: null },
    O: { prev: null }
}

var current = 'X'
var winner = null
var gameover = false
var winnerIndexes = []

var table = Array(9).fill(null)
/*
0 1 2
3 4 5
6 7 8
*/

function getWinner() {
    for (var i = 0; i < 7; i += 3) { // sorok
        if (table[i] !== null
            && table[i] === table[i + 1]
            && table[i] === table[i + 2]
        ) {
            winnerIndexes = [i, i + 1, i + 2]
            return table[i]
        }
    }

    for (var i = 0; i < 3; ++i) { // oszlopok
        if (table[i] !== null
            && table[i] === table[i + 3]
            && table[i] === table[i + 6]
        ) {
            winnerIndexes = [i, i + 3, i + 6]
            return table[i]
        }
    }

    if (table[0] !== null // átló1
        && table[0] === table[4]
        && table[0] === table[8]
    ) {
        winnerIndexes = [0, 4, 8]
        return table[0]
    }

    if (table[2] !== null // átló2
        && table[2] === table[4]
        && table[2] === table[6]
    ) {
        winnerIndexes = [2, 4, 6]
        return table[2]
    }

    return null
}

function isFull() {
    return table.every(val => val !== null)
}

function step(index) {
    if (!gameover && table[index] === null) {
        players[current].prev = index
        table[index] = current
        switchPlayers()
        winner = getWinner()
        gameover = winner !== null || isFull()
        return true
    }
    return false
}

function undoVariables() {
    table[players["X"].prev] = null
    table[players["O"].prev] = null
    players["X"].prev = null
    players["O"].prev = null
    gameover = false
    winner = null
    winnerIndexes = []
}

function getComputerStep() {
    var computerIndex = null
    do {
        computerIndex = Math.floor(Math.random() * 8)
    } while (table[computerIndex] !== null)
    return computerIndex
}

function switchPlayers() {
    if (current === "X") {
        current = "O"
    } else if (current === "O") {
        current = "X"
    }
}

function tie() {
    return isFull() && getWinner() === null
}

function resetVariables() {
    for (var i = 0; i < 9; ++i) {
        table[i] = null
    }

    current = 'X'
    winner = null
    gameover = false
    winnerIndexes = []
    currentGamemode = null
    timeout = null
    players["X"].prev = null
    players["O"].prev = null
}