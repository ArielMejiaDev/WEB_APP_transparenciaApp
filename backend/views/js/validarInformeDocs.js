var statusInforme = document.getElementById('statusInforme');
var avisoStatusInforme = document.getElementById('avisoStatusInforme');
var fechaInicialInforme = document.getElementById('fechaInicialInforme');
var avisoFechaInicial = document.getElementById('avisoFechaInicial');
var fechaFinalInforme = document.getElementById('fechaFinalInforme');
var avisoFechaFinal = document.getElementById('avisoFechaFinal');
function ocultarCampos()
{
    avisoStatusInforme.style.display="none";
    avisoFechaInicial.style.display="none";
    avisoFechaFinal.style.display="none";
}
function validarInformeDocs(){
    if (statusInforme.value == '') {
        ocultarCampos();
        avisoStatusInforme.style.display="inline";
        avisoStatusInforme.innerHTML = "Seleccione un status";
        return false;
    }
    if (statusInforme.selectedIndex=="") {
        ocultarCampos();
        avisoStatusInforme.style.display="inline";
        avisoStatusInforme.innerHTML = "Seleccione un status";
        return false;
    }
    if (fechaInicialInforme.value=="") {
        ocultarCampos();
        avisoFechaInicial.style.display="inline";
        avisoFechaInicial.innerHTML = "Seleccione una fecha para iniciar le rango";
        return false;
    }
    if (fechaFinalInforme.value=="") {
        ocultarCampos();
        avisoFechaFinal.style.display="inline";
        avisoFechaFinal.innerHTML = "Seleccione una fecha para finalizar el rango";
        return false;
    }
    return true;
}
