<?php
class ControladorIngresos
{
    public static function ctrRegistrarIngresos()
    {
        if (isset($_POST['btnGuardarIngreso'])) {
            if (isset($_POST['ingreso']) && is_numeric($_POST['ingreso'])) {
                if (!isset($_POST['concepto'])) {

                    return;
                }
                date_default_timezone_set($_SESSION["zona"]);

                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $fecha_ingreso = $fecha . ' ' . $hora;

                $items = array(
                    'ingreso' => $_POST['ingreso'],
                    'concepto' => $_POST['concepto'],
                    'fecha_ingreso' => $fecha_ingreso,
                    'usuario' => $_SESSION['nombre']
                );

                $agregar = Modeloingresos::mdlAgrearingresos($items);

                if ($agregar) {
                    $mov = array(
                        'tipo' => 'INGRESO',
                        'numero_movimiento' => $fecha_ingreso,
                        'concepto' =>  $_POST['concepto'],
                        'monto' => $_POST['ingreso'],
                        'cliente' => '',
                        'fecha' => $fecha_ingreso ,
                        'usuario' => $_SESSION["nombre"],
                        'extra' => ''
    
    
                    );
                    $movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
                
                    echo '<script>

                    swal({
                          type: "success",
                          title: "Ingreso registrado",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "ingresos";

                                    }
                                })

                    </script>';
                } else { 
                    echo'<script>

					swal({
						  type: "error",
						  title: "¡El ingreso no se pudo registrar, intente de nuevo",
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
                      title: "¡El ingreso no se pudo registrar, es probale que no cumpla con el campo cantidad",
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

    public static function ctrMostraringresos(){
        return Modeloingresos::mdlMostraringresos();
    }
    public static function ctrBorraringreso(){
		if(isset($_GET['idIngreso'])){
			$borrar = Modeloingresos::mdlBorraringreso($_GET['idIngreso']);

			if($borrar){

					echo '<script>

					swal({

						type: "success",
						title: "¡El ingreso ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
								window.location = "ingresos";
							

						}

					});
				

					</script>';


				}	


			else{

				echo '<script>

					swal({

						type: "error",
						title: "¡No pudo ser borrado el ingreso!",
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
    
    public static function ctrTotalingresos(){
        return Modeloingresos::mdlTotalingresos();
    }
}
