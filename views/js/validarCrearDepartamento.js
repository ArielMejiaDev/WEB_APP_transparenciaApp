var depto = document.getElementById('nombreDepartamentoCrearDepto');
var avisoDepto = document.getElementById('avisoNombreDepartamentoCrearDepto');
var deptoExistente = false;
var expRegNombres = /^(?![ .]+$)[a-zA-Z .]*$/;
var regExp=/^[a-zA-Z0-9]*$/;
depto.addEventListener('blur',obtenerDepto,false);
function obtenerDepto(){
	var datoDepto = depto.value;
	enviarParametro(datoDepto);
}
var conexionDepto;
function enviarParametro(datoDepto){
	var dato = new FormData();
	dato.append('depto',datoDepto);
	conexionDepto = new XMLHttpRequest();
	conexionDepto.onreadystatechange=respAjaxDepto;
	conexionDepto.open('POST',"views/modules/validacionCrearDepartamentoAjax.php",true);
	conexionDepto.send(dato);
}
function respAjaxDepto(){
	if (conexionDepto.readyState==4) {
		if (conexionDepto.status==200) {
			console.log(conexionDepto.responseText);
			if (conexionDepto.responseText=="existe") {
				deptoExistente=true;
			 	avisoDepto.innerHTML="El departamento ya existe!";
			 	avisoDepto.style.display="inline";
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'El departamento ya existe',
				})
			}else{
				avisoDepto.style.display="none";
			}
		}
	}else{
		console.log("Cargando...");
	}
}
//valida el submit en el formulario
function validarDepartamentoForm(){
	var deptoValor = depto.value;
	

	if (deptoValor=="") {
		avisoDepto.innerHTML="El departamento no puede quedar vacio";
		avisoDepto.style.display="inline";
		return false;
	}

	if (!expRegNombres.test(deptoValor)) {
		avisoDepto.innerHTML="No es valido el uso de caracteres especiales";
		avisoDepto.style.display="inline";
		return false;
	}

	if (deptoExistente) {
		return false;
	}


	return true;
}