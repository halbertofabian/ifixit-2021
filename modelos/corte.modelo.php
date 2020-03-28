<?php

require_once "conexion.php";

class ModeloCorte{

	static public function mdlCargarCorte($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO corte 
		(servicios,pedidos,ventas,ingresos,gastos,cantidad,sobrante,faltante,usuario,fecha_corte) 
		VALUES (:servicios,:pedidos,:ventas,:ingresos,:gastos,:cantidad,:sobrante,:faltante,:usuario,:fecha_corte)");
		$stmt->bindParam(":servicios", $datos['servicios']);
		$stmt->bindParam(":pedidos", $datos['pedidos']);
		$stmt->bindParam(":ventas", $datos['ventas']);
		$stmt->bindParam(":ingresos", $datos['ingresos']);
		$stmt->bindParam(":gastos", $datos['gastos']);

		$stmt->bindParam(":cantidad", $datos['cantidad']);
		$stmt->bindParam(":sobrante", $datos['sobrante']);
		$stmt->bindParam(":faltante", $datos['faltante']);
		$stmt->bindParam(":usuario", $datos['usuario']);
		$stmt->bindParam(":fecha_corte", $datos['fecha_corte']);
		
		
		return $stmt->execute();

		$stmt->close();
		$stmt = null;

	}

	static public function mdlBorrarCorte($id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM corte WHERE id = :id");

		$stmt->bindParam(":id", $id);
		
		
		return $stmt->execute();

		$stmt->close();
		$stmt = null;

	}
	static public function mdlCambiarEstado(){

		$stmt = Conexion::conectar()->prepare("UPDATE servicios SET estado_corte = 1");
		$stmt->execute();
		
		$stmt = null;
		
		$stmt = Conexion::conectar()->prepare("UPDATE gastos SET estado_corte = 1");
		$stmt->execute();
		
		$stmt = null;

		$stmt = Conexion::conectar()->prepare("UPDATE ingresos SET estado_corte = 1");
		$stmt->execute();
		
		$stmt = null;

		$stmt = Conexion::conectar()->prepare("UPDATE ventas SET estado_corte = 1");
		$stmt->execute();

		
		$stmt = null;

		$stmt = Conexion::conectar()->prepare("UPDATE pedidos SET estado_corte = 1");
		$stmt->execute();

		
		$stmt = null;


	}
	static public function cambiarEstadoTabla($table,$valor,$item,$id){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $table SET estado_corte = :valor WHERE $item = :item");
		$stmt -> bindParam(":valor",$valor);
		$stmt -> bindParam(":item",$id);
		
		$stmt->execute();
		
		$stmt = null;
	}
	static public function mdlMostrarCorte($codigo){

		if($codigo == 0){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM corte WHERE id = (SELECT MAX(id) FROM corte)");
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM corte WHERE id = :id ");
			$stmt -> bindParam(":id",$codigo,PDO::PARAM_STR);
		}

		
		$stmt->execute();
		return $stmt -> fetch();

		

		$stmt = null;


	}
	static public function mdlMostrarTodosCortes(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM corte");
		$stmt->execute();
		return $stmt -> fetchAll();

		

		$stmt = null;


	}

	static public function mdlServicioEntregado(){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(importe) AS importe FROM servicios WHERE estado_equipo = 'Entregado' AND estado_corte = 0");

			$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}
	static public function mdlServicioPendiente(){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(anticipo) AS anticipo FROM servicios WHERE estado_equipo != 'Entregado' AND estado_corte = 0 ");

			$stmt -> execute();

			return $stmt -> fetch();

	

		

		$stmt = null;
	}
	static public function mdlVentas(){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as ventas FROM ventas WHERE estado_corte = 0");

			$stmt -> execute();

			return $stmt -> fetch();

	

		

		$stmt = null;
	}

	// Suma de total  Adeudo
	static public function mdlPeidosPendiente(){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(s.importe) AS adeudo FROM pedidos s WHERE s.estado = 'Entregado' AND s.estado_corte = 0");

		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}
	static public function mdlPedidosAnticipo(){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(s.anticipo) AS total FROM pedidos s WHERE s.estado != 'Entregado' AND s.estado !='Sin existencia' AND estado_corte = 0");

		$stmt -> execute();

		return $stmt -> fetch();

		

		$stmt = null;

	}

	// Suma de total  Adeudo
	static public function mdlPedidoList(){	

		$stmt = Conexion::conectar()->prepare("SELECT importe,anticipo,total,estado,estado_corte FROM pedidos");

		$stmt -> execute();

		return $stmt -> fetchAll();

		

		$stmt = null;

	}

	// Suma de total  Adeudo
	static public function mdlServicioList(){	

		$stmt = Conexion::conectar()->prepare("SELECT importe,anticipo,total,estado_equipo,estado_corte FROM servicios");

		$stmt -> execute();

		return $stmt -> fetchAll();

		

		$stmt = null;

	}



}