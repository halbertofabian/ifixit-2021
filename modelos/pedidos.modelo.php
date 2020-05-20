<?php

require_once "conexion.php";

class ModeloPedidos
{



	static public function mdlRegistrarPedido($datos)
	{
		$sql = "INSERT INTO pedidos(pedido,nombre,contacto,fecha_pedido,equipo,marca,modelo,encargo,importe,anticipo,total,usuario_recibio) VALUES (:pedido,:nombre,:contacto,:fecha_pedido,:equipo,:marca,:modelo,:encargo,:importe,:anticipo,:total,:usuario_recibio)";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":pedido", $datos["pedido"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

		$stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_pedido", $datos["fecha_pedido"], PDO::PARAM_STR);
		$stmt->bindParam(":equipo", $datos["equipo"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);

		$stmt->bindParam(":encargo", $datos["encargo"], PDO::PARAM_STR);

		$stmt->bindParam(":importe", $datos["importe"]);
		$stmt->bindParam(":anticipo", $datos["anticipo"]);
		$stmt->bindParam(":total", $datos["total"]);

		$stmt->bindParam(":usuario_recibio", $datos["usuario_recibio"], PDO::PARAM_STR);


		return $stmt->execute();



		
		$stmt = null;
	}

	static public function mdlModificarPedido($datos)
	{
		$sql = "UPDATE  pedidos SET nombre = ?, contacto = ?, fecha_pedido = ?,
		equipo = ?, marca = ?, modelo = ?, encargo = ?, importe=?, total = ?, usuario_entrego = ?
		 WHERE pedido = ? ";
		$stmt = Conexion::conectar()->prepare($sql);


		$stmt->bindValue(1, $datos["nombre"], PDO::PARAM_STR);

		$stmt->bindValue(2, $datos["contacto"], PDO::PARAM_STR);
		$stmt->bindValue(3, $datos["fecha_pedido"], PDO::PARAM_STR);
		$stmt->bindValue(4, $datos["equipo"], PDO::PARAM_STR);
		$stmt->bindValue(5, $datos["marca"], PDO::PARAM_STR);
		$stmt->bindValue(6, $datos["modelo"], PDO::PARAM_STR);

		$stmt->bindValue(7, $datos["encargo"], PDO::PARAM_STR);

		$stmt->bindValue(8, $datos["importe"]);

		$stmt->bindValue(9, $datos["total"]);

		$stmt->bindValue(10, $datos["usuario_entrego"], PDO::PARAM_STR);
		$stmt->bindValue(11, $datos["pedido"], PDO::PARAM_STR);

		$stmt->execute();

		return $stmt -> rowCount()>0;

		
		$stmt = null;
	}

	public static function mdlObtenerId()
	{

		$stmt = Conexion::conectar()->prepare("SELECT pedido FROM pedidos WHERE pedido = (SELECT MAX(pedido) FROM pedidos)");

		$stmt->execute();

		return $stmt->fetch();





		$stmt = null;
	}
	public static function mdlMostrarPedidos()
	{

		$stmt =  Conexion::conectar()->prepare("SELECT * FROM pedidos WHERE estado_borrado = 1 ORDER BY pedido DESC");

		$stmt->execute();

		return $stmt->fetchAll();





		$stmt = null;
	}
	public static function mdlMostrarPedidosPorFiltro($filtro)
	{

		$stmt =  Conexion::conectar()->prepare("SELECT * FROM pedidos WHERE estado = :filtro AND estado_borrado = 1 ORDER BY pedido DESC");
		$stmt->bindParam(":filtro", $filtro, PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll();





		$stmt = null;
	}
	static public function detallePedido($pedido)
	{


		if ($pedido == 0) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedidos WHERE pedido = (SELECT MAX(pedido) FROM pedidos)");

			$stmt->execute();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedidos where pedido = :pedido");
			$stmt->bindParam(":pedido", $pedido, PDO::PARAM_STR);
			$stmt->execute();
		}
		return $stmt->fetch();





		$stmt = null;
	}

	// Suma de total de anticipos
	static public function mdlSumaTotalPedidosAnticipo()
	{

		$stmt = Conexion::conectar()->prepare("SELECT SUM(s.anticipo) AS total FROM pedidos s WHERE s.estado != 'Entregado' AND s.estado !='Sin existencia' AND estado_corte = 0");

		$stmt->execute();

		return $stmt->fetch();



		$stmt = null;
	}

	// Suma de total  Adeudo
	static public function mdlSumaTotalPendienteAdeudo()
	{

		$stmt = Conexion::conectar()->prepare("SELECT SUM(s.importe) AS adeudo FROM pedidos s WHERE s.estado = 'Entregado' AND s.estado_corte = 0");

		$stmt->execute();

		return $stmt->fetch();



		$stmt = null;
	}

	//Borrado del servcio
	static public function MdlBorrarPedido($datos)
	{

		if ($datos['b'] == "bl") {
			$stmt = Conexion::conectar()->prepare("UPDATE pedidos SET importe = 0, anticipo = 0,total =0, estado_borrado = 0 WHERE pedido = :pedido");
		} elseif ($datos['b'] == "bf") {

			$stmt = Conexion::conectar()->prepare("DELETE FROM pedidos WHERE pedido = :pedido");
		}

		$stmt->bindParam(":pedido", $datos['pedido'], PDO::PARAM_STR);

		return $stmt->execute();







		$stmt = null;
	}

	public static function mdlCambiarEstado($datos)
	{



		$stmt = Conexion::conectar()->prepare("UPDATE pedidos SET estado = :estado WHERE pedido = :pedido");

		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":pedido", $datos["idPedido"], PDO::PARAM_STR);
		return $stmt->execute();
		//print_r($stmt->errorInfo());
		//var_dump($datos);

		$stmt = null;
	}
	// Suma de total  Adeudo
	static public function mdlPedidoList()
	{

		$stmt = Conexion::conectar()->prepare("SELECT importe,anticipo,total,estado,estado_corte FROM pedidos");

		$stmt->execute();

		return $stmt->fetchAll();



		$stmt = null;
	}
}
