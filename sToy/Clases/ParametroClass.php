<?php
class Parametro
{
    public static function getParametros()
    {
        $consulta = ("SELECT * FROM parametro");
        return $consulta;
    }
    public static function setClases($id, $clases)
    {
        $consulta = ("UPDATE parametro SET total_clases = '$clases' WHERE id = '$id'");
        return $consulta;
    }
    public static function setPromocion($id, $promocion)
    {
        $consulta = ("UPDATE parametro SET promocion = '$promocion' WHERE id = '$id'");
        return $consulta;
    }
    public static function setRegular($id, $regular)
    {
        $consulta = ("UPDATE parametro SET regular = '$regular' WHERE id = '$id'");
        return $consulta;
    }
}
