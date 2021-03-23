<?php

/*La clase Rectangulo tiene los atributos privados de tipo Punto _vertice1, _vertice2, _vertice3
y _vertice4 (que corresponden a los cuatro vértices del rectángulo).
La base de todos los rectángulos de esta clase será siempre horizontal. Por lo tanto, debe tener
un constructor para construir el rectángulo por medio de los vértices 1 y 3.
*/

class Rectangulo
{

private $_vertice1;
private $_vertice2;
private $_vertice3;
private $_vertice4;


public $_area;
public $_ladoDos;
public $ladoUno;
public $perimetro;

public function __construct($v1, $v3)
{
    $this->_vertice1 = $v1;
    $this->_vertice3 = $v3;
}

}
?>