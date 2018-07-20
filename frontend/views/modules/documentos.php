<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<?php 
    $main = new MainController();
    $habilitado = false;
?>
<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title"><?php $main->printNumeralOnScreenController(); ?></h2>
        <ol class="breadcrumb page-head-nav">
            <li><a href="#"><?php echo $_GET['year'] ?></a></li>
            <li><a href="#"><?php echo $_GET['mes'] ?></a></li>
            <li class="active">Alerts</li>
        </ol>
    </div>
	<div class="main-content container-fluid">
		<div class="row">
      <div class="col-sm-12">
      <?php
        $status = $main->evalStatusNumeralController();
        echo $status;
      ?>
      <?php 
        if ($status === '')
        {
      ?>
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-body">
            <div class="col-sm-12">
                <div id="categorias" style="">
                    <h3>Documentos</h3>
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
