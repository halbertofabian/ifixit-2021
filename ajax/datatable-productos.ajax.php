<?php session_start();
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductos
{

	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/

	public function mostrarTablaProductos()
	{

		$item = null;
		$valor = null;
		$orden = "id";

		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

		if (count($productos) == 0) {

			echo '{"data": []}';

			return;
		}

		$datosJson = '{
		  "data": [';

		for ($i = 0; $i < count($productos); $i++) {

			/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/

			$imagen = "<img src='" . $productos[$i]["imagen"] . "' width='40px'>";

			/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/

			$item = "id";
			$valor = $productos[$i]["id_categoria"];

			$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

			/*=============================================
 	 		STOCK
  			=============================================*/

			if ($productos[$i]["stock"] <= 10) {

				$stock = "<button class='btn btn-danger'>" . $productos[$i]["stock"] . "</button>";
			} else if ($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15) {

				$stock = "<button class='btn btn-warning'>" . $productos[$i]["stock"] . "</button>";
			} else {

				$stock = "<button class='btn btn-success'>" . $productos[$i]["stock"] . "</button>";
			}

			/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/

			if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial") {

				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='" . $productos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-edit'></i></button></div>";
			} else {

				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='" . $productos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='" . $productos[$i]["id"] . "' codigo='" . $productos[$i]["codigo"] . "' imagen='" . $productos[$i]["imagen"] . "'><i class='fa fa-times'></i></button></div>";
			}

			//$barra = "<a href='extensiones/tcpdf/pdf/etiqueta.php?codigo=".$productos[$i]["codigo"]."&tipo=producto' target='_blank' class='btn btn-default' ><i class='fas fa-barcode'></i>
			//</a>";
			$barra =  "<button class='btn btn-default btnImprimirEtiqueta' codeProducto='" . $productos[$i]["codigo"] . "'><i class='fas fa-barcode'></i></button>";

			$datosJson .= '[
				  "' . ($i + 1) . '",
				  "' . trim($barra) . '",
			      "' . trim($imagen) . '",
			      "' . trim($productos[$i]["codigo"]) . '",
			      "' . trim($productos[$i]["descripcion"]) . '",
			      "' . trim($categorias["categoria"]) . '",
			      "' . trim($stock) . '",
			      "' . trim($productos[$i]["precio_compra"]) . '",
				  "' . trim($productos[$i]["precio_venta"]) . '",
				  "' . trim($productos[$i]["precio_mayoreo"]) . '",
			      "' . trim($productos[$i]["fecha"]) . '",
			      "' . $botones . '"
			    ],';
		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .=   '] 

		 }';

		echo $datosJson;
	}
}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();
