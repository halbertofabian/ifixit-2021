<?php

if ($_SESSION["perfil"] == "Tecnico" || $_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Tecnico-editor") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h3 class="display-5">Administración de usuarios</h3>
    <button class="btn btn-dark float-right" data-toggle="modal" data-target="#modalAgregarUsuario">
      <i class="fas fa-plus"></i>
      Agregar usuario
    </button>
  </div>
</div>


<section class="container-fluid">

  <div class="card">
    <div class="card-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

        <thead>

          <tr>


            <th>Nombre</th>
            <th>Usuario</th>
            <th>Foto</th>
            <th>Perfil</th>
            <th>Estado</th>
            <th>Último login</th>
            <th>Acciones</th>

          </tr>

        </thead>

        <tbody>

          <?php

          /*$item = "suscriptor";
        $valor = $_SESSION["suscriptor"];*/

          $usuarios = ControladorUsuarios::ctrMostrarUsuariosSuscriptos();

          foreach ($usuarios as $key => $value) {

            echo ' <tr>
                  
                  <td>' . $value["nombre"] . '</td>
                  <td>' . $value["usuario"] . '</td>';

            if ($value["status_online"] == 1) {
              if ($value["foto"] != "") {

                echo '<td><img src="' . $value["foto"] . '" class="img-thumbnail" width="40px" style="border: 2px solid #228B22" ></td>';
              } else {

                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px" style="border: 2px solid #228B22" ></td>';
              }
            }
            if ($value["status_online"] == 0) {
              if ($value["foto"] != "") {

                echo '<td><img src="' . $value["foto"] . '" class="img-thumbnail" width="40px" style="border: 2px solid #FF0000"></td>';
              } else {

                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px" style="border: 2px solid #FF0000"></td>';
              }
            }


            echo '<td>' . $value["perfil"] . '</td>';

            if ($value["estado"] != 0) {

              echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["usuario"] . '" estadoUsuario="0">Activado</button></td>';
            } else {

              echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["usuario"] . '" estadoUsuario="1">Desactivado</button></td>';
            }

            if ($_SESSION['propietario'] == $value['usuario']) {
              echo '<td>' . $value["ultimo_login"] . '</td>
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarUsuario" propietario="' . $_SESSION['propietario'] . '" idUsuario="' . $value["usuario"] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-edit"></i></button>


                    </div>  

                  </td>

                </tr>';
            } else {
              echo '<td>' . $value["ultimo_login"] . '</td>
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarUsuario" propietario="' . $_SESSION['propietario'] . '" idUsuario="' . $value["usuario"] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-edit"></i></button>
                      <button class="btn btn-danger btnEliminarUsuario"  idUsuario="' . $value["id"] . '" fotoUsuario="' . $value["foto"] . '" usuario="' . $value["usuario"] . '"><i class="fa fa-times"></i></button>
                    

                    </div>  

                  </td>

                </tr>';
            }
          }


          ?>

        </tbody>

      </table>

    </div>

  </div>

</section>




<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-dark">
          <h4 class="modal-title">Agregar usuario</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>



        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoPerfil">

                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>
                  <option value="Recepcionista">Recepcionista</option>



                  <option value="Vendedor">Vendedor</option>

                  <option value="Tecnico">Tecnico</option>
                  <option value="Tecnico-editor">Tecnico Editor</option>


                  <!--<option value="Auxiliar">Auxiliar</option>

                  <option value="Tecnico">Tecnico</option>-->

                </select>

              </div>

            </div>
            <div class="form-group permisosSuc " id="sectionPermiso">

              <label for="">Permisos de sucursal:</label><br>
              <span>Elije la(s) sucursal(es) a las que puede accerder este usuario</span>

              <?php

              $nomSuc = ControladorSucursal::ctrMostrarSucursalPropietario($_SESSION['suscriptor']);
              foreach ($nomSuc as $key => $value) :
              ?>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="sucPermiso[]" value="<?php echo $value['nombre'] ?>" id="<?php echo $value['nombre'] ?>">
                  <label class="form-check-label" for="<?php echo $value['nombre'] ?>">
                    <span class="text-dark"><?php echo $value['nombre'] ?></span>
                  </label>
                </div>
              <?php endforeach; ?>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-dark">Guardar usuario</button>

        </div>

        <?php

        $crearUsuario = new ControladorUsuarios();
        $crearUsuario->ctrCrearUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-dark">
          <h4 class="modal-title">Editar usuario</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>



        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarPerfil">

                  <option value="" id="editarPerfil"></option>

                  <option value="Administrador">Administrador</option>
                  <option value="Recepcionista">Recepcionista</option>
                  <option value="Vendedor">Vendedor</option>
                  <option value="Tecnico">Tecnico</option>
                  <option value="Tecnico-editor">Tecnico Editor</option>


                </select>

              </div>

            </div>



            <div class="form-group permisosSuc " id="sectionPermiso">

              <label for="">Permisos de sucursal:</label><br>
              <span>Elije la(s) sucursal(es) a las que puede accerder este usuario</span>

              <?php

              $nomSuc = ControladorSucursal::ctrMostrarSucursalPropietario($_SESSION['suscriptor']);
              foreach ($nomSuc as $key => $value) :
              ?>

                <div class="form-check">
                  <input class="form-check-input chk_i" type="checkbox" name="sucPermiso[]" value="<?php echo $value['nombre'] ?>" id="suc_<?php echo str_replace(" ", "-", $value['nombre']) ?>">
                  <label class="form-check-label" for="suc_<?php echo str_replace(" ", "-", $value['nombre']) ?>">
                    <span class="text-dark"><?php echo $value['nombre'] ?></span>
                  </label>
                </div>
              <?php endforeach; ?>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-dark">Modificar usuario</button>

        </div>

        <?php

        $editarUsuario = new ControladorUsuarios();
        $editarUsuario->ctrEditarUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();

?>