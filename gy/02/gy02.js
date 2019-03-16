function $(id) {
    return document.getElementById(id);
} // domból kiszedi az id elemet amit pm-ként megadtunk

function init() {
    $('hellogomb').onclick = hello;
    $('masologomb').onclick = masolas;
    $('keruletgomb').onclick = kerulet;
    $('tippgomb').onclick = tipp;
    kitalaltSzam = Math.floor(Math.random() * 100);
    console.log(kitalaltSzam);
    $('forditasgomb').onclick = forditas;
}

function hello() {
    var n = $('hanyszor').value;
    var s = "";
    for (var i = 1; i <= n; ++i) {
        s += "<p style='font-size: " + (i * 5) + "px'>hello vilag</p>";
    }
    $('hellok').innerHTML = s;
}


// F2: 2 inputmező, gombnyomásra átmásolódik az érték a másikba

function masolas() {
    $('masodik').value = $('elso').value;
}


// F3: input kör sugara, gombnyomásra kör kerülete (r^2*pi)

function kerulet() {
    var r = $('sugar').value;
    $('korkerulet').innerHTML = precisionRound(r * 2 * Math.PI, 2);
}

function precisionRound(number, precision) {
    var factor = Math.pow(10, precision);
    return Math.round(number * factor) / factor;
}


// F4: tippelt szám nagyobb/kisebb/egyenlő kitalált számnál

var kitalaltSzam;

function tipp() {
    if ($('tippinput').value > kitalaltSzam) {
        $('eredmeny').innerHTML = "Nagyobb.";
    } else if ($('tippinput').value < kitalaltSzam) {
        $('eredmeny').innerHTML = "Kisebb.";
    } else {
        $('eredmeny').innerHTML = "Talalt.";
    }
}

// F5: szótár tömb, angol szó in, magyar szó out

var szotar = [
    { angol: 'apple', magyar: 'alma' },
    { angol: 'pear', magyar: 'korte' },
    { angol: 'plum', magyar: 'szilva' },
    { angol: 'peach', magyar: 'barack' }
];

function forditas() {
    var angolul = $('angolkifejezes').value;
    for (var i = 0; i < szotar.length; ++i) {
        if (angolul == szotar[i]. angol) {
            $('magyarkifejezes').innerHTML = szotar[i].magyar;
        }
    }
}

window.onload = init;