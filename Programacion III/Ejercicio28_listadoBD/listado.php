<?php


// Aplicación Nº 28 ( Listado BD)
// Archivo: listado.php
// método:GET
// Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
// cada objeto o clase tendrán los métodos para responder a la petición
// devolviendo un listado <ul> o tabla de html <table>

include "usuario.php";
include "venta.php";
include "producto.php";


$arrayListado = array();

if(isset($_GET["txtListado"]))
{
    $listado = $_GET["txtListado"];
    switch($listado)
    {
        case "usuarios":


            try
            {
            
                $arrayListado = Usuario::TraerTodosLosUsuarios();
                echo Usuario::MostrarListaHtml($arrayListado);
               
            } 
            catch(PDOException $ex)
            {
                echo "error ocurrido!"; 
                echo $ex->getMessage();
            }


            // var_dump( $usuarios);
            //    $usuarios = Usuario::LeerJSON("$listado");
           
        break;

        case "productos":
            try
            {
                $arrayListado = Producto::TraerTodosLosProductos();
                echo Producto::MostrarListaHtml($arrayListado);
               
            } 
            catch(PDOException $ex)
            {
                echo "error ocurrido!"; 
                echo $ex->getMessage();
            }
        break;
        
        case "ventas":
            try
            {
            
                $arrayListado = Venta::TraerTodasLasVentas();
                echo Venta::MostrarListaHtml($arrayListado);
               
            } 
            catch(PDOException $ex)
            {
                echo "error ocurrido!"; 
                echo $ex->getMessage();
            }
        break;
            
        default:
            echo "\n--Ingrese un listado válido--\n";


    }
    

}else{
    echo "\nError, dato no ingresado correctamente\n";
}




?>