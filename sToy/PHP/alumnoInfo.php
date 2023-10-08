<?php
include("../Clases/AlumnoClass.php");
include("../BD/BdClass.php");
$conexion = new Conexion();
$conexion->conectar();
$dni = $_GET['dni'];
$consulta = Alumno::sugerenciaDni($dni);
$sugerencia = $conexion->ejecutaConsulta($consulta);
$sugerencia = $sugerencia->fetch_object();
if(empty($sugerencia->dni)){
    echo("No existe el alumno");
}else{
    echo("<p>Sugerencia : $sugerencia->dni</p>");

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
echo "<td>  $sugerencia->dni </td>";
echo "<td>  $sugerencia->nombre </td>";
echo "<td>  $sugerencia->apellido </td>";
echo "<td>  $sugerencia->fecha_nac </td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
echo "</div>";

echo "<a href='index.php?dni=$sugerencia->dni'><button name='btn-enviar' class='btn btn-primary mt-2 mb-5'>Presente!</button> </a>";
echo "</div>";
}
?>
