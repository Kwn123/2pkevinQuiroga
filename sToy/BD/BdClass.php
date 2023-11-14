<?php
class Conexion {
    private $host = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $nombreBD = "bdStoy";
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->nombreBD);
    }

    public function conectar() {
        return $this->conexion;
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }
    public function ejecutaConsulta($consulta){
        return $this->conexion->query($consulta);
    }
}

?>