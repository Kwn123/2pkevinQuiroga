<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>insertar jugadora</h2>
    <form action="indexphp.php" method="post">
        <label >Nombre: <input type="text" name="nomJug"></label><br>
        <label >Apellido: <input type="text" name="apeJug"></label><br>
        <label >Edad: <input type="number" name="edadJug"></label><br>
        <label >Club: <input type="text" name="clubJug"></label><br>
        <button type="submit">Enviar</button>
    </form>    
    <h2>Editar jugadora</h2>
    <p>Para editar jugadora click <a href="update.php">aqui</a></p>
</body>
</html>
<?php

require_once("conexion.php");

    if($_SERVER['REQUEST_METHOD']=='POST'){
    
        $nombre = $_POST['nomJug'];
        $apellido = $_POST['apeJug'];
        $edad = $_POST['edadJug'];
        $club = $_POST['clubJug'];
        if ($nombre != "" && $apellido != "" && $edad != "" && $club != "") {
        $query = "INSERT INTO jugadoras(nombre, apellido, club, edad) VALUES('$nombre', '$apellido',  '$club','$edad')";
    
        $smt = $conexion->prepare($query);
        $smt->execute();
        echo("<script>alert('Registro exitoso')</script>");
        }else{
            echo("<script>alert('Registro fallido')</script>");
        };
    };

?>