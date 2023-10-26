<?php
require("../BD/BdClass.php");
require("../Clases/ParametroClass.php");
$conexion = new Conexion();
$conexion->conectar();
$consulta = Parametro::getParametros();
$parametros = $conexion->ejecutaConsulta($consulta);
$parametros = $parametros->fetch_object();
$id = $parametros->id;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $clasesTotal = $_GET['clasesTotal'];
    $promocion = $_GET['promocion'];
    $regular = $_GET['regular'];

    if (!empty($clasesTotal)) {
            $consulta = Parametro::setClases($id, $clasesTotal);
            $conexion->ejecutaConsulta($consulta);
        
    }
    if (!empty($promocion)) {
            $consulta = Parametro::setPromocion($id, $promocion);
            $conexion->ejecutaConsulta($consulta);
    }
    if (!empty($regular)) {
            $consulta = Parametro::setRegular($id, $regular);
            $conexion->ejecutaConsulta($consulta);
    }
    header("Location: ../index.php");
}
