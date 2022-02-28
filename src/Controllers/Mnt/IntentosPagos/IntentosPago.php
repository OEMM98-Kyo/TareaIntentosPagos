<?php

namespace Controllers\Mnt\IntentosPagos;

use Controllers\PublicController;
use Views\Renderer;

class IntentosPago extends PublicController
{
    private $_modeStrings = array(
        "INS" => "Nuevo IntentosPagos",
        "UPD" => "Editar %s (%s)",
        "DSP" => "Detalle de %s (%s)",
        "DEL" => "Eliminando %s (%s)"
    );
    private $_estadoOptions = array(
        "ENV" => "Enviado",
        "PGD" => "Pagado",
        "CNL" => "Cancelado",
        "ERR" => "Error"
    );
    private $_viewData = array(
        "mode"=>"INS",
        "id"=>0,
        "fecha"=>"",
        "cliente"=>"",
        "monto"=>"",
        "fechaven" =>"",
        "estado"=>"ENV",
        "modeDsc"=>"",
        "readonly"=>false,
        "isInsert"=>false,
        "estadoOptions"=>[],
        "crsxToken"=>""
    );
    private function init(){
        if (isset($_GET["mode"])) {
            $this->_viewData["mode"] = $_GET["mode"];
        }
        if (isset($_GET["id"])) {
            $this->_viewData["id"] = $_GET["id"];
        }
        if (!isset($this->_modeStrings[$this->_viewData["mode"]])) {
            error_log(
                $this->toString() . " Mode not valid " . $this->_viewData["mode"],
                0
            );
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.intentospagos.intentospagos',
                'Sucedio un error al procesar la página.'
            );
        }
        if ($this->_viewData["mode"] !== "INS" && intval($this->_viewData["id"], 10) !== 0) {
            $this->_viewData["mode"] !== "DSP";
        }
    }
    
    private function handlePost()
    {
        \Utilities\ArrUtils::mergeFullArrayTo($_POST, $this->_viewData);


        if (!(isset($_SESSION["intentosPagos_crsxToken"])
            && $_SESSION["intentosPagos_crsxToken"] == $this->_viewData["crsxToken"] )
        ) {
            unset($_SESSION["intentosPagos_crsxToken"]);
            \Utilities\Site::redirectToWithMsg(
                'index.php?page=mnt.intentospagos.intentospagos',
                'Ocurrio un error, no se puede procesar el formulario.'
            );
        }


        $this->_viewData["id"] = intval($this->_viewData["id"], 10);
        if (!\Utilities\Validators::isMatch(
            $this->_viewData["estado"],
            "/^(ENV)|(PGD)|(CNL)|(ERR)$/"
        )
        ) {
            $this->_viewData["errors"][] = "Estado debe ser ENV o PGD o CNL o ERR";
        }

        if (isset($this->_viewData["errors"]) && count($this->_viewData["errors"]) > 0 ) {

        } else {
            unset($_SESSION["intentosPagos_crsxToken"]);
            switch ($this->_viewData["mode"]) {
            case 'INS':
                # code...
                $result = \Dao\Mnt\intentosPagos::nuevoIntentosPagos(
                    $this->_viewData["fecha"],
                    $this->_viewData["cliente"], 
                    $this->_viewData["monto"],
                    $this->_viewData["fechaven"],
                    $this->_viewData["estado"]
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.intentospagos.intentospagos',
                        "¡Intento guardado satisfactoriamente!"
                    );
                }
                break;
            case 'UPD':
                $result = \Dao\Mnt\intentosPagos::actualizarIntentosPagos(
                    $this->_viewData["id"], 
                    $this->_viewData["cliente"], 
                    $this->_viewData["estado"]
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.intentospagos.intentospagos',
                        "¡Intento actualizado satisfactoriamente!"
                    );
                }
                break;
            case 'DEL':
                $result = \Dao\Mnt\intentosPagos::eliminarIntentosPagos(
                    $this->_viewData["id"]
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        'index.php?page=mnt.intentospagos.intentospagos',
                        "¡Intento eliminado satisfactoriamente!"
                    );
                }
                break;
            default:
                # code...
                break;
            }
        }
    }

    private function prepareViewData()
    {
        if ($this->_viewData["mode"] == "INS") {
             $this->_viewData["modeDsc"]
                 = $this->_modeStrings[$this->_viewData["mode"]];
        } else {
            $tmpintentosPagos = \Dao\Mnt\intentosPagos::obtenerPorid(
                intval($this->_viewData["id"], 10)
            );
            \Utilities\ArrUtils::mergeFullArrayTo($tmpintentosPagos, $this->_viewData);
            $this->_viewData["modeDsc"] = sprintf(
                $this->_modeStrings[$this->_viewData["mode"]],
                $this->_viewData["id"], 
                $this->_viewData["fecha"],
                $this->_viewData["cliente"], 
                $this->_viewData["monto"],
                $this->_viewData["fechaven"],
                $this->_viewData["estado"]
            );
        }
        $this->_viewData["estadoOptions"]
            = \Utilities\ArrUtils::toOptionsArray(
                $this->_estadoOptions,
                'value',
                'text',
                'selected',
                $this->_viewData['estado']
            );

        $this->_viewData["crsxToken"] = md5(time()."intentosPagos");
        $_SESSION["intentosPagos_crsxToken"] = $this->_viewData["crsxToken"]; 
    }
    public function run(): void{
        $this->init();
        if ($this->isPostBack()) {
            $this->handlePost();
        }
        $this->prepareViewData();
        Renderer::render('mnt/IntentosPago', $this->_viewData);
    }
}

?>