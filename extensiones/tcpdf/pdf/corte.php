<?php session_start();

require_once "../../../controladores/corte.controlador.php";
require_once "../../../modelos/corte.modelo.php";

require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";



class imprimirFactura
{

	public $codigo;

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
		$nombre_suc = $sucursal['nombre'];
		$telefono_suc = $sucursal['telefono'];
		$tipo_impresion = $sucursal['tipo_impresora'];
		$impresion = $tipo_impresion == '80mm' ? 190  : 135;
		$impresions2 = ($impresion / 2);
		$formato = $tipo_impresion == '80mm' ? 'A7' : 'A4';



		$itemVenta = "codigo";
		$valorVenta = $this->codigo;
		$respuestaVenta = ControladorCorte::mostrarCorte($valorVenta);

		$servicios = $respuestaVenta['servicios'];
		$pedidos = $respuestaVenta['pedidos'];
		$ventas = $respuestaVenta['ventas'];
		$ingresos = $respuestaVenta['ingresos'];
		$gastos = $respuestaVenta['gastos'];
		$fecha = $respuestaVenta['fecha_corte'];
		$cantidad = $respuestaVenta['cantidad'];
		$sobrante = $respuestaVenta['sobrante'];
		$faltante = $respuestaVenta['faltante'];
		$usuario = $respuestaVenta['usuario'];
		$corte = $respuestaVenta['id'];


		//TRAEMOS LA INFORMACIÓN DEL VENDEDOR


		//REQUERIMOS LA CLASE TCPDF

		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetMargins($margen['0'], $margen['1'], $margen['2']);




		//$pdf->SetHeaderMargin(0);
		//$pdf->SetFooterMargin(0);
		//$pdf->setCellPaddings(0,0,0,0);
		//$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->setPrintHeader(false); //no imprime la cabecera ni la linea 
		$pdf->setPrintFooter(false);

		$pdf->AddPage('P', $formato);

		// $logo = isset($_SESSION['ruta_logo']) && $_SESSION['ruta_logo']!="" ? '<img src="../../../'.$_SESSION['ruta_logo'].'"  width="100px"/>' : $nombre_suc;
		$logo = $sucursal['ruta_logo'] == "" ? $nombre_suc : '<img src="../../../' . $sucursal['ruta_logo'] . '"  width="50px"/>';

		//---------------------------------------------------------

		$bloque1 = <<<EOF

<table style="font-size:9px; text-align:center">

	<tr>
		<td style="width:$impresion px;">
	
			<div>
			
				

				
				$logo
				<br>
				
				Fecha de corte: $fecha
				<br>
				Dirección: $direccion

				<br>
				Teléfono: $telefono_suc
				<div style="text-align:center;border: .1px solid #000; background-color:#000; height:80px; color:#fff; font-size:10px;">
				<strong> CORTE #$corte</strong>
				</div>
				
				Usuario: $usuario

				<br>

			</div>

		</td>

	</tr>


</table>

EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------

		// ---------------------------------------------------------

		$bloque3 = <<<EOF

<table style="font-size:9px; text-align:center">

	<tr>
	
		<td style="width:$impresions2 px;">
			 Detalle:
		</td>

	</tr>
	<tr>
		<td style="width:$impresions2 px;">
			Servicios: $  $servicios <br>
		</td>

	</tr>
	<tr>
		<td style="width:$impresions2 px;">
			Pedidos: $  $pedidos <br>
		</td>

	</tr>
	<tr>
		<td style="width:$impresions2 px;">
			Ventas: $  $ventas <br>
		</td>

	</tr>
	<tr>
		<td style="width:$impresions2 px;">
			Ingresos: $  $ingresos <br>
		</td>

	</tr>
	<tr>
		<td style="width:$impresions2 px;">
			Gastos: $  $gastos <br>
		</td>

	</tr>
	<tr>
		<td style="width:$impresions2 px;">
			Total: $ $cantidad <br>
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresions2 px;">
			 Sobrante: 
		</td>

		<td style="width:$impresions2 px;">
			$ $sobrante
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px;">
			 <hr>
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresions2 px;">
			 Faltante: 
		</td>

		<td style="width:$impresions2 px;">
			$ $faltante
		</td>

	</tr>

	

</table>



EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO 

		//$pdf->Output('factura.pdf', 'D');
		$pdf->Output('factura.pdf');
	}
}

$factura = new imprimirFactura();
$factura->codigo = $_GET["codigo"];
$factura->traerImpresionFactura();
