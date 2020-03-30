<?php

if ($_SESSION["perfil"] == "Auxiliar" || $_SESSION['perfil'] == "Tecnico") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

    $app -> getComponents('pagina-construccion');
    return;

?>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h3 class="display-5">Caja de ventas</h3>
    </div>
</div>

<section class="container-fluid">

    <div class="row">

        <!--=====================================
      EL FORMULARIO
      ======================================-->

        <div class="col-md-5 col-12">

            <div class="card">

                <div class="card-header with-border">
                    <div class="card-title text-center">
                        Notas de remisión
                    </div>
                </div>

                <form role="form" method="post" class="formularioVenta">

                    <div class="card-body">

                        <div class="">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <span for="tipoVenta" class="text-danger">Tipo de venta</span>
                                    <select name="tipoVenta" class="form-control" id="tipoVenta">
                                        <option value="n">Normal</option>
                                        <option value="m">Mayoreo</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="row">
                                    <div class="col-12 col-md-12">
                                        Venta normal <input type="radio" name="tipoVenta" id="ventaNormal" checked>
                                        Venta mayoreo <input type="radio" name="tipoVenta" id="VentaMayoreo">
                                    </div>
                                </div> -->


                            <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-text"><i class="fa fa-user"></i></span>

                                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                                    <!--<input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">-->

                                </div>

                            </div>

                            <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================-->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-text"><i class="fa fa-key"></i></span>

                                    <?php

                                    $item = null;
                                    $valor = null;

                                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                                    if (!$ventas) {

                                        echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                                    } else {



                                        $codigo = $ventas['codigo'] + 1;

                                        $codigo;

                                        echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="' . $codigo . '" readonly>';
                                    }

                                    ?>


                                </div>

                            </div>

                            <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================-->

                            <div class="form-group">

                                <div class="input-group">

                                    <span class="input-group-text"><i class="fa fa-users"></i></span>

                                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                                        <option value="">Seleccionar cliente</option>

                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                                        foreach ($categorias as $key => $value) {

                                            echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                        }

                                        ?>

                                    </select>

                                    <!-- <span class="input-group-text"><button type="button" class="btn btn-default btn" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span> -->

                                </div>
                                <br>
                                <!-- <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label for="">Nombre del cliente</label>
                                            <input class="form-control" type="text" name="" placeholder="Nombre del cliente" aria-label="Recipient's " aria-describedby="my-addon">

                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label for="">Teléfono del cliente</label>
                                            <input class="form-control" type="text" name="" placeholder="Teléfono del cliente" aria-label="Recipient's " aria-describedby="my-addon" data-inputmask="'mask':'(999) 999-9999'" data-mask>

                                        </div>
                                    </div> -->


                            </div>

                            <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================-->

                            <div class="form-group row nuevoProducto">



                            </div>

                            <input type="hidden" id="listaProductos" name="listaProductos">

                            <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                            <button type="button" class="btn btn-default d-md-none btnAgregarProducto">Agregar producto</button>

                            <hr>

                            <div class="row">

                                <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->

                                <div class="col-8 float-right">

                                    <table class="table">

                                        <thead>

                                            <tr>
                                                <th class="text-danger">Descuento</th>
                                                <th>Total</th>
                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <td style="width: 50%">

                                                    <div class="input-group">

                                                        <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required value="0">

                                                        <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                                                        <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

                                                        <span class="input-group-text"><i class="fa fa-percent"></i></span>

                                                    </div>

                                                </td>

                                                <td style="width: 50%">

                                                    <div class="input-group">

                                                        <span class="input-group-text"><i class="ion ion-social-usd"></i></span>

                                                        <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                                                        <input type="hidden" name="totalVenta" id="totalVenta">


                                                    </div>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                            <hr>

                            <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                            <div class="form-group row ml-2">

                                <div class="col-md-4 mr-3" style="padding-right:0px">

                                    <div class="input-group">

                                        <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>

                                            <option value="Efectivo">Efectivo</option>
                                            <option value="TC">Tarjeta Crédito</option>
                                            <option value="TD">Tarjeta Débito</option>
                                        </select>

                                    </div>
                                </div>


                                <div class="cajasMetodoPago row mt-1">
                                    <div class="col-md-6 col-12">

                                        <div class="input-group">

                                            <span class="input-group-text"><i class="ion ion-social-usd"></i></span>

                                            <input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>

                                        </div>

                                    </div>

                                    <div class="col-md-6 col-12" id="capturarCambioEfectivo" style="padding-left:0px">

                                        <div class="input-group">

                                            <span class="input-group-text"><i class="ion ion-social-usd"></i></span>

                                            <input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">



                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit" class="btn btn-dark float-right">Hacer venta</button>

                    </div>

                    <?php

                    $guardarVenta = new ControladorVentas();
                    $guardarVenta->ctrCrearVenta();

                    ?>

                </form>



            </div>

        </div>

        <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

        <div class="col-md-7 hidden-sm hidden">

            <div class="card">

                <div class="card-header with-border">
                    <div class="card-title text-center">
                        Productos
                    </div>
                </div>

                <div class="card-body">

                    <!-- <table class="table table-bordered table-striped dt-responsive tablaVentas">

              <thead>

                <tr>
                  <th style="width: 10px">#</th>
                  <th>Acciones</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                 
                  <th>Imagen</th>
                </tr>

              </thead>

            </table> -->

                    <div class="row">
                        <div class="col-12 col-md-12">
                            <form class="formularioBusqueda" method="post" action="#" id="formularioBusqueda">

                                <div class="row">
                                    <div class="col-md-12 col-12">

                                        <div class="form-group">
                                            <label for="txtCode" class="sr-only">SCAN CODE</label>
                                            <input type="text" autofocus class="form-control" id="card-searchP" placeholder="INTRODUCE CODIGO DE BARRAS / ENTER (Recomendación usar lector de barras)">
                                        </div>

                                    </div>
                                </div>
                            </form>



                            <!-- <div class="col-12 form-group  mb-2">
                        <label for="card-searchAllP" class="sr-only">SEARCH ALL</label>
                        <input type="text" class="form-control" id="card-searchAllP" style="border: none;" placeholder="BUSQUEDA FILTRADA">
                    </div> -->

                            <div class="card-body" style="height: 500px; overflow-y: scroll;">
                                <div class="row" id="contentProductos">



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar cliente</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="card-body">

                        <!-- ENTRADA PARA EL NOMBRE -->
                        Campos obligatotios(*)
                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text"><strong>*</strong><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL DOCUMENTO ID -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text"><i class="fa fa-key"></i></span>

                                <input type="hidden" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento">

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL EMAIL -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>

                                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email">

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL TELÉFONO -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text"><i class="fa fa-phone"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Código</label>
                                <input type="text" class="form-control input-lg" placeholder="52" name="codigo-wp" value="" pattern="\d*" maxlength="2" id="codigo">
                            </div>
                            <div class="col-md-10">
                                <label for="">Número de whatsapp <i class="fa fa-whatsapp text-success" aria-hidden="true"></i></label>
                                <input type="text" class="form-control input-lg" placeholder="0000000000" name="numero-wp" pattern="\d*" maxlength="10" id="wsp">
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA DIRECCIÓN -->
                        <br>
                        <div class="form-group ">

                            <div class="input-group">

                                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección">

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>

                                <input type="hidden" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default float-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar cliente</button>

                </div>

            </form>

            <?php

            $crearCliente = new ControladorClientes();
            $crearCliente->ctrCrearCliente("crear-venta");

            ?>

        </div>

    </div>

</div>

<script src="vistas/js/app/caja.js"></script>