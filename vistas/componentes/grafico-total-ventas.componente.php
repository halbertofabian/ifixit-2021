<?php

error_reporting(0);

if (isset($_GET["fechaInicial"])) {

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
} else {

    $fechaInicial = null;
    $fechaFinal = null;
}

$respuesta = ControladorMovimientos::ctrRangoFechasVentas($fechaInicial, $fechaFinal);


$arrayFechas = array();
$arrayVentas = array();
$sumaPagosMes = array();

foreach ($respuesta as $key => $value) {

    #Capturamos sólo el año y el mes
    $fecha = substr($value["fecha"], 0, 7);

    #Introducir las fechas en arrayFechas
    array_push($arrayFechas, $fecha);

    #Capturamos las ventas
    $arrayVentas = array($fecha => $value["monto"]);

    #Sumamos los pagos que ocurrieron el mismo mes
    foreach ($arrayVentas as $key => $value) {

        $sumaPagosMes[$key] += $value;
    }
}


$noRepetirFechas = array_unique($arrayFechas);


$respuesta = ControladorMovimientos::ctrRangoFechasGastos($fechaInicial, $fechaFinal);

$arrayFechas = array();
$arrayVentas = array();
$sumaPagosMesGastos = array();

foreach ($respuesta as $key => $value) {

    #Capturamos sólo el año y el mes
    $fecha = substr($value["fecha"], 0, 7);

    #Introducir las fechas en arrayFechas
    array_push($arrayFechas, $fecha);

    #Capturamos las ventas
    $arrayVentas = array($fecha => $value["monto"]);

    #Sumamos los pagos que ocurrieron el mismo mes
    foreach ($arrayVentas as $key => $value) {

        $sumaPagosMesGastos[$key] += $value;
    }
}


$noRepetirFechas1 = array_unique($arrayFechas);

if ($noRepetirFechas != null) {

    /*foreach ($noRepetirFechas as $key) {
    $totales = $sumaPagosMes[$key];
  }*/
    $totales = $sumaPagosMes[$key];
} else {

    $totales = 0;
}

if ($noRepetirFechas1 != null) {

    /*foreach ($noRepetirFechas1 as $key) {
    $totales =  $totales - $sumaPagosMesGastos[$key];
  }*/
    $totales =  $totales - $sumaPagosMesGastos[$key];
} else {

    $totales =  $totales;
}
//var_dump($sumaPagosMes);
//var_dump($sumaPagosMesGastos);

$corte = ControladorCorte::mostrarCorte(0);

?>




<!--=====================================
GRÁFICO DE VENTAS
======================================-->
<div class="card card-solid bg-dark">
    <div class="row">
        <div class="col-md-6">
            <div class="card-header">



                <h3 class="card-title"> <i class="fa fa-th"></i> Gráfico de Ventas, Pedidos, Servicios, Ingresos </h3>

            </div>

            <div class="card-body border-radius-none nuevoGraficoVentas">

                <div class="chart" id="line-chart-ventas" style="height: 250px;"></div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card-header">



                <h3 class="card-title"><i class="fa fa-th"></i> Gráfico de Gastos</h3>

            </div>
            <div class="card-body border-radius-none nuevoGraficoVentas">

                <div class="chart" id="line-chart-gastos" style="height: 250px;"></div>

            </div>
        </div>
    </div>

    <hr>

    <script>
        var line = new Morris.Line({
            element: 'line-chart-ventas',
            resize: true,
            data: [

                <?php

                if ($noRepetirFechas != null) {

                    foreach ($noRepetirFechas as $key) {


                        echo "{ y: '" . $key . "', ventas: " . $sumaPagosMes[$key] . " },";
                    }
                    echo "{ y: '" . $key . "', ventas: " . $sumaPagosMes[$key] . " },";
                    $totales = $sumaPagosMes[$key];
                } else {

                    echo "{ y: '0', ventas: '0' }";
                }


                ?>

            ],
            xkey: 'y',
            ykeys: ['ventas'],
            labels: ['ventas'],
            lineColors: ['#efefef'],
            lineWidth: 4,
            hideHover: 'auto',
            gridTextColor: '#fff',
            gridStrokeWidth: 0.4,
            pointSize: 4,
            pointStrokeColors: ['#efefef'],
            gridLineColor: '#efefef',
            gridTextFamily: 'Open Sans',
            preUnits: '$',
            gridTextSize: 10
        });
    </script>
    <script>
        var line = new Morris.Line({
            element: 'line-chart-gastos',
            resize: true,
            data: [

                <?php

                if ($noRepetirFechas1 != null) {

                    foreach ($noRepetirFechas1 as $key) {


                        echo "{ y: '" . $key . "', gastos: " . $sumaPagosMesGastos[$key] . " },";
                    }

                    echo "{ y: '" . $key . "', gastos: " . $sumaPagosMesGastos[$key] . " },";

                    $totales =  $totales - $sumaPagosMesGastos[$key];
                } else {

                    echo "{ y: '0', gastos: '0' }";
                }


                ?>

            ],
            xkey: 'y',
            ykeys: ['gastos'],
            labels: ['gastos'],
            lineColors: ['#efefef'],
            lineWidth: 4,
            hideHover: 'auto',
            gridTextColor: '#fff',
            gridStrokeWidth: 0.4,
            pointSize: 4,
            pointStrokeColors: ['#efefef'],
            gridLineColor: '#efefef',
            gridTextFamily: 'Open Sans',
            preUnits: '$',
            gridTextSize: 10
        });
    </script>


</div>