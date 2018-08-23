<?php
$listarNum = new SidebarController();
?>
<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Menu</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        <li class="divider">Menu</li>
                            <?php
                                $listarNum->listarNumeralesController();
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>