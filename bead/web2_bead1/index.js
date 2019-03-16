//
function $(selector) {
	return document.querySelector(selector);
}

function $$(selector) {
	return document.querySelectorAll(selector);
}

function delegate(parent, type, selector, fn) {
	function delegatedFunction(e) {
		if (e.target.matches(`${selector},${selector} *`)) {
			let target = e.target;
			while (!target.matches(selector)) {
			target = target.parentNode;
		}
		e.delegatedTarget = target;
		return fn.call(target, e);
		}
	}
	parent.addEventListener(type, delegatedFunction, false);
}

// Adatok és feldolgozó függvények (akciók)
function rotateImage() {
	document.getElementById("rotatable").setAttribute("class", "rotated90");
}

// Eseménykezelők
function whichMouseButton(e) {
	const pressedButton = e.button;
	if (pressedButton === 0) {
		//console.log('bal gomb');
	} else if (pressedButton === 2) {
		e.preventDefault();
		rotateImage();
	}
}
$('#rotatable').addEventListener('mousedown', whichMouseButton);

delegate($('#table'), 'click', 'td', clickOnImage);
function clickOnImage(e) {
	//rotateImage();
	// $('#table').innerHTML = genTable(table, gameState);
}

// HTML generáló
