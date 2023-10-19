<?php
include("../BD/BdClass.php");
include("../Clases/AlumnoClass.php");
$conexion = new Conexion();
$conexion->conectar();
$dni = $_GET['dni'];
$consulta = Alumno::obtenerAlumno($dni);
$resultado = $conexion->ejecutaConsulta($consulta);
$alumno = $resultado->fetch_object();

$maxFecha = date("Y-m-d");
$minFecha = date('Y-m-d', strtotime('-100 years'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Estilos/css/style.css">
    <link rel="stylesheet" href="/Estilos/css/bootstrap.min.css">
    <title>Document</title>
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
    <div class="container-fondo" style="height: 90%;">
        <div class="container d-flex justify-content-center align-items-center" style="height: 88vh; width: 100vw;">
            <div class="container d-flex justify-content-center align-items-center ">
                <div class="container-form d-flex justify-content-center align-items-center rounded" style="height: 50vh; width: 50%; background-color: white;">
                    <form action="#" method="GET" class="d-flex flex-column">
                        <div class="mb-3 d-flex align-items-center">
                            <label for="nombre" class="form-label me-2">Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $alumno->nombre; ?>">
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="apellido" class="form-label me-2">Apellido</label>
                            <input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo $alumno->apellido; ?>">
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="dni" class="form-label me-2">DNI</label>
                            <input class="form-control" type="number" name="dni" id="dni" value="<?php echo $dni; ?>">
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="fecha-nacimiento" class="form-label me-2">Fecha de Nacimiento</label>
                            <input class="form-control" type="date" name="fecha_nacimiento" id="fecha" value="<?php echo $alumno->fecha_nac; ?>" min="<?php echo $minFecha ?>" max="<?php echo $maxFecha ?>">
                        </div>
                        <button class="btn btn-primary align-self-center" type="submit">Modificar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php 
        if(isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['dni']) && isset($_GET['fecha_nacimiento'])){
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                $fecha = $_GET['fecha_nacimiento'];
                        $fechas = explode("-", $fecha);
                        $añoMenores = date("Y") - 17;
                        if ($añoMenores < $fechas [0]){
                            echo "<div class='alert alert-danger text-center' style='margin-bottom: 10px'>Error: El alumno a ingresar es menor de edad.</div>";
                            exit;
                        }
                $consulta = Alumno::actualizarAlumno($_GET['nombre'], $_GET['apellido'], $_GET['dni'], $_GET['fecha_nacimiento']);
                $conexion->ejecutaConsulta($consulta);
                echo "Hola";
                echo "<script>alert('Se modifico el alumno');</script>";
                echo "<script>window.location='/ABM/lista.php';</script>";
        }}
        ?>
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }
    </style>
    <script src="/Estilos/js/bootstrap.bundle.min.js"></script>
</body>
</html>