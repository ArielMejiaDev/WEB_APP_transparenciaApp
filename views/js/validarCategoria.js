function validarCrearCategoria(){
	//VALIDAR DESCRIPCION DE LA CATEGORIA
		var categoria = document.getElementById('descripcionCrearCategoria');
		var avisoCrearCategoria = document.getElementById('avisoDescripcionCrearCategoria');
		var expRegNombres = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
		var expRegNum = /^[0-9]*$/;
		if (categoria.value=="") {
			avisoCrearCategoria.innerHTML="No puede quedar vacio";
			avisoCrearCategoria.style.display="inline";
			return false;
		}else{
			if (!expRegNombres.test(categoria.value)) {
				avisoCrearCategoria.innerHTML="No esta permitido el uso de caracteres especiales";
				avisoCrearCategoria.style.display="inline";
				return false;
			}
		}
	//FIN DE VALIDA DESCRIPCION DE LA CATEGORIA
	//VALIDAR ID DEL NUMERAL 
		var idNumeralCrearCategoria = document.getElementById('idNumeralCrearCategoria');
		var avisoIdNumeralCrearCategoria = document.getElementById('avisoIdNumeralCrearCategoria');
		if (idNumeralCrearCategoria.value=="") {
			avisoIdNumeralCrearCategoria.innerHTML="No puede quedar vacio";
			avisoIdNumeralCrearCategoria.style.display="inline";
			return false;
		}else{
			if (!expRegNum.test(idNumeralCrearCategoria.value)) {
				avisoIdNumeralCrearCategoria.innerHTML="No esta permitido el uso de caracteres especiales";
				avisoIdNumeralCrearCategoria.style.display="inline";
				return false;
			}
		}				
	//FIN VALIDAR ID DEL NUMERAL
	return true;
}
function validarEditarCategoria(){
	var expRegNombres = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
	var expRegNum = /^[0-9]*$/;
	var idNumeral = document.getElementById('idNumeralEditarCategoria');
	var avisoIdNumeral = document.getElementById('avisoIdNumeralEditarCategoria');
	var idCategoria = document.getElementById('idEditarCategoria');
	var descripcionCategoria = document.getElementById('descripcionEditarCategoria');
	var avisoDescripcionCategoria = document.getElementById('avisoDescripcionEditarCategoria');
	//VALIDAR IDNUMERALCATEGORIA
		if (idNumeral.value=="") {
			avisoIdNumeral.innerHTML="No puede quedar vacio";
			avisoIdNumeral.style.display="inline";
			return false;
		}else{
			if (!expRegNum.test(idNumeral.value)) {
				avisoIdNumeral.innerHTML="No esta permitido el uso de caracteres especiales";
				avisoIdNumeral.style.display="inline";
				return false;
			}
		}
	//FIN VALIDAR IDNUMERALCATEGORIA
	
	//VALIDAR ID CATEGORIA
		if (idCategoria.value=="") {
			avisoDescripcionCategoria.innerHTML="No puede quedar vacio";
			avisoDescripcionCategoria.style.display="inline";
			return false;
		}else{
			if (!expRegNum.test(idCategoria.value)) {
				avisoDescripcionCategoria.innerHTML="No esta permitido el uso de caracteres especiales";
				avisoDescripcionCategoria.style.display="inline";
				return false;
			}
		}
	//FIN VALIDAR ID CATEGORIA

	//VALIDAR DESCRIPCION CATEGORIA
		if (descripcionCategoria.value=="") {
			avisoDescripcionCategoria.innerHTML="No puede quedar vacio";
			avisoDescripcionCategoria.style.display="inline";
			return false;
		}else{
			if (!expRegNombres.test(descripcionCategoria.value)) {
				avisoDescripcionCategoria.innerHTML="No esta permitido el uso de caracteres especiales";
				avisoDescripcionCategoria.style.display="inline";
				return false;
			}
		}
	//FIN VALIDAR DESCRIPCION CATEGORIA
	return true;
}
function validarAgregarAvisoCategoria(){
	var expRegNombres = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
	var expRegNum = /^[0-9]*$/;
	var idCategoria = document.getElementById('idAgregarReglaCategoria');
	var avisoCategoria = document.getElementById('avisoAgregarReglaCategoria');
	var avisoDelAvisoCategoria = document.getElementById('avisoAvisoAgregarReglaCategoria');
	//VALIDAR ID CATEGORIA
		if (idCategoria.value=="") {
			avisoDelAvisoCategoria.innerHTML="No puede quedar vacio";
			avisoDelAvisoCategoria.style.display="inline";
			return false;
		}else{
			if (!expRegNum.test(idCategoria.value)) {
				avisoDelAvisoCategoria.innerHTML="No esta permitido el uso de caracteres especiales";
				avisoDelAvisoCategoria.style.display="inline";
				return false;
			}
		}
	//FIN VALIDAR ID CATEGORIA
	//VALIDAR AVISO
		if (avisoCategoria.value=="") {
			avisoDelAvisoCategoria.innerHTML="No puede quedar vacio";
			avisoDelAvisoCategoria.style.display="inline";
			return false;
		}else{
			if (!expRegNombres.test(avisoCategoria.value)) {
				avisoDelAvisoCategoria.innerHTML="No esta permitido el uso de caracteres especiales";
				avisoDelAvisoCategoria.style.display="inline";
				return false;
			}
		}
	//FIN VALIDAR AVISO
	return true;
}