 <?php

  if ($_SESSION["perfil"] == "Vendedor" || $_SESSION['perfil'] == "Tecnico") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
  }

  ?>
 <div class="jumbotron jumbotron-fluid">
   <div class="container-fluid">
     <h3 class="display-5">Administrar productos</h3>
     <div class="btn-group float-right">
       <button class="btn btn-dark" data-toggle="modal" data-target="#modalAgregarProducto">
         <i class="fas fa-plus"></i>
         Agregar producto

       </button>
       <!-- Button trigger modal -->
       <!-- <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal">
               Agregar producto
             </button> -->

     </div>
   </div>
 </div>


 <section class="container-fluid">

   <div class="card">

     <div class="card-header with-border">


       <?php
        $item = null;
        $valor = null;
        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor); ?>
       <form action="excel/descargar-excel.php">
         <div class="row">
           <div class="col-md-2 col-12 mb-3">
             <button class="btn btn-success" title="Exportar a excel" id="btnProductoExcel">
             <i class="fas fa-file-excel"></i> Exportar a excel
             </button>
           </div>
           <div class="col-md-4 col-12">
             <select name="categoriaP" id="" data-placeholder="Seleccione una categoría (Opcional)" class="form-control mySelect2">
               <option value="todo">Seleccione una categoría (Opcional)</option>
               <?php foreach ($categorias as $key => $value) : ?>
                 <option value="<?php echo $value['id'] ?>">
                   <?php echo $value['categoria'] ?>
                 </option>
               <?php endforeach; ?>
             </select>
           </div>
         </div>
         <input type="hidden" value="producto" name="producto">
       </form>
     </div>
     <div class="card-body">
       <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">

         <thead>

           <tr>

             <th style="width:10px">#</th>
             <th>Generar etiqueta</th>
             <th>Imagen</th>
             <th>Código</th>
             <th>Descripción</th>
             <th>Categoría</th>
             <th>Stock</th>
             <th>Precio de compra</th>
             <th>Precio de venta</th>
             <th>Precio de mayoreo</th>

             <th>Agregado</th>
             <th>Acciones</th>

           </tr>

         </thead>

       </table>

       <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

     </div>

   </div>

 </section>


 <!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

 <div id="modalAgregarProducto" class="modal fade" role="dialog">

   <div class="modal-dialog">

     <div class="modal-content">

       <form role="form" method="post" enctype="multipart/form-data">

         <!--=====================================
        CABEZA DEL MODAL
        ======================================-->


         <div class="modal-header bg-dark">

           

           <h4 class="modal-title">Agregar producto</h4>

         </div>

         <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

         <div class="modal-body">

           <div class="card-body">

             <div class="alert alert-secondary" role="alert">
               <h5 class="alert-heading">Campos obligatorios (*)</h5>

             </div>


             <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

             <div class="form-group">
               <label for="nuevaCategoria">Selecione una categoría *</label>

               <div class="input-group">

                 <span class="input-group-text"><i class="fa fa-th"></i></span>

                 <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>

                   <option value="">Selecionar categoría</option>

                   <?php

                    $item = null;
                    $valor = null;

                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                    foreach ($categorias as $key => $value) {

                      echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                    }

                    ?>

                 </select>

               </div>

             </div>

             <!-- ENTRADA PARA EL CÓDIGO -->

             <div class="form-group">

               <label for="nuevoCodigo">Ingrese el código del producto *</label>


               <div class="input-group">

                 <span class="input-group-text"><i class="fa fa-code"></i></span>

                 <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" required>

               </div>

             </div>

             <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">

               <label for="nuevaDescripcion">Ingrese una descipción / marca / modelo / ect. *</label>

               <input type="text" class="form-control input-lg" data-role="tagsinput" name="nuevaDescripcion" placeholder="Ingresar descripción" required>

             </div>

             <!-- ENTRADA PARA STOCK -->
             <div class="row">
               <div class="form-group col-md-6 col-12">
                 <label for="nuevoStock">Ingrese la cantidad en existencia * </label>


                 <div class="input-group">

                   <span class="input-group-text"><i class="fa fa-check"></i></span>

                   <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

                 </div>


               </div>
               <!-- <div class="form-group col-md-6 col-12">
                 <label for="nuevoStock">Ingrese la cantidad en existencia minima.</label>


                 <div class="input-group">

                   <span class="input-group-text"><i class="fa fa-check"></i></span>

                   <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Ingrese la cantidad en existencia minima.">

                 </div>


               </div> -->

             </div>



             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

               <div class="col-xs-6">

                 <label for="">Costo del producto *</label>

                 <div class="input-group">

                   <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>

                   <input type="text" class="form-control input-lg efectivoFormat" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Costo de compra" required>

                 </div>

               </div>

               <!-- ENTRADA PARA PRECIO VENTA -->

               <div class="col-xs-6">
                 <label for="">Precio de venta * </label>


                 <div class="input-group">

                   <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>

                   <input type="text" class="form-control input-lg efectivoFormat" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio de venta" required>

                 </div>

                 <br>

                 <!-- CHECKcard PARA PORCENTAJE -->

                 <!-- <div class="col-xs-6">

                   <div class="form-group">

                     <label>

                       <input type="checkcard" class="minimal porcentaje">
                       Utilizar procentaje
                     </label>

                   </div>

                 </div> -->

                 <!-- ENTRADA PARA PORCENTAJE -->

                 <!-- <div class="col-xs-6" style="padding:0">

                   <div class="input-group">

                     <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                     <span class="input-group-text"><i class="fa fa-percent"></i></span>

                   </div>

                 </div> -->

               </div>
               <div class="col-xs-6">
                 <label for="">Precio de venta a mayoreo</label>


                 <div class="input-group">

                   <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>

                   <input type="text" class="form-control input-lg efectivoFormat" id="nuevoPrecioMayoreo" name="nuevoPrecioMayoreo" step="any" min="0" placeholder="Precio de venta a mayoreo">

                 </div>

                 <br>

                 <!-- CHECKcard PARA PORCENTAJE -->

                 <!-- <div class="col-xs-6">

                   <div class="form-group">

                     <label>

                       <input type="checkcard" class="minimal porcentaje">
                       Utilizar procentaje
                     </label>

                   </div>

                 </div> -->

                 <!-- ENTRADA PARA PORCENTAJE -->

                 <!-- <div class="col-xs-6" style="padding:0">

                   <div class="input-group">

                     <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                     <span class="input-group-text"><i class="fa fa-percent"></i></span>

                   </div>

                 </div> -->

               </div>

             </div>

             <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">

               <div class="panel">SUBIR IMAGEN</div>

               <input type="file" class="nuevaImagen" name="nuevaImagen">

               <p class="help-block">Peso máximo de la imagen 2MB</p>

               <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

             </div>

           </div>

         </div>

         <!--=====================================
        PIE DEL MODAL
        ======================================-->

         <div class="modal-footer">

           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

           <button type="submit" class="btn btn-dark">Guardar producto</button>

         </div>

       </form>

       <?php

        $crearProducto = new ControladorProductos();
        $crearProducto->ctrCrearProducto();

        ?>

     </div>

   </div>

 </div>




 <!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

 <div id="modalEditarProducto" class="modal fade" role="dialog">

   <div class="modal-dialog">

     <div class="modal-content">

       <form role="form" method="post" enctype="multipart/form-data">

         <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

         <div class="modal-header bg-dark">

           

           <h4 class="modal-title">Editar producto</h4>

         </div>

         <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

         <div class="modal-body">

           <div class="card-body">

             <div class="alert alert-secondary" role="alert">
               <h5 class="alert-heading">Campos obligatorios (*)</h5>

             </div>


             <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

             <div class="form-group">
               <label for="">Categoría *</label>

               <div class="input-group">

                 <span class="input-group-text"><i class="fa fa-th"></i></span>

                 <select class="form-control input-lg" name="editarCategoria" readonly required>

                   <option id="editarCategoria"></option>

                 </select>

               </div>

             </div>

             <!-- ENTRADA PARA EL CÓDIGO -->

             <div class="form-group">

               <label for="">Código del producto *</label>


               <div class="input-group">

                 <span class="input-group-text"><i class="fa fa-code"></i></span>

                 <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

               </div>

             </div>

             <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
               <label for="nuevaDescripcion">Ingrese una descipción / marca / modelo / ect. *</label>

               <input type="text" class="form-control input-lg" data-role="tagsinput" id="editarDescripcion" name="editarDescripcion" value="" required>

             </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">

               <div class="input-group">

                 <span class="input-group-text"><i class="fa fa-check"></i></span>

                 <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

               </div>

             </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

               <div class="col-xs-6">
                 <label for="">Costo del producto</label>

                 <div class="input-group">

                   <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>

                   <input type="text" class="form-control input-lg efectivoFormat" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" required>

                 </div>

               </div>

               <!-- ENTRADA PARA PRECIO VENTA -->

               <div class="col-xs-6">
                 <label for="">Precio venta</label>

                 <div class="input-group">

                   <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>

                   <input type="text" class="form-control efectivoFormat input-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" required>

                 </div>

                 <br>

                 <!-- CHECKcard PARA PORCENTAJE -->

                 <!-- <div class="col-xs-6">

                   <div class="form-group">

                     <label>

                       <input type="checkcard" class="minimal porcentaje" checked>
                       Utilizar procentaje
                     </label>

                   </div>

                 </div> -->

                 <!-- ENTRADA PARA PORCENTAJE -->

                 <!-- <div class="col-xs-6" style="padding:0">

                   <div class="input-group">

                     <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                     <span class="input-group-text"><i class="fa fa-percent"></i></span>

                   </div>

                 </div> -->

               </div>
               <div class="col-xs-6">
                 <label for="">Precio de venta a mayoreo</label>


                 <div class="input-group">

                   <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>

                   <input type="text" class="form-control input-lg efectivoFormat" id="editarPrecioMayoreo" name="editarPrecioMayoreo" step="any" min="0" placeholder="Precio de venta a mayoreo">

                 </div>

                 <br>

                 <!-- CHECKcard PARA PORCENTAJE -->

                 <!-- <div class="col-xs-6">

                   <div class="form-group">

                     <label>

                       <input type="checkcard" class="minimal porcentaje">
                       Utilizar procentaje
                     </label>

                   </div>

                 </div> -->

                 <!-- ENTRADA PARA PORCENTAJE -->

                 <!-- <div class="col-xs-6" style="padding:0">

                   <div class="input-group">

                     <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                     <span class="input-group-text"><i class="fa fa-percent"></i></span>

                   </div>

                 </div> -->

               </div>

             </div>

             <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">

               <div class="panel">SUBIR IMAGEN</div>

               <input type="file" class="nuevaImagen" name="editarImagen">

               <p class="help-block">Peso máximo de la imagen 2MB</p>

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

           <button type="submit" class="btn btn-dark">Guardar cambios</button>

         </div>

       </form>

       <?php

        $editarProducto = new ControladorProductos();
        $editarProducto->ctrEditarProducto();

        ?>

     </div>

   </div>

 </div>

 <?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto->ctrEliminarProducto();






  ?>

 <!-- Modal -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="myModalLabel">Agregar producto</h4>
       </div>
       <form action="#" method="post" enctype="multipart/form-data">
         <div class="modal-body">
           <div class="row">
             <div class="col-12 col-md-12">
               <ol class="breadcrumb">
                 <li><a href="#">DETALLE GENERAL</a></li>
               </ol>
             </div>
             <div class="form-group col-md-4 col-12">
               <label for="my-input">Código de barras</label>
               <span class="input-group-text"><i class="fas fa-barcode"></i></span>
               <input id="my-input" class="form-control" type="text" name="">
             </div>
             <div class="form-group col-md-8 col-12">
               <label for="my-input">Nombre / Marca / Descipción</label>
               <span class="input-group-text"><i class="fa fa-product-hunt"></i></span>
               <input id="my-input" class="form-control" type="text" name="">
             </div>
             <div class="form-group col-md-12 col-12">
               <label for="my-input">Caracteristicás</label>
               <span class="input-group-text"><i class="fa fa-product-hunt"></i></span>
               <input id="my-input" class="form-control" type="text" name="">
             </div>
             <div class="col-12 col-md-12">
               <ol class="breadcrumb">
                 <li><a href="#">INVENTARIO</a></li>
               </ol>
             </div>
             <div class="form-group col-md-4 col-12">
               <label for="my-input">Cantidad en existencia</label>
               <span class="input-group-text"><i class="fa fa-product-hunt"></i></span>
               <input id="my-input" class="form-control" type="number" name="">
             </div>
             <div class="form-group col-md-4 col-12">
               <label for="my-input">Cantidad en existencia mínima</label>
               <span class="input-group-text"><i class="fa fa-product-hunt"></i></span>
               <input id="my-input" class="form-control" type="number" name="">
             </div>
             <div class="form-group col-md-4 col-12">
               <label for="my-input">Precio de compra</label>
               <span class="input-group-text"><i class="fa fa-product-hunt"></i></span>
               <input id="my-input" class="form-control" type="text" name="">
             </div>
             <div class="form-group col-md-4 col-12">
               <label for="my-input disabled">Nótificar por correo cantidad mínima</label>
               <span class="input-group-text"><i class="fa fa-product-hunt"></i></span>
               <input id="my-input" class="form-control" readonly type="text" value="próxiamente..." name="">
             </div>
             <div class="col-12 col-md-12">
               <ol class="breadcrumb">
                 <li><a href="#">PRECIOS</a></li>
               </ol>
             </div>
             <div class="form-group col-md-4 col-12">
               <label for="my-input">Precio de venta</label>
               <span class="input-group-text"><i class="fa fa-product-hunt"></i></span>
               <input id="my-input" class="form-control" type="text" name="">
             </div>
             <div class="form-group col-md-4 col-12">
               <label for="my-input">Precio de mayoreo</label>
               <span class="input-group-text"><i class="fa fa-product-hunt"></i></span>
               <input id="my-input" class="form-control" type="text" name="">
             </div>
             <div class="col-12 col-md-12">
               <ol class="breadcrumb">
                 <li><a href="#">IMAGEN</a></li>
               </ol>
             </div>


             <div class="form-group col-md-12 col-12">

               <!-- Nav tabs -->
               <ul class="nav nav-tabs" role="tablist">
                 <li role="presentation" class="active"><a href="#pc" aria-controls="pc" role="tab" data-toggle="tab">Cargar desde mi PC</a></li>
                 <li role="presentation"><a href="#url" aria-controls="url" role="tab" data-toggle="tab">Cargar por url</a></li>
               </ul>

               <!-- Tab panes -->
               <div class="tab-content">
                 <div role="tabpanel" class="tab-pane active" id="pc">
                   <div class="form-group">

                     <div class="panel">SUBIR IMAGEN</div>

                     <input type="file" class="nuevaImagen" name="editarImagen">

                     <p class="help-block">Peso máximo de la imagen 2MB</p>

                     <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                     <input type="hidden" name="imagenActual" id="imagenActual">

                   </div>
                 </div>
                 <div role="tabpanel" class="tab-pane" id="url">
                   <span class="input-group-text"><i class="fa fa-product-hunt"></i></span>
                   <input id="my-input" class="form-control" type="text" name="">

                 </div>
               </div>


             </div>





           </div>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-dark">Save changes</button>
         </div>
       </form>
     </div>
   </div>
 </div>