<?php
$dashboard = new DashboardController();
?>
<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Menu</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">Menu</li>
                        <li class="active">
                            <a href="dashboard"><i class="icon mdi mdi-home"></i><span>Escritorio</span>
                            </a>
                        </li>
                        <?php 
                            if ($datos['rol']=='admin') {
                            ?>
                        <li class="parent"><a href="#"><i class="icon mdi mdi-account-circle"></i><span>Usuarios</span></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="crearUsuario"><i class="icon mdi mdi-account-add"></i> Crear usuario</a>
                                </li>
                                <li>
                                    <a href="listarUsuarios"><i class="icon mdi mdi-accounts"></i> Lista de usuarios</a>
                                </li>
                            </ul>
                        </li>
                        <li class="parent"><a href="#"><i class="icon mdi mdi-layers"></i><span>Departamentos</span></a>
                          <ul class="sub-menu">
                            <li><a href="crearDepartamento"><i class="icon mdi mdi-plus-circle"></i> Crear Depto</a>
                                <li><a href="listarDepartamentos"><i class="icon mdi mdi-plus-circle-o-duplicate"></i> Lista Departamentos</a>
                            </li>
                          </ul>
                        </li>
                        <li class="parent"><a href="#"><i class="icon mdi mdi-view-module"></i><span> Númerales</span></a>
                          <ul class="sub-menu">
                            <li><a href="crearNumerales"><i class="icon mdi mdi-collection-plus"></i> Crear Númeral</a>
                            </li>
                            <li><a href="listarNumerales"><i class="icon mdi mdi-collection-text"></i> Listar numeral</a>
                            </li>
                            <li><a href="crearCategoria"><i class="icon mdi mdi-plus-circle"></i> Crear categoria</a>
                            </li>
                            <li><a href="listarCategorias"><i class="icon mdi mdi-plus-circle-o-duplicate"></i> Listar categoria</a>
                            </li>
                          </ul>
                        </li>
                        <?php
                            }
                        ?>
                        <li class="parent"><a href="#"><i class="icon mdi mdi-collection-text"></i><span>Archivos</span></a>
                          <ul class="sub-menu">
                            <li><a href="subirArchivos"><i class="icon mdi mdi-cloud-upload"></i> Subir archivos</a>
                            </li>
                            <li><a href="listarArchivosSubidosGeneral"><i class="icon mdi mdi-collection-text"></i> Listar archivos General</a>
                            </li>
                            <?php  
                                if ($datos['rol']!='redactor' && $datos['rol']!='jefeRedaccion' && $datos['rol']!='editor') {
                                ?>
                            <li>
                                <a href="activarArchivos"><i class="icon mdi mdi-check-all"></i> Activar extemporaneos</a>
                            </li>
                            <?php 
                                }
                            ?>
                          </ul>
                        </li>
                        <?php  
                            if ($datos['rol']=='editor' || $datos['rol']=='admin') {
                        ?>
                            <li class="parent"><a href="#"><i class="icon mdi mdi-print"></i><span>Informes</span></a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="informes"><i class="icon mdi mdi-collection-pdf"></i> Informes Docs</a>
                                    </li>
                                    <?php  
                                        if ($datos['rol']=='admin') {
                                    ?>
                                    <li>
                                        <a href="informesVitacora"><i class="icon mdi mdi-collection-pdf"></i> Informes Vitacora</a>
                                    </li>
                                    <?php 
                                        }
                                    ?>
                                </ul>
                            </li>
                        <?php 
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="progress-widget">
          <div class="progress-data">
            <span class="progress-value"><?php echo $dashboard->totalDocsServidorController();?></span><span class="name">Archivos Subidos</span>
          </div>
          <div class="progress">
            <div style="width: <?php echo $dashboard->totalDocsServidorController();?>%;" class="progress-bar progress-bar-primary"></div>
          </div>
        </div>
    </div>
</div>