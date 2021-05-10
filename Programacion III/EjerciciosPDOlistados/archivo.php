<?php


// Obtener los detalles completos de todos los usuarios y poder ordenarlos
// alfabéticamente de forma ascendente o descendente.
// a :{ archivo :usuarios.php, renglón :308}
if(isset($_GET["txtOrdenUser"]))
{
    include "usuario.php";
    $usuarios = Usuario::TraerTodosLosUsuariosOrdenados($_GET["txtOrdenUser"]);
    echo Usuario::MostrarListaHtml($usuarios);

}
// B. Obtener los detalles completos de todos los productos y poder ordenarlos
// alfabéticamente de forma ascendente y descendente.
// b :{ archivo :producto.php, renglón :260}
elseif(isset($_GET["txtOrdenProducto"]))
{
    include "producto.php";
    $productos = Producto :: TraerTodosLosProductosOrdenados($_GET["txtOrdenProducto"]);
    echo Producto::MostrarListaHtml($productos);
}

// C. Obtener todas las compras filtradas entre dos cantidades.
// c :{ archivo :venta.php, renglón :81}
elseif(isset($_GET["txtCantUno"],$_GET["txtCantDos"] ))
{
    include "venta.php";
    $ventas = Venta :: TraerVentasEntreCantidades($_GET["txtCantUno"],$_GET["txtCantDos"]);
    echo Venta::MostrarListaHtml($ventas);
}

// D. Obtener la cantidad total de todos los productos vendidos entre dos fechas.
// d :{ archivo :venta.php, renglón :92}
elseif(isset($_GET["txtFechaUno"],$_GET["txtFechaDos"] ))
{
    include "venta.php";
    $ventas = Venta :: TraerCantidadTotalEntreFechas($_GET["txtFechaUno"],$_GET["txtFechaDos"] );
    
    // var_dump($ventas);
    // DEVUELVO UN OBJETO CON KEYS = COLUMNAS DE LA CONSULTA

    for ($i=0; $i < count($ventas); $i++) { 

        foreach ($ventas[$i] as $key => $value) {
            echo $key . ": " . $value;
        }
    }

}

// E. Mostrar los primeros “N” números de productos que se han enviado.
// e :{ archivo :venta.php, renglón :103}
elseif(isset($_GET["txtCantidadProductos"]))
{
    include "venta.php";

    $ventas = Venta :: TraerVentasConNombreProductoConLimite($_GET["txtCantidadProductos"] );

    for ($i=0; $i < count($ventas); $i++) { 

        foreach ($ventas[$i] as $key => $value) {
            echo $key . ": " . $value . " - ";
        }
        echo "\n";
    }
    

}
// F. Mostrar los nombres del usuario y los nombres de los productos de cada venta.
// f :{ archivo :venta.php, renglón :116}
elseif(isset($_GET["txtVentasConProductoUsuario"]))
{
    include "venta.php";

    $ventas = Venta :: TraerVentasConNombresProductoUsuarios();

    for ($i=0; $i < count($ventas); $i++) { 

        foreach ($ventas[$i] as $key => $value) {
            echo $key . ": " . $value . " - ";
        }
        echo "\n";
    }
    

}
// G. Indicar el monto (cantidad * precio) por cada una de las ventas.
// g :{ archivo :venta.php, renglón :126}
elseif(isset($_GET["txtVentasMontoTotal"]))
{
    include "venta.php";

    $ventas = Venta :: TraerVentasConMonto();

    for ($i=0; $i < count($ventas); $i++) { 

        foreach ($ventas[$i] as $key => $value) {
            echo $key . ": " . $value . " - ";
        }
        echo "\n";
    }

}

// H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario (ejemplo: 104).
// h :{ archivo :venta.php, renglón :137}
elseif(isset($_GET["txtIdProducto"], $_GET["txtIdUsuario"]))
{
    include "venta.php";

    $ventas = Venta :: TraerTotalProductoVendidoPorUsuario($_GET["txtIdProducto"], $_GET["txtIdUsuario"]);

    for ($i=0; $i < count($ventas); $i++) { 

        foreach ($ventas[$i] as $key => $value) {
            echo $key . ": " . $value . " - ";
        }
        echo "\n";
    }

}
// I. Obtener todos los números de los productos vendidos por algún usuario filtrado por localidad (ejemplo: ‘Avellaneda’).
// i :{ archivo :venta.php, renglón :151}
elseif(isset($_GET["txtLocalidad"]))
{
    include "venta.php";

    $ventas = Venta :: TraerProductoVendidoPorLocalidad($_GET["txtLocalidad"]);

    for ($i=0; $i < count($ventas); $i++) { 

        foreach ($ventas[$i] as $key => $value) {
            echo $key . ": " . $value . " - ";
        }
        echo "\n";
    }

}
// J. Obtener los datos completos de los usuarios filtrando por letras en su nombre o apellido.
// j :{ archivo :usuario.php, renglón :337}
if(isset($_GET["txtFiltroNombre"], $_GET["txtFiltroApellido"]))
{
    include "usuario.php";
    $usuarios = Usuario::TraerUsuariosFiltroNombreApellido($_GET["txtFiltroNombre"], $_GET["txtFiltroApellido"]);
    echo Usuario::MostrarListaHtml($usuarios);

}

// K. Mostrar las ventas entre dos fechas del año.
// k :{ archivo :venta.php, renglón :163}
elseif(isset($_GET["txtFechaUnoVentas"],$_GET["txtFechaDosVentas"] ))
{
    include "venta.php";
    $ventas = Venta :: TraerVentasEntreFechas($_GET["txtFechaUnoVentas"],$_GET["txtFechaDosVentas"]);
    echo Venta::MostrarListaHtml($ventas);
}
else{
    echo "\nError, dato no ingresado correctamente\n";
}





?>