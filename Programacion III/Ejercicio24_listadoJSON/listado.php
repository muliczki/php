<?php


// Aplicación No 24 ( Listado JSON y array de usuarios)
// Archivo: listado.php
// método:GET
// Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
// usuarios).
// En el caso de usuarios carga los datos del archivo usuarios.json.
// se deben cargar los datos en un array de usuarios.
// Retorna los datos que contiene ese array en una lista
// <ul>
// <li>apellido, nombre,foto</li>
// <li>apellido, nombre,foto</li>
// </ul>
// Hacer los métodos necesarios en la clase usuario

include "usuario.php";

$usuarios = array();

if(isset($_GET["txtListado"]))
{
    $listado = $_GET["txtListado"];
    switch($listado)
    {
        case "usuarios.json":
           $usuarios = Usuario::LeerJSON($listado);
           
            echo Usuario::MostrarListaHtml($usuarios);
           
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