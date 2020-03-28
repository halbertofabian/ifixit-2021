<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Suscripción
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Suscripción</li>
    
    </ol>

  </section>

  <section class="content">

    <?php 
    $suscripcion =  SuscripcionContrlador::ctrObternerEstadoSuscripcion();
     ?>   
     <!--Información del suscruptor-->
      <div class="col-12 col-md-12">
        <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Información del suscriptor</h3>
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
      <div class="">
        
        <p><strong>Email: </strong><?php echo $suscripcion['propietario'] ?></p>
        <p><strong>Suscripción: </strong><?php echo $estado = $suscripcion['estado_suscripcion']==1 ?  "<span class='text-success'>Activa</span>" : "<span class='text-danger'>Pausada, activación pendiente</span>" ?> 
         
      </p>
        <p><strong>Tipo de suscripión </strong><stong class="text-primary"><?php echo $suscripcion['tipo'].' '. $suscripcion['plan'] ?></stong></p>
        <p><strong>Fecha inicio: </strong><?php echo $suscripcion['fecha_inicio'] ?><strong>Fecha Termino: </strong><?php echo $suscripcion['fecha_termino'] ?></p>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <?php if($_SESSION["db_name"]=="" && $suscripcion['tipo']=="IFIXIT PRUEBA"): ?>
       
      
      <div class="alert alert-success">
      <strong>¡BIEN HECHO!</strong>. <p>Has registrado una cuenta de prueba, estas a un paso de completar el registro, solo contactanos por medio de nuestros chats`s para dar de alta tu</p>cuenta.
    </div>
    
      
        <form action="" method="post">
            <div class="btn-group">
        <button type="submit" class="btn btn-info" name="btnActivarSuc">
           Terminar activación <i class="fas fa-hourglass-end"></i>
        </button>
       <a class="btn btn-success " target="_blank" href="https://api.whatsapp.com/send?phone=527341006945&text=Propietario:<?php  echo $suscripcion['propietario']; ?>" role="button"><i class="fab fa-whatsapp" style=""></i> Vía Whatsapp</a>
                <a class="btn btn-primary " href="https://www.messenger.com/t/softmor" target="_blank" role="button"><i class="fab fa-facebook-messenger"></i> Vía messenger</a>

      </div>
        <?php $activacion = new ControladorSucursal();
              $activacion -> ctractivarCuenta();
         ?>
      </form>
                
    
    <?php elseif ($suscripcion['tipo']!="IFIXIT PRUEBA" && $_SESSION["db_name"]==""):?>

      <div class="col-md-8 col-12">
            <hr>

            <?php include 'vistas/modulos/plan.php'; ?>
            

      </div> 

    <?php endif; ?>
    </div>
  <!-- box-footer -->
  </div>
<!-- /.box -->
      </div>

      <?php if($_SESSION["db_name"]!=""): ?>

        
      <div class="col-12 col-md-12">
        

        <div class="box">
        



    <div class="box-header with-border">
      <h3 class="box-title">Contactanos
      
      </h3>
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
      <div class="container">
        <div class="row">
          <div class="col-12">

            <?php 
            
         if($suscripcion['estado_suscripcion']==1){

          include 'vistas/modulos/alert-activo.php';
          return;
        }   
        if($suscripcion['tipo']=="IFIXIT PRUEBA"){

            include 'vistas/modulos/alert-prueba.php';

        }
        if($suscripcion['tipo']!="IFIXIT PRUEBA"){

          include 'vistas/modulos/alert-termino.php';
        }
        
          
          ?>
          </div>
          <div class="col-md-8 col-12">
            <hr>

            <?php include 'vistas/modulos/plan.php'; ?>
            

          </div>  
          </div>
        </div>
      </div>
      <?php include 'vistas/modulos/caracteristicas-paquete.php'; ?>
  
      
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      
    </div>
  <!-- box-footer -->
  </div>
<!-- /.box -->
      </div>
 


    <?php return; endif; ?>
    
    
    
    

                
    </div>


  </section>

  

</div>




