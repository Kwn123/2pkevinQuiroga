<?php
include("../BD/BdClass.php");
include("../Clases/AlumnoClass.php");
$conexion = new Conexion();
$conexion->conectar();
if (isset($_GET['id'])) {
    $dni = $_GET['id'];
}
$consulta = Alumno::obtenerTodosLosAlumnos();
$resultado = $conexion->ejecutaConsulta($consulta);
$alumnos = $resultado;
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Estilos/css/style.css">
    <link rel="stylesheet" href="/Estilos/css/bootstrap.min.css">
    <title>ABM</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand w-5 h-5" href="../Index.php">
                <img src="/Multimedia/icono.png" alt="Icono" class="img-fluid" style="max-width: 50px; height: auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="z-index: 999;">
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
                            <li><a class="dropdown-item" href="/ABM/asistencia.php">Asistencias alumnos</a></li>
                        </ul>
                    </li>
                </ul>

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
        </div>
    </nav>

    <div class="container-fondo d-flex justify-content-center align-items-center" style="height: 88vh">
        <div class="container d-flex justify-content-center text-center align-items-center" style="height: 70vh">
            <div class="container-form d-flex justify-content-center align-items-center rounded w-50" style="margin-top: 10%;background-color: white; margin-bottom: 100px; ">
                <form action="#" method="GET" class="d-flex flex-column align-items-center h-55 w-50">
                    <h5 class="mb-3">Ingresa un alumno</h5>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="nombre" class="form-label me-2">Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" pattern="[A-Za-z ]*">
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="apellido" class="form-label me-2">Apellido</label>
                        <input class="form-control" type="text" name="apellido" id="apellido">
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="dni" class="form-label me-2">DNI</label>
                        <input class="form-control" type="number" name="dni" id="dni" value="<?php echo $dni ?>">
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="fecha-nacimiento" class="form-label me-2">Fecha de Nacimiento</label>
                        <input class="form-control" type="date" name="fecha-nacimiento" id="fecha">
                    </div>
                    <button class="btn btn-primary align-self-center mb-2" type="submit">Enviar</button>
                </form>
            </div>
        </div>
        <div class="contenedor-alertas d-flex justify-content-center align-items-center mt-4 " style="height: 30vh;">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (isset($_GET['dni'])) {
                    if (!empty($_GET['dni'] && !empty($_GET['nombre']) && !empty($_GET['apellido']) && !empty($_GET['fecha-nacimiento']))) {
                        $nombre = $_GET['nombre'];
                        $apellido = $_GET['apellido'];
                        $dni = $_GET['dni'];
                        $fecha = $_GET['fecha-nacimiento'];
                        $alumno = new Alumno($nombre, $apellido, $dni, $fecha);
                        $consulta = $alumno->insertarAlumno();
                        try {
                            $conexion->ejecutaConsulta($consulta);
                            header("Refresh: 0; url=/ABM/insertarABM.php");
                        } catch (mysqli_sql_exception $error) {
                            if ($error->getCode() == 1062) {
                                echo "<div class='alert alert-danger text-center' style='margin-bottom: 10px'>Error: El DNI ya existe en la base de datos.</div>";
                            } else {
                                echo "<div class='alert alert-danger text-center 'style='margin-bottom: 10px'>Error inesperado.</div>" . $error->getMessage();
                            }
                        }
                    } else {
                        echo "<div class='alert alert-danger text-center ' style='margin-bottom: 10px'>Error al ingresar al alumno</div>";
                    }
                }
            }
            ?>
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