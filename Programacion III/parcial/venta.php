<?php

include_once "accesoDatos.php";
class Venta{

    public $_id;
    public $_fecha;
    public $_numeroPedido;
    public $_mail;
    public $_tipoPizza;
    public $_saborPizza;
    public $_cantidad;
    public $_imagen;
 


    public function __construct()
    {
        
    }

    public static function RealizarVenta($mail, $tipo, $sabor, $cantidad)
    {
        $venta = new Venta();
        $venta->_mail = $mail;
        $venta->_tipoPizza = $tipo;
        $venta->_saborPizza = $sabor;
        $venta->_cantidad = $cantidad;

        $venta->_numeroPedido = random_int(300000,999999);
        $venta->_fecha = date("y-m-d"); 


        return $venta;
    }
    

    public function InsertarVentaParametros()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into ventas (tipo, sabor, cantidad, mail, fecha, nro_pedido) values(:tipo, :sabor, :cantidad, :mail, :fecha, :nro_pedido)");

        $consulta->bindValue(':tipo',$this->_tipoPizza, PDO::PARAM_STR);
        $consulta->bindValue(':sabor',$this->_saborPizza, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad', $this->_cantidad, PDO::PARAM_INT);
        $consulta->bindValue(':mail', $this->_mail, PDO::PARAM_INT);
        $consulta->bindValue(':fecha', $this->_fecha, PDO::PARAM_STR);
        $consulta->bindValue(':nro_pedido', $this->_numeroPedido, PDO::PARAM_INT);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

    public function GuardarFoto ($imagen)
    {
        $nombreFoto = $this->_tipoPizza. "+". $this->_saborPizza. "+". $this->_mail.".jpg";
        //$_FILES["image"]["name"] = $nombreFoto;
        $destino = "./ImagenesDeLaVenta/".$nombreFoto;
        move_uploaded_file($imagen["tmp_name"],$destino);
        
        $this->_imagen =$destino;
    }


}
?>