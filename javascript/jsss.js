<script>
	document.addEventListener('DOMContentLoaded', function () {
var options = null;
var elems = document.querySelectorAll('.datepicker');
var instances = M.Datepicker.init(elems, options);
});
document.addEventListener('DOMContentLoaded', function () {
var options = null;
var elems = document.querySelectorAll('.timepicker');
var instances = M.Timepicker.init(elems, options);
});

var btnPopup = document.getElementById('btnPopup');
var overlay = document.getElementById('overlay');
btnPopup.addEventListener('click', openModal);

function openModal() {
overlay.style.display = 'block';
}

var btnPopup2 = document.getElementById('btnPopup2');
var overlay2 = document.getElementById('overlay2');
btnPopup2.addEventListener('click', openModal2);

function openModal2() {
if (document.getElementById('nom').value != "" && document.getElementById('prenom').value != "") {

overlay2.style.display = 'block';
overlay.style.display = 'none';
} else {

alert("Saisir votre nom et prénom");

}

}
var btnPopup3 = document.getElementById('btnPopup3');
var overlay3 = document.getElementById('overlay3');
btnPopup3.addEventListener('click', openModal3);

function openModal3() {

if (document.getElementById('tel').value != "") {
overlay3.style.display = 'block';
overlay2.style.display = 'none';


} else {

alert("Saisir votre nom et prénom");

}

}