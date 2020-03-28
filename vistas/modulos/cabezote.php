<?php
/*$suscripcion = SuscripcionContrlador::ctrObternerEstadoSuscripcion();
    //var_dump($suscripcion);
   if($suscripcion["estado_suscripcion"]==0){
      header("location:suscripcion");

   }*/
?>

<style>
	.btn-pull {
		float: left;
		color: #000;

		padding: 15px;




	}

	.btn-dark {
		background: #fff;
		color: #222D32;
		transition: .7s;
	}

	.btn-dark-inverse {
		background: #222D32;
		color: #fff;
		transition: .7s;
	}

	.nav-dark {
		background: #fff;
		color: #222D32;
	}

	.btn-dark:hover {
		background: #222D32;
		color: #fff;
	}

	.btn-dark-inverse:hover {
		background: #fff;
		color: #222D32;
	}

	.btn-active {
		background: #222D32;
		color: #fff;
		/*border-left: solid 4px #7FC86A;*/

	}

	.sidebar-menu li a:hover {
		background: #222D32;
		color: #fff;
	}

	label {
		color: grey;
	}

	#form-calif input[type="radio"] {
		display: none;
	}

	.clasificacion {
		direction: rtl;
		/* right to left */
		unicode-bidi: bidi-override;
		/* bidi de bidireccional */
	}

	#form-calif label:hover {
		color: orange;
	}

	#form-calif label:hover~label {
		color: orange;
	}

	#form-calif input[type="radio"]:checked~label {
		color: orange;
	}

	#form-calif p {
		text-align: center;
	}

	#form-calif label {
		font-size: 24px;
	}
</style>
<header class="main-header ">

	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="inicio" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini">
			<img src="vistas/img/plantilla/ifixit_x.png" alt="" width="30">
		</span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><img src="vistas/img/plantilla/ifixit.png" alt="" width="50"></span>
	</a>



	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="nav-dark navbar-static-top" role="navigation">


		<!-- Botón de navegación -->

		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="color: #000">

			<span class="sr-only">Toggle navigation</span>

		</a>

		<?php if ($_SESSION['perfil'] != "Tecnico") : ?>
			<div class="btn-group">

				<?php if (isset($_GET['ruta'])) : ?>
					<?php if ($_GET['ruta'] == 'servicios') :
					?>
						<a href="servicios" class=" btn btn-active  btn-pull"><i class="fa fa-wrench"></i> Crear Servicio</a>

					<?php
					else : ?>
						<a href="servicios" class=" btn btn-dark btn-pull"><i class="fa fa-wrench"></i> Crear Servicio</a>
					<?php endif; ?>
					<?php if ($_GET['ruta'] == 'crear-venta') :
					?>
						<a href="crear-venta" class="btn btn-active btn-pull "><i class="fa fa-cart-arrow-down"></i> Crear venta</a>

					<?php
					else : ?>
						<a href="crear-venta" class="btn btn-dark btn-pull "><i class="fa fa-cart-arrow-down"></i> Crear venta</a>
					<?php endif; ?>
					<?php if ($_GET['ruta'] == 'entregas') :
					?>

						<ul class="nav navbar-nav">

							<li class="dropdown user user-menu">

								<a href="#" class=" btn btn-active  btn-pull  dropdown-toggle" data-toggle="dropdown"><i class="fa fa-archive"></i> Entregas</a>



								<ul class="dropdown-menu list-group">

									<li class="list-group-item">


										<a href="entregas" class="">Servicios</a>


									</li>
									<li class="list-group-item">


										<a href="lista-pedidos" class="">Pedidos</a>


									</li>






								</ul>

							</li>

						</ul>

					<?php
					else : ?>

						<ul class="nav navbar-nav">

							<li class="dropdown user user-menu">

								<a href="#" class="btn btn-dark btn-pull dropdown-toggle" data-toggle="dropdown"><i class=" fa fa-archive"></i> Entregas</a>



								<ul class="dropdown-menu list-group">

									<li class="list-group-item">


										<a href="entregas" class="">Servicios</a>


									</li>
									<li class="list-group-item">


										<a href="lista-pedidos" class="">Pedios</a>


									</li>






								</ul>

							</li>

						</ul>
					<?php endif; ?>
					<?php if ($_GET['ruta'] == 'agregar-servicio') :
					?>
						<a href="agregar-servicio" class=" btn btn-active  btn-pull"><i class="far fa-address-card"></i> Servicio Precargado</a>

					<?php
					else : ?>
						<a href="agregar-servicio" class=" btn btn-dark btn-pull"><i class="far fa-address-card"></i> Servicio Precargado</a>
					<?php endif; ?>
				<?php endif; ?>
				<!--<button class="btn btn-dark btn-pull">a</button>
	      	<button class="btn btn-dark btn-pull">b</button>
	      	<button class="btn btn-dark btn-pull">c</button>-->
			</div>
		<?php endif; ?>



		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">

			<ul class="nav navbar-nav">
				<li class="user-body">
					<a href="changeUser">
						<i class="fas fa-user-friends"></i> Cambio de usuario
					</a>

				</li>

				<li class="dropdown user user-menu">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown">




						<i class="fa fa-university"></i>
						<span class="hidden-xs"><?php echo $_SESSION["nom_suc"]; ?></span>

					</a>

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu">


						<li class="user-body">
							<form action="#" method="post">
								<div class="form-group">
									<label for="my-input">Seleccione una sucursal</label>
									<select name="ingSucursal" class="form-control" id="">
										<?php $susc = ControladorSucursal::ctrMostrarSucursalPropietario($_SESSION["suscriptor"]); ?>

										<?php foreach ($susc as $key => $item) : ?>
											<option value="<?php echo $item['nombre'] ?>"><?php echo $item['nombre'] ?></option>
										<?php endforeach; ?>
									</select>
									<br>
									<button type="submit" name="btnCambiarSucursal" class="btn btn-primary  pull-right">Acceder</button>
								</div>
								<?php

								$login = new ControladorUsuarios();
								$login->ctrCambiarSucursal();

								?>

							</form>
						</li>


					</ul>

				</li>

			</ul>
			<ul class="nav navbar-nav">



				<li>
					<a href="ayuda">
						<i class="fa  fa-info-circle"></i>
						<strong>Ayuda</strong>
					</a>
				</li>
				<li class="dropdown notifications-menu">

					<a href="#" class="" data-toggle="modal" data-target="#mdlActualizaciones">
						<i class="fa fa-bell-o"></i>
						<span class="label label-primary">3</span>
					</a>

				</li>
			</ul>

			<ul class="nav navbar-nav">

				<li class="dropdown user user-menu">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						<?php

						if ($_SESSION["foto"] != "") {

							echo '<img src="' . $_SESSION["foto"] . '" class="user-image">';
						} else {


							echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
						}


						?>

						<span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>

					</a>

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu">





						<li class="user-body">


							<a href="suscripcion" class="btn btn-block btn-link btn-flat">
								<i class="fas fa-globe-europe"> </i>
								Mi suscripción</a>



						</li>
						<li class="user-body">

							<form action="" method="post">




								<button type="submit" name="btnBloquearUsuario" class="btn btn-block btn-link btn-flat">
									<i class="fas fa-user-lock"> </i>
									Bloquear sesión</button>


								<?php
								$bloquear = new ControladorUsuarios();

								$bloquear->ctrBloaquearUsusario() ?>
							</form>

						</li>
						<li class="user-body">



							<a href="salir" class="btn btn-block btn-link btn-flat"><i class="fas fa-sign-out-alt"> </i> Salir</a>


						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

