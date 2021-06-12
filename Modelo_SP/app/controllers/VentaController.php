<?php
require_once './models/Venta.php';
require_once './models/Hortaliza.php';
require_once './models/Usuario.php';
require_once './interfaces/IApiUsable.php';

use \App\Models\Venta as Venta;
use \App\Models\Hortaliza as Hortaliza;
use \App\Models\Usuario as Usuario;

//sacar la herencia del modelo!
class VentaController implements IApiUsable
{
  public function CargarUno($request, $response, $args)
  {

    $parametros = $request->getParsedBody();

    $nombreHortaliza = $parametros['nombreHortaliza'];
    $email = $parametros['emailEmpleado'];
    $cantidad = $parametros['cantidad'];
    $nombreCliente = $parametros['cliente'];

    $idEmpleado = Usuario::where('mail','=',$email)->first()['id'];
    $idHortaliza = Hortaliza::where('nombre','=',$nombreHortaliza)->first()['id'];

    $uploadedFile = $request->getUploadedFiles()['foto'];

    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
      //ok foto
      $filename = $idHortaliza.'_'.$nombreCliente.'.jpg';
      $rutaFoto = "../app/files/FotosVentas/".$filename;
      $uploadedFile->moveTo($rutaFoto);

      // $response->getBody()->write('Uploaded: ' . $rutaFoto);
    }else{
      //no subio foto o error
      $rutaFoto = "";
    }
    
    // Creamos la Venta
    $venta = new Venta();
    $venta->id_hortaliza = $idHortaliza;
    $venta->id_empleado = $idEmpleado;
    $venta->cantidad = $cantidad;
    $venta->cliente = $nombreCliente;
    $venta->foto = $rutaFoto;
    $venta->fecha_venta =  date ("Y-m-d H:i:s");

    $venta->save();

    $payload = json_encode(array("mensaje" => "Venta creada con exito"));

    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
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


  
  public function TraerVentasEmpleado($request, $response, $args)
  {
    $lista='';

    if(isset($request->getQueryParams()['emailEmpleado'])){
      //traigo por email de empleado si esta seteado el parametro EMAIL
      $email = $request->getQueryParams()['emailEmpleado'];
      $empleado = Usuario::where('mail','=',$email)->first();
      if(!is_null($empleado))
      {
        $lista = Venta::where('id_empleado','=', $empleado['id'])->get();
      }
    }else{ 
      // traigo todas 
      $lista = Venta::all();
      
    }

    $payload = json_encode(array("listaVentas" => $lista));
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function TraerHortalizaMasVendida($request, $response, $args)
  {
    $lista='';

    $lista = Venta::
    select("id_hortaliza")->
    groupBy('id_hortaliza')->
    get();

    //ve esto
    // $lista = Venta::where('id_empleado','=', $empleado['id'])->get();

    $payload = json_encode(array("listaVentas" => $lista));
    $response->getBody()->write($payload);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }


}
