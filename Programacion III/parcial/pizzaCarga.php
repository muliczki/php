<?php

// <!-- PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
// guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
// identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente. -->

include_once "pizza.php";

class PizzaCarga{

    public static function CargarPizza($sabor, $precio, $tipo, $cantidad)
    {
        $pizzas = array();

        
        $pizzas = Pizza::LeerJSON("pizza.json");
    
    
        $pizzaAux = Pizza::CrearPizza($sabor, $tipo,$precio, $cantidad);
    
    
        if( $pizzaAux->BuscarPizza($pizzas)) //veo si ya existe el producto 
        {
            echo "Stock actualizado :D\n";
    
        }else{
    
            $pizzaAux->SetId();
            array_push($pizzas, $pizzaAux);
            echo "Producto ingresado :D\n";
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

