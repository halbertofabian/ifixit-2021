<?php   
    class ModeloUpdateDB{
        public static function alterTable($sql){
            try {
                //code...
                $pps = Conexion::conectar();
                $pps = $pps->prepare($sql);

               return $pps->execute();

            


            } catch (\PDOException $th) {
                throw $th;
                return false;

            }finally{
                $pps = null;
            }
        }
    }