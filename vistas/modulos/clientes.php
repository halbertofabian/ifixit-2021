<?php

if ($_SESSION["perfil"] == "Auxiliar" || $_SESSION["perfil"] == "Tecnico") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <h3 class="display-5">Administrar clientes</h3>
    <div class="btn-group float-right">

      <button class="btn btn-dark" data-toggle="modal" data-target="#modalAgregarCliente">
        <i class="fas fa-plus"></i>
        Agregar cliente

      </button>


      <a href="excel/descargar-excel.php?cliente" class="btn btn-success" title="Exportar a excel">
      <i class="fas fa-file-excel"></i> Exportar a excel
      </a>

    </div>
  </div>
</div>


<section class="container-fluid">

  <div class="card">

    <div class="card-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

        <thead>

          <tr>

            <th style="width:10px">#</th>
            <th>Nombre</th>
            <th>Documento ID</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Fecha nacimiento</th>
            <th>Total compras</th>
            <th>Última compra</th>
            <th>Ingreso al sistema</th>
            <th>Acciones</th>

          </tr>

        </thead>

        <tbody>

          <?php

          $item = null;
          $valor = null;

          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

          foreach ($clientes as $key => $value) {


            echo '<tr>

                    <td>' . ($key + 1) . '</td>

                    <td>' . $value["nombre"] . '</td>

                    <td>' . $value["documento"] . '</td>

                    <td>' . $value["email"] . '</td>

                    <td>' . $value["telefono"] . '</td>

                    <td>' . $value["direccion"] . '</td>

                    <td>' . $value["fecha_nacimiento"] . '</td>             

                    <td>' . $value["compras"] . '</td>

                    <td>' . $value["ultima_compra"] . '</td>

                    <td>' . $value["fecha"] . '</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-edit"></i></button>';

            if ($_SESSION["perfil"] == "Administrador") {

              echo '<button class="btn btn-danger btnEliminarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
            }

            echo '</div>  

                    </td>

                  </tr>';
          }

          ?>

        </tbody>

      </table>

    </div>

  </div>

</section>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-dark">

          
          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            Campos obligatotios(*)
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><strong>*</strong><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento">

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email">

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección">

              </div>

            </div>
            <div class="row">
              <div class="col-md-2">
                <label for="">Código</label>
                <input type="text" class="form-control input-lg" placeholder="52" name="codigo-wp" value="" pattern="\d*" maxlength="4" id="codigo">
              </div>
              <div class="col-md-10">
                <label for="">Número de whatsapp <i class="fab fa-whatsapp text-success" aria-hidden="true"></i></label>
                <input type="text" class="form-control input-lg" placeholder="0000000000" name="numero-wp" pattern="\d*" maxlength="10" id="wsp">
              </div>
            </div>
            <br>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-dark">Guardar cliente</button>

        </div>

      </form>

      <?php

      $crearCliente = new ControladorClientes();
      $crearCliente->ctrCrearCliente("clientes");

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-dark">

          
          <h4 class="modal-title">Editar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            Campos obligatotios(*)
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><strong>*</strong><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>
                <input type="hidden" id="idCliente" name="idCliente">
              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-key"></i></span>

                <input type="number" min="0" class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId">

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail">

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion">

              </div>

            </div>
            <div class="row">
              <div class="col-md-2">
                <label for="">Código</label>
                <input type="text" class="form-control input-lg" placeholder="52" name="codigo-wp" value="" pattern="\d*" maxlength="4" id="Editarcodigo">
              </div>
              <div class="col-md-10">
                <label for="">Número de whatsapp <i class="fab fa-whatsapp text-success" aria-hidden="true"></i></label>
                <input type="text" class="form-control input-lg" placeholder="0000000000" name="numero-wp" pattern="\d*" maxlength="10" id="Editarwsp">
              </div>
            </div>
            <br>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-text"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-dark">Guardar cambios</button>

        </div>

      </form>

      <?php

      $editarCliente = new ControladorClientes();
      $editarCliente->ctrEditarCliente();

      ?>



    </div>

  </div>

</div>

<?php

$eliminarCliente = new ControladorClientes();
$eliminarCliente->ctrEliminarCliente();

?>