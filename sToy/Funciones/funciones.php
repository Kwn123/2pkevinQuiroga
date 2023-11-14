<?php
include("../BD/BdClass.php");
include("../Clases/AlumnoClass.php");
include("../Clases/AsistenciaClass.php");
require("../Clases/ParametroClass.php");
$conexion = new Conexion();
$conexion->conectar();

date_default_timezone_set('America/Argentina/Buenos_Aires');

/*------------------------------------ FUNCION INDEX----------------------------------------------------------- */
if (isset($_GET['dniPresente'])) {
    $dni = $_GET['dniPresente'];
    $consulta = Alumno::sugerenciaDni($dni);
    $sugerencia = $conexion->ejecutaConsulta($consulta)->fetch_all();

    $fecha = date("Y-m-d");
    if (empty($sugerencia[0])) {
        echo "<div class='caja-index alert alert-info mt-5' style=' overflow-y: auto; '>";
        echo ("No existe el alumno");
        echo "</div>";
    } else {
        echo "<div class='caja-index alert alert-info mt-5' style=' overflow-y: auto; '>";
        echo "<div class='d-flex justify-content-center'style='margin-top:0%;'>";
        echo "<table class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Dni</th>";
        echo "<th>Nombre</th>";
        echo "<th>Apellido</th>";
        echo "<th>Fecha nacimiento</th>";
        echo "<th>Accion</th>";
        echo "</tr>";
        echo " </thead>";
        echo "<tbody>";
        foreach ($sugerencia as $sugerencias) {

            $consulta = Asistencia::contarAsistencia($sugerencias[0], $fecha);
            $resultado = $conexion->ejecutaConsulta($consulta)->fetch_object();

            if ($resultado->contador < 1) {
                echo "<tr>";
                echo "<td>  $sugerencias[0] </td>";
                echo "<td>  $sugerencias[1] </td>";
                echo "<td>  $sugerencias[2] </td>";
                $fechaVuelta = date("d/m/Y", strtotime($sugerencias[3]));
                echo "<td>  $fechaVuelta </td>";
                echo "<td><a href='../index.php?dni=$sugerencias[0]&?presente=true'><img src='../Multimedia/check.svg'  class='img-fluid imagen-icono-ajustes' style='margin-right: 5px;'></a> <a href='../Asistencia/agregarAsistencia.php?dni=$sugerencias[0]'><img src='../Multimedia/plus.svg'  class='img-fluid imagen-icono-ajustes' style='margin-right: 5px;'></a></td>";
            } else {
                echo "<tr>";
                echo "<td>  $sugerencias[0] </td>";
                echo "<td>  $sugerencias[1] </td>";
                echo "<td>  $sugerencias[2] </td>";
                $fechaVuelta = date("d/m/Y", strtotime($sugerencias[3]));
                echo "<td>  $fechaVuelta </td>";
                echo "<td><img src='../Multimedia/check2.svg' alt='' class='img-fluid imagen-icono-ajustes' style='margin-right: 5px;'> <a href='../Asistencia/agregarAsistencia.php?dni=$sugerencias[0]'><img src='../Multimedia/plus.svg'  class='img-fluid imagen-icono-ajustes' style='margin-right: 5px;'></a></td>";
            }
        }
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}
/*--------------------------------------------------------------------- */
if (isset($_GET["nombrePresente"])) {
    $valor = $_GET["nombrePresente"];
    $consultaApellidos = Alumno::sugerenciaApellido($valor);
    $sugerenciaApellidos = $conexion->ejecutaConsulta($consultaApellidos)->fetch_all();

    $consultaNombres = Alumno::sugerenciaNombre($valor);
    $sugerenciaNombres = $conexion->ejecutaConsulta($consultaNombres)->fetch_all();

    $resultados = array_merge($sugerenciaApellidos, $sugerenciaNombres);

    $fecha = date("Y-m-d");

    if (empty($resultados)) {
        echo "<div class='caja-index alert alert-info mt-5' style=' overflow-y: auto; '>";
        echo ("No existen alumnos con la letra ingresada.");
        echo "</div>";
    } else {
        echo "<div class='caja-index alert alert-info mt-5' style=' overflow-y: auto; '>";
        echo "<div class='d-flex justify-content-center' style='margin-top:0%;'>";
        echo "<table class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Dni</th>";
        echo "<th>Nombre</th>";
        echo "<th>Apellido</th>";
        echo "<th>Fecha nacimiento</th>";
        echo "<th>Accion</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($resultados as $sugerencia) {

            $consulta = Asistencia::contarAsistencia($sugerencia[0], $fecha);
            $resultado = $conexion->ejecutaConsulta($consulta)->fetch_object();
            echo "<tr>";
            echo "<td>  $sugerencia[0] </td>";
            echo "<td>  $sugerencia[1] </td>";
            echo "<td>  $sugerencia[2] </td>";
            $fechaVuelta = date("d/m/Y", strtotime($sugerencia[3]));
            echo "<td>  $fechaVuelta </td>";

            if ($resultado->contador < 1) {
                echo "<td><a href='../index.php?dni=$sugerencia[0]'><img src='../Multimedia/check.svg' alt='' class='img-fluid imagen-icono-ajustes' style='margin-right: 5px;'></a> <a href='../Asistencia/agregarAsistencia.php?dni=$sugerencia[0]'><img src='../Multimedia/plus.svg' alt='' class='img-fluid imagen-icono-ajustes' style='margin-right: 5px;'></a></td>";
            } else {
                echo "<td><img src='../Multimedia/check2.svg' alt='' class='img-fluid imagen-icono-ajustes' style='margin-right: 5px;'> <a href='../Asistencia/agregarAsistencia.php?dni=$sugerencia[0]'><img src='../Multimedia/plus.svg' alt='' class='img-fluid imagen-icono-ajustes' style='margin-right: 5px;'></a></td>";
            }
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}

//----------------------------------------------------------------------------------------------- 

if (isset($_GET["eliminar"]) && isset($_GET['id'])) {
    if ($_GET["eliminar"] == true) {
        $id = $_GET['id'];
        $consulta = Asistencia::eliminarAsistenciaId($id);
        $conexion->ejecutaConsulta($consulta);
        header("Location: ../Asistencia/asistenciaLista.php?eliminado=true");
    }
}

if (isset($_GET['dni']) && isset($_GET["eliminar"])) {
    $dni = $_GET["dni"];
    if (!empty($_GET['dni'])) {
        $consulta = Asistencia::eliminarAsistencia($dni);
        $conexion->ejecutaConsulta($consulta);

        $consulta = Alumno::eliminarAlumno($dni);
        $conexion->ejecutaConsulta($consulta);
        header("Refresh: 0; url=/index.php?eliminado=true");
    }
}
//--------------------------PARAMETROS---------------------------
$consulta = Parametro::getParametros();
$parametros = $conexion->ejecutaConsulta($consulta);
$parametros = $parametros->fetch_object();
$id = $parametros->id;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clasesTotal']) && isset($_POST['promocion']) && isset($_POST['regular'])) {
    $clasesTotal = $_POST['clasesTotal'];
    $promocion = $_POST['promocion'];
    $regular = $_POST['regular'];

    if (!empty($clasesTotal)) {
        $consulta = Parametro::setClases($id, $clasesTotal);
        $conexion->ejecutaConsulta($consulta);
    }
    if (!empty($promocion)) {
        $consulta = Parametro::setPromocion($id, $promocion);
        $conexion->ejecutaConsulta($consulta);
    }
    if (!empty($regular)) {
        $consulta = Parametro::setRegular($id, $regular);
        $conexion->ejecutaConsulta($consulta);
    }
    header("Location: ../index.php");
}
//--------------------------HORARIOS---------------------------
if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['horaInicio']) && isset($_POST['horaFin']) && isset($_POST['tolerancia']) ) {
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];
    $tolerancia = $_POST['tolerancia'];

    if (!empty($horaInicio)) {
        $consulta = Parametro::setHoraEntrada($id, $horaInicio);
        $conexion->ejecutaConsulta($consulta);
    }
    if (!empty($horaFin)) {
        $consulta = Parametro::setHoraSalida($id, $horaFin);
        $conexion->ejecutaConsulta($consulta);
    }
    if (!empty($tolerancia)) {
        $consulta = Parametro::setTolerancia($id, $tolerancia);
        $conexion->ejecutaConsulta($consulta);
    }
    header("Location: ../index.php");
}
//-----------------------------------------------------------------
