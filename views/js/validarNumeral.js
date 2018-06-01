function validarEditarNumeral(){
	var numeral = document.getElementById("descripcionEditarNumeral");
	var avisoNumeral = document.getElementById("avisoDescripcionEditarNumeral");
	var expRegNombres = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
	//VALIDAR QUE NO ESTE VACIO
	if (numeral.value=="") {
		avisoNumeral.style.display="inline";
		avisoNumeral.innerHTML="No puede quedar vacio el númeral";
		return false;
	}else{
		if (!expRegNombres.test(numeral.value)) {
		avisoNumeral.style.display="inline";
		avisoNumeral.innerHTML="No esta permitido el uso de caracteres especiales";
		return false;
	}
	}
	
	//VALIDAR QUE NO SEA NINGUNA EXPRESION REGULAR
	return true;
}

var numeral = document.getElementById("descripcionCrearNumeral");
var avisoNumeral = document.getElementById("avisoDescripcionCrearNumeral");
var numeralExiste = false;
numeral.addEventListener('blur',validarNumeralAjax,false);
var conexionAjaxNumeral;
function validarNumeralAjax(){
	//VALIDAR CON AJAX QUE NO EXISTA LA DESCRIPCION DEL NUMERAL
		//console.log(numeral.value);
		dato = new FormData();
		dato.append('numeral',numeral.value);
		conexionAjaxNumeral = new XMLHttpRequest();
		conexionAjaxNumeral.onreadystatechange = respAjaxNumeral;
		conexionAjaxNumeral.open("POST","views/modules/validacionCrearNumeralAjax.php",true);
		conexionAjaxNumeral.send(dato);
	//FIN DE VALIDAR CON AJAX QUE NO EXISTA LA DESCRIPCION DEL NUMERAL
}
function respAjaxNumeral(){
	if (conexionAjaxNumeral.readyState==4) {
		if (conexionAjaxNumeral.status==200) {
			console.log(conexionAjaxNumeral.responseText);
			var existencia = conexionAjaxNumeral.responseText;
			if (existencia=='Existe') {
				numeralExiste=true;
				avisoNumeral.innerHTML="El numeral ya existe!";
			 	avisoNumeral.style.display="inline";
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'El numeral ya existe',
				})
			}
		}
	}else{
		numeralExiste=false;
		avisoNumeral.style.display="none";
	}
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

	//VALIDAR QUE NO EXISTA YA ESE NUMERAL CON AJAX
		if (numeralExiste) {
			return false;
		}
	//FIN VALIDAR QUE NO EXISTA YA ESE NUMERAL CON AJAX
	return true;
}