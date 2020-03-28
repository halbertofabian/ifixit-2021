<?php
class ControladorTraspasos
{
    public static function intercamcio()
    {
        if (isset($_POST['btnIntercambio'])) {
            $sucursal =  ModeloSucursal::mdlMostrarSucursal($_POST['sucursal']);

            $db_info = array(
                'db_name' => $sucursal['db_name'],
                'user_name' => $sucursal['user_name'],
                'password_db' => $sucursal['password_db'],
            );
            if ($_SESSION['nom_suc'] == $sucursal['nombre']) {
                echo '<script>

                swal({

                    type: "error",
                    title: "¡La sucursal es la misma, no puedes hacer el traspaso!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){
                    
                         window.history.back();

                    }

                });
            

            </script>';
                return;
            }

            date_default_timezone_set($_SESSION["zona"]);

            $fecha = date('Y-m-d');


            $hora = date('H:i:s');

            $valor1b = $fecha . ' ' . $hora;
            $producto =  ModeloTraspasos::issetItem(
                $db_info,
                'productos',
                'codigo',
                $_POST['editarCodigo']
            );
            //var_dump($producto);
            $stock = $_POST['editarStock1'] + $producto['stock'];
            $precioVenta = $_POST['editarPrecioVenta'];
            $precioCompra = $_POST['editarPrecioCompra'];
            $codigo = $_POST['editarCodigo'];

            $productos = array(
                'stock' => $stock,
                'precio_venta' => $precioVenta,
                'precio_compra' => $precioCompra,
                'codigo' => $codigo

            );

            $thisStock = $_POST['editarStock'] - $_POST['editarStock1'];

            if ($_POST['editarStock1'] > $_POST['editarStock'] || $_POST['editarStock'] == 0) {
                echo '<script>

                swal({

                    type: "error",
                    title: "¡No dispone de la suficiente cantidad para traspasar!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){
                    
                         window.history.back();

                    }

                });
            

            </script>';
                return;
            }


            if (!$producto) {
                // Crear Producto

                $categoria =  ModeloTraspasos::issetItem(
                    $db_info,
                    'categorias',
                    'categoria',
                    $_POST['editarCategoria']
                );

               $cat = !$categoria ? 0 : $_POST["editarCategoria"];
                
                if(isset($_POST["editarDescripcion"])){
            
                        if(preg_match('/^.+$/', $_POST["editarDescripcion"]) &&
                           preg_match('/^[0-9]+$/', $_POST["editarStock1"]) &&	
                           preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
                           preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){
            
                               /*=============================================
                            VALIDAR IMAGEN
                            =============================================*/


                  $ruta = $_POST['imagenActual'];

                            
            
                            $tabla = "productos";
            
                            $datos = array("id_categoria" => $cat,
                                           "codigo" => $_POST["editarCodigo"],
                                           "descripcion" => $_POST["editarDescripcion"],
                                           "stock" => $_POST["editarStock1"],
                                           "precio_compra" => $_POST["editarPrecioCompra"],
                                           "precio_venta" => $_POST["editarPrecioVenta"],
                                           "imagen" => $ruta);
            
                            $respuesta = ModeloTraspasos::mdlIngresarProducto($db_info,$tabla, $datos);
            
                            if($respuesta == "ok"){
            
                                echo'<script>
            
                                    swal({
                                          type: "success",
                                          title: "¡Producto traspasado con éxito!",
                                          showConfirmButton: true,
                                          confirmButtonText: "Cerrar"
                                          }).then(function(result){
                                                    if (result.value) {
            
                                                    window.location = "intercambios";
            
                                                    }
                                                })
            
                                    </script>';
                                    $actualizarStok = ModeloProductos::mdlActualizarProductoStok($thisStock, $codigo);
                                    $mov = array(
                                        'tipo' => 'TRASPASO',
                                        'numero_movimiento' => $codigo,
                                        'concepto' => 'Traspaso de ' . $_SESSION['nom_suc'] . ' -> ' . $sucursal['nombre'],
                                        'monto' => '',
                                        'cliente' => '',
                                        'fecha' => $valor1b,
                                        'usuario' => $_SESSION["nombre"],
                                        'extra' => '' . $_POST['editarStock1'] . ''
                    
                    
                                    );
                    
                                    $movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
            
                            }
            
            
                        }else{
            
                            echo'<script>
            
                                swal({
                                      type: "error",
                                      title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
                                      showConfirmButton: true,
                                      confirmButtonText: "Cerrar"
                                      }).then(function(result){
                                        if (result.value) {
            
                                        window.location = "intercambios";
            
                                        }
                                    })
            
                              </script>';
                        }
        }
            } else {
                // Ya existe, editar existencias



                $traspaso = ModeloTraspasos::updateProductoTraspaso($db_info, $productos);

                $actualizarStok = ModeloProductos::mdlActualizarProductoStok($thisStock, $codigo);

                $mov = array(
                    'tipo' => 'TRASPASO',
                    'numero_movimiento' => $codigo,
                    'concepto' => 'Traspaso de ' . $_SESSION['nom_suc'] . ' -> ' . $sucursal['nombre'],
                    'monto' => '',
                    'cliente' => '',
                    'fecha' => $valor1b,
                    'usuario' => $_SESSION["nombre"],
                    'extra' => '' . $_POST['editarStock1'] . ''


                );

                $movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
                echo '<script>

                swal({

                    type: "success",
                    title: "¡Producto traspasado con éxito!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){

                    if(result.value){
                    
                        window.location = "intercambios";

                    }

                });
            

            </script>';
            }
        }
    }
}
