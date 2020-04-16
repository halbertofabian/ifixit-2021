<?php

use Stripe\ApiOperations\Update;


class ControladorUpdateDB
{
    public static function alterTable()
    {
        if (isset($_POST['btnUpdateTable'])) {
            $sql = "CREATE TABLE `slide` (
                `id` int(11) NOT NULL,
                `nombre` text COLLATE utf8_spanish_ci NOT NULL,
                `imgFondo` text COLLATE utf8_spanish_ci NOT NULL,
                `tipoSlide` text COLLATE utf8_spanish_ci NOT NULL,
                `imgProducto` text COLLATE utf8_spanish_ci NOT NULL,
                `estiloImgProducto` text COLLATE utf8_spanish_ci NOT NULL,
                `estiloTextoSlide` text COLLATE utf8_spanish_ci NOT NULL,
                `titulo1` text COLLATE utf8_spanish_ci NOT NULL,
                `titulo2` text COLLATE utf8_spanish_ci NOT NULL,
                `titulo3` text COLLATE utf8_spanish_ci NOT NULL,
                `boton` text COLLATE utf8_spanish_ci NOT NULL,
                `url` text COLLATE utf8_spanish_ci NOT NULL,
                `orden` int(11) NOT NULL,
                `fecha` datetime NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;     
              ALTER TABLE `slide`
              ADD PRIMARY KEY (`id`);
              ALTER TABLE `slide` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;    
              ";

            $alter = ModeloUpdateDB::alterTable($sql);

            var_dump($alter);
        }
    }
    public function crearBD()
    {
        if (isset($_POST['btnInstalarBase'])) {
            $banco_datos = ModeloUpdateDB::mdlObtenerBD();



            //Consulta el modulo que se ejecutara en el query

            $modulo = ModeloUpdateDB::mdlObtenerModulo('IFIXITMOR');
            //var_dump($modulo);
            // Asigna las credenciales de la bd a la cual se le ejecutara el query
            $_SESSION['db_name'] = $banco_datos['db_name'];
            $_SESSION['user_name'] = $banco_datos['user_name'];
            $_SESSION['password_db'] = $banco_datos['password_db'];

            // Carga el query con todas las tablas
            $crearBD = ModeloUpdateDB::mdlCrearBD($modulo['contenido']);

            //var_dump($crearBD);
            if ($crearBD) {
                // Actualizar la disponibilidad de la base de datos
                ModeloUpdateDB::mdlActualizarDisponibilidad($banco_datos['id']);
                $nueva_suc = $banco_datos['id'];
            } else {
                $mensajes[0] = 'La base de datos no se pudo crear, continua para más instrucciones.';
                $nueva_suc = 2;
            }

            $base = ModeloSucursal::activarBD($_SESSION['nom_suc'], $nueva_suc);

            if ($base) {
                echo '<script>

					swal({
						  type: "success",
						  title: "¡Base de datos instalada!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
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
						  title: "No se pudo instalar la base de datos o ya está instalada, intenta de nuevo.",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "./";

							}
						})

			  	</script>';
            }
        }
    }
}
