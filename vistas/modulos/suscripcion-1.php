<?php
$sucursal = SuscripcionModelo::mdlObetnerEstadoSucursal($_SESSION['suscriptor'], $_SESSION['nom_suc']);
// if ($sucursal['estado'] == 1) {
//     echo '<script>

// 	window.location = "./suscripcion";

// </script>';
//     return;
// };
$app->getComponents('navbar');
$app->getComponents('sidebar');
if (isset($rutas[0]) && $rutas[0] == 'salir') {
    $app->getPage('salir');
    return;
}

?>
<div class="content-wrapper">


    <?php

    $estadoSuscrip =   SuscripcionContrlador::ctrObternerEstadoSuscripcion();

    if ($estadoSuscrip['estado_suscripcion'] == 1 && $sucursal['estado'] == 0) :
    ?>
        <div class="jumbotron">
            <h1 class="display-4">¡Hola!</h1>
            <p class="lead">Esta cuenta requiere que se active un token_suc el cual nos ayudará a nuestro soprte para identificar esta sucursal en nuestro sistema. </p>
            <hr class="my-4">
            <p>Ayudanos a activar el token_suc por favor, para que en futuras actualizaciones podramos brindarte un mejor soporte.</p>
            <form action="" method="post">
                <button type="submit" class="btn btn-dark btn-lg" href="#" name="btnActivarTokenSuc">Activar token_suc</button>
                <?php
                $activar = new ControladorSucursal();
                $activar->ctrActivarTokenSuc();
                ?>
            </form>
        </div>
        <script src="//code.tidio.co/nxinf3gpsku2ofkbr2vhlpfheik0cb5k.js"></script>

    <?php
        return;
    endif;

    ?>



    <div class="jumbotron jumbotron-fluid">
        <div class="container-fluid">
            <h3 class="display-5">Suscripción</h3>

            <p>Token suc: <strong><?php echo $sucursal['token_suc'] ?> </strong> </p>

        </div>
    </div>
    <?php


    if ($sucursal['estado'] == 0) :
        //echo "<pre>", print_r($sucursal), "</pre>";   
    ?>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-2">Pagos pendiente</h5>
                            <table class="table table-responsive">
                                <thead class="thead-light">
                                    <tr>
                                        <th>token_pay</th>
                                        <th>Monto</th>
                                        <th>Metodo pago</th>
                                        <th>Detalle</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $pagosPendientes = SuscripcionModelo::mdlObetnerEstadoPagos($_SESSION['usuario'], 'Pendiente');

                                    foreach ($pagosPendientes as $key => $value) :
                                    ?>
                                        <tr>
                                            <td><?php echo $value['token_pay'] ?></td>
                                            <td><?php echo $value['monto'] ?></td>
                                            <td><?php echo $value['metodo_pago'] ?></td>

                                            <td><?php echo $value['detalle_producto'] ?></td>
                                            <td><?php echo $value['estado'] ?></td>


                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning" role="alert">
                Tu sucursal esta desactivada, es probable que se encuentre pausada debido a una falta de pago.
            </div>
            <div class="card">
                <div class="card-body">
                                                        <strong>Datos de bancarios</strong>
                                                        <br>
                                                        <img src="https://cdn.onlinecasino.mx/images/septiembre2018/metodo-de-pago-bancomer_680x279.png" width="200" alt="">
                                                        <p><strong>Banco:</strong> BBVA BANCOMER</p>
                                                       
                                                        
                                                        <p><strong>Tarjeta de débito:</strong> 4152 3136 7828 3263</p>
                                                        <p><strong>Titular:</strong> Héctor Alberto López Fabián</p>

                                                        <form action="" method="post">
                                                            <div>
                                                                <p>¿Tienes alguna duda?</p>
                                                                <div class="btn-group" role="group" aria-label="Button group">

                                                                    <a target="_blanck" href="http://bit.ly/3awLZCM" class="btn btn-success"><i class="fab fa-whatsapp"></i></a>
                                                                    <a target="_blanck" href="https://m.me/LFHALBERTO" class="btn btn-primary"><i class="fab fa-facebook-messenger"></i></a>

                                                                </div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary float-right mb-2" name="btnChargePayEfectivo">
                                                                Crear cuenta
                                                            </button>
                                                            <?php
                                                            $payEfectivo = new StripeCharge();
                                                            $payEfectivo->efectivoCharge();

                                                            ?>
                                                        </form>

                                                    </div>

                <div class="card-footer">
                    Puedes enviar el comprobante de pago y el token suc <?php echo $sucursal['token_suc']  ?> a <strong>ventas@ifixitmor.com</strong> o por medio de WhatsApp, Messenger.
                    <p>¿Tienes alguna duda, requieres otro metodo de pago o quieres enviar tu comprobante?</p>
                    <div class="btn-group" role="group" aria-label="Button group">

                        <a target="_blanck" href="http://bit.ly/3awLZCM" class="btn btn-success"><i class="fab fa-whatsapp"></i></a>
                        <a target="_blanck" href="https://m.me/LFHALBERTO" class="btn btn-primary"><i class="fab fa-facebook-messenger"></i></a>
                    </div>

                </div>
            </div>

        </div>

    <?php endif; ?>
    <?
    if ($sucursal['base'] == 2 && $sucursal['estado'] == 1) :
        //echo "<pre>", print_r($sucursal), "</pre>";   
    ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                Tenemos un problema con tu sucursal, no se pudo instalar la base de datos en autómatico.
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detalles</h5>
                    <p class="card-text">Es probable que no hayamos actualizado nuestra lista base de datos disponibles, pero no te preocuoes. Da click en el botón de instalar base de datos, en breves segundos ya tendras una base de datos lista para usar. </p>

                    <?php
                    $bd = SuscripcionModelo::mdlObtenerBD();

                    if ($bd != null) : ?>
                        <form method="post">


                            <button type="submit" class="btn btn-warning" name="btnInstalarBase"> <i class="fas fa-download"></i> Instalar base de datos</button>

                            <?php

                            $creabd = new ControladorUpdateDB();
                            $creabd->crearBD();

                            ?>

                        </form>

                    <?php else : ?>
                        <strong>No hay bases de datos disponibles</strong>
                    <?php endif; ?>

                </div>
                <div class="card-footer">
                    <p>Si no hay ningún botón de instalar, por favor comunicate con un agente.</p>
                    <div class="btn-group" role="group" aria-label="Button group">

                        <a target="_blanck" href="http://bit.ly/3awLZCM" class="btn btn-success"><i class="fab fa-whatsapp"></i></a>
                        <a target="_blanck" href="https://m.me/LFHALBERTO" class="btn btn-primary"><i class="fab fa-facebook-messenger"></i></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<script src="//code.tidio.co/nxinf3gpsku2ofkbr2vhlpfheik0cb5k.js"></script>