<?php
session_start();
require_once '../modelos/sucursales.modelo.php';

class AjaxSucursal
{

    //public $nom_suc;

    public function eliminarLogoAjax()
    {
        $res = ModeloSucursal::mdlEliminarLogoSuc($_SESSION['nom_suc']);
        echo json_encode($res);
    }
}

if (isset($_POST['isDeleteLogo'])) {
    $logo = new AjaxSucursal();
    $logo->eliminarLogoAjax();
}
