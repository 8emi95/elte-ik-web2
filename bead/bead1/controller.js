var currentGameMode = null
var timeout = null

function $(id) {
    return document.getElementById(id)
}

function init() {
    $('humanOpponent').addEventListener('click', revealBoard, false)
    $('computerOpponent').addEventListener('click', revealBoard, false)
    $('demo').addEventListener('click', revealBoard, false)
    $('undoButton').addEventListener('click', undoClick, false)
    $('newGameButton').addEventListener('click', reset, false)
    $('backButton').addEventListener('click', reset, false)

    var cells = document.querySelectorAll("#gameboard table td")
    for (var cell of cells) {
        cell.addEventListener('click', cellClick, false)
    }
}

window.addEventListener('load', init, false)

function getCellByIndex(index) {
    return document.querySelector("[data-cellindex='" + index + "']")
}

function revealBoard(e) {
    currentGameMode = e.target.id
    $('mode').style.display = "none"
    $('gameboard').style.display = "block"

    $("message").innerHTML = "X kezd."
}

function cellClick(e) {
    var index = parseInt(e.target.dataset.cellindex)
    var symbol = current

    if (!step(index)) {
        return
    }

    e.target.innerHTML = symbol

    if (gameover) {
        end()
        return
    }

    if (currentGameMode !== 'humanOpponent') {
        $("message").innerHTML = ""

        var computerIndex = getComputerStep()
        var computerCell = getCellByIndex(computerIndex)
        symbol = current
        step(computerIndex)
        computerCell.innerHTML = symbol

        if (gameover) {
            if (currentGameMode === "computerOpponent") {
                end()
            } else if (currentGameMode === "demo") {
                $('undoButton').style.display = "block"
                computerCell.style.color = "gray"

                timeout = setTimeout(() => {
                    $('undoButton').style.display = "none"
                    computerCell.style.color = ""
                    end()
                }, 5000)
            }
        }
    } else {
        $("message").innerHTML = current + " következik."
    }
}

function end() {
    colorWinner()
    $('newGameButton').style.display = "block"
    if (tie()) {
        $("message").innerHTML = "A játék döntetlen."
        $("animation").innerHTML = "<img src='tie" + (Math.floor(Math.random() * 4) + 1) + ".gif'>"
    } else if ((currentGameMode === 'computerOpponent' || currentGameMode === 'demo') && winner === 'O') {
        $("message").innerHTML = "A nyertes: " + winner
        $("animation").innerHTML = "<img src='lose" + (Math.floor(Math.random() * 4) + 1) + ".gif'>"
    } else {
        $("message").innerHTML = "A nyertes: " + winner
        $("animation").innerHTML = "<img src='win" + (Math.floor(Math.random() * 4) + 1) + ".gif'>"
    }
}

function undoClick() {
    clearTimeout(timeout)
    $('undoButton').style.display = "none"
    getCellByIndex(players["O"].prev).style.color = ""
    document.querySelector("[data-cellindex='" + players["X"].prev + "']").innerHTML = ""
    document.querySelector("[data-cellindex='" + players["O"].prev + "']").innerHTML = ""
    undoVariables()
}

function colorWinner() {
    for (var i of winnerIndexes) {
        getCellByIndex(i).style.backgroundColor = "#9c39ba"
    }
}

function reset() {
    $('mode').style.display = "block"
    $('gameboard').style.display = "none"
    $('newGameButton').style.display = "none"

    $("message").innerHTML = ""
    $("animation").innerHTML = ""

    for (var i = 0; i < 9; ++i) {
        getCellByIndex(i).innerHTML = ""
        getCellByIndex(i).style.backgroundColor = ""
    }

    resetVariables()
}