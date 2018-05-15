var depto = document.getElementById('nombreDepartamentoCrearDepto');
var avisoDepto = document.getElementById('avisoNombreDepartamentoCrearDepto');
var deptoExistente = false;
depto.addEventListener('blur',obtenerDepto,false);
function obtenerDepto(){
	var datoDepto = depto.value;
	enviarParametro(datoDepto);
}
var conexion;
function enviarParametro(datoDepto){
	var dato = new FormData();
	dato.append('depto',datoDepto);
	conexion = new XMLHttpRequest();
	conexion.onreadystatechange=respAjax;
	conexion.open('POST',"views/modules/validacionCrearDepartamentoAjax.php",true);
	conexion.send(dato);
}
function respAjax(){
	if (conexion.readyState==4) {
		if (conexion.status==200) {
			console.log(conexion.responseText);
			if (conexion.responseText=="existe") {
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
	if (!depto.value=="") {
		return true;
	}else{
		avisoDepto.innerHTML="El departamento no puede quedar vacio";
		avisoDepto.style.display="inline";
	}
	if (deptoExistente) {
			return false;
		}
	return false;
}