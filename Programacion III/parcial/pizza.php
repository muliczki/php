<?php

class Pizza{

    public $_sabor;
    public $_id;
    public $_precio;
    public $_tipo;
    public $_cantidad;
    public $_imagen;



    

    public function __construct()
    {
        
    }

    
    public static function LeerJSON(String $archivoPath)
    {
        if(!is_null($archivoPath))
        {
            $arrayLeido = array();
            $data = file_get_contents($archivoPath);
            
            //echo $data,"\n";
            
            $arrayTexto = json_decode($data, TRUE);
            
            if(is_null($arrayTexto))
            {
                return $arrayLeido;
            }else
            {
            
                foreach ($arrayTexto as $array)
                {
                    
                    //var_dump($array);
                    $aux = self::TransformarLeidoJson($array["_id"], $array["_sabor"], $array["_tipo"], $array["_precio"], $array["_cantidad"], $array["_imagen"]);
                    
                    //echo $user->MostrarUsuario();
                    // $user = self::TransformarAUsuario($array[$i]["_nombre"], $array[$i]["_clave"], $array[$i]["_mail"], $array[$i]["_id"], $array[$i]["_fechaRegistro"], $array[$i]["_fotoRuta"]);
                    
                    array_push($arrayLeido, $aux);
                }

                //var_dump($usuarios);
                return $arrayLeido;
            }
        }
        
    }


    public static function TransformarLeidoJson($id, $sabor, $tipo, $precio, $cantidad, $imagen)
    {
        $aux = new Pizza();
        $aux->_id = $id;
        $aux->_sabor = $sabor;
        $aux->_tipo = $tipo;
        $aux->_precio = $precio;
        $aux->_cantidad = $cantidad;
        $aux->_imagen = $imagen;

        return $aux;

    }


    public static function GuardarJson($array)
    {
        $json_string = json_encode($array);
        //var_dump($json_string);
        $file = 'pizza.json';
        return file_put_contents($file, $json_string);
        
    }
    

    public static function CrearPizza($sabor, $tipo, $precio, $cantidad)
    {
        $aux = new Pizza();
        // $aux->_id = random_int(0,10000);
        $aux->_sabor = $sabor;
        $aux->_tipo = $tipo;
        $aux->_precio = $precio;
        $aux->_cantidad = $cantidad;
        // $aux->_imagen = $imagen;

        return $aux;

    }

    public function BuscarPizza($array)
    {
        $retorno = FALSE;
        if(!is_null($array))
        {
            foreach($array as $aux)
            {
                if (is_a($aux, "Pizza") && $aux->_sabor == $this->_sabor && $aux->_tipo == $this->_tipo)
                {
                    $aux->_cantidad += $this->_cantidad;
                    $retorno= TRUE;
                    break;
                }
            }

        }
        return $retorno;
    }



    public function SetId()
    {
        $this->_id = self::GetIDoriginal();
    }

    public static function GetIDoriginal()
    {
        return random_int(1,10000);
    }


    public function BuscarPizzaSabor($array)
    {
        $retorno = FALSE;
        foreach($array as $aux) 
        {
            if($aux->_sabor == $this->_sabor)
            {
                $retorno = TRUE;
                break;
            }
            
        }
        return $retorno;
    }

    public function BuscarPizzaTipo($array)
    {
        $retorno = FALSE;
        foreach($array as $aux) 
        {
            if($aux->_tipo == $this->_tipo)
            {
                $retorno = TRUE;
                break;
            }
            
        }
        return $retorno;
    }


    public function BuscarPizzaVenta($array, $mail)
    {
        $retorno = FALSE;
        if(!is_null($array))
        
        {
            foreach($array as $aux)
            {
                if (is_a($aux, "Pizza") && $aux->_sabor == $this->_sabor && $aux->_tipo == $this->_tipo)
                {
                    if($aux->_cantidad >= $this->_cantidad)
                    {
                        include_once "venta.php";
                        $nuevaVenta = Venta::RealizarVenta($mail, $this->_tipo, $this->_sabor, $this->_cantidad );
                        $aux->_cantidad -= $this->_cantidad;
                        $retorno = $nuevaVenta;
                        break;
                    }
                
                    
                }
            }

        }
        return $retorno;
    }



}



?>

