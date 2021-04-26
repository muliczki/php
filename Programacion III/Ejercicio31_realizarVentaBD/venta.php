<?php

include_once "accesoDatos.php";
class Venta{

    
    public $_fechaVenta;
    public $_cantidad;
    public $_idProducto;
    public $_idUsuario;
    public $_idVenta;


    public function __construct()
    {
        
    }


    public static function RealizarVenta($idProducto, $idUsuario, $cantidad)
    {
        $venta = new Venta();
        $venta->_fechaVenta = date("y-m-d");
        $venta->_cantidad = $cantidad;
        $venta->_idProducto = $idProducto;
        $venta->_idUsuario = $idUsuario;

        return $venta;
    }

    public function MostrarVenta()
    {
        $aux= "". 
        "ID: " . $this->_id .
        " - ID USUARIO: " . $this->_idUsuario .
        " - ID PRODUCTO: " . $this->_idProducto .
        " - CANTIDAD: " . $this->_cantidad .
        " - FECHA VENTA: " . $this->_fechaVenta;
        return $aux;

    }

    public static function MostrarListaHtml($ventas)
    {
        $aux = "<ul>";

        foreach($ventas as $venta)
        {
            $aux .= "<li>".$venta->MostrarVenta()."</li>";
            
        }
        $aux .= "</ul>";


        return $aux;

    }


    public static function TraerTodasLasVentas()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select id as _id,id_producto as _idProducto,id_usuario as _idUsuario,cantidad as _cantidad,fecha_venta as _fechaVenta from venta");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}

    public function InsertarVentaParametros()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into venta (id_producto, id_usuario, cantidad, fecha_venta) values(:idProducto,:idUser,:cantidad,:fecha)");

        $consulta->bindValue(':idProducto',$this->_idProducto, PDO::PARAM_INT);
        $consulta->bindValue(':idUser',$this->_idUsuario, PDO::PARAM_INT);
        $consulta->bindValue(':fecha', $this->_fechaVenta, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad', $this->_cantidad, PDO::PARAM_INT);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

}