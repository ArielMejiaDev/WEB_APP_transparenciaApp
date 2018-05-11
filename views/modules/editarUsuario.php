<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$editarUsuario = new UsuariosController();

if (isset($_GET['not'])) {
  if ($_GET['not']=='success') {
    echo "  <script>
          swal({
            position: 'top-end',
            type: 'success',
            title: 'Usuario grabado exitosamente!',
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
                <?php $editarUsuario->crearFormEditarUsuarioController(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>