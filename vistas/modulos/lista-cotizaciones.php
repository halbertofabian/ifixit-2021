<?php
if ($_SESSION['perfil'] == "Tecnico") {
  echo '<script>

	window.location = "./inicio";

</script>';
  return;
}
?>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h3 class="display-5">Lista de cotizaciones</h3>
  </div>
</div>


<!-- Main content -->
<section class="container">
  <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

    <thead>

      <tr>
        <th style="width: 500px">Acciones</th>
        <th style="width:10px">#Presupuesto</th>
        <th>Cliente</th>
        <th>Contacto</th>
        <th>Fecha de cotizacion</th>
        <th>Fecha de entrega</th>
        <!--<th>Estado</th>-->
        <th>Tipo de equipo</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Color</th>
        <th>Observaciones</th>
        <th>Estado fisico</th>
        <th>Diagnostico</th>
        <th>Pin desbloqueo</th>
        <th>Estetica</th>
        <th>$Cotizacion estimada</th>
        <th>Recibio</th>
        <th>Imei/Serie</th>
        <!--<th>Modifico</th>-->
      </tr>

    </thead>


    <tbody>
      <?php
      $presupuesto = ControladorPresupuestos::ctrMostrarPresupuestos();

      foreach ($presupuesto as $key => $value) { ?>

        <tr>
          <td>
            <div class="btn-group">
              <!--<button class="btn btn-warning">
                      <i class="fa fa-pencil"></i>
                    </button>-->
              <?php if ($_SESSION["perfil"] == "Administrador") : ?>
                <button class="btn btn-danger btnBorrarCotizacion" idCotizacion="<?php echo $value['presupuesto']; ?>">
                  <i class="fa fa-times"></i>
                </button>
              <?php endif; ?>
              <button class="btn btn-secondary btnImprimirTiketC" idCotizacion="<?php echo $value['presupuesto']; ?>">
                <i class="fa fa-print"></i>
              </button>
            </div>
          </td>
          <td>

            <div class="text-dark text-center">
              <?php echo $value['presupuesto']; ?>
            </div>


          </td>
          <td><?php echo $value['nombre']; ?></td>
          <td><?php echo $value['contacto']; ?></td>
          <td><?php echo $value['fecha_cotizacion']; ?></td>
          <td><?php echo $value['fecha_entrega']; ?></td>
          <!-- Estado de reparacion -->
          <!--<?php
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
                <select name="estado" class="form-control estado_equipo" onchange="cambiarEstadoP( <?php echo $value['presupuesto']; ?>)" id="estado_equipo" idServicio="<?php echo $value['presupuesto'] ?>" >
                 
                  <option value="<?php echo $value['estado_equipo']; ?>"><?php echo $value['estado_equipo']; ?></option>
                
                  <option value="En obesernación">En obesernación</option>
                  <option value="Entregado">Entregado</option>
                  <option value="En reparación">En reparación</option>
                 
                </select>
                </td>
                <?php } ?>-->


          <!--<td><?php echo $value['estado_equipo'] ?></td>-->

          <td><?php echo $value['equipo'] ?></td>
          <td><?php echo $value['marca'] ?></td>
          <td><?php echo $value['modelo']; ?></td>
          <td><?php echo $value['color']; ?></td>
          <td><?php echo $value['observaciones']; ?></td>
          <td><?php echo $value['estado_fisico']; ?></td>
          <td><?php echo $value['diagnostico']; ?></td>

          <td><?php echo $value['desbloqueo']; ?></td>
          <td><?php echo $value['estetica']; ?></td>
          <td><?php echo $value['costo_estimado']; ?></td>




          <td><?php echo $value['usuario_recibio']; ?></td>
          <td><?php echo $value['imei']; ?></td>
          <!--<td><?php echo $value['usuario_entrego']; ?>
              </td>-->

          <input type="hidden" value="<?php echo $value['presupuesto']; ?>" name="presupuesto">
        </tr>

      <? }
      ?>

    </tbody>

  </table>
  <?php $borrarCotizacion = new ControladorPresupuestos();
  $borrarCotizacion->ctrBorrarCotizacion(); ?>
</section>
