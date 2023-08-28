<?php
require_once 'conexion.php';

$query= "select * from jugadoras";
$smt = $conexion->prepare($query);
$smt -> execute();
$jugadoras = $smt->fetchAll();

echo "<table>";
echo("<tr>");
echo("<th>nombre</th>"." ");
echo("<th>apellido</th>"." ");
echo("<th>edad</th>"." ");
echo("<th>nombre</th>");
echo("<th></th>");
echo("</tr>");

echo("<br>");
foreach($jugadoras as $jugadora){
    echo("<tr>");
    echo("<td>".$jugadora['nombre']." "."</td>");

    echo("<td>".$jugadora['apellido']." "."</td>");

    echo("<td>".$jugadora['edad']." "."</td>");

    echo("<td>".$jugadora['club']." "."</td>");

    echo("<td><a href='editar.php?id=".$jugadora['ID']."'>Editar</a></td>");
    echo("</tr>");
}
echo "</table>";
echo "<a href='indexphp.php'>Inicio</a> <br>";
?>
