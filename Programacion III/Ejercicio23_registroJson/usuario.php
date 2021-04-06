<?php

class Usuario{

    // private String $_nombre;
    // private String $_clave;
    // private String $_mail;
    // private int $_id;
    // private $_fechaRegistro;

    public String $_nombre;
    public String $_clave;
    public String $_mail;
    public int $_id;
    public $_fechaRegistro;
    public $_fotoRuta;

    public function __construct(String $nombre ="nombre", String $clave="clave", String $mail="mail")
    {
        if(is_string($nombre) && is_string($clave) && is_string($mail))
        {
            $this->_nombre = $nombre;
            $this->_clave = $clave;
            $this->_mail = $mail;
            $this->_id = self::GetIDoriginal();
            $this->_fechaRegistro = self::GetFechaActual();


        }
    }


    // public function __get ($_nombre)
    // {
    //     return $this->_nombre;
    // }


    // public function Get_clave()
    // {
    //     return $this->_clave;
    // }

    // public function Get_mail()
    // {
    //     return $this->_mail;
    // }
    
    public function Get_id()
    {
        return $this->_id;
    }

    // public function Get_fechaRegistro()
    // {
    //     return $this->_fechaRegistro;
    // }


    public function SetFoto($rutaFoto)
    {
        $this->_fotoRuta = $rutaFoto;
    }
    



    public static function GetIDoriginal()
    {
        return random_int(1,10000);
    }

    public static function GetFechaActual()
    {
        return date("d.m.y");
    }

    public function MostrarUsuario()
    {
        $aux= "". 
        "Nombre: " . $this->_nombre .
        //"\nClave: " . $this->_clave .
        " / Email: " . $this->_mail .
        " / id: " . $this->_id .
        " / fecha: " . $this->_fechaRegistro ."\n";
        return $aux;

    }

    public function GuardarCSV()
    {
        $archivoPath = "usuarios.csv";
        $dato= $this->_nombre . ",". $this->_clave . ",". $this->_mail. "\n";

        //unlink($archivoPath);
        
        $archivo = fopen($archivoPath, 'a+');
        $fread = fread($archivo, 100);


        if($fread==FALSE || $fread=="")
        {
            $titulos="Nombre,Clave,Email\n";
            $fwrite = fwrite($archivo, $titulos);

        }

        $fwrite = fwrite($archivo, $dato);
        return fclose($archivo);
        
        
    }


    public static function GuardarJson($usuariosArray)
    {
        $json_string = json_encode($usuariosArray);
        var_dump($json_string);
        $file = 'usuarios.json';
        return file_put_contents($file, $json_string);
        
        
    }

    public static function LeerCSV(String $archivoPath)
    {
        if(!is_null($archivoPath))
        {
            $usuarios = array();

            //unlink($archivoPath);
            
            $archivo = fopen($archivoPath, 'r');
            $flag = TRUE;
            while ( !feof($archivo))
            {
                if(!feof($archivo))
                {
                    if($flag) //PARA NO LEER EL TITULO
                    {
                        $linea = fgets($archivo);
                        $flag = FALSE;
                    }
    
                    $linea = fgets($archivo);
                    if(!empty($linea))
                    {
                        $linea = str_replace("\n","", $linea);
                        $aux = explode(',', $linea);

                        $nombre = $aux[0];
                        $clave = $aux[1];
                        $email = $aux[2];

                        if(!empty($nombre) && !empty($clave) && !empty($email))
                        {
                            $usuarios[] = new Usuario($nombre, $clave, $email);
                        }
                    }
                }
                
                
            }
            //var_dump($usuarios);
            return $usuarios;
        }
        
    }


    public static function MostrarListaHtml($usuarios)
    {
        $aux = "<ul>";

        foreach($usuarios as $user)
        {
            $aux .= "<li>".$user->MostrarUsuario()."</li>";
        }
        $aux .= "</ul>";
        return $aux;
    }


    public function LogInUsuario($usuarios)
    {
        foreach($usuarios as $user)
        {
            if($user->_mail == $this->_mail)
            {
                if($user->_clave == $this->_clave)
                {
                    return "Verificado :D";
                }else{
                    return "Error en los datos, contraseña incorrecta";
                }
            }
        }

        return "Usuario no registrado, el mail no existe";
    }

}


?>