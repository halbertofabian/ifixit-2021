<aside class="main-sidebar elevation-4 sidebar-light-danger">
    <!-- Brand Logo -->
    <a href="<?php echo $url ?>" class="brand-link">
        <?php
        if (isset($_SESSION['ruta_logo'])) {

            if ($_SESSION['ruta_logo'] != "") {
                echo '<img src="' . $url . $_SESSION['ruta_logo'] . '" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">';
            } else {
                echo '<img src="' . $url . 'vistas/img/plantilla/ifixit_x.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">';
            }
        } else {
            echo '<img src="' . $url . 'vistas/img/plantilla/ifixit_x.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">';
        }

        ?>
        <!-- <img src="<?php echo $url ?>vistas/img/plantilla/ifixit_x.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">
            <img src="<?php echo $url ?>vistas/img/plantilla/ifixit.png" width="80" alt="">
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2 ">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <div class="image text-center d-md-none">
                    <img src="<?php echo $_SESSION["foto"] ?>" class="img-circle elevation-3" width="65" alt="">
                </div>
                <li class="nav-item has-treeview d-md-none">
                    <a href="#" class="nav-link">

                        <i class="nav-icon fas fa-id-card-alt"></i>
                        <p class="text-danger">
                            <?php echo $_SESSION["usuario"] ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>

                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="<?php echo $url ?>mi-perfil" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mi perfil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Notificaciones</p>
                            </a>
                        </li> -->
                        <?php if ($_SESSION['perfil'] == "Administrador") : ?>
                <li class="nav-item">
                    <a class="nav-link"  href="#">
                        <i class="fa fa-university"></i>
                        <span class=""><?php echo $_SESSION["nom_suc"]; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <form action="#" method="post">
                                <div class="form-group">
                                    <label for="my-input">Seleccione una sucursal</label>
                                    <select name="ingSucursal" class="form-control" id="">
                                        <?php $susc = ControladorSucursal::ctrMostrarSucursalPropietario($_SESSION["suscriptor"]); ?>

                                        <?php foreach ($susc as $key => $item) : ?>
                                            <option value="<?php echo $item['nombre'] ?>"><?php echo $item['nombre'] ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <button type="submit" name="btnCambiarSucursal" class="btn btn-dark  mt-2 mb-2">Acceder</button>
                                </div>
                                <?php

                                $login = new ControladorUsuarios();
                                $login->ctrCambiarSucursal();

                                ?>

                            </form>
                            </li>
                
            <?php endif; ?>
                        
                        <li class="nav-item">
                            <a href="<?php echo $url ?>salir" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Salir</p>
                            </a>
                        </li>

                    </ul>

                </li>


                <?php
                if ($_SESSION['perfil'] == 'Administrador') {
                    $app->getComponents('menu-admin');
                } elseif ($_SESSION['perfil'] == 'Vendedor' || $_SESSION["perfil"] == "Recepcionista") {
                    $app->getComponents('menu-vendedor');
                } elseif ($_SESSION['perfil'] == 'Tecnico' || $_SESSION['perfil'] == 'Tecnico-editor') {
                    $app->getComponents('menu-tecnico');
                }
                ?>









            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Modal -->

<?php

if ($_SESSION['perfil'] == 'Administrador') : ?>
    <div class="modal fade" id="mdlAddSale" tabindex="-1" role="dialog" aria-labelledby="mdlAddSaleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mdlAddSaleLabel">Nueva compra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formNewSale">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="my-input">Busque el producto</label><br>


                                    <select name="inputSaleSelectedCode" id="inputSaleSelectedCode" class="form-control mySelect2">
                                        <option value="1" selected>Seleccione un producto</option>
                                    </select>
                                    <br>
                                    <label class="load-product"></label>
                                </div>

                            </div>

                            <div class="col-md-8 col-12">
                                <div class="form-group">
                                    <label for="inputSaleCode">Código</label>
                                    <input id="inputSaleCode" class="form-control" type="text" name="inputSaleCode" readonly>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="inputSaleStock" data-toggle="tooltip" data-placement="top" title="Se sumarán con las piezas existentes">Nuevas piezas</label>
                                    <input id="inputSaleStock" class="form-control" min="1" type="number" name="inputSaleStock">
                                </div>
                            </div>

                            <div class="col-12 mb-1">
                                <label for="">¿Mismo costo?</label>

                                <input type="text" name="inputSalePriceProduct" id="inputSalePriceProduct" class="form-control efectivoFormat" placeholder="Dejar en blanco si no quieres cambiar el costo de producto">
                            </div>
                            <div class="col-12 mb-1">
                                <label for="">¿Mismo precio venta?</label>

                                <input type="text" name="inputSalePriceSale" id="inputSalePriceSale" class="form-control efectivoFormat" placeholder="Dejar en blanco si no quieres cambiar el precio de venta">
                            </div>
                            <div class="col-12 mb-1">
                                <label for="">¿Mismo precio mayoreo?</label>

                                <input type="text" name="inputSalePriceMayoreo" id="inputSalePriceMayoreo" class="form-control efectivoFormat" placeholder="Dejar en blanco si no quieres cambiar el precio de mayoreo">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark btnGuardarP">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php elseif ($_SESSION['perfil'] == 'Vendedor' || $_SESSION['perfil'] == 'Recepcionista') : ?>
    <div class="modal fade" id="mdlAddSaleV" tabindex="-1" role="dialog" aria-labelledby="mdlAddSaleVLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mdlAddSaleVLabel">Nueva compra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formNewSale">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="my-input">Busque el producto</label><br>


                                    <select name="inputSaleSelectedCode" id="inputSaleSelectedCode" class="form-control mySelect2">
                                        <option value="1" selected>Seleccione un producto</option>
                                    </select>
                                    <br>
                                    <label class="load-product"></label>
                                </div>

                            </div>

                            <div class="col-md-8 col-12">
                                <div class="form-group">
                                    <label for="inputSaleCode">Código</label>
                                    <input id="inputSaleCode" class="form-control" type="text" name="inputSaleCode" readonly>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="inputSaleStock" data-toggle="tooltip" data-placement="top" title="Se sumarán con las piezas existentes">Nuevas piezas</label>
                                    <input id="inputSaleStock" class="form-control" min="1" type="number" name="inputSaleStock">
                                </div>
                            </div>

                            <div class="col-12 mb-1">


                                <input type="hidden" name="inputSalePriceProduct" id="inputSalePriceProduct" class="form-control efectivoFormat" placeholder="Dejar en blanco si no quieres cambiar el costo de producto">
                            </div>
                            <div class="col-12 mb-1">


                                <input type="hidden" name="inputSalePriceSale" id="inputSalePriceSale" class="form-control efectivoFormat" placeholder="Dejar en blanco si no quieres cambiar el precio de venta">
                            </div>
                            <div class="col-12 mb-1">


                                <input type="hidden" name="inputSalePriceMayoreo" id="inputSalePriceMayoreo" class="form-control efectivoFormat" placeholder="Dejar en blanco si no quieres cambiar el precio de mayoreo">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark btnGuardarP">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endif ?>




