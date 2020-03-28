<?php

/**
 * 
 */
class ControladorPedidos
{

	function __construct()
	{
		# code...
	}

	//Registrar pedido

	public static function ctrRegistrarPedido()
	{
		//Filtro de validacion "Campo existente"
		if (isset($_POST['btnRegistrarPedido'])) {
			//2Do filtro verificar si son numeros
			if (is_numeric($_POST['importe']) && is_numeric($_POST['anticipo'])) {

				$wspp = $_POST['codigo-wp'] . "" . $_POST['numero-wp'];

				date_default_timezone_set($_SESSION["zona"]);

				$fecha = date('Y-m-d');


				$hora = date('H:i:s');

				$valor1b = $fecha . ' ' . $hora;
				/*if (strlen($wspp) > 0 && strlen($wspp) < 12) {

					echo '<script>
		
							swal({
		
								type: "error",
								title: "Si registrará whatsapp asegúrese de poner código y los 10 dígitos. De lo contrario dejar en blanco ambos campos.",
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
*/


				$total = $_POST['importe'] - $_POST['anticipo'];

				$datos = array(
					'pedido' => $_POST['pedido'],
					'nombre' => $_POST['nombre'],
					'contacto' => $_POST['contacto'] . " " . $_POST['email'] . "/" . $wspp,
					'fecha_pedido' => $_POST['fecha_pedido'],
					'equipo' => $_POST['equipo'],
					'marca' => $_POST['marca'],
					'modelo' => $_POST['modelo'],

					'encargo' => $_POST['encargo'],
					'importe' => $_POST['importe'],
					'anticipo' => $_POST['anticipo'],
					'total' => $total,
					'usuario_recibio' => $_SESSION['nombre']
				);
				$agregar = ModeloPedidos::mdlRegistrarPedido($datos);
				$concepto = "";

				$concepto = $total  == 0 ? 'PAGADO' : 'ANTICIPO';

				if ($agregar) {
					if ($_POST['anticipo'] != 0) {
						$mov = array(
							'tipo' => 'PEDIDO',
							'numero_movimiento' => $_POST['pedido'],
							'concepto' => $concepto,
							'monto' => $_POST['anticipo'],
							'cliente' => $_POST['nombre'],
							'fecha' => $valor1b,
							'usuario' => $_SESSION["nombre"],
							'extra' => ''


						);

						$movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
					}
					echo '<script>

					
						
									window.location = "lista-pedidos";
							window.open("extensiones/tcpdf/pdf/pedido-factura.php?codigo=' . $_POST['pedido'] . '", "_blank");
							

						
				

					</script>';
				} else {
					echo '<script>

					swal({

						type: "error",
						title: "¡Error, el pedido no pudo ser registrado!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
								window.history.back();
							

						}

					});
				

					</script>';
				}
			} else {
				echo '<script>

					swal({

						type: "error",
						title: "¡Error, el formato no es valido para importe y anticipo",
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
	public static function ctrobtenerId()
	{
		return  ModeloPedidos::mdlObtenerId();
	}
	public static function ctrMostrarPedidos()
	{
		return ModeloPedidos::mdlMostrarPedidos();
	}
	public static function ctrMostrarPedidosPorFiltro($filtro)
	{
		return ModeloPedidos::mdlMostrarPedidosPorFiltro($filtro);
	}

	public static function detallePedido($orden)
	{


		$respuesta = ModeloPedidos::detallePedido($orden);

		return $respuesta;
	}

	public static function ctrBorrarPedido()
	{
		if (isset($_GET['idPedido']) && isset($_GET['bl'])) {
			if ($_SESSION['perfil'] == "Administrador") {
				if ($_GET['bl']) {
					$datos = array(
						'b' => "bf",
						'pedido' => $_GET['idPedido']
					);
					$borar = ModeloPedidos::MdlBorrarPedido($datos);
					if ($borar) {

						$movDel = ModeloMovimientos::mdlDeteteMovimientoPedido($_GET['idPedido']);

						if ($movDel) {
							echo '<script>

							swal({

								type: "success",
								title: "¡El pedido ha sido borrado con exito!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
										window.location = "lista-pedidos";
									

								}

							});
						

							</script>';
						} else {
							echo '<script>

							window.location = "lista-pedidos";

						</script>';
						}
					} else {

						echo '<script>

							swal({

								type: "error",
								title: "¡El pedido se pudo borrar!",
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
			} else {
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
	public static function ctrMostrarTotalAnticipo()
	{
		return ModeloPedidos::mdlSumaTotalPedidosAnticipo();
	}
	public static function ctrMostrarTotalAdeudos()
	{
		return ModeloPedidos::mdlSumaTotalPendienteAdeudo();
	}
	/*
			$estado_corte=0;
		$detalle = ModeloPedidos::detallePedido($orden);
		
		if($detalle["estado_corte"]== 0 && $_GET["estado"]== "Entregado"){
			$estado_corte =2;
		}
		if($detalle["estado_corte"]== 1 && $estado == "Entregado"){
			$estado_corte =3;
		}
		if(($detalle["estado_corte"]== 1 || $detalle["estado_corte"]== 4 ) && $estado != "Entregado"){
			$estado_corte =4;
		}
		//var_dump($detalle);

		$corte = ModeloPedidos::cambiarEstadoTabla("pedidos",$estado_corte,"pedido",$orden);

		$res = ModeloPedidos::mdlCambiarEstado($estado,$usuario,$orden);
		return $res;
		*/
	public static function ctrCambiarestado()
	{
		if (isset($_GET["idPedido"]) && isset($_GET["estado"])) {
			$datos = array(
				'estado' => $_GET["estado"],
				'idPedido' => $_GET["idPedido"]
			);
			$cambiarEstado = ModeloPedidos::mdlCambiarEstado($datos);
			if ($cambiarEstado) {
				$estado_corte = 0;
				date_default_timezone_set($_SESSION["zona"]);

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b = $fecha . ' ' . $hora;
				$detalle = ModeloPedidos::detallePedido($_GET["idPedido"]);

				if ($detalle["estado_corte"] == 0 && $_GET["estado"] == "Entregado") {
					$estado_corte = 2;
					if ($detalle['total'] != 0) {
						$mov = array(
							'tipo' => 'PEDIDO',
							'numero_movimiento' => $detalle['pedido'],
							'concepto' => 'LIQUIDADO',
							'monto' => $detalle['total'],
							'cliente' => $detalle['nombre'],
							'fecha' => $valor1b,
							'usuario' => $_SESSION["nombre"],
							'extra' => ''


						);
						$movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
					}
				}
				if ($detalle["estado_corte"] == 1 && $_GET["estado"] == "Entregado") {
					$estado_corte = 3;
					if ($detalle['total'] != 0) {
						$mov = array(
							'tipo' => 'PEDIDO',
							'numero_movimiento' => $detalle['pedido'],
							'concepto' => 'LIQUIDADO',
							'monto' => $detalle['total'],
							'cliente' => $detalle['nombre'],
							'fecha' => $valor1b,
							'usuario' => $_SESSION["nombre"],
							'extra' => ''


						);
						$movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
					}
				}
				if (($detalle["estado_corte"] == 1 || $detalle["estado_corte"] == 4) && $_GET["estado"] != "Entregado") {
					$estado_corte = 4;
				}
				//var_dump($detalle);

				$corte = ModeloServicios::cambiarEstadoTabla("pedidos", $estado_corte, "pedido", $_GET["idPedido"]);

				if ($_GET["estado"] == "Sin existencia" && $_GET["anticipo"] != 0) {

					$items = array(
						'gasto' => $_GET["anticipo"],
						'concepto' => "Devolución de pedido sin exitencia con número de pedido " . $_GET["idPedido"],
						'fecha_gasto' => $valor1b,
						'usuario' => $_SESSION['nombre']
					);
					$agregar = ModeloGastos::mdlAgrearGastos($items);
					$mov = array(
						'tipo' => 'GASTO',
						'numero_movimiento' => $detalle['pedido'],
						'concepto' =>  "DEVOLUCIÓN DE PEDIDO",
						'monto' => $_GET["anticipo"],
						'cliente' => $detalle['nombre'],
						'fecha' => $valor1b,
						'usuario' => $_SESSION["nombre"],
						'extra' => ''


					);
					$movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
				}
				echo '<script>
						window.location = "lista-pedidos";
					</script>';
			} else {
				echo '<script>

							swal({

								type: "error",
								title: "¡No es posible cambiar de estado!",
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
}
