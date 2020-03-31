<div class="container mt-4">

    <h2>Bienvenido (a) <?php echo $_SESSION['nombre'] ?> 🙋‍♂️ a la versión 3.0.1 de ifixitmor</h2>
    <h4 class="mb-3">
        Queremos mejorar la experiencia de usuario, para ello elije la sucursal a la que quieres acceder e indica la cantidad con la que inicias en caja.
    </h4>

    <?php

    if ($_SESSION['propietario'] == $_SESSION['usuario']) :
        $susc = ControladorSucursal::ctrMostrarSucursalPropietario($_SESSION['suscriptor']);

    ?>

        <form action="" method="post">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="text-dark" for="my-ingSucursal">Seleccione la sucursal</label><br>
                        <select name="ingSucursal" class="form-control" id="ingSucursal">
                            <?php foreach ($susc as $key => $value) : ?>
                                <option value="<?php echo $value['nombre'] ?>"><?php echo $value['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <?php
                    if ($_SESSION['perfil'] != "Tecnico") : ?>

                        <div class="form-group">
                            <label class="text-dark" for="nuevoValorEfectivoSucusarl">Cantidad (Opcional)</label>
                            <p>Al inicio del día usted puede indicar con que cantidad cuenta en caja (Lo puede dejar en blanco)</p>
                            <input id="nuevoValorEfectivoSucusarl" class="form-control nuevoValorEfectivoSucusarl" type="text" placeholder="$00.00" name="nuevoValorEfectivoSucusarl">
                        </div>


                    <?php endif; ?>

                    <button type="submit" name="btnCargarSucursal" class="btn btn-block btn-dark">Acceder a la sucursal</button>



                    <?php
                    $cargarSucursal = new ControladorUsuarios();
                    $cargarSucursal->ctrCargarSucursal();
                    ?>
                </div>
            </div>
        </form>


    <?php else : ?>

        <?php

        $susc = ControladorUsuarios::ctrSucursalesPermisoUsuario($_SESSION['usuario']);

        $arraySuc = array();

        $arraySuc = explode(",", $susc['acceso_sucursal']);

        //var_dump($arraySuc);

        if ($arraySuc[0] == "") :
        ?>
            <div class="alert alert-warning" role="alert">
                Querido(a) se hicieron unos cambios en el sistema, no tienes acceso a ninguna sucursal. De favor pídele a tu administrador que te asigne al menos una sucursal, dicha configuración la puede hacer en el módulo de usuarios.
                <a href="<?php echo $url ?>sucursal" class="alert-link">volver a cargar</a>
            </div>


        <?php else : ?>
            <form action="" method="post">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="text-dark" for="my-ingSucursal">Seleccione la sucursal</label><br>
                            <select name="ingSucursal" class="form-control" id="ingSucursal">
                                <?php foreach ($arraySuc as $key => $value) : ?>
                                    <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <?php
                        if ($_SESSION['perfil'] != "Tecnico") : ?>

                            <div class="form-group">
                                <label class="text-dark" for="nuevoValorEfectivoSucusarl">Cantidad (Opcional)</label>
                                <p>Al inicio del día usted puede indicar con que cantidad cuenta en caja (Lo puede dejar en blanco)</p>
                                <input id="nuevoValorEfectivoSucusarl" class="form-control nuevoValorEfectivoSucusarl" type="text" placeholder="$00.00" name="nuevoValorEfectivoSucusarl">
                            </div>


                        <?php endif; ?>

                        <button type="submit" name="btnCargarSucursal" class="btn btn-block btn-dark">Acceder a la sucursal</button>



                        <?php
                        $cargarSucursal = new ControladorUsuarios();
                        $cargarSucursal->ctrCargarSucursal();
                        ?>
                    </div>
                </div>
            </form>
    <?php endif;
    endif;
    ?>

</div>

<script src="<?php echo ControladorPlantilla::getRute(); ?>vistas/js/plantilla.js"></script>