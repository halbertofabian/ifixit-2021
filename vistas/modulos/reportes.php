<?php

if ($_SESSION["perfil"] == "Tecnico" || $_SESSION["perfil"] == "Vendedor") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h3 class="display-5">Reportes de ventas</h3>
    <div class="btn-group float-right" role="group" aria-label="Button group">

      <button type="button" class="btn btn-default" id="daterange-btn2">

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
      <?php

      if (isset($_GET["fechaInicial"])) {

        echo '<a class="btn btn-success"  href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial=' . $_GET["fechaInicial"] . '&fechaFinal=' . $_GET["fechaFinal"] . '">';
      } else {

        echo '<a class="btn btn-success"  href="vistas/modulos/descargar-reporte.php?reporte=reporte">';
      }

      ?>
      <i class="fas fa-file-excel"></i>
      Descargar reporte en Excel
      </a>

    </div>
  </div>
</div>


<section class="container-fluid">

  <div class="card">
    <div class="card-body">

      <div class="row">

        <div class="col-md-6 col-12">

          <?php

          include "reportes/grafico-ventas.php";

          ?>

        </div>

        <div class="col-md-6 col-12">

          <?php

          include "reportes/productos-mas-vendidos.php";

          ?>

        </div>

        <div class="col-md-6 col-xs-12">
          <!-- <?php

                // include "reportes/vendedores.php";

                ?>

           </div>

           <div class="col-md-6 col-xs-12">
             
            <?php

            // include "reportes/compradores.php";

            ?>-->

        </div>

      </div>

    </div>

  </div>

</section>