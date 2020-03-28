<?php 
	session_start();




	header('Content-type:application/xls');
	header('Content-Disposition: attachment; filename=file.xls');

	require_once "../controladores/categorias.controlador.php";
	require_once "../modelos/categorias.modelo.php";
	require_once "../controladores/productos.controlador.php";
	require_once "../modelos/productos.modelo.php";
	require_once "../controladores/clientes.controlador.php";
	require_once "../modelos/clientes.modelo.php";


	if(isset($_GET['categoria'])):

	$categorias = ControladorCategorias::exportExcelCategorias();
	echo utf8_decode('<table style="text-align: center;">
	<tr>
		<th>Código</th>
		<th>Categoría</th>
		<th>Fecha creación</th>
		
	</tr>');
?>

	<?php
		foreach ($categorias as  $value) {
		 	
		
			
				echo utf8_decode('<tr>
					<td>'. $value['id'].'</td>
					<td>'. $value['categoria'].'</td>
					<td>'. $value['fecha'].'</td>
					
				</tr>');	

			
		}
		echo "</table>";
	
	elseif(isset($_GET['producto'])):
		
		if($_GET['categoriaP']=="todo"){
			$productos = ControladorProductos::exportExcelProductos(null,null,"id");
		}else{
			
			$productos = ControladorProductos::exportExcelProductos("id_categoria",$_GET['categoriaP'],"id");
		}
		

		echo utf8_decode('<table style="text-align: center;">
	<tr>
		<th>Codigo</th>
		<th>Descripción</th>
		<th>Categoría</th>
		<th>Cantidad</th>
		<th>Precio compra</th>
		<th>Precio venta</th>
		<th>Ganancia</th>
		<th>Agregado</th>
		
	</tr>');


		foreach ($productos as  $value) {
		 	
		 		echo utf8_decode('<tr>
					<td>'.$value["codigo"].'</td>
					<td>'.$value["descripcion"].'</td>
					<td>'.$value["id_categoria"].'</td>
					<td>'.$value["stock"].'</td>
					<td>'.$value["precio_compra"].'</td>
					<td>'.$value["precio_venta"].'</td>
					<td>'.($value["precio_venta"] - $value["precio_compra"]).'</td>
					<td>'.$value["fecha"].'</td>
					
				</tr>');
		
			
		}
		echo "</table>";

		elseif(isset($_GET['cliente'])):
		$clientes = ControladorClientes::exportExcelClientes();

		//var_dump($clientes);

		echo utf8_decode('<table style="text-align: center;">
	<tr>
		<th>Nombre</th>
		<th>ID Documento</th>
		<th>Email</th>
		<th>Teléfono</th>
		<th>Dirección</th>
		<th>Fecha nacimiento</th>
		<th>Total compras</th>
		<th>Última compra</th>
		<th>Ingreso al sistema</th>
		
	</tr>');

 
		foreach ($clientes as  $value) {
		 	
		 		echo utf8_decode('<tr>
					<td>'.$value["nombre"].'</td>
					<td>'.$value["documento"].'</td>
					<td>'.$value["email"].'</td>
					<td>'.$value["telefono"].'</td>
					<td>'.$value["direccion"].'</td>
					<td>'.$value["fecha_nacimiento"].'</td>
					<td>'.$value["compras"].'</td>
					<td>'.$value["ultima_compra"].'</td>
					<td>'.$value["fecha"].'</td>
					
				</tr>');
		
			
		}
		echo "</table>";
	


 endif; ?>
