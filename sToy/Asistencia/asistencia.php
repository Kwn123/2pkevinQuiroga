<?php
include("../BD/BdClass.php");
include("../Clases/AlumnoClass.php");
include("../Clases/AsistenciaClass.php");
$fecha = $_GET['fecha'] ;
$conexion = new Conexion();
$conexion->conectar();
/*
$consulta = Asistencia::obtenerTodasLasAsistencias();
$asistencias = $conexion->ejecutaConsulta($consulta);*/
$consulta = Asistencia::obtenerAsistenciasPorFecha($fecha);
$asistencias = $conexion->ejecutaConsulta($consulta)

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Estilos/css/style.css">
    <link rel="stylesheet" href="/Estilos/css/bootstrap.min.css">
    <title>Asistencia</title>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand w-5 h-5" href="../Index.php">
            <img src="/Multimedia/icono.png" alt="Icono" class="img-fluid" style="max-width: 50px; height: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Agregar asistencia</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Acciones
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/ABM/lista.php">Lista alumnos</a></li>
                        <li><a class="dropdown-item" href="../Asistencia/asistenciaLista.php">Asistencias alumnos</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="nav-item dropstart">
                    <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../Multimedia/tools.svg" alt="" class="img-fluid imagen-icono-ajustes" style="margin-right: 5px;">
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../PHP/parametros.php" class="dropdown-item">Configuracion</a>
                        </li>
                    </ul>
                </div>
    </div>
</nav>
<div class="container-fondo d-flex justify-content-center align-items-center " style="height: 88vh">
        <div class="alert alert-danger d-none" id="error"></div>
        <div class="container-textAlumno grid text-center mt-3" style="max-height: 73vh; width: 80%;">
            <div class='alert alert-info' style="max-height: 73vh; width: 100%; overflow-y: auto;">
            <h2>Lista asistencias</h2>
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>dni</th>
                            <th>nombre</th>
                            <th>apellido</th>
                            <th>fecha/hora</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($asistencias->num_rows == 0) {
                            echo "No hay asistencias registradas.";
                            echo "<br>";
                            echo "<br>";
                        } else {
                            $asistencias = $asistencias->fetch_all(MYSQLI_ASSOC);
                            foreach ($asistencias as $presente) {
                                echo "<tr>";
                                echo "<td>$presente[id]</td>";
                                echo "<td>$presente[dni]</td>";
                                $dni = $presente['dni'];
                                $consulta = Alumno::obtenerAlumno($dni);
                                $alumno = $conexion->ejecutaConsulta($consulta);
                                $alumno = $alumno->fetch_assoc();
                                echo "<td>$alumno[nombre]</td>";
                                echo "<td>$alumno[apellido]</td>";
                                echo "<td>$presente[fecha_asistencia]</td>";
                                echo "<td><a href='asistenciaUpdate.php?id=$presente[id]'>Editar</a></td>";
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
    <script src="/Estilos/js/bootstrap.bundle.min.js"></script>
</body>

</html>