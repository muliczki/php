<?php


abstract class FiguraGeometrica
{
    protected $_color; 
    protected $_perimetro; 
    protected $_superficie; 

    public function __construct()
    {

    }

    public function GetColor ()
    {
        return $this->_color;
    }

    public function SetColor ($color)
    {
        return $this->_color = $color;
    }

    public function ToString()
    {
        $informacion = "<br>Perimetro: " . $this->_perimetro .
        "<br>Superficie: " . $this->_superficie;

        return $informacion;
    }

    public abstract function Dibujar();

    protected abstract function CalcularDatos();


}


?>