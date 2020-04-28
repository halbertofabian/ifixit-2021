<!-- <li class="nav-item has-treeview">
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
                </li> -->
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-cog"></i>
        <p>
            Personalizar
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?php echo $url ?>textos" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Personalizar mensajes</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class=" nav-icon  fas fa-dolly-flatbed"></i>
        <p>
            Inventario
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- <li class="nav-item">
            <a href="<?php // echo $url ?>productos" class="nav-link">
                <i class="nav-icon fas fa-plus"></i>
                <p>Nuevo producto</p>
            </a>
        </li> -->
        <li class="nav-item">
            <a href="#newSale" class="nav-link mdlAddSale" data-toggle="modal" data-target="#mdlAddSaleV">

                <i class="nav-icon fas fa-cart-plus"></i>
                <p>Nueva compra</p>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a href="<?php // echo $url ?>categorias" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                    Categorías
                </p>
            </a>
        </li> -->
    </ul>
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
                <p>Gastos</p>
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
    </ul>
</li>


<!-- <li class="nav-item">
                    <a href="<?php echo $url ?>domicilio" class="nav-link">
                        <i class="nav-icon fas fa-shipping-fast"></i>
                        <p>
                            Servicio a domicilio
                        </p>
                    </a>
                </li> -->
<!-- <li class="nav-item">
                    <a href="<?php echo $url ?>renovar" class="nav-link">
                        <i class="nav-icon fas fa-sync-alt"></i>
                        <p>
                            Renovar cuenta
                        </p>
                    </a>
                </li> -->


