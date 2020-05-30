<?php
require_once "conexion.php";
class  ModeloMovimientos
{
	public static function mdlRegistrarMovimientos($datos, $corte)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO movimientos (tipo,numero_movimiento,concepto,monto,cliente,fecha,usuario,extra,corte) 
            VALUES (:tipo,:numero_movimiento,:concepto,:monto,:cliente,:fecha,:usuario,:extra,:corte)");

		$stmt->bindParam(":tipo", $datos['tipo'], PDO::PARAM_STR);
		$stmt->bindParam(":numero_movimiento", $datos['numero_movimiento'], PDO::PARAM_STR);
		$stmt->bindParam(":concepto", $datos['concepto'], PDO::PARAM_STR);
		$stmt->bindParam(":monto", $datos['monto']);
		$stmt->bindParam(":cliente", $datos['cliente'], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos['usuario'], PDO::PARAM_STR);
		$stmt->bindParam(":extra", $datos['extra'], PDO::PARAM_STR);
		$stmt->bindParam(":corte", $corte);

		$stmt->execute();
		return $stmt->rowCount() > 0;
		//return print_r($stmt->errorInfo());

		$stmt = null;
	}
	/*=============================================
	RANGO FECHAS
	=============================================*/

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal)
	{

		if ($fechaInicial == null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo != 'GASTO' ORDER BY id ASC");

			$stmt->execute();

			return $stmt->fetchAll();
		} else if ($fechaInicial == $fechaFinal) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo != 'GASTO' AND  fecha like '%$fechaFinal%'");

			$stmt->bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo != 'GASTO' AND fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
			} else {


				$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo != 'GASTO' AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
			}

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}
	static public function mdlRangoFechasGastos($tabla, $fechaInicial, $fechaFinal)
	{

		if ($fechaInicial == null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo = 'GASTO' ORDER BY id ASC");

			$stmt->execute();

			return $stmt->fetchAll();
		} else if ($fechaInicial == $fechaFinal) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo = 'GASTO' AND  fecha like '%$fechaFinal%'");

			//$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo = 'GASTO' AND fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
			} else {


				$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo = 'GASTO' AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
			}

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}

	static public function mdlRangoFechasTipo($tabla, $fechaInicial, $fechaFinal, $tipo, $corte)
	{

		if ($fechaInicial == null && $corte == null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo = :tipo ORDER BY id ASC");
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetchAll();
		} elseif ($corte != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo = :tipo AND corte = :corte ORDER BY id ASC");
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
			$stmt->bindParam(":corte", $corte, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetchAll();
		} else if ($fechaInicial == $fechaFinal) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo = :tipo AND  fecha like '%$fechaFinal%'");

			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
			//$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt->execute();
			//return print_r($stmt->errorInfo());
			return $stmt->fetchAll();
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo = :tipo AND fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
			} else {


				$stmt = Conexion::conectar()->prepare("SELECT * FROM movimientos WHERE tipo = :tipo AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
			}
			$stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetchAll();
		}
	}

	// Borrar movimiento de servicio 
	public static function mdlDeteteMovimientoServicio($movimiento)
	{
		$sql = "DELETE FROM movimientos WHERE numero_movimiento = ? AND tipo = 'SERVICIO' OR  concepto = 'DEVOLUCIÓN DE SERVICIO' ";

		try {
			$pps = Conexion::conectar()->prepare($sql);

			$pps->bindValue(1, $movimiento);

			$pps->execute();

			return $pps->rowCount() > 0;
		} catch (PDOException $th) {
			//throw $th;
		}
	}
	// Borrar movimientos pedidos

	public static function mdlDeteteMovimientoPedido($movimiento)
	{
		$sql = "DELETE FROM movimientos WHERE numero_movimiento = ? AND tipo = 'PEDIDO' OR  concepto = 'DEVOLUCIÓN DE PEDIDO' ";

		try {
			$pps = Conexion::conectar()->prepare($sql);

			$pps->bindValue(1, $movimiento);

			$pps->execute();

			return $pps->rowCount() > 0;
		} catch (PDOException $th) {
			//throw $th;
		}
	}


	// Consultar movimiento de servicio 
	public static function mdlOnetnerOrdenServicio($orden)
	{
		try {
			$sql = "SELECT * FROM movimientos WHERE numero_movimiento = ? AND tipo = 'SERVICIO' ";

			$con = Conexion::conectar();
			$pps = $con->prepare($sql);
			$pps->bindValue(1, $orden);
			$pps->execute();
			return $pps->fetchAll();
		} catch (\Throwable $th) {
			//throw $th;
			return false;
		} finally {
			$pps = null;
			$con = null;
		}
	}


	public static function mdlAbonarServicio($datos)
	{
		try {
			$sql = "UPDATE servicios SET
			 anticipo = ? ,total = ?,fecha_entrega = ?,
			 estado_equipo = ?,usuario_entrego = ? WHERE orden = ?
			 ";
			$con = Conexion::conectar();
			$pps = $con->prepare($sql);
			$pps->bindValue(1, $datos['anticipo']);
			$pps->bindValue(2, $datos['total']);
			$pps->bindValue(3, $datos['fecha_entrega']);
			$pps->bindValue(4, $datos['estado_equipo']);
			$pps->bindValue(5, $datos['usuario_entrego']);
			$pps->bindValue(6, $datos['orden']);
			$pps->execute();
			return $pps->rowCount() > 0;
		} catch (\Throwable $th) {
			//throw $th;
			return false;
		} finally {
			$pps = null;
			$con = null;
		}
	}

	public static function mdlEliminarMovimientoId($id)
	{
		try {
			$sql = "DELETE FROM movimientos WHERE id = ?";
			$con = Conexion::conectar();
			$pps = $con->prepare($sql);
			$pps->bindValue(1, $id);
			$pps->execute();
			return $pps->rowCount() > 0;
		} catch (\Throwable $th) {
			//throw $th;
			return false;
		} finally {
			$pps = null;
			$con = null;
		}
	}
}
