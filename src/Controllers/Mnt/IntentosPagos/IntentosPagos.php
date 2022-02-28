<?php
namespace Controllers\Mnt\IntentosPagos;

use Controllers\PublicController;
use Views\Renderer;

/*
  intentosPagos
  `id` BIGINT(8) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `cliente` VARCHAR(128) NOT NULL,
  `monto` NUMERIC(13,2) NOT NULL,
  `fechaVenc` DATE NOT NULL,
  `estado` CHAR(3) NOT NULL DEFAULT 'ENV',
*/

class IntentosPagos extends PublicController 
{
    public function run(): void
    {
        $viewData = array();
        $viewData["IntentosPagos"]
            = \Dao\Mnt\IntentosPagos::obtenerIntentosPagos();
        Renderer::render('mnt/IntentosPagos', $viewData);
    }
}

?>