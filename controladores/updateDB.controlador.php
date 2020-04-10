<?php
class ControladorUpdateDB
{
    public static function alterTable()
    {
        if (isset($_POST['btnUpdateTable'])) {
            $sql = "CREATE TABLE `slide` (
                `id` int(11) NOT NULL,
                `nombre` text COLLATE utf8_spanish_ci NOT NULL,
                `imgFondo` text COLLATE utf8_spanish_ci NOT NULL,
                `tipoSlide` text COLLATE utf8_spanish_ci NOT NULL,
                `imgProducto` text COLLATE utf8_spanish_ci NOT NULL,
                `estiloImgProducto` text COLLATE utf8_spanish_ci NOT NULL,
                `estiloTextoSlide` text COLLATE utf8_spanish_ci NOT NULL,
                `titulo1` text COLLATE utf8_spanish_ci NOT NULL,
                `titulo2` text COLLATE utf8_spanish_ci NOT NULL,
                `titulo3` text COLLATE utf8_spanish_ci NOT NULL,
                `boton` text COLLATE utf8_spanish_ci NOT NULL,
                `url` text COLLATE utf8_spanish_ci NOT NULL,
                `orden` int(11) NOT NULL,
                `fecha` datetime NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;     
              ALTER TABLE `slide`
              ADD PRIMARY KEY (`id`);
              ALTER TABLE `slide` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;    
              ";

            $alter = ModeloUpdateDB::alterTable($sql);

            var_dump($alter);
        }
    }
}
