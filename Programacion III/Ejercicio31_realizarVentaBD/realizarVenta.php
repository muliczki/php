<?php

// Aplicación Nº 31 (RealizarVenta BD )
// Archivo: RealizarVenta.php
// método:POST
// Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
// POST .
// Verificar que el usuario y el producto exista y tenga stock.
// Retorna un :
// “venta realizada”Se hizo una venta
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesarios en las clases


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


    $productos = Producto::TraerTodosLosProductos();
    $usuarios = Usuario::TraerTodosLosUsuarios();

    if(Usuario::BuscarUsuario($usuarios, $idUsuario))
    {
        if(Producto :: BuscarProducto($productos, $codigoProducto))
        {
            $aux = Producto :: ValidarStock($productos, $codigoProducto, $cantidadVenta, $idUsuario);
            if( is_string($aux)) //si es texto hubo algun error
            {
                echo $aux;
            }else{
                $aux->InsertarVentaParametros();
                echo "Venta realizada\n";
            }

        }else{

            echo "El producto no está registrado\n";
        }

    }else{
        echo "El usuario no está registrado\n";
    }



}else{
    echo "\nError, dato no ingresado correctamente\n";
}



?>