<?php
// La clase Punto ha de tener dos atributos privados con acceso de sólo lectura (sólo con
// getters), que serán las coordenadas del punto. Su constructor recibirá las coordenadas del
// punto.

class Punto
{

private int $_x;
private int $_y;

public function __construct(int $x, int $y)
{
    if(is_int($x) && is_int($y))
    {
        $this->_x = $x;
        $this->_y = $y;
    }
}

public function GetX()
{
    return $this->_x;
}

public function GetY()
{
    return $this->_y;
}

}
?>