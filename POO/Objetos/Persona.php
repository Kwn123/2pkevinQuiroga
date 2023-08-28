<?php

class Persona
{
    public $nombre;
    public  $apellido;
    public $edad;
    public $dni;
    public $numeroCuenta;
    public function __construct($nombre, $apellido, $edad, $dni, $numeroCuenta){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->edad = $edad;
        $this->dni = $dni;
        $this->numeroCuenta = $numeroCuenta;
    }


}
