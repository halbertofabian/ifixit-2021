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
    <h3 class="display-5">Corte de caja</h3>

  </div>
</div>


<!-- Main content -->
<section class="container-fluid">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-4 col-12">
          <?php $total = ControladorCorte::procesarCorte();

          if ($total == 0) :
          ?>
            <div class="alert alert-warning text-center">
              <strong>El corte aún no se puede procesar</strong>
            </div>
          <?php else : ?>
            <form action="ajax/corte.ajax.php">
              <div class="form-group">
                <label for="cantidad">Cantidad en caja</label>


                <?php if (isset($_SESSION['corte'])) :
                  if ($_SESSION['corte'] != "") : ?>

                    <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad en caja" value="<?php echo $_SESSION['corte'] ?>">
                    <br>
                    <a href="corte" class="btn btn-danger">Cancelar</a>
                    <input type="submit" class="btn btn-dark float-right" value="Hacer corte" name="hacer">
                  <?php else : ?>
                    <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad en caja">
                    <br>
                    <input type="submit" class="btn btn-dark float-right" value="Procesar corte..." name="procesar">
                  <?php endif;

                else : ?>
                  <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad en caja">
                  <br>
                  <input type="submit" class="btn btn-dark float-right" value="Procesar corte..." name="procesar">
                <?php endif;
                if (isset($_SESSION['corte'])) {
                  $_SESSION['corte'] = "";
                }
                ?>





              </div>
            </form>
          <?php endif;

          $borrarCorte = new ControladorCorte();
          $borrarCorte->ctrBorrarCorte();

          ?>
        </div>
      </div>

    </div>
    <div class="card-body">
      <?php if ($_SESSION['perfil'] == "Administrador") : ?>
        <table class="table table-bordered table-striped dt-responsive tablas">

          <thead>
            <tr>
              <th>#</th>
              <th>Cantidad</th>
              <th>Sobrante</th>
              <th>Faltante</th>
              <th>Fecha corte</th>
              <th>Usuario</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <?php $corte = ControladorCorte::mostrarTodosCorte();
            foreach ($corte as $key => $value) :  ?>
              <tr>
                <td><?php echo $value['id']; ?></td>
                <td><?php echo $value['cantidad']; ?></td>
                <td><?php echo $value['sobrante']; ?></td>
                <td><?php echo $value['faltante']; ?></td>
                <td><?php echo $value['fecha_corte']; ?></td>
                <td><?php echo $value['usuario']; ?></td>
                <td>
                  <div class="btn-group">

                    <button class="btn btn-secondary btnImprimirCorte" idCorte="<?php echo $value['id']; ?>"><i class="fa fa-print"></i></button>
                    <!-- <button class="btn btn-danger btnBorrarCorte" idCorte="<?php echo $value['id']; ?>"><i class="fa fa-times"></i></button> -->
                    <a class=" btn btn-info" target="_blank" href="extensiones/tcpdf/pdf/reporte-movimientos.php?corte=<?php echo $value['id']; ?>">
                    <i class="fas fa-file-pdf"></i>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
      <?php endif; ?>
    </div>
  </div>



</section>