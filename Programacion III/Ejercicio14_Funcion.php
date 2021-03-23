<?php 

/*Aplicación No 14 (Par e impar)
Crear una función llamada esPar que reciba un valor entero como parámetro y devuelva TRUE
si este número es par ó FALSE si es impar.
Reutilizando el código anterior, crear la función esImpar.*/

/*
INDEXXXXX
include "Ejercicio14_Funcion.php";

$numero = random_int(1, 100);


echo "$numero es par?? = ". esTrueOrFalse(esPar($numero)) ;
echo "<br>$numero es impar?? = ". esTrueOrFalse(esImpar($numero));

*/


function esPar($numEntero)
{
	if($numEntero%2)
	{
		return FALSE;
	}else{
		return TRUE;
	}
}

function esImpar($numEntero)
{
	return !esPar($numEntero);
}

function esTrueOrFalse($boolean)
{
	if($boolean)
	{
		return "TRUE";
	}else{
		return "FALSE";
	}
}


 ?>