</header>

<br>


<!-- Modal -->
<div class="modal fade" id="mdlActualizaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-secondary">
				<h3 class="modal-title" id="exampleModalLabel">Hay 3 nuevas Actualizaciones </h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 col-12">
						<div class="card">
							<div class="card-header">
								<div class="alert alert-info" role="alert">
									<h4 class="alert-heading">Información</h4>
									Algunos cambios en el sistema tardan en llegar a tu navegador, puedes hacer la actualización manual con la combinación de teclas
									<br>
									<o>
										<li>
											Mac: <strong>cmd + shift + R</strong>
										</li>
										<li>
											Windows: <strong>ctr + shift + R o F5 + R</strong>
										</li>
									</o>
								</div>

							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item">Ticket en formato media carta y carta entera</li>
								<li class="list-group-item">Agrega precio de mayoreo a tus<a  href="<?php ControladorPlantilla::getRute() ?>productos"> Productos</a>  </li>

								<li class="list-group-item">Venta a mayoreo <a  href="<?php ControladorPlantilla::getRute() ?>crear-venta">Crear venta</a> o <a  href="<?php ControladorPlantilla::getRute() ?>caja">Caja</a> </li>
								<li class="list-group-item">Agrega tu logo a todos tus tickets de venta</li>


							</ul>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<p class="text-center text-info">Estamos actualizando el sistema cada semana para ofrecerte un servicio de calidad, gracias por las sugerencias que nos has hecho. Si tienes una observación u otra sugerencia con mucho gusto nos gustaría escucharte</p>
				<h5 class="" style="text-align: left"> <strong>¿Te gustaría dejarnos una reseña?</strong></h5>
				<form action="" id="form-calif" method="post">
					<textarea name="resena_text" id="resena_text" cols="30" rows="5" class="form-control" placeholder="Escribe aquí tu reseña, nos ayudarías mucho a crecer 😚" ></textarea>
					<p class="text-center"> <strong>¿ De 1 a 5 estrellas como calificas nuestro servicio ?</strong> </p>
					<p class="clasificacion">
						
						<input id="radio1" type="radio" name="resena_calif" value="5">

						<label for="radio1">★</label>

						<input id="radio2" type="radio" name="resena_calif" value="4">

						<label for="radio2">★</label>

						<input id="radio3" type="radio" name="resena_calif" value="3">

						<label for="radio3">★</label>

						<input id="radio4" type="radio" name="resena_calif" value="2">

						<label for="radio4">★</label>

						<input id="radio5" type="radio" name="resena_calif" value="1">

						<label for="radio5">★</label>
					</p>
					<div class="form-group">
						<button type="submit" class="btn btn-primary pull-right" name="btnEnviarResena" >Enviar</button>
					</div>
					<?php 

						$resena = new ControladorUsuarios();
						$resena -> ctrEnviarResena();
						
					?>
				</form>

			</div>

		</div>
	</div>
</div>