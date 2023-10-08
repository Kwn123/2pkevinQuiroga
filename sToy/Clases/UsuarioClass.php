<?php 
class Usuario{

    public static function verificar($usuario, $password){
        $consulta =("SELECT * FROM admin WHERE usuario = '$usuario' AND password = '$password'");
        return $consulta;
    }
    public static function dniUsuario($password){
        $consulta =("SELECT * FROM admin WHERE password = '$password'");
        return $consulta;
    
    }
    
}

?>