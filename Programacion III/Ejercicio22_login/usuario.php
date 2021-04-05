<?php

class Usuario{

    private String $_nombre;
    private String $_clave;
    private String $_mail;


    public function __construct(String $nombre, String $clave, String $mail)
    {
        if(is_string($nombre) && is_string($clave) && is_string($mail))
        {
            $this->_nombre = $nombre;
            $this->_clave = $clave;
            $this->_mail = $mail;
        }
    }


    public function MostrarUsuario()
    {
        $aux= "". 
        "Nombre: " . $this->_nombre .
        //"\nClave: " . $this->_clave .
        " / Email: " . $this->_mail;
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