<?php

/**
 * 
 */
class ControladorSucursal
{

	function __construct()
	{
		# code...
	}

	public static function ctrMostrarSucursal()
	{
		return ModeloSucursal::mdlMostrarSucursal($_SESSION['nom_suc']);
	}
	public static function ctrMostrarSucursalPropietario($popietario)
	{
		return ModeloSucursal::mdlMostrarSucursalPropietario($popietario);
	}
	public static function ctractivarCuenta()
	{
		if (isset($_POST['btnActivarSuc'])) {
			$sucu = ModeloSucursal::mdlMostrarSucursal($_SESSION['nom_suc']);

			$_SESSION['db_name'] =  $sucu["db_name"];
			$_SESSION['user_name'] =  $sucu["user_name"];
			$_SESSION['base'] =  $sucu["base"];
			$_SESSION['password_db'] =  $sucu["password_db"];
			//$_SESSION['tipo_suc'] = $sucu["tipo"];
			echo '<script>

					

							window.location = "suscripcion";


			  	</script>';
		}
	}

	public static function ctrModificarInformación()
	{
		if (isset($_POST['btnModInfo'])) {


			$ruta = $_POST["imagenActual"];

			if (isset($_FILES["nuevaImagen"]["tmp_name"])) {

				list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL Producto
					=============================================*/
				$fileimg = md5($_SESSION["nom_suc"]);

				$directorio = "vistas/img/logo_suc/" . $fileimg;

				mkdir($directorio, 0755);

				/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

				if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {

					/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

					//$aleatorio = mt_rand(100, 999);

					$ruta = "vistas/img/logo_suc/" . $fileimg . "/logo_suc.jpg";

					$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);
				}

				if ($_FILES["nuevaImagen"]["type"] == "image/png") {

					/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/



					$ruta = "vistas/img/logo_suc/" . $fileimg . "/logo_suc.png";

					$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);
				}
			}


			$datos = array(
				'nombre' => $_SESSION["nom_suc"],
				'direccion' => $_POST["direccion"],
				'telefono' => $_POST["telefono"],
				'sitio_web' => $_POST["sitio_web"],
				'tipo_impresora' => $_POST['impresion'],
				'zona' => $_POST['zona'],
				'ruta_logo' => $ruta
			);
			$modificar = ModeloSucursal::mdlModificarInformación($datos);
			if ($modificar) {
				$_SESSION["zona"] = $_POST['zona'];
				$_SESSION["ruta_logo"] = $ruta;
				echo '<script>

					

							window.location = "configuraciones";


			  	</script>';
			} else {
				echo '<script>

					swal({
						  type: "error",
						  title: "¡No se pudo gurdar la información!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "configuraciones";

							}
						})

