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
        $traspaso = ControladorMovimientos::ctrRangoFechasTipo($fechaInicial, $fechaFinal, 'TRASPASO',$corte);
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
	<td style=" background-color:white; text-align:center">TRASPASOS</td>
	</tr>
	<br>

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">#</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Concepto</td>

		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Fecha</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Usuario</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Cantidad</td>
		
		</tr>

	</table>

EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');


		// ---------------------------------------------------------


		// ---------------------------------------------------------
		$montoServicio = 0;
		foreach ($traspaso as $key => $item) {
			$montoServicio += $item['monto'];
			$bloque6 = <<<EOF

<br>


<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$item[numero_movimiento]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$item[concepto]
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$item[fecha]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
			$item[usuario]
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
            $item[extra]
			</td>
			
			
			
			


		</tr>

	</table>

EOF;


			$pdf->writeHTML($bloque6, false, false, false, false, '');
		}
	
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
