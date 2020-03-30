<?php

session_start();

require_once '../controladores/usuarios.controlador.php';

require_once '../modelos/usuarios.modelo.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APP IFIXIT</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

 


    <?php

    $start = new ControladorUsuarios();
    $res = $start->ctrIngresoUsuarioToken();


    if ($res) :
    ?>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Accediendo al sistema</h1>
                <p class="lead">Espere un momento por favor</p>
                <div class="text-center">
                    <div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-dark" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>



                </div>
            </div>
        </div>
    <?php
        //sleep(4);
        header('refresh:3;url=https://app.ifixitmor.com/sucursal');

    //
    else :


    ?>
        <script>
            swal({
                title: "¡Ohoo no!",
                text: "Acceso denegado, intenta de nuevo",
                icon: "error",
                button: false,
            });
        </script>
        <div class="text-center mt-5">
            <div class="spinner-grow text-dark" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-dark" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="spinner-grow text-dark" role="status">
                <span class="sr-only">Loading...</span>
            </div>



        </div>




    <?php
        
      

        header('refresh:5;url=https://ifixitmor.com/app-login');


    endif;

    ?>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../vistas/plugins/toastr/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>


</body>

</html>