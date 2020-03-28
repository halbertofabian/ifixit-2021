<aside class="main-sidebar elevation-4 sidebar-light-danger">
    <!-- Brand Logo -->
    <a href="<?php  echo $url ?>" class="brand-link">
        <img src="<?php echo $url ?>vistas/img/plantilla/ifixit_x.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
            <img src="<?php echo $url ?>vistas/img/plantilla/ifixit.png" width="80" alt="">
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <div class="image text-center d-md-none">
                    <img src="<?php echo $_SESSION["foto"] ?>" class="img-circle elevation-3" width="65" alt="User Image">
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
                        <li class="nav-item">
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
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>salir" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Salir</p>
                            </a>
                        </li>

                    </ul>

                </li>







                <li class="nav-item has-treeview">
                    <a href="<?php echo $url ?>mi-web" class="nav-link">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Mi web
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $url ?>mi-web" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Configuración</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>slide" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sliders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Servicios</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $url ?>configuraciones" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Personalizar
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $url ?>api" class="nav-link">
                        <i class="nav-icon fa fa-cubes"></i>
                        <p>
                            Mi API
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $url ?>usuarios" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Usuarios
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $url ?>categorias" class="nav-link">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Categorías
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $url ?>productos" class="nav-link">
                        <i class="nav-icon fa fa-cart-plus"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $url ?>intercambios" class="nav-link">
                        <i class="nav-icon fa fa-truck text-primary"></i>
                        <p>
                            Intercambio de inventario
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $url ?>caja" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Caja
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Gestión
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $url ?>corte" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Corte de caja</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>ingresos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ingresos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>egresos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gatos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>movimientos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Movimientos</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?php echo $url ?>clientes" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Clientes
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?php echo $url ?>cotizaciones" class="nav-link">
                        <i class="nav-icon fas fa-money-check-alt"></i>
                        <p>
                            Cotizaciones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $url ?>cotizaciones" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear cotización</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>lista-cotizaciones" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lista de cotizaciones</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon  fab  fa-opencart"></i>
                        <p>
                            Pedidos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $url ?>pedidos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear pedido</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>lista-pedidos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lista de pedidos</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon  fa fa-wrench"></i>
                        <p>
                            Servicios
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $url ?>servicios" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear servicio</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>entregas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lista de servicios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>agregar-servicio" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear servicio precargado</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="<?php echo $url ?>ventas" class="nav-link">
                        <i class="nav-icon  fas fa-shopping-cart"></i>
                        <p>
                            Ventas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $url ?>ventas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Administrar ventas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>crear-venta" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Crear venta</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $url ?>reportes" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reporte de ventas</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="<?php echo $url ?>domicilio" class="nav-link">
                        <i class="nav-icon fas fa-shipping-fast"></i>
                        <p>
                            Servicio a domicilio
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $url ?>renovar" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>
                            Renovar cuenta
                        </p>
                    </a>
                </li>




            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>