			  	</script>';
			}
		}
	}
	public static function ctrModificarRedes()
	{

		if (isset($_POST['btnModRedes'])) {

			$datos = array(
				'nombre' => $_SESSION["nom_suc"],
				'facebook' => $_POST["facebook"],
				'youtube' => $_POST["youtube"],
				'twitter' => $_POST["twitter"],
				'instagram' => $_POST["instagram"],
				'whatsapp' => $_POST["whatsapp"]
			);

			$modificar = ModeloSucursal::mdlModificarRedes($datos);

			if ($modificar) {
				echo '<script>

					

							window.location = "configuraciones";


			  	</script>';
			} else {
				echo '<script>

					swal({
						  type: "error",
						  title: "¡No se pudo gurdar la información!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "configuraciones";

							}
						})

			  	</script>';
			}
		}
	}

	public static function ctrModificarTxtServicio()
	{
		if (isset($_POST['btnModServWP'])) {
			$datos = array(
				'nombre' => $_SESSION["nom_suc"],
				'text_servicio' => $_POST["text_servicio"]
			);

			$modificar = ModeloSucursal::mdlModificarTxtServicio($datos);
			if ($modificar) {
				echo '<script>

					

							window.location = "configuraciones";


			  	</script>';
			} else {
				echo '<script>

					swal({
						  type: "error",
						  title: "¡No se pudo gurdar la información!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "configuraciones";

							}
						})

			  	</script>';
			}
		}
	}
	public static function ctrModificarPoliticas()
	{
		if (isset($_POST['btnModPoliticas'])) {
			$datos = array(
				'nombre' => $_SESSION["nom_suc"],
				'politicas' => $_POST["politicas"]
			);

			$modificar = ModeloSucursal::mdlModificarPoliticas($datos);
			if ($modificar) {
				echo '<script>

					

							window.location = "configuraciones";


			  	</script>';
			} else {
				echo '<script>

					swal({
						  type: "error",
						  title: "¡No se pudo gurdar la información!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "configuraciones";

							}
						})

			  	</script>';
			}
		}
	}
	public static function ctrModificarPoliticasAccesorios()
	{
		if (isset($_POST['btnModPoliticasAccesorios'])) {
			$datos = array(
				'nombre' => $_SESSION["nom_suc"],
				'politicas_accesorios' => $_POST["politicas_accesorios"]
			);
			//var_dump($datos);
			$modificar = ModeloSucursal::mdlModificarPoliticasAccesorios($datos);
			if ($modificar) {
				echo '<script>

					

							window.location = "configuraciones";


			  	</script>';
			} else {
				echo '<script>

					swal({
						  type: "error",
						  title: "¡No se pudo gurdar la información!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "configuraciones";

							}
						})

			  	</script>';
			}
		}
	}

	public static function ctrGuardarSucursal()
	{
		if (isset($_POST["btnGuardarSuc"])) {
			$contSuc = ModeloSucursal::mdlContarSuc(md5($_SESSION["propietario"]));
			var_dump($contSuc);

			$susc = ModeloUsuarios::mdlMostrarSuscripcion(md5($_SESSION["propietario"]));
			$_SESSION["suscriptor"] = $susc["id"];

			$_SESSION['tipo_suc'] =  $susc["tipo"];
			$_SESSION['tipo_plan'] =  $susc["plan"];

			$suscCount = ModeloUsuarios::mdlContadorSuscriptorSucursal($susc["id"]);
			$suscCountTotal = ModeloUsuarios::mdlTotalSucursalesSuscripcion($susc["id"]);

			$suscCount = $contSuc["COUNT(propietario)"];
			//if($contSuc["COUNT(propietario)"]=>)

			if ($suscCount >= $suscCountTotal['sucursales']) {
				echo '<script>

					swal({

						type: "error",
						title: "Tu suscripción tiene una contratación de ' . $suscCountTotal['sucursales'] . ' sucursales, si requieres más ponte en contacto con un agente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "configuraciones";

						}

					});
				

				</script>';

				return;
			}


			$sucursal = array(
				'nombre' => $_POST['nombre_suc'],
				'propietario' => md5($_SESSION["propietario"])
			);
			$agregar = ModeloSucursal::mdlAgregarSucursal($sucursal);
			if ($agregar) {
				echo '<script>

					swal({
						  type: "success",
						  title: "¡Sucursal guardada!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "configuraciones";

							}
						})

			  	</script>';
			} else {
				echo '<script>

					swal({
						  type: "error",
						  title: "¡No se pudo gurdar la información!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "configuraciones";

							}
						})

			  	</script>';
			}
		}
	}
	public static function getZone()
	{
		return $zona = array(
			'America/Adak', 'America/Anchorage', 'America/Anguilla', 'America/Antigua',
			'America/Araguaina', 'America/Argentina/Buenos_Aires', 'America/Argentina/Catamarca', 'America/Argentina/Cordoba',
			'America/Argentina/Jujuy', 'America/Argentina/La_Rioja', 'America/Argentina/Mendoza', 'America/Argentina/Rio_Gallegos',
			'America/Argentina/Salta', 'America/Argentina/San_Juan', 'America/Argentina/San_Luis', 'America/Argentina/Tucuman',
			'America/Argentina/Ushuaia', 'America/Aruba', 'America/Asuncion', 'America/Atikokan',
			'America/Bahia', 'America/Bahia_Banderas', 'America/Barbados', 'America/Belem',
			'America/Belize', 'America/Blanc-Sablon', 'America/Boa_Vista', 'America/Bogota',
			'America/Boise', 'America/Cambridge_Bay', 'America/Campo_Grande', 'America/Cancun',
			'America/Caracas', 'America/Cayenne', 'America/Cayman', 'America/Chicago',
			'America/Chihuahua', 'America/Costa_Rica', 'America/Creston', 'America/Cuiaba',
			'America/Curacao', 'America/Danmarkshavn', 'America/Dawson', 'America/Dawson_Creek',
			'America/Denver', 'America/Detroit', 'America/Dominica', 'America/Edmonton',
			'America/Eirunepe', 'America/El_Salvador', 'America/Fort_Nelson', 'America/Fortaleza',
			'America/Glace_Bay', 'America/Godthab', 'America/Goose_Bay', 'America/Grand_Turk',
			'America/Grenada', 'America/Guadeloupe', 'America/Guatemala', 'America/Guayaquil',
			'America/Guyana', 'America/Halifax', 'America/Havana', 'America/Hermosillo',
			'America/Indiana/Indianapolis', 'America/Indiana/Knox', 'America/Indiana/Marengo', 'America/Indiana/Petersburg',
			'America/Indiana/Tell_City', 'America/Indiana/Vevay', 'America/Indiana/Vincennes', 'America/Indiana/Winamac',
			'America/Inuvik', 'America/Iqaluit', 'America/Jamaica', 'America/Juneau',
			'America/Kentucky/Louisville', 'America/Kentucky/Monticello', 'America/Kralendijk', 'America/La_Paz',
			'America/Lima', 'America/Los_Angeles', 'America/Lower_Princes', 'America/Maceio',
			'America/Managua', 'America/Manaus', 'America/Marigot', 'America/Martinique',
			'America/Matamoros', 'America/Mazatlan', 'America/Menominee', 'America/Merida',
			'America/Metlakatla', 'America/Mexico_City', 'America/Miquelon', 'America/Moncton',
			'America/Monterrey', 'America/Montevideo', 'America/Montserrat', 'America/Nassau',
			'America/New_York', 'America/Nipigon', 'America/Nome', 'America/Noronha',
			'America/North_Dakota/Beulah', 'America/North_Dakota/Center', 'America/North_Dakota/New_Salem', 'America/Ojinaga',
			'America/Panama', 'America/Pangnirtung', 'America/Paramaribo', 'America/Phoenix',
			'America/Port-au-Prince', 'America/Port_of_Spain', 'America/Porto_Velho', 'America/Puerto_Rico',
			'America/Punta_Arenas', 'America/Rainy_River', 'America/Rankin_Inlet', 'America/Recife',
			'America/Regina', 'America/Resolute', 'America/Rio_Branco', 'America/Santarem',
			'America/Santiago', 'America/Santo_Domingo', 'America/Sao_Paulo', 'America/Scoresbysund',
			'America/Sitka', 'America/St_Barthelemy', 'America/St_Johns', 'America/St_Kitts',
			'America/St_Lucia', 'America/St_Thomas', 'America/St_Vincent', 'America/Swift_Current',
			'America/Tegucigalpa', 'America/Thule', 'America/Thunder_Bay', 'America/Tijuana',
			'America/Toronto', 'America/Tortola', 'America/Vancouver', 'America/Whitehorse',
			'America/Winnipeg', 'America/Yakutat', 'America/Yellowknife'
		);
	}
}
