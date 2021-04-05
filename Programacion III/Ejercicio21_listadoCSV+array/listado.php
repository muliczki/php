<?php


// Aplicación Nº 21 ( Listado CSV y array de usuarios)
// Archivo: listado.php
// método:GET
// Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
// usuarios).
// En el caso de usuarios carga los datos del archivo usuarios.csv.
// se deben cargar los datos en un array de usuarios.
// Retorna los datos que contiene ese array en una lista
// <ul>
// <li>Coffee</li>
// <li>Tea</li>
// <li>Milk</li>
// </ul>
// Hacer los métodos necesarios en la clase usuario

include "usuario.php";

$usuarios = array();

if(isset($_GET["txtListado"]))
{
    $listado = $_GET["txtListado"];
    switch($listado)
    {
        case "usuarios.csv":
           $usuarios = Usuario::LeerCSV($listado);
           
            echo Usuario::MostrarListaHtml($usuarios);
           
        break;

        case "productos.csv":
            echo "\n--Listado PRODUCTOS no cargado aún--\n";
        break;
        
        case "vehiculos.csv":
            echo "\n--Listado VEHICULOS no cargado aún--\n";
            break;
            
        default:
            echo "\n--Ingrese un listado válido--\n";


    }
    

}else{
    echo "\nError, dato no ingresado correctamente\n";
}




?>