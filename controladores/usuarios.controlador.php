<?php

class ControladorUsuarios
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario()
	{

		if (isset($_POST["ingUsuario"])) {




			$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$tabla = "usuarios";

			$item = "usuario";
			$valor = $_POST["ingUsuario"];

			$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

			//var_dump($respuesta);	

			if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {

				$suscriptor = $respuesta['suscriptor'];
				//Variable contador de usuarios

				$susc = ModeloUsuarios::mdlMostrarSuscripcion($suscriptor);
				//var_dump($susc);
				/*if($susc["estado_suscripcion"]==0){
						echo '<br><div class="alert alert-danger">Tu suscripción no esta activa, debido a falta de pago</div>';
						return;


					}*/


				//var_dump($sucu);
				// if(!$sucu){
				// 	echo '<br>
				// 		<div class="alert alert-danger">Datos erroneos</div>';
				// 		return;

				// }

				if ($respuesta["estado"] == 1) {

					$_SESSION["session"] = true;



					//Datos del usuario

					$_SESSION["nombre"] = $respuesta["nombre"];
					$_SESSION["usuario"] = $respuesta["usuario"];
					$_SESSION["foto"] = $respuesta["foto"];
					$_SESSION["perfil"] = $respuesta["perfil"];

					//Datos de la susctipcion
					$_SESSION["suscriptor"] = $susc["id"];

					$_SESSION['tipo_suc'] =  $susc["tipo"];
					$_SESSION['tipo_plan'] =  $susc["plan"];

					$_SESSION['fecha_inicio'] =  $susc["fecha_inicio"];
					$_SESSION['fecha_termino'] =  $susc["fecha_termino"];
					$_SESSION['propietario'] =  $susc["propietario"];
					$_SESSION['estado_suscripcion'] =  $susc["estado_suscripcion"];

					$_SESSION["nom_suc"] = "";
					$_SESSION["base"] = "";





					/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

					date_default_timezone_set($_SESSION["zona"]);

					$fecha = date('Y-m-d');
					$hora = date('H:i:s');

					$fechaActual = $fecha . ' ' . $hora;

					$item1 = "ultimo_login";
					$valor1 = $fechaActual;

					$item2 = "usuario";
					$valor2 = $respuesta["usuario"];

					$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

					$statusOnline = ControladorUsuarios::ctrOnlineStatus(1, $_SESSION["usuario"]);


					if ($ultimoLogin == "ok") {

						echo '<script>

								window.location = "sucursal";

							</script>';
					}
				} else {

					echo '<br>
							<div class="alert alert-danger">El usuario  no está activado</div>';
				}
			} else {

				echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
			}
		}
	}

	static public function ctrIngresoUsuarioToken()
	{

		if (isset($_GET["tokenAuth"])) {



			$ipAuth = $_GET['ip'];
			$tokenAuth = $_GET['tokenAuth'];



			$respuesta = ModeloUsuarios::mdlMostrarUsuariosToken($ipAuth, $tokenAuth);

			//var_dump($respuesta);	

			$tabla = "usuarios";



			if ($respuesta != false) {

				$suscriptor = $respuesta['suscriptor'];
				//Variable contador de usuarios

				$susc = ModeloUsuarios::mdlMostrarSuscripcion($suscriptor);
				//var_dump($susc);
				/*if($susc["estado_suscripcion"]==0){
						echo '<br><div class="alert alert-danger">Tu suscripción no esta activa, debido a falta de pago</div>';
						return;


					}*/


				//var_dump($sucu);
				// if(!$sucu){
				// 	echo '<br>
				// 		<div class="alert alert-danger">Datos erroneos</div>';
				// 		return;

				// }

				if ($respuesta["estado"] == 1) {

					$_SESSION["session"] = true;



					//Datos del usuario

					$_SESSION["nombre"] = $respuesta["nombre"];
					$_SESSION["usuario"] = $respuesta["usuario"];
					$_SESSION["foto"] = $respuesta["foto"];
					$_SESSION["perfil"] = $respuesta["perfil"];

					//Datos de la susctipcion
					$_SESSION["suscriptor"] = $susc["id"];

					$_SESSION['tipo_suc'] =  $susc["tipo"];
					$_SESSION['tipo_plan'] =  $susc["plan"];

					$_SESSION['fecha_inicio'] =  $susc["fecha_inicio"];
					$_SESSION['fecha_termino'] =  $susc["fecha_termino"];
					$_SESSION['propietario'] =  $susc["propietario"];
					$_SESSION['estado_suscripcion'] =  $susc["estado_suscripcion"];

					$_SESSION["perfil"] = $respuesta["perfil"];


					$_SESSION["nom_suc"] = "";
					$_SESSION["base"] = "";





					/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

					//date_default_timezone_set($_SESSION["zona"]);

					$fecha = date('Y-m-d');
					$hora = date('H:i:s');

					$fechaActual = $fecha . ' ' . $hora;

					$item1 = "ultimo_login";
					$valor1 = $fechaActual;

					$item2 = "usuario";
					$valor2 = $respuesta["usuario"];

					$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

					$statusOnline = ControladorUsuarios::ctrOnlineStatus(1, $_SESSION["usuario"]);

					return true;
				} else {

					return false;
				}
			} else {

				return false;
			}
		}
	}

	public function ctrCargarSucursal()
	{
		if (isset($_POST['btnCargarSucursal'])) {
			$sucu = ModeloUsuarios::mdlMostrarSucursal($_SESSION["suscriptor"], $_POST["ingSucursal"]);

			//Datos de la sucursal


			$_SESSION["nom_suc"] = $sucu["nombre"];
			$_SESSION["zona"] = $sucu["zona"];
			$_SESSION['db_name'] =  $sucu["db_name"];
			$_SESSION['user_name'] =  $sucu["user_name"];
			$_SESSION['base'] =  $sucu["base"];
			$_SESSION['password_db'] =  $sucu["password_db"];
			$_SESSION['ruta_logo'] =  $sucu["ruta_logo"];
			$_SESSION['token_suc'] =  $sucu["token_suc"];






			if ($_POST['nuevoValorEfectivoSucusarl'] > 0) {
				date_default_timezone_set($_SESSION["zona"]);

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$fecha_ingreso = $fecha . ' ' . $hora;



				$items = array(
					'ingreso' => $_POST['nuevoValorEfectivoSucusarl'],
					'concepto' => 'Inicio de caja',
					'fecha_ingreso' => $fecha_ingreso,
					'usuario' => $_SESSION['nombre']
				);

				$agregar = Modeloingresos::mdlAgrearingresos($items);

				if ($agregar) {
					$mov = array(
						'tipo' => 'INGRESO',
						'numero_movimiento' => $fecha_ingreso,
						'concepto' =>  'Inicio de caja',
						'monto' => $_POST['nuevoValorEfectivoSucusarl'],
						'cliente' => '',
						'fecha' => $fecha_ingreso,
						'usuario' => $_SESSION["nombre"],
						'extra' => ''


					);
					$movimiento = ControladorMovimientos::ctrRegistrarMovimiento($mov);
				}
			}
			echo '<script>

						window.location = "./";

					</script>';
		}
	}

	public function ctrCambiarSucursal()
	{
		if (isset($_POST['btnCambiarSucursal'])) {
			$sucu = ModeloUsuarios::mdlMostrarSucursal($_SESSION["suscriptor"], $_POST["ingSucursal"]);

			//Datos de la sucursal


			$_SESSION["nom_suc"] = $sucu["nombre"];
			$_SESSION["zona"] = $sucu["zona"];
			$_SESSION['db_name'] =  $sucu["db_name"];
			$_SESSION['user_name'] =  $sucu["user_name"];
			$_SESSION['base'] =  $sucu["base"];
			$_SESSION['password_db'] =  $sucu["password_db"];
			$_SESSION['ruta_logo'] =  $sucu["ruta_logo"];


			echo '<script>

						window.location = "./";

					</script>';
		}
	}


	static public function ctrOnlineStatus($estado, $usuario)
	{
		$statusOnline = ModeloUsuarios::mdlStatusOnline($estado, $usuario);
	}
	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario()
	{

		if (isset($_POST["nuevoUsuario"])) {
			//Variable contadora de usuarios

			$contUsuarios = ModeloUsuarios::mdlContadorSuscriptor($_SESSION["suscriptor"]);

			$usuariosTotal = ModeloUsuarios::mdlTotalUsuariosSuscripcion($_SESSION["suscriptor"]);

			if ($contUsuarios[0] >= $usuariosTotal['usuarios']) {

				echo '<script>

					swal({

						type: "error",
						title: "Tu suscripción rebasa él limite de usuarios contratados, puedes adquirir más usuarios de así desearlo",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){			
							window.location = "usuarios";
						}
					});
				
				</script>';
				return;
			}


			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&

				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])
			) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if (isset($_FILES["nuevaFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
					$nameFile = md5($_POST["nuevoUsuario"]);

					$directorio = "vistas/img/usuarios/" . $nameFile;
					if (!file_exists($directorio)) {
						mkdir($directorio, 0777);
					}



					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $nameFile . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}
					if ($_FILES["nuevaFoto"]["type"] == "image/jpg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $nameFile . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if ($_FILES["nuevaFoto"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $nameFile . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$permisoSuc = "";

				foreach ($_POST['sucPermiso'] as $key => $value) {
					$permisoSuc .= $value . ',';
				}
				$permisoSuc = trim($permisoSuc, ',');
				$datos = array(
					"nombre" => $_POST["nuevoNombre"],
					"usuario" => $_POST["nuevoUsuario"],
					"password" => $encriptar,
					"perfil" => $_POST["nuevoPerfil"],
					"foto" => $ruta,
					"suscriptor" => $_SESSION["suscriptor"],
					"acceso_sucursal" => $permisoSuc
				);
				//var_dump($datos);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);


				if ($respuesta == "ok") {


					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

					</script>';
				}
			} else {

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarUsuariosSuscriptos()
	{



		$respuesta = ModeloUsuarios::mdlMostrarUsuariosSuscriptor($_SESSION["suscriptor"]);

		return $respuesta;
	}

	static public function ctrMostrarUsuariosSuscriptosPorRol($perfil)
	{



		$respuesta = ModeloUsuarios::mdlMostrarUsuariosSuscriptorPorRol($_SESSION["suscriptor"], $perfil);

		return $respuesta;
	}




	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario()
	{

		if (isset($_POST["editarUsuario"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/



				$ruta = $_POST["fotoActual"];

				if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;
					$nameFile = md5($_POST["editarUsuario"]);

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/" . $nameFile;

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if (!empty($_POST["fotoActual"]) && $_POST["fotoActual"] != "vistas/img/usuarios/default/anonymous.png") {

						unlink($_POST["fotoActual"]);
					} else {


						if (!file_exists($directorio)) {
							mkdir($directorio, 0777);
						}
					}

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if (!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png") {

						unlink($_POST["imagenActual"]);
					} else {

						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $nameFile . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}
					if ($_FILES["nuevaFoto"]["type"] == "image/jpg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $nameFile . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if ($_FILES["editarFoto"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $nameFile . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "usuarios";

				if ($_POST["editarPassword"] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					} else {

						echo '<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result) {
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

						return;
					}
				} else {

					$encriptar = $_POST["passwordActual"];
				}

				$permisoSuc = "";

				foreach ($_POST['sucPermiso'] as $key => $value) {
					$permisoSuc .= $value . ',';
				}
				$permisoSuc = trim($permisoSuc, ',');
				$datos = array(
					"nombre" => $_POST["editarNombre"],
					"usuario" => $_POST["editarUsuario"],
					"password" => $encriptar,
					"perfil" => $_POST["editarPerfil"],
					"foto" => $ruta,
					"acceso_sucursal" => $permisoSuc
				);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';
			}
		}
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuario()
	{

		if (isset($_GET["idUsuario"])) {

			$tabla = "usuarios";
			$datos = $_GET["idUsuario"];
			$suscriptor = $_SESSION["suscriptor"];

			if ($_GET["fotoUsuario"] != "") {

				$nameFile  = md5($_GET["usuario"]);

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/' . $nameFile);
			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos, $suscriptor);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';
			}
		}
	}

	public static function ctrrenovarSuscripcion()
	{
		if (isset($_POST['btnRenovarSuscripcion'])) {
			$arrayName =
				$datos = array(
					'plan' => $_POST['plan'],
					'tipo' => $_POST['tipo'],
					'propietario' => $_SESSION["propietario"]
				);

			$renovar = ModeloUsuarios::mdlrenovarSuscripcion($datos);

			if ($renovar) {

				echo '<script>

				swal({
					  type: "success",
					  title: "!Bien hecho¡ Tu suscrpción ha sido renovada, Estamos a la espera de tu  comprobante de pago.",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "suscripcion";

								}
							})

				</script>';
			} else {
				echo '<script>

					swal({

						type: "error",
						title: "¡No es posible actualizar tu cuenta, ponte en contacto con alguno de nuestros agentes!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "suscripcion";

						}

					});
				

				</script>';
			}
		}
	}

	public function ctrBloaquearUsusario()
	{
		if (isset($_POST['btnBloquearUsuario'])) {
			$_SESSION['block_session'] = true;

			echo '<script>

					window.location = "block";

				</script>';
		}
	}
	public function ctrdesbloquearUsuario()
	{
		if (isset($_POST['btnDesbloquearUsuario'])) {

			$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$tabla = "usuarios";

			$item = "usuario";
			$valor = $_POST["ingUsuario"];

			$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);




			//var_dump($respuesta);	

			if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {


				//Datos del usuario

				$_SESSION["nombre"] = $respuesta["nombre"];
				$_SESSION["usuario"] = $respuesta["usuario"];
				$_SESSION["foto"] = $respuesta["foto"];
				$_SESSION["perfil"] = $respuesta["perfil"];

				unset($_SESSION['block_session']);




				/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

				date_default_timezone_set($_SESSION["zona"]);

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');

				$fechaActual = $fecha . ' ' . $hora;

				$item1 = "ultimo_login";
				$valor1 = $fechaActual;

				$item2 = "usuario";
				$valor2 = $respuesta["usuario"];

				$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

				$statusOnline = ControladorUsuarios::ctrOnlineStatus(1, $_SESSION["usuario"]);


				if ($ultimoLogin == "ok") {

					echo '<script>

								window.location = "inicio";

							</script>';
				}
			} else {

				echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
			}
		}
	}

	public function ctrEnviarResena()
	{
		if (isset($_POST['btnEnviarResena'])) {
			$_POST['usuario'] = $_SESSION['usuario'];

			$guardar = ModeloUsuarios::mdlEnviarResena($_POST);

			if ($guardar) {

				echo '<script>

				swal({
					  type: "success",
					  title: "!Gracias¡ tu reseña es muy importante",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "./";

								}
							})

				</script>';
			} else {
				echo '<script>

					swal({

						type: "error",
						title: "¡Ocurrio un error inesperado! Intenta de nuevo",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "./";

						}

					});
				

				</script>';
			}
		}
	}


	public static function ctrSucursalesPermisoUsuario($usuario)
	{
		return ModeloUsuarios::mdlSucursalesPermisoUsuario($usuario);
	}

	public static function ctrSucursalesPropietario()
	{
		return ModeloUsuarios::mdlContadorSuscriptorSucursal($_SESSION['suscrptor']);
	}

	
}
