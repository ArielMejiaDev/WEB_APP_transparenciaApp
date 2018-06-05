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
                            <?php  
                                if ($datos['rol']!='redactor') {
                                ?>
                            <li><a href="#"><i class="icon mdi mdi-check-all"></i> Validar archivos</a>
                            </li>
                            <li><a href="#"><i class="icon mdi mdi-long-arrow-up"></i> Publicar archivos</a>
                            </li>
                            <?php 
                                }
                            ?>
                          </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="progress-widget">
          <div class="progress-data">
            <span class="progress-value">40</span><span class="name">Archivos Subidos</span>
          </div>
          <div class="progress">
            <div style="width: 40%;" class="progress-bar progress-bar-primary"></div>
          </div>
        </div>
    </div>
</div>