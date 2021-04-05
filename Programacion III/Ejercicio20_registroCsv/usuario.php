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
        $aux= "USUARIO". 
        "\nNombre: " . $this->_nombre .
        //"\nClave: " . $this->_clave .
        "\nEmail: $ " . $this->_mail . "\n\n";

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

}


?>