<?php
require_once "conexion-traspaso.php";
class  ModeloTraspasos
{
    public static function issetItem($db_info, $table, $item, $value)
    {
        $stmt = ConexionTraspaso::conectar(
            $db_info['db_name'],
            $db_info['user_name'],
            $db_info['password_db']
        )->prepare("SELECT *  FROM $table WHERE $item = :val ");
        $stmt->bindParam(":val", $value, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        

        $stmt = null;
    }

    public static function updateProductoTraspaso($db_info, $producto)
    {
        $stmt = ConexionTraspaso::conectar(
            $db_info['db_name'],
            $db_info['user_name'],
            $db_info['password_db']
        )->prepare("UPDATE productos SET 
        stock = :stock , precio_compra = :precio_compra 
        , precio_venta = :precio_venta WHERE codigo = :codigo ");

        $stmt->bindParam(":stock", $producto['stock'], PDO::PARAM_STR);
        $stmt->bindParam(":precio_compra", $producto['precio_compra'], PDO::PARAM_STR);
        $stmt->bindParam(":precio_venta", $producto['precio_venta'], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $producto['codigo'], PDO::PARAM_STR);
    
       return  $stmt->execute();

       //$stmt->execute();
       
       print_r($stmt->errorInfo());

        

        $stmt = null;
    }
    // Agrear producto

    static public function mdlIngresarProducto($db_info,$tabla, $datos){

		$stmt = ConexionTraspaso::conectar(
            $db_info['db_name'],
            $db_info['user_name'],
            $db_info['password_db'])->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta,precio_mayoreo) VALUES (:id_categoria, :codigo, :descripcion, :imagen, :stock, :precio_compra, :precio_venta,:precio_mayoreo)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_mayoreo", $datos["precio_mayoreo"], PDO::PARAM_STR);
        

        $stmt -> execute();

        return $stmt -> rowCount()>0;
		// if($stmt->execute()){

		// 	return "ok";

		// }else{

		// 	return "error";
		
		// }

		
		$stmt = null;

    }
    
    static public function mdlIngresarCategoria($db_info,$datos){

		$stmt = Conexion::conectar(
            $db_info['db_name'],
            $db_info['user_name'],
            $db_info['password_db'])->prepare("INSERT INTO categorias(categoria) VALUES (:categoria)");

		$stmt->bindParam(":categoria", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}
}
