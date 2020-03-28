<?php

/*if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}*/

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Soporte Softmor IFIXIT
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">ayuda</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">¿Exactamente qué ofrece ifixitmor?</h3>
        <div class="box-tools pull-right">
          <!-- Collapse Button -->
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        
        
        <div class="container mt-2 mb-4">
  <div class=" mb-4">
    <strong>
    Softmor Ifixit es un software</strong> con una interfaz de usuario amigable y facil de entender adaptado a las necesidades de tu laboratorio, cuenta con varios módulos los cuales te permitaran registrar diagnosticos, pedidos, ordenes, productos, categorias, ventas entre mucho más, una de las catarcteristicas principales es que al tener precencia en la web este mismo software puede ir escalando y con forme pase el tiempo ira en constante actualización dando paso a la posibilidad de añadir más módulos que la misma comunidad requiera.
    </div>
    
      <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Módulos con los que actualmente cuenta</li>
      </ol>
    </nav>
    <div class="row">
      <div class="col-12 col-md-6"></div>
     
      <div class="col-12 col-md-6 mt-2">

      
        <strong>
          <a class="btn btn-dark"  href="#panelControl" role="button" aria-expanded="false" aria-controls="panelControl">
            API`S
         </a>
        </strong>
        <div class=" mt-1" id="panelControl">
        <div class="card card-body text-dark">
          En softmor estamos trabajando para mejorar el servicio, proyecto ifixitmor no se queda atrás, pensamos que tú como dueño de un laboratorio  quieres darte a conocer, tus clientes quieren saber que productos tienes, que servicios ofreces, ellos también querrán hacerte cotizaciones en línea o hasta pedir productos a domicilio, déjalos impresionados con lo que puedes ofrecer, por eso nosotros ponemos a tu disposición un par de API`S que se conectan con nuestro software. Así es, la información que esta en nuestro sistema también puede estar en tu propio sitio Web.
        </div>
      </div>
      </div>
       
      
    
    </div>
    <div class="row">
     
      <div class="col-12 col-md-6 mt-2">
      
        <strong>
          <a class="btn btn-dark"  href="#panelControl" role="button" aria-expanded="false" aria-controls="panelControl">
            Consulta
         </a>
        </strong>
        <div class=" mt-1" id="panelControl">
        <div class="card card-body text-dark">
          Tus clientes pueden consultar el estado actual entre otra más información acerca del servicio, además de que se le mostrara tus redes sociales y sitio web y métodos de contacto.
        </div>
      </div>
      </div>
       <div class="col-12 col-md-6"></div>
      
    
    </div>
    
    <div class="row">
      <div class="col-12 col-md-6"></div>
      <div class="col-12 col-md-6 mt-2">
      
        <strong>
          <a class="btn btn-dark"  href="#panelControl" role="button" aria-expanded="false" aria-controls="panelControl">
            Panel de control
         </a>
        </strong>
        <div class=" mt-1" id="panelControl">
        <div class="card card-body text-dark">
          Este módulo te muestra información relacionada con tu suscripción y de manera general te permite configurar los datos de tu sucursal.
        </div>
      </div>
      </div>
      
    
    </div>
    <div class="row">
      
      <div class="col-12 col-md-6 mt-2">
      
        <strong>
          <a class="btn btn-dark"  href="#usuarios" role="button" aria-expanded="false" aria-controls="usuarios">
            Usuarios
         </a>
        </strong>
        <div class=" mt-1" id="usuarios">
        <div class="card card-body text-dark">
          Este módulo te muestra un listado de todos los usuarios que forman parte de la suscripción, así mismo la gestion de los suarios según el paquete que solicitaste.
        </div>
      </div>
      
      </div>
      <div class="col-12 col-md-6"></div>
    
    </div>
    <div class="row">
      <div class="col-12 col-md-6"></div>
      <div class="col-12 col-md-6 mt-2">
      
        <strong>
          <a class="btn btn-dark"  href="#categorias" role="button" aria-expanded="false" aria-controls="categorias">
            Categorías
         </a>
        </strong>
        <div class=" mt-1" id="categorias">
        <div class="card card-body text-dark">
          Este módulo te muestra un listado de todos las categorias que forman parte de tu sistema, así mismo la gestion de las categorías.
        </div>
      </div>
      
      </div>
      
    
    </div>
    <div class="row">
      
      <div class="col-12 col-md-6 mt-2">
      
        <strong>
          <a class="btn btn-dark"  href="#productos" role="button" aria-expanded="false" aria-controls="productos">
            Productos
         </a>
        </strong>
        <div class=" mt-1" id="productos">
        <div class="card card-body text-dark">
          Este módulo te muestra un listado de todos los productos que forman parte de tu sistema, así mismo la gestion de los productos.
        </div>
      </div>
      
      </div>
      <div class="col-12 col-md-6"></div>
    
    </div>
    <div class="row">
      <div class="col-12 col-md-6"></div>
      <div class="col-12 col-md-6 mt-2">
      
        <strong>
          <a class="btn btn-dark"  href="#clientes" role="button" aria-expanded="false" aria-controls="clientes">
            Clientes
         </a>
        </strong>
        <div class=" mt-1" id="clientes">
        <div class="card card-body text-dark">
          Este módulo te muestra un listado de todos los clientes de tu sistema, así mismo la gestion de los clientes.
        </div>
      </div>
      
      </div>
      
    
    </div>
    <div class="row">
      
      <div class="col-12 col-md-6 mt-2">
      
        <strong>
          <a class="btn btn-dark"  href="#cotizaciones" role="button" aria-expanded="false" aria-controls="cotizaciones">
            Cotizaciones
         </a>
        </strong>
        <div class=" mt-1" id="cotizaciones">
        <div class="card card-body text-dark">
          En este módulo puedes encontrar un listado de todas las cotizaciones que se hicieron, permitiendo a los usuarios del sistema ver a detalle las fallas que se diagnosticaron entre otras caracteristcas imprtantes.
        </div>
      </div>
      
      </div>
      <div class="col-12 col-md-6"></div>
      
    
    </div>
    <div class="row">
      <div class="col-12 col-md-6"></div>
      <div class="col-12 col-md-6 mt-2">
      
        <strong>
          <a class="btn btn-dark"  href="#pedidos" role="button" aria-expanded="false" aria-controls="pedidos">
            Pedidos
         </a>
        </strong>
        <div class=" mt-1" id="pedidos">
        <div class="card card-body text-dark">
          En este módulo puedes guardar los pedidos que tus clientes te vayan haciendo, este módulo es muy útil cuando no tienes inventrio de cierto producto que te estan solictando tus clientes, igual podras encontrar un listado de todos los pedidos así mismo su gestión.
        </div>
      </div>
      
      </div>
      
      
    
    </div>
    <div class="row">
      
      <div class="col-12 col-md-6 mt-2">
      
        <strong>
          <a class="btn btn-dark"  href="#servicios" role="button" aria-expanded="false" aria-controls="servicios">
            Servicios
         </a>
        </strong>
        <div class=" mt-1" id="servicios">
        <div class="card card-body text-dark">
          En este módulo podras levantar las ordenes de servicio, cuenta con los campos necesarios para llenar una orden completa y de igual manera te muestra un listado de los servicios levantados anteriormente así mismo su gestión, la cual te permite mantener actualizados  a los usuarios sobre el estado actual del servicio.
        </div>
      </div>
      
      </div>
      
      <div class="col-12 col-md-6"></div>
    
    </div>
    <div class="row">
      <div class="col-12 col-md-6"></div>
      <div class="col-12 col-md-6 mt-2">
      
        <strong>
          <a class="btn btn-dark"  href="#ventas" role="button" aria-expanded="false" aria-controls="ventas">
            Ventas
         </a>
        </strong>
        <div class=" mt-1" id="ventas">
        <div class="card card-body text-dark">
          Este módulo te muestra un listado de todas las ventas que se van haciendo, te muestra las ventas del día o las que se le indique en una fecha, también te muestra reportes graficos de los vendedores y clientes más activos de tu sucursal y te da un listado en formato excel de tus ventas.
        </div>
      </div>
      
      </div>
      
      
    
    </div>
    <div class="row">
      
      <div class="col-12 col-md-6 mt-2">
      
        <strong>
          <a class="btn btn-dark"  href="#corte" role="button" aria-expanded="false" aria-controls="corte">
            Corte de ventas
         </a>
        </strong>
        <div class=" mt-1" id="corte">
        <div class="card card-body text-dark">
          Este módulo te da un listado de todos los cortes que se hicieron, te muestra información como ventas hasta el día del corte, faltantes y sobrantes de caja.
        </div>
      </div>
      
      </div>
      
      <div class="col-12 col-md-6"></div>
    
    </div>

    
    

