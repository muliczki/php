<?php
include "Ejercicio15_FiguraGeometrica.php";

class Rectangulo extends FiguraGeometrica
{
    private $_ladoDos;
    private $_ladoUno;

    public function __construct($l1, $l2){
        parent::__construct();
    {
        $this->_ladoUno = $l1;
        $this->_ladoDos = $l2;

        $this->CalcularDatos();

    }}

    public function Dibujar()
    {
        $dibujo ="<br><br>";
        for ($i=0; $i < $this->_ladoUno; $i++) { 
            
            for ($j=0; $j < $this->_ladoDos ; $j++) { 
                $dibujo= $dibujo ."*";
            }
            $dibujo= $dibujo . "<br>";

        }

        $this->SetColor("blue");
        $color  = $this->GetColor();
        return "<font color=\"$color\">$dibujo</font>"."<br><br>";
        
    }

    public function CalcularDatos()
    {
        $this->_superficie = $this->_ladoUno * $this->_ladoDos;
        $this->_perimetro = $this->_ladoUno*2 + $this->_ladoDos*2;
    }

    public function ToString()
    {
        $informacion = "Lado uno: " . $this->_ladoUno .
        "<br>Lado dos: " . $this->_ladoDos;


        return $informacion . parent::ToString() . $this->Dibujar();
    }
}

?>