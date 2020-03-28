<?php 
	require_once 'conexion-softmor.php';
	/**
	 * 
	 */
	class SuscripcionModelo 
	{
		
		function __construct()
		{
			# code...
		}
		 //Ver el estado de la suscripcion

		public static function mdlObetnerEstadoSuscripcion($propietario){
			$stmt = ConexionSoftmor::conectar()->prepare("SELECT * FROM suscripciones WHERE propietario = :propietario");

			$stmt -> bindParam(":propietario", $propietario, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
		}
		public static function mdlAgregarUsuario($datos){
			$stmt = ConexionSoftmor::conectar()->prepare("INSERT INTO usuarios(nombre, usuario, password, perfil, foto,suscriptor,telefono) VALUES (:nombre, :usuario, :password, :perfil, :foto,:suscriptor,:telefono)");

			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
			$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
			$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
			$stmt->bindParam(":suscriptor", $datos["suscriptor"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);


			return $stmt->execute();

			
			

			$stmt->close();
			
			$stmt = null;
		}
		public static function mdlAgregarSucursal($datos){
			$stmt = ConexionSoftmor::conectar()->prepare("INSERT INTO sucursales(nombre,propietario,base) VALUES (:nombre_suc,:propietario,2)");

			$stmt->bindParam(":nombre_suc", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":propietario", $datos["propietario"], PDO::PARAM_STR);

			return $stmt->execute();

			
			//print_r($stmt->errorInfo());

			$stmt->close();
			
			$stmt = null;
		}
		public static function mdlAgregarSuscripcion($datos){
			$stmt = ConexionSoftmor::conectar()->prepare("INSERT INTO suscripciones(id,tipo,plan,propietario) VALUES (:id,:tipo,:plan,:propietario)");
			$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

			$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
			$stmt->bindParam(":plan", $datos["plan"], PDO::PARAM_STR);
			$stmt->bindParam(":propietario", $datos["propietario"], PDO::PARAM_STR);


			return $stmt->execute();

			//print_r($stmt->errorInfo());


			$stmt->close();
			
			
			$stmt = null;
		}
		/*public static function mdlAgregarSucursalUsuario($datos){
			$stmt = ConexionSoftmor::conectar()->prepare("INSERT INTO sucursal_usuario(usuario,sucursal) VALUES (:usuario,:sucursal)");

			$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":sucursal", $datos["sucursal"], PDO::PARAM_STR);

			return $stmt->execute();
			$stmt->close();
			
			$stmt = null;
		}*/


		public static function issetEmail($email){
			$stmt = ConexionSoftmor::conectar()->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");

			$stmt->bindParam(":usuario", $email, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
			
			//print_r($stmt->errorInfo());

			$stmt->close();
			
			$stmt = null;
		}
		public static function issetSucursal($sucursal){
			$stmt = ConexionSoftmor::conectar()->prepare("SELECT * FROM sucursales WHERE nombre = :nombre");

			$stmt->bindParam(":nombre", $sucursal, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
			
			//print_r($stmt->errorInfo());

			$stmt->close();
			
			$stmt = null;
		}

		
	}