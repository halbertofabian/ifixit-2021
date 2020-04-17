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
        <h3 class="display-5">Intercambio de inventario</h3>

    </div>
</div>


<section class="container-fluid">

    <div class="card">

        <?php
        if (
            $_SESSION['tipo_suc'] == "IFIXIT INDIVIDUAL" ||
            $_SESSION['tipo_suc'] == "IFIXIT INDIVIDUAL-ANUAL" ||
            $_SESSION['tipo_suc'] == "IFIXIT PRUEBA"
        ) :

        ?>

            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading"></h4>
                    <p> Lo sentimos :( no cuentas con las versión IFIXIT DUO o IFIXIT PRO</p>
                    <p class="mb-0">Actualiza a una de estas versiones para poder disfrutar de grandes beneficios</p>
                </div>

                <?php include_once 'vistas/modulos/caracteristicas-paquete.php'; ?>
            </div>

        <?php return;
        endif; ?>

        <div class="card-header with-border">


            <?php $sucursal = ControladorSucursal::ctrMostrarSucursal();
            $susc = ControladorSucursal::ctrMostrarSucursalPropietario($sucursal['propietario']);

            //echo var_dump($susc);
            ?>

            <h3 class="text-primary"> <?php echo strtoupper($sucursal['nombre']); ?> </h3>



        </div>

        <div class="card-body">
            <strong>Sucursales</strong>

            <div class="float-right">
                <a href="extensiones/tcpdf/pdf/reporte-movimientos-traspaso.php" class="btn btn-white" target="_blank">

                    <strong><i class="fas fa-eye"></i> Ver traspasos</strong>
                </a>
            </div>





            <ul>
                <?php foreach ($susc as $key => $item) : ?>

                    <li>

                        <?php echo $item['nombre'] ?>

                    </li>
                <?php endforeach; ?>

            </ul>



            <table class="table tablas table-bordered table-striped dt-responsive tablatraspasos" width="100%">

                <thead>

                    <tr>

                        <th style="width:10px">#</th>
                        <th>Imagen</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Stock</th>

                        <th>Agregado</th>
                        <th>Traspasar</th>

                    </tr>

                </thead>
                <tbody>
                    <?php
                    $item = null;
                    $valor = null;
                    $orden = "id";

                    $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
                    for ($i = 0; $i < count($productos); $i++) :
                    ?>
                        <tr>
                            <td><?php echo $i + 1 ?></td>
                            <td><?php echo "<img src='" . $productos[$i]["imagen"] . "' width='40px'>"; ?></td>
                            <?php
                            $item = "id";
                            $valor = $productos[$i]["id_categoria"];

                            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor); ?>
                            <td><?php echo $productos[$i]["codigo"] ?></td>
                            <td><?php echo $productos[$i]["descripcion"] ?></td>
                            <td><?php echo $categorias["categoria"]; ?></td>
                            <td><?php echo "<strong class='text-success'>" . $productos[$i]["stock"] . "</strong>"; ?></td>

                            <td><?php echo $productos[$i]["fecha"]; ?></td>
                            <td>


                                <div class="btn-group"><button class="btn btn-dark btnTraspasoProducto" idProducto="<?php echo $productos[$i]["id"] ?>" data-toggle="modal" data-target="#modalTraspaso"><i class="fa  fa-retweet"></i></button></div>

                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>

            </table>


        </div>

    </div>

</section>

</div>




<div id="modalTraspaso" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header bg-dark">



                    <h4 class="modal-title">Traspaso de mercancia</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="card-body">


                        <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

                        <div class="form-group">
                            <label for="">Categoría</label>
                            <div class="input-group">


                                <span class="input-group-text"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" name="editarCategoria" readonly required>

                                    <option id="editarCategoria"></option>

                                </select>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL CÓDIGO -->

                        <div class="form-group">
                            <label for="">Código</label>
                            <div class="input-group">

                                <span class="input-group-text"><i class="fa fa-code"></i></span>

                                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA DESCRIPCIÓN -->

                        <div class="form-group">
                            <label for="">Descripción</label>

                            <div class="input-group">



                                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required readonly>

                            </div>

                        </div>

                        <!-- ENTRADA PARA STOCK -->


                        <div class="form-group">
                            <label for="">Elija la sucursal a que va a traspasar la mercancia</label>

                            <div class="input-group">

                                <span class="input-group-text"><i class="fa  fa-university"></i></span>

                                <select class="form-control input-lg" name="sucursal">

                                    <?php foreach ($susc as $key => $item) : ?>

                                        <option value="<?php echo $item['nombre'] ?>">

                                            <?php echo $item['nombre'] ?>

                                        </option>
                                    <?php endforeach; ?>


                                </select>

                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Ingrese la cantidad a traspasar</label>

                            <div class="input-group">

                                <span class="input-group-text"><i class="fa fa-check"></i></span>

                                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required readonly>
                                <input type="number" class="form-control input-lg" id="editarStock1" name="editarStock1" min="0" required placeholder="Cantidad a traspasar">
                            </div>

                        </div>



                        <!-- ENTRADA PARA PRECIO COMPRA -->

                        <div class="form-group row">

                            <div class="col-md-6 col-12">
                                <label for="">Costo del producto</label>

                                <div class="input-group">


                                    <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>

                                    <input type="text" class="form-control input-lg efectivoFormat" step="any" min="0" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" required>

                                </div>

                            </div>

                            <!-- ENTRADA PARA PRECIO VENTA -->

                            <div class="col-md-6 col-12">
                                <label for="">Precio de venta</label>
                                <div class="input-group">



                                    <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>

                                    <input type="text" class="form-control input-lg efectivoFormat" id="editarPrecioVenta" step="any" min="0" name="editarPrecioVenta" step="any" min="0" required>

                                </div>

                                <br>

                                <!-- CHECKcard PARA PORCENTAJE -->



                                <!-- ENTRADA PARA PORCENTAJE -->



                            </div>

                            <div class="col-md-6">
                                <label for="">Precio de venta a mayoreo</label>


                                <div class="input-group">

                                    <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>

                                    <input type="text" class="form-control input-lg efectivoFormat" id="editarPrecioMayoreo" name="editarPrecioMayoreo" step="any" min="0" placeholder="Precio de venta a mayoreo">

                                </div>
                            </div>


                        </div>

                        <!-- ENTRADA PARA SUBIR FOTO -->

                        <div class="form-group">

                            <div class="panel">IMAGEN</div>



                            <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">


                            <input type="hidden" name="imagenActual" id="imagenActual">

                        </div>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-dark" name="btnIntercambio">Traspasar mercancia</button>

                </div>

            </form>

            <?php

            $traspasar = new ControladorTraspasos();
            $traspasar->intercamcio();

            ?>

        </div>

    </div>

</div>