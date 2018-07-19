<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<?php 
    $main = new MainController();
    $habilitado = false;
?>
<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title"><?php $main->printNumeralOnScreenController(); ?></h2>
    </div>
	<div class="main-content container-fluid">
		<div class="row">
      <div class="col-sm-12">
      <?php
        $status = $main->evalStatusNumeralController();
        echo $status;
        //var_dump($status);
      ?>
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-body">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><?php $main->printNumeralOnScreenController(); ?></div>
                    <div class="tab-container">
                        <ul class="nav nav-tabs">
                        <?php
                            if ($status =='')
                            {
                                $main->renderTabsController($_GET['idNumeral']);
                            }
                            
                        ?>
                        </ul>
                        <div class="tab-content">
                        <?php
                            if ($status =='')
                            {
                                $main->renderContentTabsController($_GET['idNumeral']);
                            }
                            
                        ?>
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
<!-- SCRIPT PARA MANDAR AJAX PARA CARGAR CATEGORIAS -->
<script>
    var meses = document.getElementsByClassName("mes");
    for (let index = 0; index < meses.length; index++) {
        meses[index].addEventListener('click',capturarDatosMeses,false);
        
    }
    function capturarDatosMeses(e)
    {
        e.preventDefault();
		var idNumeral = e.target.getAttribute('idNumeral');
        var year = e.target.getAttribute('year');
        var mes = e.target.getAttribute('mes');
        alert('click en el numeral con id: '+idNumeral+' del año: '+year+' en el mes de: '+mes);
    }
</script>
