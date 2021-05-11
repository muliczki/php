<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../vendor/autoload.php';
require_once './clases/AccesoDatos.php';
require_once './clases/usuarioApi.php';


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener infor mación sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);


/* FUNCION MIDDELWARE*/
// VERIFICADOR CREDENCIALES
$VerificadorDeCredenciales = function ($request, $response, $args) {

  if($request->isGet())
  {
     $response->getBody()->write('<p>NO necesita credenciales para los get</p>');
     $response = $args($request, $response);
  }
  else
  {
    $response->getBody()->write('<p>verifico credenciales</p>');
    $ArrayDeParametros = $request->getParsedBody();
    $nombre=$ArrayDeParametros['nombre'];
    $tipo=$ArrayDeParametros['tipo'];
    if($tipo=="administrador")
    {
      $response->getBody()->write("<h3>Bienvenido $nombre </h3>");
      $response = $args($request, $response);
    }
    else
    {
      $response->getBody()->write('<h2>no tenes habilitado el ingreso</h2>');
      
      //var_dump($ArrayDeParametros)
      // array(1) { ["nombre"]=> string(7) "Micaela" }
    }  
  }  
  $response->getBody()->write('<p>vuelvo del verificador de credenciales</p>');
  return $response;  
};

// VERIFICADOR JSON
$VerificadorDeObjetoJson = function ($request, $response, $args) {

  if($request->isGet())
  {
     $response->getBody()->write('<p>NO necesita credenciales para los get</p>');
     $response = $args($request, $response);
  }
  else
  {
    $response->getBody()->write('<p>verifico credenciales</p>');
    $ArrayDeParametros = $request->getParsedBody();

    $arrayTexto = json_decode($ArrayDeParametros["obj_json"], TRUE);

    $nombre=$arrayTexto['nombre'];
    $tipo=$arrayTexto['tipo'];

    if($tipo=="administrador")
    {
      $response = $args($request, $response);
    }
    else
    {
      $objDelaRespuesta= new stdclass();  
      $objDelaRespuesta->error= $nombre;
      $newResponse = $response->withJson($objDelaRespuesta, 403);
      return $newResponse;
      //var_dump($ArrayDeParametros)
      // array(1) { ["obj_json"]=> string(44) "{"nombre":"Micaela", "tipo":"administrador"}" }
    }  
  }  
  return $response;  
};


$VerificadorDeObjetoJsonBD = function ($request, $response, $args) {

  if($request->isGet())
  {
     $response = $args($request, $response);
  }
  else
  {
    $response->getBody()->write('<p>verifico credenciales</p>');
    $ArrayDeParametros = $request->getParsedBody();

    $arrayTexto = json_decode($ArrayDeParametros["obj_json"], TRUE);

    $nombre=$arrayTexto['mail'];  
    $tipo=$arrayTexto['clave'];

    $usuario = new usuarioApi();
    // if($usuario-> TraerTodos() )
    {
      $response = $args($request, $response);
    }
    // else
    {
      $objDelaRespuesta= new stdclass();  
      $objDelaRespuesta->error= $nombre;
      $newResponse = $response->withJson($objDelaRespuesta, 403);
      return $newResponse;
      //var_dump($ArrayDeParametros)
      // array(1) { ["obj_json"]=> string(44) "{"nombre":"Micaela", "tipo":"administrador"}" }
    }  
  }  
  return $response;  
};

/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/usuario', function () {
 
  $this->get('/', \usuarioApi::class . ':traerTodos');
 
  $this->get('/{id}', \usuarioApi::class . ':traerUno');

  $this->post('/', \usuarioApi::class . ':CargarUno');

  $this->delete('/', \usuarioApi::class . ':BorrarUno');

  $this->put('/', \usuarioApi::class . ':ModificarUno');

  $this->post('/login', \usuarioApi::class . ':LogIn');
     
});


//GRUPO CREDENCIALES
$app->group('/credenciales', function () {
 
  $this->get('/', function (Request $request, Response $response) {    
    $response->getBody()->write("API => GET");
    return $response;
  });

  $this->post('/', function (Request $request, Response $response) {    
    $response->getBody()->write("API => POST");
    return $response;
  });
     
})->add($VerificadorDeCredenciales);



//GRUPO JSON
$app->group('/json', function () {
 
  $this->get('/', function ($request, $response, $args) {    
    $objDelaRespuesta= new stdclass();
    
    $objDelaRespuesta->mensaje="API => GET";
    $newResponse = $response->withJson($objDelaRespuesta, 200);  
    return $newResponse;
  });

  $this->post('/', function ($request, $response, $args) {    
    $objDelaRespuesta= new stdclass();
    $objDelaRespuesta->mensaje="API => POST";

    $newResponse = $response->withJson($objDelaRespuesta, 200);  
    return $newResponse;
  });
     
})->add($VerificadorDeObjetoJson);



//GRUPO JSON_BD
$app->group('/json_bd', function () {
 
  $this->get('/',\usuarioApi::class . ':traerTodos');

  $this->post('/',\usuarioApi::class . ':traerTodos');
     
})->add($VerificadorDeObjetoJsonBD);



$app->run();