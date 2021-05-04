<?php
class usuario
{
	public $_nombre;
    public $_clave;
    public $_mail;
    public $_fechaRegistro;
    public $_id;



  	public function BorrarUsuario()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuarios  				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->_id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

	// public static function BorrarCdPorAnio($año)
	//  {

	// 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 		$consulta =$objetoAccesoDato->RetornarConsulta("
	// 			delete 
	// 			from cds 				
	// 			WHERE jahr=:anio");	
	// 			$consulta->bindValue(':anio',$año, PDO::PARAM_INT);		
	// 			$consulta->execute();
	// 			return $consulta->rowCount();

	//  }
	// public function ModificarUsuario()
	//  {

	// 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 		$consulta =$objetoAccesoDato->RetornarConsulta("
	// 			update usuarios  
	// 			set titel='$this->titulo',
	// 			interpret='$this->cantante',
	// 			jahr='$this->año'
	// 			WHERE id='$this->id'");
	// 		return $consulta->execute();

	//  }
	
  
	//  public function InsertarElCd()
	//  {
	// 			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 			$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into cds (titel,interpret,jahr)values('$this->titulo','$this->cantante','$this->año')");
	// 			$consulta->execute();
	// 			return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	//  }

	  public function ModificarUsuarioParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuarios 
				set nombre=:nombre,
				clave=:clave,
				mail=:mail 
				WHERE id=:id");
			$consulta->bindValue(':id',$this->_id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$this->_nombre, PDO::PARAM_STR);
			$consulta->bindValue(':clave', $this->_clave, PDO::PARAM_STR);
			$consulta->bindValue(':mail', $this->_mail, PDO::PARAM_STR);
			return $consulta->execute();
	 }

	 public function InsertarElUsuarioParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,clave,mail,fecha_registro) 
				values(:nombre,:clave,:mail,:fecha)");
				$consulta->bindValue(':nombre',$this->_nombre, PDO::PARAM_STR);
				$consulta->bindValue(':clave', $this->_clave, PDO::PARAM_STR);
				$consulta->bindValue(':mail', $this->_mail, PDO::PARAM_STR);
				$consulta->bindValue(':fecha',$this->_fechaRegistro, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 public function GuardarCD()
	 {

	 	if($this->id>0)
	 		{
	 			$this->ModificarUsuarioParametros();
	 		}else {
	 			$this->InsertarElUsuarioParametros();
	 		}

	 }


  	public static function TraerTodoLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id as _id,nombre as _nombre,mail as _mail,fecha_registro as _fechaRegistro, clave as _clave from usuarios");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}

	public static function TraerUnUsuario($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id as _id,nombre as _nombre,mail as _mail,fecha_registro as _fechaRegistro, clave as _clave from usuarios 		
			where id = :id");
			$consulta->bindValue(':id', $id, PDO::PARAM_INT);
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('usuario');
			return $cdBuscado;				

			
	}

	// public static function TraerUnCdAnio($id,$anio) 
	// {
	// 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 		$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=? AND jahr=?");
	// 		$consulta->execute(array($id, $anio));
	// 		$cdBuscado= $consulta->fetchObject('cd');
    //   		return $cdBuscado;				

			
	// }

	// public static function TraerUnCdAnioParamNombre($id,$anio) 
	// {
	// 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 		$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
	// 		$consulta->bindValue(':id', $id, PDO::PARAM_INT);
	// 		$consulta->bindValue(':anio', $anio, PDO::PARAM_STR);
	// 		$consulta->execute();
	// 		$cdBuscado= $consulta->fetchObject('cd');
    //   		return $cdBuscado;				

			
	// }
	
	// public static function TraerUnCdAnioParamNombreArray($id,$anio) 
	// {
	// 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
	// 		$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
	// 		$consulta->execute(array(':id'=> $id,':anio'=> $anio));
	// 		$consulta->execute();
	// 		$cdBuscado= $consulta->fetchObject('cd');
    //   		return $cdBuscado;				

			
	// }

	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->_nombre."  ".$this->_mail."  ".$this->_fechaRegistro;
	}

}