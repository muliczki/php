<?php

// Aplicación Nº 27 (Registro BD) 
// Archivo: registro.php
// método:POST
// Recibe los datos del usuario(nombre, clave,mail )por POST , 
// crear un objeto y utilizar sus métodos para poder hacer el alta,
// guardando los datos  la base de datos 
// retorna si se pudo agregar o no. 

include "usuario.php";



if(isset($_POST["txtNombre"],$_POST["txtClave"],$_POST["txtMail"], $_POST["txtApellido"], $_POST["txtLocalidad"]))
{

    $user = Usuario::CrearUsuario($_POST["txtNombre"],$_POST["txtClave"],$_POST["txtMail"],$_POST["txtApellido"], $_POST["txtLocalidad"]);
    
    echo $user->InsertarUsuarioParametros();


}else{
    echo "\nError, dato no ingresado correctamente\n";
}


?>