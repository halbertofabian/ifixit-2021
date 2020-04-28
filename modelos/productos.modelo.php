<?php

require_once "conexion.php";

class ModeloProductos
{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor, $orden)
	{
		if ($item == "id_categoria" && $item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} elseif ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

			$stmt->execute();

			return $stmt->fetchAll();
		}



		$stmt = null;
	}
	static public function mdlMostrarProducto($valor)
	{



		$stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE codigo = :codigo ");

		$stmt->bindParam(":codigo", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();





		$stmt = null;
	}


	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta,precio_mayoreo) VALUES (:id_categoria, :codigo, :descripcion, :imagen, :stock, :precio_compra, :precio_venta,:precio_mayoreo)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_mayoreo", $datos["precio_mayoreo"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}


		$stmt = null;
	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, descripcion = :descripcion, imagen = :imagen, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta , precio_mayoreo = :precio_mayoreo WHERE codigo = :codigo");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_mayoreo", $datos["precio_mayoreo"], PDO::PARAM_STR);



		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}


		$stmt = null;
	}

	// Editar producto rapido 
	public static function mdlEditarProductoRapido($datos)
	{
		try {
			$sql = "UPDATE productos SET stock = ? , precio_compra = ? , precio_venta = ? , precio_mayoreo = ? WHERE codigo = ? ";

			$con = Conexion::conectar();
			$pps = $con->prepare($sql);
			$pps->bindValue(1, $datos['stockP']);
			$pps->bindValue(2, $datos['precioP']);
			$pps->bindValue(3, $datos['precioV']);
			$pps->bindValue(4, $datos['precioM']);
			$pps->bindValue(5, $datos['codigoP']);
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
	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}
	static public function mdlActualizarProductoStok($stock, $codigo)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE productos SET stock = :stock WHERE codigo = :codigo");

		$stmt->bindParam(":stock", $stock, PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);

		return $stmt->execute();



		$stmt = null;
	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function mdlMostrarSumaVentas($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt->execute();

		return $stmt->fetch();



		$stmt = null;
	}

	public static function mdlMostrarProductosInnerJoin()
	{
		$stmt = Conexion::conectar()->prepare("SELECT p.*,c.* FROM productos p JOIN categorias c on p.id_categoria = c.id");

		$stmt->execute();

		return $stmt->fetchAll();



		$stmt = null;
	}

	static public function mdlMostrarProductosBusqueda($consulta)
	{
		if ($consulta != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM productos  WHERE codigo LIKE '%" . $consulta . "%' OR descripcion LIKE '%" . $consulta . "%'  GROUP BY descripcion ASC  ");
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM productos ORDER BY descripcion ASC ");
		}
		$stmt->execute();
		return  $stmt->fetchAll();
		//print_r($stmt->errorInfo());

		$stmt = null;
	}
}
