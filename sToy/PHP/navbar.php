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
                        <a class="nav-link" href="/ABM/insertar.php">Insertar alumno</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Listas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../ABM/lista.php">Alumnos</a></li>
                            <li><a class="dropdown-item" href="../Asistencia/asistenciaLista.php">Asistencias</a></li>
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