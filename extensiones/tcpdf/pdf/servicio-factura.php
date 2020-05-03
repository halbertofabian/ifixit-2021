<?php session_start();
require_once '../../../lib/phpqrcode/qrlib.php';
require_once "../../../controladores/servicios.controlador.php";
require_once "../../../modelos/servicios.modelo.php";
require_once "../../../controladores/sucursales.controlador.php";
require_once "../../../modelos/sucursales.modelo.php";
require_once "../../../controladores/plantilla.controlador.php";
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
		$sucursal = ControladorSucursal::ctrMostrarSucursal();

		if($sucursal['tipo_impresora']=="T-CARTA"){
			echo '
			<script>
				window.location.href="'.ControladorPlantilla::getRute().'extensiones/tcpdf/pdf/t-carta.php?codigo='.$this->orden.'"
				</script>
			';
		}
		if($sucursal['tipo_impresora']=="M-CARTA"){
			echo '
			<script>
				window.location.href="'.ControladorPlantilla::getRute().'extensiones/tcpdf/pdf/t-m-carta.php?codigo='.$this->orden.'"
				</script>
			';
		}



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

		$impresion = $tipo_impresion == '80mm' ? 190  : 135;
		$impresions2 = ($impresion / 2);
		$formato = $tipo_impresion == '80mm' ? 'A7' : 'A4';

		$itemVenta = "orden";
		$valorVenta = $this->orden;

		if ($valorVenta == 0) {
			$valorVenta = ControladorServicios::orden();
		}
		$servicio = ControladorServicios::ctrDetalleServicio($valorVenta);


		$fecha = $servicio['fecha_reparacion'];
		$importe = $servicio['importe'];
		$anticipo = $servicio['anticipo'];
		$adeudo = $servicio['total'];
		$cliente = $servicio['nombre'];
		$usuario = $servicio['usuario_recibio'];
		$problema = $servicio['problema'];
		$solucion = $servicio['solucion'];
		$marca = $servicio['marca'];
		$modelo = $servicio['modelo'];
		$observacion = $servicio['observaciones'];
		$estetica = $servicio['estetica'];
		$estado_fisico = $servicio['estado_fisico'];
		$color = $servicio['color'];
		$codigo = $servicio['codigo_cliente'];
		$contacto = $servicio['contacto'];
		$imei = $servicio['imei'];
		$nota = $servicio['nota'];

		$estado_equipo = $servicio['estado_equipo'];

		$pagado = "";
		//var_dump($sucursal['ruta_logo']);
		$logo = $sucursal['ruta_logo'] == "" ? $nombre_suc : '<img src="../../../' . $sucursal['ruta_logo'] . '"  width="50px"/>';

		//$logo = isset($_SESSION['ruta_logo']) && $_SESSION['ruta_logo']!="" ? '<img src="../../../'.$_SESSION['ruta_logo'].'"  width="100px"/>' : $nombre_suc;

		//$ruta = !isset($_SESSION['ruta_logo']) || $_SESSION['ruta_logo']==""  ? $nombre_suc : ""; ;
		//echo $_SESSION['ruta_logo'];

		ControladorPlantilla::generarQR($codigo);

		$nom_suc =  strtolower(str_replace(' ', '-', trim($sucursal['nombre'])));
		$qr = '<img src="../../../vistas/img/qr_generator/' . $nom_suc . '/s.jpg" width="50px" style=""></img>';






		//$qrurl = "vistas/img/qr_generator/" . md5($_SESSION['nom_suc']). '/' . $valorVenta . '.png';

		if ($estado_equipo == "Entregado") {
			$adeudo = 0;
			$anticipo = $importe;
			$pagado = "PAGADO";
		}

		//REQUERIMOS LA CLASE TCPDF

		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetMargins($margen['0'], $margen['1'], $margen['2'],0);

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->AddPage('P', $formato);

		$bardcode = $pdf->serializeTCPDFtagParameters(
			array($valorVenta, 'C128', '', '', 0, 0, 0.5, array(
				'position' => 'S',
				'border' => false, 'padding' => 0,
				'fgcolor' => array(0, 0, 0),
				'bgcolor' => array(255, 255, 255),
				'text' => true, 'font' => 'helvetica',
				'fontsize' => 7, 'stretchtext' => 6
			), 'N')
		);


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
				<strong> SERVICIO #$valorVenta</strong>
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
				<th><strong>Problema</strong></th>
				

				</tr>
				<tr>
					<td style=" text-align:center;">$problema</td>
				</tr>
				
				<tr>
				<th>
				<strong>Solucion</strong></th>
				

				</tr>
				<tr>
					<td style=" text-align:center;">$solucion</td>
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

<table style="font-size:9px; text-align:right;">

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
			 
		</td>

	</tr>

	<tr>
	
		<td style="width:$impresions2 px;">
			 Adeuda:$ $adeudo <br>
			
		</td>
		
		
		

		

	</tr>
	<tr>
	<td style="width:$impresion px; text-align: center;">
			 
			 <strong>$pagado</strong> 
	</td>
	</tr>

	
	<tr>
		<td>
			<hr>
		</td>
	</tr>
	
	<tr>
		<td style="text-align:center;">
		
			 
			 <strong> Firma de equipo entregado </strong>
		</td>
	</tr>

	<tr>
		<td style="width:$impresion px; text-align: left;">
			 <style>
				.p{
					font-size:4px;
				}
			 </style>

			 <div style="text-align:center;"> <strong> Políticas </strong></div>
			 <p align="justify" style="font-size:6.9px;" >
				$politicas
			 </p>
			 <br>

			 
			 


		</td>
	</tr>

	<tr>
		<td>
			<hr>
		</td>
	</tr>
	
	<tr>
		<td style="text-align:center;">
		
			 
			 <strong>Firma aceptación</strong>
		</td>
	</tr>

	</table>
	
	<table>
	
	
</table>
    




EOF;

$qrType = <<<EOF

<table>
<tr>
	
<td style="width:$impresions2 px; font-size:9px; text-align: center;" >
	
	Muchas gracias por su elección

	<div style="font-size:6.9px;">
	Consulta el estado de tu servicio en la siguiente url 
	<br>
	<strong>softmormx.com/consulta</strong>
	<br>
	Codigo: <strong>$codigo</strong>
	</div>
	
</td>
<td style="width:$impresions2 px; font-size:9px; text-align: center;" >


	<div style="font-size:6.9px;">
	
	$qr
	
</td>



</tr>
<tr>
	<td style="width:$impresion px; font-size:8px; text-align: center;">
		<div style="font-size:6.9px;">
			$nota
		</div>
		<br>
	</td>	
	</tr>
</table>

EOF;

		

		$pdf->writeHTML($bloque3, false, false, false, false, '');


		$pdf->writeHTML($qrType, false, false, false, false, '');
		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO 

		//$pdf->Output('factura.pdf', 'D');
		$pdf->Output('servicio-' . $valorVenta . 'factura.pdf');
	}
}

$factura = new imprimirFactura();
$factura->orden = $_GET["codigo"];
$factura->traerImpresionFactura();
/**
 * 
 * <tr>
	
		<td style="width:$impresion px; text-align:center; font-size:7px;">

		<tcpdf style="width:$impresion px; text-align:center;" method="write1DBarcode" params="$bardcode" />
		
		
		</td>

	</tr>
 */