<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<?php 
$dashboard = new DashboardController();
?>
<div class="be-content">
	<div class="main-content container-fluid">
		<div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-body">
            <div class="col-sm-12">
              <div class="panel panel-default">
                <div class="panel-heading">Transparencia</div>
                <div class="tab-container">
                  <ul class="nav nav-tabs">
                    <li class=""><a target="_blank" href="https://www.ipm.org.gt/" style="cursor: pointer"><span class="icon mdi mdi-home"></span> Inicio</a></li>
                    <li class=""><a href="#decreto" data-toggle="tab" aria-expanded="false"><span class="icon mdi mdi-book"></span>Decreto 29-2016</a></li>
                    <li class=""><a href="#solicitud" data-toggle="tab" aria-expanded="false"><span class="icon mdi mdi-edit"></span>Solicitud</a></li>
                    <li class="active"><a href="#contacto" data-toggle="tab" aria-expanded="true"><span class="icon mdi mdi-email"></span>contacto</a></li>
                  </ul>
                  <div class="tab-content">
                    <div id="contacto" class="tab-pane cont active">
                      <p class="text-center"><img src="views/images/favicon.ico" alt=""></p>
                      <p class="text-center">INSTITUTO DE PREVISIÓN MILITAR</p>
                      <p class="text-center">LEY DE ACCESO A LA INFORMACIÓN PÚBLICA</p>
                      <p class="text-center"> Cualquier información adicional a la publicada en este sitio, puede solicitarla a la Unidad de Información Pública del IPM, llamando al teléfono 23054900 ó por medio de correo electrónico a la dirección</p>
                      <p class="text-center"><strong>transparencia@ipm.org.gt</strong></p>
                    </div>
                    <div id="decreto" class="tab-pane cont">
                      <h2>Decreto 29-2016</h2>
                      <p class="text-center">DECRETO 29-2016 – (LEY DE READECUACIÓN PRESUPUESTARIA)</p>
                      <p class="text-center">Decreto Ley para la viabilización de la ejecución presupuestaria y sustitución de fuentes de financiamiento al presupuesto general de ingresos y egresos del Estado para el ejercicio fiscal 2016; y disposiciones para la profesionalización y carrera pública administrativa;</p>
                    </div>
                    <div id="solicitud" class="tab-pane">
                      <form>
                          <div class="form-group xs-pt-10">
                              <label>Nombre Completo (Obligatorio)</label>
                              <input type="text" placeholder="Ingrese su nombre completo" class="form-control">
                          </div>
                          <div class="form-group xs-pt-5">
                              <label>Dpi (Obligatorio)</label>
                              <input type="text" placeholder="Ingrese su Dpi" class="form-control">
                          </div>
                          <div class="form-group xs-pt-5">
                              <label>Persona Juridica (Opcional)</label>
                              <input type="text" placeholder="Ingrese el nombre de la persona juridica" class="form-control">
                          </div>
                          <div class="form-group xs-pt-10">
                              <label>Genero</label><br>
                              <label class="radio-inline">
                                <input type="radio" name="genero" checked="true">Masculino
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="genero">Femenino
                              </label>
                          </div>
                          <div class="form-group xs-pt-10">
                              <label>Teléfono (Opcional 1.)</label>
                              <input type="text" placeholder="Ingrese un número de teléfono" class="form-control">
                          </div>
                          <div class="form-group xs-pt-10">
                              <label>Teléfono (Opcional 2.)</label>
                              <input type="text" placeholder="Ingrese otro número de teléfono" class="form-control">
                          </div>
                          <div class="form-group xs-pt-10">
                              <label>Correo Electrónico (Obligatorio)</label>
                              <input type="email" placeholder="ingrese su correo electronico" class="form-control">
                          </div>
                          <div class="form-group xs-pt-10">
                              <label>Dirección para recibir notificaciones (Obligatorio)</label>
                              <input type="text" placeholder="ingrese una direccion para notificarle" class="form-control">
                          </div>
                          <div class="form-group xs-pt-10">
                              <label>DESCRIPCIÓN DEL DOCUMENTO O INFORMACIÓN SOLICITADA:</label>
                              <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                          </div>
                          <div class="form-group xs-pt-10">
                              <label>FORMA EN LA QUE DESEA SE LE ENTREGUE LA INFORMACIÓN:</label><br>
                              <label class="radio-inline">
                                <input type="checkbox" name="optradio" checked="true"> Copia en medio digital
                              </label>
                              <label class="radio-inline">
                                <input type="checkbox" name="optradio"> Envío por correo electrónico
                              </label>
                              <label class="radio-inline">
                                <input type="checkbox" name="optradio"> Copia simple
                              </label>
                              <label class="radio-inline">
                                <input type="checkbox" name="optradio"> Copia certificada
                              </label>
                          </div>
                          <div class="col-xs-6">
                              <p class="text-right">
                                  <button type="submit" class="btn btn-space btn-primary">Enviar</button>
                              </p>
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
    </div>
    <div class="row">
    </div>
    <div class="row">
      <div class="col-md-6">
      </div>
      <div class="col-md-6">
      </div>
    </div>
  </div>
</div>


