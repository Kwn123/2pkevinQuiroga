<?php

class Banco
{
    public $nombreBanco;
    public $direccion;
    public $listaCuenta = array();

    public function __construct($nombreBanco, $direccion)
    {
        $this->nombreBanco = $nombreBanco;
        $this->direccion = $direccion;
    }

    public function agregarCuenta($datosCuenta)
    {
        array_push($this->listaCuenta, $datosCuenta);
    }
    public function buscarCuenta($nombreTitular,$apellidoTitular)
    {
        foreach ($this->listaCuenta as $cuenta) {
                if (($nombreTitular == ($cuenta->titular->nombre)) && ($apellidoTitular == ($cuenta->titular->apellido))) {
                    $dato = [$cuenta->titular->nombre, $cuenta->titular->apellido, $cuenta->numeroCuenta, $cuenta->saldo]; 
                    return $dato;
                
            }
        }
    }
}
    /*
    public function agregarCuenta($nombreTitular, $apellidoTitular, $cuenta)
    {
        array_push($this->listaCuenta, array($nombreTitular, $apellidoTitular, $cuenta));
    }
*/
