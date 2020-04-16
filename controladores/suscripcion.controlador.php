<?php

/**
 * 
 */
class SuscripcionContrlador
{

	function __construct()
	{
		# code...
	}

	public static function ctrObternerEstadoSuscripcion()
	{
		return  SuscripcionModelo::mdlObetnerEstadoSuscripcion($_SESSION['propietario']);
	}

	public static function ctrHacerPedido()
	{
		if (isset($_POST['btnHacerPedido'])) {
			if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"]) || $_POST['password'] != "" || $_POST['tipo_suc'] != "" || $_POST['nombre_suc'] != "" || $_POST["nombre"] != "") {

				$email  = SuscripcionModelo::issetEmail($_POST["email"]);
				$sucursal  = SuscripcionModelo::issetSucursal($_POST['nombre_suc']);


				echo "Hola";

				if ($email != false) {
					echo '
						<script>
						swal({
						  title: "Error :(",
						  text: "Correo no disponible, inetnte con otro",
						  icon: "warning",
						  button: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						   window.history.back();
						  } 
						});
						</script>';
					return;
				}
				if ($sucursal != false) {
					echo '
						<script>
						swal({
						  title: "Error :(",
						  text: "Sucursal no disponible, inetnte con otro nombre",
						  icon: "warning",
						  button: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						   window.history.back();
						  } 
						});
						</script>';
					return;
				}

				$encriptar = crypt(
					$_POST["password"],
					'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'
				);
				$softmor =  md5($_POST["email"]);
				$numero = "";
				$foto = "vistas/img/usuarios/default/anonymous.png";
				if (isset($_POST["numero"]))
					$numero = $_POST["numero"];

				$sucursal = array(
					'nombre' => $_POST['nombre_suc'],
					'propietario' => $softmor
				);
				$suscrpciones = array(
					'id' => $softmor,
					'tipo' => $_POST['tipo_suc'],
					'plan' => $_POST['tipo_plan'],
					'propietario' => $_POST["email"]
				);
				//nombre, usuario, password, perfil, foto,suscriptor,telefono
				$usuarios = array(
					'usuario' => $_POST["email"],
					'nombre' => $_POST["nombre"], 'password' => $encriptar,
					'foto' => $foto,
					'telefono' => $numero,
					"perfil" => 'Administrador',
					'suscriptor' => $softmor
				);
				$registro = array(
					'usuario' => $_POST["email"],
					'sucursal' => $_POST["nombre_suc"]
				);
				//var_dump($sucursal);

				$registro_sucu = SuscripcionModelo::mdlAgregarSucursal($sucursal);
				if ($registro_sucu) {
					$registro_susc = SuscripcionModelo::mdlAgregarSuscripcion($suscrpciones);
					if ($registro_susc) {
						$registro_usua = SuscripcionModelo::mdlAgregarUsuario($usuarios);
						if ($registro_usua) {







							echo '
						<script>
						swal({
						  title: "Registro exitoso",
						  text: "A continuación inicie sessión ",
						  icon: "success",
						  button: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						   window.location = "../login";
						  } 
						});
						</script>';

							//echo openssl_decrypt("q3EjjDHJWmNsCQsyjUmb21gyMqrRr1QE/n6No0/VsOA=","AES-128-ECB","IFIXITMOR");





						} else {
							echo '
						<script>
						swal({
						  title: "Ocurrio un error no identificado",
						  text: "Cominucate con uno de los de soporte ",
						  icon: "warning",
						  button: true,
						  dangerMode: true,
						})
						.then((willDelete) => {
						  if (willDelete) {
						   window.history.back();
						  } 
						});
						</script>';
							return;
						}
					}
				}
			}





			/*var_dump($registro_sucu);
					var_dump($registro_susc);
					var_dump($registro_usua);
					var_dump($registro_usua_suc);*/
		} else {
		}
	}
}
