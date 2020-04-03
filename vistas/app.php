<?php

session_start();


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>APP IFIXIT- DASHBOARD</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <meta name="description" content="Sistema gestor de ordenes, servicio de punto de venta">

  <meta name="keyword" content="Punto de venta, software ifixit softmor ordenes ventas, productos, ordenes reparacion de queipos">

  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">


  <meta property="og:title" content="softmor">
  <meta property="og:url" content="https://www.softmor.com/">
  <meta property="og:description" content="Sistema gestor de ordenes, servicio de punto de venta">
  <meta property="og:image" content="<?php echo $url ?>vistas/img/plantilla/ifixit_x.png">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Softmor">
  <meta property="og:locale" content="es_MX">

  <meta name="description" content="DESARROLLO Y DISEÑO
-Aplicaciones Móviles
--Aplicaciones Informativas
--Tienda online y APP
-Desarrollo Web
--Páginas web InformátiSvas
--Foros
--Blogs
-Aplicaciones Web y Sistemas
--Sistema de reservas y sitio web Hotelero.
--Sistema para Doctores.
--Sistema de reserva para agencia de viajes.
--Tiendas Online
--Sistema Punto de Venta y Tienda Online
--Sistema de bienes raíces y sitio web.
--Sistema y sitio web Abogados.
--Sistema administrativo.
PUNTOS DE VENTA 
-Punto de venta
-Punto de venta + tienda online
-Tienda online + aplicación
VOZ Y DATOS
-Instalación de redes Wifi &amp; Lan
-Servidores
-Cámaras IP
-Cámaras CCTV
-Acces point de Internet
REPARACIÓN Y DESBLOQUEO
-Liberación de móviles
-Reparación de dispositivos móviles
-Reparación de equipos de computo
-Electrónica general
-Desbloqueo
FORO
" />

  <meta name="keywords" content="DESARROLLO Y DISEÑO
-Aplicaciones Móviles
--Aplicaciones Informativas
--Tienda online y APP
-Desarrollo Web
--Páginas web InformátiSvas
--Foros
--Blogs
-Aplicaciones Web y Sistemas
--Sistema de reservas y sitio web Hotelero.
--Sistema para Doctores.
--Sistema de reserva para agencia de viajes.
--Tiendas Online
--Sistema Punto de Venta y Tienda Online
--Sistema de bienes raíces y sitio web.
--Sistema y sitio web Abogados.
--Sistema administrativo.
PUNTOS DE VENTA 
-Punto de venta
-Punto de venta + tienda online
-Tienda online + aplicación
VOZ Y DATOS
-Instalación de redes Wifi &amp; Lan
-Servidores
-Cámaras IP
-Cámaras CCTV
-Acces point de Internet
REPARACIÓN Y DESBLOQUEO
-Liberación de móviles
-Reparación de dispositivos móviles
-Reparación de equipos de computo
-Electrónica general
-Desbloqueo
FORO
" />
  <meta property="og:description" content="DESARROLLO Y DISEÑO
