//mandamos por ajax el numeral seleccionado y relizamos un query para ver si existen categorias con el id del numeral seleccionado
var numeral = document.getElementById('idNumeral');
var categoria = document.getElementById('idCategoria');
var formGroupCat = document.getElementById('formGroupCat');
var conexionSubirDoc;
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
            }else{
                formGroupCat.style.display="block";
                categoria.innerHTML = conexionSubirDoc.responseText;
            }
        }else{
            console.log('Cargando ...');
        }
    }
}