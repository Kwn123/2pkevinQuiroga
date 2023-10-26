<?php
include("../BD/BdClass.php");
include("../Clases/AsistenciaClass.php");
include("../Clases/AlumnoClass.php");
$conexion = new Conexion();
$conexion->conectar();
$id = $_GET['id'];
$consulta = Asistencia::obtenerAsistencia($id);
$asistencia = $conexion->ejecutaConsulta($consulta);
$asistencia = $asistencia->fetch_object();
$consulta = Alumno::obtenerAlumno($asistencia->dni);
$alumno = $conexion->ejecutaConsulta($consulta);
$alumno = $alumno->fetch_object();
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
                        <li><a class="dropdown-item" href="../Asistencia/asistencia.php">Asistencias alumnos</a></li>
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
            <div class="container-form text-center rounded" style="height: 41vh; width: 40%; background-color: white; margin-bottom: 25vh">
                <h3>Editar asistencia</h3>
                <form action="#" method="POST" class="d-flex flex-column text-center">
                <input type="hidden" name="id" value="<?php echo $asistencia->id; ?>">
                    <div class="mb-3">
                        <label for="dni" class="form-label">Dni</label>
                        <input class="form-control" type="text" name="dni" id="dni" value="<?php echo $asistencia->dni; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fecha_asistencia" class="form-label">Fecha asistencia</label>
                        <input class="form-control" type="text" name="fecha_asistencia" id="fecha_asistencia" value="<?php echo $asistencia->fecha_asistencia; ?>">
                    </div>
                    <button class="btn btn-primary align-self-center" type="submit">Editar</button>
                </form>
            </div>
            <div class="alert alert-info">
                <?php echo "<p>El alumno $alumno->nombre $alumno->apellido con DNI: $asistencia->dni asistio el dia  $asistencia->fecha_asistencia</p>" ;?> 
            </div>
        <?php
        if (isset($_POST['id']) && isset($_POST['fecha_asistencia']) && isset($_POST['dni'])) {
            $fecha = $_POST['fecha_asistencia'];
            $consulta = Alumno::obtenerAlumno($_POST['dni']);
            $alumno = $conexion->ejecutaConsulta($consulta);
            $alumno = $alumno->fetch_object();
            $fecha_valida = DateTime::createFromFormat('Y-m-d H:i:s', $fecha);
            if (empty($fecha) || ($fecha_valida !== false)){
            if ((empty($alumno->dni) || $alumno->dni == null || $alumno->dni == "" || $alumno->dni == 0)) {
                echo "<script>alert('El dni no existe');</script>";
            }else{
                $consulta =Asistencia::actualizarAsistencia($_POST['id'], $_POST['dni'], $_POST['fecha_asistencia']);
                $conexion->ejecutaConsulta($consulta);
                echo "<script>alert('Se modifico la asistencia');</script>";
                echo "<script>window.location='/Asistencia/asistenciaLista.php';</script>";
            }
        }else{
            echo "<script>alert('Error en la fecha');</script>";
        }
        }
        ?>
        <script src="/Estilos/js/bootstrap.bundle.min.js"></script>
</body>

</html>