-Aplicaciones Móviles
--Aplicaciones Informativas
--Tienda online y APP
-Desarrollo Web
--Páginas web InformátiSvas
--Foros
--Blogs
-Aplicaciones Web y Sistemas
--Sistema de reservas y sitio web Hotelero.
--Sistema para Doctores.
--Sistema de reserva para agencia de viajes.
--Tiendas Online
--Sistema Punto de Venta y Tienda Online
--Sistema de bienes raíces y sitio web.
--Sistema y sitio web Abogados.
--Sistema administrativo.
PUNTOS DE VENTA 
-Punto de venta
-Punto de venta + tienda online
-Tienda online + aplicación
VOZ Y DATOS
-Instalación de redes Wifi &amp; Lan
-Servidores
-Cámaras IP
-Cámaras CCTV
-Acces point de Internet
REPARACIÓN Y DESBLOQUEO
-Liberación de móviles
-Reparación de dispositivos móviles
-Reparación de equipos de computo
-Electrónica general
-Desbloqueo
FORO" />

  <meta property="og:url" content="https://softmor.com/" />
  <meta property="og:site_name" content="softmor" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:description" content="DESARROLLO Y DISEÑO -Aplicaciones Móviles --Aplicaciones Informativas --Tienda online y APP -Desarrollo Web --Páginas web InformátiSvas --Foros --Blogs -Aplicaciones Web y Sistemas --Sistema de reservas y sitio web Hotelero. --Sistema para Doctores. --Sistema de reserva para agencia de viajes. --Tiendas Online --Sistema Punto de Venta y Tienda Online --Sistema de bienes raíces y sitio web. --Sistema y sitio web Abogados. --Sistema administrativo. PUNTOS DE VENTA  -Punto de venta -Punto de venta + tienda online -Tienda online + aplicación VOZ Y DATOS -Instalación de redes Wifi &amp; Lan -Servidores -Cámaras IP -Cámaras CCTV -Acces point de Internet REPARACIÓN Y DESBLOQUEO -Liberación de móviles -Reparación de dispositivos móviles -Reparación de equipos de computo -Electrónica general -Desbloqueo FORO" />


  <link rel="shortcut icon" href="<?php echo $url ?>vistas/img/plantilla/ifixit_x.png" type="image/x-icon">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/css/adminlte.min.css">


  <link rel="stylesheet" href="<?php echo $url ?>vistas/css/slide.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">



  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $url ?>vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/plugins/iCheck/all.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/plugins/iCheck/square/blue.css">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/bower_components/morris.js/morris.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/plugins/select2/css/select2.min.css">


  <!--Estilo de los paquetes -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/css/plantilla.css">


  <link href="<?php echo $url ?>vistas/bower_components/tags-bootstrap/tagsinput.css" rel="stylesheet" type="text/css">

  <!-- bootstrap slider -->
  <link rel="stylesheet" href="<?php echo $url ?>vistas/plugins/bootstrap-slider/slider.css">



  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->


  <!-- jQuery -->
  <script src="<?php echo $url ?>vistas/plugins/jquery/jquery.min.js"></script>

  <script src="<?php echo $url ?>vistas/bower_components/jquery-ui/jquery-ui.min.js"></script>



  <!-- Bootstrap 4 -->
  <script src="<?php echo $url ?>vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo $url ?>vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo $url ?>vistas/js/adminlte.min.js"></script>


  <!-- FastClick -->
  <script src="<?php echo $url ?>vistas/bower_components/fastclick/lib/fastclick.js"></script>


  <!-- DataTables -->
  <script src="<?php echo $url ?>vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo $url ?>vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $url ?>vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo $url ?>vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="<?php echo $url ?>vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="<?php echo $url ?>vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- bootstrap color picker https://farbelous.github.io/bootstrap-colorpicker/v2/-->
  <script src="<?php echo $url ?>vistas/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

  <!-- InputMask -->
  <script src="<?php echo $url ?>vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="<?php echo $url ?>vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="<?php echo $url ?>vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- jQuery Number -->
  <script src="<?php echo $url ?>vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="<?php echo $url ?>vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo $url ?>vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="<?php echo $url ?>vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="<?php echo $url ?>vistas/bower_components/morris.js/morris.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="<?php echo $url ?>vistas/bower_components/Chart/Chart.js"></script>

  <script src="<?php echo $url ?>vistas/bower_components/select2/dist/js/select2.full.min.js"></script>

  <script src="<?php echo $url ?>vistas/bower_components/tags-bootstrap/tagsinput.js"></script>


  <!-- Bootstrap slider http://seiyria.com/bootstrap-slider/-->
  <script src="<?php echo $url ?>vistas/plugins/bootstrap-slider/bootstrap-slider.js"></script>

  <script src="<?php echo $url ?>vistas/plugins/select2/js/select2.min.js"></script>




</head>

<style>

