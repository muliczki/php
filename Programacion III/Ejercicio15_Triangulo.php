<?php
//include "Ejercicio15_FiguraGeometrica.php";

class Triangulo extends FiguraGeometrica
{
    private $_altura;
    private $_base;

    public function __construct($b, $h){
        parent::__construct();
    {
        $this->_altura = $h;
        $this->_base = $b;

        $this->CalcularDatos();

    }}

    public function Dibujar()
    {

        $dibujo ="<br><br>";
        //echo "<center>";
        for ($i=0; $i< $this->_altura; $i++) {
            for ($k=0; $k<$this->_altura; $k++) {
                $dibujo = $dibujo . str_repeat('*', $k + $i++ + 1);
                $dibujo= $dibujo . "<br>";
            }
        }

 
        $this->SetColor("red");
        $color  = $this->GetColor();
        return "<font color=\"$color\">$dibujo</font>";
        
    }

    public function CalcularDatos()
    {
        $this->_superficie = ($this->_altura * $this->_base)/2;
        $this->_perimetro = $this->_altura *2 + $this->_base;
    }

    public function ToString()
    {
        $informacion = "Base: " . $this->_base .
        "<br>Altura: " . $this->_altura;


        return $informacion . parent::ToString() . $this->Dibujar();
    }
}

?>