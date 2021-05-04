<?php

include "consultasVentas.php";

if(isset($_GET["txtSabor"], $_GET["txtPrecio"],$_GET["txtTipo"],$_GET["txtCantidad"]))
{

    include "pizzaCarga.php";
    PizzaCarga :: CargarPizza($_GET["txtSabor"], $_GET["txtPrecio"],$_GET["txtTipo"],$_GET["txtCantidad"]);

}else if(isset($_POST["txtSabor"],$_POST["txtTipo"], $_POST["txtMail"], $_POST["txtCantidad"], $_FILES["imagen"]))
{
    include "altaVenta.php";
    AltaVenta::VenderPizza($_POST["txtSabor"],$_POST["txtTipo"], $_POST["txtMail"], $_POST["txtCantidad"], $_FILES["imagen"]);

}else if(isset($_POST["txtSabor"],$_POST["txtTipo"]))
{
    include "pizzaConsultar.php";
    PizzaConsultar ::ConsultarPizza($_POST["txtSabor"],$_POST["txtTipo"]);


}else
{
    echo "\nError, dato no ingresado correctamente\n";
}



?>  