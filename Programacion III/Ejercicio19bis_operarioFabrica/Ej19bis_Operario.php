<?php

class Operario{

    private String $_apellido;
    private String $_nombre;
    private int $_legajo;
    private float $_salario;

    public function __construct(int $legajo, String $apellido, String $nombre)
    {
        if(is_string($apellido) && is_string($nombre) && is_int($legajo))
        {
            $this->_apellido = $apellido;
            $this->_nombre = $nombre;
            $this->_legajo = $legajo;
        }
        
    }

    public function Equals(Operario $op1, Operario $op2) : bool
    {
        if(!is_null($op1) && !is_null($op2))
        {
            if($op1->_nombre == $op2->_nombre &&
            $op1->_apellido == $op2->_apellido &&
            $op1->_legajo == $op2->_legajo)
            {
                return TRUE;
            }
            
            return FALSE;
        }
    }

    public function GetNombreApellido() :string
    {
        return $this->_nombre . ", " . $this->_apellido;
    }

    public function GetSalario() :float
    {
        return $this->_salario;
    }

    public function SetAumentarSalario(float $aumento) : void
    {
        $this->_salario += $this->_salario * $aumento / 100;
    }

    public function Mostrar() :string
    {
        $aux= "OPERARIO<br>". 
        $this->GetNombreApellido() .
        "<br>LEGAJO: " . $this->_legajo.
        "<br>SALARIO: " . $this->_salario;

        return $aux;
    }

    public static function MostrarOperario (Operario $unOperario)
    {
        return $unOperario->Mostrar();
    }
}


?>