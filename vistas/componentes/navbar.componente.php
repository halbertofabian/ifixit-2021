<style>
    label {
        color: grey;
    }

    #form-calif input[type="radio"] {
        display: none;
    }

    .clasificacion {
        direction: rtl;
        /* right to left */
        unicode-bidi: bidi-override;
        /* bidi de bidireccional */
    }

    #form-calif label:hover {
        color: orange;
    }

    #form-calif label:hover~label {
        color: orange;
    }

    #form-calif input[type="radio"]:checked~label {
        color: orange;
    }

    #form-calif p {
        text-align: center;
    }

    #form-calif label {
        font-size: 24px;
    }
</style>

<nav class="main-header navbar navbar-expand navbar-dark">


    <!-- Left navbar links -->
    <ul class="navbar-nav mb-4">
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
            <a href="<?php echo $url ?>servicios" class="nav-link"> <i class="fas fa-screwdriver"></i> Crear Servicio </a>
        </li>

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
    <ul class="navbar-nav ml-auto mb-4">

        <!-- <li class="nav-item d-none d-md-inline-block ">


            <a href="<?php echo $url ?>changeUser" class="nav-link"><i class="fas fa-user-friends"></i> Cambiar de usuario</a>

            </a>
        </li> -->
        <?php if ($_SESSION['perfil'] == "Administrador") : ?>
            <li class="nav-item dropdown d-none d-md-inline-block">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-university"></i>
                    <span class=""><?php echo $_SESSION["nom_suc"]; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Cambio de sucursal</span>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-item">
                        <form action="#" method="post">
                            <div class="form-group">
                                <label for="my-input">Seleccione una sucursal</label>
                                <select name="ingSucursal" class="form-control" id="">
                                    <?php $susc = ControladorSucursal::ctrMostrarSucursalPropietario($_SESSION["suscriptor"]); ?>

                                    <?php foreach ($susc as $key => $item) : ?>
                                        <option value="<?php echo $item['nombre'] ?>"><?php echo $item['nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <button type="submit" name="btnCambiarSucursal" class="btn btn-dark  float-right mt-2 mb-2">Acceder</button>
                            </div>
                            <?php

                            $login = new ControladorUsuarios();
                            $login->ctrCambiarSucursal();

                            ?>

                        </form>
                    </div>

                </div>
            </li>
        <?php endif; ?>

        <li class="nav-item ">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#mdlActualizaciones">
                <i class="far fa-bell"></i>
                <span class="badge badge-success navbar-badge">0</span>
            </a>
        </li>

        <li class="nav-item d-none d-md-inline-block">
            <a href="<?php echo $url ?>caja" class="nav-link"><i class="fas fa-cash-register"></i> Caja</a>
        </li>

        <li class="nav-item dropdown d-none d-md-inline-block">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <img src="<?php echo $_SESSION["foto"] ?>" class="img-circle elevation-2" width="30" alt="User Image"> <?php echo $_SESSION["usuario"] ?><i class="fas fa-caret-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- <a href="#" class="dropdown-item bg-dark">
                    <i class="fas fa-id-card-alt"></i> Mi perfil
                </a> -->
                <a href="<?php echo $url ?>suscripcion" class="dropdown-item  bg-dark">
                    <i class="fas fa-globe-americas"></i> Mi suscripción
                </a>

                <form action="" method="post">

                    <button type="submit" name="btnBloquearUsuario" class=" dropdown-item  bg-dark btn btn-block text-white btn-link btn-flat">
                        <i class="fas fa-user-lock"> </i>
                        Bloquear sesión</button>


                    <?php
                    $bloquear = new ControladorUsuarios();

                    $bloquear->ctrBloaquearUsusario() ?>
                </form>

                <a href="<?php echo $url ?>salir" class="dropdown-item  bg-dark">
                    <i class="fas fa-sign-out-alt"></i> Salir
                </a>
            </div>
        </li>


    </ul>
</nav>


<!-- Modal -->
<div class="modal fade" id="mdlActualizaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h3 class="modal-title" id="exampleModalLabel">Hay 0 Actualizaciones </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="alert alert-info" role="alert">
                                    <h4 class="alert-heading">Información</h4>
                                    Algunos cambios en el sistema tardan en llegar a tu navegador, puedes hacer la actualización manual con la combinación de teclas
                                    <br>
                                    <o>
                                        <li>
                                            Mac: <strong>cmd + shift + R</strong>
                                        </li>
                                        <li>
                                            Windows: <strong>ctr + shift + R o F5 + R</strong>
                                        </li>
                                    </o>
                                </div>

                            </div>
                            <ul class="list-group list-group-flush">

                                <!-- <li class="list-group-item">Ticket en formato media carta y carta entera</li> -->


                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-12">
                        <p class="text-center text-info">Estamos actualizando el sistema cada semana para ofrecerte un servicio de calidad, gracias por las sugerencias que nos has hecho. Si tienes una observación u otra sugerencia con mucho gusto nos gustaría escucharte</p>
                        <h5 class="" style="text-align: left"> <strong>¿Te gustaría dejarnos una reseña?</strong></h5>
                        <form action="" id="form-calif" method="post">
                            <textarea name="resena_text" id="resena_text" cols="30" rows="5" class="form-control" placeholder="Escribe aquí tu reseña, nos ayudarías mucho a crecer 😚"></textarea>
                            <p class="text-center"> <strong>¿ De 1 a 5 estrellas como calificas nuestro servicio ?</strong> </p>
                            <p class="clasificacion">

                                <input id="radio1" type="radio" name="resena_calif" value="5">

                                <label for="radio1">★</label>

                                <input id="radio2" type="radio" name="resena_calif" value="4">

                                <label for="radio2">★</label>

                                <input id="radio3" type="radio" name="resena_calif" value="3">

                                <label for="radio3">★</label>

                                <input id="radio4" type="radio" name="resena_calif" value="2">

                                <label for="radio4">★</label>

                                <input id="radio5" type="radio" name="resena_calif" value="1">

                                <label for="radio5">★</label>
                            </p>
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark float-right" name="btnEnviarResena">Enviar</button>
                            </div>
                            <?php

                            $resena = new ControladorUsuarios();
                            $resena->ctrEnviarResena();

                            ?>
                        </form>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>