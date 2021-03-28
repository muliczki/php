<?php

include "Ejercicio18_Garage.php";

$autos = array(new Auto("ROJO","FORD"));

$autos[] = new Auto("NEGRO","FORD");

$autos[] = new Auto("BLANCO","PEUGEOT",800000);
$autos[] = new Auto("BLANCO","PEUGEOT",1000000);

$autos[] = new Auto("GRIS","RENAULT",1600000,'2017-02-03');

$unGarage = new Garage("Todo Rojo SA", 120);


foreach ($autos as $unAuto) {
    $unGarage->Add($unAuto);
}

echo $unGarage->MostrarGarage();

$unGarage->Add($autos[0]); //error

$unGarage->Remove($autos[0]);
$unGarage->Remove($autos[0]); //error

echo $unGarage->MostrarGarage();

?>