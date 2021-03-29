<?php

/*Pasajero
Atributos privados: _apellido (string), _nombre (string), _dni (string), _esPlus (boolean)
Crear un constructor capaz de recibir los cuatro parámetros.
Crear el método de instancia “Equals” que permita comparar dos objetos Pasajero. Retornará
TRUE cuando los _dni sean iguales.
Agregar un método getter llamado GetInfoPasajero, que retornará una cadena de caracteres
con los atributos concatenados del objeto.
Agregar un método de clase llamado MostrarPasajero que mostrará los atributos en la página
*/

class Pasajero{

    private String $_apellido;
    private String $_nombre;
    private String $_dni;
    private bool $_esPlus;

    public function __construct(String $apellido, String $nombre, String $dni, bool $plus)
    {
        if(is_string($apellido) && is_string($nombre) && is_string($dni) && is_bool($plus))
        {
            $this->_apellido = $apellido;
            $this->_nombre = $nombre;
            $this->_dni = $dni;
            $this->_esPlus = $plus;
        }
        
    }

    public function Equals(Pasajero $otroPasajero)
    {
        if(!is_null($otroPasajero))
        {
            if($this->_dni == $otroPasajero->_dni)
            {
                return TRUE;
            }
            
            return FALSE;
        }
    }

    public function GetEsPlus()
    {
        return $this->_esPlus;
    }

    public function GetInfoPasajero()
    {
        $aux= "PASAJERO". 
        "<br>NOMBRE: " . $this->_nombre .
        "<br>APELLIDO: " . $this->_apellido .
        "<br>DNI: " . $this->_dni.
        "<br>ES PLUS: ";
        if($this->_esPlus)
        {
            $aux .= "SI<br><br>";
        }else{
            $aux .= "NO<br><br>";
        }

        return $aux;
    }

    public static function MostrarPasajero (Pasajero $unPasajero)
    {
        return $unPasajero->GetInfoPasajero();
    }
}


?>