<?php

include_once "pizza.php";
class PizzaConsultar{

    public static function ConsultarPizza($sabor, $tipo)
    {
        $pizzas = array();

        
        $pizzas = Pizza::LeerJSON("pizza.json");
    
    
        $pizzaAux = Pizza::CrearPizza($sabor, $tipo, 0, 0);
    
    
        if( $pizzaAux->BuscarPizza($pizzas)) //veo si ya existe el producto 
        {
            echo "Si Hay :D\n";
    
        }else{
    
            if($pizzaAux->BuscarPizzaTipo($pizzas)==FALSE && $pizzaAux->BuscarPizzaSabor($pizzas)==FALSE)
            {
                echo "NO HAY TIPO NI SABOR :(\n";
        
            }elseif($pizzaAux->BuscarPizzaTipo($pizzas)==FALSE)
            {
                echo "NO HAY TIPO :(\n";
        
            }else
            {
                echo "NO HAY SABOR :(\n";
        
            }

        }
    
        

    }
}

?> 