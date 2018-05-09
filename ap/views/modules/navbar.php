<?php  
$user = $_SESSION['usuario'];
$datosUsuario = new DatosUsuarioController();
$datos = $datosUsuario->getDatosUsuarioController();
?>
<nav class="navbar navbar-default navbar-fixed-top be-top-header">
  <div class="container-fluid">
    <div class="navbar-header"><a href="index.php" class="navbar-brand"></a></div>
    <div class="be-right-navbar">
      <ul class="nav navbar-nav navbar-right be-user-nav">
        <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="<?php echo $datos['foto']; ?>" alt="Avatar"><span class="user-name"><?php echo $user; ?></span></a>
          <ul role="menu" class="dropdown-menu">
            <li>
              <div class="user-info">
                <div class="user-name"><?php echo $user; ?></div>
                <div class="user-position online">En línea</div>
              </div>
            </li>
            <li><a href="#"><span class="icon mdi mdi-face"></span> Cuenta</a></li>
            <li><a href="#"><span class="icon mdi mdi-settings"></span> Ajustes</a></li>
            <li><a href="index.php?action=cerrarSesion"><span class="icon mdi mdi-power"></span> Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
      <div class="page-title"><span>Transparencia App</span></div>
      <ul class="nav navbar-nav navbar-right be-icons-nav">
        <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon mdi mdi-notifications"></span><span class="indicator"></span></a>
          <ul class="dropdown-menu be-notifications">
            <li>
              <div class="title">Notificaciones<span class="badge">3</span></div>
              <div class="list">
                <div class="be-scroller">
                  <div class="content">
                    <ul>
                      <li class="notification notification-unread"><a href="#">
                          <div class="image"><img src="views/images/avatar2.png" alt="Avatar"></div>
                          <div class="notification-info">
                            <div class="text"><span class="user-name">Karen Celada</span> Subió un archivo.</div><span class="date">hace 2 minutos</span>
                          </div></a></li>
                      <li class="notification"><a href="#">
                          <div class="image"><img src="views/images/avatar3.png" alt="Avatar"></div>
                          <div class="notification-info">
                            <div class="text"><span class="user-name">Joel García</span> Subió un archivo.</div><span class="date">hace 1 dia</span>
                          </div></a></li>
                      <li class="notification"><a href="#">
                          <div class="image"><img src="views/images/avatar4.png" alt="Avatar"></div>
                          <div class="notification-info">
                            <div class="text"><span class="user-name">Pedro Picapiedra</span> is watching your main repository</div><span class="date">hace 2 dias</span>
                          </div></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="footer"> <a href="#">Ver todas las notificaciones</a></div>
            </li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon mdi mdi-apps"></span></a>
          <ul class="dropdown-menu be-connections">
            <li>
              <div class="list">
                <div class="content">
                  <div class="row">
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="views/images/github.png" alt="Github"><span>GitHub</span></a></div>
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="views/images/bitbucket.png" alt="Bitbucket"><span>Bitbucket</span></a></div>
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="views/images/slack.png" alt="Slack"><span>Slack</span></a></div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="views/images/dribbble.png" alt="Dribbble"><span>Dribbble</span></a></div>
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="views/images/mail_chimp.png" alt="Mail Chimp"><span>Mail Chimp</span></a></div>
                    <div class="col-xs-4"><a href="#" class="connection-item"><img src="views/images/dropbox.png" alt="Dropbox"><span>Dropbox</span></a></div>
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