<?php
session_start();
require_once '../modelos/updateDB.modelo.php';
require_once '../modelos/sucursales.modelo.php';


class UpdateDBAjax
{
    public $token_suc;
    public $sql;

    public function alterTableAjax()
    {

        $res = ModeloUpdateDB::alterTable($_POST['content_sql']);
        if ($res) {

            $_POST['id_suc'] = $_SESSION['nom_suc'];
            date_default_timezone_set($_SESSION["zona"]);
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');

            $_POST['fecha_actualizacion'] = $fecha . ' ' . $hora;

            $act = ModeloUpdateDB::mdlCrearDetalleAct($_POST);


            $estadoAct = ModeloSucursal::mdlActSuc($_POST['token_suc']);


            echo json_encode(true, true);
        } else {
            echo json_encode(false, true);
        }
        // echo json_encode($res, true);
    }
}

if (isset($_POST['btnActualizarSuc'])) {
    $act = new UpdateDBAjax();
    $act->token_suc = $_POST['token_suc'];
    $act->sql = $_POST['content_sql'];
    $act->alterTableAjax();
}
