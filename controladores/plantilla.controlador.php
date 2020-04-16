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
			'suscripcion-1'
		);

		return $whitList;
	}
}
