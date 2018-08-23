var numeralEditar = document.getElementById('idNumeralEditar');
avisoNumeralEditar = document.getElementById('avisoIdNumeralEditar');
categoriaEditar = document.getElementById('idCategoriaEditar');
avisoCategoriaEditar = document.getElementById('avisoIdCategoriaEditar');
fechaEditar = document.getElementById('fecha_docEditar');
avisoFechaEditar = document.getElementById('avisoFechaEditar');
documentoEditar = document.getElementById('docEditar');
avidoDocumentoEditar = document.getElementById('avisoDocEditar');
formGroup = document.getElementById('formGroupCatEditar');
idDoc = document.getElementById('idDoc');
expRegNum = /^[0-9]*$/;
expRegPdf = /^.+\.((?:[pP][dD][fF]))$/;
var conexionEditarDoc;
numeralEditar.addEventListener('change',enviarNumeralEditarId,false);
function enviarNumeralEditarId(){
    var dato = new FormData();
    dato.append('idNumeral',numeralEditar.value);
    conexionEditarDoc = new XMLHttpRequest();
    conexionEditarDoc.onreadystatechange=respEnviarNumeralEditarId;
    conexionEditarDoc.open('POST','views/modules/validarDocAjax.php',true);
    conexionEditarDoc.send(dato);
}
function respEnviarNumeralEditarId(){
    if (conexionEditarDoc.readyState==4) {
        if (conexionEditarDoc.status==200) {
            console.log(conexionEditarDoc.responseText);
            if (conexionEditarDoc.responseText=='No hay') {
                formGroup.style.display="none";
                numeralEditar.removeAttribute('name');
                numeralEditar.setAttribute('name','idNumeralEditarSinCat');

                fechaEditar.removeAttribute('name');
                fechaEditar.setAttribute('name','fecha_docEditarSinCat');

                documentoEditar.removeAttribute('name');
                documentoEditar.setAttribute('name','docEditarSinCat');
            }else{
                formGroup.style.display = "block";
                categoriaEditar.innerHTML = conexionEditarDoc.responseText;

                numeralEditar.removeAttribute('name');
                numeralEditar.setAttribute('name','idNumeralEditar');

                fechaEditar.removeAttribute('name');
                fechaEditar.setAttribute('name','fecha_docEditar');

                documentoEditar.removeAttribute('name');
                documentoEditar.setAttribute('name','docEditar');
            }
        }
    }
}
documentoEditar.addEventListener('change',valExistPdf,false);
var conexionValExistPdfEditar;
function valExistPdf(){
    var pdfTitleEditar = documentoEditar.files[0]['name'];
    dato = new FormData();
    dato.append('pdfTitleEditar',pdfTitleEditar);
    dato.append('idDoc',idDoc.value);
    conexionValExistPdfEditar = new XMLHttpRequest();
    conexionValExistPdfEditar.onreadystatechange = respValExistPdf;
    conexionValExistPdfEditar.open('POST','views/modules/validarDocAjax.php',true);
    conexionValExistPdfEditar.send(dato);
}
function respValExistPdf(){
    if (conexionValExistPdfEditar.readyState==4) {
        if (conexionValExistPdfEditar.status==200) {
            console.log(conexionValExistPdfEditar.responseText);
            if (conexionValExistPdfEditar.responseText=='existe') {
                docExiste = true;
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'El documento ya existe en el sistema',
                })
            }else{
                docExiste = false;
            }
        }
    }
}
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