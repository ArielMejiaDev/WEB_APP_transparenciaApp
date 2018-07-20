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
                    <div class="list-group" id="agregarLinks">
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
    var conexionCategorias;
    for (let index = 0; index < meses.length; index++) {
        meses[index].addEventListener('click',enviarNumeralAñoMes,false);
        
    }
    function enviarNumeralAñoMes(e)
    {
        e.preventDefault();
		var idNumeral = e.target.getAttribute('idNumeral');
        var year = e.target.getAttribute('year');
        var mes = e.target.getAttribute('mes');
        //alert('click en el numeral con id: '+idNumeral+' del año: '+year+' en el mes de: '+mes);
        datos = new FormData();
        datos.append('idNumeral',idNumeral);
        datos.append('year',year);
        datos.append('mes',mes);
        conexionCategorias = new XMLHttpRequest();
        conexionCategorias.onreadystatechange = respEnviarNumeralAñoMes;
        conexionCategorias.open('POST','views/modules/ajaxModule.php',true);
        conexionCategorias.send(datos);
    }
    function respEnviarNumeralAñoMes()
    {
        if (conexionCategorias.readyState==4)
        {
            if (conexionCategorias.status==200)
            {
                console.log(conexionCategorias.responseText);
                var links = document.getElementById('agregarLinks');
                categorias = document.getElementById('categorias');
                categorias.style.display="block";
                links.innerHTML = conexionCategorias.responseText; 
            }    
        }
    }
</script>
