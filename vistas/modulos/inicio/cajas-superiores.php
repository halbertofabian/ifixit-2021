<?php

$item = null;
$valor = null;
$orden = "id";

/*$anticipoPedidos = ControladorPedidos::ctrMostrarTotalAnticipo();
$adeudoPedidos = ControladorPedidos::ctrMostrarTotalAdeudos();
$ventas = ControladorVentas::ctrSumaTotalVentas();

$anticipo = ControladorServicios::ctrSumaTotalVentasServicioAnticipo();
$adeudo = ControladorServicios::ctrSumaTotalVentasServicioAdeudo();*/


$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

$totalPendientes = ControladorServicios::ctrSumaTotalPendientes();
//$totalClientes = count($clientes);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

$corteReal = ControladorCorte::procesarCorte();

?>



<div class="col-md-3 col-6">

  <div class="small-box bg-aqua">

    <div class="inner">

      <h3>$<?php echo $corteReal; ?></h3>

      <p>Total útimo corte</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="movimientos" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-md-3 col-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3><?php echo number_format($totalCategorias); ?></h3>

      <p>Categorías</p>

    </div>

    <div class="icon">

      <i class="ion ion-clipboard"></i>

    </div>

    <a href="categorias" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-md-3 col-6">

  <div class="small-box bg-yellow">

    <div class="inner">

      <h3><?php echo $totalPendientes['total']; ?></h3>

      <p>Pendientes</p>

    </div>

    <div class="icon">

      <i class="fa fa-wrench"></i>

    </div>

    <a href="entregas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-md-3 col-6">

  <div class="small-box bg-red">

    <div class="inner">

      <h3><?php echo number_format($totalProductos); ?></h3>

      <p>Productos</p>

    </div>

    <div class="icon">

      <i class="ion ion-ios-cart"></i>

    </div>

    <a href="productos" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>