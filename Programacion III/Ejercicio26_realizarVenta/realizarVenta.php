<?php


include "usuario.php";
include "producto.php";
include_once "venta.php";

$productos = array();
$usuarios = array();
$ventas = array();


if(isset($_POST["txtCodigo"],$_POST["txtIdUsuario"], $_POST["txtCantidadComprar"]))
{
    $codigoProducto = (int) $_POST["txtCodigo"];
    $idUsuario = (int) $_POST["txtIdUsuario"];
    $cantidadVenta = (int) $_POST["txtCantidadComprar"];


    $productos = Producto::LeerJSON("productos.json");
    $usuarios = Usuario::LeerJSON("usuarios.json");

    if(Usuario::BuscarUsuario($usuarios, $idUsuario))
    {
        if(Producto :: BuscarProducto($productos, $codigoProducto))
        {
            $aux = Producto :: ValidarStock($productos, $codigoProducto, $cantidadVenta, $idUsuario);
            if( is_string($aux)) //si es texto hubo algun error
            {
                echo $aux;
            }else{
                array_push($ventas,$aux);
                echo "Venta realizada\n";
            }

        }else{

            echo "El producto no está registrado\n";
        }

    }else{
        echo "El usuario no está registrado\n";
    }

    //var_dump($ventas);
    if( Producto::GuardarJson($productos) && Usuario::GuardarJson($usuarios) && Venta ::GuardarJson($ventas))
    {
        echo "\n--Guardado correctamente--\n";
    }else{
        echo "\n--Error al guardar--\n";
    }


}else{
    echo "\nError, dato no ingresado correctamente\n";
}



?>