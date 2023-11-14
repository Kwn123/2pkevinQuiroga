<?php
include("../BD/BdClass.php");
include("../Clases/AlumnoClass.php");
include("../Clases/AsistenciaClass.php");
$conexion = new Conexion();
$conexion->conectar();

date_default_timezone_set('America/Argentina/Buenos_Aires');

$consulta = Asistencia::ordenarTodasAsistenciasOrdenadas();
$asistencias = $conexion->ejecutaConsulta($consulta);
$asistencias = $asistencias->fetch_all();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estilos/css/style.css">
    <link rel="stylesheet" href="../Estilos/css/bootstrap.min.css">
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
                if (count($asistencias) == 0) {
                    echo "No hay asistencias registradas.";
                    echo "<br>";
                    echo "<br>";
                } else {
                    echo "<table class='table table-bordered'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>fecha/hora</th>";
                    echo "<th>Accion</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach ($asistencias as $presente) {
                        echo "<tr>";
                        $fechaVuelta = date("d/m/Y", strtotime($presente[0]));
                        echo "<td>$fechaVuelta</td>";
                        echo "<td><a href='asistencia.php?fecha=$presente[0]'>Ir a lista</a></td>";
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
    <script src="../Estilos/js/sweetalert2.all.min.js"></script>
    <script src="../Estilos/js/bootstrap.bundle.min.js"></script>
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }
    </style>
</body>
</html>


<?php 
if(isset($_GET["eliminado"])){
    if ($_GET["eliminado"] == true){
       echo "<script>Swal.fire({
           position: 'top-end',
           icon: 'success',
           title: 'Asitencia eliminada',
           showConfirmButton: false,
           timer: 1500
         })</script>";
    }
   }
?>