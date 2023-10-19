<?php
class Correo 
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

	function ValidaCorreo($Colab_Email)
		{
		$this->sql="SELECT * FROM `colaborador` WHERE `Colab_Email`='$Colab_Email' AND `Colab_Estado`='ACTIVO'";
		$this->rpta=$this->cnx->prepare($this->sql);
		$this->rpta->execute();
		$this->fila=$this->rpta->fetch(PDO::FETCH_ASSOC); 
 		$this->cant=$this->rpta->rowCount();
        $this->rpta->closeCursor();
		$data = 0;
		if ($this->cant==1){
			$data = 1;
		}
		return $data;
		}

	function GrabaContrasena($Colab_Email, $password)
		{
			//Se encripta el password
			$Usua_Password = MD5($password);

			$this->sql="SELECT * FROM `colaborador` WHERE `Colab_Email`='$Colab_Email' AND `Colab_Estado`='ACTIVO'";
			$this->rpta=$this->cnx->prepare($this->sql);
			$this->rpta->execute();
			$this->fila=$this->rpta->fetchAll(PDO::FETCH_ASSOC); 
 			$this->cant=$this->rpta->rowCount();
        	$this->rpta->closeCursor();

			//Se ubica el DNI del usuario
			$Colaborador_id = "";
			foreach($this->fila as $row){
				$Colaborador_id = $row['Colaborador_id'];
			};

			$this->sql="UPDATE `usuario` SET `Usua_Password`='$Usua_Password' WHERE `Usuario_Id`='$Colaborador_id'";
			$this->rpta=$this->cnx->prepare($this->sql);
			$this->rpta->execute();
        	$this->rpta->closeCursor();
		}

	}