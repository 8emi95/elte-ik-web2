function $(id) {
    return document.getElementById(id)
}

window.addEventListener('load', init, false)

function init() {
    $('form1').addEventListener('submit', ellenorzes, false)
	$('btnUj').addEventListener('click', ujJatek, false);
	$('terkep').addEventListener('click', keres, false);
	kepinit();
}

// 1. a)
// név és érdeklődési terület megadása kötelező
// életkornak csak számot fogadunk el
// Az ellenőrzést elküldéskor végezzük el, a hibákat az űrlap felett egy listában jelenítsük meg.
function ellenorzes(e) {
    var hibak = [];
    if ($('txtNev').value === '') {
        hibak.push('A név kötelező!');
    }
    if (!(/^\d{0,2}$/.test( $('txtKor').value ))) {
        hibak.push('A kor nem szám!');
    }
    if ($('selErd').value === '') {
        hibak.push('Érdeklődni kötelező!');
    }
    
    if (hibak.length > 0) {
        e.preventDefault();
        $('hibak').innerHTML = tombbolLista(hibak);
    }
}

function tombbolLista(x) {
    return '<li>' + x.join('</li><li>') + '</li>';
}

// 8.
var kincsPoz;
var vege;

function xyKoord(td) {
    var x = td.cellIndex;
    var tr = td.parentNode;
    var y = tr.sectionRowIndex;
    return {
        x: x,
        y: y
    };
}
function keres(e) {
    if (!vege) {
        if (e.target.tagName === 'TD') {
            var td = e.target;
            var kattPoz = xyKoord(td);
            if (kincsPoz.x === kattPoz.x &&
                    kincsPoz.y === kattPoz.y) {
                td.innerHTML = 'V';
                vege = true;
            } else {
                td.innerHTML = 'N';
            }
        }
    }
}

function ujJatek(e) {
    var n = parseInt($('txtN').value, 10);
    kincsPoz = {
        x: veletlen(n),
        y: veletlen(n)
    };
    console.log(kincsPoz);
    vege = false;
    $('terkep').innerHTML = genTable(n);
}

function veletlen(n) {
    return Math.floor(Math.random() * n);
}

function genTable(n) {
    var s = '';
    for (var i = 0; i < n; i++) {
        s += '<tr>';
        for (var j = 0; j < n; j++) {
            s += '<td></td>';
        }
        s += '</tr>';
    }
    return s;
}

var kepek = [
    'http://idezeteekk.hupont.hu/felhasznalok_uj/1/9/195469/kepfeltoltes/alma._xd.jpg',
    'http://www.egeszseg-betegseg.hu/leadpics/alternativ/2013/01/19/mandulaval-toltott-sult-alma-large.jpg'
];

var aktkep = 0;

function kepinit() {
    var s = '<input type="button" id="btnElozo" value="<" />'+
            '<img id="kep" src="" />' +
            '<input type="button" id="btnKovetkezo" value=">" />';
    $('nezoke').innerHTML = s;
    $('kep').src = kepek[aktkep];
    $('kep').style.transition = 'opacity 0.7s';
    //$('btnElozo').onclick = elozo;
    $('btnKovetkezo').onclick = kovetkezo;
}

function kovetkezo() {
    $('kep').style.opacity = 0;
    $('kep').addEventListener('transitionend', kov2);
}

function kov2() {
    $('kep').removeEventListener('transitionend', kov2);
    $('kep').style.opacity = 1;
    aktkep = (aktkep + 1) % kepek.length;
    $('kep').src = kepek[aktkep];
}