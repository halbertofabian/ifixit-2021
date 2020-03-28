<aside class="main-sidebar">

	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<?php

				if ($_SESSION["foto"] != "") {

					echo '<img src="' . $_SESSION["foto"] . '" class="img-circle">';
				} else {


					echo '<img src="vistas/img/usuarios/default/anonymous.png" class="img-circle">';
				}
				?>

			</div>
			<div class="pull-left info">
				<p><?php echo $_SESSION["usuario"]; ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<ul class="sidebar-menu">

			<?php

			if ($_SESSION["perfil"] == "Administrador") {

				echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			
					';





				echo '

			</li>
			
			<li>

				<a href="configuraciones">

					<i class="fa fa-cog"></i>
					<span>Personalizar</span>

				</a>

			</li>
			<li>

				<a href="api">

					<i class="fa fa-cubes"></i>
					<span>Mi API</span>

				</a>

			</li>

			<li>

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>
			
			';
			}

			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Auxiliar") {

				echo '<li>

				<a href="categorias">

					<i class="fa fa-th"></i>
					<span>Categorías</span>

				</a>

			</li>
			
			

			<li>

				<a href="productos">

					<i class="fa fa-cart-plus"></i>
					<span>Productos</span>

				</a>

			</li>
			
			
			<li>

				<a href="intercambios">

					<i class="fa fa-truck text-danger"></i>
					<span>Intercambio de inventario</span>

				</a>

			</li>';
			}

			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor") {

				echo '

				</li>
				<li>

				<a href="caja">

					<i class="fas fa-cash-register"></i>
					<span>Caja de venta</span>

				</a>

			</li>
			<li class="treeview">

				<a href="#">

					<i class="fa fa-dollar"></i>
					
					<span>Gestión</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu nav-dark">
					
				<li>

				<a href="corte">

				<i class="fa fa-circle-o"></i>
				<span>Corte de caja</span>

			</a>

			</li>

					<li>

						<a href="ingresos">
							
							<i class="fa fa-circle-o"></i>
							<span>Ingresos</span>

						</a>

					</li>
					<li>

						<a href="egresos">
							
							<i class="fa fa-circle-o"></i>
							<span>Gastos</span>

						</a>

					</li>';
				if ($_SESSION["perfil"] == "Administrador") {
					echo '<li>

						<a href="movimientos">
							
							<i class="fa fa-circle-o"></i>
							<span>Movimientos</span>

						</a>

					</li>';
				}





				echo '</ul>
			
			
			<li>

				<a href="clientes">

					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>

			</li>
			<li class="treeview">

				<a href="#">

					<i class="fa fa-money"></i>
					
					<span>Cotizaciones</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu nav-dark">
					
					<li>

						<a href="cotizaciones">
							
							<i class="fa fa-circle-o"></i>
							<span>Cotizaciones</span>

						</a>

					</li>

					<li>

						<a href="lista-cotizaciones">
							
							<i class="fa fa-circle-o"></i>
							<span>Lista de cotizaciones</span>

						</a>

					</li>

					
				
					';





				echo '</ul>

			</li>
			<li class="treeview">

				<a href="#">

					<i class="fa  fa-opencart"></i>
					
					<span>Pedidos</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu nav-dark">
					
					<li>

						<a href="pedidos">
							
							<i class="fa fa-circle-o"></i>
							<span>Pedidos</span>

						</a>

					</li>

					<li>

						<a href="lista-pedidos">
							
							<i class="fa fa-circle-o"></i>
							<span>Lista de pedidos</span>

						</a>

					</li>
				</ul>
			</li>		
			<li class="treeview">

				<a href="#">

					<i class="fa fa-wrench"></i>
					
					<span>Servicios</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu nav-dark">
					
					<li>

						<a href="servicios">
							
							<i class="fa fa-circle-o"></i>
							<span>Servicios</span>

						</a>

					</li>

					<li>

						<a href="entregas">
							
							<i class="fa fa-circle-o"></i>
							<span>Lista de servicios</span>

						</a>

					</li>
					<li>

						<a href="agregar-servicio">
							
							<i class="fa fa-wrench"></i>
							<span>Precargar servicio</span>

						</a>

					</li>

					
				
					';





				echo '</ul>

			</li>
			
			
			
			
			
			

			';
			}
			

			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor") {

				echo '
			
			<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu nav-dark">
					
					<li>

						<a href="ventas">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar ventas</span>

						</a>

					</li>

					<li>

						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear venta</span>

						</a>

					</li>

					
				
					';

				if ($_SESSION["perfil"] == "Administrador") {

					echo '<li>

						<a href="reportes">
							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de ventas</span>

						</a>

					</li>';
				}



				echo '</ul>

			</li>
					
					
			';
			}

			?>

		</ul>

	</section>

</aside>