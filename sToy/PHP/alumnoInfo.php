<?php
include("../Clases/AlumnoClass.php");
include("../BD/BdClass.php");
$conexion = new Conexion();
$conexion->conectar();
$dni = $_GET['dni'];
$consulta = Alumno::sugerenciaDni($dni);
$sugerencia = $conexion->ejecutaConsulta($consulta);
$alumno = $sugerencia->fetch_object();
if(empty($alumno->dni)){
    echo "<div class='alert alert-info mt-3' style='overflow-y: auto; height: 80px'>";
    echo("No existe el alumno");
    echo "</div>";
}else{
   echo "<div class='alert alert-info mt-3' style='overflow-y: auto; height: 80px'>";
    $sugerencia = $sugerencia->fetch_all();
    foreach ($sugerencia as $sugerencias){
        echo("<p>Sugerencia : $sugerencias[0] / $sugerencias[1] $sugerencias[2]</p>");
    }
    echo "</div>";

echo "<div class='d-flex justify-content-center'style='margin-top:0%;'>";
echo "<table class='table table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>Dni</th>";
echo "<th>Nombre</th>";
echo "<th>Apellido</th>";
echo "<th>Fecha nacimiento</th>";
echo "</tr>";
echo " </thead>";
echo "<tbody>";
echo "<tr>";
echo "<td>  $alumno->dni </td>";
echo "<td>  $alumno->nombre </td>";
echo "<td>  $alumno->apellido </td>";
echo "<td>  $alumno->fecha_nac </td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
echo "</div>";

echo "<a href='index.php?dni=$alumno->dni'><button name='btn-enviar' class='btn btn-primary mt-2 mb-5'>Presente!</button> </a>";
echo "</div>";
}
?>
