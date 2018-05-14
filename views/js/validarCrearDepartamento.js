function validarDepartamentoForm(){
	var depto = document.getElementById('nombreDepartamentoCrearDepto');
	var avisoDepto = document.getElementById('avisoNombreDepartamentoCrearDepto');
	if (!depto.value=="") {
		return true;
	}else{
		avisoDepto.innerHTML="El departamento no puede quedar vacio";
		avisoDepto.style.display="inline";
	}
	return false;
}