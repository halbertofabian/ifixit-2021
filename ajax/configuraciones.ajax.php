<?php
session_start();
require_once '../modelos/configuracion.modelo.php';

class ConfiguracionesAjax
{
    public $atributo;

    public function ajaxGuardarText()
    {
        $res = ModeloConfiguracion::mdlGuardarText($_POST['texto'], $_POST['id']);

        echo json_encode($res, true);
    }
    public function obtenerText()
    {
        $res = ModeloConfiguracion::mdlObtenerTextoAtributo($this->atributo);

        echo json_encode($res, true);
    }
}
if (isset($_POST['changeTextMsj'])) {
    $change = new ConfiguracionesAjax();
    $change->ajaxGuardarText();
}
if (isset($_POST['btnObtenerEstado'])) {
    $change = new ConfiguracionesAjax();
    $change->atributo = $_POST['atributo'];
    $change->obtenerText();
}
