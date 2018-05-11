//sugerir usuario
var usuario = document.getElementById('usuarioCrearUsuario');
usuario.addEventListener('focus',sugerirUsuario,false);
function sugerirUsuario(){
	var nombreUsuario = document.getElementById('nombresCrearUsuario').value;
	var inicial = nombreUsuario.charAt(0).toLowerCase();

	var apellidoUsuario = document.getElementById('apellidosCrearUsuario').value;
	var stringArray = apellidoUsuario.split(" ");


	var usuarioSugerido = inicial+stringArray[0];


	// validar si el apellido es "de"
	if (stringArray[0]=="de") {
		var usuarioSugerido = inicial+stringArray[0]+stringArray[1];
	}

	// validar si el apellido es "del"
	if (stringArray[0]=="del") {
		var usuarioSugerido = inicial+stringArray[0]+stringArray[1];
	}

	// validar si el apellido es "de"
	if (stringArray[1]=="la") {
		var usuarioSugerido = inicial+stringArray[0]+stringArray[1]+stringArray[2];
	}
	
	

	var usuario = document.getElementById('usuarioCrearUsuario');
	usuario.value=usuarioSugerido.toLowerCase();

}


//SUGERIR EMAIL
var sugerenciaEmail = document.getElementById('emailCrearUsuario');
sugerenciaEmail.addEventListener('focus',sugerirEmail,false);

function sugerirEmail(){
	var sugerenciaEmail = document.getElementById('emailCrearUsuario');
	var sugerenciaUsuario = document.getElementById('usuarioCrearUsuario').value;
	var dominio = "@ipm.org.gt";
	sugerenciaEmail.value=sugerenciaUsuario+dominio;
}

//VALIDACION DE EXISTENCIA DE USUARIO EN EL FORM DE CREAR USUARIO CON AJAX
var usuario = document.getElementById('usuarioCrearUsuario');
var usuarioExistente = false;
usuario.addEventListener('blur',obtenerUsuario,false);
var conexion;
function obtenerUsuario(){
	console.log(usuario.value);
	var datos = new FormData();
	datos.append("usuario",usuario.value);
	conexion = new XMLHttpRequest();
	conexion.onreadystatechange=respAjax;
	conexion.open("POST","views/modules/validacionCrearUsuarioAjax.php",true);
	conexion.send(datos);
}
function respAjax(){
	if (conexion.readyState==4) {
		if (conexion.status==200) {
			//console.log(conexion.responseText);
			if (conexion.responseText=="existe") {
				usuarioExistente=true;
				var avisoUsuario = document.getElementById('avisoUsuarioCrearUsuario');
			 	avisoUsuario.innerHTML="El usuario ya existe!";
			 	avisoUsuario.style.display="inline";
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'El usuario ya existe',
				})
			}else{
				var avisoUsuario = document.getElementById('avisoUsuarioCrearUsuario');
				avisoUsuario.style.display="none";
			}
		}
	}else{
		console.log("Cargando...");
	}
}
//FIN DE VALIDACION DE EXISTENCIA DE USUARIO CON AJAX








//VALIDACION DE EMAIL REPETIDO CON AJAX EN EL FORM DE CREAR USUARIO
var emailValidar = document.getElementById('emailCrearUsuario');
emailValidar.addEventListener('blur',enviarEmail,false);
var emailExistente=false;
var conexion;
function enviarEmail(){
	//console.log(emailValidar.value);
	var datosEmail = new FormData();
	datosEmail.append("email",emailValidar.value);
	conexion = new XMLHttpRequest();;
	conexion.onreadystatechange=respEmailAjax;
	conexion.open("POST","views/modules/validacionCrearUsuarioAjax.php",true);
	conexion.send(datosEmail);
}
function respEmailAjax(){
	if (conexion.readyState==4) {
		if (conexion.status==200) {
			if (conexion.responseText=="existe") {
				//console.log(conexion.responseText);
				emailExistente=true;
				var avisoEmail = document.getElementById('avisoEmailCrearUsuario');
			 	avisoEmail.innerHTML="El email ya existe!";
			   	avisoEmail.style.display="inline";
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'El email ya existe',
				})
			}else{
				var avisoEmail = document.getElementById('avisoEmailCrearUsuario');
			   	avisoEmail.style.display="none";
			}
		}
	}
}
// FIN VALIDACION DE EMAIL REPETIDO CON AJAX EN EL FORM DE CREAR USUARIO








