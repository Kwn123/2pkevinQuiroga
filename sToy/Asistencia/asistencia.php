<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
include("../BD/BdClass.php");
include("../Clases/AlumnoClass.php");
include("../Clases/AsistenciaClass.php");
$conexion = new Conexion();
$conexion->conectar();


if (isset($_GET["fecha"])) {
    $fecha = $_GET['fecha'];
    $consulta = Asistencia::obtenerAsistenciasPorFecha($fecha);
    $asistencias = $conexion->ejecutaConsulta($consulta);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Estilos/css/style.css">
    <link rel="stylesheet" href="/Estilos/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Estilos/css/sweetalert2.min.css">
    <title>Asistencia</title>
</head>

<body>

    <?php include("../PHP/navbar.php") ?>

    <div class="container-fondo d-flex justify-content-center align-items-center " style="height: 88vh">
        <div class="alert alert-danger d-none" id="error"></div>
        <div class="container-textAlumno grid text-center mt-3" style="max-height: 73vh; width: 80%;">
            <div class='alert alert-info' style="max-height: 73vh; width: 100%; overflow-y: auto;">
                <h2>Lista asistencias</h2>
                        <?php
                        if ($asistencias->num_rows == 0) {
                            echo "<table class='table table-bordered'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>id</th>";
                            echo "<th>dni</th>";
                            echo "<th>nombre</th>";
                            echo "<th>apellido</th>";
                            echo "<th>fecha/hora</th>";
                            echo "<th>Eliminar</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            echo "No hay asistencias registradas.";
                            echo "<br>";
                            echo "<br>";

                            $consulta=Asistencia::reinicioAutoIncrement();
                            $conexion->ejecutaConsulta($consulta);
                            
                        } else {
                            $asistencias = $asistencias->fetch_all(MYSQLI_ASSOC);
                            echo "<table class='table table-bordered'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>id</th>";
                            echo "<th>dni</th>";
                            echo "<th>nombre</th>";
                            echo "<th>apellido</th>";
                            echo "<th>fecha/hora</th>";
                            echo "<th>Eliminar</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            foreach ($asistencias as $presente) {
                                echo "<tr>";
                                echo "<td>$presente[id]</td>";
                                echo "<td>$presente[dni]</td>";

                                $dni = $presente['dni'];
                                $consulta = Alumno::obtenerAlumno($dni);
                                $alumno = $conexion->ejecutaConsulta($consulta)->fetch_assoc();

                                echo "<td>$alumno[nombre]</td>";
                                echo "<td>$alumno[apellido]</td>";
                                $fechaVuelta = date("d/m/Y H:i", strtotime($presente['fecha_asistencia']));
                                echo "<td>$fechaVuelta</td>";
                                echo "<td><a href='javascript:void(0)'><img src='../Multimedia/trash.svg' onclick='alertaAsistencia($presente[id])' class='img-fluid imagen-icono-ajustes' style='margin-right: 5px;'></a></td>";
                                echo "</tr>";
                            }
                        }
                    
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }
    </style>
    <script src="../Funciones/funciones.js"></script>
    <script src="../Estilos/js/sweetalert2.all.min.js"></script>
    <script src="../Estilos/js/bootstrap.bundle.min.js"></script>
</body>

</html>