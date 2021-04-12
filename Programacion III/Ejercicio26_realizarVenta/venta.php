<?php

class Venta{

    public int $_codigoBarra;
    public String $_descripcionProducto;
    public int $_idUsuario;
    public int $_cantidad;
    public float $_precioUnitario;
    public float $_totalBruto;
    public float $_ivaTotal;
    public float $_precioFinal;
    public int $_idVenta;

    public function __construct($codigoProducto, $idComprador, $cantidad, $precioUnitario, $descripcion)
    {
        $this->_codigoBarra = $codigoProducto;
        $this->_idUsuario = $idComprador;
        $this->_cantidad = $cantidad;
        $this->_precioUnitario = $precioUnitario;
        $this->_descripcionProducto = $descripcion;

        $this->_totalBruto = $precioUnitario*$cantidad;
        $this->_ivaTotal = $precioUnitario * 0.21 * $cantidad;

        $this->_precioFinal = $this->_totalBruto + $this->_ivaTotal;

    }



    public static function RealizarVenta($codigoProducto, $idComprador, $cantidad, $precioUnitario, $descripcion)
    {
        $venta = new Venta($codigoProducto, $idComprador, $cantidad, $precioUnitario, $descripcion);
        $venta -> SetId();
        return $venta;
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
        $file = 'ventas.json';
        return file_put_contents($file, $json_string);
        
    }


}

?>