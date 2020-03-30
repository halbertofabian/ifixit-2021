<?php
if ($_SESSION['perfil'] == "Tecnico") {
  echo '<script>

	window.location = "./inicio";

</script>';
  return;
}
?>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h3 class="display-5">Lista de pedidos</h3>
  </div>
</div>


<!-- Main content -->
<section class="container-fluid">
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="btn-group float-right">
        <button type="button" class="btn btn-secondary">Filtrar por</button>
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
          <li><a class="dropdown-item" href="index.php?ruta=lista-pedidos&filtro=En proceso">En proceso</a></li>
          <li><a class="dropdown-item" href="index.php?ruta=lista-pedidos&filtro=Pendiente">Pendiente</a></li>
          <li><a class="dropdown-item" href="index.php?ruta=lista-pedidos&filtro=Entregado">Entregado</a></li>
          <li><a class="dropdown-item" href="index.php?ruta=lista-pedidos&filtro=Sin existencia">Sin existencia</a></li>


        </ul>
      </div>
    </div>
  </div>
  <br>
  <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

    <thead>

      <tr>
        <th style="width: 100px">Acciones</th>
        <th style="width:10px">#Pedido</th>
        <th>Cliente</th>
        <th>Contacto</th>
        <th>Fecha de pedido</th>
        <th>Fecha de entrega</th>
        <th>Estado</th>
        <th>Tipo de equipo</th>
        <th>Marca</th>
        <th>Modelo</th>

        <th>Encargo</th>
        <th>Importe</th>
        <th>Adelanto</th>
        <th>Adeudo</th>

        <th>Recibio</th>
        <th>Modifico</th>
      </tr>

    </thead>


    <tbody>
      <?php
      if (isset($_GET['filtro'])) {

        $pedidos = ControladorPedidos::ctrMostrarPedidosPorFiltro($_GET['filtro']);
      } else {
        $pedidos = ControladorPedidos::ctrMostrarPedidos();
      }


      foreach ($pedidos as $key => $value) { ?>

        <tr>
          <td>
            <div class="btn-group">
              <!--<button class="btn btn-warning">
                      <i class="fa fa-pencil"></i>
                    </button>-->
              <?php if ($_SESSION["perfil"] == "Administrador") : ?>
                <?php if ($value['estado'] != "Entregado" && $value['estado'] != "Sin existencia") : ?>
                  <button class="btn btn-danger btnBorrarP " idPedido="<?php echo $value['pedido']; ?>">
                    <i class="fa fa-times"></i>
                  </button>
                <?php endif; ?>
              <?php endif; ?>
              <button class="btn btn-secondary  btnImprimirTiketP" idPedido="<?php echo $value['pedido']; ?>">
                <i class="fa fa-print"></i>
              </button>
            </div>
          </td>
          <td>

            <div class="text-dark text-center">
              <?php echo $value['pedido']; ?>
            </div>



          </td>
          <td><?php echo $value['nombre']; ?></td>
          <?php
          $cadena =  $value['contacto'];
          $cadena = explode("/", $cadena);

          //if($cadena[1]==null){
          //$cadena[1]= "";
          //}
          $lng = count($cadena);
          $c1 = "";
          $c2 = "";
          //var_dump($lng);
          if ($lng == 1) {
            $c1 = $cadena[0];
          }
          if ($lng == 2) {
            $c1 = $cadena[0];
            if ($cadena[1] != "") {
              $c2 = "<a href='https://api.whatsapp.com/send?phone=$cadena[1]' class='btn btn-success' target='_blank' ><i class='fab fa-whatsapp' aria-hidden='true'></i></a>";
            }
          }
          //var_dump($cadena);
          //var_dump($cadena);
          // $contacto = $cadena[0];
          // $wspp = $cadena[1];

          ?>
          <td>
            <?php echo $c1 ?> <br>
            <?php //echo $c2 ?></a>

          </td>

          <td><?php echo $value['fecha_pedido']; ?></td>
          <td><?php echo $value['fecha_entrega']; ?></td>
          <!-- Estado de pedidos -->
          <td>
            <?php if ($value['estado'] == "Entregado") : ?>
              <strong class="text-success">
                <?php echo $value['estado'] ?>
              </strong>
            <?php endif; ?>
            <?php if ($value['estado'] == "Sin existencia") : ?>
              <strong class="text-danger">
                <?php echo $value['estado'] ?>
              </strong>
            <?php endif; ?>
            <?php if ($value['estado'] == "Pendiente" || $value['estado'] == "En proceso") : ?>
              <select name="" id="estadoSeleccionado" class="form-control" anticipo="<?php echo $value['anticipo']; ?>" onchange="cambiarEstadoPedido(<?php echo $value['pedido'] ?>)">

                <option value=""><?php echo $value['estado'] ?></option>

                <option value="Pendiente">Pendiente</option>
                <option value="En proceso">En proceso</option>
                <option value="Entregado">Entregado</option>
                <option value="Sin existencia">Sin existencia</option>
              </select>
            <?php endif; ?>

          </td>




          <td><?php echo $value['equipo'] ?></td>
          <td><?php echo $value['marca'] ?></td>
          <td><?php echo $value['modelo']; ?></td>

          <td><?php echo $value['encargo']; ?></td>
          <td><?php echo $value['importe']; ?></td>
          <td><?php echo $value['anticipo']; ?></td>

          <td><?php echo $value['total']; ?></td>





          <td><?php echo $value['usuario_recibio']; ?></td>
          <td><?php echo $value['usuario_entrego']; ?></td>

          <input type="hidden" value="<?php echo $value['pedido']; ?>" name="pedido">
        </tr>

      <? }
      ?>

    </tbody>

  </table>
  <?php


  $pedido = new ControladorPedidos();
  $pedido->ctrBorrarPedido();
  $pedido->ctrCambiarestado();


  ?>
</section>
