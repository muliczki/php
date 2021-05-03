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

    public static function TraerVentasEntreCantidades($q1, $q2)
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select id as _id,id_producto as _idProducto,id_usuario as _idUsuario,cantidad as _cantidad,fecha_venta as _fechaVenta from venta WHERE cantidad BETWEEN :cant1 and :cant2");
        $consulta->bindValue(':cant1', $q1, PDO::PARAM_INT);
        $consulta->bindValue(':cant2', $q2, PDO::PARAM_INT);
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}


    public static function TraerCantidadTotalEntreFechas($fecha1, $fecha2)
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select sum(cantidad) from venta WHERE fecha_venta BETWEEN :fecha1 and :fecha2");
        $consulta->bindValue(':fecha1', $fecha1, PDO::PARAM_STR);
        $consulta->bindValue(':fecha2', $fecha2, PDO::PARAM_STR);
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_OBJ);		
	}


    public static function TraerVentasConNombreProductoConLimite($cantidadLimite)
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select v.fecha_venta, v.id as id_venta, p.nombre as nombre_producto FROM venta v INNER JOIN producto p  
        WHERE v.id_producto = p.id 
        ORDER BY v.fecha_venta 
        LIMIT :cantidad ");
        $consulta->bindValue(':cantidad', $cantidadLimite, PDO::PARAM_INT);
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_OBJ);		
	}


    public static function TraerVentasConNombresProductoUsuarios()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select v.fecha_venta, v.id as id_venta, p.nombre as nombre_producto, u.nombre as nombre_usuario FROM venta v INNER JOIN producto p INNER JOIN usuario u 
        WHERE v.id_producto = p.id AND v.id_usuario = u.id 
        ORDER BY v.fecha_venta ");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_OBJ);		
	}

    public static function TraerVentasConMonto()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select v.fecha_venta, v.id as id_venta, v.cantidad, p.precio as precio_unitario, round(v.cantidad * p.precio,2) as monto_venta FROM venta v INNER JOIN producto p 
        WHERE v.id_producto = p.id 
        ORDER BY v.fecha_venta ");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_OBJ);		
	}
}