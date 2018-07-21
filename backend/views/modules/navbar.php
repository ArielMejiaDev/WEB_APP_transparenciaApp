<?php  
$user = $_SESSION['usuario'];
$datosUsuario = new DatosUsuarioController();
$datos = $datosUsuario->getDatosUsuarioController();
$notificaciones = new NotificacionesController();

if (isset($_GET['action'])) {
  //validar ingerso en crear usuarios
    if ($_GET['action']=='crearUsuario') {
        if ($datos['rol']!='admin') {
          header('Location:index.php');
        }
    }
  //fin validar ingerso en crear usuarios

  //validar ingreso en listar usuarios
    if ($_GET['action']=='listarUsuarios') {
      if ($datos['rol']!='admin') {
          header('Location:index.php');
        }
    }
  //fin validar ingreso en listar usuarios

  //validar ingreso en crear numerales
    if ($_GET['action']=='crearNumerales') {
      if ($datos['rol']!='admin') {
          header('Location:index.php');
        }
    }
  //fin validar ingreso en crear numerales

  //validar ingreso en listar numerales
    if ($_GET['action']=='listarNumerales') {
      if ($datos['rol']!='admin') {
          header('Location:index.php');
        }
    }
  //fin validar ingreso en listar numerales  

  //validar ingreso en crear departamentos
    if ($_GET['action']=='crearDepartamento') {
      if ($datos['rol']!='admin') {
          header('Location:index.php');
        }
    }
  //fin validar ingreso en crear departamentos

  //validar ingreso en listar departamentos
    if ($_GET['action']=='listarDepartamentos') {
      if ($datos['rol']!='admin') {
          header('Location:index.php');
        }
    }
  //fin validar ingreso en listar departamentos

  //validar ingreso en agregarReglaNumeral
    if ($_GET['action']=='agregarReglaNumeral') {
      if ($datos['rol']!='admin') {
          header('Location:index.php');
        }
    }
  //fin validar ingreso en agregarReglaNumeral

  //validar ingreso en crearCategoria
    if ($_GET['action']=='crearCategoria') {
      if ($datos['rol']!='admin') {
          header('Location:index.php');
        }
    }
  //fin validar ingreso en crearCategoria  

  //validar ingreso en editarCategoria
    if ($_GET['action']=='editarCategoria') {
      if ($datos['rol']!='admin') {
          header('Location:index.php');
        }
    }
  //fin validar ingreso en editarCategoria

  //validar ingreso en agregarReglaCategoria
    if ($_GET['action']=='agregarReglaCategoria') {
      if ($datos['rol']!='admin') {
          header('Location:index.php');
        }
    }
  //fin validar ingreso en agregarReglaCategoria

  //validar ingreso en agregarReglaCategoria
    if ($_GET['action']=='listarCategorias') {
      if ($datos['rol']!='admin') {
          header('Location:index.php');
        }
    }
  //fin validar ingreso en agregarReglaCategoria

  //validar ingreso en agregarReglaCategoria
  if ($_GET['action']=='activarArchivos') {
    if ($datos['rol']!='admin') {
        header('Location:index.php');
      }
  }
  //fin validar ingreso en agregarReglaCategoria    


  //SUBIR ARCHIVOS NO PORQUE TODOS VAN A PODER SUBIR ARCHIVOS
  
}
?>
<nav class="navbar navbar-default navbar-fixed-top be-top-header">
  <div class="container-fluid">
    <div class="navbar-header"><a href="index.html" class="navbar-brand"></a></div>
    <div class="be-right-navbar">
      <ul class="nav navbar-nav navbar-right be-user-nav">
        <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="<?php echo $datos['foto'];?>" alt="Avatar"><span class="user-name"><?php echo $user;?></span></a>
          <ul role="menu" class="dropdown-menu">
            <li>
              <div class="user-info">
                <div class="user-name"><?php echo $user;?></div>
                <div class="user-position online">En línea</div>
              </div>
            </li>
            <li><a href="#"><span class="icon mdi mdi-face"></span> Cuenta</a></li>
            <li><a href="#"><span class="icon mdi mdi-settings"></span> Ajustes</a></li>
            <li><a href="cerrarSesion"><span class="icon mdi mdi-power"></span> Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
      <div class="page-title"><span>Escritorio</span></div>
      <ul class="nav navbar-nav navbar-right be-icons-nav">
        <!-- <li class="dropdown"><a href="#" role="button" aria-expanded="false" class="be-toggle-right-sidebar"><span class="icon mdi mdi-settings"></span></a></li> -->
        <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>
          <ul class="dropdown-menu be-notifications">
            <li>
            <?php
              $notificacionesDocsSubidos = $notificaciones->totalNotificacionesSubidasController((int)$datos['id']);
              $totalNot = $notificacionesDocsSubidos;
            ?>
              <div class="title">Notificaciones<span class="badge"><?php echo $totalNot; ?></span></div>
              <div class="list">
                <div class="be-scroller">
                  <div class="content">
                    <ul id="NotificationsDiv" userId="<?php echo (int)$datos['id']; ?>">
                    
                    </ul>
                  </div>
                </div>
              </div>
              <div class="footer"> <a href="listarArchivosSubidosGeneral">Ver todas las notificaciones</a></div>
            </li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon mdi mdi-apps"></span></a>
          <ul class="dropdown-menu be-connections">
            <li>
              <div class="list">
                <div class="content">
                  <div class="row">
                    <div class="col-xs-4"><a target="_blank" href="https://www.ipm.org.gt/situ" class="connection-item"><img src="views/images/situ.png" alt="SITU"><span>SITU</span></a></div>
                    <div class="col-xs-4"><a target="_blank" href="https://www.ipm.org.gt/sag" class="connection-item"><img src="views/images/sie.png" alt="SIE"><span>SIE</span></a></div>
                    <div class="col-xs-4"><a target="_blank" href="index.php" class="connection-item"><img src="views/images/sip.png" alt="SIP"><span>SIP</span></a></div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4"><a target="_blank" href="https://www.ipm.org.gt" class="connection-item"><img src="views/images/portal.png" alt="Portal IPM"><span>Portal IPM</span></a></div>
                    <div class="col-xs-4"><a target="_blank" href="https://sistema.ipm.org.gt" class="connection-item"><img src="views/images/sistemaIPM.png" alt="Sistema IPM"><span>Sistema IPM</span></a></div>
                  </div>
                </div>
              </div>
              <div class="footer"> <a href="#">Mas</a></div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<script>
addEventListener('load',loadNotifications,false);
setInterval(function(){loadNotifications() ; }, 60000);
var connNot;
var idDiv = document.getElementById("NotificationsDiv");
id = idDiv.getAttribute("userId");
function loadNotifications(){

  //alert('id: '+id);
  dato = new FormData();
  dato.append('idUsuarioNotificaciones',id);
  connNot = new XMLHttpRequest();
  connNot.onreadystatechange = respLoadNotifications;
  connNot.open("POST","views/modules/ajaxNotifications.php",true);
  connNot.send(dato);
}
function respLoadNotifications(){
  if (connNot.readyState==4) {
    if (connNot.status==200) {
      idDiv.innerHTML = connNot.responseText;
    }
  }
}
</script>