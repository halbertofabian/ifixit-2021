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
        <h3 class="display-5">Ingresos de caja</h3>

    </div>
</div>


<!-- Main content -->
<section class="container-fluid">
    <form method="post">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-2">
                    <div class="form-group">
                        <label for="">Cantidad</label>
                        <input type="text" class="form-control " name="ingreso" value="" required placeholder="$0.00">
                    </div>

                </div>
                <div class="col-12 col-md-10">
                    <div class="form-group">
                        <label for="">Concepto</label>
                        <input type="text" class="form-control " name="concepto" value="" required placeholder="">
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <button class="btn btn-dark float-right" name="btnGuardarIngreso">Guardar</button>
                </div>
            </div>



        </div>
        <?php $ingresos = new ControladorIngresos();
        $ingresos->ctrRegistrarIngresos(); ?>
    </form>
    <br>
    <div class="container-fluid">
        <table class="table table-bordered table-striped dt-responsive tablas">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Cantidad</th>
                    <th>Concepto</th>
                    <th>Fecha Ingreso</th>
                    <th>Usuario</th>
                    <?php if ($_SESSION['perfil'] == "Administrador") : ?>
                        <!-- <th>Acciones</th> -->
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody>
                <?php $ingresos = ControladorIngresos::ctrMostraringresos();
                foreach ($ingresos as $key => $value) :

                ?>
                    <tr>
                        <td><?php echo $value['id'] ?></td>
                        <td><?php echo $value['cantidad'] ?></td>
                        <td><?php echo $value['concepto'] ?></td>
                        <td><?php echo $value['fecha_ingreso'] ?></td>
                        <td><?php echo $value['usuario'] ?></td>
                        <?php if ($_SESSION['perfil'] == "Administrador") : ?>
                            <!-- <td><button class="btn-sm btn-danger btnBorrarIngreso" idIngreso="<?php echo $value['id'] ?>"><i class="fa fa-trash"></i></button></td> -->
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>

            </tbody>

        </table>
    </div>
</section>
<?php $borrarIngreso = new ControladorIngresos();
$borrarIngreso->ctrBorraringreso() ?>
<!-- /.content -->