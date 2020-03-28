<?php

if ($_SESSION["perfil"] == "Vendedor" || $_SESSION['perfil'] == "Tecnico") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

?>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h3 class="display-5">Movimientos de Caja</h3>
    </div>
</div>


<!-- Main content -->
<section class="container">
    <?php $mov = ControladorCorte::ctrMostrarMovimientos();

    $total = ($mov['servicios'] + $mov['pedidos'] + $mov['ventas'] + $mov['ingresos']) - $mov['gastos'];
    ?>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">

            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fas fa-cash-register"></i></span>

                <div class=" info-box-content">
                    <span class="info-box-text">CAJA</span>
                    <span class="info-box-number">$<?php echo $total ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa fa-wrench""></i></span>

                    <div class=" info-box-content">
                        <span class="info-box-text">SERVICIOS</span>
                        <span class="info-box-number">$<?php echo $mov['servicios'] ?></span>
                        <a href="entregas" class="small-box-footer">Entregas</a>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-dark"><i class="fas fa-people-carry"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">PEDIDOS</span>
                <span class="info-box-number">$<?php echo $mov['pedidos'] ?></span>
                <a href="pedidos" class="small-box-footer">Pedidos</a>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-list-ul"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">VENTAS</span>
                <span class="info-box-number">$ <?php echo $mov['ventas'] ?></span>
                <a href="ventas" class="small-box-footer">Ventas</a>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">INGRESOS</span>
                    <span class="info-box-number">$ <?php echo $mov['ingresos'] ?></span>
                    <a href="ingresos" class="small-box-footer">Ingresos</a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-minus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">GASTOS (EGRESOS)</span>
                    <span class="info-box-number">$ <?php echo $mov['gastos'] ?></span>
                    <a href="egresos" class="small-box-footer">Gastos</a>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-lg-12">
            <div class="box-header with-border">

                <div class="input-group">

                    <button type="button" class="btn btn-dark mb-4" id="daterange-btn3">

                        <span>
                            <i class="fa fa-calendar"></i>

                            <?php

                            if (isset($_GET["fechaInicial"])) {

                                echo $_GET["fechaInicial"] . " - " . $_GET["fechaFinal"];
                            } else {

                                echo 'Rango de fecha';
                            }

                            ?>
                        </span>

                        <i class="fa fa-caret-down"></i>

                    </button>

                </div>



            </div>

            <?php

            if ($_SESSION["perfil"] == "Administrador") {

                include "reportes/grafico-total-ventas.php";
            }

            ?>

        </div>
    </div>
    <!-- /.col -->
</section>