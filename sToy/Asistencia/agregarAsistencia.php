<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

include("../BD/BdClass.php");
include("../Clases/AlumnoClass.php");
include("../Clases/AsistenciaClass.php");
require("../Clases/ParametroClass.php");
$conexion = new Conexion();
$conexion->conectar();

$consulta = Parametro::getParametros();
$parametros = $conexion->ejecutaConsulta($consulta)->fetch_object();

$fecha = Date('Y-m-d');
$año = Date('Y');

isset($_GET['dni']) ? $dni = $_GET['dni'] : $dni = null;

$consulta = Alumno::obtenerAlumno($dni);
$alumno = $conexion->ejecutaConsulta($consulta)->fetch_object();

if (!isset($alumno)) {
    $alumno = new Alumno("Alumno no existe", "", 0, '01-01-0001');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Estilos/css/style.css">
    <link rel="stylesheet" href="../Estilos/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Estilos/css/sweetalert2.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar asistencia</title>
</head>

<body>
    <?php include("../PHP/navbar.php") ?>

    <div class="container-fondo d-flex justify-content-center align-items-center" style="height: 88vh">
        <div class="container d-flex justify-content-center text-center align-items-center" style="height: 70vh">
            <div class="container-form rounded w-50 mt-1 px-4 py-5 mb-100" style="background-color: white">
                <form action="#" method="POST" class="d-flex flex-column align-items-center w-100">
                    <h4 class="mb-3 h-auto">Ingresa fecha y hora de asistencia</h4>
                    <p>Alumno: <?php echo "$alumno->apellido, $alumno->nombre Dni: $alumno->dni"; ?></p>
                    <div class="mb-3 d-flex align-items-center">

                        <label for="asistencia" class="form-label me-2 mt-1">Asistencia</label>
                        <input class="form-control mt-1" type="datetime-local" name="asistencia" id="asistencia" max="<?php echo "$fecha" . "T" . "00:00" ?>" min="<?php echo "$año" . "-01-01" . "T" . "00:00" ?>">
                    </div>
                    <button class="btn btn-primary align-self-center mb-2" type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../Estilos/js/sweetalert2.all.min.js"></script>
    <script src="../Estilos/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php

if (isset($_POST["asistencia"])) {
    $fechaCompleta  = $_POST["asistencia"];
    if (!empty($fechaCompleta)) {
        $partes = explode('T', $fechaCompleta);
        $fecha = $partes[0];
        $hora = $partes[1];
        $dia = date("w", strtotime($fecha));
        
        echo $dia;

        $consulta = Asistencia::contarAsistencia($dni, $fecha);
        $resultado = $conexion->ejecutaConsulta($consulta)->fetch_object();

        if ($dia != 0 && $dia != 6) {
            if ($hora >= $parametros->hora_inicio && $hora <= $parametros->hora_fin) {
                if ($hora >= $parametros->tolerancia && $hora <= $parametros->hora_fin) {
                    if ($resultado->contador < 1) {
                        $consulta = Asistencia::presente($dni, $fechaCompleta);
                        $conexion->ejecutaConsulta($consulta);
                        echo "<script>Swal.fire('Asistencia registrada, alumno ingreso tarde', '', 'success');</script>";
                    } else {
                        echo "<script>Swal.fire('Ya se registro la asistencia', '', 'error');</script>";
                    }
                } else {
                    if ($resultado->contador < 1) {
                        $consulta = Asistencia::presente($dni, $fechaCompleta);
                        $conexion->ejecutaConsulta($consulta);
                        echo "<script>Swal.fire('Asistencia registrada', '', 'success');</script>";
                    } else {
                        echo "<script>Swal.fire('Ya se registro la asistencia', '', 'error');</script>";
                    }
                }
            } else {
                echo "<script>Swal.fire('La hora no es válida', '', 'error');</script>";
            }
        } else {
            echo "<script>Swal.fire('Es fin de semana', '', 'error');</script>";
        }
    } else {
        echo "<script>Swal.fire('La fecha no es válida', '', 'error');</script>";
    }
}


?>