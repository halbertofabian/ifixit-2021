<?php

class ControladorPlantilla
{

	static public function ctrPlantilla()
	{
		$url = ControladorPlantilla::getRute();
		$app = new ControladorPlantilla();
		include "vistas/app.php";
	}

	static function getRute()
	{
		return APP_URL;
	}


	//function que trae los componentes
	public function getComponents($comp, $rutas = "")
	{
		//mandar a traer un metodo se usa :: porque nos retorna 
		$url = ControladorPlantilla::getRute();
		$app = new ControladorPlantilla();
		include_once 'vistas/componentes/' . $comp . '.componente.php';
	}

	//function que cargara la pagina
	public function getPage($page, $rutas = "")
	{
		//mandar a traer un metodo se usa :: porque nos retorna 
		$url = ControladorPlantilla::getRute();
		$app = new ControladorPlantilla();
		include_once 'vistas/modulos/' . $page . '.php';
	}

	//crear lista blanca
	public static function getWhiteList()
	{
		$whitList = array(
			'inicio',
			'usuarios',
			'categorias',
			'productos',
			'clientes',
			'ventas',
			'ventas-may',
			'crear-venta',
			'editar-venta',
			'reportes',
			'servicios',
			'pedidos',
			'entregas',
			'corte',
			'envios',
			'notas',
			'equipos-detalle',
			'cotizaciones',
			'configuraciones',
			'lista-cotizaciones',
			'lista-pedidos',
			'suscripcion',
			'ayuda',
			'api',
			'agregar-servicio',
			'actualizaciones',
			'refacciones',
			'egresos',
			'movimientos',
			'ingresos',
			'intercambios',
			'look',
			'caja',
			'block',
			'changeUser',
			'sucursal',
			'refacciones',
			'salir',
			'mi-web',
			'slide',
			'suscripcion-1',
			'modulos',
			'acceso'
		);

		return $whitList;
	}

	public static function generarQR($valor)
	{


		$nom_suc =  strtolower(str_replace(' ', '-', trim($_SESSION['nom_suc'])));

		$dir = '../../../vistas/img/qr_generator/' . $nom_suc . '';
		//Si no existe la carpeta la creamos
		if (!file_exists($dir))
			mkdir($dir, 0777, true);

		//Declaramos la ruta y nombre del archivo a generar

		$filename = $dir . "/s" .   '.png';

		$tamaño = 10; //Tamaño de Pixel
		$level = 'H'; //Precisión Máxima
		$framSize = 3; //Tamaño en blanco
		$contenido = 'https://ifixitmor.com/s/' . $nom_suc . '/consulta-s/' . $valor; //Texto

		//Enviamos los parametros a la Función para generar código QR 
		return QRcode::png($contenido, $filename, $level, $tamaño, $framSize);
	}
}
