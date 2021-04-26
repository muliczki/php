<?php

include_once "accesoDatos.php";

class Usuario{

    // private String $_nombre;
    // private String $_clave;
    // private String $_mail;
    // private int $_id;
    // private $_fechaRegistro;

    public $_nombre;
    public $_apellido;
    public $_clave;
    public $_mail;
    public $_fechaRegistro;
    public $_localidad;
    public $_id;

    // public function __construct($id=0, $nombre, $apellido, $clave, $mail, $fecha ="---" , $localidad)
    // {
    //     if(is_string($nombre) && is_string($clave) && is_string($mail))
    //     {
    //         $this->_nombre = $nombre;
    //         $this->_clave = $clave;
    //         $this->_mail = $mail;
    //         $this->_apellido = $apellido;
    //         $this->_localidad = $localidad;
    //         //$this->_id = self::GetIDoriginal();
    //         $this->_fechaRegistro = date("y-m-d");

            
    //     }
    // }


    public function __construct()
    {
        
    }


    public static function TransformarAUsuario($clave, $mail)
    {
        $user = new Usuario();
        $user->_clave = $clave;
        $user->_mail = $mail;

        return $user;

    }

    
    public function Get_id()
    {
        return $this->_id;
    }




    // public function SetFoto($rutaFoto)
    // {
    //     $this->_fotoRuta = $rutaFoto;
    // }
    



    // public static function GetIDoriginal()
    // {
    //     return random_int(1,10000);
    // }

    // public static function GetFechaActual()
    // {
    //     return date("d.m.y");
    // }

    public function MostrarUsuario()
    {
        $aux= "". 
        "ID: " . $this->_id .
        " - Nombre: " . $this->_nombre .
        " - Apellido: " . $this->_apellido .
        //"\nClave: " . $this->_clave .
        " - Email: " . $this->_mail .
        " - Localidad: " . $this->_localidad .
        //" / Foto: " . $this->_fotoRuta;
        " - Fecha: " . $this->_fechaRegistro;
        return $aux;

    }

    // public function GuardarCSV()
    // {
    //     $archivoPath = "usuarios.csv";
    //     $dato= $this->_nombre . ",". $this->_clave . ",". $this->_mail. "\n";

    //     //unlink($archivoPath);
        
    //     $archivo = fopen($archivoPath, 'a+');
    //     $fread = fread($archivo, 100);


    //     if($fread==FALSE || $fread=="")
    //     {
    //         $titulos="Nombre,Clave,Email\n";
    //         $fwrite = fwrite($archivo, $titulos);

    //     }

    //     $fwrite = fwrite($archivo, $dato);
    //     return fclose($archivo);
        
        
    // }


    // public static function GuardarJson($usuariosArray)
    // {
    //     $json_string = json_encode($usuariosArray);
    //     //var_dump($json_string);
    //     $file = 'usuarios.json';
    //     return file_put_contents($file, $json_string);
        
        
    // }

    // public static function LeerCSV(String $archivoPath)
    // {
    //     if(!is_null($archivoPath))
    //     {
    //         $usuarios = array();

    //         //unlink($archivoPath);
            
    //         $archivo = fopen($archivoPath, 'r');
    //         $flag = TRUE;
    //         while ( !feof($archivo))
    //         {
    //             if(!feof($archivo))
    //             {
    //                 if($flag) //PARA NO LEER EL TITULO
    //                 {
    //                     $linea = fgets($archivo);
    //                     $flag = FALSE;
    //                 }
    
    //                 $linea = fgets($archivo);
    //                 if(!empty($linea))
    //                 {
    //                     $linea = str_replace("\n","", $linea);
    //                     $aux = explode(',', $linea);

    //                     $nombre = $aux[0];
    //                     $clave = $aux[1];
    //                     $email = $aux[2];

    //                     if(!empty($nombre) && !empty($clave) && !empty($email))
    //                     {
    //                         $usuarios[] = new Usuario($nombre, $clave, $email);
    //                     }
    //                 }
    //             }
                
                
    //         }
    //         //var_dump($usuarios);
    //         return $usuarios;
    //     }
        
