<?php

include "usuario.php";

// punto 1
$usuarios = Usuario::TraerTodosLosUsuariosOrdenados("de");
echo Usuario::MostrarListaHtml($usuarios);

?>