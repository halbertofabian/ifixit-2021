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

        // $logo = isset($_SESSION['ruta_logo']) && $_SESSION['ruta_logo']!="" ? '<img src="../../../'.$_SESSION['ruta_logo'].'"  width="100px"/>' : $nombre_suc;
        $logo = $sucursal['ruta_logo'] == "" ? '<strong style="font-size:18px">' . $nombre_suc . '</strong>' : '<img src="../../../' . $sucursal['ruta_logo'] . '"  width="70px"/>';

        //$ruta = !isset($_SESSION['ruta_logo']) || $_SESSION['ruta_logo']==""  ? $nombre_suc : ""; ;
        //echo $_SESSION['ruta_logo'];


       
        //echo $contacto.'<br>';
        $array = array();
        $array = explode("/", $contacto);
        //echo $array[0].'<br>';
        $wp =  $array[1];
        $array = explode(" ", $array[0]);
        $tel  = $array[0] . $array[1];
        $correo = $array[2];




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

    <table style="font-size:9px;">
        <thead>
            <tr>
                <td style="text-align:left;width:20%">
                    $logo
                </td>
                <td style="text-align:center;width:50%">
                    <p>$direccion </p>
                    <p>$telefono_suc</p>
                    <p>$web</p>

                </td>
                <td style="text-align:right;width:30%">
                <tcpdf style="width:50px; text-align:center;" method="write1DBarcode" params="$bardcode" />
                </td>
            </tr>
        </thead>
        
    </table>
   
    <table style="font-size:9px;border: 1px solid #000; padding-bottom:4px">
    <thead>
        
        
        <tr>
            <td style="text-align:left;width:33.3%;">
                <p>
                <strong>Nombre del cliente</strong><br>
                    $cliente
                </p>
            </td>
            <td style="text-align:center;width:33.3%">
                <p>
                <strong>Contacto</strong><br>
                    $tel <br>
                    $correo <br>
                    $wp
                </p>
            </td>    
            <td style="text-align:center;width:33.3%">
                <p>
                <strong>Fecha recepción</strong><br>
                    $fecha <br>
                    <strong>Le atendio</strong> <br>
                    $usuario
                </p>
            </td>
        </tr>
    </thead>
    
    </table>
    <table style="font-size:9px;border: 1px solid #000; padding-bottom:4px">
    <thead>
    <tr>
            <td style="text-align:center;">
                <strong>Datos del equipo</strong>
            </td>
        </tr>
        
        <tr>
            <td style="text-align:left;width:33.3%;">
                <p>
                <strong>Marca</strong><br>
                    $marca
                </p>
                <p>
                <strong>Problema</strong><br>
                    $problema
                </p>
                <p>
                <strong>Estetica</strong><br>
                    $estetica
                </p>
                <p style="text-align:center">
                <strong>Patron</strong><br>
                    <img src="../../../vistas/img/logo_suc/patron.jpg"  width="100px"/>
                </p>
                
            </td>
            <td style="text-align:center;width:33.3%">
                <p>
                <strong>Modelo</strong><br>
                    $modelo
                </p>
                <p>
                <strong>Solución</strong><br>
                    $solucion
                </p>
                <p>
                <strong>Estado fisico</strong><br>
                    $estado_fisico
                </p>
                <p>
                <strong>Total:</strong><br>
                </p>
                <p>
                <strong>Anticipo:</strong><br>
                </p>
                <p>
                <strong>Adeudo:</strong><br>
                </p>
            </td>    
            <td style="text-align:center;width:33.3%">
                <p>
                <strong>IMEI/SERIE</strong><br>
                    $imei
                </p>
                <p>
                <strong>Observaciones</strong><br>
                    $observacion
                </p>
                <p>
                <strong></strong><br>
                   
                </p>
                <p>
                   $ $importe
                </p>
                
                <p>
                  $  $anticipo
                </p>
                ---------------------------------
                <p>
                  $  $adeudo
                </p>
                <strong>$pagado</strong> 
            </td>
        </tr>
    </thead>
    
</table>
<table style="font-size:9px;padding-top:10px">
<thead>
    <tr>
        <td style="text-align:center;width:67.7.3%">
            
            <div style="text-align:center;"> <strong> Politicas </strong></div>
            <p align="justify" style="font-size:6.9px;" >
                $politicas
                <br>
                <br>
                <hr>
                <p align="center">Yo $cliente acepto las politicas de este establecimiento</p>
            </p>

            

        </td>
        <td style="text-align:center;width:33.3%">

            <strong> Firma de equipo entregado </strong><br><br>
            <hr>
        </td>
    </tr>
</thead>

</table>

<table style="font-size:9px;">
        <thead>
            <tr>
                <td style="text-align:center;width:100%">
                    Muchas gracias por su elección
                    <div style="font-size:8px;">
                        Consulta el estado de tu servicio en la siguiente url 
                        <br>
                        <strong>https://softmormx.com/consulta</strong>
                        <br>
                        Codigo: <strong>$codigo</strong>
                        <div style="font-size:7px;">
                            $nota
                        </div>

                    </div>
                </td>
            </tr>
        </thead>
        
    </table>
    

    



EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, '');
        // $pdf->writeHTML($bloque1, false, false, false, false, '');





        // ---------------------------------------------------------
        //SALIDA DEL ARCHIVO 

        //$pdf->Output('factura.pdf', 'D');
        $pdf->Output('t-carta' . $valorVenta . 'factura.pdf');
    }
}

$factura = new imprimirFactura();
$factura->orden = $_GET["codigo"];
$factura->traerImpresionFactura();
