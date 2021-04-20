<?php

class Venta{

    
    public $_fechaVenta;
    public $_cantidad;
    public $_idProducto;
    public $_idUsuario;
    public $_idVenta;


    public function __construct()
    {
        
    }

    public function MostrarVenta()
    {
        $aux= "". 
        "ID: " . $this->_id .
        " - ID USUARIO: " . $this->_idUsuario .
        " - ID PRODUCTO: " . $this->_idProducto .
        " - CANTIDAD: " . $this->_cantidad .
        " - FECHA VENTA: " . $this->_fechaRegistro;
        return $aux;

    }

    public static function MostrarListaHtml($ventas)
    {
        $aux = "<ul>";

        foreach($ventas as $venta)
        {
            $aux .= "<li>".$venta->MostrarUsuario()."</li>";
            
        }
        $aux .= "</ul>";


        return $aux;

    }


    public static function TraerTodosLasVentas()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select id as _id,id_producto as _idProducto,id_usuario as _idUsuario,cantidad as _cantidad,fecha_venta as _fechaVenta from venta");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}


}