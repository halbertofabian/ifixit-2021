<?php

require_once "conexion.php";

class ModeloServicios
{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function MdlMostrarServcios($tecnico = "")
	{

		if ($tecnico != "") {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM servicios WHERE estado_borrado = 1 AND tecnico = :tecnico ORDER BY orden DESC ");
			$stmt->bindParam(":tecnico", $tecnico, PDO::PARAM_STR);

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM servicios WHERE estado_borrado = 1 ORDER BY orden DESC ");
		}



		$stmt->execute();

		return $stmt->fetchAll();





		$stmt = null;
	}
	static public function MdlMostrarServciosPorFiltro($filtro, $tecnico = "")
	{

		if ($tecnico != "") {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM servicios WHERE estado_equipo = :filtro  AND tecnico = :tecnico  ORDER BY orden DESC ");
			$stmt->bindParam(":filtro", $filtro, PDO::PARAM_STR);
			$stmt->bindParam(":tecnico", $tecnico, PDO::PARAM_STR);

		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM servicios WHERE estado_equipo = :filtro   ORDER BY orden DESC ");
			$stmt->bindParam(":filtro", $filtro, PDO::PARAM_STR);
		}
		$stmt->execute();

		return $stmt->fetchAll();





		$stmt = null;
	}

	//Borrado del servcio
	static public function MdlBorrarServico($datos)
	{

		if ($datos['b'] == "bl") {
			$stmt = Conexion::conectar()->prepare("UPDATE servicios SET importe = 0, anticipo = 0,total =0, estado_borrado = 0 WHERE orden = :orden");
		} elseif ($datos['b'] == "bf") {

			$stmt = Conexion::conectar()->prepare("DELETE FROM servicios WHERE orden = :orden");
		}

		$stmt->bindParam(":orden", $datos['orden'], PDO::PARAM_STR);

		return $stmt->execute();







		$stmt = null;
	}
	static public function ctrDetalleServicio($orden)
	{


		if ($orden == 0) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM servicios WHERE orden = (SELECT MAX(orden) FROM servicios)");

			$stmt->execute();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM servicios where orden = :orden");
			$stmt->bindParam(":orden", $orden, PDO::PARAM_STR);
			$stmt->execute();
		}
		return $stmt->fetch();





