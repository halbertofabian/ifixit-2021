<?php

require_once "conexion-softmor.php";

class ModeloUsuarios
{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor)
	{
		//	$suscriptor= $_SESSION["suscriptor"];

		if ($item != null) {

			$stmt = ConexionSoftmor::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);


			$stmt->execute();
			//print_r($stmt->errorInfo());

			return $stmt->fetch();
		} else {

			$stmt = ConexionSoftmor::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();
			//print_r($stmt->errorInfo());

			return $stmt->fetchAll();
		}




		$stmt = null;
	}

	static public function mdlMostrarUsuariosToken($ipAuth, $tokenAuth)
	{
		//	$suscriptor= $_SESSION["suscriptor"];



		$stmt = ConexionSoftmor::conectar()->prepare("SELECT * FROM usuarios WHERE  tokenAut = ? AND ipAuth = ?");

		$stmt->bindValue(1, $tokenAuth);
		$stmt->bindValue(2, $ipAuth);



		$stmt->execute();
		//print_r($stmt->errorInfo());

		return $stmt->fetch();





		$stmt = null;
	}
	static public function mdlMostrarUsuariosSuscriptor($suscriptor)
	{



		$stmt = ConexionSoftmor::conectar()->prepare("SELECT * FROM usuarios WHERE suscriptor = :suscriptor");

		$stmt->bindParam(":suscriptor", $suscriptor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();


		$stmt = null;
	}

	static public function mdlMostrarUsuariosSuscriptorPorRol($suscriptor, $perfil)
	{



		$stmt = ConexionSoftmor::conectar()->prepare("SELECT * FROM usuarios WHERE suscriptor = :suscriptor AND perfil = :perfil ");

		$stmt->bindParam(":suscriptor", $suscriptor, PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $perfil, PDO::PARAM_STR);


		$stmt->execute();

		return $stmt->fetchAll();


		$stmt = null;
	}




	//Verificar suscripciòn
	static public function mdlMostrarSuscripcion($valor)
	{



		$stmt = ConexionSoftmor::conectar()->prepare("SELECT * FROM suscripciones WHERE id = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();





		$stmt = null;
	}

	//Mostrar sucursales
	static public function mdlMostrarSucursal($usuario, $sucursal)
	{



		$stmt = ConexionSoftmor::conectar()->prepare("SELECT bd.db_name,bd.user_name,bd.password_db,sc.* FROM Banco_datos AS bd  JOIN sucursales AS sc ON bd.id = sc.base WHERE sc.nombre  = :nombre_suc AND  sc.propietario =  :usuario");

		$stmt->bindParam(":nombre_suc", $sucursal, PDO::PARAM_STR);

		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);


		$stmt->execute();

		return $stmt->fetch();





		$stmt = null;
	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos)
	{

		$stmt = ConexionSoftmor::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto,suscriptor,acceso_sucursal) VALUES (:nombre, :usuario, :password, :perfil, :foto,:suscriptor,:acceso_sucursal)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":suscriptor", $datos["suscriptor"], PDO::PARAM_STR);
		$stmt->bindParam(":acceso_sucursal", $datos["acceso_sucursal"], PDO::PARAM_STR);


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
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos)
	{

		$stmt = ConexionSoftmor::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto, acceso_sucursal = :acceso_sucursal WHERE usuario = :usuario");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":acceso_sucursal", $datos["acceso_sucursal"], PDO::PARAM_STR);



		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}
	/* Editar usuario para cambiar el estado en linea */
	static public function mdlStatusOnline($estado, $usuario)
	{

		$stmt = ConexionSoftmor::conectar()->prepare("UPDATE usuarios SET status_online = :status_online WHERE  usuario = :usuario");

		$stmt->bindParam(":status_online", $estado, PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
	{

		$stmt = ConexionSoftmor::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos, $suscriptor)
	{


		$stmt = ConexionSoftmor::conectar()->prepare("DELETE FROM $tabla WHERE id = :id AND suscriptor = :suscriptor");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);
		$stmt->bindParam(":suscriptor", $suscriptor, PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}

	//Modelo sucuripcion
	public static function mdlAgregarSucursalUsuario($datos)
	{
		$stmt = ConexionSoftmor::conectar()->prepare("INSERT INTO sucursal_usuario(usuario,sucursal) VALUES (:usuario,:sucursal)");

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":sucursal", $datos["sucursal"], PDO::PARAM_STR);

		return  $stmt->execute();



		$stmt = null;
	}

	//Contar usuarios

	public static function mdlContadorSuscriptor($suscriptor)
	{
		$stmt = ConexionSoftmor::conectar()->prepare("SELECT COUNT(suscriptor) FROM usuarios WHERE suscriptor = :suscriptor");

		$stmt->bindParam(":suscriptor", $suscriptor, PDO::PARAM_STR);



		$stmt->execute();
		//print_r($stmt->errorInfo());

		return $stmt->fetch();





		$stmt = null;
	}

	// Contar sucursales

	public static function mdlContadorSuscriptorSucursal($propietario)
	{
		$stmt = ConexionSoftmor::conectar()->prepare("SELECT COUNT(propietario) FROM sucursales WHERE propietario = :propietario");

		$stmt->bindParam(":propietario", $propietario, PDO::PARAM_STR);



		$stmt->execute();
		//print_r($stmt->errorInfo());

		return $stmt->fetch();





		$stmt = null;
	}

	public static function mdlTotalUsuariosSuscripcion($suscriptor)
	{
		$stmt = ConexionSoftmor::conectar()->prepare("SELECT usuarios FROM suscripciones WHERE id = ? ");

		$stmt->bindValue(1, $suscriptor, PDO::PARAM_STR);

		$stmt->execute();
		//print_r($stmt->errorInfo());
		return $stmt->fetch();


		$stmt = null;
	}
	public static function mdlTotalSucursalesSuscripcion($suscriptor)
	{
		$stmt = ConexionSoftmor::conectar()->prepare("SELECT sucursales FROM suscripciones WHERE id = ? ");

		$stmt->bindValue(1, $suscriptor, PDO::PARAM_STR);

		$stmt->execute();
		//print_r($stmt->errorInfo());
		return $stmt->fetch();


		$stmt = null;
	}
	public static function mdlSucursalesPermisoUsuario($usuario)
	{
		$stmt = ConexionSoftmor::conectar()->prepare("SELECT acceso_sucursal  FROM usuarios WHERE usuario = ? ");

		$stmt->bindValue(1, $usuario, PDO::PARAM_STR);

		$stmt->execute();
		//print_r($stmt->errorInfo());
		return $stmt->fetch();


		$stmt = null;
	}

	public static function mdlrenovarSuscripcion($datos)
	{
		$stmt = ConexionSoftmor::conectar()->prepare("UPDATE suscripciones SET tipo = :tipo, plan = :plan WHERE propietario = :propietario");

		$stmt->bindParam(":tipo", $datos['tipo'], PDO::PARAM_STR);
		$stmt->bindParam(":plan", $datos['plan'], PDO::PARAM_STR);
		$stmt->bindParam(":propietario", $datos['propietario'], PDO::PARAM_STR);



		return $stmt->execute();
		//print_r($stmt->errorInfo());






		$stmt = null;
	}

	static public function mdlEnviarResena($datos)
	{

		$stmt = ConexionSoftmor::conectar()->prepare("UPDATE usuarios SET resena_text = ? , resena_calif = ?  WHERE usuario = ? ");

		$stmt->bindParam(1, $datos['resena_text'], PDO::PARAM_STR);
		$stmt->bindParam(2, $datos['resena_calif'], PDO::PARAM_INT);
		$stmt->bindParam(3, $datos['usuario'], PDO::PARAM_STR);




		$stmt->execute();

		return $stmt->rowCount();



		$stmt = null;
	}
}
