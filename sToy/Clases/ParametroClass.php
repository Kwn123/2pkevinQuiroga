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
    public static function setHoraEntrada($id, $horaEntrada){
        $consulta = ("UPDATE parametro SET hora_inicio = '$horaEntrada' WHERE id = '$id'");
        return $consulta;
    }
    public static function setHoraSalida($id, $horaSalida){
        $consulta = ("UPDATE parametro SET hora_fin = '$horaSalida' WHERE id = '$id'");
        return $consulta;
    }
    public static function setTolerancia($id, $tolerancia){
        $consulta = ("UPDATE parametro SET tolerancia = '$tolerancia' WHERE id = '$id'");
        return $consulta;
    
    }
}
