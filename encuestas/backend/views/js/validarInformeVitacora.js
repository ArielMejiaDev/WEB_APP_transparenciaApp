var fechaInicialInforme = document.getElementById('fechaInicialInformeVitacora');
var avisoFechaInicial = document.getElementById('avisoFechaInicialVitacora');
var fechaFinalInforme = document.getElementById('fechaFinalInformeVitacora');
var avisoFechaFinal = document.getElementById('avisoFechaFinalVitacora');
function ocultarCampos()
{
    avisoFechaInicial.style.display="none";
    avisoFechaFinal.style.display="none";
}
function validarInformeVitacora(){
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
