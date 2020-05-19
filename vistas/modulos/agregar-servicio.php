<?php

if ($_SESSION["perfil"] == "Auxiliar" || $_SESSION['perfil'] == 'Tecnico') {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>

<style>
  .bg-dark {
    background-color: #fff;
    color: #000;
    box-shadow: 2px 5px 5px #ccc;
  }

  .bg-dark:hover {
    color: #000;
  }
</style>

<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h3 class="display-5">Servicios Precargados</h3>
    <button class="btn btn-dark float-right" data-toggle="modal" data-target="#modalAgregarServicio">
      <i class="fas fa-plus"></i>
      Agregar servicio

    </button>
  </div>
</div>


<section class="container-fluid">



  <div class="conatiner">


    <div class="row">
      <div class="col-12 col-md-6">
        <div class="form-group">
          <label for="caja_busqueda">Buscar:</label>
          <input type="text" class="form-control" name="box-search" id="box-search">
        </div>
      </div>
    </div>
    <hr>

    <div class="row" id="datos">


    </div>
  </div>










</section>



<div id="modalAgregarServicio" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-dark">

        <h4 class="modal-title">Agregar Servicio</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

          

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fas fa-wrench"></i></span>

                <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingresar nombre" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL TIPO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-map"></i></span>

                <select name="tipo_equipo" id="" class="form-control">
                  <option value="" selected="">Seleccione un tipo de equipo</option>
                  <option value="Celular">Celular</option>
                  <option value="Tablet">Tablet</option>
                  <option value="Computadora">Computadora</option>
                  <option value="Otro">Otro</option>
                </select>

              </div>

            </div>
            <!-- ENTRADA PARA LA MARCA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fab fa-bandcamp"></i></span>

                <input type="text" class="form-control input-lg" name="marca" placeholder="Ingresar la marca" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL MODELO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fas fa-mobile"></i></span>

                <input type="text" class="form-control input-lg" name="modelo" placeholder="Ingresar el modelo" required>

              </div>

            </div>
            <!-- ENTRADA PARA LA Precio -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-dollar"></i></span>

                <input type="text" class="form-control input-lg" name="precio" placeholder="Ingresar el precio" required>

              </div>

            </div>





          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-dark" name="btnAgregarServicioPrecargado">Guardar servicio</button>

        </div>

      </form>
      <?php $preservicio = new ControladorServicios();
      $preservicio->crtAgregarPreServicio();
      ?>

    </div>

  </div>

</div>




<div id="modalEditarServicio" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-dark">
          <h4 class="modal-title">Editar Servicio</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>



        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fas fa-wrench"></i></span>

                <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingresar nombre" required id="nuevoNombre">

              </div>

            </div>
            <!-- ENTRADA PARA EL TIPO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-map"></i></span>

                <select name="tipo_equipo" id="nuevoTipo_equipo" class="form-control">
                  <option value="" selected="">Seleccione un tipo de equipo</option>
                  <option value="Celular">Celular</option>
                  <option value="Tablet">Tablet</option>
                  <option value="Computadora">Computadora</option>
                  <option value="Otro">Otro</option>
                </select>

              </div>

            </div>
            <!-- ENTRADA PARA LA MARCA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fab fa-bandcamp"></i></span>

                <input type="text" class="form-control input-lg" name="marca" placeholder="Ingresar la marca" required id="nuevaMarca">

              </div>

            </div>
            <!-- ENTRADA PARA EL MODELO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fas fa-mobile"></i></span>

                <input type="text" class="form-control input-lg" name="modelo" placeholder="Ingresar el modelo" required id="nuevoModelo">

              </div>

            </div>
            <!-- ENTRADA PARA LA Precio -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-dollar"></i></span>

                <input type="text" class="form-control input-lg" name="precio" placeholder="Ingresar el precio" required id="nuevoPrecio">
                <input type="hidden" class="form-control input-lg" name="id" placeholder="" required id="id">

              </div>

            </div>





          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-dark" name="btnActualizarServicioPrecargado">Guardar servicio</button>

        </div>

      </form>
      <?php $preservicio = new ControladorServicios();
      $preservicio->crtEditarPreServicio();
      ?>

    </div>

  </div>

</div>