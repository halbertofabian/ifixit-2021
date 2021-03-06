<?php session_start();

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxProductos
{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idCategoria;

  public function ajaxCrearCodigoProducto()
  {

    $item = "id_categoria";
    $valor = $this->idCategoria;
    $orden = "id";

    $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

    echo json_encode($respuesta);
  }


  /*=============================================
  EDITAR PRODUCTO
  =============================================*/

  public $idProducto;
  public $traerProductos;
  public $nombreProducto;

  public function ajaxCajaProducto()
  {

    $item = "codigo";
    $valor = $this->idProducto;
    $orden = "codigo";
    $respuesta = ControladorProductos::ctrMostrarProductos(
      $item,
      $valor,
      $orden
    );
    echo json_encode($respuesta);
  }
  public function ajaxAllProduct()
  {


    $respuesta = ControladorProductos::ctrMostrarProductos(
      null,
      null,
      'codigo'
    );
    echo json_encode($respuesta);
  }
  public function ajaxEditarProductoRapido()
  {


    $respuesta = ModeloProductos::mdlEditarProductoRapido($_POST);
    echo json_encode($respuesta);
  }

  public function ajaxEditarProducto()
  {

    if ($this->traerProductos == "ok") {

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos(
        $item,
        $valor,
        $orden
      );

      echo json_encode($respuesta);
    } else if ($this->nombreProducto != "") {

      $item = "descripcion";
      $valor = $this->nombreProducto;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos(
        $item,
        $valor,
        $orden
      );

      echo json_encode($respuesta);
    } else {

      $item = "id";
      $valor = $this->idProducto;
      $orden = "id";

      $respuesta = ControladorProductos::ctrMostrarProductos(
        $item,
        $valor,
        $orden
      );

      echo json_encode($respuesta);
    }
  }
}


/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/

if (isset($_POST["idCategoria"])) {

  $codigoProducto = new AjaxProductos();
  $codigoProducto->idCategoria = $_POST["idCategoria"];
  $codigoProducto->ajaxCrearCodigoProducto();
}
/*=============================================
EDITAR PRODUCTO
=============================================*/

if (isset($_POST["idProducto"])) {

  $editarProducto = new AjaxProductos();
  $editarProducto->idProducto = $_POST["idProducto"];
  $editarProducto->ajaxEditarProducto();
}

/*=============================================
TRAER PRODUCTO
=============================================*/

if (isset($_POST["traerProductos"])) {

  $traerProductos = new AjaxProductos();
  $traerProductos->traerProductos = $_POST["traerProductos"];
  $traerProductos->ajaxEditarProducto();
}

/*=============================================
TRAER PRODUCTO
=============================================*/

if (isset($_POST["nombreProducto"])) {

  $traerProductos = new AjaxProductos();
  $traerProductos->nombreProducto = $_POST["nombreProducto"];
  $traerProductos->ajaxEditarProducto();
}

if (isset($_POST["idBarras"])) {
  $editarProducto = new AjaxProductos();
  $editarProducto->idProducto = $_POST["idBarras"];
  $editarProducto->ajaxCajaProducto();
}

if (isset($_POST["allProducts"])) {
  $allProducts = new AjaxProductos();
  $allProducts->ajaxAllProduct();
}

if (isset($_POST["btnChangeP"])) {
  $btnChangeP = new AjaxProductos();
  $btnChangeP->ajaxEditarProductoRapido();
}
