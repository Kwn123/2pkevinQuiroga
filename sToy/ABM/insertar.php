<?php
// ---------------------- Conexiones --------------------------
include("../BD/BdClass.php");
include("../Clases/AlumnoClass.php");
$conexion = new Conexion();
$conexion->conectar();

$dniMinimo = 1000000;
$dniMaximo = 99999999;

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
    <?php include("../PHP/navbar.php") ?>
    <!-- -------------------------------------------CONTENEDOR FONDO---------------------------------------- -->
    <div class="container-fondo d-flex justify-content-center align-items-center" style="height: 88vh">
        <div class="container d-flex justify-content-center text-center align-items-center" style="height: 70vh">
            <div class="container-form d-flex justify-content-center align-items-center rounded w-50" style="margin-top: 10%;background-color: white; margin-bottom: 100px; ">
                <form action="#" method="POST" class="d-flex flex-column align-items-center h-55 w-50">
                    <h5 class="mb-3">Ingresa un alumno</h5>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="nombre" class="form-label me-2">Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" pattern="[A-Za-z ]*" maxlength="15">
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <label for="apellido" class="form-label me-2">Apellido</label>
                        <input class="form-control" type="text" name="apellido" pattern="[A-Za-zñÑ ]*" id="apellido" maxlength="15">
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
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['dni'])) {
            if (!empty($_POST['dni'] && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['fecha_nacimiento']))) {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $dni = $_POST['dni'];
                $fecha = $_POST['fecha_nacimiento'];
                $fechas = explode("-", $fecha);
                $añoMenores = date("Y") - 17;
                if ($dni <  $dniMinimo  || $dni > $dniMaximo) {
                    echo " <script> Swal.fire('Error', 'Documento erroneo', 'error');</script>";
                } else {
                    if ($añoMenores < $fechas[0]) {
                        echo " <script> Swal.fire('Error', 'El alumno a ingresar es menor de edad', 'error');</script>";
                    } else {
                        $alumno = new Alumno($nombre, $apellido, $dni, $fecha);
                        $consulta = $alumno->insertarAlumno();
                        try {
                            $conexion->ejecutaConsulta($consulta);
                            echo "<script>Swal.fire('Éxito', 'Alumno insertado', 'success');</script>";
                        } catch (mysqli_sql_exception $error) {
                            if ($error->getCode() == 1062) {
                                echo "<script>Swal.fire('Error', 'El DNI ya existe en la base de datos', 'error');</script>";
                            } else {
                                echo "<script>Swal.fire('Error', 'Error inesperado: " . $error->getMessage() . "', 'error');</script>";
                            }
                        }
                    }
                }
            } else {
                echo "<script>Swal.fire('Error', 'Error al ingresar al alumno', 'error');</script>";
            }
        }
    }
    ?>
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }
    </style>
</body>

</html>