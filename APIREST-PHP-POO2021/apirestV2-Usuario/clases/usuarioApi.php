<?php
require_once 'usuario.php';
require_once 'IApiUsable.php';

class usuarioApi extends usuario implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
    	$elUser=usuario::TraerUnUsuario($id);
     	$newResponse = $response->withJson($elUser, 200);  
    	return $newResponse;
    }

     public function TraerTodos($request, $response, $args) {
      	$todosLosUser= usuario::TraerTodoLosUsuarios();
     	$newResponse = $response->withJson($todosLosUser, 200);  
    	return $newResponse;
    }
      public function CargarUno($request, $response, $args) {
     	 $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $nombre= $ArrayDeParametros['nombre'];
        $mail= $ArrayDeParametros['mail'];
        $clave= $ArrayDeParametros['clave'];
        
        $miUser = new usuario();
        $miUser->_nombre=$nombre;
        $miUser->_mail=$mail;
        $miUser->_clave=$clave;
		$miUser->_fechaRegistro = date("y-m-d");
        $miUser->InsertarElUsuarioParametros();


			// $archivos = $request->getUploadedFiles();
			// $destino="./fotos/";
			// //var_dump($archivos);		
			// //var_dump($archivos['foto']);	

			// $nombreAnterior=$archivos['foto']->getClientFilename();
			// $extension= explode(".", $nombreAnterior)  ;
			// //var_dump($nombreAnterior);
			// $extension=array_reverse($extension);	

			// $archivos['foto']->moveTo($destino.$mail.".".$extension[0]);
        $response->getBody()->write("se guardo el usuario");

        return $response;
    }
      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id'];
     	$user= new usuario();
     	$user->_id=$id;
     	$cantidadDeBorrados=$user->BorrarUsuario();

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantidad=$cantidadDeBorrados;
	    if($cantidadDeBorrados>0)
	    	{
	    		 $objDelaRespuesta->resultado="algo borro!!!";
	    	}
	    	else
	    	{
	    		$objDelaRespuesta->resultado="no Borro nada!!!";
	    	}
	    $newResponse = $response->withJson($objDelaRespuesta, 200);  
      	return $newResponse;
    }
    
     public function ModificarUno($request, $response, $args) {
     	//$response->getBody()->write("<h1>Modificar  uno</h1>");
     	$ArrayDeParametros = $request->getParsedBody();
	    // var_dump($ArrayDeParametros);    	
	    $miUser = new usuario();
	    $miUser->_id=$ArrayDeParametros['id'];
	    $miUser->_nombre=$ArrayDeParametros['nombre'];
	    $miUser->_mail=$ArrayDeParametros['mail'];
	    $miUser->_clave=$ArrayDeParametros['clave'];

	   	$resultado =$miUser->ModificarUsuarioParametros();
	   	$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
    }


	public function LogIn($request, $response, $args){
		
		$ArrayDeParametros = $request->getParsedBody();
		$usuarios = Usuario::TraerTodoLosUsuarios();
		$miUser = new usuario();		
		$miUser->_mail=$ArrayDeParametros['mail'];
		$miUser->_clave=$ArrayDeParametros['clave'];
		
		$resultado = $miUser->LogInUsuario($usuarios);
		$objDelaRespuesta= new stdclass();
		// var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);

	}

}