<?php 
include("../BD/BdClass.php");
include("../Clases/AlumnoClass.php");
include("../Clases/AsistenciaClass.php");
$conexion = new Conexion();
$conexion->conectar();
        if (isset($_GET['dni'])) {
            $dni = $_GET["dni"];
            if (!empty($_GET['dni'])) {
                $consulta = Asistencia::eliminarAsistencia($dni);
                $conexion->ejecutaConsulta($consulta);
                $consulta = Alumno::eliminarAlumno($dni);
                $conexion->ejecutaConsulta($consulta);
                echo "<script>alert('Alumno eliminado')</script>";
                header("Refresh: 0; url=/index.php");
            }
        }
