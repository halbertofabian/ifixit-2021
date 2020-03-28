<div id="back"></div>

<div class="login-box">
  
  <div class="login-logo">
    <img src="vistas/img/plantilla/logo-ofici.png" alt="" width="200">
    
  </div>

  <div class="login-box-body" style="background: #FAFAFC">

    <p class="login-box-msg">Ingresar al sistema</p>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required value="demo@softmormx.com">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required value="demo">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      
      </div>

      <div class="input-group col-12">
              
                <span class="input-group-addon"><i class="fa fa-university"></i> Softmor_</span> 

                <input type="text" class="form-control input-lg" name="ingSucursal" placeholder="Nombre de la sucursal" value="softmx">

      </div>
      <br>

      <div class="row">
       
        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        
        </div>

      </div>

      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

  </div>

</div>