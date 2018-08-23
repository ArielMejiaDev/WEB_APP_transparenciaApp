
function validarPassword(){
	var nuevoPass = document.getElementById('nuevoPassword').value;
	var confPass = document.getElementById('repitePassword').value;
	if (nuevoPass!=""&&confPass!="") {
		var nuevoPass = document.getElementById('nuevoPassword').value;
		var confPass = document.getElementById('repitePassword').value;
		if (nuevoPass != confPass) {
			var alerta = document.getElementById('validarPassword');
			alerta.style.display="block";
		}else{
			var alerta = document.getElementById('validarPassword');
			alerta.style.display="none";
		}
	}
}

function validarPassword2(){
	var nuevoPass = document.getElementById('nuevoPassword').value;
	var confPass = document.getElementById('repitePassword').value;
	if (nuevoPass!=""&&confPass!="") {
		var nuevoPass = document.getElementById('nuevoPassword').value;
		var confPass = document.getElementById('repitePassword').value;
		if (nuevoPass != confPass) {
			return false;
			var alerta = document.getElementById('validarPassword');
			alerta.style.display="block";
		}else{
			var alerta = document.getElementById('validarPassword');
			alerta.style.display="none";
			return true;
		}
	}
}