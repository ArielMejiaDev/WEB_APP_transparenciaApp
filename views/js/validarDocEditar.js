var numeralEditar = document.getElementById('idNumeralEditar');
avisoNumeralEditar = document.getElementById('avisoIdNumeralEditar');
categoriaEditar = document.getElementById('idCategoriaEditar');
avisoCategoriaEditar = document.getElementById('avisoIdCategoriaEditar');
fechaEditar = document.getElementById('fecha_docEditar');
avisoFechaEditar = document.getElementById('avisoFechaEditar');
documentoEditar = document.getElementById('docEditar');
avidoDocumentoEditar = document.getElementById('avisoDocEditar');
expRegNum = /^[0-9]*$/;
expRegPdf = /^.+\.((?:[pP][dD][fF]))$/;
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

    if (categoriaEditar.value == "") {
        avisoCategoriaEditar.innerHTML = "No puede quedar vacio";
        avisoCategoriaEditar.style.display = "inline";
        return false;
    }else{
        if (!expRegNum.test(categoriaEditar.value)) {
            avisoCategoriaEditar.innerHTML = "No esta permitido el uso de caracteres especiales";
            avisoCategoriaEditar.style.display = "inline";
            return false;
        }
    }

    if (fechaEditar.value == "") {
        avisoFechaEditar.innerHTML = "No puede quedar vacio";
        avisoFechaEditar.style.display = "inline";
        return false;
    }
    
    return true;
}