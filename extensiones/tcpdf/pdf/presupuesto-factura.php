<?php session_start();

require_once "../../../controladores/presupuestos.controlador.php";
require_once "../../../modelos/presupuestos.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
/*
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";*/



class imprimirFactura
{

	public $orden;

	public function traerImpresionFactura()
	{

		//TRAEMOS LA INFORMACIÓN DE LA VENTA
		//Consulta
		$sucursal = ControladorSucursal::ctrMostrarSucursal();

		if ($sucursal['margenes'] != "") {
			$margen = explode(",", $sucursal['margenes']);
		} else {
			$margen = explode(",", '1,8,0');
		}
		$direccion = $sucursal['direccion'];
		$nombre_suc = strtoupper($sucursal['nombre']);
		$telefono_suc = $sucursal['telefono'];
		$politicas = $sucursal['politicas'];
		$web = $sucursal['sitio_web'];

		$tipo_impresion = $sucursal['tipo_impresora'];

		$impresion = $tipo_impresion == '58mm' ? 135  : 160;
		$impresions2 = ($impresion / 2);
		$formato = $tipo_impresion == '58mm' ? 'A4' : 'A7';


		$itemVenta = "orden";
		$valorVenta = $this->orden;

		if ($valorVenta == 0) {
			$valorVenta = ControladorPresupuestos::presupuesto();
		}
		$servicio = ControladorPresupuestos::ctrDetallePresupuesto($valorVenta);


		$fecha = $servicio['fecha_cotizacion'];
		$importe = $servicio['costo_estimado'];

		$cliente = $servicio['nombre'];
		$usuario = $servicio['usuario_recibio'];
		$problema = $servicio['diagnostico'];

		$contacto = $servicio['contacto'];
		$marca = $servicio['marca'];
		$modelo = $servicio['modelo'];
		$observacion = $servicio['observaciones'];
		$estetica = $servicio['estetica'];
		$estado_fisico = $servicio['estado_fisico'];
		$color = $servicio['color'];
		$imei = $servicio['imei'];

		//REQUERIMOS LA CLASE TCPDF

		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetMargins($margen['0'], $margen['1'], $margen['2']);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->AddPage('P', $formato);

		// $logo = isset($_SESSION['ruta_logo']) && $_SESSION['ruta_logo']!="" ? '<img src="../../../'.$_SESSION['ruta_logo'].'"  width="100px"/>' : $nombre_suc;
		$logo = $sucursal['ruta_logo'] == "" ? $nombre_suc : '<img src="../../../' . $sucursal['ruta_logo'] . '"  width="100px"/>';

		//---------------------------------------------------------

		$bloque1 = <<<EOF

<table style="font-size:9px;">
	

	<tr>
		<td style="width:$impresion px;">
	
			<div>
			
				<strong style="text-align:center">
				
				
				$logo 
				
				
				</strong> 
			

				<div style="text-align:center">
			 	
				
				 $direccion

				<br>
				 $telefono_suc
				
				<br>
				
				$web
				
				</div>
				<div style="text-align:center; border: .1px solid #000;">
				<strong> Fecha:</strong>  $fecha<br>
				<strong> Cliente:</strong> $cliente <br>
				<strong> Contacto:</strong> $contacto <br>
				<strong> Le atendio:</strong> $usuario 
				</div>
				 
			
				<div style="text-align:center;border: .1px solid #000; background-color:#000; height:80px; color:#fff; font-size:10px;">
				<strong> COTIZACION #$valorVenta</strong>
				</div>
				
				<div style="text-align:center">
				<strong > Datos del equipo </strong>
				</div>
				
				<table style=" text-align:left; border: .01px solid #000;">
				<thead>

				</thead>
				<tbody>
				<tr>

				<th><strong>Marca</strong></th>
				

				</tr>

				<tr>
					<td style=" text-align:center;">$marca</td>
				</tr>
				

				<tr>

				<th>

					<strong>Modelo</strong></th>
				

				</tr>
				
				<tr>
					<td style=" text-align:center;">$modelo $color</td>

				</tr>

				

				<tr>

					<th><strong>Imei/Serie</strong></th>
			

				</tr>
				<tr>
					<td style="text-align:center;">$imei</td>
				</tr>
					<hr>
				<tr>
				<th><strong>Diagnostico</strong></th>
				

				</tr>
				<tr>
					<td style=" text-align:center;">$problema</td>
				</tr>
				
				
				

				<tr>
				<th><strong>Observaciones</strong></th>
				
				</tr>
				<tr>


				
				<td style=" text-align:center;">$observacion</td>

				</tr>
				<hr>

				<tr>
				<th><strong>Estetica</strong></th>
				

				</tr>

				<tr>
				<td style=" text-align:center;">$estetica</td>
				</tr>

				<tr>
				<th>
					<strong>Estado físico</strong>
				</th>
		

				</tr>
				<tr>
					<td style=" text-align:center;">$estado_fisico</td>
				</tr>
				
				


				</tbody>
					
				</table>
			
				</div>

		</td>

	</tr>


</table>

EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------







		// ---------------------------------------------------------

		$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	
	<tr>
	
		<td style="text-align: center; width:$impresion px;">
			 Costo estimado: <br> <strong>$importe</strong> 
		</td>

		

	</tr>

	<br>
	<br>
	

	<tr>
	
		<td><hr></td>

	</tr>

	<tr>

		<td style="width:$impresion px;text-align:center ">
		
			 
			 
			 <strong>Firma de aceptación</strong>
		</td>
	</tr>



	

	
	<tr>
		<td style="width:$impresion px; text-align: left;">
			 <style>
				.p{
					font-size:4px;
				}
			 </style>

			 <div style="text-align:center;"> <strong> Politicas </strong></div>
			 <p align="justify" style="font-size:6.9px;" >
				$politicas
			 </p>

		</td>
	</tr>
	
	<tr>
	
		<td style="width:$impresion px; font-size:8px; text-align: center;" >
			
			Muchas gracias por su elección
			
			
		</td>

	</tr>

</table>



EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO 

		//$pdf->Output('factura.pdf', 'D');
		$pdf->Output('Cotizacion-' . $valorVenta . '.pdf');
	}
}

$factura = new imprimirFactura();
$factura->orden = $_GET["codigo"];
$factura->traerImpresionFactura();
