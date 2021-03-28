<?php

/*La clase Rectangulo tiene los atributos privados de tipo Punto _vertice1, _vertice2, _vertice3
y _vertice4 (que corresponden a los cuatro vértices del rectángulo).
La base de todos los rectángulos de esta clase será siempre horizontal. Por lo tanto, debe tener
un constructor para construir el rectángulo por medio de los vértices 1 y 3.

INDEXXX
include "Ejercicio16_Rectangulo.php";

$puntoA = new Punto(2,3);
$puntoB = new Punto(14,6);


$rectangulo = new Rectangulo($puntoA, $puntoB);

$rectangulo->Dibujar();

*/

include "Ejercicio16_Punto.php";

class Rectangulo
{

private Punto $_vertice1;
private Punto $_vertice2;
private Punto $_vertice3;
private Punto $_vertice4;

public float $area;
public int $ladoDos;
public int $ladoUno;
public float $perimetro;

public function __construct(Punto $v1, Punto $v3)
{
    if(is_a($v1,"Punto") && is_a($v3,"Punto"))
    {
        $this->_vertice1 = $v1;
        $this->_vertice3 = $v3;

        $this->_vertice2 = new Punto($this->_vertice3->GetX(), $this->_vertice1->GetY());
        $this->_vertice4 = new Punto($this->_vertice1->GetX(), $this->_vertice3->GetY());

        $this->ladoUno = $this->_vertice3->GetX() - $this->_vertice1->GetX(); //base
        $this->ladoDos = $this->_vertice3->GetY() - $this->_vertice1->GetY(); //altura

        $this->perimetro = $this->ladoDos *2 + $this->ladoUno*2;
        $this->area = $this->ladoUno * $this->ladoDos;

    }

}

public function Dibujar()
{
    echo "RECTANGULO". 
    "<br>Base: " . $this->ladoUno .
    "<br>Altura: " . $this->ladoDos .
    "<br>Perímetro: " . $this->perimetro .
    "<br>Area: " . $this->area;

    $dibujo ="<br><br>";
    for ($i=0; $i < $this->ladoDos; $i++) { 
        
        for ($j=0; $j < $this->ladoUno ; $j++) { 
            $dibujo= $dibujo ."*";
        }
        $dibujo= $dibujo . "<br>";

    }
    echo $dibujo;


}

}
?>