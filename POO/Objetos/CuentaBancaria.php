<?php

class CuentaBanco {
public $numeroCuenta;
public  $titular;
public $saldo;

public function __construct($numeroCuenta,$titular,$saldo){
    $this->numeroCuenta = $numeroCuenta;
    $this->titular =$titular;
    $this->saldo = $saldo;
}
public function depocitar($monto){
    $this->saldo += $monto;
    $resultado = "Se ha depositado $".$monto.", su saldo actual es de $".$this->saldo;
    return $resultado;
}
public function retirar($monto){
    if($monto <= $this->saldo){
    $this->saldo -= $monto;

    $resultado = "Retiro exitoso de $".$monto." su saldo actual es de $".$this->saldo."\n";
    return $resultado;

    }else{

    $resultado = "Saldo insuficiente, su saldo actual es de $".$this->saldo."\n";
    return $resultado;
    }
}
}
