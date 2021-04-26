<?php

// Aplicación Nº 32(Modificacion BD)
// Archivo: ModificacionUsuario.php
// método:POST
// Recibe los datos del usuario(nombre, clavenueva, clavevieja,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder hacer la modificación,
// guardando los datos la base de datos
// retorna si se pudo agregar o no.
// Solo pueden cambiar la clave

include "usuario.php";

if(isset($_POST["txtNombre"],$_POST["txtClaveNueva"], $_POST["txtClaveVieja"], $_POST["txtMail"]))
{

    $usuarios = Usuario::TraerTodosLosUsuarios();

    $usuarioPost = Usuario::TransformarAUsuario($_POST["txtClaveVieja"], $_POST["txtMail"]);

    $aux= $usuarioPost->LogInUsuario($usuarios);

    if( is_string($aux)) //si es string algun error
    {
        echo $aux;
    }else   // user loggeado, cambio clave!
    {
        $usuarioPost->ModificarProductoParametros($_POST["txtClaveNueva"]);
        echo "CLAVE ACTUALIZADA";
    }


}else{
    echo "\nError, dato no ingresado correctamente\n";
}



?>