<?php

// Aplicación Nº 20 (Registro CSV)
// Archivo: registro.php
// método:POST
// Recibe los datos del usuario(nombre, clave,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder hacer el alta,
// guardando los datos en usuarios.csv.
// retorna si se pudo agregar o no.
// Cada usuario se agrega en un renglón diferente al anterior.
// Hacer los métodos necesarios en la clase usuario

include "usuario.php";

$usuarios = array();

if(isset($_POST["txtNombre"],$_POST["txtClave"],$_POST["txtMail"]))
{
    for ($i=0; $i <3 ; $i++) { 
        $usuarios[$i]=new Usuario($_POST["txtNombre"], $_POST["txtClave"], $_POST["txtMail"]);
        if( $usuarios[$i]->GuardarCSV())
        {
            echo "\n--Usuario guardado correctamente--\n";
        }else{
            echo "\n--Error al guardar usuario--\n";
        }
    }


}else{
    echo "\nError, dato no ingresado correctamente\n";
}




?>