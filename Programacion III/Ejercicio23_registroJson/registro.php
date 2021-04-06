<?php

// Aplicación Nº 23 (Registro JSON)
// Archivo: registro.php
// método:POST
// Recibe los datos del usuario(nombre, clave,mail )por POST ,
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
// crear un dato con la fecha de registro , toma todos los datos y utilizar sus métodos para
// poder hacer el alta,
// guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
// Usuario/Fotos/.
// retorna si se pudo agregar o no.
// Cada usuario se agrega en un renglón diferente al anterior.
// Hacer los métodos necesarios en la clase usuario

include "usuario.php";

$usuarios = array();

if(isset($_POST["txtNombre"],$_POST["txtClave"],$_POST["txtMail"], $_FILES["image"]))
{
    for ($i=0; $i <3 ; $i++) { 
        
        $userAux = new Usuario($_POST["txtNombre"], $_POST["txtClave"], $_POST["txtMail"]);
        
        //OK PARA UNA FOTO DE UN USUARIO
        // $nombreFoto = $userAux->Get_id().".jpg";
        // //$_FILES["image"]["name"] = $nombreFoto;
        // $destino = "Usuario/Fotos/".$nombreFoto;
        // move_uploaded_file($_FILES["image"]["tmp_name"],$destino);
        
        
        // YO VOY A USAR LA MISMA FOTO PARA LOS 3 USUARIOS, SE QUE EN LA REALIDAD NO TIENE SENTIDO
        $nombreFoto = "user".$userAux->Get_id().".jpg";
        //$_FILES["image"]["name"] = $nombreFoto;
        $destino = "Usuario\Fotos\\".$nombreFoto;
        move_uploaded_file($_FILES["image"]["tmp_name"],$destino);
        echo $_FILES["image"]["tmp_name"], "\n";
        
        $userAux->SetFoto($destino);
        array_push($usuarios, $userAux);
    }

    // foreach ($usuarios as $user) {
    //     echo $user->MostrarUsuario();
    // }


    
    if( Usuario::GuardarJson($usuarios) != FALSE)
        {
            echo "\n--Usuario guardado correctamente--\n";
        }else{
            echo "\n--Error al guardar usuario--\n";
        }

}else{
    echo "\nError, dato no ingresado correctamente\n";
}


?>