<script>
    $(".mdlAddSale").on("click", function() {
        var datos = new FormData();
        datos.append("allProducts", true)
        $.ajax({
            url: "ajax/productos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                $(".load-product").html("Cargando...")
            },
            success: function(respuesta) {
                $(".load-product").html("")

                respuesta.forEach(pdt => {
                    let $option = $('<option />', {
                        text: pdt.codigo + "-" + pdt.descripcion,
                        value: pdt.codigo,
                    });
                    $('#inputSaleSelectedCode').prepend($option);

                });

                $('#inputSaleSelectedCode').value("1");


            }

        })
    })

    var precios = new Array(3);
    var stock = 0;

    $("#inputSaleSelectedCode").on("change", function() {

        var datos = new FormData();
        datos.append("idBarras", $("#inputSaleSelectedCode").val())
        $.ajax({
            url: "ajax/productos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                $(".load-product").html("Cargando...")
            },
            success: function(respuesta) {
                $(".load-product").html()
                $("#inputSaleCode").val(respuesta.codigo);
                precios[0] = respuesta.precio_compra;
                precios[1] = respuesta.precio_venta;
                precios[2] = respuesta.precio_mayoreo;
                stock = respuesta.stock;

            }
        })
    })

    $(document).on("submit", "#formNewSale", function(e) {
        e.preventDefault();
        if ($("#inputSaleSelectedCode").val() == "1") {
            toastr.warning('Selecciona un código valido', 'Error')
            return;
        }
        if ($("#inputSaleStock").val() <= 0) {
            toastr.warning('Introduce una nueva cantidad valida', 'Error')
            return;
        }

        //console.log($("#inputSalePriceProduct").val())

        var precioP, precioV, precioM;

        if ($("#inputSalePriceProduct").val() > 0) {
            precioP = $("#inputSalePriceProduct").val();

        } else {
            precioP = precios[0];
        }
        if ($("#inputSalePriceSale").val() > 0) {
            precioV = $("#inputSalePriceSale").val();

        } else {
            precioV = precios[1]
        }
        if ($("#inputSalePriceMayoreo").val() > 0) {
            precioM = $("#inputSalePriceMayoreo").val();

        } else {
            precioM = precios[2]
        }

        var nuevoStock = Number($("#inputSaleStock").val()) + Number(stock);

        var data = new FormData();

        data.append("codigoP", $("#inputSaleSelectedCode").val())
        data.append("stockP", nuevoStock)
        data.append("precioP", precioP)
        data.append("precioV", precioV)
        data.append("precioM", precioM)
        data.append("btnChangeP", precioM)

        $.ajax({
            url: "ajax/productos.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function() {
                $(".btnGuardarP").attr("disabled", true)
                $(".btnGuardarP").html("Guardando producto...")
            },
            success: function(respuesta) {
                $(".btnGuardarP").attr("disabled", false)
                $(".btnGuardarP").html("Guardar producto")
                if (respuesta) {
                    toastr.success('Producto guardado', 'Muy bien')
                }

                $("#inputSaleStock").val("")
                $('#inputSaleCode').val("");
                $('#inputSalePriceProduct').val("");
                $('#inputSalePriceSale').val("");
                $('#inputSalePriceMayoreo').val("")
                $('#inputSaleSelectedCode').val("1");

            }
        })

    })


    function limpiarCampos() {
        //
    }
</script>