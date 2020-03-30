<nav class="main-header navbar navbar-expand navbar-dark">


    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Buscar servicios" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        
        <li class="nav-item d-none d-md-inline-block">
            <a href="<?php echo $url ?>crear-venta" class="nav-link"> <i class="fas fa-cart-plus"></i> Crear Venta </a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"> <i class="fas fa-archive"></i> Entregas</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="<?php echo $url ?>entregas" class="dropdown-item"> <i class="fas fa-screwdriver"></i> Lista de servicios </a></li>

                <li><a href="<?php echo $url ?>lista-pedidos" class="dropdown-item"><i class="fas fa-clipboard-list"></i> Lista de Pedidos</a></li>
            </ul>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="<?php echo $url ?>agregar-servicio" class="nav-link"> <i class="far fa-address-card"></i> Servicio precargado </a>
        </li>
    </ul>

    <!-- SEARCH FORM -->


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item d-none d-md-inline-block">
            <a href="<?php echo $url ?>caja" class="nav-link"><i class="fas fa-cash-register"></i> Caja</a>
        </li>

        <li class="nav-item dropdown d-none d-md-inline-block">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <img src="<?php echo $_SESSION["foto"] ?>" class="img-circle elevation-2" width="30" alt="User Image"> <?php echo $_SESSION["usuario"] ?><i class="fas fa-caret-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item bg-dark">
                    <i class="fas fa-id-card-alt"></i> Mi perfil
                </a>
                <a href="#" class="dropdown-item  bg-dark">
                <i class="fas fa-globe-americas"></i> Mi suscripción
                </a>
                <a href="<?php echo $url ?>" class="dropdown-item  bg-dark">
                    <i class="fas fa-user-lock"></i> Bloquear sesión
                </a>
                <a href="<?php echo $url ?>salir" class="dropdown-item  bg-dark">
                <i class="fas fa-sign-out-alt"></i> Salir
                </a>
            </div>
        </li>


    </ul>
</nav>