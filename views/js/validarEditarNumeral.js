function validarNumeralForm(){
	var numeral = document.getElementById("descripcionEditarNumeral");
	var avisoNumeral = document.getElementById("avisoDescripcionEditarNumeral");
	var expRegNombres = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
	//VALIDAR QUE NO ESTE VACIO
	if (numeral.value=="") {
		avisoNumeral.style.display="inline";
		avisoNumeral.innerHTML="No puede quedar vacio el númeral";
		return false;
	}
	if (!expRegNombres.test(numeral.value)) {
		avisoNumeral.style.display="inline";
		avisoNumeral.innerHTML="No esta permitido el uso de caracteres especiales";
		return false;
	}
	//VALIDAR QUE NO SEA NINGUNA EXPRESION REGULAR
	return true;
}

function validarCrearNumeral(){
	var numeral = document.getElementById("descripcionCrearNumeral");
	var avisoNumeral = document.getElementById("avisoDescripcionCrearNumeral");
	var expRegNombres = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
	//VALIDAR QUE NO ESTE VACIO
	if (numeral.value=="") {
		avisoNumeral.style.display="inline";
		avisoNumeral.innerHTML="No puede quedar vacio el númeral";
		return false;
	}
	if (!expRegNombres.test(numeral.value)) {
		avisoNumeral.style.display="inline";
		avisoNumeral.innerHTML="No esta permitido el uso de caracteres especiales";
		return false;
	}
	//VALIDAR QUE NO SEA NINGUNA EXPRESION REGULAR
	return true;
}