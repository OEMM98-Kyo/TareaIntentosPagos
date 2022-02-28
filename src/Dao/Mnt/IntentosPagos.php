<?php

namespace Dao\Mnt;
use Dao\Table;

/* 
 `intentospagos` (
    `id` int NOT NULL AUTO_INCREMENT,
    `fecha` date NOT NULL,
    `cliente` varchar(128) NOT NULL,
    `monto` double NOT NULL,
    `fechaven` date NOT NULL,
    `estado` enum('ENV','PGD','CNL','ERR') NOT NULL DEFAULT 'ENV',
    PRIMARY KEY (`id`)
  ) 
*/

class IntentosPagos extends Table
{
    //LISTAR TODOS
    public static function obtenerIntentosPagos()
    {
        $sqlstr = "select * from intentosPagos;";
        return self::obtenerRegistros(
            $sqlstr,
            array()
        );
    }

    //LISTAR POR ID
    public static function obtenerPorId($id)
    {
        $sqlstr = "select * from intentosPagos where id=:id;";
        return self::obtenerUnRegistro(
            $sqlstr,
            array("id"=>$id)
        );
    }

    //AGREGAR
    public static function nuevoIntentosPagos($fecha, $cliente, $monto, $fechaVenc, $estado)
    {
        $sqlstr= "INSERT INTO intentoPagos (fecha,cliente,monto,fechaVenc,estado) values (:fecha, :cliente, :monto, :fechaVenc, :estado);";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "fecha" => $fecha,
                "cliente" => $cliente,
                "monto" => $monto,
                "fechaVenc" => $fechaVenc,
                "estado" => $estado
            )
        );
    }

    //ACTUALIZAR
    public static function actualizarIntentosPagos($cliente, $estado, $id)
    {
        $sqlstr = "UPDATE intentoPagos set cliente=:cliente, estado=:estado where id=:id";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "cliente" => $cliente,
                "estado" => $estado,
                "id" => $id
            )
        );
    }

    //BORRAR
    public static function eliminarIntentosPagos($id)
    {
        $sqlstr = "DELETE FROM intentoPagos where id=:id;";
        return self::executeNonQuery(
            $sqlstr,
            array(
                "id" => $id
            )
        );
    }
}

?>