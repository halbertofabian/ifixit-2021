<?php

require_once "conexion.php";

class ModeloPresupuestos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function MdlMostrarPresupuestos(){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM presupuestos ORDER BY presupuesto DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

	

		$stmt -> close();

		$stmt = null;

	}
	static public function mdlDetallePresupuesto($presupuesto){

		
			if($presupuesto==0){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM presupuestos WHERE presupuesto = (SELECT MAX(presupuesto) FROM presupuestos)");
					
					$stmt -> execute();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM presupuestos where presupuesto = :presupuesto");
				$stmt->bindParam(":presupuesto",$presupuesto,PDO::PARAM_STR);
				$stmt -> execute();
			}
			return $stmt -> fetch();

	

		$stmt -> close();

		$stmt = null;

	}
	

	static public function presupuesto(){

		

			$stmt = Conexion::conectar()->prepare("SELECT presupuesto FROM presupuestos WHERE presupuesto = (SELECT MAX(presupuesto) FROM presupuestos)");

			$stmt -> execute();

			return $stmt -> fetch();

	

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarPresupuesto($datos){
		$sql = "INSERT INTO presupuestos(presupuesto,nombre,contacto,fecha_cotizacion, equipo,marca,modelo,color,observaciones,estado_fisico,diagnostico,desbloqueo,estetica,costo_estimado,usuario_recibio,imei) VALUES (:presupuesto,:nombre,:contacto,:fecha_cotizacion,:equipo,:marca,:modelo,:color,:observaciones,:estado_fisico,:diagnostico,:desbloqueo,:estetica,:costo_estimado,:usuario_recibio,:imei)";
		$stmt = Conexion::conectar()->prepare($sql);
		
		$stmt->bindParam(":presupuesto", $datos["presupuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		
		$stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_cotizacion", $datos["fecha_cotizacion"], PDO::PARAM_STR);
		$stmt->bindParam(":equipo", $datos["equipo"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_fisico", $datos["estado_fisico"], PDO::PARAM_STR);
		$stmt->bindParam(":diagnostico", $datos["diagnostico"], PDO::PARAM_STR);
	
		$stmt->bindParam(":desbloqueo", $datos["desbloqueo"], PDO::PARAM_STR);

		$stmt->bindParam(":estetica", $datos["estetica"], PDO::PARAM_STR);
		
		$stmt->bindParam(":costo_estimado", $datos["costo_estimado"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario_recibio", $datos["usuario_recibio"], PDO::PARAM_STR);
		$stmt->bindParam(":imei", $datos["imei"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, descripcion = :descripcion, imagen = :imagen, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta WHERE codigo = :codigo");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlCambiarEstado($estado,$usuario,$orden){
	
	if($estado=="Entregado"){
		$stmt = Conexion::conectar()->prepare("UPDATE servicios SET fecha_entrega = NOW() , estado_equipo = :estado_equipo, usuario_entrego =:usuario_entrego WHERE  orden = :orden");
	}else{
		$stmt = Conexion::conectar()->prepare("UPDATE servicios SET estado_equipo = :estado_equipo, usuario_entrego =:usuario_entrego WHERE  orden = :orden");
	}
		

		$stmt -> bindParam(":estado_equipo", $estado, PDO::PARAM_STR);
		$stmt -> bindParam(":usuario_entrego", $usuario, PDO::PARAM_STR);
		$stmt -> bindParam(":orden", $orden, PDO::PARAM_STR);
		
		/*if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}*/
		return $stmt -> execute()>0;

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}
	static public function mdlSumaTotalVentasServicioAnticipo(){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(s.anticipo) AS total FROM servicios s WHERE s.estado_equipo != 'Entregado' WHERE estado_corte = 0 ");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
	static public function mdlSumaTotalVentasServicioAdeudo(){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(s.importe) AS adeudo FROM servicios s WHERE s.estado_equipo = 'Entregado' WHERE estado_corte = 0 ");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
	static public function mdlSumaTotalPendientes(){	

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(estado_equipo) AS total FROM servicios where estado_equipo != 'Reparado' AND estado_equipo != 'Entregado' ");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	public static function MdlBorrarCotizacion($datos){


		$stmt = Conexion::conectar()->prepare("DELETE FROM presupuestos WHERE presupuesto = :presupuesto");
	

		$stmt -> bindParam(":presupuesto",$datos['presupuesto'],PDO::PARAM_STR);	

		return $stmt -> execute();

			

	

		$stmt -> close();

		$stmt = null;

	}
	//SELECT COUNT(estado_equipo) AS total FROM servicios where estado_equipo != 'Reparado' || estado_equipo != 'Entregado'


}