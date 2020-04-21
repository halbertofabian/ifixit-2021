
<footer class="main-footer mt-5">
    <div class="float-right d-none d-sm-block mt-5">
        <b>Version</b> 3.0.1
    </div>

    <strong>Copyright &copy; 2020 <a href="https://softmor.com/" target="_blank">Softmor</a>.</strong>

    Todos los derechos reservados.
    <?php

            date_default_timezone_set($_SESSION["zona"]);
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');

        echo $fechaActual = $fecha . ' ' . $hora;
     
    
     
     ?>

</footer>