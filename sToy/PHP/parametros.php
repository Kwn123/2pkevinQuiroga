<?php
require("../BD/BdClass.php");
require("../Clases/ParametroClass.php");
$conexion = new Conexion();
$conexion->conectar();

$consulta = Parametro::getParametros();
$parametros = $conexion->ejecutaConsulta($consulta)->fetch_object();

$clasesTotal = $parametros->total_clases;
$promocion = $parametros->promocion;
$regular = $parametros->regular;
$horaInicio = $parametros->hora_inicio;
$horaFin = $parametros->hora_fin;
$tolerancia = $parametros->tolerancia;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parametros</title>
    <link rel="stylesheet" href="../Estilos/css/style.css">
    <link rel="stylesheet" href="../Estilos/css/bootstrap.min.css">
</head>

<body>
<?php include("../PHP/navbar.php") ?>
<div class="container-fondo flex" style="height: 88vh;">
    <div class="row">
        <div class="col-md-6 mx-auto" style=" width: 90vh;">
            <div class="d-flex align-items-center rounded text-center" style="background-color: white; height: 60vh;">
                <form class="w-75 mx-auto mt-4" method="POST" action="../Funciones/funciones.php">
                    <h3 class="rounded" style="font-size: 24px;">Parametros clases</h3>
                    <div class="form-group">
                        <label for="clases">Total de clases</label>
                        <input id="clases" type="number" name="clasesTotal" class="form-control mt-2" min="1" placeholder="<?php echo $clasesTotal; ?>">
                    </div>
                    <div class="form-group">
                        <label for="clases">Porcentaje de promoción</label>
                        <input id="clases" type="number" class="form-control mt-2" name="promocion" min="1" placeholder="<?php echo $promocion; ?>">
                    </div>
                    <div class="form-group">
                        <label for="clases">Porcentaje de regular</label>
                        <input id="clases" type="number" class="form-control mt-2" name="regular" min="1" placeholder="<?php echo $regular; ?>">
                    </div>
                    <button class="btn btn-primary align-self-center mt-4" type="submit">Guardar parametros</button>
                </form>
            </div>
        </div>

        <div class="col-md-6 mx-auto" style=" width: 90vh;">
            <div class="d-flex align-items-center rounded text-center" style="background-color: white; height: 60vh;">
                <form class="w-75 mx-auto mt-4" method="POST" action="../Funciones/funciones.php">
                    <h3 class="rounded" style="font-size: 24px;">Parametros horarios</h3>
                    <div class="form-group">
                        <label for="clases">Hora de inicio</label>
                        <input id="clases" type="time" class="form-control mt-2"  name="horaInicio" value="<?php echo $horaInicio; ?>">
                    </div>
                    <div class="form-group">
                        <label for="clases">Hora de salida</label>
                        <input id="clases" type="time" class="form-control mt-2" name="horaFin"  value="<?php echo $horaFin; ?>">
                    </div>
                    <div class="form-group">
                        <label for="clases">Tolerancia</label>
                        <input id="clases" type="time" class="form-control mt-2" name="tolerancia"  value="<?php echo $tolerancia; ?>">
                    </div>
                    <button class="btn btn-primary align-self-center mt-4" type="submit">Guardar horarios</button>
                </form>
            </div>
        </div>
    </div>
</div>




    <script src="../Estilos/js/bootstrap.bundle.min.js"></script>
    <script src="../Estilos/js/sweetalert2.all.min.js"></script>

</body>

</html>