		$stmt = null;
	}
	static public function mdlMostrarNota($orden)
	{



		$stmt = Conexion::conectar()->prepare("SELECT * FROM servicios WHERE  orden = :orden");

		$stmt->bindParam(":orden", $orden, PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetch();





		$stmt = null;
	}


	static public function orden()
	{



		$stmt = Conexion::conectar()->prepare("SELECT orden FROM servicios WHERE orden = (SELECT MAX(orden) FROM servicios)");

		$stmt->execute();

		return $stmt->fetch();





		$stmt = null;
	}

	/*=============================================
	REGISTRO DE SERVICIO
	=============================================*/
	static public function mdlIngresarServicio($datos)
	{
		$sql = "INSERT INTO servicios(orden,nombre,contacto,fecha_reparacion, equipo,marca,modelo,color,observaciones,estado_fisico,problema,solucion
		,desbloqueo,estetica,importe,anticipo,total,usuario_recibio,imei,codigo_cliente,fecha_prometida,tecnico) 
		VALUES (:orden,:nombre,:contacto,:fecha_reparacion,
		:equipo,:marca,:modelo,:color,:observaciones,
		:estado_fisico,:problema,:solucion,:desbloqueo,
		:estetica,:importe,:anticipo,:total,:usuario_recibio,
		:imei,:codigo_cliente,:fecha_prometida,:tecnico)";
		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":orden", $datos["orden"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

		$stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_reparacion", $datos["fecha_reparacion"], PDO::PARAM_STR);
		$stmt->bindParam(":equipo", $datos["equipo"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_fisico", $datos["estado_fisico"], PDO::PARAM_STR);
		$stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);
		$stmt->bindParam(":solucion", $datos["solucion"], PDO::PARAM_STR);
		$stmt->bindParam(":desbloqueo", $datos["desbloqueo"], PDO::PARAM_STR);

		$stmt->bindParam(":estetica", $datos["estetica"], PDO::PARAM_STR);
		$stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
		$stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario_recibio", $datos["usuario_recibio"], PDO::PARAM_STR);
		$stmt->bindParam(":imei", $datos["imei"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_cliente", $datos["codigo_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_prometida", $datos["fecha_prometida"], PDO::PARAM_STR);
		$stmt->bindParam(":tecnico", $datos["tecnico"], PDO::PARAM_STR);




		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}
		//print_r($stmt->errorInfo());


		$stmt = null;
	}

	/*======================
	MODIFICAR SERVICIO
	========================*/
	static public function mdlModificarServicio($datos)
	{
		$sql = "UPDATE servicios SET nombre = :nombre, contacto = :contacto,
		fecha_reparacion = :fecha_reparacion, equipo = :equipo,
		marca =:marca, modelo = :modelo, color = :color,
		observaciones = :observaciones, estado_fisico = :estado_fisico,
		problema = :problema, solucion = :solucion,
		desbloqueo = :desbloqueo, estetica = :estetica,
		importe = :importe, anticipo = :anticipo, anticipo = :anticipo,
		total = :total, estado_equipo = :estado_equipo,
		usuario_entrego = :usuario_entrego, estado_corte = :estado_corte , imei = :imei, 
		codigo_cliente = :codigo_cliente , fecha_prometida = :fecha_prometida , tecnico = :tecnico WHERE orden = :orden";
		$stmt = Conexion::conectar()->prepare($sql);


		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

		$stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_reparacion", $datos["fecha_reparacion"], PDO::PARAM_STR);
		$stmt->bindParam(":equipo", $datos["equipo"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_fisico", $datos["estado_fisico"], PDO::PARAM_STR);
		$stmt->bindParam(":problema", $datos["problema"], PDO::PARAM_STR);
		$stmt->bindParam(":solucion", $datos["solucion"], PDO::PARAM_STR);
		$stmt->bindParam(":desbloqueo", $datos["desbloqueo"], PDO::PARAM_STR);

		$stmt->bindParam(":estetica", $datos["estetica"], PDO::PARAM_STR);
		$stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_STR);
		$stmt->bindParam(":anticipo", $datos["anticipo"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_equipo", $datos["estado_equipo"], PDO::PARAM_STR);
		//$stmt->bindParam(":usuario_recibio", $datos["usuario_recibio"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario_entrego", $datos["usuario_entrega"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_corte", $datos["estado_corte"], PDO::PARAM_STR);
		$stmt->bindParam(":imei", $datos["imei"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_cliente", $datos["codigo_cliente"], PDO::PARAM_STR);

		$stmt->bindParam(":orden", $datos["orden"], PDO::PARAM_STR);

		$stmt->bindParam(":fecha_prometida", $datos["fecha_prometida"], PDO::PARAM_STR);
		$stmt->bindParam(":tecnico", $datos["tecnico"], PDO::PARAM_STR);

		//$stmt->execute();

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}
		//print_r($stmt->errorInfo());


		$stmt = null;
	}


	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, descripcion = :descripcion, imagen = :imagen, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta WHERE codigo = :codigo");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}


		$stmt = null;
	}

	static public function mdlCambiarEstado($estado, $usuario, $orden, $fecha_entrega)
	{

		if ($estado == "Entregado" || $estado == "Entregado no quedo") {
			$stmt = Conexion::conectar()->prepare("UPDATE servicios SET fecha_entrega = :fecha_entrega , estado_equipo = :estado_equipo, usuario_entrego =:usuario_entrego WHERE  orden = :orden");
			$stmt->bindParam(":fecha_entrega", $fecha_entrega);
		} else {
			$stmt = Conexion::conectar()->prepare("UPDATE servicios SET estado_equipo = :estado_equipo, usuario_entrego =:usuario_entrego WHERE  orden = :orden");
		}


		$stmt->bindParam(":estado_equipo", $estado, PDO::PARAM_STR);
		$stmt->bindParam(":usuario_entrego", $usuario, PDO::PARAM_STR);
		$stmt->bindParam(":orden", $orden, PDO::PARAM_STR);



		/*if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}*/

		$exec = $stmt->execute() > 0;

		return $exec;



		//

		$stmt = null;
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
	static public function mdlSumaTotalVentasServicioAnticipo()
	{

		$stmt = Conexion::conectar()->prepare("SELECT SUM(s.anticipo) AS total FROM servicios s WHERE s.estado_equipo != 'Entregado' AND estado_corte = 0 ");

		$stmt->execute();

		return $stmt->fetch();



		$stmt = null;
	}
	static public function mdlSumaTotalVentasServicioAdeudo()
	{

		$stmt = Conexion::conectar()->prepare("SELECT SUM(s.importe) AS adeudo FROM servicios s WHERE s.estado_equipo = 'Entregado' AND  s.estado_corte = 0 ");

		$stmt->execute();

		return $stmt->fetch();



		$stmt = null;
	}
	static public function mdlSumaTotalPendientes()
	{

		//$stmt = Conexion::conectar()->prepare("SELECT COUNT(estado_equipo) AS total FROM servicios where estado_equipo != 'Reparado' AND estado_equipo != 'Entregado' ");
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(estado_equipo) AS total FROM servicios where estado_equipo != 'Reparado' AND estado_equipo != 'Entregado' AND estado_borrado = 1");


		$stmt->execute();

		return $stmt->fetch();



		$stmt = null;
	}
	//SELECT COUNT(estado_equipo) AS total FROM servicios where estado_equipo != 'Reparado' || estado_equipo != 'Entregado'
	static public function cambiarEstadoTabla($table, $valor, $item, $id)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $table SET estado_corte = :valor WHERE $item = :item");
		$stmt->bindParam(":valor", $valor);
		$stmt->bindParam(":item", $id);

		$stmt->execute();

		$stmt = null;
	}
	static public function editarNota($nota, $orden)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE servicios SET nota = :nota WHERE orden = :orden");
		$stmt->bindParam(":nota", $nota);
		$stmt->bindParam(":orden", $orden);

		return $stmt->execute();



		$stmt = null;
	}

	static public function mdlAgregarPreServicio($datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO 
			servicio_precargado (nombre,tipo_equipo,marca,modelo,precio) VALUES(:nombre,:tipo_equipo,:marca,:modelo,:precio)");
		$stmt->bindParam(":nombre", $datos['nombre']);
		$stmt->bindParam(":tipo_equipo", $datos['tipo_equipo']);
		$stmt->bindParam(":marca", $datos['marca']);
		$stmt->bindParam(":modelo", $datos['modelo']);
		$stmt->bindParam(":precio", $datos['precio']);


		return $stmt->execute();

		// print_r($stmt->errorInfo());



		$stmt = null;
	}

	static public function MdlMostrarServciosPrecargados($consulta)
	{

		if ($consulta != null) {
			$stmt = Conexion::conectar()->prepare("SELECT id,nombre,tipo_equipo,marca,modelo,precio FROM servicio_precargado  WHERE nombre LIKE '%" . $consulta . "%' OR tipo_equipo LIKE '%" . $consulta . "%' OR marca LIKE '%" . $consulta . "%' OR modelo LIKE '%" . $consulta . "%' OR precio LIKE '%" . $consulta . "%' ");
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM servicio_precargado  ORDER BY id DESC ");
		}



		$stmt->execute();

		return  $stmt->fetchAll();

		//print_r($stmt->errorInfo());




		$stmt = null;
	}
	static public function mdlEliminarServicioPre($datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM servicio_precargado WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		return $stmt->execute();





		$stmt = null;
	}

	static public function mdlActualizarPreServicio($datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE servicio_precargado SET nombre = :nombre , tipo_equipo = :tipo_equipo, marca= :marca , modelo = :modelo , precio = :precio WHERE id = :id");
		$stmt->bindParam(":nombre", $datos['nombre']);
		$stmt->bindParam(":tipo_equipo", $datos['tipo_equipo']);
		$stmt->bindParam(":marca", $datos['marca']);
		$stmt->bindParam(":modelo", $datos['modelo']);
		$stmt->bindParam(":precio", $datos['precio']);
		$stmt->bindParam(":id", $datos['id']);


		return $stmt->execute();

		// print_r($stmt->errorInfo());



		$stmt = null;
	}

	static public function MdlMostrarServcioPrecargado($id)
	{


		$stmt = Conexion::conectar()->prepare("SELECT * FROM servicio_precargado  WHERE id =  :id ");

		$stmt->bindParam(":id", $id);



		$stmt->execute();

		return  $stmt->fetch();

		//print_r($stmt->errorInfo());




		$stmt = null;
	}


	public static function mdlAbonoServicio($orden, $monto, $total)
	{
		$sql = "UPDATE servicios SET anticipo = ?, total = ?, estado_corte = 0 WHERE orden = ?";

		$pps = Conexion::conectar()->prepare($sql);

		$pps->bindValue(1, $monto);
		$pps->bindValue(2, $total);
		$pps->bindValue(3, $orden);

		return $pps->execute();

		$pps = null;
	}
}
