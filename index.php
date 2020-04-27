<?php
ob_start();



include_once 'conf.php';

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/servicios.controlador.php";
require_once "controladores/corte.controlador.php";
require_once "controladores/presupuestos.controlador.php";
require_once "controladores/pedidos.controlador.php";
require_once "controladores/suscripcion.controlador.php";
require_once "controladores/sucursales.controlador.php";
require_once "controladores/gastos.controlador.php";
require_once "controladores/ingresos.controlador.php";
require_once "controladores/movimientos.controlador.php";
require_once "controladores/traspasos.controlador.php";
require_once "controladores/slide.controlador.php";
require_once "controladores/updateDB.controlador.php";



require_once "modelos/usuarios.modelo.php";
require_once "modelos/presupuestos.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/servicios.modelo.php";
require_once "modelos/corte.modelo.php";
require_once "modelos/pedidos.modelo.php";
require_once "modelos/suscripcion.modelo.php";
require_once "modelos/sucursales.modelo.php";
require_once "modelos/gastos.modelo.php";
require_once "modelos/ingresos.modelo.php";
require_once "modelos/movimientos.modelo.php";
require_once "modelos/traspasos.modelo.php";
require_once "modelos/slide.modelo.php";
require_once "modelos/updateDB.modelo.php";
require_once "modelos/configuracion.modelo.php";


//U@U+5FBb$$gZ
require_once "extensiones/vendor/autoload.php";


//Require Librerias
require_once 'lib/phpqrcode/qrlib.php';


require_once 'lib/phpMailer/Exception.php';
require_once 'lib/phpMailer/PHPMailer.php';
require_once 'lib/phpMailer/SMTP.php';

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
