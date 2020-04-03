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
    <h3 class="display-5">Entrega de equipos</h3>
  </div>
</div>
<!-- Main content -->
<section class="container-fluid">
  <div class="row">
    <div class="col-md-4 col-12">
      <form action="" method="POST">
        <div class="form-group">
          <label for="inputSearchService">Número de servicio:</label>
          <input id="inputSearchService" class="form-control" type="text" placeholder="Escribe o scanea el número de órden del servicio" name="inputSearchService">
        </div>
        <div class="form-group">
          <input type="submit" id="btnSearchService" class="btn btn-dark pull-right" type="text" value="Buscar" name="btnSearchService">
        </div>
        <?php
        $buscarServicio = new ControladorServicios();
        $buscarServicio->ctrBucarServicioOrden();
        ?>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-12">
      <div class="btn-group float-right">
        <button type="button" class="btn btn-secondary">Filtrar por</button>
        <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
          <li><a class="dropdown-item" href="index.php?ruta=entregas&filtro=Reparacion">Reparación</a></li>
          <li><a class="dropdown-item" href="index.php?ruta=entregas&filtro=Entregado">Entregado</a></li>
          <li><a class="dropdown-item" href="index.php?ruta=entregas&filtro=Reparado">Reparado</a></li>
          <li><a class="dropdown-item" href="index.php?ruta=entregas&filtro=No quedo">No quedo</a></li>
          <li><a class="dropdown-item" href="index.php?ruta=entregas&filtro=Laboratorio">Laboratorio</a></li>
          <li><a class="dropdown-item" href="index.php?ruta=entregas&filtro=Entregado no quedo">Entregado sin quedar</a></li>

        </ul>
      </div>
    </div>
  </div>
  <br>

  <table class="table tablaServicios table-bordered table-striped dt-responsive tablas" width="100%">

    <thead>

      <tr>
        <th style="width:10px">#Número de órden</th>
        <th>Generar etiqueta</th>
        <th style="width: 500px">Acciones</th>
        <!-- <th>Abonos</th> -->

        <th>Notas</th>

        <th>Cliente</th>
        <th>Contacto</th>
        <th>Fecha de servicio</th>
        <th>Fecha de entrega</th>
        <th>Estado</th>
        <th>Tipo de equipo</th>
        <th>Equipo</th>
        <th>Modelo</th>
        <th>Color</th>
        <th>Observaciones</th>

        <th>Estado fisico</th>
        <th>Problema</th>
        <th>Solucion</th>
        <th>Pin desbloqueo</th>
        <th>Estetica</th>
        <th>Importe</th>
        <th>Anticipo</th>
        <th>Adeudo</th>



        <th>Recibio</th>
        <th>Modifico</th>
        <th>Nota</th>
        <th>Imei/Serie</th>
        <th>Código</th>
      </tr>

    </thead>


    <tbody>
      <?php
      if (isset($_GET['filtro'])) {

        $servicio = ControladorServicios::ctrMostrarServicioPorFiltro($_GET['filtro']);
      } else {
        $servicio = ControladorServicios::ctrMostrarServicio();
      }


      foreach ($servicio as $key => $value) {


      ?>

        <tr>
          <td>
            <button class="btn btn-dark btnVerServicio" idServicio="<?php echo $value['orden']; ?>">
              <i class="fas fa-info"> Ver </i> <strong><?php echo $value['orden']; ?></strong>
            </button>


          </td>
          <td>
            <a href="extensiones/tcpdf/pdf/etiqueta.php?codigo=<?php echo $value['orden']; ?>&tipo=servicio" target="_blank" class="btn btn-default " idServicio="<?php echo $value['orden']; ?>">

              <i class="fas fa-barcode"></i>
            </a>
          </td>
          <td>
            <div class="btn-group">

              <?php if ($_SESSION['perfil'] == "Vendedor") : ?>



                <?php if ($value['estado_equipo'] != "Entregado" && $value['estado_equipo'] != "Entregado no quedo") : ?>
                  <a href="index.php?ruta=servicios&editarServicio=<?php echo $value['orden']; ?>" class="btn btn-warning" idServicio="<?php echo $value['orden']; ?>"><i class="fa fa-edit"></i></a>


                <?php endif; ?>


              <?php endif; ?>
              <?php if ($_SESSION['perfil'] == "Administrador") : ?>



                <?php if ($value['estado_equipo'] != "Entregado" && $value['estado_equipo'] != "Entregado no quedo") : ?>
                  <a href="index.php?ruta=servicios&editarServicio=<?php echo $value['orden']; ?>" class="btn btn-warning" idServicio="<?php echo $value['orden']; ?>"><i class="fa fa-edit"></i></a>

                  <button class="btn btn-danger  btnEliminarServicio" idServicio="<?php echo $value['orden']; ?>">
                    <i class="fa fa-times"></i>
                  </button>

                  <!-- <a href="index.php?ruta=servicios&editarServicio=<?php echo $value['orden']; ?>" class="btn btn-warning" idServicio="<?php echo $value['orden']; ?>"><i class="fa fa-edit"></i></a> -->
                  <!--<button class="btn btn-warning  btnEditarServicio" idServicio="<?php echo $value['orden']; ?>">
                                  <i class="fa fa-edit"></i>
                                </button>-->

                <?php endif; ?>


              <?php endif; ?>

              <button class="btn btn-secondary btnImprimirTiket" idServicio="<?php echo $value['orden']; ?>">

                <i class="fa fa-print"></i>
              </button>


            </div>
          </td>


          <!-- <td>

              <?php if (($value['estado_equipo'] != "Entregado" && $value['estado_equipo'] != "Entregado no quedo") && $value['total'] != 0) :
              ?>
                <button class="btn btn-success btnAbonos" data-toggle="modal" data-target="#modalAbono" idServicio="<?php echo $value['orden']; ?>">
                  <i class="fa fa-dollar"></i>
                </button>

              <?php endif;
              ?>

            </td> -->




          <td>
            <button class="btn btn-dark btnEditarNota" data-toggle="modal" data-target="#modalEditarNota" idServicio="<?php echo $value['orden']; ?>">
              <i class="fa fa-sticky-note"></i>
            </button>
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
              $c2 = '
                <button class="btn btn-success btnMsjWsp " codigoServicio="' . $value['orden'] . '" numWp="' . $cadena[1] . '" data-toggle="modal" data-target="#exampleModal">Mandar WhatsApp <i class="fab fa-whatsapp" aria-hidden="true"></i></button>';
            }
          }
          //var_dump($cadena);
          //var_dump($cadena);
          // $contacto = $cadena[0];
          // $wspp = $cadena[1];

          ?>
          <td>
            <?php echo $c1 ?> <br>
            <?php echo $c2 ?>

          </td>

          <td><?php echo $value['fecha_reparacion']; ?></td>
          <td><?php echo $value['fecha_entrega']; ?></td>
          <!-- Estado de reparacion -->
          <?php
          if ($value['estado_equipo'] == "Entregado" || $value['estado_equipo'] == "Entregado no quedo") {
            echo '<td>
                        <strong class="text-success">' . $value['estado_equipo'] . '</td>';
          } else {

            if ($value['estado_equipo'] == "Reparado" || $value['estado_equipo'] == "Entregado") {
              echo '<td class="bg-success">';
            }
            if ($value['estado_equipo'] == "No quedo") {
              echo '<td class="bg-danger">';
            }
            if ($value['estado_equipo'] == "Reparacion" || $value['estado_equipo'] == "Laboratorio") {
              echo '<td class="bg-warning">';
            } ?>
            <select name="estado" class="form-control estado_equipo" anticipo="<?php echo $value['anticipo']; ?>" onchange="cambiarEstado( <?php echo $value['orden']; ?>)" id="estado_equipo" idServicio="<?php echo $value['orden'] ?>">

              <option value="<?php echo $value['estado_equipo']; ?>"><?php echo $value['estado_equipo']; ?></option>

              <option value="Reparado">Reparado</option>
              <option value="Entregado">Entregado</option>
              <option value="Reparacion">Reparacion</option>
              <option value="No quedo">No quedo</option>
              <option value="Laboratorio">Laboratorio</option>
              <option value="Entregado no quedo">Entregado sin quedar</option>
            </select>
            </td>
          <?php } ?>




          <td><?php echo $value['equipo'] ?></td>
          <td><?php echo $value['marca'] ?></td>
          <td><?php echo $value['modelo']; ?></td>
          <td><?php echo $value['color']; ?></td>
          <td><?php echo $value['observaciones']; ?></td>

          <td><?php echo $value['estado_fisico']; ?></td>
          <td><?php echo $value['problema']; ?></td>
          <td><?php echo $value['solucion']; ?></td>
          <td><?php echo $value['desbloqueo']; ?></td>
          <td><?php echo $value['estetica']; ?></td>
          <td><?php echo $value['importe']; ?></td>
          <td><?php echo $value['anticipo']; ?></td>
          <td><?php echo $value['total']; ?></td>



          <td><?php echo $value['usuario_recibio']; ?></td>
          <td><?php echo $value['usuario_entrego']; ?></td>
          <td><?php echo $value['nota']; ?></td>
          <td><?php echo $value['imei']; ?></td>
          <td><?php echo $value['codigo_cliente']; ?></td>
          <input type="hidden" value="<?php echo $value['orden']; ?>" name="orden">
        </tr>

      <? }
      ?>

    </tbody>

  </table>

  <?php
  $eliminar = new ControladorServicios();
  $eliminar->ctrBorrarServico();
  ?>
