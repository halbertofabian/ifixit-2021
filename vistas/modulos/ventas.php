<?php

if ($_SESSION["perfil"] == "Tecnico") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

$xml = ControladorVentas::ctrDescargarXML();

if ($xml) {

  rename($_GET["xml"] . ".xml", "xml/" . $_GET["xml"] . ".xml");

  echo '<a class="btn btn-block btn-success abrirXML" archivo="xml/' . $_GET["xml"] . '.xml" href="ventas">Se ha creado correctamente el archivo XML <span class="fa fa-times pull-right"></span></a>';
}

?>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h3 class="display-5">Administrar ventas</h3>
    <div class="btn-group float-right" role="group" aria-label="Button group">
      <a href="<?php echo $url ?>crear-venta" class="btn btn-dark">
        <i class="fas fa-plus"></i>
        Agregar venta
      </a>
      <button type="button" class="btn btn-default" id="daterange-btn">

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
</div>


<section class="container-fluid">

  <div class="card">

    <div class="card-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

        <thead>

          <tr>

            <th style="width:10px">#</th>
            <th>Código factura</th>
            <th>Producto</th>

            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Forma de pago</th>
            <th>Neto</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Acciones</th>

          </tr>

        </thead>

        <tbody>

          <?php

          if (isset($_GET["fechaInicial"])) {

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];
          } else {

            date_default_timezone_set($_SESSION["zona"]);

            $fecha = date('Y-m-d');
            $fechaInicial = $fecha;
            $fechaFinal = $fecha;
          }

          $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {

            echo '<tr>

                  <td>' . ($key + 1) . '</td>

                  <td>' . $value["codigo"] . '</td>';
            $productos = json_decode($value["productos"], true);
            //var_dump($productos);
            echo '<td>';
            foreach ($productos as $key => $item) {
              echo $item["descripcion"] . " {cantidad(es): " . $item["cantidad"] . "} <br>";
            }
            echo '</td>';


            $itemCliente = "id";
            $valorCliente = $value["id_cliente"];

            $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

            echo '<td>' . $respuestaCliente["nombre"] . '</td>';

            $itemUsuario = "usuario";
            $valorUsuario = $value["id_vendedor"];

            $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

            echo '<td>' . $respuestaUsuario["nombre"] . '</td>

                  <td>' . $value["metodo_pago"] . '</td>

                  <td>$ ' . number_format($value["neto"], 2) . '</td>

                  <td>$ ' . number_format($value["total"], 2) . '</td>

                  <td>' . $value["fecha"] . '</td>

                  <td>

                    <div class="btn-group">

                      
                        
                      <button class="btn btn-secondary btnImprimirFactura" codigoVenta="' . $value["codigo"] . '">

                        <i class="fa fa-print"></i>

                      </button>';

            if ($_SESSION["perfil"] == "Administrador") {

              echo  '<button class="btn btn-warning btnEditarVenta" idVenta="' . $value["id"] . '"><i class="fa fa-edit"></i></button>' .

                '  <button class="btn btn-danger btnEliminarVenta" idVenta="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
            }

            echo '</div>  

                  </td>

                </tr>';
          }

          ?>

        </tbody>

      </table>

      <?php

      $eliminarVenta = new ControladorVentas();
      $eliminarVenta->ctrEliminarVenta();

      ?>


    </div>

  </div>

</section>

<script src="vistas/js/app/ventas.js"></script>