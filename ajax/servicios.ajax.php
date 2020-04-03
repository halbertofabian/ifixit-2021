<?php

session_start();
require_once "../controladores/servicios.controlador.php";
require_once "../modelos/servicios.modelo.php";
require_once "../modelos/corte.modelo.php";
require_once "../modelos/gastos.modelo.php";
require_once "../modelos/movimientos.modelo.php";
require_once "../controladores/movimientos.controlador.php";


	if (isset($_GET['orden']) && isset($_GET['estado'])) {
		$res = ControladorServicios::ctrCambiarEstadoEquipo($_GET['estado'],$_SESSION['nombre'],$_GET['orden'],$_GET['anticipo'],$_GET['nota']);
		if($res){
			
			header("location:../entregas");
		}else{
			
		}

	    

	}
	if(isset($_GET['servicio'])){
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

		public function ajaxEditarNota(){

		
		$valor = $this->idServicio;

		$respuesta = ControladorServicios::ctrMostrarNota($valor);

		echo json_encode($respuesta);

		}
		public function ajaxborrarServicioPrecargado(){

		
		$valor = $this->idServicio;

		$respuesta = ModeloServicios::mdlEliminarServicioPre($valor);

		echo json_encode($respuesta);

		}

		public function ajaxMostrarServicioPrecargadoById(){

		
		$valor = $this->idServicio;

		$respuesta = ModeloServicios::MdlMostrarServcioPrecargado($valor);

		echo json_encode($respuesta);
		}


		public function ajaxMostrarServicioPrecargado(){

		
		$valor = $this->consulta;

		$respuesta = ControladorServicios::ctrMostrarServciosPrecargados($valor);

		$salida = "";

			foreach ($respuesta as $key => $value){
            $salida .='<div class="col-lg-3 col-xs-6">
            <!-- small card -->
            
            <div class="small-box bg-light">
              <div class="inner">
                <h3 class="text-dark">$'.$value["precio"].'</h3>

                <p class="text-success"><strong>'.$value['nombre'].'</strong></p>
                <p><strong>'.$value['marca'].'</strong></p>
                <p><strong>'.$value['modelo'].'</strong></p>
                <p>'.$value['tipo_equipo'].'</p>
              </div>

              <a href="index.php?ruta=servicios&precargado='.$value['id'].'"><div class="icon">
                <i class="fa fa fa-wrench"></i>
              </div>
              </a>

              <div class="btn-group" style="padding: 5px">
              ';
              if($_SESSION['perfil']=="Administrador"){
              	$salida .= '<button class="btn btn-danger" id="btnEliminarServPre" idServ="'.$value['id'].'"><i class="fa fa-trash"></i></button>
                <button class="btn btn-warning" id="btnEditarServPre" idServ="'.$value['id'].'" data-toggle="modal" data-target="#modalEditarServicio"><i class="fa fa-edit"></i></button>';
              }
                $salida .= '


                <a href="index.php?ruta=servicios&precargado='.$value['id'].'" class="btn btn-dark"><i class="fa fa-plus-square"></i>
                </a>
              </div>

              
            </div>
        </div>';
      		}
      		if($salida == ""){
      			echo '
      			<div class="col-12 col-md-12">
	      			<div class="alert alert-link text-center">
					<strong>No se encontaron resultados :( </strong>
					</div>
				</div>	
			';
      		}else{
      			echo $salida;
      		}
      		

		}
	}

	/*=============================================
	
	=============================================*/	
	if(isset($_POST["idServicio"])){

		$nota = new AjaxServicio();
		$nota -> idServicio = $_POST["idServicio"];
		$nota -> ajaxEditarNota();
	}

	if(isset($_POST["consulta"])){

		$nota = new AjaxServicio();
		$nota -> consulta = $_POST["consulta"];
		$nota -> ajaxMostrarServicioPrecargado();
	}

	if(isset($_POST["borrarServicio"])){

		$nota = new AjaxServicio();
		$nota -> idServicio = $_POST["borrarServicio"];
		$nota -> ajaxborrarServicioPrecargado();
	}

	if(isset($_POST["idServicioPre"])){

		$nota = new AjaxServicio();
		$nota -> idServicio = $_POST["idServicioPre"];
		$nota -> ajaxMostrarServicioPrecargadoById();
	}






