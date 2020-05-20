<?php

session_start();
require_once '../lib/phpMailer/Exception.php';
require_once '../lib/phpMailer/PHPMailer.php';
require_once '../lib/phpMailer/SMTP.php';
require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";
require_once "../modelos/corte.modelo.php";
require_once "../modelos/gastos.modelo.php";
require_once "../modelos/movimientos.modelo.php";
require_once "../modelos/sucursales.modelo.php";


require_once "../controladores/movimientos.controlador.php";
require_once "../controladores/sucursales.controlador.php";
require_once "../controladores/plantilla.controlador.php";




if (isset($_GET['orden']) && isset($_GET['estado'])) {
	echo 'Error 409';
}
if (isset($_GET['servicio'])) {
	$_SESSION['orden'] = $_GET['servicio'];
	header("location:../equipos-detalle");
}


class AjaxServicio
{

	function __construct()
	{
	}
	public $idServicio;
	public $consulta;

	public function ajaxEditarNota()
	{


		$valor = $this->idServicio;

		$respuesta = ControladorServicios::ctrMostrarNota($valor);

		echo json_encode($respuesta);
	}
	public function ajaxborrarServicioPrecargado()
	{


		$valor = $this->idServicio;

		$respuesta = ModeloServicios::mdlEliminarServicioPre($valor);

		echo json_encode($respuesta);
	}

	public function ajaxMostrarServicioPrecargadoById()
	{


		$valor = $this->idServicio;

		$respuesta = ModeloServicios::MdlMostrarServcioPrecargado($valor);

		echo json_encode($respuesta);
	}


	public function ajaxMandarCorreo()
	{

		$respuesta = ControladorServicios::ctrMandarCorreo();

		echo json_encode($respuesta);
	}

	public function ajaxAbonarServicio()
	{

		$respuesta 	= ControladorMovimientos::ctrAbonarServicio($_POST);

		echo json_encode($respuesta);
	}
	public function ajaxMostrarServicio()
	{
		$orden = $this->idServicio;
		$respuesta = ModeloMovimientos::mdlOnetnerOrdenServicio($orden);

		//echo json_encode($respuesta, true);
		$salida = '
		<table class="table table-light mt-5 tablasAbono">
			<thead class="thead-light">
				<tr>
					<th>Número de movimiento</th>
					<th>Servicio</th>
					<th>Concepto</th>
					<th>Usuario</th>
					<th>Fecha de movimiento</th>
					<th>Monto</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
		';
		$res = "";
		foreach ($respuesta as $key => $value) {
			$res .= '
				<tr>
					<td>' . $value['id'] . '</td>
					<td>' . $value['numero_movimiento'] . '</td>
					<td>' . $value['concepto'] . '</td>
					<td>' . $value['usuario'] . '</td>
					<td>' . $value['fecha'] . '</td>
					<td>' . $value['monto'] . '</td>';

			if ($_SESSION['perfil'] == "Administrador")
				$res .= '<td><button class="btn btn-danger btnEliminarAbono" onclick="eliminarAbono(' . $value['numero_movimiento'] . ',' . $value['id'] . ',' . $value['monto'] . ')"  ><i class="fas fa-trash"></i></button></td>';
			else
				$res .= '<td></td>
				</tr>
			';
		}

		if ($res == "") {
			$salida = '<div class="alert alert-warning text-center" role="alert">
			Aún no hay abonos para este servicio
		  </div>';
		} else {
			$salida .= $res . '
			</tbody>
			</table>
			';
		}



		echo  $salida . '<br>';
	}

	public function ajaxMostrarServicioOrden()
	{
		$orden = $this->idServicio;
		//$respuesta = ModeloMovimientos::mdlOnetnerOrdenServicio($orden);
		$datalle = ControladorServicios::ctrDetalleServicio($orden);
		echo json_encode($datalle, true);
	}

