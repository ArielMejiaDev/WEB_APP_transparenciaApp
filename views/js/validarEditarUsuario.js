//VALIDACION AJAX PARA USUARIO
	var usuarioAjax = document.getElementById('usuarioEditarUsuario');
	var idAjax = document.getElementById('idEditarUsuario');
	usuarioAjax.addEventListener('blur',enviarIdAjax,false);
	var conexionValIdEditarUsuarioAjax;
	var conexionValUsuarioEditarUsuarioAjax;
	var usuarioExiste=false;
//FIN VALIDACION AJAX PARA USUARIO
//VALIDACION AJAX EMAIL
	var emailAjax = document.getElementById('emailEditarUsuario');
	emailAjax.addEventListener('blur',enviarIdMailAjax,false);
	var conexionValIdMailEditarUsuarioAjax;
//FIN VALIDACION AJAX EMAIL
function enviarIdMailAjax(){
	var data = new FormData();
	data.append('idEditarUsuarioMail',idAjax.value);
	conexionValIdMailEditarUsuarioAjax = new XMLHttpRequest();
	conexionValIdMailEditarUsuarioAjax.onreadystatechange = respEnviarIdMailAjax;
	conexionValIdMailEditarUsuarioAjax.open('POST','views/modules/validacionCrearUsuarioAjax.php',true);
	conexionValIdMailEditarUsuarioAjax.send(data);
}
function respEnviarIdMailAjax(){
	if (conexionValIdMailEditarUsuarioAjax.readyState==4) {
		if (conexionValIdMailEditarUsuarioAjax.status==200) {
			console.log(conexionValIdMailEditarUsuarioAjax.responseText);
			if (emailAjax.value!=conexionValIdMailEditarUsuarioAjax.responseText) {
				enviarMailAjax();
			}
		}else{
			console.log('Cargando...');
		}
	}
}
function enviarMailAjax(){
	alert('buscar si existe alguna coincidencia en la bd');
}

function enviarIdAjax(){
	var data = new FormData();
	data.append('idEditarUsuario',idAjax.value);
	conexionValIdEditarUsuarioAjax = new XMLHttpRequest();
	conexionValIdEditarUsuarioAjax.onreadystatechange = respAjaxenviarUsuarioAjax;
	conexionValIdEditarUsuarioAjax.open('POST','views/modules/validacionCrearUsuarioAjax.php',true);
	conexionValIdEditarUsuarioAjax.send(data);
}
function respAjaxenviarUsuarioAjax(){
	if (conexionValIdEditarUsuarioAjax.readyState==4) {
		if (conexionValIdEditarUsuarioAjax.status==200) {
			console.log(conexionValIdEditarUsuarioAjax.responseText);
			if (usuarioAjax.value!=conexionValIdEditarUsuarioAjax.responseText) {
				enviarUsuarioAjax();
			}
		}else{
			console.log('Cargando...');
		}
	}
}
function enviarUsuarioAjax(){
	var data = new FormData();
	data.append('usuarioEditarUsuario',usuarioAjax.value);
	conexionValIdEditarUsuarioAjax = new XMLHttpRequest();
	conexionValIdEditarUsuarioAjax.onreadystatechange = respAjaxenviarUsuario;
	conexionValIdEditarUsuarioAjax.open('POST','views/modules/validacionCrearUsuarioAjax.php',true);
	conexionValIdEditarUsuarioAjax.send(data);
}
function respAjaxenviarUsuario(){
	if (conexionValIdEditarUsuarioAjax.readyState==4) {
		if (conexionValIdEditarUsuarioAjax.status==200) {
			console.log(conexionValIdEditarUsuarioAjax.responseText);
			if (conexionValIdEditarUsuarioAjax.responseText=='existe') {
				usuarioExiste = true;
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'El usuario ya existe',
				})
			}else{
				usuarioExiste = false;
			}
		}
	}
}

function validarEditarUsuario(){
	var expRegNombres = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
	// var expRegNombres = /^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/;
	var regExp=/^[a-zA-Z0-9]*$/;
	var regExpPassword= /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/;
	var expRegEmail =/^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
	var regExpNum = /[1-4]/g;
	var expRegUrl = /([a-zA-Z]:(\\w+)*\\[a-zA-Z0_9]+)?.png|jpg/;
// VALIDAR EDICION DE USUARIO
	var usuario = document.getElementById("nombresEditarUsuario");
	var avisoUsuario = document.getElementById("avisoNombresEditarUsuario");
	
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
	var apellidos = document.getElementById("apellidosEditarUsuario");
	var avisoApellidos = document.getElementById("avisoApellidosEditarUsuario");
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
	var usuario = document.getElementById("usuarioEditarUsuario");
	var avisoUsuario = document.getElementById("avisoUsuarioEditarUsuario");
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
	var passwordUno = document.getElementById("passwordEditarUsuario");
	var avisoPasswordUno = document.getElementById("avisoPasswordEditarUsuario");
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
	var passwordDos = document.getElementById("repPasswordEditarUsuario");
	var avisoPasswordDos = document.getElementById("avisoRepPasswordEditarUsuario");
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
	var email = document.getElementById("emailEditarUsuario");
	var avisoEmail = document.getElementById("avisoEmailEditarUsuario");
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
	var depto = document.getElementById("deptoEditarUsuario");
	var avisoDepto = document.getElementById("avisoDeptoEditarUsuario");
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
	var urlFoto = document.getElementById("urlFotoEditarUsuario");
	var avisoUrlFoto = document.getElementById("avisoUrlFotoEditarUsuario");
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

//INICIO DE SCRIPT VALIDANDO CONFIRMACION DE ROL
	var redactor = document.getElementById('redactor').checked;
	var jefeRedaccion = document.getElementById('jefeRedaccion').checked;
	var editor = document.getElementById('editor').checked;
	var admin = document.getElementById('admin').checked;
	avisoPassword2.style.display="none";
	avisoPassword.style.display="none";
	alertaApellidos.style.display="none";
	alertaNombres.style.display="none";
	avisoUsuario.style.display="none";
	avisoEmail.style.display="none";
   	avisoDepto.style.display="none";
	var avisorol = document.getElementById('avisoRolEditarUsuario');
	if ( (redactor=="") && (jefeRedaccion=="") && (editor =="") && (admin=="") ) {
	  	avisorol.innerHTML="Por favor elija un rol para el usuario";
  		avisorol.style.display="inline";
  		return false;
	}
//FIN DE SCRIPT VALIDANDO CONFIRMACION DE ROL

//VALIDAR PREGUNTA SECRETA
	var preguntaSecreta = document.getElementById("preguntaSeguridadEditarUsuario");
	var contenedorAviso = document.getElementById("contenedorAvisoPreguntaSeguridadEditarUsuario");
	var avisoPreguntaSecreta = document.getElementById("avisoPreguntaSeguridadEditarUsuario");
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
	var respuestaSeguridad = document.getElementById("respuestaSeguridadEditarUsuario");
	var avisoRespuestaSeguridad = document.getElementById("avisoRespuestaSeguridadEditarUsuario");
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

//VALIDACION DE USUARIO CON AJAX
	if (usuarioExiste) {
		return false;
	}
//FIN VALIDACION DE USUARIO CON AJAX
	return true;
}