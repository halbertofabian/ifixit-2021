<!-- Automatic element centering -->
<?php if (!isset($_GET["sucursal"])) {
    echo '<script>

    window.location = "inicio";

  </script>';

    return;
} ?>
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <a href="#"><b><?php echo $_GET["sucursal"]; ?></b></a>
    </div>
    <!-- User name -->
    <div class="lockscreen-name text-center"><span class="hidden-xs"><?php echo $_SESSION["usuario"]; ?></span></div>
    <br>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <?php

            if ($_SESSION["foto"] != "") {

                echo '<img src="' . $_SESSION["foto"] . '" class="user-image">';
            } else {


                echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
            }


            ?>

        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" method="post">
            <div class="input-group">
                <input type="password" class="form-control" placeholder="password" name="ingPassword">
                <input type="hidden" class="form-control" placeholder="password" name="ingUsuario" value="<?php echo $_SESSION["usuario"]; ?>">
                <input type="hidden" class="form-control" placeholder="password" name="ingSucursal" value="<?php echo $_GET["sucursal"]; ?>">

                <div class="input-group-btn">
                    <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
            <?php

            $login = new ControladorUsuarios();
            $login->ctrIngresoUsuario();

            ?>
        </form>
        <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        Introduce tu contraseña para iniciar sessión
    </div>
    <div class="text-center">
        <a href="salir">O inicia sessión con otro usuario</a>
    </div>

</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>