<?php session_start();

require_once "../../../controladores/servicios.controlador.php";
require_once "../../../modelos/servicios.modelo.php";
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
        $sucursal = ControladorSucursal::ctrMostrarSucursal();
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
        $pin = $servicio['desbloqueo'];


        $estado_equipo = $servicio['estado_equipo'];

        $pagado = "";

        //$logo = isset($_SESSION['ruta_logo']) && $_SESSION['ruta_logo']!="" ? '<img src="../../../'.$_SESSION['ruta_logo'].'"  width="100px"/>' : $nombre_suc;

        //$ruta = !isset($_SESSION['ruta_logo']) || $_SESSION['ruta_logo']==""  ? $nombre_suc : ""; ;
        //echo $_SESSION['ruta_logo'];

        $logo = $nombre_suc;





        $qrurl = "vistas/img/qr_generator/" . md5($_SESSION['nom_suc']) . '/' . $valorVenta . '.png';

        if ($estado_equipo == "Entregado") {
            $adeudo = 0;
            $anticipo = $importe;
            $pagado = "PAGADO";
        }

        //REQUERIMOS LA CLASE TCPDF

        require_once('tcpdf_include.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->startPageGroup();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

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

        //---------------------------------------------------------

        $bloque1 = <<<EOF

        <table>
        <thead>
    
            <tr>
                <th>
    
                </th>
                <th style="text-align:center;">
                    <span style=" font-size:18px"> <strong> $nombre_suc </strong></span>
                </th>
                <th>

                <span style="text-align:center; font-size:14px"> <strong> Nª $valorVenta</strong></span>

                </th>
            </tr>
    
        </thead>
        <tbody>
            <tr>
                <td>
                    <img src="https://scontent.fgdl3-1.fna.fbcdn.net/v/t1.0-9/59788286_1129363577266456_3306299832011849728_o.jpg?_nc_cat=101&_nc_sid=85a577&_nc_ohc=V1ywcp11sYwAX9nk_do&_nc_ht=scontent.fgdl3-1.fna&oh=0baed69d3ca48be6924b01d806de9750&oe=5E965DD5" width="120" />
                </td>
                <td style="font-size:8px;text-align:center;">
                <br>
                <br>
                $direccion <br>
                $web <br>
                $telefono_suc
                
                </td>
                <td>
                    <tcpdf style="width:$impresion px; text-align:center;" method="write1DBarcode" params="$bardcode" />
                    $fecha
                </td>
    
            </tr>

            <tr>
                <td style="" >
                   <strong>Cliente:</strong><br>

                   <strong>Nombre:</strong> <span style="font-size:8px;"> $cliente </span> <br>
                   <strong>Teléfono:</strong> <span style="font-size:8px;"> $cliente </span> <br>
                   <strong>Correo:</strong> <span style="font-size:8px;"> $cliente </span> <br>
                   <strong>WhatsApp:</strong> <span style="font-size:8px;"> $cliente </span> <br>

                   <strong>Equipo:</strong><br>

                   <strong>Marca:</strong> <span style="font-size:8px;"> $marca </span> <br>
                   <strong>Modelo:</strong> <span style="font-size:8px;"> $modelo </span> <br>
                   <strong>Estado Fisico:</strong> <span style="font-size:8px;"> $estado_fisico </span> <br>







                </td>
                <td>
                
                <strong>Atendio / Técnico:</strong><br>

                <strong>Nombre:</strong> <span style="font-size:8px;"> $usuario </span> <br>


                <strong>Serie / IMEI :</strong> <span style="font-size:8px;"> $imei </span> <br>
                <strong>Estetica:</strong> <span style="font-size:8px;"> $estetica </span> <br>
                <strong>Observaciones:</strong> <span style="font-size:8px;"> $observacion </span> <br>

                
                </td>
                <td>
                <strong>Patron / PIN desbloqueo:</strong>
                <br>
                <center>
                <img src="https://1.bp.blogspot.com/_8pbaW8STJyM/R0TJ8EEyZ6I/AAAAAAAAADU/jponpWl5vg4/w1200-h630-p-k-no-nu/9+PUNTOS.JPG" style="width:100px;">
                <strong>PIN:</strong> <span style="font-size:8px;"> $pin </span> <br>
                
                </center>

                </td>
    
            </tr>
            <tr>
                <td>
                <strong>Problema:</strong><br>
                <span style="font-size:8px;"> $problema </span> <br>
                
                </td>
                <td>
                <strong>Solución:</strong><br>
                <span style="font-size:8px;"> $solucion </span> <br>
                
                </td>
                <td>
                <strong>Total:</strong><br>
                <span style="font-size:8px;"> $importe </span> <br>
                <strong>Anticipo:</strong><br>
                <span style="font-size:8px;"> $anticipo </span> <br>
                <strong>Resta:</strong><br>
                <span style="font-size:8px;"> $adeudo </span> <br>
                
                </td>
            </tr>
    
        </tbody>
    </table>
<div>



</div>




EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, '');
        // $pdf->writeHTML($bloque1, false, false, false, false, '');

        $pdf->AddPage();



        // ---------------------------------------------------------
        //SALIDA DEL ARCHIVO 

        //$pdf->Output('factura.pdf', 'D');
        $pdf->Output('t-carta' . $valorVenta . 'factura.pdf');
    }
}

$factura = new imprimirFactura();
$factura->orden = $_GET["codigo"];
$factura->traerImpresionFactura();

?>

