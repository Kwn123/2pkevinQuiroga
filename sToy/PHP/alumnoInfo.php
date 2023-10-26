<?php
include("../Clases/AlumnoClass.php");
include("../BD/BdClass.php");
include("../Clases/AsistenciaClass.php");
$conexion = new Conexion();
$conexion->conectar();
$dni = $_GET['dni'];
$consulta = Alumno::sugerenciaDni($dni);
$sugerencia = $conexion->ejecutaConsulta($consulta);
$sugerencia = $sugerencia->fetch_all();
$fecha = date("Y-m-d");

if(empty($sugerencia[0])){
    echo"<div class='caja-index alert alert-info mt-5' style=' overflow-y: auto; '>";
    echo("No existe el alumno");
    echo "</div>";
}else{
echo"<div class='caja-index alert alert-info mt-5' style=' overflow-y: auto; '>";
echo "<div class='d-flex justify-content-center'style='margin-top:0%;'>";
echo "<table class='table table-bordered'>";
echo "<thead>";
echo "<tr>";
echo "<th>Dni</th>";
echo "<th>Nombre</th>";
echo "<th>Apellido</th>";
echo "<th>Fecha nacimiento</th>";
echo "<th>Accion</th>";
echo "</tr>";
echo " </thead>";
echo "<tbody>";
foreach ($sugerencia as $sugerencias){
$consulta = Asistencia::contarAsistencia($sugerencias[0],$fecha);
$resultado = $conexion->ejecutaConsulta($consulta);
$resultado = $resultado->fetch_object();
if($resultado->contador <1){
    echo "<tr>";
    echo "<td>  $sugerencias[0] </td>";
    echo "<td>  $sugerencias[1] </td>";
    echo "<td>  $sugerencias[2] </td>";
    echo "<td>  $sugerencias[3] </td>";
    echo "<td><a href='index.php?dni=$sugerencias[0]'>Presente!</a></td>";
}else{
echo "<tr>";
    echo "<td>  $sugerencias[0] </td>";
    echo "<td>  $sugerencias[1] </td>";
    echo "<td>  $sugerencias[2] </td>";
    echo "<td>  $sugerencias[3] </td>";
    echo "<td>sToy!</td>";
}
}
echo "</tr>";
echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";
echo "</div>";
}
?>
