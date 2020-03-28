<?php session_start();




require_once "../../../controladores/movimientos.controlador.php";
require_once "../../../modelos/movimientos.modelo.php";


require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
class imprimirFactura
{

	public $codigo;
	public $fechaInicial;
	public $fechaFinal;
	public $corte;

	public function traerImpresionFactura()
	{

		//TRAEMOS LA INFORMACIÓN DE LA VENTA

		//	$itemVenta = "codigo";
		//	$valorVenta = $this->codigo;
		$fechaInicial = $this->fechaInicial;
		$fechaFinal = $this->fechaFinal;
		$corte = $this->corte;

		//var_dump($fechaInicial);
		//var_dump($fechaFinal);

		//EMPIEZA

		$ventas = ControladorMovimientos::ctrRangoFechasTipo($fechaInicial, $fechaFinal, 'VENTA',$corte );
		$servicios = ControladorMovimientos::ctrRangoFechasTipo($fechaInicial, $fechaFinal, 'SERVICIO',$corte );
		$pedidos = ControladorMovimientos::ctrRangoFechasTipo($fechaInicial, $fechaFinal, 'PEDIDO',$corte );
		$ingresos = ControladorMovimientos::ctrRangoFechasTipo($fechaInicial, $fechaFinal, 'INGRESO',$corte );
		$gastos = ControladorMovimientos::ctrRangoFechasTipo($fechaInicial, $fechaFinal, 'GASTO',$corte );
		//REQUERIMOS LA CLASE TCPDF

		

		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->startPageGroup();

		$pdf->AddPage();

		// ---------------------------------------------------------

		$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="text-align:center">


			
			<h1>REPORTE DE MOVIMIENTOS</h1>
			
			
			</td>

			

			

			

			

		</tr>

	</table>

EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white;">

				Reporte en construcción

			</td>


		</tr>

		

		

	</table>

EOF;

		$pdf->writeHTML($bloque2, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">
	
	<tr>
	<td style=" background-color:white; text-align:center">VENTAS</td>
	</tr>
	<br>

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:50px; text-align:center">#</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Concepto</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Monto</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Fecha</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Usuario</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Extra</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Corte</td>
		</tr>

	</table>

EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------
		$montoVentas = 0;
		$totalCompra = 0;
		foreach ($ventas as $v => $venta) {
			
			$movimiento = $venta["numero_movimiento"];
			$fecha = $venta["fecha"];
			$concepto = json_decode($venta["concepto"], true);
			//$concepto = $venta["concepto"];
			$monto = number_format($venta["monto"], 2);
			$usuario = $venta["usuario"];
			$extra = $venta["extra"];
			$corte = $venta["corte"];

			$montoVentas = $montoVentas + $monto;

			//var_dump($concepto);

			foreach ($concepto as $key => $item) {

				$itemProducto = "descripcion";
				$valorProducto = $item["descripcion"];
				$cantidad = $item["cantidad"];
				$orden = null;

				$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

				$valorUnitario = number_format($respuestaProducto["precio_compra"], 2);
				$totalCompra += $valorUnitario*$cantidad;
				$precioTotal = number_format($item["total"], 2);


				$extra = $valorUnitario*$cantidad;

				$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:50px; text-align:center">
			$movimiento
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$item[descripcion]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			$item[precio]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			$fecha
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			$usuario
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			$valorUnitario * $cantidad <br> = $extra
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			$corte
			</td>
			
			
			


		</tr>

	</table>


EOF;

				$pdf->writeHTML($bloque4, false, false, false, false, '');
			}
		}
		$totalVentas = $montoVentas - $totalCompra;
		// ---------------------------------------------------------

		$bloque5 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">


<tr>

	<td style="border-right: 1px solid #666; color:#333; background-color:white; width:330px; text-align:center"></td>

	<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
		TOTAL COMPRA:
	</td>

	<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
		$ $totalCompra
	</td>

</tr>

<tr>

	<td style="border-right: 1px solid #666; color:#333; background-color:white; width:330px; text-align:center"></td>

	<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
		TOTAL VENTA:
	</td>

	<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
		$ $montoVentas
	</td>

</tr>

<tr>

	<td style="border-right: 1px solid #666; color:#333; background-color:white; width:330px; text-align:center"></td>

	<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
		GANANCIAS:
	</td>
	
	<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
		$ $totalVentas
	</td>

</tr>


</table>

	<table style="font-size:10px; padding:5px 10px;">
<tr>
<td style=" background-color:white; text-align:center">SERVICIOS</td>
</tr>
<br>
</table>


EOF;

		$pdf->writeHTML($bloque5, false, false, false, false, '');

		// ---------------------------------------------------------
		$montoServicio = 0;
		foreach ($servicios as $key => $item) {
			$montoServicio += $item['monto'];
			$bloque6 = <<<EOF

<br>


<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:50px; text-align:center">
			$item[numero_movimiento]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			$item[concepto]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			$item[monto]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			$item[fecha]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			$item[usuario]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			$item[corte]
			</td>
			
			
			


		</tr>

	</table>

EOF;


			$pdf->writeHTML($bloque6, false, false, false, false, '');
		}
		$bloque7 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:330px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Total:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $montoServicio
			</td>

		</tr>

		

		


	</table>
	<br>

	<table style="font-size:10px; padding:5px 10px;">
	<tr>
	<td style=" background-color:white; text-align:center">PEDIDOS</td>
	</tr>
	<br>
	</table>

EOF;

		$pdf->writeHTML($bloque7, false, false, false, false, '');

		$montoPedidos = 0;
		foreach ($pedidos as $key => $item) {
			$montoPedidos += $item['monto'];
			$bloque8 = <<<EOF


<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
		<td style="border: 1px solid #666; color:#333; background-color:white; width:50px; text-align:center">
		$item[numero_movimiento]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
		$item[concepto]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
		$item[monto]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
		$item[fecha]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
		$item[usuario]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
		$item[corte]
		</td>
			
			
			


		</tr>

	</table>

EOF;

			$pdf->writeHTML($bloque8, false, false, false, false, '');
		}
		$bloque9 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:330px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Total:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $montoPedidos
			</td>

		</tr>

		

		


	</table>
	<br>

	<table style="font-size:10px; padding:5px 10px;">
	<tr>
	<td style=" background-color:white; text-align:center">INGRESO</td>
	</tr>
	<br>
	</table>

EOF;

		$pdf->writeHTML($bloque9, false, false, false, false, '');
		$montoIngresos = 0;
		foreach ($ingresos as $key => $item) {
			$montoIngresos += $item['monto'];
			$bloque10 = <<<EOF


<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
		<td style="border: 1px solid #666; color:#333; background-color:white; width:50px; text-align:center">
		$item[numero_movimiento]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
		$item[concepto]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
		$item[monto]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
		$item[fecha]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
		$item[usuario]
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
			
		</td>
		<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
		$item[corte]
		</td>
			
			
			


		</tr>

	</table>

EOF;

			$pdf->writeHTML($bloque10, false, false, false, false, '');
		}
		$bloque11 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:330px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Total:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $montoIngresos
			</td>

		</tr>

		

		


	</table>
	<br>

	<table style="font-size:10px; padding:5px 10px;">
	<tr>
	<td style=" background-color:white; text-align:center">GASTOS</td>
	</tr>
	<br>
	</table>

EOF;

		$pdf->writeHTML($bloque11, false, false, false, false, '');
		$montoGastos = 0;
		foreach ($gastos as $key => $item) {
			$montoGastos += $item['monto'];

			$bloque12 = <<<EOF


<table style="font-size:10px; padding:5px 10px;">

<tr>
			
<td style="border: 1px solid #666; color:#333; background-color:white; width:50px; text-align:center">
$item[numero_movimiento]
</td>
<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
$item[concepto]
</td>
<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
$item[monto]
</td>
<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
$item[fecha]
</td>
<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
$item[usuario]
</td>
<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
	
</td>
<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
$item[corte]
</td>
	
	
	


</tr>

	</table>

EOF;

			$pdf->writeHTML($bloque12, false, false, false, false, '');
		}
		$bloque13 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:330px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Total:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $montoGastos
			</td>

		</tr>

		

		


	</table>


EOF;

		$pdf->writeHTML($bloque13, false, false, false, false, '');

		$totalVentas = $totalVentas + $montoServicio + $montoPedidos + $montoIngresos;
		$totalNeto = $totalVentas - $montoGastos;
		$bloque14 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:330px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:330px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				VENTAS:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $totalVentas
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:330px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				GASTOS:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				- $ $montoGastos
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:330px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				TOTAL:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $totalNeto
			</td>

		</tr>


	</table>

EOF;

		$pdf->writeHTML($bloque14, false, false, false, false, '');
		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO 

		//$pdf->Output('factura.pdf', 'D');
		$pdf->Output('factura.pdf');
	}
}

$factura = new imprimirFactura();
//$factura->codigo = $_GET["codigo"];
if (isset($_GET["fechaInicial"])) {

	$factura-> fechaInicial = $_GET["fechaInicial"];
	$factura-> fechaFinal = $_GET["fechaFinal"];
} else {

	$factura-> fechaInicial = null;
	$factura-> fechaFinal = null;
}
if(isset($_GET['corte'])){
	$factura-> corte = $_GET["corte"];
}else{
	$factura-> corte = null;
}
$factura->traerImpresionFactura();
