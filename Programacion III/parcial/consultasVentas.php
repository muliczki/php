<?php


include_once "accesoDatos.php";

class ConsultasVentas{

public static function ObtenerPizzasVendidas()
    {
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT SUM(cantidad) AS Total_Vendido FROM ventas");

        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
        
    }



    public static function MostrarVentasPorFecha($fechaInicio, $fechaFin)
    {
        if (isset($fechaInicio) && isset($fechaFin) && is_string($fechaInicio) && is_string($fechaFin)) {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
            $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM ventas BETWEEN :fechaInicio AND :fechaFin ORDER BY sabor");
            $consulta->bindValue(':fechaInicio', date($fechaInicio), PDO::PARAM_STR);
            $consulta->bindValue(':fechaFin', date($fechaFin), PDO::PARAM_STR);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }

    }

    //llegue hasta aca
}

?>