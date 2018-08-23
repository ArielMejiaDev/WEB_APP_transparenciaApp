//CAPTURAR EVENTO CON AJAX
	var categoriaEditarAjax = document.getElementById('descripcionEditarCategoria');
	categoriaEditarAjax.addEventListener('blur',enviarDatosValidarEditarCategoriaAjax,false);
	var conexionValidarEditarCategoriaAjax;
	var conexionValidarDescripcionEditarCategoriaAjax;
	var catEditarExiste = false;
//FIN CAPTURAR EVENTO CON AJAX
//CAPTURAR EVENTO CON AJAX
	var categoriaAjax = document.getElementById('descripcionCrearCategoria');
	categoriaAjax.addEventListener('blur',enviarDatosValidarCrearCategoriaAjax,false);
	var conexionValidarCrearCategoriaAjax;
	var catExiste = false;
//FIN CAPTURAR EVENTO CON AJAX
function enviarDatosValidarCrearCategoriaAjax(){
	//console.log(categoriaAjax.value);
	var dato = new FormData();
	dato.append('categoria',categoriaAjax.value);
	conexionValidarCrearCategoriaAjax = new XMLHttpRequest();
	conexionValidarCrearCategoriaAjax.onreadystatechange=respAjaxValCrearCatAjax;
	conexionValidarCrearCategoriaAjax.open('POST',"views/modules/validarCrearCategoriaAjax.php",true);
	conexionValidarCrearCategoriaAjax.send(dato);
}
function respAjaxValCrearCatAjax(){
	if (conexionValidarCrearCategoriaAjax.readyState==4) {
		if (conexionValidarCrearCategoriaAjax.status==200) {
			console.log(conexionValidarCrearCategoriaAjax.responseText);
			if (conexionValidarCrearCategoriaAjax.responseText=='existe') {
				catExiste = true;
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'La categoria ya existe, por favor cambia la descripción de la categoria o revisa en la lista de categorias',
				})	
			}
		}else{
			console.log('cargando...');
		}
	}
}
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
	//SI EXISTE LA CATEGORIA REVISION CON AJAX
		if (catExiste) {			
			return false;
		}
	//FIN EXISTE LA CATEGORIA REVISION CON AJAX
	return true;
}
function enviarDatosValidarEditarCategoriaAjax(){
	var idEditarCat = document.getElementById('idEditarCategoria').value;
	var data = new FormData();
	data.append('idEditarCat',idEditarCat);
	conexionValidarEditarCategoriaAjax = new XMLHttpRequest();
	conexionValidarEditarCategoriaAjax.onreadystatechange=respAjaxValEditarCategoria;
	conexionValidarEditarCategoriaAjax.open('POST','views/modules/validarCrearCategoriaAjax.php',true);
	conexionValidarEditarCategoriaAjax.send(data);
}
function respAjaxValEditarCategoria(){
	if (conexionValidarEditarCategoriaAjax.readyState==4) {
		if (conexionValidarEditarCategoriaAjax.status==200) {
			//console.log(conexionValidarEditarCategoriaAjax.responseText);
			if (categoriaEditarAjax.value!=conexionValidarEditarCategoriaAjax.responseText) {
				enviarDescripcionValidarEditarCategoriaAjax();
			}
		}
	}
}
function enviarDescripcionValidarEditarCategoriaAjax(){
	conexionValidarDescripcionEditarCategoriaAjax = new XMLHttpRequest();
	conexionValidarDescripcionEditarCategoriaAjax.onreadystatechange = respAjaxValDescripcionEditarCategoria;
	var data = new FormData();
	data.append('descripcion',categoriaEditarAjax.value);
	conexionValidarDescripcionEditarCategoriaAjax.open('POST','views/modules/validarCrearCategoriaAjax.php',true);
	conexionValidarDescripcionEditarCategoriaAjax.send(data);
}
function respAjaxValDescripcionEditarCategoria(){
	if (conexionValidarDescripcionEditarCategoriaAjax.readyState==4) {
		if (conexionValidarDescripcionEditarCategoriaAjax.status==200) {
			console.log(conexionValidarDescripcionEditarCategoriaAjax.responseText);
			if (conexionValidarDescripcionEditarCategoriaAjax.responseText=='existe') {
				catEditarExiste = true;
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'La categoria ya existe, por favor cambia la descripción de la categoria o revisa en la lista de categorias',
				})
			}else{
				catEditarExiste = false;
			}
		}
	}
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
	//VALIDAR AJAX NO REPETIR OTRA CATEGORIA
		if (catEditarExiste) {
			return false;
		}
	//FIN VALIDAR AJAX NO REPETIR OTRA CATEGORIA
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