<?php 

/*Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.*/

/*
INDEXXXXX
include "Ejercicio12_Funcion.php";

$letras = array('M','I','C','A');

$invertido = invertirPalabra($letras);

imprimirArray($invertido);



*/


function invertirPalabra(&$array)
{
	for ($i=0; $i < count($array) ; $i++) { 
	
	$palabraInvertida[count($array)-$i-1] = $array[$i];
	}

	return $palabraInvertida;
}

function imprimirArray (&$array)
{
	for ($i=0; $i < count($array) ; $i++) { 
		echo $array[$i] . "<br>";
	}
}




 ?>