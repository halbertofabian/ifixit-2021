<?php session_start();

require_once "../../../controladores/servicios.controlador.php";
require_once "../../../modelos/servicios.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
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
	public $tipo;

	public function traerImpresionFactura()
	{

		//TRAEMOS LA INFORMACIÓN DE LA VENTA
		$sucursal = ControladorSucursal::ctrMostrarSucursal();


		$tipo_impresion = $sucursal['tipo_impresora'];

		$impresion = $tipo_impresion == '58mm' ? 135  : 160;
		$formato = $tipo_impresion == '58mm' ? 'A4' : 'A7';

		$itemVenta = "orden";
		$valorVenta = $this->orden;

		if ($this->tipo == "servicio") {
			$servicio = ControladorServicios::ctrDetalleServicio($valorVenta);
			$cliente = $servicio['nombre'];
		} else if ($this->tipo = "producto") {
			$producto = ControladorProductos::ctrMostrarProducto($valorVenta);
			$nombre_producto = $producto['descripcion'];
			$precio_producto = $producto['precio_venta'];
		}


		//REQUERIMOS LA CLASE TCPDF

		require_once('tcpdf_include.php');

		$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		if ($impresion == '58') {
			$pdf->SetMargins(2, 4, 4);
		}
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->AddPage('P', $formato);

		$bardcode = $pdf->serializeTCPDFtagParameters(
			array($valorVenta, 'C39+', '', '', 0, 0, 0.5, array(
				'position' => 'S',
				'border' => false, 'padding' => 0,
				'fgcolor' => array(0, 0, 0),
				'bgcolor' => array(255, 255, 255),
				'text' => true, 'font' => 'helvetica',
				'fontsize' => 7, 'stretchtext' => 6
			), 'N')
		);

		if ($this->tipo == "servicio") {
			$bloque3 = <<<EOF

<table style="font-size:8px; text-align:right;">
	<tr>
	
		<td style="width:$impresion px; text-align:left; font-size:8px;">

		Cliente: <strong> $cliente </strong> <br>
		Contacto: <strong> $servicio[contacto]</strong> <br>
		Equipo: <strong> $servicio[equipo] $servicio[marca] $servicio[modelo] $servicio[color]</strong> <br>
		Observaciones: <strong> $servicio[observaciones] </strong> <br>
		Problema: <strong> $servicio[problema] </strong> <br>
		Solución: <strong> $servicio[solucion] </strong> <br>
		Fecha recepción: <strong> $servicio[fecha_reparacion]</strong> <br>
		Fecha entrega: <strong> $servicio[fecha_prometida]</strong> <br>
		<br><br>
		<tcpdf style="width:$impresion px; text-align:left;" method="write1DBarcode" params="$bardcode" />
		
		
		</td>

	</tr>
</table>



EOF;

			$pdf->writeHTML($bloque3, false, false, false, false, '');
		} else if ($this->tipo = "producto") {
			$bloque1 = <<<EOF

<table style="font-size:20px; text-align:right;">
	<tr>
	
		<td style="width:$impresion px; text-align:center; font-size:8px;">

		<div style="text-align:center;">$nombre_producto</div>

		<tcpdf style="width:$impresion px; text-align:center;" method="write1DBarcode" params="$bardcode" />
		<div style="text-align:right;"> $ <strong> $precio_producto </strong> </div>


		
		
		</td>

	</tr>
</table>



EOF;
			$pdf->writeHTML($bloque1, false, false, false, false, '');
		}

		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO 

		$pdf->Output('etiqueta.pdf');
		//$pdf->Output('Etiqueta-' . $valorVenta . 'etiquta.pdf');
	}
}

$factura = new imprimirFactura();
$factura->orden = $_GET["codigo"];
$factura->tipo = $_GET["tipo"];
$factura->traerImpresionFactura();
