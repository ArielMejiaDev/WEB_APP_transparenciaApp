<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<?php 
    $main = new MainController();
?>
<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title"><?php $main->printNumeralOnScreenController($_GET['idNumeral']); ?></h2>
    </div>
	<div class="main-content container-fluid">
		<div class="row">
      <div class="col-sm-12">
      <?php
        
      ?>
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-body">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php $main->printNumeralOnScreenController($_GET['idNumeral']); ?></div>
                    <div class="tab-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#2018" data-toggle="tab" aria-expanded="true">2018</a></li>
                            <li class=""><a href="#2017" data-toggle="tab" aria-expanded="false">2017</a></li>
                            <li class=""><a href="#2016" data-toggle="tab" aria-expanded="false">2016</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="2018" class="tab-pane cont active">
                                <h4>2018</h4>
                                <ul class="nav nav-pills nav-justified">
                                    <li role="presentation" class=""><a href="#"><h4 onclick="mostrar();">Enero</h4> </a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Febrero</h4> </a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Marzo</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Abril</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Mayo</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Junio</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Julio</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Agosto</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Septiembre</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Octubre</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Noviembre</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Diciembre</h4></a></li>
                                </ul>
                            </div>
                            <div id="2017" class="tab-pane cont">
                                <h4>2017</h4>
                                <ul class="nav nav-pills nav-justified">
                                    <li role="presentation" class=""><a href="#"><h4>Enero</h4> </a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Febrero</h4> </a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Marzo</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Abril</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Mayo</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Junio</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Julio</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Agosto</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Septiembre</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Octubre</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Noviembre</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Diciembre</h4></a></li>
                                </ul>
                            </div>
                            <div id="2016" class="tab-pane">
                                <h4>2016</h4>
                                <ul class="nav nav-pills nav-justified">
                                    <li role="presentation" class=""><a href="#"><h4>Enero</h4> </a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Febrero</h4> </a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Marzo</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Abril</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Mayo</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Junio</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Julio</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Agosto</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Septiembre</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Octubre</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Noviembre</h4></a></li>
                                    <li role="presentation" class=""><a href="#"><h4>Diciembre</h4></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="categorias" style="display:none;">
                    <h3>Categorias</h3>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <span class="badge badge-primary">6</span> 
                            <span class="text-primary mdi mdi-info icon"></span>
                            Marco Normativo
                        </a>
                        <a href="#" class="list-group-item">
                            <span class="badge badge-primary">2</span> 
                            <span class="text-primary mdi mdi-info icon"></span>
                            Funciones Depenencias
                        </a>
                        <a href="#" class="list-group-item">
                            <span class="badge badge-primary">10</span> 
                            <span class="text-primary mdi mdi-info icon"></span>
                            Junta Directiva
                        </a>
                        <a href="#" class="list-group-item">
                            <span class="badge badge-primary">5</span> 
                            <span class="text-primary mdi mdi-info icon"></span>
                            General
                        </a>
                        <a href="#" class="list-group-item">
                            <span class="badge badge-primary">4</span>  
                            <span class="text-primary mdi mdi-info icon"></span>
                            Institucional
                        </a>
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
<script>
    function mostrar(){
        var categorias = document.getElementById('categorias');
        categorias.style.display="block";
    }
</script>
