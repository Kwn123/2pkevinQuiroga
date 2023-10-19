<?php
include("../BD/BdClass.php");
include("../Clases/AsistenciaClass.php");
include("../Clases/AlumnoClass.php");
require("../Clases/ParametroClass.php");
$conexion = new Conexion();
$conexion->conectar();

if (isset($_GET['eliminar'])) {
    $eliminar = $_GET['eliminar'];
    if ($eliminar == true) {
        $consulta = Asistencia::borrarTodo();
        $conexion->ejecutaConsulta($consulta);
        $consulta = Alumno::borrarTodo();
        $conexion->ejecutaConsulta($consulta);
    }
}else{
    $eliminar = false;
}

$consulta = Alumno::obtenerTodosLosAlumnos();
$resultado = $conexion->ejecutaConsulta($consulta);
$alumnos = $resultado;
$consulta = Parametro::getParametros();
$parametros = $conexion->ejecutaConsulta($consulta);
$parametros = $parametros->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Estilos/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Estilos/css/style.css">
    <title>lista</title>
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
                        <a class="nav-link" href="/ABM/insertarABM.php">Insertar alumno</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Informacion
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

        <div class='alert alert-info text-center mt-5' style="width: 80%; margin-bottom: 5%; overflow-y: auto;">
            <h2>Lista de alumnos</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Dni</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha nacimiento</th>
                        <th>Estado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($alumnos->num_rows == 0 || $eliminar == true) {
                        if($eliminar == true){
                            echo "Se eliminaron todos los alumnos.";
                            echo "<br>";
                            echo "<br>"; 
                        } else{
                        echo "No hay alumnos registrados.";
                        echo "<br>";
                        echo "<br>";
                    }
                    } else {
                        $alumnos = $resultado->fetch_all(MYSQLI_ASSOC);
                        foreach ($alumnos as $alumno) {
                            $consulta = Asistencia::contadorAsistencias($alumno['dni']);
                            $total = $conexion->ejecutaConsulta($consulta);
                            $total = $total->fetch_object();
                            $estado = Asistencia::verificarPorcentajeAsistencia($parametros->total_clases, $parametros->promocion, $parametros->regular, $total->contador);
                            echo "<tr>";
                            echo "<td>$alumno[dni]</td>";
                            echo "<td>$alumno[nombre]</td>";
                            echo "<td>$alumno[apellido]</td>";
                            echo "<td>$alumno[fecha_nac]</td>";
                            echo "<td>$estado</td>";
                            echo "<td><a href='/ABM/update2ABM.php?dni=$alumno[dni]'>Modificar</a>/<a href='/ABM/eliminarABM.php?dni=$alumno[dni]'>Eliminar</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>


        </div>

    </div>

    <script src="/Estilos/js/bootstrap.bundle.min.js"></script>
</body>

</html>