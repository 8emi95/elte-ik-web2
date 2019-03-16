document.querySelector('#button1').addEventListener('click', onClick);
function onClick(e) {
  setTimeout(function () {
    const n = parseInt( document.querySelector('#n').value );
    let s = '';
    for (let i = 0; i < n; i++) {
      s += `<li>${i+1}</li>`;
    }
    document.querySelector('#list').innerHTML = s;
  }, 20)
}

function pelda(a = 42) {
  return a;
}

function add(a, b) {
  return a + b;
}