<?php

class Alumno
{

    public $nombre;
    public $apellido;
    public $dni;
    public $fecha_nacimiento;

    public  function __construct($nombre, $apellido, $dni, $fecha_nacimiento)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
    public function insertarAlumno()
    {
        $constulta = ("INSERT INTO alumno (nombre, apellido, dni, fecha_nac) VALUES ('$this->nombre','$this->apellido','$this->dni','$this->fecha_nacimiento')");
        return $constulta;
    }
    public static function obtenerTodosLosAlumnos()
    {
        $constulta = ("SELECT * FROM alumno ORDER BY apellido");
        return $constulta;
    }
    public static function eliminarAlumno($dni)
    {
        $consulta = ("DELETE FROM alumno WHERE dni = '$dni'");
        return $consulta;
    }
    public static function obtenerAlumno($dni)
    {
        $consulta = ("SELECT * FROM alumno WHERE dni = '$dni'");
        return $consulta;
    }

    public static function actualizarAlumno($nombre, $apellido, $dni, $fecha_nacimiento, $dniViejo)
    {
        $consulta = ("UPDATE alumno SET nombre = '$nombre', apellido = '$apellido', dni = '$dni', fecha_nac = '$fecha_nacimiento' WHERE dni = '$dniViejo'");
        return $consulta;
    }
    public static function sugerenciaDni($dni)
    {
        $consulta = ("SELECT * FROM alumno WHERE dni LIKE '$dni%'");
        return $consulta;
    }
    public static function borrarTodo()
    {
        $consulta = ("DELETE FROM alumno");
        return $consulta;
    }
    public static function sugerenciaApellido($valor)
    {
        $consulta = ("SELECT * FROM alumno WHERE apellido LIKE '$valor%'");
        return $consulta;
    }
    public static function sugerenciaNombre($valor)
    {
        $consulta = ("SELECT * FROM alumno WHERE nombre LIKE '$valor%'");
        return $consulta;
    }
}
