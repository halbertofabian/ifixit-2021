<?php
require_once "conexion.php";
class  ModeloGastos
{
    public static function mdlAgrearGastos($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO gastos (fecha_gasto,cantidad,concepto,usuario) 
            VALUES (:fecha_gasto,:cantidad,:concepto,:usuario)");

        $stmt->bindParam(":fecha_gasto", $datos['fecha_gasto'], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos['gasto'], PDO::PARAM_INT);
        $stmt->bindParam(":concepto", $datos['concepto'], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos['usuario'], PDO::PARAM_STR);

        return $stmt->execute();

        
        $stmt = null;
    }

    public static function mdlMostrarGastos()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos ");

        $stmt->execute();

        return $stmt->fetchAll();

        
        $stmt = null;

    }
     public static function mdlBorrarGasto($id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM gastos WHERE id = :id");

		$stmt->bindParam(":id", $id);
		
		
		return $stmt->execute();

		
		$stmt = null;

    }
    static public function mdlTotalGastos(){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidad) as totalgastos FROM gastos WHERE estado_corte = 0");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
}
