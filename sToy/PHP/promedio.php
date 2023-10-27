<?php
include("../BD/BdClass.php");
include("../PHP/Trait.php");
include("../Clases/AlumnoClass.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Estilos/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Estilos/css/style.css">
    <title>sToy</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand w-5 h-5" href="/Index.php">
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
                            <li><a class="dropdown-item" href="/Asistencia/asistenciaLista.php">Asistencias alumnos</a></li>
                            <li><a class="dropdown-item" href="/PHP/Promedio.php">Promedio</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="nav-item dropstart">
                    <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../Multimedia/tools.svg" alt="" class="img-fluid imagen-icono-ajustes" style="margin-right: 5px;">
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/PHP/Parametros.php" class="dropdown-item">Configuracion</a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <div class="container-fondo d-flex justify-content-center align-items-center" style="height: 88vh">
        <div class="container container-index d-flex justify-content-center text-center align-items-center" style="height: 20vh">
            <div style="width: 50vh">
                <img src="../Multimedia/icono.png" class="" style="margin-bottom: 10px; margin-top: 20px; ">
                <form action="#"  method="GET" style="margin-bottom: 0px; ">
                <div class="container text-center">
                    <input type="number" id="fname" name="porcentaje" placeholder="Porcentaje" >
                    <input type="number" id="fname" name="nota1" placeholder="Primer nota" >
                    <input type="number" id="fname" name="nota2" placeholder="Segunda nota" >
                    </div>
                    <button>Enviar</button>
                </form>
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                if (isset($_GET["porcentaje"])&& isset($_GET["nota1"]) && isset($_GET["nota2"])) {
                $porcentaje = $_GET["porcentaje"];
                $nota1 = $_GET["nota1"];
                $nota2 = $_GET["nota2"];
                $resultado = Alumno::porcentajeNota($porcentaje,$nota1,$nota2);
                echo "<div class='alert alert-danger text-center 'style='margin-bottom: 10px'>$resultado</div>";
                }

            }
            ?>
        </div>
    </div>
    <script src="/index.js"></script>
    <script src="/Estilos/js/bootstrap.bundle.min.js"></script>
</body>
</html>