<?php
session_start();
require_once "../../../controladores/pedidos.controlador.php";
require_once "../../../modelos/pedidos.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";



class imprimirFactura
{

	public $orden;

	public function traerImpresionFactura()
	{

		//TRAEMOS LA INFORMACIÓN DE LA VENTA

		$sucursal = ControladorSucursal::ctrMostrarSucursal();
		if ($sucursal['margenes'] != "") {
			$margen = explode(",", $sucursal['margenes']);
		} else {
			$margen = explode(",", '1,8,0');
		}
		$direccion = $sucursal['direccion'];
		$nombre_suc = strtoupper($sucursal['nombre']);
		$telefono_suc = $sucursal['telefono'];
		$web = $sucursal['sitio_web'];

		$tipo_impresion = $sucursal['tipo_impresora'];

		$impresion = $tipo_impresion == '58mm' ? 135  : 190;
		$impresions2 = ($impresion / 2);
		$formato = $tipo_impresion == '58mm' ? 'A4' : 'A7';

		$itemVenta = "orden";
		$valorVenta = $this->orden;


		$servicio = ControladorPedidos::detallePedido($valorVenta);


		$fecha = $servicio['fecha_pedido'];
		$importe = $servicio['importe'];
		$anticipo = $servicio['anticipo'];
		$adeudo = $servicio['total'];
		$cliente = $servicio['nombre'];
		$contacto = $servicio['contacto'];
		$usuario = $servicio['usuario_recibio'];
		$encargo = $servicio['encargo'];

		$marca = $servicio['marca'];
		$modelo = $servicio['modelo'];


		$estado = $servicio['estado'];

		$pagado = "";

		if ($estado == "Entregado") {
			$adeudo = 0;
			$anticipo = $importe;
			$pagado = "PAGADO";
		}



		//REQUERIMOS LA CLASE TCPDF

		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


		$pdf->SetMargins($margen['0'], $margen['1'], $margen['2']);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->AddPage('P', $formato);

		// $logo = isset($_SESSION['ruta_logo']) && $_SESSION['ruta_logo']!="" ? '<img src="../../../'.$_SESSION['ruta_logo'].'"  width="100px"/>' : $nombre_suc;
		$logo = $sucursal['ruta_logo'] == "" ? $nombre_suc : '<img src="../../../' . $sucursal['ruta_logo'] . '"  width="50px"/>';

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
				<strong> ENCARGO #$valorVenta</strong>
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
					<td style=" text-align:center;">$modelo </td>

				</tr>

				
					<tr>
				
				<th><strong>Encargo</strong></th>
				

				</tr>
				<tr>
					<td style=" text-align:center;">$encargo</td>
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
	
		<td style="width:$impresions2 px;">
		
			 Total $ $importe 
		</td>

		<td style="width:$impresions2 px;">
			
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresions2 px;">
			 
		</td>

		<td style="width:$impresions2 px;">
			Anticipo $ $anticipo 
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px;">
			 --------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresions2 px;">
			 Adeuda:$ $adeudo
		</td>


		<td style="width:$impresions2 px;">
			
		</td>

	</tr>
	<tr>
	<td style="width:$impresion px; text-align: center;">
			 
			 <strong>$pagado</strong> 
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
		$pdf->Output('pedido-' . $valorVenta . '.pdf');
	}
}

$factura = new imprimirFactura();
$factura->orden = $_GET["codigo"];
$factura->traerImpresionFactura();
