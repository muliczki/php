<?php
// Aplicación No 25 ( AltaProducto)
// Archivo: altaProducto.php
// método:POST
// Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
// ,
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
// crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
// si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un
// nuevo renglón
// Retorna un :
// “Ingresado” si es un producto nuevo
// “Actualizado” si ya existía y se actualiza el stock.
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesarios en la clase

include "producto.php";

$productos = array();

if(isset($_POST["txtCodigo"],$_POST["txtNombre"],$_POST["txtTipo"], $_POST["txtStock"], $_POST["txtPrecio"]))
{

    $productos = Producto::LeerJSON("productos.json");
    
    $prodAux = new Producto($_POST["txtNombre"], $_POST["txtCodigo"], $_POST["txtTipo"], $_POST["txtStock"],$_POST["txtPrecio"]);
    
    if( $prodAux->BuscarProducto($productos)) //veo si ya existe el producto 
    {
        echo $prodAux->ActualizarStock($productos);

    }else{

        $prodAux->SetId();
        array_push($productos, $prodAux);
        echo "Producto ingresado :D\n";
    }


    if( Producto::GuardarJson($productos) != FALSE)
    {
        echo "\n--Guardado correctamente--\n";
    }else{
        echo "\n--Error al guardar--\n";
    }


}else{
    echo "\nError, dato no ingresado correctamente\n";
}


?>