</section>



<div class="modal  fade" id="modalEditarNota">
  <div class="modal-dialog">
    <form action="" method="post">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          
          <h4 class="modal-title">Editar nota</h4>
        </div>
        <div class="modal-body">
          <p>Hazle saber a tus clientes y grupo de trabajo cúal es la situación actual del servicio&hellip;</p>
          <div class="form-group">
            <textarea name="nota" id="textNota" cols="30" rows="10" class="form-control"></textarea>
            <input type="hidden" id="orden" name="orden">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dafault pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark" name="btnEditarNota">Guardar cambios</button>
        </div>
      </div>
      <?php
      $nota = new ControladorServicios();
      $nota->editarNota();
      ?>
    </form>

    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?php //include_once 'vistas/modulos/bardcode.php'
?>

<!-- /.modal -->


<!-- mensaje de whatsapp  -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Mensaje de whatsApp para: <strong id="numeroWp"></strong> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="post">
        <div class="modal-body">


          <input type="hidden" name="codigoWP" id="codigoWP">
          <input type="hidden" name="textNumWp" id="textNumWp">
          <input type="hidden" name="nombreWP" id="nombreWP">
          <input type="hidden" name="codeWP" id="codeWP">
          <input type="hidden" name="notaWP" id="notaWP">



          <textarea name="textwp" id="textwp" rows="10" cols="60"></textarea>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success" name="btnMandarWp">Mandar Whatsapp</button>
        </div>
        <?php
        $wsp = new ControladorServicios();
        $wsp->ctrMandarWp();

        ?>
      </form>
    </div>
  </div>
</div>