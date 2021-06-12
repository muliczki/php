<?php
require_once './models/Usuario.php';
require_once './interfaces/IApiUsable.php';
require_once './classes/Jwt.php';
require_once './middlewares/AutentificadorJWT.php';

use \App\Models\Usuario as Usuario;

//sacar la herencia del modelo!
class UsuarioController implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {

  }

  public function TraerUno($request, $response, $args)
  {
   
  }

  public function TraerTodos($request, $response, $args)
  {
   
  }

  public function ModificarUno($request, $response, $args)
  {

  }

  public function BorrarUno($request, $response, $args)
  {
  
  }

  public function Login($request, $response, $args)
  {
    $mensaje = "Login error! Datos incorrectos. Reintentar!";

    $parametros = $request->getParsedBody();

    $email = $parametros['email'];
    $clave = $parametros['clave'];
    $sexo = $parametros['sexo'];

    $user = Usuario::where('mail','=',$email)->where('clave','=',$clave)->where('sexo','=',$sexo)->first();
    // var_dump($persona);

    if(!is_null($user))
    {
      $perfil = $user['perfil'];
      $mensaje = 'OK';
      $token = Jwt::CrearToken($email, $perfil);
      // $payload = json_encode(array("mensaje" => $mensaje, "perfil" => $perfil));
      $payload = json_encode(array("mensaje" => $mensaje, "jwt" => $token));
      
    }else{
      $payload = json_encode(array("mensaje" => $mensaje));
    }

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }


}
