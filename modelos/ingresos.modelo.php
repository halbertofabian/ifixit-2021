<?php
require_once "conexion.php";
class  ModeloIngresos
{
    public static function mdlAgrearIngresos($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO ingresos (fecha_ingreso,cantidad,concepto,usuario) 
            VALUES (:fecha_ingreso,:cantidad,:concepto,:usuario)");

        $stmt->bindParam(":fecha_ingreso", $datos['fecha_ingreso'], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos['ingreso'], PDO::PARAM_INT);
        $stmt->bindParam(":concepto", $datos['concepto'], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos['usuario'], PDO::PARAM_STR);

        return $stmt->execute();

        
        $stmt = null;
    }

    public static function mdlMostrarIngresos()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM ingresos");

        $stmt->execute();

        return $stmt->fetchAll();

        
        $stmt = null;

    }
     public static function mdlBorrarIngreso($id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM ingresos WHERE id = :id");

		$stmt->bindParam(":id", $id);
		
		
		return $stmt->execute();

		
		$stmt = null;

    }
    static public function mdlTotalingresos(){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidad) as totalingresos FROM ingresos WHERE estado_corte = 0");

		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}
}
