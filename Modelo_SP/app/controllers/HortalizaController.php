<?php
require_once './models/Hortaliza.php';
require_once './interfaces/IApiUsable.php';
use Psr\Http\Message\UploadedFileInterface;

use \App\Models\Hortaliza as Hortaliza;

//sacar la herencia del modelo!
class HortalizaController implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {
    $parametros = $request->getParsedBody();

    $nombre = $parametros['peticion']['nombre'];
    $precio = $parametros['peticion']['precio'];
    $tipo = $parametros['peticion']['tipo'];

    $uploadedFile = $request->getUploadedFiles()['foto'];

    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
      //ok foto
      $filename = $nombre.'.jpg';

      
      // $host= "localhost/";
      $rutaFoto = "../app/files/FotosProductos/".$filename;
      $uploadedFile->moveTo($rutaFoto);
      // $filename = $nombre.'.jpg';

      // $rutaFoto = "../app/files/".$filename;
      // $uploadedFile->moveTo($rutaFoto);

      // $response->getBody()->write('Uploaded: ' . $rutaFoto);
    }else{
      //no subio foto o error
      $rutaFoto = "";
    }
    
    // Creamos la Hortaliza
    $hortaliza = new Hortaliza();
    $hortaliza->nombre = $nombre;
    $hortaliza->precio = $precio;
    $hortaliza->foto = $rutaFoto;
    $hortaliza->tipo = $tipo;

    $hortaliza->save();

    $payload = json_encode(array("mensaje" => "Hortaliza " .$nombre." cargada con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerUno($request, $response, $args)
  {
    // Buscamos hortalizas por id
    $id = $args['id'];

    // Buscamos por primary key
    $hortaliza = Hortaliza::find($id);

    // Buscamos por attr email
    // $persona = Persona::where('email', $email)->first();

    $payload = json_encode($hortaliza);
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerTodos($request, $response, $args)
  {
    if(isset($request->getQueryParams()['tipo'])){
      //traigo por tipo si esta seteado el parametro TIPO
      $tipo = $request->getQueryParams()['tipo'];
      $lista = Hortaliza::where('tipo','=', $tipo)->get();
    }else{ 
      // traigo todas
      $lista = Hortaliza::all();
    }
    
    $payload = json_encode(array("listaHortalizas" => $lista));
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function ModificarUno($request, $response, $args)
  {

  }

  public function BorrarUno($request, $response, $args)
  {
    $id = $args['id'];
    // Buscamos la hortaliza
    $item = Hortaliza::find($id);
    
    // Borramos si existe
    if(!is_null($item)){
      $item->delete();
      $mensaje = "Item borrado con exito";
    }else{
      $mensaje = "El ID no existe";
    }

    $payload = json_encode(array("mensaje" => $mensaje));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }


}
