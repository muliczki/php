<?php


/*
INDEXXX
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

*/
include "Ejercicio17_Auto.php";

class Garage{

private String $_razonSocial;
private float $_precioPorHora;
private $_autos; //Auto[]

public function __construct(String $razonSocial, float $precio=0)
{
    if(is_string($razonSocial) && is_float($precio))
    {
        $this->_razonSocial= $razonSocial;
        $this->_precioPorHora= $precio;
        $this->_autos = array();
    }
}

public function MostrarGarage()
{
    $aux= "GARAGE". 
    "<br>Razon Social: " . $this->_razonSocial .
    "<br>Precio por hora: $ " . number_format( $this->_precioPorHora,2)  . "<br><br>" .

    "AUTOS:<br>";
    foreach ($this->_autos as $auto) {
      $aux .=  Auto ::MostrarAuto($auto);
    }
     
    return $aux;

}

public function Equals (Auto $unAuto)
{
    if(!is_null($unAuto) && is_a($unAuto,"Auto") && in_array($unAuto, $this->_autos))
    {
        return TRUE;
    }
    
    return FALSE;
}

public function Add(Auto $unAuto)
{
    if(!is_null($unAuto) && is_a($unAuto,"Auto"))
    {
        if($this->Equals($unAuto))
        {
            echo "<br><br>--El auto ya está en el garage--<br><br>";
        }else{
            array_push($this->_autos,$unAuto);
        }
    }
}

public function Remove(Auto $unAuto)
{
    if(!is_null($unAuto) && is_a($unAuto,"Auto"))
    {
        if($this->Equals($unAuto))
        {
            unset($this->_autos[array_search($unAuto,$this->_autos)]);
        }else{
            echo "<br><br>--No se puede eliminar. El auto no está en el garage--<br><br>";
        }
    }
}


}


?>