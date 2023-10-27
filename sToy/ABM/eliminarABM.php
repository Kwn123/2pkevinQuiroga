<?php 
$dni = $_GET["dni"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="../Estilos/js/sweetalert2.all.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estilos/css/style.css">
    <link rel="stylesheet" href="../Estilos/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Estilos/css/sweetalert2.min.css">
    <title>Document</title>
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
    <div class="container-fondo d-flex justify-content-center align-items-center" style="height: 88vh">
    </div>
    <script>
    Swal.fire({
  title: 'Desea eliminar el alumno?',
  showDenyButton: true,
  showCancelButton: false,
  confirmButtonText: 'No',
  denyButtonText: `Eliminarlo`,
}).then((result) => {
  if (result.isConfirmed) {
    window.location = './lista.php';
  } else if (result.isDenied) {
    window.location = 'eliminarConfirmado.php?dni=<?php echo $dni; ?>';
  }
})
</script>
</body>
</html>
