<?php
require("../BD/BdClass.php");
require("../Clases/ParametroClass.php");
$conexion = new Conexion();
$conexion->conectar();
$consulta = Parametro::getParametros();
$parametros = $conexion->ejecutaConsulta($consulta);
$parametros = $parametros->fetch_object();
$clasesTotal = $parametros->total_clases;
$promocion = $parametros->promocion;
$regular = $parametros->regular; 
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

                <div class="nav-item dropstart">
                    <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../Multimedia/tools.svg" alt="" class="img-fluid imagen-icono-ajustes" style="margin-right: 5px;">
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="Parametros.php" class="dropdown-item">Configuracion</a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <div class="container-fondo d-flex justify-content-center align-items-center" style="height: 88vh;">
        <div class="grid align-items-center rounded text-center w-50" style="background-color: white;height: 60vh;">
            <form class="w-50 mx-auto mt-4" method="GET" action="/PHP/setParametros.php">
                <h3 class="rounded ">Parametros</h3>
                <div class="form-group">
                    <label for="clases ">Total de clases</label>
                    <input id="clases" type="number" name="clasesTotal" class="form-control mt-2" placeholder="<?php echo $clasesTotal;  ?>">
                </div>
                <div class="form-group">
                    <label for="clases">Porcentaje de promocion</label>
                    <input id="clases" type="number" class="form-control mt-2" name="promocion" placeholder="<?php echo $promocion;  ?>">
                </div>
                <div class="form-group">
                    <label for="clases">Porcentaje de regular</label>
                    <input id="clases" type="number" class="form-control mt-2" name="regular" placeholder="<?php echo $regular;  ?>">
                </div>
                <button class="btn btn-primary align-self-center mt-4" type="submit">Guardar parametros</button>
            </form>
        </div>
        <a href="./borrarTodo.php"><button class="btn btn-danger align-self-center mt-4" type="submit" >Eliminar todos los alumnos</button></a>
    </div>
    <script src="../Estilos/js/bootstrap.bundle.min.js"></script>
</body>

</html>
