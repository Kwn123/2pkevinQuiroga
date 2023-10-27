<?php
trait Calculo{

public static function porcentajeNota($porcentaje,$nota1,$nota2){
    $promedio = ($nota1 + $nota2) / 2 ;

    if (($porcentaje >= 80) && ($promedio >= 8)) {
        $resultado = "Promocion";
    }
    if (($porcentaje <= 80 && $porcentaje >= 50 ) && ($promedio >= 6)) {
        $resultado = "Regular";
    }
    if (($porcentaje <= 50 ) || ($promedio <= 6)) {
        $resultado = "Libre";
    }
    return $resultado;
} 
    
}


/* 
Funcion 3 parametros
PORCENTAJE {
recibe porcentaje 
2 notas de  1 a 10}

return libre, regular y promocion
Si el porcentaje es 0 => 80 Y el promedio de notas es mayor a 8 es = PROMOCION
Si el porcentaje <=  80  50 >= y promedio es mayor a 6 es = REGULAR
Si el porcentaje <= 50 o promedio es menor a 6 es = LIBRE 
*/
?>