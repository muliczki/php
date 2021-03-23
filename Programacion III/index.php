<?php

include "Ejercicio15_Rectangulo.php";
include "Ejercicio15_Triangulo.php";

$newRectangulo = new Rectangulo(3,8);
$newTriangulo = new Triangulo(5,3);

echo $newRectangulo->ToString();
echo $newTriangulo->ToString();

?>