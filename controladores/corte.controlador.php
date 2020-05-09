<?php

class ControladorCorte
{

	static public function procesarCorte()
	{
		/**$importe = ModeloCorte::mdlServicioEntregado();
		$anticipo = ModeloCorte::mdlServicioPendiente();
		
		$pedidosPendiente = ModeloCorte::mdlPeidosPendiente();
		$pedidosAnticipos=ModeloCorte::mdlPedidosAnticipo();


		$ventas = ModeloCorte::mdlVentas();
		
		
		return $total = $importe['importe'] + $anticipo['anticipo'] + $ventas['ventas']+$pedidosPendiente[0]+$pedidosAnticipos[0];*/
		$ventas = ModeloCorte::mdlVentas();




		//validar el corte del pedido
		//totalCorteServicio => tcp
		$pedido = ModeloCorte::mdlPedidoList();
		$tcp = 0;
		foreach ($pedido as $key => $val) {
			//verificar si no se ha hecho corte
			if ($val['estado_corte'] == 0) {
				/*if($val['estado'] == "Entregado"){
					$tcp = $tcp + $val['importe'];
				}*/
				if ($val['anticipo'] != 0 && $val['estado'] != "Entregado") {
					$tcp = $tcp + $val['anticipo'];
				} elseif ($val['anticipo'] == 0 && $val['estado'] == "Entregado") {
					$tcp = $tcp + $val['importe'];
				} elseif ($val['anticipo'] == 0 && $val['estado'] != "Entregado") {
					$tcp = $tcp + 0;
				} elseif ($val['anticipo'] != 0 && $val['estado'] == "Entregado") {
					$tcp = $tcp + $val['total'];
				}
			} elseif ($val['estado_corte'] == 2) {

				if ($val['estado'] == "Entregado") {
					$tcp = $tcp + $val['importe'];
				}
			} elseif ($val['estado_corte'] == 3) {

				if ($val['estado'] == "Entregado") {
					$tcp = $tcp + $val['total'];
				}
			} elseif ($val['estado_corte'] == 4) {

				if ($val['anticipo'] != 0 && $val['estado'] != "Entregado") {
					$tcp = $tcp + 0;
					# code...
				}
			}
		}





		//validar el corte del servicio
		//totalCorteServicio => tcs


		// Nuevo corte para servicios 




		// Termina nuevo conte para servicios 
		$servicio = ModeloCorte::mdlServicioList();
		$tcs = 0;
		// foreach ($servicio as $key => $val) {
		// 	//verificar si no se ha hecho corte
		// 	if($val['estado_corte']==0){
		// 		/*if($val['estado_equipo'] == "Entregado"){
		// 			$tcs = $tcs + $val['importe'];
		// 		}*/
		// 		if ($val['anticipo']!=0 && $val['estado_equipo']!="Entregado") {
		// 			$tcs = $tcs + $val['anticipo'];
		// 		}
		// 		elseif ($val['anticipo']==0 && $val['estado_equipo']=="Entregado") {
		// 			$tcs = $tcs + $val['importe'];
		// 		}
		// 		elseif ($val['anticipo']==0 && $val['estado_equipo']!="Entregado") {
		// 			$tcs = $tcs + 0;
		// 		}
		// 		elseif ($val['anticipo']!=0 && $val['estado_equipo']=="Entregado") {
		// 			$tcs = $tcs + $val['total'];
		// 		}



		// 	}
		// 	elseif ($val['estado_corte']==2) {

		// 		if($val['estado_equipo'] == "Entregado"){
		// 			$tcs = $tcs + $val['importe'];
		// 		}
		// 	}
		// 	elseif ($val['estado_corte']==3) {

		// 		if($val['estado_equipo'] == "Entregado"){
		// 			$tcs = $tcs + $val['total'];
		// 		}
		// 	}
		// 	elseif ($val['estado_corte']==4) {

		// 		if ($val['anticipo']!=0 && $val['estado_equipo']!="Entregado") {
		// 			$tcs = $tcs+0;
		// 		# code...
		// 		}
		// 	}

		// }

		$corte = ControladorCorte::mostrarCorte(0);

	

		$servicio =  ModeloCorte::mdlObtenerIngresosServicio($corte['id']+1);

		foreach ($servicio as $key => $value) {
			$tcs = $tcs + $value['monto'];
		}


		//var_dump($servicio);

		$ventas = ModeloCorte::mdlVentas();
		$gastos = ModeloGastos::mdlTotalGastos();
		$ingresos = ModeloIngresos::mdlTotalingresos();
		$valor1 = (int) $tcs;
		$valor2 = (int) $tcp;
		$valor3 = (int) $ventas['ventas'];
		$valor4 = (int) $gastos['totalgastos'];
		$valor5 = (int) $ingresos['totalingresos'];
		//return number_format($tcs+$ventas['ventas']);
		//return number_format($valor1+$valor2);
		$suma = $valor1 + $valor2 + $valor3 + $valor5;
		return $suma - $valor4;
		//var_dump($suma);

	}
	static public function cargarCorte($datos)
	{
		$corte  = ModeloCorte::mdlCargarCorte($datos);
		return $corte;
	}
	static public function ctlCambiarEstado()
	{
		$corte  = ModeloCorte::mdlCambiarEstado();
	}
	static public function mostrarCorte($codigo)
	{
		$corte  = ModeloCorte::mdlMostrarCorte($codigo);
		return $corte;
	}
	static public function mostrarTodosCorte()
	{
		$corte  = ModeloCorte::mdlMostrarTodosCortes();
		return $corte;
	}

