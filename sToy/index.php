<?php
include("./BD/BdClass.php");
require("./Clases/ParametroClass.php");
include("./Clases/AlumnoClass.php");
include("./Clases/AsistenciaClass.php");
include("./Clases/AlertasClass.php");

date_default_timezone_set('America/Argentina/Buenos_Aires');

$conexion = new Conexion();
$conexion->conectar();

$consulta = Parametro::getParametros();
$parametros = $conexion->ejecutaConsulta($consulta)->fetch_object();
$horaInicio = $parametros->hora_inicio;
$horaFin = $parametros->hora_fin;
$tolerancia = $parametros->tolerancia;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Estilos/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Estilos/css/style.css">
    <link rel="stylesheet" href="/Estilos/css/sweetalert2.min.css">
    <title>sToy</title>
</head>

<body>
    <?php include("./PHP/navbar.php") ?>
    <div class="container-fondo d-flex justify-content-center align-items-center" style="height: 88vh">
        <div class="container container-index d-flex justify-content-center text-center align-items-center" style="height: 20vh">
            <div style="width: 50vh">
                <img src="../Multimedia/icono.png" class="" style="margin-bottom: 10px; margin-top: 20px; ">
                <form action="" style="margin-bottom: 0px; ">
                    <input autocomplete="off" type="text" id="fname" name="fname" placeholder="Ingrese dato a buscar" onkeyup="sugerenciaPresente(this.value)">
                </form>
            </div>
        </div>
        <div id="sugerencia" class="text-center" style="height: 50vh">
        </div>
    </div>

    <script src="/Estilos/js/sweetalert2.all.min.js"></script>
    <script src="/Estilos/js/bootstrap.bundle.min.js"></script>


    <?php

    if (isset($_GET["eliminado"])) {
        if ($_GET["eliminado"] == true) {
            Alerta::alumnoEliminado();
        }
    }
    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["dni"])) {
        $dni = $_GET["dni"];
        if (!empty($dni)) {
            $alumno = Alumno::obtenerAlumno($dni);
            $alumno = $conexion->ejecutaConsulta($alumno)->fetch_object();

            $fechaCompleta = date('Y-m-d H:i');
            $partes = explode(' ', $fechaCompleta);
            $fecha = $partes[0];
            $hora = $partes[1];
            
            $consulta = Asistencia::contarAsistencia($dni, $fecha);
            $resultado = $conexion->ejecutaConsulta($consulta)->fetch_object();

            $fecha = date('Y-m-d H:i');
            if ($resultado->contador < 1) {
                if ($alumno) {
                    if ($hora >= $horaInicio && $hora <= $horaFin) {
                        $asistencia = Asistencia::presente($dni, $fecha);
                        $conexion->ejecutaConsulta($asistencia);
                        if ($hora >= $tolerancia && $hora <= $horaFin) {   
                            Alerta::presenteTarde($alumno->nombre, $alumno->apellido);
                        } else {
                            Alerta::presente($alumno->nombre, $alumno->apellido);
                        }
                    } else {
                        Alerta::horaIncorrecta();
                    }
                }
            }
        }
    }
    
    ?>
    <script src="/Funciones/funciones.js"></script>
</body>
</html>

