<?php
// ---------------------- Conexiones --------------------------
include("../BD/BdClass.php");
include("../Clases/AlumnoClass.php");
$conexion = new Conexion();
$conexion->conectar();
// ---------------------- ???????  --------------------------
if (isset($_GET['id'])) {
    $dni = $_GET['id'];
}
// ------------------------------------------------
// Obtengo todos los alumnos 
$consulta = Alumno::obtenerTodosLosAlumnos();
$resultado = $conexion->ejecutaConsulta($consulta);
$alumnos = $resultado;

$maxFecha = date("Y-m-d");
$minFecha = date('Y-m-d', strtotime('-100 years'));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estilos/css/style.css">
    <link rel="stylesheet" href="../Estilos/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Estilos/css/sweetalert2.min.css">

    <title>ABM</title>
</head>
<body>
    <!-- -------------------------------------------NAV BAR---------------------------------------- -->
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
                            <li><a class="dropdown-item" href="./lista.php">Lista alumnos</a></li>
                            <li><a class="dropdown-item" href="../Asistencia/asistenciaLista.php">Asistencias alumnos</a></li>
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
<!-- -------------------------------------------CONTENEDOR FONDO---------------------------------------- -->
    <div class="container-fondo d-flex justify-content-center align-items-center" style="height: 88vh">
        <div class="container d-flex justify-content-center text-center align-items-center" style="height: 70vh">
            <div class="container-form d-flex justify-content-center align-items-center rounded w-50" style="margin-top: 10%;background-color: white; margin-bottom: 100px; ">
                <form action="#" method="GET" class="d-flex flex-column align-items-center h-55 w-50">
                    <h5 class="mb-3">Ingresa un alumno</h5>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="nombre" class="form-label me-2">Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" pattern="[A-Za-z ]*" maxlength="30">
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="apellido" class="form-label me-2">Apellido</label>
                        <input class="form-control" type="text" name="apellido" id="apellido" maxlength="20">
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="dni" class="form-label me-2"> DNI</label>
                        <input class="form-control" type="number" name="dni" id="dni" value="<?php echo $dni ?>">
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="fecha-nacimiento" class="form-label me-2">Fecha de Nacimiento</label>
                        <input class="form-control" type="date" name="fecha_nacimiento" id="fecha" min="<?php echo $minFecha ?>" max="<?php echo $maxFecha ?>">
                    </div>
                    <button class="btn btn-primary align-self-center mb-2" type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
<!-- -------------------------------------------JS---------------------------------------- -->
    <script src="../Estilos/js/sweetalert2.all.min.js"></script>
    <script src="../Estilos/js/bootstrap.bundle.min.js"></script>
<!-- -------------------------------------------CODIGO---------------------------------------- -->
    <script>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['dni'])) {
                if (!empty($_GET['dni'] && !empty($_GET['nombre']) && !empty($_GET['apellido']) && !empty($_GET['fecha_nacimiento']))) {
                    $nombre = $_GET['nombre'];
                    $apellido = $_GET['apellido'];
                    $dni = $_GET['dni'];
                    $fecha = $_GET['fecha_nacimiento'];
                    $fechas = explode("-", $fecha);
                    $añoMenores = date("Y") - 17;
                    if ($añoMenores < $fechas[0]) {
                        echo "Swal.fire('Error', 'El alumno a ingresar es menor de edad', 'error');";
                    } else {
                        $alumno = new Alumno($nombre, $apellido, $dni, $fecha);
                        $consulta = $alumno->insertarAlumno();
                        try {
                            $conexion->ejecutaConsulta($consulta);
                            echo "Swal.fire('Éxito', 'Alumno insertado', 'success');";
                        } catch (mysqli_sql_exception $error) {
                            if ($error->getCode() == 1062) {
                                echo "Swal.fire('Error', 'El DNI ya existe en la base de datos', 'error');";
                            } else {
                                echo "Swal.fire('Error', 'Error inesperado: " . $error->getMessage() . "', 'error');";
                            }
                        }
                    }
                } else {
                    echo "Swal.fire('Error', 'Error al ingresar al alumno', 'error');";
                }
            }
        }
        ?>
    </script>
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }
    </style>
</body>

</html>