	public static function ctrBorrarCorte()
	{
		if (isset($_GET['idCorte'])) {
			$borrar = ModeloCorte::mdlBorrarCorte($_GET['idCorte']);

			if ($borrar) {

				echo '<script>

					swal({

						type: "success",
						title: "¡El corte ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
								window.location = "corte";
							

						}

					});
				

					</script>';
			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡No pudo ser borrado el corte!",
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

	static public function ctrMostrarMovimientos()
	{
		/**$importe = ModeloCorte::mdlServicioEntregado();
		$anticipo = ModeloCorte::mdlServicioPendiente();
		
		$pedidosPendiente = ModeloCorte::mdlPeidosPendiente();
		$pedidosAnticipos=ModeloCorte::mdlPedidosAnticipo();


		$ventas = ModeloCorte::mdlVentas();
		
		
		return $total = $importe['importe'] + $anticipo['anticipo'] + $ventas['ventas']+$pedidosPendiente[0]+$pedidosAnticipos[0];*/
		$ventas = ModeloCorte::mdlVentas();




		//validar el corte del pedido
		//totalCorteServicio => tcp
		$pedido = ModeloCorte::mdlPedidoList();
		$tcp = 0;
		foreach ($pedido as $key => $val) {
			//verificar si no se ha hecho corte
			if ($val['estado_corte'] == 0) {
				/*if($val['estado'] == "Entregado"){
					$tcp = $tcp + $val['importe'];
				}*/
				if ($val['anticipo'] != 0 && $val['estado'] != "Entregado") {
					$tcp = $tcp + $val['anticipo'];
				} elseif ($val['anticipo'] == 0 && $val['estado'] == "Entregado") {
					$tcp = $tcp + $val['importe'];
				} elseif ($val['anticipo'] == 0 && $val['estado'] != "Entregado") {
					$tcp = $tcp + 0;
				} elseif ($val['anticipo'] != 0 && $val['estado'] == "Entregado") {
					$tcp = $tcp + $val['total'];
				}
			} elseif ($val['estado_corte'] == 2) {

				if ($val['estado'] == "Entregado") {
					$tcp = $tcp + $val['importe'];
				}
			} elseif ($val['estado_corte'] == 3) {

				if ($val['estado'] == "Entregado") {
					$tcp = $tcp + $val['total'];
				}
			} elseif ($val['estado_corte'] == 4) {

				if ($val['anticipo'] != 0 && $val['estado'] != "Entregado") {
					$tcp = $tcp + 0;
					# code...
				}
			}
		}





		//validar el corte del servicio
		//totalCorteServicio => tcs
		$servicio = ModeloCorte::mdlServicioList();
		$tcs = 0;
		foreach ($servicio as $key => $val) {
			//verificar si no se ha hecho corte
			if ($val['estado_corte'] == 0) {
				/*if($val['estado_equipo'] == "Entregado"){
					$tcs = $tcs + $val['importe'];
				}*/
				if ($val['anticipo'] != 0 && $val['estado_equipo'] != "Entregado") {
					$tcs = $tcs + $val['anticipo'];
				} elseif ($val['anticipo'] == 0 && $val['estado_equipo'] == "Entregado") {
					$tcs = $tcs + $val['importe'];
				} elseif ($val['anticipo'] == 0 && $val['estado_equipo'] != "Entregado") {
					$tcs = $tcs + 0;
				} elseif ($val['anticipo'] != 0 && $val['estado_equipo'] == "Entregado") {
					$tcs = $tcs + $val['total'];
				}
			} elseif ($val['estado_corte'] == 2) {

				if ($val['estado_equipo'] == "Entregado") {
					$tcs = $tcs + $val['importe'];
				}
			} elseif ($val['estado_corte'] == 3) {

				if ($val['estado_equipo'] == "Entregado") {
					$tcs = $tcs + $val['total'];
				}
			} elseif ($val['estado_corte'] == 4) {

				if ($val['anticipo'] != 0 && $val['estado_equipo'] != "Entregado") {
					$tcs = $tcs + 0;
					# code...
				}
			}
		}



		$ventas = ModeloCorte::mdlVentas();
		$gastos = ModeloGastos::mdlTotalGastos();
		$ingresos = ModeloIngresos::mdlTotalingresos();
		$valor1 = (int) $tcs;
		$valor2 = (int) $tcp;
		$valor3 = (int) $ventas['ventas'];
		$valor4 = (int) $gastos['totalgastos'];
		$valor5 = (int) $ingresos['totalingresos'];
		//return number_format($tcs+$ventas['ventas']);
		//return number_format($valor1+$valor2);

		$movimientos = array(
			'servicios' => $valor1,
			'pedidos' => $valor2,
			'ventas' => $valor3,
			'gastos' => $valor4,
			'ingresos' => $valor5
		);
		//$suma = $valor1+$valor2+$valor3;
		return $movimientos;
		//var_dump($suma);

	}
}
