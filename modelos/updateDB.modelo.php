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

    public static function mdlObtenerActualizacionesInstaladas($id_suc)
    {
        try {
            $sql = "SELECT * FROM detalle_actualizacion WHERE id_suc = ?";
            $con = ConexionSoftmor::conectar();
            $pps = $con->prepare($sql);
            $pps->bindValue(1, $id_suc);
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
    public static function mdlObtenerActualizaciones()
    {
        try {
            $sql = "SELECT * FROM lista_actualizaciones";
            $con = ConexionSoftmor::conectar();
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

    public static function mdlCrearDetalleAct($detalle)
    {
        try {
            $sql = "INSERT INTO detalle_actualizacion (id_suc,id_actualizacion,fecha_actualizacion) 
                VALUES(?,?,?)";
            $pps = ConexionSoftmor::conectar()->prepare($sql);
            $pps->bindValue(1, $detalle['id_suc']);
            $pps->bindValue(2, $detalle['id_actualizacion']);
            $pps->bindValue(3, $detalle['fecha_actualizacion']);
            $pps->execute();
            return $pps->errorInfo();
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        } finally {
            $pps = null;
        }
    }
}
