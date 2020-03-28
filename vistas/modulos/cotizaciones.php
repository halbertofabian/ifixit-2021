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
    <h3 class="display-5">Crear cotización</h3>
  </div>
</div>

<!-- Main container -->
<section class="container">

  <form action="" method="post">
    <div class="row">
      <div class="col-md-4 text-success"><strong>Campos obligatorios(*)</strong></div>
    </div>
    <div class="row">

      <div class="col-md-4 col-12">
        <label for="">Numero de presupuesto <span class="text-success">(*)</span></label></label>
        <div class="form-group">
          <?php $orden = ControladorPresupuestos::presupuesto();
          if ($orden == false) :
          ?>
            <input type="number" class="form-control" placeholder="Numero de orden" required="" readonly="" name="orden" value="1">
          <?php else : ?>
            <input type="number" class="form-control" placeholder="Numero de orden" required="" readonly="" name="orden" value="<?php echo $orden['presupuesto'] + 1 ?>">
          <?php endif; ?>
        </div>


      </div>
      <div class="col-md-8">
        <label for="">Nombre <span class="text-success">(*)</span></label></label>
        <input type="text" class="form-control" placeholder="Nombre" name="nombre" required="">
      </div>

    </div>
    <div class="row">
      <div class="col-md-6">
        <label for="">Contacto</label>
        <input type="text" class="form-control" placeholder="Contacto" name="contacto">
      </div>
      <div class="col-md-6">
        <label for="">Fecha <span class="text-success">(*)</span></label></label>
        <input type="date" class="form-control" required="" name="fecha_cotizacion" id="theDate">
      </div>

    </div>

    <div class="row">


      <div class="col-md-2">
        <strong>Descripción del equipo <span class="text-success">(*)</span></label></strong><br>
        <label for="">Equipo</label>
        <select id="" class="form-control" name="equipo">
          <option value="Celular">Celular</option>
          <option value="Computadora">Computadora</option>
          <option value="Tablet">Tablet</option>
          <option value="Consola">Consola</option>
        </select>
      </div>
      <div class="col-md-3">
        <br>
        <label for="">Imei/Serie</label>
        <input type="text" class="form-control" placeholder="imei" name="imei">
      </div>
      <div class="col-md-2">
        <br>
        <label for="">Marca <span class="text-success">(*)</span></label></label>
        <input type="text" class="form-control" placeholder="Marca" name="marca" required="">
      </div>
      <div class="col-md-2">
        <br>
        <label for="">Modelo <span class="text-success">(*)</span></label></label>
        <input type="text" class="form-control" placeholder="Modelo" name="modelo" required="">
      </div>
      <div class="col-md-2">
        <br>
        <label for="">Color</label>
        <input type="text" class="form-control" placeholder="Color" name="color">
      </div>
      <div class="col-md-2">
        <br>
        <label for="">Observaciones</label>
        <input type="text" class="form-control" placeholder="Observaciones" name="observaciones">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12 col-md-12">
        <div class="text-danger">
          *Seleccione al menos una opcion de estas <span class="text-success">(*)</span></label>
        </div>
      </div>
      <div class="col-md-2 col-12">
        <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Encendido"> Encendido
      </div>
      <div class="col-md-2 col-12">
        <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Apagado"> Apagado
      </div>
      <div class="col-md-2 col-12">
        <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Manipulado"> Manipulado
      </div>
      <div class="col-md-2 col-12">
        <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Mojado"> Mojado
      </div>
      <div class="col-md-2 col-12">
        <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Roto"> Roto
      </div>
      <div class="col-md-2 col-12">
        <input type="checkbox" class="form-check-input" name="estado_fisico[]" value="Incompleto"> Incompleto
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-6">
        <label for="">Diagnostico rápido <span class="text-success">(*)</span></label></label>
        <textarea id="" cols="30" rows="5" class="form-control" name="diagnostico" required=""></textarea>
      </div>
      <div class="col-md-6">
        <label for="">Costo estimado</label>
        <textarea id="" cols="30" rows="5" class="form-control" name="costo_estimado"></textarea>
      </div>
    </div>
    <div class="row">

      <div class="col-md-6">
        <p>Patron de desbloqueo o Pin Númerico</p>
      </div>
      <div class="col-md-6">
        <p>Estetica</p>
      </div>

    </div>

    <div class="row">
      <div class="col-12 col-md-12 text-center">
        <div class="text-danger">
          *Seleccione una opcion de estas <span class="text-success">(*)</span></label>
        </div>
      </div>

      <div class="col-md-3">
        <input type="text" class="form-control" placeholder="" name="desbloqueo">
      </div>

      <div class="col-md-3">

        <input type="radio" class="" name="estetica" value="Bueno"> Bueno

      </div>
      <div class="col-md-3">

        <input type="radio" class="" name="estetica" value="Regular"> Regular

      </div>
      <div class="col-md-3">

        <input type="radio" class="" name="estetica" value="Malo"> Malo

      </div>
    </div>

    <br>
    <div class="row">
      <div class="col-md-4 mb-5">
        <input type="submit" value="Guardar" class="btn btn-dark btn-block float-right" name="btnRegistrarPresupuesto">
      </div>
    </div>
    <?php $presupuesto = new ControladorPresupuestos();
    $presupuesto->ctrRegistrarPresupuesto(); ?>
  </form>
</section>