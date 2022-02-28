<?php

//Este nombre tiene que coincidir con el nombre de la CARPETA
namespace Controllers\Clientes;

use Controllers\PublicController;
use Views\Renderer;

//Este nombre debe coincidir con el nombre del ARCHIVO .php
class Clientes extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["titulo"] = "Manejo de Clientes";
        $viewData["clientes"] = array(
            "Orlando",
            "Josue",
            "Adriana",
            "Carlos Gabriel",
            "Argelio"
        );
        Renderer::render('Clientes/Clientes', $viewData);
    }
}

?>
