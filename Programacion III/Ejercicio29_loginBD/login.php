<?php


// Aplicación No 29( Login con bd)
// Archivo: Login.php
// método:POST
// Recibe los datos del usuario(clave,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la
// base de datos,
// Retorna un :
// “Verificado” si el usuario existe y coincide la clave también.
// “Error en los datos” si esta mal la clave.
// “Usuario no registrado si no coincide el mail“
// Hacer los métodos necesarios en la clase usuario.

include "usuario.php";

$usuariosRegitrados = array();

if(isset($_POST["txtClave"],$_POST["txtMail"]))
{
    $usuariosRegitrados = Usuario::TraerTodosLosUsuarios();

    $usuarioPost = Usuario::TransformarAUsuario($_POST["txtClave"], $_POST["txtMail"]);

    echo $usuarioPost->LogInUsuario($usuariosRegitrados);

}else{
    echo "\nError, dato no ingresado correctamente\n";
}


?>