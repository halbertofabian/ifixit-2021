<?php
if ($_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Tecnico") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h3 class="display-5">Configuración de la sucursal</h3>
    <p class="lead">Aquí te permitimos que personalices tickets, logo de la empresa, redes sociales, mensajes de WhatsApp. Todo lo que tenga que ser personalizado de tu sucursal.</p>
  </div>
</div>


<?php
$suscripcion =  SuscripcionContrlador::ctrObternerEstadoSuscripcion();
$sucursal = ControladorSucursal::ctrMostrarSucursal();
$zona = ControladorSucursal::getZone();

?>


<!-- Main content -->
<section class="container-fluid">
  <div class="row">


    <div class="col-12 col-md-6">
      <div class="card collapsed-card">
        <div class="card-header with-border">
          <h3 class="card-title">Información de la sucursal </h3>

          <div class="card-tools float-right">
            <!-- Collapse Button -->
            <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          <form action="#" method="post" enctype="multipart/form-data">

            <div class="row">
              <div class="col-md-12 col-12">
                <label for="">Lógotipo de la sucursal</label>
                <div class="input-group">

                  <span class="input-group-text"><i class="fas fa-camera-retro"></i><br>


                  </span>



                  <input type="file" class="form-control input-lg nuevaImagen" name="nuevaImagen" placeholder="Logo de la sucursal" value="Cargar logótipo de la sucursal">
                  <input type="hidden" value="<?php echo $sucursal['ruta_logo'] ?>" name="imagenActual">

                </div>
              </div>
              <div class="col-md-12 col-12">
                <p class="help-block">Peso máximo de la imagen 2MB</p>
                <?php if ($sucursal['ruta_logo'] == "") : ?>
                  <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="220px">
                <?php else : ?>
                  <img src="<?php echo $sucursal['ruta_logo']; ?>" class="img-thumbnail previsualizar" width="220px">

                  <button type="button" class="btn  text-danger btnEliminarLogoSuc" nomSuc="<?php echo $_SESSION['nom_suc'] ?>"><i class="fas fa-trash"></i> Eliminar lógotipo</button>




                <?php endif; ?>

              </div>

              <div class="col-md-5">
                <br>




              </div>
            </div>


            <hr>
            <div class="row">
              <div class="col-md-6 col-12">

                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-university"></i> <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="No puedes cambiar el nombre de la sucursal, de así desearlo, comunicate con un agente"></i><br>


                  </span>



                  <input type="text" class="form-control input-lg" name="nombre" placeholder="Nombre de la sucursal" required readonly="" value="<?php echo $sucursal['nombre'] ?>">


                </div>

              </div>


              <div class="col-md-6 col-12">
                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-text"><i class="fa fa-phone"></i></span>

                    <input type="number" class="form-control input-lg" name="telefono" placeholder="Ingresar teléfono" value="<?php echo $sucursal['telefono'] ?>">

                  </div>

                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12 col-12">
                <div class="input-group">

                  <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>

                  <input type="text" class="form-control input-lg" name="direccion" placeholder="Dirección" value="<?php echo $sucursal['direccion'] ?>">

                </div>
              </div>

            </div>
            <br>

            <div class="row">
              <div class="col-12 col-md-12">
                <div class="input-group">

                  <span class="input-group-text"><i class="fas fa-globe"></i></span>

                  <input type="url" class="form-control input-lg" name="sitio_web" placeholder="Sitio web http(s)://misitio.com" value="<?php echo $sucursal['sitio_web'] ?>">

                </div>
              </div>
            </div>
            <br>
            <span class="input-group-text"><i class="fas fa-clock"> </i> Zona Horaria</span>
            <br>
            <select id="" class="form-control" name="zona">
              <option value="<?php echo $sucursal['zona'] ?>"><?php echo $sucursal['zona'] ?></option>
              <?php
              for ($i = 0; $i < 147; $i++) :
              ?>
                <option value="<?php echo $zona[$i] ?>"><?php echo $zona[$i] ?></option>
              <? endfor; ?>


            </select>
            <br>
            <span class="input-group-text"><i class="fa fa-print"></i> Seleccione su tipo de impresion</span>
            <div class="btn-group btn-group-toggle my-3 " data-toggle="buttons">

              <?php $tipo_impresora = $sucursal['tipo_impresora'];
              if ($tipo_impresora == "") :
              ?>

                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="58mm"> 58mm
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="80mm"> 80mm
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="T-CARTA"> T-CARTA
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="M-CARTA"> M-CARTA
                </label>

              <?php endif; ?>

              <?php if ($tipo_impresora == "58mm") : ?>
                <label class="btn btn-outline-dark">
                  <input type="radio" name="impresion" value="58mm" checked> 58mm
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="80mm"> 80mm
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="T-CARTA"> T-CARTA
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="M-CARTA"> M-CARTA
                </label>

              <?php endif; ?>
              <?php if ($tipo_impresora == "80mm") : ?>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="58mm"> 58mm
                </label>
                <label class="btn btn-outline-dark">
                  <input type="radio" name="impresion" value="80mm" checked> 80mm
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="T-CARTA"> T-CARTA
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="M-CARTA"> M-CARTA
                </label>

              <?php endif; ?>
              <!-- <?php //if ($tipo_impresora == "T-CARTA") : 
                    ?>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="58mm"> 58mm
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="80mm"> 80mm
                </label>
                <label class="btn btn-outline-dark">
                  <input type="radio" name="impresion" value="T-CARTA" checked> T-CARTA
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="M-CARTA"> M-CARTA
                </label>
              <?php //endif; 
              ?> -->
              <!-- <?php // if ($tipo_impresora == "M-CARTA") : 
                    ?>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="58mm"> 58mm
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="80mm"> 80mm
                </label>
                <label class="btn btn-secondary">
                  <input type="radio" name="impresion" value="T-CARTA"> T-CARTA
                </label>
                <label class="btn btn-outline-dark">
                  <input type="radio" name="impresion" value="M-CARTA" checked> M-CARTA
                </label>

              <?php // endif; 
              ?> -->




            </div>
            <div class="row margenes-input">
              <?php 
              
              if($sucursal['margenes']!=""){
                $margen = explode(",",$sucursal['margenes']);
            
              }else{
                $margen = explode(",",'1,8,0');
              }        
              ?>
              <div class="col-6">
                <div class="row">
                  <div class="col-4">
                    <input type="number" class="form-control" value="<?php echo $margen[0] ?>" name="ml" id="ml" placeholder="Margén derecho">
                    <label for="">Margen izquiero</label>
                  </div>
                  <div class="col-4">
                    <input type="number" class="form-control" value="<?php echo $margen[1] ?>" name="mt" id="ml" placeholder="Margén de arriba">
                    <label for="">Margen de arriba</label>
                  </div>
                  <div class="col-4">
                    <input type="number" class="form-control" value="<?php echo $margen[2] ?>" name="mr" id="ml" placeholder="Margén de izquierdo">
                    <label for="">Margen derecho</label>
                  </div>
                </div>
              </div>

            </div>
            <br>
            <input type="submit" value="Guardar Cambios" class="btn btn-primary float-right" name="btnModInfo">

            <?php $mod = new ControladorSucursal();
            $mod->ctrModificarInformación(); ?>

          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button class="btn btn-dark float-left" data-toggle="modal" data-target="#addSucursal">

            Agregar sucursal

          </button> <br><br>

          Está información aparecera en la parte superior de su comprobante (tiket) de ventas, cotizaciones, pedios y servicios.

        </div>
        <!-- card-footer -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-12 col-md-6">
      <div class=" card collapsed-card">
        <div class="card-header with-border">
          <h3 class="card-title">Redes sociales</h3>
          <div class="card-tools float-right">
            <!-- Collapse Button -->
            <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <form action="#" method="post">
          <div class="card-body">
            <div class="col-12 col-md-12">
              <div class="input-group">
                <span class="input-group-text"><i class="fab  fa-whatsapp"><strong> +</strong></i></span>

                <input type="text" class="form-control input-lg" name="whatsapp" placeholder="Whatsapp número con código 527341000000" value="<?php echo $sucursal['whatsapp'] ?>">
              </div><br>

              <div class="input-group">
                <span class="input-group-text"><i class="fab  fa-facebook"></i></span>

                <input type="text" class="form-control input-lg" name="facebook" placeholder="Facebook usuario" value="<?php echo $sucursal['facebook'] ?>">
              </div>
              <br>
              <div class="input-group">
                <span class="input-group-text"><i class="fab  fa-youtube"></i></span>

                <input type="text" class="form-control input-lg" value="<?php echo $sucursal['youtube'] ?>" placeholder="Youtube canal" name="youtube">
              </div>
              <br>
              <div class="input-group">
                <span class="input-group-text"><i class="fab  fa-twitter"></i></span>

                <input type="text" class="form-control input-lg" value="<?php echo $sucursal['twitter'] ?>" placeholder="Twitter usuario" name="twitter">
              </div>
              <br>
              <div class="input-group">
                <span class="input-group-text"><i class="fab  fa-instagram"></i></span>

                <input type="text" class="form-control input-lg" name="instagram" placeholder="Instagram usuario" value="<?php echo $sucursal['instagram'] ?>">
              </div>

              <br>
              <input type="submit" class="btn btn-primary float-right" value="Guardar Cambios" name="btnModRedes">
            </div>
          </div>
          <?php $red = new ControladorSucursal();
          $red->ctrModificarRedes() ?>

        </form>
        <!-- /.card-body -->
        <div class="card-footer">
          Está información aparecera en la página donde sus clientes consultan su servicio.
        </div>
        <!-- card-footer -->
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card collapsed-card">
        <div class="card-header with-border">
          <h3 class="card-title">Mensaje personalizado para whatsapp (Servicios)</h3>

          <div class="card-tools float-right">
            <!-- Collapse Button -->
            <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <form action="#" method="post">
          <div class="card-body">
            <div class="col-12 col-md-12">
              <h4>Intrucciones:</h4>
              <p>Las palabras que entran encerradas en <strong>[]</strong> son claves. La api de whatsapp no permite caracteres especiales, evite agregar cualquier carácter especial para el buen funcionamiento de la misma. Los asteriscos <strong>*</strong>, son parte de whatsapp, ayuda a escribir un texto en <strong>negrita</strong>, para más información <a href="https://faq.whatsapp.com/es/android/26000002/" target="_blank"> API Whatsapp</a></p>
              <p><strong>Claves admitidas:</strong></p>

              <strong>[NOMBRE]</strong> Obtiene el nombre del cliente (Importante)<br>
              <strong>[ORDEN]</strong> Obtiene el número de orden del servicio (Importante)<br>
              <strong>[FACEBOOK]</strong> Obtiene el enlace de facebook<br>
              <strong>[INSTAGRAM]</strong> obtiene el enlace de instagram<br>
              <strong>[TWITTER]</strong> Obtiene el enlace de twitter <br>
              <strong>[YOUTUBE]</strong> Obtiene el enlace de youtube <br>
              <strong>[SUCURSAL]</strong> Obtiene el nombre la sucursal <br>
              <strong>[CODIGO]</strong> Obtiene el código de tiket del servicio <br>
              <strong>[SITO-WB]</strong> Obtiene el enlace de su sitio web <br>
              <strong>[TEL]</strong> Obtiene el número de su whatsapp <br>
              <strong>Nota:</strong> Lo que no tengas registrado como por ejemplo redes sociales lo puedes omitir.
              <div class="input-group">
                <textarea name="text_servicio" id="" cols="100" rows="10" class="form-control" placeholder="Hola querido(a)  *[NOMBRE]*, gracias por tu preferencia. Te mantendremos informado sobre la situación actual de tu servicio con número de orden *[ORDEN]*. No olvides visitar nuestras redes sociales: *[FACEBOOK]* *[INSTAGRAM]* *[TWITTER]* *[YOUTUBE]* También puedes consultar el estado actual de tu servicio en este enlace: *https://softmormx.com/consulta/* con la siguiente información, Sucursal: *[SUCURSAL]* Código: *[CODIGO]*. Nuestro sitio web es *[SITO-WB]*. Cualquier duda o aclaración no dudes en llamarnos *[TEL]*. Gracias nuevamente y saludos."><?php echo $sucursal['text_servicio'] ?></textarea>
              </div>
              <br>
              <input type="submit" class="btn btn-primary float-right" value="Guardar Cambios" name="btnModServWP">
            </div>
          </div>
          <?php $serv = new ControladorSucursal();
          $serv->ctrModificarTxtServicio(); ?>

        </form>
        <!-- /.card-body -->
        <div class="card-footer">
          Está información aparecera en la conversación de whatsapp
        </div>
        <!-- card-footer -->
      </div>

      <!-- /.card -->
    </div>
    <div class="col-12 col-md-6">
      <div class="card collapsed-card">
        <div class="card-header with-border">
          <h3 class="card-title">Politicas del servicio</h3>
          <div class="card-tools float-right">
            <!-- Collapse Button -->
            <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <form action="#" method="post">
          <div class="card-body">
            <div class="col-12 col-md-12">
              <div class="input-group">
                <textarea name="politicas" id="" cols="100" rows="10" class="form-control" placeholder="ejem: 1.- En equipos mojados no hay grantía 2.- ..."><?php echo $sucursal['politicas'] ?></textarea>
              </div>
              <br>
              <input type="submit" class="btn btn-primary float-right" value="Guardar Cambios" name="btnModPoliticas">
            </div>
          </div>
          <?php $pot = new ControladorSucursal();
          $pot->ctrModificarPoliticas(); ?>

        </form>
        <!-- /.card-body -->
        <div class="card-footer">
          Está información aparecera en la parte inferior de su comprobante (tiket) de cotizaciones y servcios.
        </div>
        <!-- card-footer -->
      </div>

      <!-- /.card -->
    </div>
    <div class="col-12 col-md-6">
      <div class="card collapsed-card">
        <div class="card-header with-border">
          <h3 class="card-title">Politicas de venta</h3>
          <div class="card-tools float-right">
            <!-- Collapse Button -->
            <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <form action="#" method="post">
          <div class="card-body">
            <div class="col-12 col-md-12">
              <div class="input-group">
                <textarea name="politicas_accesorios" id="" cols="100" rows="10" class="form-control" placeholder="ejem: 1.- No hay devoluciones ..."><?php echo $sucursal['politicas_accesorios'] ?></textarea>
              </div>
              <br>
              <input type="submit" class="btn btn-primary float-right" value="Guardar Cambios" name="btnModPoliticasAccesorios">
            </div>
          </div>
          <?php $pot = new ControladorSucursal();
          $pot->ctrModificarPoliticasAccesorios(); ?>

        </form>
        <!-- /.card-body -->
        <div class="card-footer">
          Está información aparecera en la parte inferior de su comprobante (tiket) de ventas.
        </div>
        <!-- card-footer -->
      </div>

      <!-- /.card -->
    </div>



  </div>
  <div class="row">



  </div>
</section>

<div id="addSucursal" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-dark">

          <h4 class="modal-title">Agregar Sucursal</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>



        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card-body">

            <div class="row">
              <div class="col-md-12 col-12">
                <div class="input-group">

                  <span class="input-group-text"><i class="fa fa-university"></i></span>

                  <input type="text" class="form-control input-lg" name="nombre_suc" placeholder="Nombre de la sucursal" required>

                </div>
              </div>

            </div>






          </div>
        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default float-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-dark" name="btnGuardarSuc">Guardar sucursal</button>

        </div>

        <?php $guradar = new ControladorSucursal();
        $guradar->ctrGuardarSucursal(); ?>

      </form>

      <?php


      ?>

    </div>

  </div>

</div>