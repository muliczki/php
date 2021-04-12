<?php

class Producto{

    public String $_nombre;
    public int $_codigoBarra;
    public String $_tipo;
    public int $_stock;
    public float $_precio;
    public int $_id;
    
    public function __construct(String $nombre, String $codigo, String $tipo, String $stock, String $precio)
    {
        if(is_string($nombre) && is_int((int) $codigo) && is_string($tipo)&& is_int((int) $stock) && is_float((float) $precio))
        {
            
            $this->_nombre = $nombre;
            $this->_codigoBarra = (int) $codigo;
            $this->_stock = (int) $stock;
            $this->_precio = (float) $precio;
            $this->_tipo = $tipo;
            //$this->_id = self::GetIDoriginal();


        }
    }

    public static function TransformarLeidoJson($nombre, $codigo, $tipo, $stock, $precio, $id)
    {
        $aux = new Producto($nombre, $codigo, $tipo, $stock, $precio);
        $aux->_id = $id;

        return $aux;

    }

    public function SetId()
    {
        $this->_id = self::GetIDoriginal();
    }

    public static function GetIDoriginal()
    {
        return random_int(1,10000);
    }

    public static function GuardarJson($array)
    {
        $json_string = json_encode($array);
        //var_dump($json_string);
        $file = 'productos.json';
        return file_put_contents($file, $json_string);
        
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
                    $aux = self::TransformarLeidoJson($array["_nombre"], $array["_codigoBarra"], $array["_tipo"], $array["_stock"], $array["_precio"], $array["_id"]);
                    
                    //echo $user->MostrarUsuario();
                    // $user = self::TransformarAUsuario($array[$i]["_nombre"], $array[$i]["_clave"], $array[$i]["_mail"], $array[$i]["_id"], $array[$i]["_fechaRegistro"], $array[$i]["_fotoRuta"]);
                    
                    array_push($arrayLeido, $aux);
                }

                //var_dump($usuarios);
                return $arrayLeido;
            }
        }
        
    }


    public function BuscarProducto($array)
    {
        $retorno = FALSE;
        if(!is_null($array))
        {
            foreach($array as $aux)
            {
                if (is_a($aux, "Producto") && $aux->_codigoBarra == $this->_codigoBarra)
                {
                    $retorno= TRUE;
                    break;
                }
            }

        }
        return $retorno;
    }

    public function ActualizarStock($array)
    {
        $retorno="";

        $key = array_search($this->_codigoBarra, array_column($array, '_codigoBarra'));
        if(!is_null($key))
        {
            $array[$key]->_stock += $this->_stock;
            $retorno = "Stock actualizado :D\n";
        }else{
            $retorno = "No se pudo actualizar stock :(\n";
        }

        return $retorno;
    }


}