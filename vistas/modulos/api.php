<?php

/*if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}*/

?>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h3 class="display-5">Mi API</h3>
    <p class="lead">Servicios de consulta que puedes integrar en tu sitio web, como ordenes de servicio, productos</p>
  </div>
</div>

<section class="container">

  <div class="card">
    <div class="card-header with-border">
      <h3 class="card-title">Información </h3>
      <div class="card-tools pull-right">
        <!-- Collapse Button -->
        <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse">
          <i class="fas fa-minum"></i>
        </button>

      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">


      <p>En softmor estamos trabajando para mejorar el servicio, proyecto ifixitmor no se queda atrás, pensamos que tú como dueño de un laboratorio quieres darte a conocer, tus clientes quieren saber que productos tienes, que servicios ofreces, ellos también querrán hacerte cotizaciones en línea o hasta pedir productos a domicilio, déjalos impresionados con lo que puedes ofrecer, por eso nosotros ponemos a tu disposición un par de API`S que se conectan con nuestro software. Así es, la información que esta en nuestro sistema también puede estar en tu propio sitio Web.</p>

      <p><strong>APIKEY: </strong><?php echo $_SESSION['suscriptor'] ?></p>
      <p><strong>Sucursal: </strong><?php echo $_SESSION['nom_suc'] ?></p>


      <!--<pre>
        <code style=" color: #000">
		
    	&lt;?php 
    		function API($APIKEY,$sucursal) {
    			$url = "https://apifixit.softmormx.com/products?apikey=$APIKEY&sucursal=$sucursal";
			
			return $url;
    		}

    		$api = API('636356267252656gf6GS5');
    		$json =  file_get_contents($api);

    	?&gt;
		</code>
		</pre>-->



    </div>
    <!-- /.card-body -->

    <!-- card-footer -->
  </div>
  <div class="card collapsed-card">
    <div class="card-header with-border">
      <h3 class="card-title">Productos</h3>
      <div class="card-tools pull-right">
        <!-- Collapse Button -->
        <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse">
          <i class="fas fa-plus"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">

      <p>Ejemplo:</p>
      <a target="_blanck" href="http://apifixit.softmormx.com/productos.php/c81b5136bcd10b4390108c979ed28ee6/softmx">
        <code style=" color: #000">

          https://apifixit.softmormx.com/productos.php/APIKEY/sucursal
        </code></a>
      <p> Mi api:</p>
      <a target="_blanck" href="http://apifixit.softmormx.com/productos.php/<?php echo $_SESSION['suscriptor'] ?>/<?php echo $_SESSION['nom_suc'] ?>">
        <code style=" color: #000">

          http://apifixit.softmormx.com/productos.php/<?php echo $_SESSION['suscriptor'] ?>/<?php echo $_SESSION['nom_suc'] ?>
        </code>

      </a>





    </div>
    <!-- /.card-body -->

    <!-- card-footer -->
  </div>
  <div class="card collapsed-card">
    <div class="card-header with-border">
      <h3 class="card-title">Consulta servicio</h3>
      <div class="card-tools pull-right">
        <!-- Collapse Button -->
        <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse">
          <i class="fas fa-plus"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">

      <p>Ejemplo</p>
      <a href="http://apifixit.softmormx.com/servicios.php/c81b5136bcd10b4390108c979ed28ee6/softmx/bd4c46a6" target="_blanck">
        <code style=" color: #000">

          https://apifixit.softmormx.com/servicios.php/APIKEY/sucursal/codigo
        </code>
      </a>



    </div>
    <!-- /.card-body -->

    <!-- card-footer -->
  </div>
  <div class="card collapsed-card">
    <div class="card-header with-border">
      <h3 class="card-title">Cotizaciones en linea</h3>
      <div class="card-tools pull-right">
        <!-- Collapse Button -->
        <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse">
          <i class="fas fa-plus"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">


      <a href="#" target="_blanck">
        <code style=" color: #000">

          Próximamente...
        </code>
      </a>



    </div>
    <!-- /.card-body -->

    <!-- card-footer -->
  </div>
  <div class="card collapsed-card">
    <div class="card-header with-border">
      <h3 class="card-title">Pedidos en linea</h3>
      <div class="card-tools pull-right">
        <!-- Collapse Button -->
        <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse">
          <i class="fas fa-plus"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">


      <a href="#" target="_blanck">
        <code style=" color: #000">

          Próximamente...
        </code>
      </a>



    </div>
    <!-- /.card-body -->

    <!-- card-footer -->
  </div>

  <div>
    <span>¿Como implementar la api en mi sitio web?</span>
    <div class="text-primary">Puedes contactar a alguién de soporte, para agendar un día e implementemos la api a tu sitio web.</div>

  </div>



</section>