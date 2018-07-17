function validarActivarDoc(){
    var observaciones = document.getElementById('observaciones');
    var avisoObservaciones = document.getElementById('avisoObservaciones');
    if (observaciones.value=='') {
        swal({
            type: 'error',
            title: 'Oops...',
            text: 'No puede quedar vacio',
        })
        avisoObservaciones.style.display = "inline";
        avisoObservaciones.innerHTML="No puede quedar vacio";
        return false;
    }
    return true;
}