    // }

    // public static function LeerJSON(String $archivoPath)
    // {
    //     if(!is_null($archivoPath))
    //     {
    //         $usuarios = array();
    //         $data = file_get_contents($archivoPath);
            
    //         //echo $data,"\n";
            
    //         $arrayTexto = json_decode($data, TRUE);
            

            
    //         foreach ($arrayTexto as $array)
    //         {
                
    //             //var_dump($array);
    //             $user = self::TransformarAUsuario($array["_nombre"], $array["_clave"], $array["_mail"], $array["_id"], $array["_fechaRegistro"], $array["_fotoRuta"]);
                
    //             //echo $user->MostrarUsuario();
    //             // $user = self::TransformarAUsuario($array[$i]["_nombre"], $array[$i]["_clave"], $array[$i]["_mail"], $array[$i]["_id"], $array[$i]["_fechaRegistro"], $array[$i]["_fotoRuta"]);
                
    //             array_push($usuarios, $user);
    //         }

    //         //var_dump($usuarios);
    //         return $usuarios;
    //     }
        
    // }


    public static function MostrarListaHtml($usuarios)
    {
        $aux = "<ul>";

        foreach($usuarios as $user)
        {
            $aux .= "<li>".$user->MostrarUsuario()."</li>";
            //"<img src=".$user->_fotoRuta.">";
            
        }
        $aux .= "</ul>";


        return $aux;

    }


    public function LogInUsuario($usuarios)
    {
        $aux = "Usuario no registrado, el mail no existe";
        
        if(! is_null($usuarios))
        {
            foreach($usuarios as $user)
            {
                if($user->_mail == $this->_mail)
                {
                    if($user->_clave == $this->_clave)
                    {
                        $aux = TRUE;
                        break;
                    }else{
                        $aux = "Error en los datos, contraseña incorrecta";
                    }
                }
            }
        }
        

        return $aux;
    }


    // public function GuardarFoto ($imagen)
    // {
    //     $nombreFoto = "user". $this->Get_id().".jpg";
    //     //$_FILES["image"]["name"] = $nombreFoto;
    //     $destino = ".\Usuario\Fotos\\".$nombreFoto;
    //     move_uploaded_file($imagen["tmp_name"],$destino);
        
    //     $this->SetFoto($destino);
    // }

    public static function BuscarUsuario($array, $idValidar)
    {
        $retorno = FALSE;
        if(!is_null($array))
        {
            foreach($array as $aux)
            {
                if (is_a($aux, "Usuario") && $aux->Get_id() == $idValidar)
                {
                    $retorno= TRUE;
                    break;
                }
            }

        }
        return $retorno;
    }


    // public static function CrearUsuario($nombre, $clave, $mail, $apellido, $localidad)
    // {
    //     $user = new Usuario($nombre, $clave, $mail, $apellido, $localidad);
    //     // $user->_id = $id;
    //     // $user->_fechaRegistro = $fecha;
    //    // $user->_fotoRuta = $foto;

    //     return $user;

    // }

    public function InsertarUsuarioParametros()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail,fecha_de_registro,localidad) values(:nombre,:apellido,:clave,:mail,:fecha,:localidad)");
        $consulta->bindValue(':nombre',$this->_nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido',$this->_apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->_clave, PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->_mail, PDO::PARAM_STR);
        $consulta->bindValue(':fecha', $this->_fechaRegistro, PDO::PARAM_STR);
        $consulta->bindValue(':localidad', $this->_localidad, PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

    public static function TraerTodosLosUsuarios()
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select id as _id,nombre as _nombre,apellido as _apellido,mail as _mail,fecha_de_registro as _fechaRegistro,localidad as _localidad, clave as _clave from usuario");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}


    public function ModificarProductoParametros($claveNueva)
	{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            update usuario 
            set clave= :clave
            WHERE mail = :mail");
        $consulta->bindValue(':clave',$claveNueva, PDO::PARAM_STR);
        $consulta->bindValue(':mail',$this->_mail, PDO::PARAM_STR);
        return $consulta->execute();
	}
}


?>