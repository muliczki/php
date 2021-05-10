<?php

include_once "accesoDatos.php";
include_once "venta.php";
class Producto{

    public $_nombre;
    public $_codigoBarra;
    public $_tipo;
    public $_stock;
    public $_precio;
    public $_id;
    public $_fechaCreacion;
    public $_fechaModificacion;

    public function __construct()
    {
        
    }

    public function MostrarProducto()
    {
        $aux= "". 
        "ID: " . $this->_id .
        " - CODIGO BARRA: " . $this->_codigoBarra .
        " - NOMBRE: " . $this->_nombre .
        " - TIPO: " . $this->_tipo .
        " - STOCK: " . $this->_stock .
        " - PRECIO: $ " . $this->_precio .
        " - FECHA CREACION: " . $this->_fechaCreacion .
        " - FECHA MODIF: " . $this->_fechaModificacion;
        return $aux;

    }
    
    public static function MostrarListaHtml($productos)
    {
        $aux = "<ul>";

        foreach($productos as $producto)
        {
            $aux .= "<li>".$producto->MostrarProducto()."</li>";
            
        }
        $aux .= "</ul>";


        return $aux;

    }

    public static function TraerTodosLosProductos()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select id as _id,nombre as _nombre,codigo_barra as _codigoBarra,tipo as _tipo,stock as _stock,precio as _precio,fecha_creacion as _fechaCreacion,fecha_modificacion as _fechaModificacion from producto");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		
	}

    // public function __construct(String $nombre, String $codigo, String $tipo, String $stock, String $precio)
    // {
    //     if(is_string($nombre) && is_int((int) $codigo) && is_string($tipo)&& is_int((int) $stock) && is_float((float) $precio))
    //     {
            
    //         $this->_nombre = $nombre;
    //         $this->_codigoBarra = (int) $codigo;
    //         $this->_stock = (int) $stock;
    //         $this->_precio = (float) $precio;
    //         $this->_tipo = $tipo;
    //         //$this->_id = self::GetIDoriginal();


    //     }
    // }

    public static function CrearProducto($nombre, $codigo, $tipo, $stock, $precio)
    {
        $aux = new Producto();
        $aux->_nombre = $nombre;
        $aux->_codigoBarra = $codigo;
        $aux->_tipo = $tipo;
        $aux->_stock = $stock;
        $aux->_precio = $precio;
        $aux->_fechaCreacion = date("y-m-d");
        $aux->_fechaModificacion = date("y-m-d");


        return $aux;

    }

    // public function SetId()
    // {
    //     $this->_id = self::GetIDoriginal();
    // }

    // public static function GetIDoriginal()
    // {
    //     return random_int(1,10000);
    // }

    // public static function GuardarJson($array)
    // {
    //     $json_string = json_encode($array);
    //     //var_dump($json_string);
    //     $file = 'productos.json';
    //     return file_put_contents($file, $json_string);
        
    // }

    // public static function LeerJSON(String $archivoPath)
    // {
    //     if(!is_null($archivoPath))
    //     {
    //         $arrayLeido = array();
    //         $data = file_get_contents($archivoPath);
            
    //         //echo $data,"\n";
            
    //         $arrayTexto = json_decode($data, TRUE);
            
    //         if(is_null($arrayTexto))
    //         {
    //             return $arrayLeido;
    //         }else
    //         {
            
    //             foreach ($arrayTexto as $array)
    //             {
                    
    //                 //var_dump($array);
    //                 $aux = self::TransformarLeidoJson($array["_nombre"], $array["_codigoBarra"], $array["_tipo"], $array["_stock"], $array["_precio"], $array["_id"]);
                    
    //                 //echo $user->MostrarUsuario();
    //                 // $user = self::TransformarAUsuario($array[$i]["_nombre"], $array[$i]["_clave"], $array[$i]["_mail"], $array[$i]["_id"], $array[$i]["_fechaRegistro"], $array[$i]["_fotoRuta"]);
                    
    //                 array_push($arrayLeido, $aux);
    //             }

    //             //var_dump($usuarios);
    //             return $arrayLeido;
    //         }
    //     }
        
    // }


    public function BuscarProductoObjeto($array)
    {
        $retorno = FALSE;
        if(!is_null($array) && !is_null($this->_codigoBarra))
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

    public static function BuscarProducto($array, $codigo)
    {
        $retorno = FALSE;
        if(!is_null($array) && !is_null($codigo))
        {
            foreach($array as $aux)
            {
                if (is_a($aux, "Producto") && $aux->_codigoBarra == $codigo)
                {
                    $retorno= TRUE;
                    break;
                }
            }

        }
        return $retorno;
    }

    public function ModificarProductoParametros()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update producto 
            set stock=:stock,
            fecha_modificacion= :fechaModificacion
            WHERE codigo_barra=:codigo");
        $consulta->bindValue(':stock',$this->_stock, PDO::PARAM_INT);
        $consulta->bindValue(':fechaModificacion',$this->_fechaModificacion, PDO::PARAM_STR);
        $consulta->bindValue(':codigo',$this->_codigoBarra, PDO::PARAM_STR);
        return $consulta->execute();
	}


    public function ActualizarStock($array)
    {
        $retorno=FALSE;

        $key = array_search($this->_codigoBarra, array_column($array, '_codigoBarra'));
        if(!is_null($key))
        {
            $this->_stock += $array[$key]->_stock ;
            $retorno = TRUE;
        }
        
        return $retorno;
    }

    public function InsertarProductoParametros()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (codigo_barra,nombre,tipo, stock,precio,fecha_creacion,fecha_modificacion) values(:codigo_barra,:nombre,:tipo,:stock,:precio,:fechaCreacion, :fechaModificacion)");

        $consulta->bindValue(':codigo_barra',$this->_codigoBarra, PDO::PARAM_STR);
        $consulta->bindValue(':nombre',$this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->_tipo, PDO::PARAM_STR);
        $consulta->bindValue(':stock', $this->_stock, PDO::PARAM_INT);
        $consulta->bindValue(':precio', $this->_precio, PDO::PARAM_STR);
        $consulta->bindValue(':fechaCreacion', $this->_fechaCreacion, PDO::PARAM_STR);
        $consulta->bindValue(':fechaModificacion', $this->_fechaModificacion, PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}
    
    public static function ValidarStock($array, $codigoBarra, $cantidadPedida, $idComprador)
    {
        $retorno = "No se pudo actualizar stock :(\n";

        if(!is_null($array) && is_int($codigoBarra) && is_int($cantidadPedida))
        {
            $key = array_search($codigoBarra, array_column($array, '_codigoBarra'));
            
            if(!is_null($key))
            {
                if($array[$key]->_stock >= $cantidadPedida)
                {
                    $nuevaVenta = Venta::RealizarVenta($array[$key]->_id, $idComprador, $cantidadPedida );

                    $array[$key]->_stock -= $cantidadPedida;
                    $array[$key]->_fechaModificacion = date("y-m-d");

                    $array[$key]->ModificarProductoParametros();

                    $retorno = $nuevaVenta;
                }else{
                    
                    $retorno = "No se puede realizar la venta. Stock disponible: ".$array[$key]->_stock."\n";
                }
            }
        }
        
        return $retorno;

    }

    public static function TraerTodosLosProductosOrdenados($criterio)
	{
        if($criterio=="desc" || $criterio=="DESC")
        {
            $orden = "DESC";
        }else{
            $orden = "ASC";
        }

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select id as _id,nombre as _nombre,codigo_barra as _codigoBarra,tipo as _tipo,stock as _stock,precio as _precio,fecha_creacion as _fechaCreacion,fecha_modificacion as _fechaModificacion from producto ORDER BY nombre ". $orden);
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		
	}


    
    

}