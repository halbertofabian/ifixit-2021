<?php
class ControladorGatos
{
    public static function ctrRegistrarGastos()
    {
        if (isset($_POST['btnGuardarGasto'])) {
            if (isset($_POST['gasto']) && is_numeric($_POST['gasto'])) {
                if (!isset($_POST['concepto'])) {

                    return;
                }
                date_default_timezone_set($_SESSION["zona"]);

                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $fecha_gasto = $fecha . ' ' . $hora;

                $items = array(
                    'gasto' => $_POST['gasto'],
                    'concepto' => $_POST['concepto'],
                    'fecha_gasto' => $fecha_gasto,
                    'usuario' => $_SESSION['nombre']
                );

                $agregar = ModeloGastos::mdlAgrearGastos($items);

                if ($agregar) {
                    $mov = array(
                        'tipo' => 'GASTO',
                        'numero_movimiento' => $fecha_gasto,
                        'concepto' =>  $_POST['concepto'],
                        'monto' => $_POST['gasto'],
                        'cliente' => '',
                        'fecha' => $fecha_gasto ,
                        'usuario' => $_SESSION["nombre"],
                        'extra' => ''
    
    
                    );
                    $movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
                
                    echo '<script>

                    swal({
                          type: "success",
                          title: "Gastos registrado",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "egresos";

                                    }
                                })

                    </script>';
                } else { 
                    echo'<script>

					swal({
						  type: "error",
						  title: "¡El gasto no se pudo registrar, intente de nuevo",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

                                window.history.back();

							}
						})

			  	</script>';
                }
            } else {
                echo'<script>

                swal({
                      type: "error",
                      title: "¡El gasto no se pudo registrar, es probale que no cumpla con el campo cantidad",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {

                            window.history.back();

                        }
                    })

              </script>';
            }
        }
    }

    public static function ctrMostrarGastos(){
        return ModeloGastos::mdlMostrarGastos();
    }
    public static function ctrBorrarGasto(){
		if(isset($_GET['idGasto'])){
			$borrar = ModeloGastos::mdlBorrarGasto($_GET['idGasto']);

			if($borrar){

					echo '<script>

					swal({

						type: "success",
						title: "¡El gasto ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
								window.location = "egresos";
							

						}

					});
				

					</script>';


				}	


			else{

				echo '<script>

					swal({

						type: "error",
						title: "¡No pudo ser borrado el gasto!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.history.back();

						}

					});
				

				</script>';

			}

		}
    }
    
    public static function ctrTotalGastos(){
        return ModeloGastos::mdlTotalGastos();
    }
}
