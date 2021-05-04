<?php

include_once "pizza.php";
class AltaVenta{

    public static function VenderPizza($sabor, $tipo, $mail, $cantidad, $imagen)
    {

        $pizzas = array();
        
        $pizzas = Pizza::LeerJSON("pizza.json");

        $pizzaAux = Pizza::CrearPizza($sabor, $tipo, 0, $cantidad);


        $ventaAux = $pizzaAux->BuscarPizzaVenta($pizzas, $mail);
        if( $ventaAux==FALSE ) 
        {
            echo "NO SE PUEDE REALIZAR LA VENTA \n";

        }else{

            $ventaAux->GuardarFoto($imagen);
            echo "VENTA ID ", $ventaAux->InsertarVentaParametros(), " INSERTADA EN BASE DE DATOS\n";
        }


        if( Pizza::GuardarJson($pizzas) != FALSE)
        {
            echo "\n--Guardado correctamente--\n";
        }else{
            echo "\n--Error al guardar--\n";
        }


    }

}
?>