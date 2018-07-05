function validarActivarDoc(){
    var observaciones = document.getElementById('observaciones');
    if (observaciones.value=='') {
        swal({
            type: 'error',
            title: 'Oops...',
            text: 'No puede quedar vacio',
        })
        return false;
    }
    return true;
}