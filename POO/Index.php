<?php
/*sistema bancario

3 clases 
	persona
	banco
	cuentaBancaria

persona: nombre,apellido,edad,dni,numeroCuenta
metodo:-constructor->(nombre,apellido,edad,dni,numeroCuenta)

banco: nombreBanco,dirección,listaCuentaBancaria(array) 
Metodos: -constructor->(nombre,direccion)
	 -agregarCuenta->(cuenta)(lista)
	 -buscarCuentaTitular->(nombre,apellido) return(cuentaBancariaAsociadaPersona)

cuentaBancaria: numeroCuenta,titular(instancia clas persona),saldo
Metodos: -cnstructor->(inicializarNroCuenta,titular,saldo)
	 -depocitar(cantidad)
	 -retirar(cantidad) //si y solo si tiene saldo 
	 
Ejercicios 
1. Crear al menos dos instancias  de la clase persona y dos instancias de la clase cuenta bancaria
2. Crear una instancia de la clase banco y agregar las cuentas bancarias a la lista del banco
3. Realizar las siguientes operaciones
	a.depocita diferentes cantidades en las cuentas banacarias
	b.Realiza retiros de diferentes montos de las cuentas bancarias revisando si se puede
	c.busca una cuenta bancaria por el titular utilizando el metodo buscarcuenta por el titular
*/

require_once("Objetos/Persona.php");
require_once("Objetos/Banco.php");
require_once("Objetos/CuentaBancaria.php");

$persona1 = new Persona("Kevin","Quiroga",27,40018598,123456);
$persona2 = new Persona("Ingrid","Larrosa",24,41200953,654321);

$banco1 = new Banco("Banco BBVA","Urquiza 850");


$cuenta1 = new CuentaBanco($persona1->numeroCuenta,$persona1,500);
$banco1->agregarCuenta($cuenta1);

$cuenta2 = new CuentaBanco($persona2->numeroCuenta,$persona2,2000);
$banco1->agregarCuenta($cuenta2);

$cuentaBancaria1 = new CuentaBanco($persona1->numeroCuenta,$persona1->nombre,500);
$cuentaBancaria2 = new CuentaBanco($persona2->numeroCuenta,$persona2->nombre,2000);
echo("-----Depocito persona 1-----------------------------------------------------------------<br>");
echo($cuentaBancaria1->depocitar(100)."<br>");
echo($cuentaBancaria1->depocitar(200)."<br>");
echo("<br>");
echo("-----Depocito persona 2-----------------------------------------------------------------<br>");
echo($cuentaBancaria1->depocitar(1600)."<br>");
echo($cuentaBancaria1->depocitar(2500)."<br>");
echo("<br>");
echo("-----Retiro persona 1-----------------------------------------------------------------<br>");
echo($cuentaBancaria1->retirar(100)."<br>");
echo($cuentaBancaria1->retirar(200)."<br>");
echo($cuentaBancaria1->retirar(400)."<br>");
echo("<br>");
echo("-----Retiro persona 2----------------------------------------------------------------<br>");
echo($cuentaBancaria1->retirar(1000)."<br>");
echo($cuentaBancaria1->retirar(2500)."<br>");
echo($cuentaBancaria1->retirar(4000)."<br>");
echo("<br>");
echo("-----Busqueda cuenta ----------------------------------------------------------------<br>");
echo print_r($banco1->buscarCuenta("Kevin","Quiroga"));
?>