// VALIDACION DEL PASSWORD
function validarPassword(){
	/**
	 *
	 * VALIDANDO NOMBRES
	 *
	 */
	
	var nombres = document.getElementById('nombresCrearUsuario').value;
	if (nombres!="") {
		var caracteresNombres = nombres.length;
		var expRegNombres = /^(?![ .]+$)[a-zA-Z .]*$/;
		var regExp=/^[a-zA-Z0-9]*$/;
		var alertaNombres = document.getElementById('avisoNombresCrearUsuario');
		alertaNombres.style.display="none";

		var alertaApellidos = document.getElementById('avisoApellidosCrearUsuario');
		alertaApellidos.style.display="none";

		if (!expRegNombres.test(nombres)) {
			var alertaNombres = document.getElementById('avisoNombresCrearUsuario');
			alertaNombres.innerHTML="No estan permitidos caracteres especiales";
			alertaNombres.style.display="inline";
			return false;
		}
	}else{
		var alertaNombres = document.getElementById('avisoNombresCrearUsuario');
		alertaNombres.innerHTML="No puede quedar vacio";
		alertaNombres.style.display="inline";
		return false;
	}

	/**
	 *
	 * FIN DE VALIDACION DE NOMBRES
	 *
	 */
	

	/**
	 *
	 * VALIDACION APELLIDOS
	 *
	 */


	var apellidos = document.getElementById('apellidosCrearUsuario').value;
	if (apellidos!="") {
		var caracteresApellidos = apellidos.length;
		
		var alertaNombres = document.getElementById('avisoNombresCrearUsuario');
		alertaNombres.style.display="none";

		var alertaApellidos = document.getElementById('avisoApellidosCrearUsuario');
		alertaApellidos.style.display="none";

		if (!expRegNombres.test(apellidos)) {
		alertaApellidos.innerHTML="No estan permitidos los caracteres especiales";
		alertaApellidos.style.display="inline";
		return false;
		}

	}else{
		alertaApellidos.innerHTML="No puede quedar vacio";
		alertaApellidos.style.display="inline";
		return false;
	}

	/**
	 *
	 * FIN DE VALIDAR APELLIDOS
	 *
	 */
	



	/**
	 *
	 * VALIDAR USUARIO SIN AJAX
	 *
	 */


	 var usuario = document.getElementById('usuarioCrearUsuario').value;
	 if (usuario!="") {
	 	var avisoUsuario = document.getElementById('avisoUsuarioCrearUsuario');
	 	avisoUsuario.style.display="none";

	 	var alertaNombres = document.getElementById('avisoNombresCrearUsuario');
		alertaNombres.style.display="none";

		var alertaApellidos = document.getElementById('avisoApellidosCrearUsuario');
		alertaApellidos.style.display="none";

	 	if (!regExp.test(usuario)) {
	 		var avisoUsuario = document.getElementById('avisoUsuarioCrearUsuario');
		 	avisoUsuario.innerHTML="No estan permitidos los caracteres especiales";
		 	avisoUsuario.style.display="inline";
		 	return false;
	 	}
	 }else{
	 	var avisoUsuario = document.getElementById('avisoUsuarioCrearUsuario');
	 	avisoUsuario.innerHTML="No se puede quedar vacio";
	 	avisoUsuario.style.display="inline";
	 	return false;
	 }

	 /**
	  *
	  * FIN DE VALIDAR USUARIO SIN AJAX
	  *
	  */


	  /**
	   *
	   * VALIDACION PASSWORD
	   *
	   */
	  
	 
	   var password1 = document.getElementById('passwordCrearUsuario').value;
	   var avisoPassword = document.getElementById('avisoPasswordCrearUsuario');
	   var regExpPassword= /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/;
	   avisoPassword.style.display="none";
	   alertaApellidos.style.display="none";
	   alertaNombres.style.display="none";
	   avisoUsuario.style.display="none";

	   if (password1!="") {
	   		var caracteresPassword1 = password1.length;
	   		if (caracteresPassword1<8) {
	   			avisoPassword.innerHTML="Se require un minimo de 8 digitos para la contraseña";
		   		avisoPassword.style.display="inline";
		   		return false;
	   		}
	   		if (!regExpPassword.test(password1)) {
	   			avisoPassword.innerHTML="No estan permitidos los caracteres especiales";
		   		avisoPassword.style.display="inline";
		   		return false;
	   		}
	   }else{
	   		avisoPassword.innerHTML="No se puede quedar vacio";
	   		avisoPassword.style.display="inline";
	   		return false;
	   }


	 /**
	  *
	  * FIN VALIDACION PASSWORD
	  *
	  */

	  /**
	   *
	   * VALIDACION DE CONFIRMACION DE PASSWORD
	   *
	   */
	  
	   var password2 = document.getElementById('repPasswordCrearUsuario').value;
	   var avisoPassword2 = document.getElementById('avisoRepPasswordCrearUsuario');

	   avisoPassword2.style.display="none";
	   avisoPassword.style.display="none";
	   alertaApellidos.style.display="none";
	   alertaNombres.style.display="none";
	   avisoUsuario.style.display="none";
	   if (password2!="") {
	   	
	   		var caracteresPassword2 = password2.length;
	   		if (caracteresPassword2<8) {
	   			avisoPassword2.innerHTML="Se require un minimo de 8 digitos para la contraseña";
		   		avisoPassword2.style.display="inline";
		   	 	return false;
	   		}
	   		if (!regExpPassword.test(password2)) {
	   			avisoPassword2.innerHTML="No estan permitidos los caracteres especiales";
		   		avisoPassword2.style.display="inline";
		   	 	return false;
	   		}
	   		if (password1!==password2) {
	   			avisoPassword2.innerHTML="No coinciden las contraseñas";
		   		avisoPassword2.style.display="inline";
		   	 	return false;
	   		}
	   }else{
	   	 	avisoPassword2.innerHTML="No se puede quedar vacio";
	   		avisoPassword2.style.display="inline";
	   	 	return false;
	   }

	  /**
	   *
	   * FIN DE VALIDACION DE CONFIRMACION DE PASSWORD
	   *
	   */



	   /**
	    *
	    * VALIDACION DEL EMAIL
	    *
	    */
	   	

	   	var email = document.getElementById('emailCrearUsuario').value;
	   	var avisoEmail = document.getElementById('avisoEmailCrearUsuario');
	   	var expRegEmail =/^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
	   	if (email!="") {
	   		if (!expRegEmail.test(email)) {
	   			avisoEmail.innerHTML="Debe ingrear un email valido";
		   		avisoEmail.style.display="inline";
		   		return false;
	   		}
	   	}else{
	   		avisoEmail.innerHTML="No puede quedar vacio";
	   		avisoEmail.style.display="inline";
	   		return false;
	   	}
	  	

	  	/**
	  	 *
	  	 * FIN VALIDACION DEL EMAIL
	  	 *
	  	 */



	  	 /**
	  	  *
	  	  * VALIDACION DEL ROL
	  	  *
	  	  */
	  	 
	  	  var rol = document.getElementsByClassName('radioButton');
	  	  var avisorol = document.getElementById('avisoRolCrearUsuario');
	  	  for (var i = 0; i < rol.length; i++) {
	  	  	if (rol[i].checked) {
	  	  		return true;
	  	  	}else{
	  	  		avisorol.innerHTML="Por favor elija un rol para el usuario";
	  	  		avisorol.style.display="inline";
	  	  		return false;
	  	  	}
	  	  }

	  	  /**
	  	   *
	  	   * FIN DE VALIDACION DEL ROL
	  	   *
	  	   */
	  	  



	  	/**
	  	 *
	  	 * VALIDACION DE PREGUNTA SECRETA
	  	 *
	  	 */
	  	
	  	

	  	var preguntaSecreta = document.getElementById('preguntaSeguridadCrearUsuario').value;
	  	var avisoPreguntaSecreta = document.getElementById('avisoPreguntaSeguridadCrearUsuario');
	  	var contenedor = document.getElementById('contenedorAvisoPreguntaSeguridadCrearUsuario');
	  	avisoPreguntaSecreta.style.display="none";
	  	contenedor.style.display="none";
	  	if (preguntaSecreta!="") {

	  	}else{
	  		avisoPreguntaSecreta.innerHTML="No puede quedar vacio";
	  		avisoPreguntaSecreta.style.display="inline";
	  		contenedor.style.display="inline";
	  		return false;
	  	}



	  	/**
	  	 *
	  	 * FIN VALIDACION DE PREGUNTA SECRETA
	  	 *
	  	 */


	  	 /**
	  	  *
	  	  * VALIDAR RESPUESTA SECRETA
	  	  *
	  	  */
	  	 
	  	
		var respuestaSecreta = document.getElementById('respuestaSeguridadCrearUsuario').value;
		var avisoRespuestaSecreta = document.getElementById('avisoRespuestaSeguridadCrearUsuario');
		if (respuestaSecreta!="") {

		}else{
			avisoRespuestaSecreta.innerHTML="No puede quedar vacio";
			avisoRespuestaSecreta.style.display="inline";
			return false;
		}


	  	/**
	  	 *
	  	 * FIN VALIDAR RESPUESTA SECRETA
	  	 *
	  	 */
	  	
	  	/**
	  	 *
	  	 * VALIDAR QUE NO EXISTA USUARIOS REPETIDOS CON AJAX PARA BLOQUEAR SUBMIT
	  	 *
	  	 */

	  	 if (usuarioExistente) {
	  	 	return false;
	  	 }


	  	 /**
	  	  *
	  	  * FIN DE VALIDAR USUARIOS REPETIDOS CON AJAX PARA BLOQUEAR EL SUBMIT
	  	  *
	  	  */
	  	 
	  	
	 	/**
	 	 *
	 	 * VALIDAR QUE NO EXISTA EMAIL REPETIDOS CON AJAX PARA BLOQUEAR SUBMIT
	 	 *
	 	 */
	 	

	 	if (emailExistente) {
	  	 	return false;
	  	 }

	  	/**
	  	 *
	  	 * FIN DE VALIDAR QUE NO EXISTA EMAIL REPETIDOS CON AJAX SUBMIT
	  	 *
	  	 */
	  	
	

	return true;
}