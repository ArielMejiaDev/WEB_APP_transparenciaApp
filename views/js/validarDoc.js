//mandamos por ajax el numeral seleccionado y relizamos un query para ver si existen categorias con el id del numeral seleccionado
var numeral = document.getElementById('idNumeral');
var avisoNumeral = document.getElementById('avisoIdNumeral');
var categoria = document.getElementById('idCategoria');
var avisoCategoria = document.getElementById('avisoIdCategoria');
var formGroupCat = document.getElementById('formGroupCat');
var conexionSubirDoc;
var fecha_doc = document.getElementById("fecha_doc");
var avisoFecha = document.getElementById("avisoFecha");
var doc = document.getElementById("doc");
var avisoDoc = document.getElementById("avisoDoc");
var conexionRevisarExistenciaDoc;
var docExiste = false;
var expRegNum = /^[0-9]*$/;
var expRegDate = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
var expRegPdfFile = '/^.+\.((?:[pP][dD][fF]))$/';
var expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
numeral.addEventListener('change',enviarId,false);
function enviarId(){
    var dato = new FormData();
    dato.append('idNumeral',numeral.value);
    conexionSubirDoc = new XMLHttpRequest();
    conexionSubirDoc.onreadystatechange=respEnviarId;
    conexionSubirDoc.open('POST','views/modules/validarDocAjax.php',true);
    conexionSubirDoc.send(dato);
}
function respEnviarId(){
    if (conexionSubirDoc.readyState==4) {
        if (conexionSubirDoc.status==200) {
            //console.log(conexionSubirDoc.responseText);
            if (conexionSubirDoc.responseText=='No hay') {
                formGroupCat.style.display="none";
                numeral.removeAttribute("name");
                numeral.setAttribute("name","idNumeral2");
                
                fecha_doc.removeAttribute("name");
                fecha_doc.setAttribute("name","fecha_doc2");
                
                doc.removeAttribute("name");
                doc.setAttribute("name","doc2");
            }else{
                formGroupCat.style.display="block";
                numeral.removeAttribute("name");
                numeral.setAttribute("name","idNumeral");
                
                fecha_doc.removeAttribute("name");
                fecha_doc.setAttribute("name","fecha_doc");
                
                doc.removeAttribute("name");
                doc.setAttribute("name","doc");
                categoria.innerHTML = conexionSubirDoc.responseText;
            }
        }else{
            console.log('Cargando ...');
        }
    }
}
doc.addEventListener('change',enviarPdfTitle,false);
function enviarPdfTitle(){
    var pdfTitle = doc.files[0]['name'];
    var data = new FormData();
    data.append('docTitle',pdfTitle);
    conexionRevisarExistenciaDoc = new XMLHttpRequest();
    conexionRevisarExistenciaDoc.onreadystatechange = respEnviarPdfTitle;
    conexionRevisarExistenciaDoc.open('POST','views/modules/validarDocAjax.php',true);
    conexionRevisarExistenciaDoc.send(data);
}
function respEnviarPdfTitle(){
    if (conexionRevisarExistenciaDoc.readyState==4) {
        if (conexionRevisarExistenciaDoc.status==200) {
            console.log(conexionRevisarExistenciaDoc.responseText);
            if (conexionRevisarExistenciaDoc.responseText=='existe') {
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
function validarDoc(){
//VALIDAR NUMERAL
    if (numeral.value!="") {
        avisoNumeral.style.display = "none";
        if (!expRegNum.test(numeral.value)) {
            avisoNumeral.style.display = "inline";
            avisoNumeral.innerHTML = "No esta permitido el uso de caracteres especiales";   
            return false;
        }else{
            avisoNumeral.style.display = "none";
        }
    }else{
        avisoNumeral.style.display = "inline";
        avisoNumeral.innerHTML = "No puede quedar vacio";   
        return false;
    }
//FIN VALIDAR NUMERAL
//VALIDAR CATEGORIA
    if (!expRegNum.test(categoria.value)) {
        avisoCategoria.style.display = "inline";
        avisoCategoria.innerHTML = "No esta permitido el uso de caracteres especiales";   
        return false;
    }else{
        avisoCategoria.style.display = "none";
    }

//FIN VALIDAR CATEGORIA
//VALIDAR FECHA
    if (fecha.value!="") {
        avisoFecha.style.display="none";
        if (!expRegDate.test(fecha.value)) {
            avisoFecha.style.display="inline";
            avisoFecha.innerHTML = "No esta permitido el uso de caracteres especiales";
            return false;
        }else{
            avisoFecha.style.display="none";
        }
    }else{
        avisoFecha.style.display="inline";
        avisoFecha.innerHTML = "No puede quedar vacio";
        return false;

    }
//FIN VALIDAR FECHA
//VALIDAR DOC CON JS
    if (doc.value!="") {
        avisoDoc.style.display = "none";
    }else{
        avisoDoc.style.display = "inline";
        avisoDoc.innerHTML = "No puede quedar vacio";
        return false;
    }
//FIN VALIDAR DOC CON JS
//VALIDAR DOC CON AJAX
    if (docExiste) {
        return false;
    }
//FIN VALIDAR DOC CON AJAX
    return true;
}
