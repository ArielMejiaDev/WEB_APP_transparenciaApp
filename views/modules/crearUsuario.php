<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
?>  
<div class="be-wrapper be-fixed-sidebar">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
          	<?php include_once "views/modules/header.php"; ?>
        	<?php include_once "views/modules/sidebar.php"; ?>
        	<div class="row">
	            <div class="col-md-12">
	              <div class="panel panel-default panel-border-color panel-border-color-primary">
	                <div class="panel-heading panel-heading-divider"><i class="icon mdi mdi-account-add"></i> Crear Usuario<span class="panel-subtitle">Crea una nueva cuenta de usuario.</span></div>
	                <div class="panel-body">
	                  <form action="#" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
	                    <div class="form-group">
	                      <label class="col-sm-3 control-label" for="nombres">Nombres</label>
	                      <div class="col-sm-6">
	                        <input type="text" class="form-control" id="nombres" name="nombres">
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-sm-3 control-label" for="apellidos">Apellidos</label>
	                      <div class="col-sm-6">
	                        <input type="text" class="form-control" id="apellidos" name="apellidos">
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-sm-3 control-label" for="usuario">Usuario</label>
	                      <div class="col-sm-6">
	                        <input type="text" class="form-control" id="usuario" name="usuario">
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-sm-3 control-label" for="password">Password</label>
	                      <div class="col-sm-6">
	                        <input type="text" class="form-control" id="password" name="password">
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-sm-3 control-label" for="repPassword">Repita password</label>
	                      <div class="col-sm-6">
	                        <input type="text" class="form-control" id="repPassword" name="repPassword">
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-sm-3 control-label" for="email">Email</label>
	                      <div class="col-sm-6">
	                        <input type="text" class="form-control" id="email" name="email">
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-sm-3 control-label" for="urlFoto">Url Foto</label>
	                      <div class="col-sm-6">
	                        <input type="text" class="form-control" id="urlFoto" name="urlFoto">
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-sm-3 control-label">Rol</label>
	                      <div class="col-sm-6">
	                        <div class="be-radio inline">
	                          <input type="radio" name="rol" id="rol1">
	                          <label for="rol1">Usuario</label>
	                        </div>
	                        <div class="be-radio inline">
	                          <input type="radio" name="rol" id="rol2">
	                          <label for="rol2">Editor</label>
	                        </div>
	                        <div class="be-radio inline">
	                          <input type="radio" name="rol" id="rol3">
	                          <label for="rol3">Admin</label>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-sm-3 control-label" for="preguntaSeguridad">Escribe tu pregunta de seguridad</label>
	                      <div class="col-sm-6">
	                        <div class="input-group xs-mb-15"><span class="input-group-addon">¿</span>
	                          <input type="text" class="form-control" id="preguntaSeguridad" name="preguntaSeguridad"><span class="input-group-addon">?</span>
	                        </div>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label class="col-sm-3 control-label" for="respuestaSeguridad">Escribe tu respuesta de seguridad</label>
	                      <div class="col-sm-6">
	                        <input type="text" class="form-control" id="respuestaSeguridad" name="respuestaSeguridad">
	                      </div>
	                    </div>
	                  </form>
	                </div>
	              </div>
	            </div>
          	</div>
      	</div>
    </div>
  </div>
</div>