	public function ajaxEliminarAbono()
	{

		//$respuesta = ModeloMovimientos::mdlOnetnerOrdenServicio($orden);
		$eliminarAbono = ControladorMovimientos::ctrEliminarAbono();
		echo json_encode($eliminarAbono, true);
	}

	public function ajaxEliminarServicio()
	{
		$eliminarServicio = ControladorMovimientos::ctrEliminarServicio();
		echo json_encode($eliminarServicio, true);
	}

	public function ajaxMostrarServicioPrecargado()
	{


		$valor = $this->consulta;

		$respuesta = ControladorServicios::ctrMostrarServciosPrecargados($valor);

		$salida = "";

		foreach ($respuesta as $key => $value) {
			$salida .= '<div class="col-lg-3 col-xs-6">
            <!-- small card -->
            
            <div class="small-box bg-light">
              <div class="inner">
                <h3 class="text-dark">$' . $value["precio"] . '</h3>

                <p class="text-success"><strong>' . $value['nombre'] . '</strong></p>
                <p><strong>' . $value['marca'] . '</strong></p>
                <p><strong>' . $value['modelo'] . '</strong></p>
                <p>' . $value['tipo_equipo'] . '</p>
              </div>

              <a href="index.php?ruta=servicios&precargado=' . $value['id'] . '"><div class="icon">
                <i class="fa fa fa-wrench"></i>
              </div>
              </a>

              <div class="btn-group" style="padding: 5px">
              ';
			if ($_SESSION['perfil'] == "Administrador") {
				$salida .= '<button class="btn btn-danger" id="btnEliminarServPre" idServ="' . $value['id'] . '"><i class="fa fa-trash"></i></button>
                <button class="btn btn-warning" id="btnEditarServPre" idServ="' . $value['id'] . '" data-toggle="modal" data-target="#modalEditarServicio"><i class="fa fa-edit"></i></button>';
			}
			$salida .= '


                <a href="index.php?ruta=servicios&precargado=' . $value['id'] . '" class="btn btn-dark"><i class="fa fa-plus-square"></i>
                </a>
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

/*=============================================
	
	=============================================*/
if (isset($_POST["idServicio"])) {

	$nota = new AjaxServicio();
	$nota->idServicio = $_POST["idServicio"];
	$nota->ajaxEditarNota();
}

if (isset($_POST["consulta"])) {

	$nota = new AjaxServicio();
	$nota->consulta = $_POST["consulta"];
	$nota->ajaxMostrarServicioPrecargado();
}

if (isset($_POST["borrarServicio"])) {

	$nota = new AjaxServicio();
	$nota->idServicio = $_POST["borrarServicio"];
	$nota->ajaxborrarServicioPrecargado();
}

if (isset($_POST["idServicioPre"])) {

	$nota = new AjaxServicio();
	$nota->idServicio = $_POST["idServicioPre"];
	$nota->ajaxMostrarServicioPrecargadoById();
}

if (isset($_POST["btnMandarCorreo"])) {
	$nota = new AjaxServicio();
	$nota->ajaxMandarCorreo();
}

if (isset($_POST['btnBuscarAbono'])) {
	$abonar = new AjaxServicio();
	$abonar->idServicio = $_POST['id_servicio'];
	$abonar->ajaxMostrarServicio();
}

if (isset($_POST['btnBuscarServicio'])) {
	$abonar = new AjaxServicio();
	$abonar->idServicio = $_POST['id_servicio'];
	$abonar->ajaxMostrarServicioOrden();
}

if (isset($_POST['btnAbonarServicio'])) {
	$abonar = new AjaxServicio();
	$abonar->ajaxAbonarServicio();
}

if (isset($_POST['btnEliminarAbono'])) {
	$abonar = new AjaxServicio();
	$abonar->ajaxEliminarAbono();
}

if (isset($_POST['btnEliminarServicio'])) {
	$abonar = new AjaxServicio();
	$abonar->ajaxEliminarServicio();
}
