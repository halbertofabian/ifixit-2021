<?php
require_once 'conexion.php';
class ModeloConfiguracion
{
    // Guardar textos
    public static function mdlGuardarText($texto, $id)
    {
        try {
            $sql = " UPDATE configuraciones_suc SET valor = ?  WHERE id = ? ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $texto);
            $pps->bindValue(2, $id);
            $pps->execute();
            return $pps->rowCount() > 0;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }

    public static function mdlObtenerTextos()
    {
        try {
            $sql = "SELECT * FROM  configuraciones_suc WHERE alias = 'texto_msj' ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->execute();
            return $pps->fetchAll();
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }
    public static function mdlObtenerTextoAtributo($atributo)
    {
        try {
            $sql = "SELECT * FROM  configuraciones_suc WHERE atributo = ? AND  alias = 'texto_msj' ";
            $con = Conexion::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $atributo);
            $pps->execute();
            return $pps->fetch();
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
            $con = null;
        }
    }
}
