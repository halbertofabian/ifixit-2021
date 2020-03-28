<?php

session_start();
require_once "../controladores/corte.controlador.php";
require_once "../modelos/corte.modelo.php";
require_once "../modelos/gastos.modelo.php";
require_once "../modelos/ingresos.modelo.php";


	/*if (isset($_GET['orden']) && isset($_GET['estado'])) {
		$res = ControladorServicios::ctrCambiarEstadoEquipo($_GET['estado'],$_SESSION['nombre'],$_GET['orden']);
		if($res){
			header("location:../entregas");
		}else{
			
		}

	    

	}*/

	if(isset($_GET['cantidad'])){
		$_SESSION['corte'] = $_GET['cantidad'];
		//
		$total = ControladorCorte::procesarCorte();
		$detalle = ControladorCorte::ctrMostrarMovimientos();
		//var_dump(( int ) $total);
		//var_dump($total);
		$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha.' '.$hora;

		if($total==$_GET['cantidad']){
			$datos = array(
							'servicios' => $detalle['servicios'],
							'pedidos' => $detalle['pedidos'],
							'ventas' => $detalle['ventas'],
							'ingresos' => $detalle['ingresos'],
							'gastos' => $detalle['gastos'],
							'cantidad' => $total,
							'sobrante' => 0 ,'faltante' => 0,
							'usuario' => $_SESSION['nombre'],
							'fecha_corte' => $fechaActual );
			$corte = ControladorCorte::cargarCorte($datos);

			ControladorCorte::ctlCambiarEstado();
			echo'
				<script>
					window.location = "../corte";
					window.open("../extensiones/tcpdf/pdf/corte.php?codigo=0", "_blank");
				</script>

			';
		}



		elseif(isset($_GET['hacer'])){
			$cantidad = $total - $_GET['cantidad']; 
			if($cantidad>0){
				$faltante = $cantidad*-1;
				$sobrante = 0;
			} 
			if($cantidad<0){
				$faltante = 0;
				$sobrante = $cantidad*-1;
			}
			$datos = array(
							'servicios' => $detalle['servicios'],
							'pedidos' => $detalle['pedidos'],
							'ventas' => $detalle['ventas'],
							'ingresos' => $detalle['ingresos'],
							'gastos' => $detalle['gastos'],
				
							'cantidad' => $_GET['cantidad'],
							'sobrante' =>$sobrante,
							'faltante' => $faltante,
							'usuario' => $_SESSION['nombre'],
							'fecha_corte' => $fechaActual);
			$corte = ControladorCorte::cargarCorte($datos);
			ControladorCorte::ctlCambiarEstado();
			echo'
				<script>
					window.location = "../corte";
					window.open("../extensiones/tcpdf/pdf/corte.php?codigo=0", "_blank");
				</script>

			';
			
		}else{
			header("location:../corte");
		}
		

	}




