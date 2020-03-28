<?php

class ControladorPresupuestos{

	static public function ctrRegistrarPresupuesto(){
		if(isset($_POST['btnRegistrarPresupuesto'])){
			$estado_fisico = "";
			if(!empty($_POST['estado_fisico'])){
				foreach($_POST['estado_fisico'] as $selected){
					$estado_fisico = $estado_fisico.$selected.",";
				}
			}

			$presupuesto = array('orden' => $_POST['orden'],
							'nombre' => $_POST['nombre'],
							'contacto' => $_POST['contacto'],
							'fecha_cotizacion' => $_POST['fecha_cotizacion'],
							'equipo' => $_POST['equipo'],
							'marca' => $_POST['marca'],
							'modelo' => $_POST['modelo'],
							'color' => $_POST['color'],
							'observaciones' => $_POST['observaciones'],
							'estado_fisico' => $estado_fisico,
							
							
							'diagnostico' => $_POST['diagnostico'],
							
							'desbloqueo' => $_POST['desbloqueo'],'estetica' => $_POST['estetica'],
							'costo_estimado' => $_POST['costo_estimado'],
							
							'fecha_entrega' => NULL,
							'estado_equipo' => 'Reparacion',
							'usuario_recibio' => $_SESSION["nombre"],
							'imei' => $_POST['imei'],
							'usuario_entrega' => NULL);
			//var_dump($presupuesto);

			$res = ModeloPresupuestos::mdlIngresarPresupuesto($presupuesto);

			
			if($res == "ok"){

					echo '<script>

					

							window.location = "cotizaciones";
							window.open("extensiones/tcpdf/pdf/presupuesto-factura.php?codigo='.$_POST['orden'].'", "_blank");
						
							

				

					</script>';


				}	

				/*window.location = "extensiones/tcpdf/pdf/presupuesto-factura.php?codigo='.$_POST['orden'].'";*/


			else{

				echo '<script>

					swal({

						type: "error",
						title: "¡Recuerde que algunos campos son obligatirios o no puede haber caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							 window.history.back();

						}

					});
				

				</script>';

			}

			//$estado_fisico =  $_POST['estado_fisico'];
			//print_r($estado_fisico);
		}
		unset($_POST['orden']);
		
	}

	static public function ctrMostrarPresupuestos(){


		$respuesta = ModeloPresupuestos::MdlMostrarPresupuestos();

		return $respuesta;
	}

	static public function ctrCambiarEstadoEquipo($estado,$usuario,$orden){
		

		return $res = ModeloServicios::mdlCambiarEstado($estado,$usuario,$orden);
	}
	static public function ctrDetallePresupuesto($orden){


		$respuesta = ModeloPresupuestos::mdlDetallePresupuesto($orden);

		return $respuesta;
	}
	public function ctrSumaTotalVentasServicioAnticipo(){


		$respuesta = ModeloServicios::mdlSumaTotalVentasServicioAnticipo();

		return $respuesta;

	}
	public function ctrSumaTotalVentasServicioAdeudo(){

		

		$respuesta = ModeloServicios::mdlSumaTotalVentasServicioAdeudo();

		return $respuesta;

	}
	public function ctrSumaTotalPendientes(){

		

		$respuesta = ModeloServicios::mdlSumaTotalPendientes();

		return $respuesta;

	}
	public function presupuesto(){

		

		$respuesta = ModeloPresupuestos::presupuesto();

		return $respuesta;

	}

	public static function ctrBorrarCotizacion(){
		if(isset($_GET['idCotizacion'])){
				if($_SESSION['perfil']=="Administrador"){
					
						$datos = array('b' => "bl" ,
										'presupuesto' => $_GET['idCotizacion']);
						$borar = ModeloPresupuestos::MdlBorrarCotizacion($datos);
						if($borar){
							echo '<script>

							swal({

								type: "success",
								title: "¡la cotizacion ha sido borrado con exito!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
										window.location = "lista-cotizaciones";
									

								}

							});
						

							</script>';


						}	


					else{

						echo '<script>

							swal({

								type: "error",
								title: "¡la cotizacion no se pudo borrar!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.history.back();

								}

							});
						

						</script>';

					}

					

			}else{
			echo '<script>

						swal({

							type: "error",
							title: "¡Tu no cuentas con permisos para hacer esta operación!",
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
	
	//SELECT COUNT(estado_equipo) AS total FROM servicios where estado_equipo != 'Reparado' || estado_equipo != 'Entregado'


}