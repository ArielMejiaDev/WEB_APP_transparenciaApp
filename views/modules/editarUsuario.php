<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$editarUsuario = new UsuariosController();
$editarUsuario->actualizarUsuarioController();
if (isset($_GET['not'])) {
  if ($_GET['not']=='success') {
    echo "  <script>
          swal({
            position: 'top-end',
            type: 'success',
            title: 'Usuario editado exitosamente!',
            showConfirmButton: false,
            timer: 1500
          })
        </script>";
  }
}
include_once "navbar.php";
include_once "sidebar.php";
?>
<div class="be-wrapper be-fixed-sidebar">
  <div class="be-content">
    <div class="main-content container-fluid">   
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-heading panel-heading-divider"><i class="icon mdi mdi-edit"></i> Editar Usuario<span class="panel-subtitle">Edita la cuenta de un usuario.</span></div>
            <div class="panel-body">
                <?php $editarUsuario->crearFormEditarUsuarioController(); 
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
addEventListener('load',inicializarEventos,false);
function inicializarEventos(){
  // var select = document.getElementById('deptoCrearUsuario');
  // var opt ='<option value="1">Informatica</option><option value="2">UDAF</option>';
  // select.innerHTML+=opt;
  obtenerOptions();
}
var conexion;
function obtenerOptions(){
  var dato = new FormData;
  dato.append('tabla','departamentos');
  conexion = new XMLHttpRequest();
  conexion.onreadystatechange=respAjaxCargarOptions;
  conexion.open('POST','views/modules/cargarOptionsDeptosAjax.php',true);
  conexion.send(dato);
}
function respAjaxCargarOptions(){
  if (conexion.readyState==4) {
    if (conexion.status==200) {
      var select = document.getElementById('deptoEditarUsuario');
      var opt = conexion.responseText;
      select.innerHTML+=opt;
      //console.log(opt);
    }
  }else{
    console.log('Cargando ...');
  }
}
//FORMAS DE INCORPORAR UN OPTION *OJO PODRIA USARSE XML O JSON PERO LA IDEA ES QUE SE CONSUMAN SOLO EN HTML*
  // FORMA 1. AGREGANDO EXCLUSIVAMENTE LOS VALORES AL OBJETO.

  // opt = document.createElement('option');
  //     opt.value = "informatica";
  //     opt.innerHTML = 1;
  //     select.appendChild(opt);

  // opt = document.createElement('option');
  //     opt.value = "UDAF";
  //     opt.innerHTML = 2;
  //     select.appendChild(opt);

  // FORMA 2. AGREGANDO UN CICLO PARA VARIOS OBJETOS.
  // var min = 1,
  //     max = 3,
  //     select = document.getElementById('deptoCrearUsuario');

  // for (var i = min; i<=max; i++){
    //     var opt = document.createElement('option');
    //     opt.value = i;
    //     opt.innerHTML = i;
    //     select.appendChild(opt);

    // LA FORMA SELECCIONADA  DIFIERE UN POCO RECIBE UN AJAX CON EL OPTION YA EN HTML
    // Y UNICAMENTE LO AGREGA AL SELECT COMO HTML

  // }
// FIN DE COMENTARIOS
</script>