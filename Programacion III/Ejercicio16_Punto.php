<?php
// La clase Punto ha de tener dos atributos privados con acceso de sólo lectura (sólo con
// getters), que serán las coordenadas del punto. Su constructor recibirá las coordenadas del
// punto.

class Punto
{

private $_x;
private $_y;

public function __construct($x, $y)
{
    $this->x = $x;
    $this->y = $y;
}

public function GetX()
{
    return $this->x;
}

public function GetY()
{
    return $this->y;
}

}
?>