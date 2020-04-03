<?php


$servicio = ControladorServicios::ctrDetalleServicio($_SESSION['orden']);


if ($servicio != false) :

  $sucursal = ControladorSucursal::ctrMostrarSucursal();

  $contacto = $servicio['contacto'];
  //echo $contacto.'<br>';
  $array = array();
  $array = explode("/", $contacto);
  //echo $array[0].'<br>';
  $wp =  $array[1];
  $array = explode(" ", $array[0]);
  $tel  = $array[0] . $array[1];
  $correo = $array[2];

  //var_dump($sucursal);


?>
  <!-- <div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
      <h3 class="display-5">Servicio <strong><?php echo $servicio['orden']; ?></strong></h3>
    </div>
  </div> -->
  <section class="container-fluid">

    <div class="row">
      <div class="col-12 text-center col-md-2">
        <img src="<?php echo $_SESSION['ruta_logo'] ?>" class="thumbnail" width="100" alt="">
      </div>
      <div class="col-12 text-center col-md-5">
        <p class="text-primary"><strong><?php echo  strtoupper($_SESSION['nom_suc']) ?></strong></p>
        <p><?php echo $sucursal['direccion'] ?></p>
        <p><?php echo $sucursal['telefono'] ?></p>
        <p><?php echo $sucursal['sitio_web'] ?></p>

      </div>
      <div class="col-12 text-center col-md-5">
        <table class="table table-dark">
          <thead>
            <tr>
              <th class="text-center">Número de órden</th>

            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-danger bg-secondary" style="font-size: 24px"> <strong><?php echo $_SESSION['orden'] ?></strong>
                <button class="btn btn-dark btnImprimirTiket-view pull-right" idServicio="<?php echo $servicio['orden']; ?>">
                  <i class="fa fa-print"></i>
                </button>
              </td>


            </tr>
            <tr>
              <th class="text-center">Fecha de recepción</th>
              <th class="text-center">Fecha de entrega prometida</th>
            </tr>
            <tr>
              <td class="text-center">
                <?php echo $servicio['fecha_reparacion']; ?>
              </td>
              <td class="text-center">
                <?php echo $servicio['fecha_prometida']; ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-12 col-md-12">
        <div class="alert alert-dark" role="alert">
          Información del cliente
        </div>
      </div>
      <div class="col-md-4 col-12">
        <label for="">Nombre</label>
        <input type="text" value="<?php echo $servicio['nombre']; ?>" class="form-control" readonly>
        <label for="">Télefono</label>
        <input type="text" value="<?php echo $tel ?>" class="form-control" readonly>
      </div>
      <div class="col-md-4 col-12">
        <label for="">Correo</label>
        <input type="text" value="<?php echo $correo ?>" class="form-control" readonly>
        <label for="">WhatsApp</label>
        <input type="text" value="<?php echo $wp ?>" placeholder="Escribe el código de tu país + número Ej:52734100000" class="form-control">
      </div>
      <!-- <div class="col-md-4 col-12">
        <form action="#" method="post">
          <div class="modal-body">


            <input type="hidden" name="codigoWP" id="codigoWP">
            <input type="hidden" name="textNumWp" id="textNumWp">
            <input type="hidden" name="nombreWP" id="nombreWP">
            <input type="hidden" name="codeWP" id="codeWP">
            <input type="hidden" name="notaWP" id="notaWP">



            <textarea name="textwp" id="textwp" rows="7" cols="50"></textarea>

          </div>
          <div class="modal-footer">

            <button type="submit" class="btn btn-success" name="btnMandarWp">Mandar Whatsapp</button>
          </div>
          <?php
          $wsp = new ControladorServicios();
          $wsp->ctrMandarWp();

          ?>
        </form>
      </div> -->


      <div class="col-12 col-md-12 mt-3">
        <div class="alert alert-dark" role="alert">
          Información del equipo
        </div>
      </div>
    </div>
    <div class="row">


      <div class="col-12 col-md-4">

        <label for="">Estado equipo</label>

        <input type="text" value="<?php echo $servicio['estado_equipo']; ?>" class="form-control" readonly>

        <!-- <div class="form-group">
          <label for="">Estado del servicio</label>
          <select name="estado" class="form-control estado_equipo" anticipo="<?php echo $servicio['anticipo']; ?>" onchange="cambiarEstado( <?php echo $servicio['orden']; ?>)" id="estado_equipo" idServicio="<?php echo $servicio['orden'] ?>">

            <option value="<?php echo $servicio['estado_equipo']; ?>"><?php echo $servicio['estado_equipo']; ?></option>

            <option value="Reparado">Reparado</option>
            <option value="Entregado">Entregado</option>
            <option value="Reparacion">Reparacion</option>
            <option value="No quedo">No quedo</option>
            <option value="Laboratorio">Laboratorio</option>
            <option value="Entregado no quedo">Entregado sin quedar</option>
          </select>
        </div> -->
        <!-- <div class="form-group pull-right">
          <input class="btn btn-primary" value="Cambiar estado" type="submit" name="">
        </div> -->
        <div class="form-group">
          <label for="">Técnico a cargo del servicio</label>
          <input type="text" readonly value="<?php echo $servicio['tecnico'] ?>" class="form-control">
        </div>
      </div>
      <div class="col-md-4 col-12">

        <div class="form-group">
          <label for="">Nota para el cliente y tu equipo de trabajo</label>
          <textarea name="nota" id="textNota" cols="30" rows="10" class="form-control" readonly><?php echo $servicio['nota']; ?></textarea>
          <input type="hidden" id="orden" name="orden">
        </div>


      </div>
      <div class="col-md-4 col-12">
        <br>

        <!-- <img src="vistas/img/plantilla/letrero.png" width="300" alt=""> -->
        <!-- <br>
        <button class="btn btn-link">Agregar refacciones</button>
        <br>
        <button class="btn btn-link">Reporte técnico</button>
        <br>
        <button class="btn btn-link">Agregar abono</button>
        <br>
        <button class="btn btn-link">Entregar equipo</button> -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-12">
        <label for="">Equipo</label>
        <input type="text" value="<?php echo $servicio['equipo']; ?>" class="form-control" readonly>
        <label for="">IMEI</label>
        <input type="text" value="<?php echo $servicio['imei']; ?>" class="form-control" readonly>
        <label for="">Pin de desbloqueo</label>
        <input type="text" value="<?php echo $servicio['desbloqueo']; ?>" class="form-control" readonly>

      </div>
      <div class="col-md-3 col-12">
        <label for="">Marca</label>
        <input type="text" value="<?php echo $servicio['marca']; ?>" class="form-control" readonly>
        <label for="">Estado fisico</label> <br>
        <div class="text-center">
          <?php

          $item = array();

          $item = explode(",", $servicio['estado_fisico']);

          foreach ($item as $key => $value) {
            echo '<span class="label label-danger"> ' . $value . ' </span> ';
          }

          ?>
        </div>



      </div>
      <div class="col-md-3 col-12">
        <label for="">Módelo</label>
        <input type="text" value="<?php echo $servicio['modelo']; ?>" class="form-control" readonly>
        <label for="">Estatica</label>
        <input type="text" value="<?php echo $servicio['estetica']; ?>" class="form-control" readonly>

      </div>
      <div class="col-md-3 col-12">
        <label for="">Color</label>
        <input type="text" value="<?php echo $servicio['color']; ?>" class="form-control" readonly>
        <label for="">Observaciones</label>
        <input type="text" value="<?php echo $servicio['observaciones']; ?>" class="form-control" readonly>

      </div>


    </div>
    <br>
    <div class="row">
      <div class="col-md-6 col-12">
        <div class="card card-danger">
          <div class="card-header">
            <h4> <strong>Problema</strong></h4>
          </div>
          <div class="card-body text-center">
            <?php echo $servicio['problema'] ?>
          </div>
        </div>

      </div>
      <div class="col-md-6 col-12">
        <div class="card card-success">
          <div class="card-header">
            <h4> <strong>Solución</strong></h4>
          </div>
          <div class="card-body text-center">
            <?php echo $servicio['solucion'] ?>
          </div>
        </div>

      </div>
    </div>

  </section>

<?php else : ?>
  <div class="alert alert-danger" role="alert">
    No se encontro el servicio especificado  <strong class="text-dark"> <?php echo $_SESSION['orden'] ?></strong> 
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <div class="card">
          <div class="card-header">
            Busca de nuevo el servicio
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="form-group">
                <label for="inputSearchService">Número de servicio:</label>
                <input id="inputSearchService" class="form-control" type="text" placeholder="Escribe o scanea el número de órden del servicio" name="inputSearchService">
              </div>
              <div class="form-group">
                <input type="submit" id="btnSearchService" class="btn btn-dark float-right" type="text" value="Buscar" name="btnSearchService">
              </div>
              <?php
              $buscarServicio = new ControladorServicios();
              $buscarServicio->ctrBucarServicioOrden();
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php endif; ?>