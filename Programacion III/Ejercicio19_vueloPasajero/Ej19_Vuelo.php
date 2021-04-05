<?php

include "Ej19_Pasajero.php";
class Vuelo{

    private DateTime $_fecha;
    private String $_empresa;
    private float $_precio;
    private $_listaDePasajeros; //Pasajero[]
    private int $_cantMaxima;


    public function __construct(String $empresa, float $precio, $cantMax = 3)
    {
        if(is_string($empresa) && is_float($precio) && is_int($cantMax))
        {
        $this->_fecha = new DateTime('NOW');
        $this->_empresa = $empresa;
        $this->_precio = $precio;
        $this->_cantMaxima = $cantMax;
        $this->_listaDePasajeros = array();
        }

    }

    public function GetCantMax()
    {
        return $this->_cantMaxima;
    }


    public function GetVuelo()
    {
        $aux= "VUELO". 
        "<br>EMPRESA: " . $this->_empresa .
        "<br>FECHA: " . $this->_fecha->format('Y/m/d') .
        "<br>PRECIO: $ " . number_format( $this->_precio,2)  . 
        "<br>CANT MAX PASAJEROS: " . $this->_cantMaxima ."<br><br>" .


        "PASAJEROS:<br>";
        
        foreach ($this->_listaDePasajeros as $unPasajero) {
        $aux .=  Pasajero ::MostrarPasajero($unPasajero);
        }
        
        return $aux;

    }


    public function AgregarPasajero(Pasajero $unPasajero)
    {
        if(!is_null($unPasajero) && is_a($unPasajero,"Pasajero"))
        {
            foreach ($this->_listaDePasajeros as $pasajero) {
                if($pasajero->Equals($unPasajero))
                {
                    return "<br>-- EL PASAJERO YA SE ENCUENTRA EN EL VUELO --<br><br>";
                }
            }
            if(!is_null($this->_listaDePasajeros) && count($this->_listaDePasajeros, COUNT_NORMAL)+1 > $this->GetCantMax())
            {
                return "<br>-- EL VUELO SE ENCUENTRA LLENO --<br><br>";
            }else{
                array_push($this->_listaDePasajeros, $unPasajero);
                return "<br>-- SE AGREGO EL PASAJERO AL VUELO --<br><br>";
            }
        }
    }


    public function MostrarVuelo()
    {
        return $this->GetVuelo();
    }



    public static function Add(Vuelo $v1, Vuelo $v2)
    {
        if(is_a($v1, "Vuelo")&& is_a($v2, "Vuelo"))
        {
        $total=0;
        foreach ($v1->_listaDePasajeros as $pasajero) {
            if($pasajero->GetEsPlus())
            {
                $total += $v1->_precio* 0.8;
            }else{
                $total += $v1->_precio;
            }
        }

        foreach ($v2->_listaDePasajeros as $pasajero) {
            if($pasajero->GetEsPlus())
            {
                $total += $v2->_precio* 0.8;
            }else{
                $total += $v2->_precio;
            }
        }
        return $total;
        }

    }


    public static function Remove(Vuelo $unVuelo, Pasajero $unPasajero)
    {
        if(!is_null($unPasajero) && is_a($unPasajero,"Pasajero") &&
        !is_null($unVuelo) && is_a($unVuelo,"Vuelo"))
        {
            foreach ($unVuelo->_listaDePasajeros as $pasajero) {
                if($pasajero->Equals($unPasajero))
                {
                    unset($unVuelo->_listaDePasajeros[array_search($unPasajero,$unVuelo->_listaDePasajeros)]);
                    return $unVuelo;
                  
                }
            }
            echo "<br><br>--No se puede eliminar. El pasajero no está en el vuelo--<br><br>";
            return $unVuelo;
            
        }
    }
}

?>
