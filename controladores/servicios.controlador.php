<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ControladorServicios
{

	static public function ctrRegistrarServicio()
	{
		if (isset($_POST['btnRegistrarServicio'])) {
			$_SESSION['presupuesto'] = "";
			$estado_fisico = "";
			if (!empty($_POST['estado_fisico'])) {
				foreach ($_POST['estado_fisico'] as $selected) {
					$estado_fisico = $estado_fisico . $selected . ",";
				}
			}
			$codigo_cliente = substr(md5($_POST['nombre']), 0, 4) . substr(md5($_POST['orden']), 28, 32);

			date_default_timezone_set($_SESSION["zona"]);

			$fecha = date('Y-m-d');


			$hora = date('H:i:s');

			$valor1b = $fecha . ' ' . $hora;

			// $wspp = $_POST['codigo-wp'] . "" . $_POST['numero-wp'];
			$wspp =  $_POST['numero-wp'];

			//$nombre = $_POST['nombre'];
			//$orden = $_POST['orden'];
			//$msj = "Hola querido $nombre, gracias por elegir nuestros servicios. Te mantendremos informado sobre la situación actual de tu servicio con número de orden *$orden*";
			//$redes_sociales = "No olvides visitar nuestras redes sociales *https://www.facebook.com/softmor*  *https://www.instagram.com/softmormx/*";
			//Holaquerido ".$_POST['nombre']." gracias por elegir nuestros servicios. 
			//Te mantendremos informados acerca del estado de tu servicio con numero de folio #".$_POST['orden'].".

			/*if(strlen($wspp)>0 && strlen($wspp) <12 ){
				
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
				
			 }else{
				 */

			$suc = ControladorSucursal::ctrMostrarSucursal();

			$orden = ControladorServicios::orden();

			if ($orden == false) {
				$orden = '1000';
			} else {
				$orden = $orden['orden'] + 1;
			}

			$url  = ControladorPlantilla::getRuteIndex();
			$nom_suc =  strtolower(str_replace(' ', '-', trim($_SESSION['nom_suc'])));
			$ruta = $url . 's/' . $nom_suc . '/d/' . $codigo_cliente;


			$text = $suc['text_servicio'];
			//echo $text;
			$text = str_replace('[NOMBRE]', $_POST['nombre'], $text);
			$text = str_replace('[ORDEN]', $orden, $text);
			$text = str_replace('[TICKET-S]', $ruta, $text);

			$text = str_replace('[FACEBOOK]', "https://www.facebook.com/" . $suc['facebook'], $text);
			$text = str_replace('[INSTAGRAM]', "https://www.instagram.com/" . $suc['instagram'], $text);
			$text = str_replace('[TWITTER]', "https://twitter.com/" . $suc['twitter'], $text);
			$text = str_replace('[YOUTUBE]', "https://www.youtube.com/channel/" . $suc['youtube'], $text);
			$text = str_replace('[SUCURSAL]', $_SESSION['nom_suc'], $text);
			$text = str_replace('[CODIGO]', $codigo_cliente, $text);
			$text = str_replace('[SITO-WB]', $suc['sitio_web'], $text);
			$text = str_replace('[TEL]', $suc['whatsapp'], $text);

			//echo $text." Hola";

			//}



			$servicio = array(
				'orden' => $orden,
				'nombre' => $_POST['nombre'],
				'contacto' => $_POST['contacto'] . " " . $_POST['email'] . "/" . $wspp,
				'fecha_reparacion' => $_POST['fecha_reparacion'] . ' ' . $hora,
				'equipo' => $_POST['equipo'],
				'marca' => $_POST['marca'],
				'modelo' => $_POST['modelo'],
				'color' => $_POST['color'],
				'observaciones' => $_POST['observaciones'],
				'estado_fisico' => $estado_fisico,


				'problema' => $_POST['problema'],
				'solucion' => $_POST['solucion'],
				'desbloqueo' => $_POST['desbloqueo'], 'estetica' => $_POST['estetica'],
				'importe' => str_replace(',', '', $_POST['importe']),
				'anticipo' => str_replace(',', '', $_POST['anticipo']),
				'total' => str_replace(',', '', $_POST['total']),
				'fecha_entrega' => NULL,
				'estado_equipo' => 'Reparacion',
				'usuario_recibio' => $_POST['usuario_recibio'],
				'usuario_entrega' => NULL,
				'imei' => $_POST['imei'],
				'codigo_cliente' => $codigo_cliente,

				'fecha_prometida' => $_POST['fecha_prometida'] . ' ' . $_POST['hora_prometida'],

				'tecnico' => $_POST['tecnico']





				//'fecha_prometida' => $fecha_prometida

			);
			//var_dump($servicio);
			$concepto = "";

			$concepto = $_POST['total'] == 0 ? 'PAGADO' : 'ANTICIPO';

			//$monto = $_POST['total'] == 0 ? $_POST['importe'] : $_POST['anticipo'];

			$res = ModeloServicios::mdlIngresarServicio($servicio);







			if ($res) {
				if ($_POST['anticipo'] != 0) {
					$mov = array(
						'tipo' => 'SERVICIO',
						'numero_movimiento' => $orden,
						'concepto' => $concepto,
						'monto' => str_replace(',', '', $_POST['anticipo']),
						'cliente' => $_POST['nombre'],
						'fecha' => $valor1b,
						'usuario' => $_SESSION["nombre"],
						'extra' => ''


					);

					$movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
				}


				// AppController::messagesInfo('¡Bien hecho!', 'Venta realizada', 'success', 'caja');

				// $dir = 'vistas/img/qr_generator/' . $_SESSION['nom_suc'] . '/';
				// //Si no existe la carpeta la creamos
				// if (!file_exists($dir))
				// 	mkdir($dir, 0777);

				// //Declaramos la ruta y nombre del archivo a generar

				// $filename = $dir .  '' . $orden . '.png';

				// $tamaño = 5; //Tamaño de Pixel
				// $level = 'H'; //Precisión Máxima
				// $framSize = 1; //Tamaño en blanco
				// //$contenido = $_POST['saleCode']; //Texto
				// $url = ControladorPlantilla::getRute();
				// //Enviamos los parametros a la Función para generar código QR 
				// QRcode::png($url . 'consulta/?sucursal=' . md5($_SESSION['nom_suc']) . '&codigo=' . $codigo_cliente . '&apikey=' . $_SESSION['suscriptor'], $filename, $level, $tamaño, $framSize);
				//$qr = ControladorPlantilla::generarQR();

				if (strlen($wspp) > 0) {


					echo '<script>

					swal({

						type: "info",
						title: "¿Quieres mandar WhatsApp?",
						showCancelButton: true,
						confirmButtonColor: "#3085d6",
						cancelButtonColor: "#d33",
						cancelButtonText: "No",
						confirmButtonText: "Si, mandar WhatsApp"

					}).then(function(result){

						if(result.value){
						
							window.open("https://wa.me/' . $wspp . '?text=' . $text . '", "_blank");

						}
						window.location = "entregas";
						window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=' . $orden . '", "_blank");

					});
				

				</script>';

					// 	echo '<script>

					// 	var r = confirm("¿Quieres mandar whatsapp?");
					// 	if(r){

					// 		window.open("https://wa.me/' . $wspp . '?text=' . $text . '", "_blank");

					// 	}
					// 		window.location = "entregas";
					// 		window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=' . $orden . '", "_blank");



					// </script>';
				} else {
					echo '
						<script>
						window.location = "entregas";
						window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=' . $orden . '", "_blank");
						</script>
					';
				}
			} else {

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
	}
	static public function ctrRegistrarServicioR()
	{
		if (isset($_POST['btnRegistrarServicio'])) {






			$_SESSION['presupuesto'] = "";
			$estado_fisico = "";
			if (!empty($_POST['estado_fisico'])) {
				foreach ($_POST['estado_fisico'] as $selected) {
					$estado_fisico = $estado_fisico . $selected . ",";
				}
			}
			$codigo_cliente = substr(md5($_POST['nombre']), 0, 4) . substr(md5($_POST['orden']), 28, 32);

			date_default_timezone_set($_SESSION["zona"]);

			$fecha = date('Y-m-d');


			$hora = date('H:i:s');

			$valor1b = $fecha . ' ' . $hora;

			$wspp = $_POST['numero-wp'];

			$suc = ControladorSucursal::ctrMostrarSucursal();

			$textWp = ModeloConfiguracion::mdlObtenerTextos();
			$text = $textWp[1]['valor'];
			$orden = ControladorServicios::orden();

			if ($orden == false) {
				$orden = '1000';
			} else {
				$orden = $orden['orden'] + 1;
			}

			$url  = ControladorPlantilla::getRuteIndex();
			$nom_suc =  strtolower(str_replace(' ', '-', trim($_SESSION['nom_suc'])));
			$ruta = $url . 's/' . $nom_suc . '/d/' . $codigo_cliente;



			//echo $text;
			$text = str_replace('[NOMBRE]', $_POST['nombre'], $text);
			$text = str_replace('[ORDEN]', $orden, $text);
			$text = str_replace('[TICKET-S]', $ruta, $text);

			$text = str_replace('[FACEBOOK]', "https://www.facebook.com/" . $suc['facebook'], $text);
			$text = str_replace('[INSTAGRAM]', "https://www.instagram.com/" . $suc['instagram'], $text);
			$text = str_replace('[TWITTER]', "https://twitter.com/" . $suc['twitter'], $text);
			$text = str_replace('[YOUTUBE]', "https://www.youtube.com/channel/" . $suc['youtube'], $text);
			$text = str_replace('[SUCURSAL]', $_SESSION['nom_suc'], $text);
			$text = str_replace('[CODIGO]', $codigo_cliente, $text);
			$text = str_replace('[SITO-WB]', $suc['sitio_web'], $text);
			$text = str_replace('[TEL]', $suc['whatsapp'], $text);

			//echo $text." Hola";

			//}



			$servicio = array(
				'orden' => $orden,
				'nombre' => $_POST['nombre'],
				'contacto' => $_POST['contacto'] . " " . $_POST['email'] . "/" . $wspp,
				'fecha_reparacion' => $_POST['fecha_reparacion'] . ' ' . $hora,
				'equipo' => $_POST['equipo'],
				'marca' => $_POST['marca'],
				'modelo' => $_POST['modelo'],
				'color' => $_POST['color'],
				'observaciones' => $_POST['observaciones'],
				'estado_fisico' => $estado_fisico,


				'problema' => $_POST['problema'],
				'solucion' => $_POST['solucion'],
				'desbloqueo' => $_POST['desbloqueo'], 'estetica' => $_POST['estetica'],
				'importe' => str_replace(',', '', $_POST['importe']),
				'anticipo' => str_replace(',', '', $_POST['anticipo']),
				'total' => str_replace(',', '', $_POST['total']),
				'fecha_entrega' => NULL,
				'estado_equipo' => 'Reparacion',
				'usuario_recibio' => $_POST['usuario_recibio'],
				'usuario_entrega' => NULL,
				'imei' => $_POST['imei'],
				'codigo_cliente' => $codigo_cliente,

				'fecha_prometida' => $_POST['fecha_prometida'] . ' ' . $_POST['hora_prometida'],

				'tecnico' => $_POST['tecnico'],
				//'inversion' => $_POST['inversion'],
				'diagnostico' => $_POST['diagnostico']

				//'fecha_prometida' => $fecha_prometida

			);
			//var_dump($servicio);
			$concepto = "";

			$concepto = $_POST['total'] == 0 ? 'PAGADO' : 'ANTICIPO';

			//$monto = $_POST['total'] == 0 ? $_POST['importe'] : $_POST['anticipo'];

			$res = ModeloServicios::mdlIngresarServicioR($servicio);







			if ($res) {
				if ($_POST['anticipo'] != 0) {
					$mov = array(
						'tipo' => 'SERVICIO',
						'numero_movimiento' => $orden,
						'concepto' => $concepto,
						'monto' => str_replace(',', '', $_POST['anticipo']),
						'cliente' => $_POST['nombre'],
						'fecha' => $valor1b,
						'usuario' => $_SESSION["nombre"],
						'extra' => ''


					);

					$movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
				}



				if (strlen($wspp) > 0) {


					echo '<script>

					swal({

						type: "info",
						title: "¿Quieres mandar WhatsApp?",
						showCancelButton: true,
						confirmButtonColor: "#3085d6",
						cancelButtonColor: "#d33",
						cancelButtonText: "No",
						confirmButtonText: "Si, mandar WhatsApp"

					}).then(function(result){

						if(result.value){
						
							window.open("https://wa.me/' . $wspp . '?text=' . $text . '", "_blank");

						}
						window.location = "entregas";
						window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=' . $orden . '", "_blank");

					});
				

				</script>';
				} else {
					echo '
						<script>
						window.location = "entregas";
						window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=' . $orden . '", "_blank");
						</script>
					';
				}
			} else {

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
		}
	}
	//Metodo para modificar el servicio
	static public function ctrModificarServicio()
	{



		if (isset($_POST['btnModificarServicio'])) {
			$_SESSION['presupuesto'] = "";
			$estado_fisico = "";
			if (!empty($_POST['estado_fisico'])) {
				foreach ($_POST['estado_fisico'] as $selected) {
					$estado_fisico = $estado_fisico . $selected . ",";
				}
			}
			$codigo_cliente = substr(md5($_POST['nombre']), 0, 4) . substr(md5($_POST['orden']), 28, 32);

			date_default_timezone_set($_SESSION["zona"]);


			$hora = date('H:i:s');



			$wspp =  $_POST['numero-wp'];

			$suc = ControladorSucursal::ctrMostrarSucursal();
			$text = $suc['text_servicio'];
			//echo $text;
			$text = str_replace('[NOMBRE]', $_POST['nombre'], $text);
			$text = str_replace('[ORDEN]', $_POST['orden'], $text);
			$text = str_replace('[FACEBOOK]', "https://www.facebook.com/" . $suc['facebook'], $text);
			$text = str_replace('[INSTAGRAM]', "https://www.instagram.com/" . $suc['instagram'], $text);
			$text = str_replace('[TWITTER]', "https://twitter.com/" . $suc['twitter'], $text);
			$text = str_replace('[YOUTUBE]', "https://www.youtube.com/channel/" . $suc['youtube'], $text);
			$text = str_replace('[SUCURSAL]', $_SESSION['nom_suc'], $text);
			$text = str_replace('[CODIGO]', $codigo_cliente, $text);
			$text = str_replace('[SITO-WB]', $suc['sitio_web'], $text);
			$text = str_replace('[TEL]', $suc['whatsapp'], $text);


			$servicio = array(
				'orden' => $_POST['orden'],
				'nombre' => $_POST['nombre'],
				'contacto' => $_POST['contacto'] . " " . $_POST['email'] . "/" . $wspp,
				'fecha_reparacion' => $_POST['fecha_reparacion'] . ' ' . $hora,
				'equipo' => $_POST['equipo'],
				'marca' => $_POST['marca'],
				'modelo' => $_POST['modelo'],
				'color' => $_POST['color'],
				'observaciones' => $_POST['observaciones'],
				'estado_fisico' => $estado_fisico,
				'estado_corte' => '0',

				'problema' => $_POST['problema'],
				'solucion' => $_POST['solucion'],
				'desbloqueo' => $_POST['desbloqueo'], 'estetica' => $_POST['estetica'],
				'importe' => str_replace(',', '', $_POST['importe']),
				'anticipo' => str_replace(',', '', $_POST['anticipo']),
				'total' => str_replace(',', '', $_POST['total']),
				'fecha_entrega' => NULL,
				'estado_equipo' => $_POST['estado_equipo'],
				'usuario_recibio' => $_SESSION["nombre"],
				'usuario_entrega' => $_SESSION["nombre"],
				'imei' => $_POST['imei'],
				'codigo_cliente' => $codigo_cliente,
				'fecha_prometida' => $_POST['fecha_prometida'] . ' ' . $_POST['hora_prometida'],

				'tecnico' => $_POST['tecnico']
			);
			//var_dump($servicio);

			$res = ModeloServicios::mdlModificarServicio($servicio);

			if ($res == "ok") {
				if (strlen($wspp) > 0) {

					echo '<script>

					swal({

						type: "info",
						title: "¿Quieres mandar WhatsApp?",
						showCancelButton: true,
						confirmButtonColor: "#3085d6",
						cancelButtonColor: "#d33",
						cancelButtonText: "No",
						confirmButtonText: "Si, mandar WhatsApp"

					}).then(function(result){

						if(result.value){
						
							window.open("https://wa.me/' . $wspp . '?text=' . $text . '", "_blank");

						}
						window.location = "entregas";
						window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=' . $_POST['orden'] . '", "_blank");

					});
				

				</script>';
				} else {
					echo '
						<script>
						window.location = "entregas";
						window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=' . $_POST['orden'] . '", "_blank");
						</script>
					';
				}
			} else {
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



			// if ($res == "ok") {


			// 	echo '<script>



			// 					window.location = "entregas";
			// 				window.open("extensiones/tcpdf/pdf/servicio-factura.php?codigo=' . $_POST['orden'] . '", "_blank");






			// 		</script>';
			// } else {

			// 	echo '<script>

			// 		swal({

			// 			type: "error",
			// 			title: "¡Recuerde que algunos campos son obligatirios o no puede haber caracteres especiales!",
			// 			showConfirmButton: true,
			// 			confirmButtonText: "Cerrar"

			// 		}).then(function(result){

			// 			if(result.value){

			// 				window.history.back();

			// 			}

			// 		});


			// 	</script>';
			// }

			//$estado_fisico =  $_POST['estado_fisico'];
			//print_r($estado_fisico);
		}
	}

	static public function ctrMostrarServicio($tecnico = "")
	{


		$respuesta = ModeloServicios::MdlMostrarServcios($tecnico);

		return $respuesta;
	}
	static public function ctrMostrarServicioPorFiltro($filtro, $tecnico = "")
	{


		$respuesta = ModeloServicios::MdlMostrarServciosPorFiltro($filtro, $tecnico);

		return $respuesta;
	}

	static public function ctrMostrarNota($orden)
	{


		$respuesta = ModeloServicios::mdlMostrarNota($orden);

		return $respuesta;
	}
	/**
	 * 
	 * */

	public static function ctrCambiarEstadoEquipo($estado, $usuario, $orden, $anticipo, $nota)
	{
		$_POST['estado'] = $estado;
		$_POST['nota'] = $nota;
		$_POST['orden'] = $orden;



		date_default_timezone_set($_SESSION["zona"]);

		$fecha = date('Y-m-d');
		$hora = date('H:i:s');
		$fecha = $fecha . ' ' . $hora;
		$detalle = ControladorServicios::ctrDetalleServicio($_POST['orden']);
		$bandera = "";

		if ($_POST['estado'] == "ENTREGADO" && $detalle['total'] > 0) {
			$movimiento = ControladorMovimientos::ctrRegistrarMovimiento(
				array(
					'tipo' => 'SERVICIO',
					'numero_movimiento' => $detalle['orden'],
					'concepto' => 'LIQUIDADO',
					'monto' => $detalle['total'],
					'cliente' => $detalle['nombre'],
					'fecha' => $fecha,
					'usuario' => $_SESSION["nombre"],
					'extra' => ''
				)
			);
			if ($movimiento) {
				$cambiarEstado = ModeloServicios::mdlCambiarEstado($_POST['estado'], $_SESSION["nombre"], $_POST['orden'], $fecha, $detalle['nota']);
				if ($cambiarEstado) {

					$bandera = array("type" => "success", "status" => true, "mensaje" => "Estado cambiado con éxito. Este servicio fue entregado y hay un adeudo, este mismo se reporta en movimientos como LIQUIDADO");
				} else {
					$bandera = array("type" => "warning", "status" => false, "mensaje" => "Ocurrio un error inesperado. Este servicio fue entregado y hay un adeudo, este mismo se reporta en movimientos como LIQUIDADO. Pero no cambio su estado a entregado, si te sale este mensaje toma nota de la orden de servicio y comunicate con soporte.");
				}
			} else {
				$bandera = array("type" => "error", "status" => false, "mensaje" => "Hay problema con tu conexión, no se pudo cambiar el estado. Intenta nuevamente.");
			}
		} elseif ($_POST['estado'] == "Entregado no quedo" && $detalle['anticipo'] > 0) {
			$agregarGasto = ModeloGastos::mdlAgrearGastos(
				array(
					'gasto' => $detalle['anticipo'],
					'concepto' => "Devolución de servicio sin quedar con número de orden " . $_POST['orden'],
					'fecha_gasto' => $fecha,
					'usuario' => $_SESSION['nombre']
				)
			);
			if ($agregarGasto) {
				$movimiento = ControladorMovimientos::ctrRegistrarMovimiento(
					array(
						'tipo' => 'SERVICIO',
						'numero_movimiento' => $detalle['orden'],
						'concepto' => 'COBRO POR DIAGNOSTICO',
						'monto' => $detalle['diagnostico'],
						'cliente' => $detalle['nombre'],
						'fecha' => $fecha,
						'usuario' => $_SESSION["nombre"],
						'extra' => ''
					)
				);

				if ($movimiento) {
					$cambiarEstado = ModeloServicios::mdlCambiarEstado($_POST['estado'], $_SESSION["nombre"], $_POST['orden'], $fecha, $_POST['nota']);
					if ($cambiarEstado) {
						$bandera = array("type" => "success", "status" => true, "mensaje" => "Estado cambiado con éxito. Este servicio fue entregado sin ser reparado y hay un anticipo, este mismo se reporta en movimientos de gasto como devolución de servicio. Y entrará a caja el monto denominado cobro por diagnostico ");
					} else {
						$bandera = array("type" => "warning", "status" => false, "mensaje" => "Ocurrio un error inesperado. Este servicio fue entregado sin ser reparado y hay un anticipo, este mismo se reporta en movimientos como DEVOLUCIÓN DE SERVICIO. Pero no cambio su estado a entregado sin quedar, si te sale este mensaje toma nota de la orden de servicio y comunicate con soporte.");
					}
				} else {
					$bandera = array("type" => "warning", "status" => false, "mensaje" => "Ocurrio un error inesperado. Este servicio fue entregado y hay un anticipo, este mismo se reporta en gastos como DEVOLUCIÓN DE SERVICIO. Pero no en movimientos, si te sale este mensaje toma nota de la orden de servicio y comunicate con soporte.");
				}
			} else {
				$bandera = array("type" => "error", "status" => false, "mensaje" => "Hay problema con tu conexión, no se pudo cambiar el estado. Intenta nuevamente.");
			}
		} elseif ($_POST['estado'] == "Entregado no quedo" && $detalle['anticipo'] == 0) {
			$movimiento = ControladorMovimientos::ctrRegistrarMovimiento(
				array(
					'tipo' => 'SERVICIO',
					'numero_movimiento' => $detalle['orden'],
					'concepto' => 'COBRO POR DIAGNOSTICO',
					'monto' => $detalle['diagnostico'],
					'cliente' => $detalle['nombre'],
					'fecha' => $fecha,
					'usuario' => $_SESSION["nombre"],
					'extra' => ''
				)
			);
			if ($movimiento) {
				$cambiarEstado = ModeloServicios::mdlCambiarEstado($_POST['estado'], $_SESSION["nombre"], $_POST['orden'], $fecha, $_POST['nota']);
				if ($cambiarEstado) {
					$bandera = array("type" => "success", "status" => true, "mensaje" => "Estado cambiado con éxito. Este servicio fue entregado sin ser reparado,este mismo entrará a caja el monto denominado cobro por diagnostico ");
				} else {
					$bandera = array("type" => "warning", "status" => false, "mensaje" => "Ocurrio un error inesperado. Este servicio fue entregado sin ser reparado. Pero no cambio su estado a entregado sin quedar, si te sale este mensaje toma nota de la orden de servicio y comunicate con soporte.");
				}
			} else {
				$bandera = array("type" => "warning", "status" => false, "mensaje" => "Ocurrio un error inesperado. Este servicio fue entregado y hay un anticipo, este mismo se reporta en gastos como DEVOLUCIÓN DE SERVICIO. Pero no en movimientos, si te sale este mensaje toma nota de la orden de servicio y comunicate con soporte.");
			}
		} else {
			$cambiarEstado = ModeloServicios::mdlCambiarEstado($_POST['estado'], $_SESSION["nombre"], $_POST['orden'], $fecha, $detalle['nota']);
			if ($cambiarEstado) {
				$bandera = array("type" => "success", "status" => true, "mensaje" => "Estado cambiado con éxito.");
			} else {
				$bandera = array("type" => "error", "status" => false, "mensaje" => "Hay problema con tu conexión, no se pudo cambiar el estado. Intenta nuevamente.");
			}
		}

		// Mensajes 3 tipos success, warning y error

		return $bandera;
	}
	static public function ctrCambiarEstadoEquipoR($estado, $usuario, $orden, $anticipo, $nota)
	{

		$estado_corte = 0;
		date_default_timezone_set($_SESSION["zona"]);

		$fecha = date('Y-m-d');
		$hora = date('H:i:s');
		$valor1b = $fecha . ' ' . $hora;

		$detalle = ModeloServicios::ctrDetalleServicio($orden);




		if ($detalle["estado_corte"] == 0 && $estado == "Entregado") {
			$estado_corte = 2;
			if ($detalle['total'] != 0) {
				$mov = array(
					'tipo' => 'SERVICIO',
					'numero_movimiento' => $detalle['orden'],
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
		if ($detalle["estado_corte"] == 1 && $estado == "Entregado") {
			$estado_corte = 3;
			if ($detalle['total'] != 0) {
				$mov = array(
					'tipo' => 'SERVICIO',
					'numero_movimiento' => $detalle['orden'],
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
		if (($detalle["estado_corte"] == 1 || $detalle["estado_corte"] == 4) && $estado != "Entregado") {
			$estado_corte = 4;
		}
		//var_dump($detalle);

		$corte = ModeloServicios::cambiarEstadoTabla("servicios", $estado_corte, "orden", $orden);


		$res = ModeloServicios::mdlCambiarEstado($estado, $usuario, $orden, $valor1b, $nota);
		if ($estado == "Entregado no quedo" && $anticipo != 0) {
			if ($res) {
				$items = array(
					'gasto' => $anticipo,
					'concepto' => "Devolución de servicio sin quedar con número de orden " . $orden,
					'fecha_gasto' => $valor1b,
					'usuario' => $_SESSION['nombre']
				);
				$agregar = ModeloGastos::mdlAgrearGastos($items);

				$mov = array(
					'tipo' => 'GASTO',
					'numero_movimiento' => $detalle['orden'],
					'concepto' =>  "DEVOLUCIÓN DE SERVICIO",
					'monto' => $anticipo,
					'cliente' => $detalle['nombre'],
					'fecha' => $valor1b,
					'usuario' => $_SESSION["nombre"],
					'extra' => ''


				);
				$movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
			}
		}

		return $res;
	}

	// ---------
	static public function ctrDetalleServicio($orden)
	{


		$respuesta = ModeloServicios::ctrDetalleServicio($orden);

		return $respuesta;
	}
	public function ctrSumaTotalVentasServicioAnticipo()
	{


		$respuesta = ModeloServicios::mdlSumaTotalVentasServicioAnticipo();

		return $respuesta;
	}
	public function ctrSumaTotalVentasServicioAdeudo()
	{



		$respuesta = ModeloServicios::mdlSumaTotalVentasServicioAdeudo();

		return $respuesta;
	}
	public function ctrSumaTotalPendientes()
	{



		$respuesta = ModeloServicios::mdlSumaTotalPendientes();

		return $respuesta;
	}
	public function orden()
	{



		$respuesta = ModeloServicios::orden();

		return $respuesta;
	}

	//Borrar servicio 
	static  public function ctrBorrarServico()
	{

		if (isset($_GET['idServicio']) && isset($_GET['bl'])) {
			if ($_SESSION['perfil'] == "Administrador") {
				if ($_GET['bl']) {
					$datos = array(
						'b' => "bf",
						'orden' => $_GET['idServicio']
					);

					$borar = ModeloServicios::MdlBorrarServico($datos);
					if ($borar) {

						// Quitar de movimientos 

						$movDel = ModeloMovimientos::mdlDeteteMovimientoServicio($_GET['idServicio']);

						if ($movDel) {

							echo '<script>
    
							swal({

								type: "success",
								title: "¡El servicio ha sido borrado con exito!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
										window.location = "entregas";
									

								}

							});
						

							</script>';
						} else {
							echo '<script>

							window.location = "entregas";
						

						</script>';
						}
					} else {
						echo '<script>

							swal({

								type: "error",
								title: "¡El servicio se pudo borrar!",
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
	public static function editarNota()
	{
		if (isset($_POST['btnEditarNota'])) {
			$nota = ModeloServicios::editarNota($_POST['nota'], $_POST['orden']);
			if ($nota) {
				echo '<script>

							swal({

								type: "success",
								title: "¡Nota guardada!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
										window.location = "entregas";
									

								}

							});
						

							</script>';
			} else {

				echo '<script>

							swal({

								type: "error",
								title: "¡No se pudo guardar la nota!",
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

	public static function crtAgregarPreServicio()
	{

		echo " ok";


		if (isset($_POST['btnAgregarServicioPrecargado'])) {

			//Validar si es numero
			if (!is_numeric($_POST['precio'])) {
				echo '<script>

							swal({

								type: "error",
								title: "¡Precio no valido, por favor intenta con un precio real!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
										window.history.back();
									

								}

							});
						

							</script>';
			}

			//Agregar a un arreglo los campos

			$servicio = array(
				'nombre' =>  $_POST['nombre'],
				'marca' =>  $_POST['marca'],
				'modelo' =>  $_POST['modelo'],
				'tipo_equipo' => $_POST['tipo_equipo'],
				'precio' =>  $_POST['precio']
			);
			// recorrer en arreglo para Validar que no esten vacios los campos
			foreach ($servicio as $key => $value) {
				if (empty($value)) {
					echo '<script>

							swal({

								type: "error",
								title: "¡Todos los campos son obligatorios!",
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

			//var_dump($servicio);
			$agregar = ModeloServicios::mdlAgregarPreServicio($servicio);
			if ($agregar) {
				echo '<script>

							buscar_datos(null);
									</script>';
			} else {

				echo '<script>

							swal({

								type: "error",
								title: "¡El servicio se pudo crear!",
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

	public static function ctrMostrarServciosPrecargados($consulta)
	{
		return ModeloServicios::MdlMostrarServciosPrecargados($consulta);
	}

	public static function crtEditarPreServicio()
	{

		//echo " ok";


		if (isset($_POST['btnActualizarServicioPrecargado'])) {

			//Validar si es numero
			if (!is_numeric($_POST['precio'])) {
				echo '<script>

							swal({

								type: "error",
								title: "¡Precio no valido, por favor intenta con un precio real!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
										window.history.back();
									

								}

							});
						

							</script>';
			}

			//Agregar a un arreglo los campos

			$servicio = array(
				'nombre' =>  $_POST['nombre'],
				'marca' =>  $_POST['marca'],
				'modelo' =>  $_POST['modelo'],
				'tipo_equipo' => $_POST['tipo_equipo'],
				'precio' =>  $_POST['precio'],
				'id' =>  $_POST['id']
			);
			// recorrer en arreglo para Validar que no esten vacios los campos
			foreach ($servicio as $key => $value) {
				if (empty($value)) {
					echo '<script>

							swal({

								type: "error",
								title: "¡Todos los campos son obligatorios!",
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

			//var_dump($servicio);
			$agregar = ModeloServicios::mdlActualizarPreServicio($servicio);
			if ($agregar) {
				echo '<script>

							buscar_datos(null);
									</script>';
			} else {

				echo '<script>

							swal({

								type: "error",
								title: "¡El servicio se pudo crear!",
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
	public  static function ctrMostrarServcioPrecargado($id)
	{


		return 	ModeloServicios::MdlMostrarServcioPrecargado($_GET['precargado']);
	}

	// Abono para la orden de servicio 

	public static function ctrAbonoServicio()
	{

		if (isset($_POST['btnGuardarAbono'])) {




			date_default_timezone_set($_SESSION["zona"]);

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha . ' ' . $hora;

			$orden = ModeloServicios::ctrDetalleServicio($_POST['orden']);

			if ($_POST['abono'] > $orden['total']) {

				echo '<script>

							swal({

								type: "error",
								title: "¡No es posible abonar, debido a la cantidad que intenta introducir!",
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




			$anticipo = $orden['anticipo'] + $_POST['abono'];
			$total = $orden['importe'] - $anticipo;



			$abono = ModeloServicios::mdlAbonoServicio($_POST['orden'], $_POST['abono'], $total);

			var_dump($abono);

			if ($abono) {

				$mov = array(
					'tipo' => 'SERVICIO',
					'numero_movimiento' => $_POST['orden'],
					'concepto' =>  "ABONO",
					'monto' => $_POST['abono'],
					'cliente' => $orden['nombre'],
					'fecha' => $valor1b,
					'usuario' => $_SESSION["nombre"],
					'extra' => ''


				);

				$movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);


				echo '<script>

							swal({

								type: "success",
								title: "¡Abono creado con éxito!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
										window.location = "entregas";
									

								}

							});
						

							</script>';
			} else {
				echo '<script>

							swal({

								type: "error",
								title: "¡No se pudo abonar, intente de nuevo!",
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


	public function ctrMandarWp()
	{
		if (isset($_POST['btnMandarWp'])) {

			$wspp = $_POST['textNumWp'];

			$suc = ControladorSucursal::ctrMostrarSucursal();
			$url  = ControladorPlantilla::getRuteIndex();
			$nom_suc =  strtolower(str_replace(' ', '-', trim($_SESSION['nom_suc'])));
			$ruta = $url . 's/' . $nom_suc . '/d/' . $_POST['codeWP'];

			$text = $_POST['textwp'];
			//echo $text;
			$text = str_replace('[NOMBRE]', $_POST['nombreWP'], $text);
			$text = str_replace('[ORDEN]', $_POST['codigoWP'], $text);
			$text = str_replace('[NOTA-S]', $_POST['notaWP'], $text);
			$text = str_replace('[TICKET-S]', $ruta, $text);


			$text = str_replace('[FACEBOOK]', "https://www.facebook.com/" . $suc['facebook'], $text);
			$text = str_replace('[INSTAGRAM]', "https://www.instagram.com/" . $suc['instagram'], $text);
			$text = str_replace('[TWITTER]', "https://twitter.com/" . $suc['twitter'], $text);
			$text = str_replace('[YOUTUBE]', "https://www.youtube.com/channel/" . $suc['youtube'], $text);
			$text = str_replace('[SUCURSAL]', $_SESSION['nom_suc'], $text);
			$text = str_replace('[CODIGO]', $_POST['codeWP'], $text);
			$text = str_replace('[SITO-WB]', $suc['sitio_web'], $text);
			$text = str_replace('[TEL]', $suc['whatsapp'], $text);


			echo '
				<script>
				window.open("https://wa.me/' . $wspp . '?text=' . $text . '", "_blank");
				</script>
			';
		}
	}
	public function ctrMandarCorreo()
	{
		if (isset($_POST['btnMandarCorreo'])) {

			$correo = $_POST['correo_des'];

			$suc = ControladorSucursal::ctrMostrarSucursal();
			$url  = ControladorPlantilla::getRuteIndex();
			//$nom_suc =  strtolower(str_replace(' ', '-', trim($_SESSION['nom_suc'])));
			$ruta = $url . 'lib/tcpdf/pdf/t-carta.php?codigo=' . $_POST['codeEM'] . '&nom_suc=' . $_SESSION['nom_suc'];

			$text = $_POST['textcorreo'];
			//echo $text;
			$text = str_replace('[NOMBRE]', $_POST['nombreEM'], $text);
			$text = str_replace('[ORDEN]', $_POST['codigoEM'], $text);
			$text = str_replace('[NOTA-S]', $_POST['notaEM'], $text);
			$text = str_replace('[TICKET-S]', '<a href="' . $ruta . '">Descargar</a>', $text);


			$text = str_replace('[FACEBOOK]', '<a href="https://www.facebook.com/' . $suc['facebook'] . '">FACEBOOK</a> <br>', $text);
			$text = str_replace('[INSTAGRAM]', '<a href="https://www.instagram.com/' . $suc['instagram'] . '">INSTAGRAM</a> <br>', $text);
			$text = str_replace('[TWITTER]', '<a href="https://twitter.com/' . $suc['twitter'] . '">TWITTER</a> <br>', $text);
			$text = str_replace('[YOUTUBE]', '<a href="https://www.youtube.com/channel/' . $suc['youtube'] . '">YOUTUBE</a> <br>', $text);
			$text = str_replace('[SUCURSAL]', $_SESSION['nom_suc'], $text);
			$text = str_replace('[CODIGO]', $_POST['codeEM'], $text);
			$text = str_replace('[SITO-WB]', '<a href="' . $suc['sitio_web'] . '">Sitio web</a> <br>',  $text);
			$text = str_replace('[TEL]', $suc['whatsapp'], $text);
			$text = str_replace('*', "", $text);




			try {


				$mail = new PHPMailer(true);

				$mail->CharSet = "UTF-8";

				$mail->SMTPDebug = 0;                      // Enable verbose debug output
				$mail->isSMTP();                                            // Send using SMTP
				$mail->Host       = 'smtp.hostinger.mx';                    // Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				$mail->Username   = 'status@ifixitmor.com';                     // SMTP username
				$mail->Password   = '199720031230';                               // SMTP password
				$mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
				$mail->Port       = 587;                                    // TCP port to connect to

				//Recipients
				$mail->setFrom('status@ifixitmor.com', $_SESSION['nom_suc']);
				$mail->addAddress($correo, '');
				// Optional name

				// Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Estado de tu servicio';
				$mail->Body  = $text;
				$mail->send();

				return true;
			} catch (PHPMailer $th) {
				throw $th;
				return false;
			}
		}
	}
	public function ctrBucarServicioOrden()
	{
		if (isset($_POST['btnSearchService'])) {

			$_SESSION['orden'] = $_POST['inputSearchService'];

			echo '
				<script>
				window.location = "equipos-detalle";
				</script>
			';
		}
	}





	//SELECT COUNT(estado_equipo) AS total FROM servicios where estado_equipo != 'Reparado' || estado_equipo != 'Entregado'


}
