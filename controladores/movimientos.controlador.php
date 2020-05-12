<?php
class ControladorMovimientos
{
  public static function ctrRegistrarMovimiento($datos)
  {
    $corte = ModeloCorte::mdlMostrarCorte(0);
    $ultimo = (int) $corte['id'];
    $ultimo++;


    return $movimiento = ModeloMovimientos::mdlRegistrarMovimientos($datos, $ultimo);
  }
  static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal)
  {

    $tabla = "movimientos";

    $respuesta = ModeloMovimientos::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

    return $respuesta;
  }
  static public function ctrRangoFechasGastos($fechaInicial, $fechaFinal)
  {

    $tabla = "movimientos";

    $respuesta = ModeloMovimientos::mdlRangoFechasGastos($tabla, $fechaInicial, $fechaFinal);

    return $respuesta;
  }

  static public function ctrRangoFechasTipo($fechaInicial, $fechaFinal, $tipo, $corte)
  {

    $tabla = "movimientos";

    $respuesta = ModeloMovimientos::mdlRangoFechasTipo($tabla, $fechaInicial, $fechaFinal, $tipo, $corte);

    return $respuesta;
  }

  public static function ctrEliminarAbono()
  {
    if ($_POST['btnEliminarAbono']) {

      $detalle = ModeloServicios::ctrDetalleServicio($_POST['orden']);

      if ($detalle['estado_equipo'] == "Entregado" || $detalle['estado_equipo'] == "Entregado no quedo") {
        return array("status" => false, "mensaje" => 'Este equipo ya fue entregado, por seguridad no puedes eliminar abonos');
      }

      $importe = $detalle['importe'];
      $anticipo = $detalle['anticipo'];
      // $adeudo = $detalle['total'];

      $eliminarAbono = ModeloMovimientos::mdlEliminarMovimientoId($_POST['id_movimiento']);

      if ($eliminarAbono) {

        $_POST['anticipo'] = str_replace(',', '', $anticipo - $_POST['monto']);

        $_POST['total'] = str_replace(',', '', $importe + $_POST['anticipo']);

        $_POST['usuario_entrego'] = $_SESSION["nombre"];
        $_POST['estado_equipo'] = $detalle['estado_equipo'];
        $_POST['fecha_entrega'] = $detalle['fecha_entrega'];

        $status  =  ModeloMovimientos::mdlAbonarServicio($_POST);

        if ($status) {
          return array("status" => true, "mensaje" => 'Abono eliminado con éxtito');
        } else {
          return array("status" => false, "mensaje" => 'Error no esperado, reporté con el administrador');
        }
      } else {
        return array("status" => false, "mensaje" => 'Se produjo un error, intente de nuevo');
      }
    }
  }
  public static function ctrAbonarServicio()
  {
    if (isset($_POST['btnAbonarServicio'])) {

      date_default_timezone_set($_SESSION["zona"]);

      $fecha = date('Y-m-d');


      $hora = date('H:i:s');

      $valor1b = $fecha . ' ' . $hora;


      $detalle = ModeloServicios::ctrDetalleServicio($_POST['orden']);

      $importe = $detalle['importe'];
      $anticipo = $detalle['anticipo'];
      $adeudo = $detalle['total'];

      if ($_POST['abono'] <= 0) {
        return array('status' => false, 'mensaje' => 'El abono no puede ser menor igual a 0, intente con otra cantidad');
        echo  '<script>     
                toastr.error("El abono no puede ser menor igual a 0, intente con otra cantidad", "Error")
            </script>';
      }
      if ($_POST['abono'] > $adeudo) {
        return array('status' => false, 'mensaje' => 'El abono supera la cantidad del adeudo, intente con otra cantidad');
        echo '<script>     
                toastr.error("El abono supera la cantidad del adeudo, intente con otra cantidad", "Error")
            </script>';;
      }

      $_POST['anticipo'] = str_replace(',', '', $anticipo + $_POST['abono']);

      $_POST['total'] = str_replace(',', '', $importe - $_POST['anticipo']);

      $concepto = "ABONO";

      if ($_POST['estado_equipo'] == "Entregado") {

        $_POST['fecha_entrega'] = $valor1b;
        $concepto = "LIQUIDADO";
      } else {
        $_POST['estado_equipo'] = $detalle['estado_equipo'];
        $_POST['fecha_entrega'] = $detalle['fecha_entrega'];
      }

      $_POST['usuario_entrego'] = $_SESSION["nombre"];

      // Guardar 

      $mov = array(

        'tipo' => 'SERVICIO',
        'numero_movimiento' => $_POST['orden'],
        'concepto' => $concepto,
        'monto' => str_replace(',', '', $_POST['abono']),
        'cliente' => $detalle['nombre'],
        'fecha' => $valor1b,
        'usuario' => $_SESSION["nombre"],
        'extra' => ''


      );

      $movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);

      if ($movimiento) {
        $status  =  ModeloMovimientos::mdlAbonarServicio($_POST);
        if ($status) {
          return array('status' => $status, 'mensaje' => 'Abono registrado con éxito');
        } else {
          return array('status' => $status, 'mensaje' => 'Contactar a soporte, abono no registrado');
        }
      } else {
        return array('status' => $status, 'mensaje' => 'Hubo un problema, intenta de nuevo.');
      }
    }
  }
}
