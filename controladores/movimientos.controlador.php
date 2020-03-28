<?php
class ControladorMovimientos
{
  public static function ctrRegistrarMovimiento($datos)
  {
    $corte = ModeloCorte::mdlMostrarCorte(0);
    $ultimo = (int)$corte['id'];
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

  static public function ctrRangoFechasTipo($fechaInicial, $fechaFinal,$tipo,$corte)
  {

    $tabla = "movimientos";

    $respuesta = ModeloMovimientos::mdlRangoFechasTipo($tabla, $fechaInicial, $fechaFinal,$tipo,$corte);

    return $respuesta;
  }

  
  
}
