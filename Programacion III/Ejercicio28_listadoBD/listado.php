<?php


// Aplicación Nº 28 ( Listado BD)
// Archivo: listado.php
// método:GET
// Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
// cada objeto o clase tendrán los métodos para responder a la petición
// devolviendo un listado <ul> o tabla de html <table>

include "usuario.php";
include "venta.php";


$usuarios = array();

if(isset($_GET["txtListado"]))
{
    $listado = $_GET["txtListado"];
    switch($listado)
    {
        case "usuarios":


            try
            {
            
                $usuarios = Usuario::TraerTodosLosUsuarios();
                echo Usuario::MostrarListaHtml($usuarios);
               
            } 
            catch(PDOException $ex)
            {
                echo "error ocurrido!"; 
                echo $ex->getMessage();
            }


            // var_dump( $usuarios);
            //    $usuarios = Usuario::LeerJSON("$listado");
            
            
           
        break;

        case "productos.json":
            echo "\n--Listado PRODUCTOS no cargado aún--\n";
        break;
        
        case "vehiculos.json":
            echo "\n--Listado VEHICULOS no cargado aún--\n";
            break;
            
        default:
            echo "\n--Ingrese un listado válido--\n";


    }
    

}else{
    echo "\nError, dato no ingresado correctamente\n";
}




?>