<?php

if (isset($rutas[0]) && $rutas[0] == 'salir') {
    $app->getPage('salir');
    return;
}

?>

<div class="jumbotron">
    <h1 class="display-4">Hola <?php echo $_SESSION['nombre'] ?></h1>
    <p class="lead">Soy el asistente de actualizaciones.</p>
    <hr class="my-4">
    <p>Esta página te mostrará las actualizaciones que son necesarias instalar para el uso correcto del sistema.</p>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nuevas actualizaciones</h5>
            <hr>
            <div class="alert alert-danger" role="alert">
                Hemos detectado algunas actualizaciones que tienes pendientes, no te llevará ni 1 segundo instalarlas.
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Módulo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $act_dis = ModeloUpdateDB::mdlObtenerActualizaciones();
                    //$act_ins = ModeloUpdateDB::mdlObtenerActualizacionesInstaladas($_SESSION['nom_suc']);

                    foreach ($act_dis as $key => $dis) :
                    ?>
                        <tr>
                            <th scope="row"><?php echo $dis['id'] ?></th>
                            <td><?php echo $dis['tipo'] ?></td>
                            <td><?php echo $dis['descripcion'] ?></td>
                            <td><?php echo $dis['fecha'] ?></td>
                            <td>
                                <button type="button" class="btn btn-danger btnActualizarSuc" pagina="<?php echo $dis['tipo']  ?>" id_actualizacion="<?php echo $dis['id'] ?>" token_suc="<?php echo $_SESSION['token_suc'] ?>" content_sql="<?php echo $dis['contenido_sql'] ?>"> <i class="fas fa-download"></i>Instalar</button>
                            </td>
                        </tr>
                    <?php

                    endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            ¿Tienes algun problema? Ponte en contacto con soporte indicando tu token_suc <strong><?php echo $_SESSION['token_suc'] ?></strong>
        </div>
    </div>


</div>

<script>
    $(".table").on("click", ".btnActualizarSuc", function() {

        var pagina = $(this).attr("pagina");


        var datos = new FormData();

        datos.append("token_suc", $(this).attr("token_suc"));
        datos.append("content_sql", $(this).attr("content_sql"));
        datos.append("id_actualizacion", $(this).attr("id_actualizacion"));

        datos.append("btnActualizarSuc", true);

        $.ajax({
            url: "ajax/updateDB.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta) {

                if (respuesta) {
                    swal({

                        type: "success",
                        title: "Esta cuenta se actualizo con éxito.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result) {

                        if (result.value) {
                            window.location = pagina;
                        }
                    });

                } else {
                    swal({

                        type: "error",
                        title: "No se pudo actualizar esta cuenta. Ponte en contaco con soporte o recarga la página.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result) {

                        if (result.value) {
                            window.location = "./";
                        }
                    });
                }
            }
        })

    })
</script>

<script src="//code.tidio.co/nxinf3gpsku2ofkbr2vhlpfheik0cb5k.js"></script>