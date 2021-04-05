<?php

include "Ej19_Vuelo.php";

$pasajeros = array(new Pasajero("LOPEZ","CARLOS","21456217",TRUE));

$pasajeros[] = new Pasajero("MARTINEZ","LUCAS","34561236",FALSE);

$pasajeros[] = new Pasajero("GOMEZ","MATIAS","41023674", FALSE);
$pasajeros[] = new Pasajero("TRAIZA","MARCELA","25615890", TRUE);

$unVuelo = new Vuelo("LATAM AIRLINES", 60000);

$otroVuelo = new Vuelo("AMERICAN AIRLINES", 70000);

foreach ($pasajeros as $pasajero) {
    echo $unVuelo->AgregarPasajero( $pasajero);
}

echo $otroVuelo->AgregarPasajero( $pasajeros[3]);
echo $unVuelo->GetVuelo();

echo "Suma vuelo 1 y 2: $ ";
echo number_format(Vuelo::Add($unVuelo, $otroVuelo),2); 
echo "<br><br><br>";

Vuelo::Remove($unVuelo,$pasajeros[1]);
Vuelo::Remove($unVuelo,$pasajeros[1]);
echo $unVuelo->GetVuelo();

?>