</style>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse expansion-alids-init">

  <?php

  if (isset($_SESSION['perfil']) && $_SESSION['session']) :
    $rutas = array();
    if (isset($_GET['ruta'])) {

      $rutas = explode('/', $_GET['ruta']);

      if ($rutas[0] == 'sucursal') {
        $app->getPage('sucursal');
        return;
      }
    }



  ?>

    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->

      <?php

      $suscripcion = SuscripcionContrlador::ctrObternerEstadoSuscripcion();

      if ($suscripcion["estado_suscripcion"] != 0) {
        if ($_SESSION['base'] == 2) {
          if (isset($_GET["ruta"]) && $_GET["ruta"] == "salir") {
            include "modulos/" . $_GET["ruta"] . ".php";
          }
          $_GET["ruta"] = "suscripcion";
        } else {

          if ($_SESSION['nom_suc'] == "") {
            include "modulos/sucursal.php";
            return;
          }

          if (isset($_SESSION['block_session'])) {
            include "modulos/block.php";
            return;
          }
          /*=============================================
    CABEZOTE
    =============================================*/
          $app->getComponents('navbar');

          /*=============================================
MENU
=============================================*/

          $app->getComponents('sidebar',$url);

          /*=============================================
CONTENIDO
=============================================*/
        }
      } else {
        if (isset($_GET["ruta"]) && $_GET["ruta"] == "salir") {
          include "modulos/" . $_GET["ruta"] . ".php";
        }
        $_GET["ruta"] = "suscripcion";

        /*=============================================
CABEZOTE
=============================================*/
        $app->getComponents('navbar');

        /*=============================================
MENU
=============================================*/

        include "modulos/menu.php";
      }
      ?>

      <?php //$app->getComponents('navbar'); ?>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->

      <?php //$app->getComponents('sidebar',$url); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Aqui van las paginas -->
        <?php

        if (isset($_GET['ruta'])) {
          //Traer la lista blanca de paginas adminitas
          $whiteList = ControladorPlantilla::getWhiteList();

          //Guardad en la variable la ruta que venga de GET

          //Crea un arreglo vacio
          $rutas = array();

          // Crea los elementos del arreglo a partir de caracter /
          $rutas = explode("/", $_GET['ruta']);

          // Asigna a la variable el primer item del arreglo que será la página
          $ruta_get = $rutas[0];
          //Inicializamos una bandera en true para ver si hay pagina admitida
          $_404 = true;
          //Recorremos la lista de paginas admitidas
          foreach ($whiteList as $item) {
            //Si hay una conincidencia con lo que venga por GET y un elemento de mi lista
            if ($ruta_get == $item) {
              //Marcar la bandera en false indicando que si existe la pagina
              $_404 =  false;
            }
          }
          //Guardar la pagina mostrar dependiendo la bandera
          $page = $_404 ? '404' : $ruta_get;
          //Cargar la pagina solicitada
          $app->getPage($page, $rutas);
        } else {

          $app->getPage('inicio');
        }

        ?>


        <?php //$app->getPage('acceso-restringido') 
        ?>

        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->



      <?php $app->getComponents('footer') ?>


      <!-- Control Sidebar -->

      <!-- /.control-sidebar -->
    </div>


  <?php else :

    header('Location:' . URL)

  ?>

  <?php endif;  ?>
  <!-- ./wrapper -->


  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo $url ?>vistas/js/demo.js"></script>



  <script src="<?php echo $url ?>vistas/js/app/plantilla.js"></script>
  <script src="<?php echo $url ?>vistas/js/app/usuarios.js"></script>
  <script src="<?php echo $url ?>vistas/js/app/categorias.js"></script>
  <script src="<?php echo $url ?>vistas/js/app/productos.js"></script>
  <script src="<?php echo $url ?>vistas/js/app/clientes.js"></script>

  <script src="<?php echo $url ?>vistas/js/app/reportes.js"></script>

  <script src="<?php echo $url ?>vistas/js/app/corte.js"></script>
  <script src="<?php echo $url ?>vistas/js/app/pedidos.js"></script>
  <script src="<?php echo $url ?>vistas/js/app/cotizaciones.js"></script>

  <script src="<?php echo $url ?>vistas/js/app/servicios.js"></script>
  <script src="<?php echo $url ?>vistas/js/app/refacciones.js"></script>
  <script src="<?php echo $url ?>vistas/js/app/gestorSlide.js"></script>


  <!-- BEGIN JIVOSITE CODE {literal} -->
  <!--<script type='text/javascript'>
(function(){ var widget_id = '1Q4ht8CGyg';var d=document;var w=window;function l(){
  var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
  s.src = '//code.jivosite.com/script/widget/'+widget_id
    ; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}
  if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}
  else{w.addEventListener('load',l,false);}}})();
</script>-->
  <!-- {/literal} END JIVOSITE CODE -->

  <script src="//code.tidio.co/nxinf3gpsku2ofkbr2vhlpfheik0cb5k.js"></script>
  <!-- Código de instalación Cliengo para http://ifixit.softmormx.com -->
  <!-- <script type="text/javascript">
    (function() {
      var ldk = document.createElement('script');
      ldk.type = 'text/javascript';
      ldk.async = true;
      ldk.src = 'https://s.cliengo.com/weboptimizer/5e6e676ee4b0e5d513a25265/5e6e676fe4b0e5d513a25268.js';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(ldk, s);
    })();
  </script> -->
  <!-- /WhatsHelp.io widget -->
</body>

</html>