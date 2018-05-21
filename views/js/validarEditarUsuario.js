function validarEditarUsuario(){
	var expRegNombres = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
	// var expRegNombres = /^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/;
	var regExp=/^[a-zA-Z0-9]*$/;
	var regExpPassword= /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/;
	var expRegEmail =/^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
	var regExpNum = /[1-4]/g;
	var expRegUrl = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
// VALIDAR EDICION DE USUARIO
	var usuario = document.getElementById("nombresCrearUsuario");
	var avisoUsuario = document.getElementById("avisoNombresCrearUsuario");
	
	if (usuario.value == "") {
		avisoUsuario.style.display="inline";
		avisoUsuario.innerHTML="No puede dejar vacio los nombres";
		return false;
	}else{
		if (!expRegNombres.test(usuario.value)) {
			avisoUsuario.style.display="inline";
			avisoUsuario.innerHTML="No esta permitido el ingreso de caracteres especiales";
			return false;
		}
	}
// FIN DE VALIDACION DE USUARIO
	
// VALIDAR APELLIDOS
	var apellidos = document.getElementById("apellidosCrearUsuario");
	var avisoApellidos = document.getElementById("avisoApellidosCrearUsuario");
	if (apellidos.value =="") {
		avisoApellidos.style.display="inline";
		avisoApellidos.innerHTML="No puede dejar vacio los apellidos";
		return false;
	}else{
		if (!expRegNombres.test(apellidos.value)) {
			avisoApellidos.style.display="inline";
			avisoApellidos.innerHTML="No esta permitido el ingreso de caracteres especiales";
			return false;
		}
	}
// FIN VALIDAR APELLIDOS

// VALIDAR USUARIO
	var usuario = document.getElementById("usuarioCrearUsuario");
	var avisoUsuario = document.getElementById("avisoUsuarioCrearUsuario");
	if (usuario.value == "") {
		avisoUsuario.style.display="inline";
		avisoUsuario.innerHTML="No puede dejar vacio el usuario";
		return false;
	}else{
		if (!regExp.test(usuario.value) ) {
			avisoUsuario.style.display="inline";
			avisoUsuario.innerHTML="No esta permitido el ingreso de caracteres especiales";
			return false;
		}
	}
// FIN VALIDAR USUARIO

// VALIDAR CONTRASEÑA UNO
	var passwordUno = document.getElementById("passwordCrearUsuario");
	var avisoPasswordUno = document.getElementById("avisoPasswordCrearUsuario");
	if (passwordUno.value == "") {
		avisoPasswordUno.style.display="inline";
		avisoPasswordUno.innerHTML = "No puede dejar vacia la contraseña";
		return false;
	}else{
		if (!regExpPassword.test(passwordUno.value) ) {
			avisoPasswordUno.style.display="inline";
			avisoPasswordUno.innerHTML = "No esta permitido el uso de caracteres especiales/ Debe contener 1 mayuscula, 1 minuscula y 8 caracteres minimo";
			return false;
		}
	}
//FIN VALIDAR CONTRASEÑA UNO

//VALIDAR CONTRASEÑA DOS
	var passwordDos = document.getElementById("repPasswordCrearUsuario");
	var avisoPasswordDos = document.getElementById("avisoRepPasswordCrearUsuario");
	if (passwordDos.value=="") {
		avisoPasswordDos.style.display="inline";
		avisoPasswordDos.innerHTML="No puede dejar vacia la confirmacion de contraseña";
		return false;
	}else{
		if (!regExpPassword.test(passwordDos.value)) {
			avisoPasswordDos.style.display="inline";
			avisoPasswordDos.innerHTML="No esta permitido el uso de caracteres especiales/ Debe contener 1 mayuscula, 1 minuscula y 8 caracteres minimo";
			return false;
		}
	}

//FIN VALIDAR CONTRASEÑA DOS

//VALIDAR QUE AMBAS CONTRASEÑAS COINCIDAN
	if (passwordUno.value != passwordDos.value) {
		avisoPasswordDos.style.display="inline";
		avisoPasswordDos.innerHTML="No coinciden las contraseñas";
		return false;
	}
//FIN VALIDAR QUE AMBAS CONTRASEÑAS COINCIDAN

//VALIDAR EMAIL
	var email = document.getElementById("emailCrearUsuario");
	var avisoEmail = document.getElementById("avisoEmailCrearUsuario");
	if (email.value=="") {
		avisoEmail.style.display="inline";
		avisoEmail.innerHTML="No puede quedar vacio el email";
		return false;
	}else{
		if (!expRegEmail.test(email.value)) {
			avisoEmail.style.display="inline";
			avisoEmail.innerHTML="No esta permitido el uso de caracteres especiales";
			return false;
		}
	}
//FIN VALIDAR EMAIL

//VALIDAR DEPTO
	var depto = document.getElementById("deptoCrearUsuario");
	var avisoDepto = document.getElementById("avisoDeptoCrearUsuario");
	if (depto.value==0) {
		avisoDepto.style.display="inline";
		avisoDepto.innerHTML = "Debe seleccionar un departamento";
		return false;
	}
	if (depto.value=="") {
		avisoDepto.style.display="inline";
		avisoDepto.innerHTML = "Debe seleccionar un departamento";
		return false;
	}
	if (!regExpNum.test(depto.value)) {
		avisoDepto.style.display="inline";
		avisoDepto.innerHTML = "No esta permitido el uso de caracteres especiales";
		return false;
	}
//FIN VALIDAR 

//VALIDAR URL
	var urlFoto = document.getElementById("urlFotoCrearUsuario");
	var avisoUrlFoto = document.getElementById("avisoUrlFotoCrearUsuario");
	if (urlFoto.value=="") {
		avisoUrlFoto.style.display="inline";
		avisoUrlFoto.innerHTML="No puede quedar vacia la url para el avatar";
		return false;
	}else{
			if (!expRegUrl.test(urlFoto.value)) {
			avisoUrlFoto.style.display="inline";
			avisoUrlFoto.innerHTML="No esta permitido el uso de caracteres especiales";
			return false;
		}
	}
//FIN VALIDAR URL

//VALIDAR ROL
	// var usuario = document.getElementById('usuario').checked;
	// var editor = document.getElementById('editor').checked;
	// var admin = document.getElementById('admin').checked;
	// var avisoRol = document.getElementById('avisoRolCrearUsuario');
	// if (usuario=="" && editor=="" && admin=="") {
	// 	avisoRol.style.display="inline";
	// 	avisoRol.innerHTML="Debe Seleccionar un rol";
	// 	return false;
	// }
//FIN VALIDAR ROL

//VALIDAR PREGUNTA SECRETA
	var preguntaSecreta = document.getElementById("preguntaSeguridadCrearUsuario");
	var contenedorAviso = document.getElementById("contenedorAvisoPreguntaSeguridadCrearUsuario");
	var avisoPreguntaSecreta = document.getElementById("avisoPreguntaSeguridadCrearUsuario");
	if (preguntaSecreta.value=="") {
		contenedorAviso.style.display="inline";
		avisoPreguntaSecreta.style.display="inline";
		avisoPreguntaSecreta.innerHTML="No puede quedar vacia la pregunta secreta";
		return false;
	}else{
		if (!expRegNombres.test(preguntaSecreta.value)) {
			contenedorAviso.style.display="inline";
			avisoPreguntaSecreta.style.display="inline";
			avisoPreguntaSecreta.innerHTML="No esta permitido el ingreso de caracteres especiales";
			return false;
		}
	}
//FIN VALIDAR PREGUNTA SECRETA

//VALIDAR RESPUESTA DE SEGURIDAD
	var respuestaSeguridad = document.getElementById("respuestaSeguridadCrearUsuario");
	var avisoRespuestaSeguridad = document.getElementById("avisoRespuestaSeguridadCrearUsuario");
	if (respuestaSeguridad.value=="") {
		avisoRespuestaSeguridad.style.display="inline";
		avisoRespuestaSeguridad.innerHTML="No puede quedar vacia la respuesta de seguridad";
		return false;
	}else{
		if (!expRegNombres.test(respuestaSeguridad.value)) {
			avisoRespuestaSeguridad.style.display="inline";
			avisoRespuestaSeguridad.innerHTML="No esta permitido el ingreso de caracteres especiales";
			return false;
		}
	}
//FIN VALIDAR RESPUESTA DE SEGURIDAD
	return true;
}