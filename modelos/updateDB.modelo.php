<?php
require_once 'conexion.php';
require_once 'conexion-softmor.php';
class ModeloUpdateDB
{
    public static function alterTable($sql)
    {
        try {
            //code...
            $pps = Conexion::conectar();
            $pps = $pps->prepare($sql);

            return $pps->execute();
        } catch (\PDOException $th) {
            throw $th;
            return false;
        } finally {
            $pps = null;
        }
    }

    public static function mdlCrearBD($sql)
    {
        try {
            $pps = Conexion::conectar()->prepare($sql);
            return  $pps->execute();
        } catch (\PDOException $th) {
            throw $th;
            return false;
        } finally {
            $pps = null;
        }
    }

    public static function mdlObtenerModulo($modulo)
    {
        try {
            $sql = "SELECT * FROM ifixit_modulos WHERE modulo  = ? ";
            $pps = ConexionSoftmor::conectar()->prepare($sql);
            $pps->bindValue(1, $modulo);
            $pps->execute();
            return $pps->fetch();
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
        }
    }

    public static function mdlObtenerBD()
    {
        try {
            $sql = "SELECT * FROM Banco_datos WHERE usar = 0 ORDER BY id ASC LIMIT 1 ";
            $pps = ConexionSoftmor::conectar()->prepare($sql);
            $pps->execute();
            return $pps->fetch();
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
        }
    }

    public static function mdlActualizarDisponibilidad($id)
    {
        try {
            $sql = "UPDATE Banco_datos SET usar = 1 WHERE id = ?";
            $pps = ConexionSoftmor::conectar()->prepare($sql);
            $pps->bindValue(1, $id);
            $pps->execute();
            return $pps->rowCount();
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
        }
    }
}
