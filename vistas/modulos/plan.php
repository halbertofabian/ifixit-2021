<div class="container mt-3">
              <div class="jumbotron">
                <h1 class="display-4">¡Hola!</h1>
                <p class="lead">Nos gustaría que siga adquiriendo nuestros servicios...</p>
                <hr class="my-4">
                <p>No olvide que cada semana hay nuevas actualizaciones que ustedes como comunidad requieren. Queda pendiente hacer el déposito correspondiente.</p>
                <p>Por el momento contamos con estas redes sociales, puede ponerse en contacto con nosotros  por medio de ellas. Cualquier duda o acalaración estamos para servirle</p>
                <form action="" method="post">
            <div class="btn-group">
        <button type="submit" class="btn btn-info" name="btnActivarSuc">
           Terminar activación <i class="fas fa-hourglass-end"></i>
        </button>
        <a class="btn btn-success " target="_blank" href="https://api.whatsapp.com/send?phone=527341006945&text=Propietario:<?php  echo $suscripcion['propietario']; ?>" role="button"><i class="fab fa-whatsapp" style=""></i> Vía Whatsapp</a>
                <a class="btn btn-primary " href="https://www.facebook.com/softmor/" target="_blank" role="button"><i class="fab fa-facebook-messenger"></i> Vía messenger</a>

      </div>
        <?php $activacion = new ControladorSucursal();
              $activacion -> ctractivarCuenta();
         ?>
      </form>
                <div class="container">
                  <div class="row justify-content-center">
                    
                    <div class="col-12 col-md-8 mt-2">
                      <div class="card" style="width: 100%;">
                      <div class="card-header">
                        <strong class="text-danger">
                          <h4><?php echo 'Tipo de cuenta: '.$suscripcion['tipo'].' '.$suscripcion['plan'] ?></h4>
                        </strong>
                      </div>
                     
                        <div class="accordion" id="accordionExample">
                      <div class="card">
                        <h3>Pagos por oxxo</h3>
                          <div class="card-body">
                            1.- Dile al cajero que quieres realizar un pago de servicio albo <br>
                        2.- Díctale los 16 dígitos de la tarjeta como referencia: 
                          <strong>5439 2411 0271 2007</strong> <br>
                        3.- Realiza el pago en efectivo por el monto del  paquete de tu elección más $12 MXN de comisión OXXO 
                        <hr>
                        <h3>Pagos por SPEI</h3>
                         Puedes transferir por SPEI, desde el portal internet o app móvil de cualquier banco de México
                      Información 
                      CLABE
                      <strong>6461 8014 6000 3133 75</strong>
                      Banco
                      <strong>STP/Sistema de transferencias y pagos</strong>
                      Nombre
                      <strong>Hector Alberto Lopez Fabian</strong>
                          </div>
                        </div>
                      </div>
                    
                    <div class="card text-success">

                      Estamos a la espera de tu  comprobante de pago, indicándonos tu tipo de plan que hayas elegido

                      
                    </div>
                    </div>
                    
                    </div>
                    </div>

                  </div>
                </div>
            </div>