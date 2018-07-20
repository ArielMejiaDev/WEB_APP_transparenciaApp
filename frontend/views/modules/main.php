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
        if ($status==='')
        {
        
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
        <?php
        } 
        ?>
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
<!-- SCRIPT PARA MANDAR AJAX PARA CARGAR CATEGORIAS -->
<script src="views/js/ajaxMain.js"></script>
