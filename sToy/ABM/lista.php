<?php
include("../BD/BdClass.php");
include("../Clases/AsistenciaClass.php");
include("../Clases/AlertasClass.php");
include("../Clases/AlumnoClass.php");
require("../Clases/ParametroClass.php");
$conexion = new Conexion();
$conexion->conectar();

$consulta = Alumno::obtenerTodosLosAlumnos();
$alumnos = $conexion->ejecutaConsulta($consulta)->fetch_all();

$consulta = Parametro::getParametros();
$parametros = $conexion->ejecutaConsulta($consulta)->fetch_object();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estilos/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Estilos/css/style.css">
    <link rel="stylesheet" href="../Estilos/css/sweetalert2.min.css">

    <title>lista alumnos</title>
</head>

<body>
    <?php include("../PHP/navbar.php") ?>

    <div class="container-fondo d-flex justify-content-center align-items-center " style="height: 88vh">
        <div class='alert alert-info text-center mt-5' style="width: 80%; margin-bottom: 5%; overflow-y: auto;">
            <h2>Lista de alumnos</h2>
            <?php
            if (empty($alumnos)) {
                echo "No hay alumnos registrados.";
                echo "<br>";
                echo "<br>";
            } else {
                echo "<table class='table table-hover'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Dni</th>";
                echo "<th>Nombre</th>";
                echo "<th>Apellido</th>";
                echo "<th>Fecha nacimiento</th>";
                echo "<th>Estado</th>";
                echo "<th>Accion</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                
                
                foreach ($alumnos as $alumno) {
                    $consulta = Asistencia::contadorAsistencias($alumno[0]);
                    $total = $conexion->ejecutaConsulta($consulta)->fetch_object();
                    $consulta = Asistencia::tarde($parametros->tolerancia,$parametros->hora_fin,$alumno[0]);

                    $asistenciasTardias = $conexion->ejecutaConsulta($consulta)->fetch_object();
                    $totalAsistencia = $total->contador - $asistenciasTardias->tarde;
                    
                    $estado = Asistencia::verificarPorcentajeAsistencia($parametros->total_clases, $parametros->promocion, $parametros->regular, $totalAsistencia,$asistenciasTardias->tarde);
                    
                    echo "<tr>";
                    echo "<td>$alumno[0]</td>";
                    echo "<td>$alumno[1]</td>";
                    echo "<td>$alumno[2]</td>";

                    $fechaVuelta = date("d/m/Y", strtotime($alumno[3]));

                    echo "<td>$fechaVuelta</td>";
                    echo "<td>$estado</td>";
                    echo "<td><a href='/ABM/modificar.php?dni=$alumno[0]'><img src='../Multimedia/pen.svg' alt='' class='img-fluid imagen-icono-ajustes' style='margin-right: 5px;'></a> <a href='javascript:void(0)'><img src='../Multimedia/trash.svg' onclick='alertaEliminar($alumno[0])' class='img-fluid imagen-icono-ajustes' style='margin-right: 5px;'></a></td>";
                    echo "</tr>";
                }
            }
            ?>


        </div>

    </div>
    <script src="../Estilos/js/sweetalert2.all.min.js"></script>
    <script src="../Estilos/js/bootstrap.bundle.min.js"></script>
    <script src="../Funciones/funciones.js"></script>
    <?php
    if (isset($_GET["modificar"])) {
        if ($_GET["modificar"] == true) {
            Alerta::alumnoEditado();
        }
    }
    ?>
</body>

</html>