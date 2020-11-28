<?php session_start();

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";



class imprimirFactura
{

	public $codigo;

	public function traerImpresionFactura()
	{

		//TRAEMOS LA INFORMACIÓN DE LA VENTA

		$sucursal = ControladorSucursal::ctrMostrarSucursal();

		$tipo_hoja = $sucursal['tipo_hoja'];

		$tipo_hoja = explode(",",$tipo_hoja);

		$_80mm = $tipo_hoja[0];
		$_58mm = $tipo_hoja[0];

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
		$politicas_ventas = $sucursal['politicas_accesorios'];

		$impresion = $tipo_impresion == '80mm' ? 190  : 135;
		$impresions2 = ($impresion / 2);
		$formato = $tipo_impresion == '80mm' ? $_80mm : $_58mm;

		$itemVenta = "codigo";
		$valorVenta = $this->codigo;

		$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

		$fecha = substr($respuestaVenta["fecha"], 0, -8);
		$productos = json_decode($respuestaVenta["productos"], true);
		$neto = number_format($respuestaVenta["neto"], 2);
		$impuesto = number_format($respuestaVenta["impuesto"], 2);
		$total = number_format($respuestaVenta["total"], 2);

		//TRAEMOS LA INFORMACIÓN DEL CLIENTE

		$itemCliente = "id";
		$valorCliente = $respuestaVenta["id_cliente"];

		$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

		//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

		$itemVendedor = "usuario";
		$valorVendedor = $respuestaVenta["id_vendedor"];

		$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

		//REQUERIMOS LA CLASE TCPDF

		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		//$pdf->setPrintHeader(false);
		//$pdf->setPrintFooter(false);
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

<table style="font-size:9px;">

	<tr>
		<td style="width:$impresion px;">
	
			<div>
				<strong style="text-align:center">
				
				$logo 
				
				</strong> 
				<br>
		
			
				Fecha recepción: $fecha
				
				
				<div style="width:$impresion px;">
				
			 <hr>
			
				
				Dirección: $direccion

				<br>
				Teléfono: $telefono_suc
				
				<br>
				$web
				
				
			<hr>
			
		</div>
									
				Cliente: $respuestaCliente[nombre]

				<br>
				Vendedor: $respuestaVendedor[nombre]

				<br>
				<div style="text-align:center;border: .1px solid #000; background-color:#000; height:80px; color:#fff; font-size:10px;">
				<strong> VENTA #$valorVenta</strong>
				</div>
				

			</div>

		</td>

	</tr>


</table>

EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------


		foreach ($productos as $key => $item) {

			$valorUnitario = number_format($item["precio"], 2);

			$precioTotal = number_format($item["total"], 2);

			$bloque2 = <<<EOF

<table style="font-size:9px;">

	<tr>
	
		<td style="width:$impresion px; text-align:left">
		$item[descripcion] 
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px; text-align:right">
		$ $valorUnitario Und * $item[cantidad]  = $ $precioTotal
		<br>
		</td>

	</tr>

</table>

EOF;

			$pdf->writeHTML($bloque2, false, false, false, false, '');
		}

		// ---------------------------------------------------------

		$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>
	
		<td style="width:$impresions2 px;">
			 NETO: 
		</td>

		<td style="width:$impresions2 px;">
			$ $neto
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresions2 px;">
			 DTO: 
		</td>

		<td style="width:$impresions2 px;">
			$ $impuesto
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresion px;">
			 <hr>
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresions2 px;">
			 TOTAL: 
		</td>

		<td style="width:$impresions2 px;">
			$ $total
		</td>

	</tr>
	<tr>
	
		<td style="width:$impresion px;"> 
		 
			 <p align="justify" style="font-size:6.9px;" >
			  	<strong>$politicas_ventas</strong>
			 </p>
		</td>

	</tr>
	
	<tr>
	
		<td style="width:$impresion px; text-align:center">
			
			Muchas gracias por su compra
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
