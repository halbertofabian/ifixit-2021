<?php 
	require_once 'conexion-softmor.php';
	/**
	 * 
	 */
	class ModeloSucursal
	{
		
		function __construct()
		{
			# code...
		}
		public static function mdlMostrarSucursal($nombre){
			$stmt = ConexionSoftmor::conectar()->prepare("SELECT bd.db_name,bd.user_name,bd.password_db,sc.* FROM Banco_datos AS bd  JOIN sucursales AS sc ON bd.id = sc.base WHERE sc.nombre  = :nombre");
			$stmt -> bindParam(":nombre",$nombre,PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);

			
			$stmt = null;


		}
		public static function mdlMostrarSucursalPropietario($propietario){
			$stmt = ConexionSoftmor::conectar()->prepare("SELECT bd.db_name,bd.user_name,bd.password_db,sc.* FROM Banco_datos AS bd  JOIN sucursales AS sc ON bd.id = sc.base WHERE sc.propietario  = :propietario");
			$stmt -> bindParam(":propietario",$propietario,PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt->fetchAll();

			
			$stmt = null;


		}

		

		

		public static function mdlContarSuc($propietario){
			$stmt = ConexionSoftmor::conectar()->prepare("SELECT COUNT(propietario) FROM sucursales WHERE propietario =:propietario");
			$stmt -> bindParam(":propietario",$propietario,PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);

			
			$stmt = null;


		}

		public static function mdlModificarInformación($datos){
			$stmt = ConexionSoftmor::conectar()->prepare("UPDATE sucursales SET direccion = :direccion, sitio_web = :sitio_web, telefono = :telefono , tipo_impresora =:tipo_impresora, zona = :zona, ruta_logo = :ruta_logo WHERE nombre = :nombre");
			$stmt -> bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
			$stmt -> bindParam(":sitio_web",$datos["sitio_web"],PDO::PARAM_STR);
			$stmt -> bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
			$stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			$stmt -> bindParam(":tipo_impresora",$datos["tipo_impresora"],PDO::PARAM_STR);
			$stmt -> bindParam(":zona",$datos["zona"],PDO::PARAM_STR);
			$stmt -> bindParam(":ruta_logo",$datos["ruta_logo"],PDO::PARAM_STR);


			return $stmt -> execute();

			

			
			$stmt = null;
		}
		public static function mdlModificarPoliticas($datos){
			$stmt = ConexionSoftmor::conectar()->prepare("UPDATE sucursales SET politicas = :politicas WHERE nombre = :nombre");
			$stmt -> bindParam(":politicas",$datos["politicas"],PDO::PARAM_STR);
			
			$stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			

			return $stmt -> execute();

			

			
			$stmt = null;
		}
		
		public static function mdlModificarTxtServicio($datos){
			$stmt = ConexionSoftmor::conectar()->prepare("UPDATE sucursales SET text_servicio = :text_servicio WHERE nombre = :nombre");
			$stmt -> bindParam(":text_servicio",$datos["text_servicio"],PDO::PARAM_STR);
			
			$stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			

			return $stmt -> execute();

			

			
			$stmt = null;
		}
		public static function mdlModificarPoliticasAccesorios($datos){
			$stmt = ConexionSoftmor::conectar()->prepare("UPDATE sucursales SET politicas_accesorios = :politicas_accesorios WHERE nombre = :nombre");
			$stmt -> bindParam(":politicas_accesorios",$datos["politicas_accesorios"],PDO::PARAM_STR);
			
			$stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			

			return $stmt -> execute();

			

			
			$stmt = null;
		}
		public static function mdlAgregarSucursal($datos){
			$stmt = ConexionSoftmor::conectar()->prepare("INSERT INTO sucursales(nombre,propietario,base) VALUES (:nombre_suc,:propietario,2)");

			$stmt->bindParam(":nombre_suc", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":propietario", $datos["propietario"], PDO::PARAM_STR);

			return $stmt->execute();

			
			//print_r($stmt->errorInfo());

			
			
			$stmt = null;
		}


		public static function  mdlModificarRedes($datos){
			$stmt = ConexionSoftmor::conectar()->prepare("UPDATE sucursales SET facebook = :facebook , youtube = :youtube , twitter = :twitter, instagram = :instagram, whatsapp = :whatsapp  WHERE nombre = :nombre");
			$stmt -> bindParam(":facebook",$datos["facebook"],PDO::PARAM_STR);
			$stmt -> bindParam(":youtube",$datos["youtube"],PDO::PARAM_STR);
			$stmt -> bindParam(":twitter",$datos["twitter"],PDO::PARAM_STR);
			$stmt -> bindParam(":instagram",$datos["instagram"],PDO::PARAM_STR);
			$stmt -> bindParam(":whatsapp",$datos["whatsapp"],PDO::PARAM_STR);
			
			$stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			

			return $stmt -> execute();

			

			
			$stmt = null;
		}

		
	}