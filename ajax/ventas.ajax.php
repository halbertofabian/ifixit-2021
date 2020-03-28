<?php
session_start();
require_once '../modelos/productos.modelo.php';

require_once '../controladores/productos.controlador.php';
require_once '../controladores/plantilla.controlador.php';




class AjaxVentas
{
    public $valueSearch;


    public function ajaxCargarProductosBuscados()
    {


        $valor = $this->valueSearch;

        $respuesta = ControladorProductos::ctrMostrarProductosBuscados($valor);

        

       
        $salida = "";

        foreach ($respuesta as $key => $value) {

            if ($value['stock'] <= 10) {
                $stok = '<span class="btn btn-block text-center btn-danger">' . $value['stock'] . '</span>';
            } else if ($value['stock'] >= 11 && $value['stock'] <= 20) {
                $stok = '<span class="btn btn-block text-center btn-warning">' . $value['stock'] . '</span>';
            } else {
                $stok = '<span class="btn btn-block text-center btn-success">' . $value['stock'] . '</span>';
            }

            $salida .= '
            <div class="col-md-4 col-xs-4">
                <div class="card">
                        <img class="card-img-top" src="'. $value['imagen'] . '" width="100" alt="Card image cap">
                    <div class="card-body text-center">
                        <h5 class="card-title"><strong> $' . $value["precio_venta"] . ' </strong></h5>
                        <p class="card-text text-primary">' . $value['codigo'] . '</p>
                        <p class="card-text"><strong>' . $value['descripcion'] . '</strong></p>
                        
                    </div>
                    <div class="card-footer">
                    <div class="btn-group text-center" style="padding: 5px">

                        
                        ' . $stok . '
                    </div>
                    </div> 
                </div>
            </div>';
        }
        if ($salida == "") {
            echo '
      			<div class="col-12 col-md-12">
	      			<div class="alert alert-link text-center">
					<strong>No se encontaron resultados :( </strong>
					</div>
				</div>	
			';
        } else {
            echo $salida;
        }
    }
}


if (isset($_POST["productos"])) {

    $nota = new AjaxVentas();
    $nota->valueSearch = $_POST["productos"];
    $nota->ajaxCargarProductosBuscados();
}
