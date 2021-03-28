<?php

/*
INDEXXXXXX
include "Ejercicio17_Auto.php";

$Autos = array(new Auto("ROJO","FORD"));

//Crear dos objetos “Auto” de la misma marca y distinto color.
$Autos[] = new Auto("NEGRO","FORD");

//Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
$Autos[] = new Auto("BLANCO","PEUGEOT",800000);
$Autos[] = new Auto("BLANCO","PEUGEOT",1000000);

//Crear un objeto “Auto” utilizando la sobrecarga restante.
$Autos[] = new Auto("GRIS","RENAULT",1600000,'2017-02-03');

// Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al atributo precio.
for ($i= count($Autos); $i > count($Autos)-3 ; $i--) { 
    $Autos[$i-1]->AgregarImpuestos(1500);

}


echo "Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el resultado obtenido:";
$importeDouble = Auto::Add($Autos[0], $Autos[1]);
echo "Suma Auto1 + Auto2: $ " . number_format($importeDouble,2). "<br><br>";

echo "<br>Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no:";
if($Autos[0]->Equals($Autos[1]))
{
    echo "<br>AUTO 1 Y AUTO 2, SON IGUALES. MISMA MARCA<br>";
}else{
    
    echo "<br>AUTO 1 Y AUTO 2, SON DISTINTOS. DISTINTA MARCA<br>";
}

if($Autos[0]->Equals($Autos[4]))
{
    echo "<br>AUTO 1 Y AUTO 5, SON IGUALES. MISMA MARCA<br>";
}else{
    
    echo "<br>AUTO 1 Y AUTO 5, SON DISTINTOS. DISTINTA MARCA<br><br>";
}


echo "<br>Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5):";   

$i=1;
foreach ($Autos as $aut) {
    if($i%2)
    {
        Auto::MostrarAuto($aut);
    }
    $i++;
}
*/

class Auto{

private String $_color;
private float $_precio;
private String $_marca;
private $_fecha;


function __construct($color, $marca , $precio=0, $fecha='1900-01-01')
{
    $this->_color=$color; 
    $this->_marca=$marca; 
    $this->_precio=$precio; 
    $this->_fecha = $fecha; 
}

public static function MostrarAuto(Auto $unAuto)
{
    //$precioFormato = money_format("000,000.00",$this->_precio);
    $aux ="AUTO". 
    "<br>Marca: " . $unAuto->_marca .
    "<br>Color: " . $unAuto->_color .
    "<br>Precio con impuestos: $ " .  number_format( $unAuto->_precio,2) .
    "<br>Fecha de fabricación: " . $unAuto->_fecha . "<br><br><br>"; //->format('Y/m/d');

    return $aux;
}

public function AgregarImpuestos(float $impuestos)
{
    $this->_precio += $impuestos;
}

public function Equals(Auto $auto1){

    return ($this->_marca == $auto1->_marca);
}

public static function Add(Auto $auto1, Auto $auto2)
{
    $precio = 0;
    if($auto1->Equals($auto2) && $auto1->_color == $auto2->_color)
    {
        $precio = $auto1->_precio + $auto2->_precio;
    }else{
        echo "No se pueden sumar. Distinta marca/color<br>";
    }

    return $precio;
}


}

?>
