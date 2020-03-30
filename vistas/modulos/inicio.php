<?php
/*$suscripcion = SuscripcionContrlador::ctrObternerEstadoSuscripcion();
    //var_dump($suscripcion);
   if($suscripcion["estado_suscripcion"]==0){
      header("location:suscripcion");

   }*/
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $url ?>">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Panel de control</li>
  </ol>
</nav>

<section class="container-fluid">

  <div class="row">
    <?php

    if ($_SESSION["perfil"] == "Administrador") {

      include "inicio/cajas-superiores.php";
    }

    ?>

  </div>

  <div class="row">

    <div class="col-lg-12">

      <?php

      if ($_SESSION["perfil"] == "Administrador") {

        $app ->getComponents('grafico-total-ventas');
      }

      ?>

    </div>

    <div class="col-lg-6">

      <?php

      if ($_SESSION["perfil"] == "Administrador") {

        include "reportes/productos-mas-vendidos.php";
      }

      ?>

    </div>

    <div class="col-lg-6">

      <?php

      if ($_SESSION["perfil"] == "Administrador") {

        include "inicio/productos-recientes.php";
      }

      ?>

    </div>

    <div class="col-lg-12">

      <?php

      if ($_SESSION["perfil"] == "Vendedor") {

        echo '<div class="box box-success">

             <div class="box-header">

             <h1>Bienvenid@ ' . $_SESSION["nombre"] . '</h1>

             </div>

             </div>';
      } else if ($_SESSION["perfil"] == "Tecnico") {
        include_once 'vistas/modulos/vista-tecnica.php';
      }

      ?>

    </div>

  </div>

</section>

</div>