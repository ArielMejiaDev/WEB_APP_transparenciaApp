<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
?> 
<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<?php 
$dashboard = new DashboardController();
?>
<div class="be-content">
	<div class="main-content container-fluid">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
        <div class="widget widget-tile">
          <div id="spark1" class="chart sparkline"></div>
          <div class="data-info">
            <div class="desc">Usuarios</div>
            <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end=" <?php $dashboard->contarUsuariosController(); ?> " class="number">0</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="widget widget-tile">
          <div id="spark2" class="chart sparkline"></div>
          <div class="data-info">
            <div class="desc">Docs publicados</div>
            <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="<?php $dashboard->contarDocsPublicadosController(); ?>" class="number">0</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="widget widget-tile">
          <div id="spark3" class="chart sparkline"></div>
          <div class="data-info">
            <div class="desc">Doc aprobados</div>
            <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span data-toggle="counter" data-end="<?php $dashboard->contarDocsAprobadosController(); ?>" class="number">0</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3">
        <div class="widget widget-tile">
          <div id="spark4" class="chart sparkline"></div>
          <div class="data-info">
            <div class="desc">Docs Reprobados</div>
            <div class="value"><span class="indicator indicator-negative mdi mdi-chevron-down"></span><span data-toggle="counter" data-end="<?php $dashboard->contarDocsRechazadosController(); ?>" class="number">0</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- <div class="col-md-12">
        <div class="widget widget-fullwidth be-loading">
          <div class="widget-head">
            <div class="tools">
              <div class="dropdown"><span data-toggle="dropdown" class="icon mdi mdi-more-vert visible-xs-inline-block dropdown-toggle"></span>
                <ul role="menu" class="dropdown-menu">
                  <li><a href="#">Week</a></li>
                  <li><a href="#">Month</a></li>
                  <li><a href="#">Year</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Today</a></li>
                </ul>
              </div><span class="icon mdi mdi-chevron-down"></span><span class="icon toggle-loading mdi mdi-refresh-sync"></span><span class="icon mdi mdi-close"></span>
            </div>
            <div class="button-toolbar hidden-xs">
              <div class="btn-group">
                <button type="button" class="btn btn-default">Week</button>
                <button type="button" class="btn btn-default active">Month</button>
                <button type="button" class="btn btn-default">Year</button>
              </div>
              <div class="btn-group">
                <button type="button" class="btn btn-default">Today</button>
              </div>
            </div><span class="title">Recent Movement</span>
          </div>
          <div class="widget-chart-container">
            <div class="widget-chart-info">
              <ul class="chart-legend-horizontal">
                <li><span data-color="main-chart-color1"></span> Purchases</li>
                <li><span data-color="main-chart-color2"></span> Plans</li>
                <li><span data-color="main-chart-color3"></span> Services</li>
              </ul>
            </div>
            <div class="widget-counter-group widget-counter-group-right">
              <div class="counter counter-big">
                <div class="value">25%</div>
                <div class="desc">Purchase</div>
              </div>
              <div class="counter counter-big">
                <div class="value">5%</div>
                <div class="desc">Plans</div>
              </div>
              <div class="counter counter-big">
                <div class="value">5%</div>
                <div class="desc">Services</div>
              </div>
            </div>
            <div id="main-chart" style="height: 260px;"></div>
          </div>
          <div class="be-spinner">
            <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
              <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
            </svg>
          </div>
        </div>
      </div> -->
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-default panel-table">
          <div class="panel-heading"> 
            <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
            <div class="title">Docs subidos recientemente</div>
          </div>
          <div class="panel-body table-responsive">
            <table class="table table-striped table-borderless table-hover">
              <thead>
                <tr>
                  <th style="width:40%;">Usuario</th>
                  <th class="number">N</th>
                  <th style="width:20%;">Fecha</th>
                  <th style="width:20%;">Status</th>
                  <th style="width:5%;" class="actions"></th>
                </tr>
              </thead>
              <tbody class="no-border-x">
              <?php 
                $dashboard->docsSubidosRecientesController();
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
            <div class="title">Vitacora</div>
          </div>
          <div class="panel-body table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th style="width:37%;">Usuario</th>
                  <th style="width:36%;">Actividad</th>
                  <th>Fecha</th>
                  <th class="actions"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="user-avatar"> <img src="views/images/avatar6.png" alt="Avatar">Erick Contreras</td>
                  <td>Subio un documento</td>
                  <td>Jun 16, 2018</td>
                  <td class="actions"><a href="#" class="icon"><i class="mdi mdi-assignment-account"></i></a></td>
                </tr>
                <tr>
                  <td class="user-avatar"> <img src="views/images/user.png" alt="Avatar">Admin</td>
                  <td>Creo un nuevo usuario</td>
                  <td>Jun 17, 2018</td>
                  <td class="actions"><a href="#" class="icon"><i class="mdi mdi-assignment-account"></i></a></td>
                </tr>
                <tr>
                  <td class="user-avatar"> <img src="views/images/avatar5.png" alt="Avatar">Jefe de RRHH</td>
                  <td>Aprobo un documento</td>
                  <td>Jun 15, 2018</td>
                  <td class="actions"><a href="#" class="icon"><i class="mdi mdi-assignment-account"></i></a></td>
                </tr>
                <tr>
                  <td class="user-avatar"> <img src="views/images/avatar5.png" alt="Avatar">Sub jefe de RRHH</td>
                  <td>Rechazo un documento</td>
                  <td>Jun 16, 2018</td>
                  <td class="actions"><a href="#" class="icon"><i class="mdi mdi-assignment-account"></i></a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