</div>
      </video>
       
      </div>
      <!-- /.box-body -->
     
      <!-- box-footer -->
  </div>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Uso del módulo de cotizaciones</h3>
        <div class="box-tools pull-right">
          <!-- Collapse Button -->
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        
        
        <video width="400" controls>
        <source src="vistas/videos/cotizaciones.mp4" type="video/mp4">
      </video>
       
      </div>
      <!-- /.box-body -->
     
      <!-- box-footer -->
  </div>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">¿Por qué no me aparecen todas las opciones del menu?</h3>
        <div class="box-tools pull-right">
          <!-- Collapse Button -->
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        Su usuario tiene el rol de vendedor, por seguridad unas opciones y configuraciones estan inabilitadas. 
      </div>
      <!-- /.box-body -->
     
      <!-- box-footer -->
  </div>
  <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">¿Qué pasa si renuevo mi suscripción antes de que termine?</h3>
        <div class="box-tools pull-right">
          <!-- Collapse Button -->
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        No te preocupes tu suscripción nueva empieza el día que termina la anterior. 
      </div>
      <!-- /.box-body -->
     
      <!-- box-footer -->
  </div>
  <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Sólo el perfil de administrador tiene todos los permisos</h3>
        <div class="box-tools pull-right">
          <!-- Collapse Button -->
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        El usuario que tenga el rol de administrador tendra el control total del sistema mientras que el de vendedor solo tendra permisos de lectura. 
      </div>
      <!-- /.box-body -->
     
      <!-- box-footer -->
  </div>
<!-- /.box -->
  
  </section>

</div>



 


