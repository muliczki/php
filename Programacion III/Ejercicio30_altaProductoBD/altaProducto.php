<?php

// Aplicación Nº 30 ( AltaProducto BD)
// Archivo: altaProducto.php
// método:POST
// Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
// , carga la fecha de creación y crear un objeto ,se debe utilizar sus métodos para poder
// verificar si es un producto existente,
// si ya existe el producto se le suma el stock , de lo contrario se agrega .
// Retorna un :
// “Ingresado” si es un producto nuevo
// “Actualizado” si ya existía y se actualiza el stock.
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesarios en la clase

include "producto.php";

$productos = array();

if(isset($_POST["txtCodigo"],$_POST["txtNombre"],$_POST["txtTipo"], $_POST["txtStock"], $_POST["txtPrecio"]))
{

    $productos = Producto::TraerTodosLosProductos();
    
    $prodAux = Producto:: CrearProducto($_POST["txtNombre"], $_POST["txtCodigo"], $_POST["txtTipo"], $_POST["txtStock"],$_POST["txtPrecio"]);
    
    if( $prodAux->BuscarProducto($productos)) //veo si ya existe el producto 
    {
        if($prodAux->ActualizarStock($productos))
        {
            $prodAux->ModificarProductoParametros();
            echo "STOCK ACTUALIZADO\n";
            
        }else{
        
            echo "No se puede actualizar\n";
        }

    }else{

        echo "PRODUCTO ID ", $prodAux->InsertarProductoParametros(), " INSERTADO EN BASE DE DATOS\n";

    }



}else{
    echo "\nError, dato no ingresado correctamente\n";
}


?>