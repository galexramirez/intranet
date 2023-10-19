<?php
class Usuario 
	{	
	var $cnx;
	var $sql;
	var $rpta;
	var $cant;
	var $fila=array();

	function __construct()
		{
		SController('ConexionesBD','C_ConexionBD');
		$Instancia= new C_ConexionesBD();
		$this->cnx=$Instancia->Conectar(); 	
		}

	/// F. PARA VALIDAR INGRESO DE USUARIOS/ USUARIO, CONTRASEÑA / VALIDOS O NO VALIDOS
	/*
	function ValidaUsuario($usuario,$password)
		{
		
		$this->sql="select * from usuario where Usua_UsuarioWeb='".$usuario."' and Usua_Password='".$password."' and Usua_Estado='ACTIVO'";
		$this->rpta=$this->cnx->prepare($this->sql);
		$this->rpta->execute();
		$this->fila=$this->rpta->fetch(PDO::FETCH_ASSOC); 
 		$this->cant=$this->rpta->rowCount();
        $this->rpta->closeCursor();
       	if ($this->cant=="1")
       		{
			$_SESSION['USU_NOMBRES']=$this->fila[Usua_Nombres];
		    $_SESSION['USUARIO_ID']=$this->fila[Usuario_Id];
		    $_SESSION['USU_PERFIL']=$this->fila[Usua_Perfil];
		    $_SESSION['Usua_NombreCorto']=$this->fila[Usua_NombreCorto];
			}    
        
		}
		*/
		function ValidaUsuario($usuario,$password)
		{
		$password = MD5($password);
		$this->sql="select * from usuario where Usua_UsuarioWeb='".$usuario."' and Usua_Password='".$password."' and Usua_Estado='ACTIVO'";
		$this->rpta=$this->cnx->prepare($this->sql);
		$this->rpta->execute();
		$this->fila=$this->rpta->fetch(PDO::FETCH_ASSOC); 
 		$this->cant=$this->rpta->rowCount();
        $this->rpta->closeCursor();
       	if ($this->cant=="1")
       		{
			$_SESSION['USU_NOMBRES']=$this->fila['Usua_Nombres'];
		    $_SESSION['USUARIO_ID']=$this->fila['Usuario_Id'];
		    $_SESSION['USU_PERFIL']=$this->fila['Usua_Perfil'];
		    $_SESSION['Usua_NombreCorto']=$this->fila['Usua_NombreCorto'];

			$usuario_id = $this->fila['Usuario_Id'];
			$this->sql="SELECT TO_BASE64 (`Colab_Fotografia`) AS `b64_foto` FROM `glo_colaboradorimagen` WHERE `Colaborador_id`='$usuario_id'";
			$this->rpta=$this->cnx->prepare($this->sql);
			$this->rpta->execute();
			$this->fila=$this->rpta->fetch(PDO::FETCH_ASSOC); 
			$this->cant=$this->rpta->rowCount();
			$this->rpta->closeCursor();
			if($this->cant=="1"){
				$_SESSION['usua_fotografia'] = $this->fila['b64_foto'];
			}

			}    
        
		}
	}
