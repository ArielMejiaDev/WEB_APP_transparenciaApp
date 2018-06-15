var numeralEditar = document.getElementById('idNumeralEditar');
avisoNumeralEditar = document.getElementById('avisoIdNumeralEditar');
expRegNum = /^[0-9]*$/;
function validarDocEditar(){
    if (numeralEditar.value == "") {
        avisoNumeralEditar.innerHTML = "No puede quedar vacio";
        avisoNumeralEditar.style.display = "inline";
        return false;
    }else{
        if (!expRegNum.test(numeralEditar.value)) {
            avisoNumeralEditar.innerHTML = "No esta permitido el uso de caracteres especiales";
            avisoNumeralEditar.style.display = "inline";
            return false;
        }
    }
    return true;
}