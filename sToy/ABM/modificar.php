<?php
include("../BD/BdClass.php");
include("../Clases/AlumnoClass.php");
$conexion = new Conexion();
$conexion->conectar();

$dniViejo = $_GET['dni'];
$consulta = Alumno::obtenerAlumno($dniViejo);
$resultado = $conexion->ejecutaConsulta($consulta);
$alumno = $resultado->fetch_object();

if (!isset($alumno)) {
    $alumno = new Alumno("Alumno no existe", "", 1, 01 - 01 - 0001);
}

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
    <title>Document</title>
</head>

<body>
    <?php include("../PHP/navbar.php") ?>
    <div class="container-fondo" style="height: 70%;">
        <div class="container d-flex justify-content-center align-items-center" style="height: 88vh; width: 100vw;">
            <div class="container d-flex justify-content-center align-items-center ">
                <div class="container-form d-flex justify-content-center align-items-center rounded" style="height: 50vh; width: 50%; background-color: white;">
                    <form action="#" method="GET" class="d-flex flex-column">
                        <div class="mb-3 d-flex align-items-center">
                            <label for="nombre" class="form-label me-2">Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" pattern="[A-Za-z ]*" value="<?php echo $alumno->nombre; ?>">
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="apellido" class="form-label me-2">Apellido</label>
                            <input class="form-control" type="text" name="apellido" id="apellido" pattern="[A-Za-z ]*" value="<?php echo $alumno->apellido; ?>">
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="dni" class="form-label me-2">DNI</label>
                            <input class="form-control" type="number" name="dni" id="dni" value="<?php echo $alumno->dni; ?>">
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <label for="fecha-nacimiento" class="form-label me-2">Fecha de Nacimiento</label>
                            <input class="form-control" type="date" name="fecha_nacimiento" id="fecha" value="<?php echo $alumno->fecha_nac; ?>" min="<?php echo $minFecha ?>" max="<?php echo $maxFecha ?>">
                        </div>
                        <button class="btn btn-primary align-self-center" type="submit">Modificar</button>
                        <input type="hidden" name="dniViejo" value="<?php echo $dniViejo; ?>">
                    </form>
                </div>
            </div>
        </div>
        <style>
            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
            }
        </style>

        <script src="../Estilos/js/sweetalert2.all.min.js"></script>
        <script src="../Estilos/js/bootstrap.bundle.min.js"></script>

        <?php
        if (isset($_GET['nombre']) && isset($_GET['apellido']) && isset($_GET['dni']) && isset($_GET['fecha_nacimiento'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $fecha = $_GET['fecha_nacimiento'];
                $fechas = explode("-", $fecha);
                $añoMenores = date("Y") - 17;

                $dni = $_GET['dni'];
            
                if ($dni <  40000000 || $dni > 99999999) {
                    echo " <script> Swal.fire('Error', 'Documento erroneo', 'error');</script>";
                } else {
                    if ($añoMenores < $fechas[0]) {
                        echo "<script>Swal.fire('Error', 'El alumno a ingresar es menor de edad', 'error');</script>";
                        exit;
                    }
                    $consulta = Alumno::actualizarAlumno($_GET['nombre'], $_GET['apellido'], $_GET['dni'], $_GET['fecha_nacimiento'], $_GET['dniViejo']);
                    $conexion->ejecutaConsulta($consulta);
                    echo "<script>window.location='/ABM/lista.php?modificar=true';</script>";
                }
            }
        }
        ?>
</body>
</html>