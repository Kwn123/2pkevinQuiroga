<?php
class Asistencia
{
    public static function presente($dni, $fecha)
    {
        $consulta = "INSERT INTO asistencia (dni, fecha_asistencia) VALUES ('$dni', '$fecha')";
        return $consulta;
    }
    public static function eliminarAsistencia($dni)
    {
        $consulta = "DELETE FROM asistencia WHERE dni = '$dni'";
        return $consulta;
    }
    public static function obtenerTodasLasAsistencias()
    {
        $consulta = "SELECT * FROM asistencia";
        return $consulta;
    }
    public static function contadorAsistencias($dni)
    {
        $consulta = "SELECT COUNT(*) as contador FROM asistencia WHERE dni = '$dni'";
        return $consulta;
    }
    public static function obtenerAsistencia($id)
    {
        $consulta = "SELECT * FROM asistencia WHERE id = '$id'";
        return $consulta;
    }
    public static function actualizarAsistencia($id, $dni, $fecha)
    {
        $consulta = "UPDATE asistencia SET dni = '$dni', fecha_asistencia = '$fecha' WHERE id = '$id'";
        return $consulta;
    }
    public static function verificarPorcentajeAsistencia($clasesTotales, $promocion, $regular, $asistencias){

        $porcentajeAsistencia = number_format((($asistencias / $clasesTotales) * 100), 0);

        if ($porcentajeAsistencia >= $promocion) {
            $estado = ("<div class='alert alert-success d-flex justify-content-center align-items-center' style='height:5px'>$porcentajeAsistencia%</div>");
            return $estado;
        } else if ($porcentajeAsistencia >= $regular) {
            $estado = ("<div class='alert alert-warning d-flex justify-content-center align-items-center' style='height:5px'>$porcentajeAsistencia%</div>");
            return $estado;
        } else {
            $estado = ("<div class='alert alert-danger d-flex justify-content-center align-items-center' style='height:5px'>$porcentajeAsistencia%</div>");
            return $estado;
        }
    }

    public static function ordenarTodasAsistenciasOrdenadas (){
        $consulta = "SELECT DATE(fecha_asistencia) AS fecha, COUNT(*) AS total_asistencias FROM asistencia GROUP BY DATE(fecha_asistencia) ORDER BY fecha DESC;";
        return $consulta;
    }
    public static function obtenerAsistenciasPorFecha($fecha){
        $consulta = "SELECT * FROM asistencia WHERE fecha_asistencia  LIKE '$fecha%'";
        return $consulta;
    }
    public static function borrarTodo(){
        $consulta = "DELETE FROM asistencia";
        return $consulta;
    }
    public static function contarAsistencia($dni,$fecha){
        $consulta = "SELECT COUNT(*) as contador FROM asistencia WHERE dni = '$dni' AND fecha_asistencia LIKE '$fecha %';";
        return $consulta;
    }
}
