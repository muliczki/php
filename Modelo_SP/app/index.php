<?php
error_reporting(-1);
ini_set('display_errors', 1);
date_default_timezone_set('America/Argentina/Buenos_Aires');

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;
use Illuminate\Database\Capsule\Manager as Capsule;

#region Require
require __DIR__ . '/../vendor/autoload.php';

require_once './controllers/HortalizaController.php';
require_once './controllers/UsuarioController.php';
require_once './controllers/VentaController.php';
require_once './middlewares/AccesosMD.php';
require_once './classes/Jwt.php';

#endregion


// base = 3qlr8BwHdi
// contra = Xvx3m0VxBQ
// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/*
.env
MYSQL_HOST=remotemysql.com
MYSQL_PORT=3306
MYSQL_USER=3qlr8BwHdi
MYSQL_PASS=Xvx3m0VxBQ
MYSQL_DB=3qlr8BwHdi

*/

// Instantiate App
$app = AppFactory::create();
// // Set base path
// $app->setBasePath('/app');
$app->setBasePath('/Modelo_SP/app');

// Add error middleware
$app->addErrorMiddleware(true, true, true);
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
#endregion

#region Eloquent
$container=$app->getContainer();

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['MYSQL_HOST'],
    'database'  => $_ENV['MYSQL_DB'],
    'username'  => $_ENV['MYSQL_USER'],
    'password'  => $_ENV['MYSQL_PASS'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

#endregion

#region Routes

$app->group('/hortalizas', function (RouteCollectorProxy $group) {
  $group->get('[/]', \HortalizaController::class . ':TraerTodos'); //para cualquier persona
  $group->get('/{id}', \HortalizaController::class . ':TraerUno')->add(\AccesosMD::class . ':VerificarPerfilVend')->add(\AccesosMD::class . ':VerificarUsuario');
  
  $group->post('[/]', \HortalizaController::class . ':CargarUno')->add(\AccesosMD::class . ':VerificarPerfilAdm')->add(\AccesosMD::class . ':VerificarUsuario');

  $group->delete('/{id}', \HortalizaController::class . ':BorrarUno')->add(\AccesosMD::class . ':VerificarPerfilAdm')->add(\AccesosMD::class . ':VerificarUsuario');
});

$app->group('/estadisticas', function (RouteCollectorProxy $group) {
  $group->get('/empleados[/]', \VentaController::class . ':TraerVentasEmpleado'); 
  $group->get('/hortalizas[/]', \VentaController::class . ':TraerHortalizaMasVendida'); 
});

$app->post('/login[/]', \UsuarioController::class . ':Login'); //para cualquier persona
// ->add(\MWLogger::class . ':usuarioLogger');
#endregion
$app->post('/venta[/]', \VentaController::class . ':CargarUno')->add(\AccesosMD::class . ':VerificarPerfilVend')->add(\AccesosMD::class . ':VerificarUsuario');


$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("Modelo SP - Uliczki Micaela");
    return $response;
});


$app->group('/jwt', function (RouteCollectorProxy $group) {
  $group->get('/devolverPayLoad[/]', \Jwt::class . ':DevolverPayload');
  $group->get('/devolverDatos[/]', \Jwt::class . ':DevolverDatos');
  $group->get('/verificarToken[/]', \Jwt::class . ':VerificarToken');

});






$app->run();
