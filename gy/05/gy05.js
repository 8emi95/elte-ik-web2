function $(id) {
    return document.getElementById(id)
}

window.addEventListener('load', init, false)

function init() {
    $('szingomb').addEventListener('click', szinez, false)
    $('eltuntetgomb').addEventListener('click', eltuntet, false)
    $('btnStart').addEventListener('click', visszaszamol, false)
}

//////////////////////////////////////////////////////////////////

function szinez() {
    $('par1').className = 'csunya'
    // $('par1').style.border = '1px solid orange';
    // $('par1').style.backgroundColor = 'brown';
    // $('par1').style.color = "white";
}

function eltuntet() {
    if ($('par1').style.display === 'none') {
        $('par1').style.opacity = 1
        $('par1').style.display = ''
    } else {
        $('par1').style.opacity = 0
        // $('par1').addEventListener('transitioned', animVege, false)
    }
}

// animVege

// idoVege

//////////////////////////////////////////////////////////////////

function visszaszamol() {
    //
}

//////////////////////////////////////////////////////////////////

setInterval( function() {
    var seconds = new Date().getSeconds()
    var sdegree = seconds * 6
    var srotate = "rotate(" + sdegree + "deg)"
    $('sec').style.transform = srotate
}, 1000)

setInterval( function() {
    var hours = new Date().getHours()
    var mins = new Date().getMinutes()
    var hdegree = hours * 30 + (mins / 2)
    var hrotate = "rotate(" + hdegree + "deg)"
    $('hour').style.transform = hrotate
}, 1000)

setInterval( function() {
    var mins = new Date().getMinutes()
    var mdegree = mins * 6
    var mrotate = "rotate(" + mdegree + "deg)"
    $('min').style.transform = mrotate
}, 1000)