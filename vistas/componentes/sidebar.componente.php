<aside class="main-sidebar elevation-4 sidebar-light-danger">
    <!-- Brand Logo -->
    <a href="<?php echo $url ?>" class="brand-link">
        <img src="<?php echo $url ?>vistas/img/plantilla/ifixit_x.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
            <img src="<?php echo $url ?>vistas/img/plantilla/ifixit.png" width="80" alt="">
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2 ">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <div class="image text-center d-md-none">
                    <img src="<?php echo $_SESSION["foto"] ?>" class="img-circle elevation-3" width="65" alt="">
                </div>
                <li class="nav-item has-treeview d-md-none">
                    <a href="#" class="nav-link">

                        <i class="nav-icon fas fa-id-card-alt"></i>
                        <p class="text-danger">
                            <?php echo $_SESSION["usuario"] ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>

                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="<?php echo $url ?>mi-perfil" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mi perfil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Notificaciones</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="<?php echo $url ?>salir" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Salir</p>
                            </a>
                        </li>

                    </ul>

                </li>


                <?php
                if ($_SESSION['perfil'] == 'Administrador') {
                    $app->getComponents('menu-admin');
                } elseif ($_SESSION['perfil'] == 'Vendedor') {
                    $app->getComponents('menu-vendedor');
                } elseif ($_SESSION['perfil'] == 'Tecnico') {
                    $app->getComponents('menu-tecnico');
                }
                ?>









            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>