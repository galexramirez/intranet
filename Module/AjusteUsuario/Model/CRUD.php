<?php
session_start();
class CRUD
{	
	var $conexion;
	var $objeto;

	function __construct()
	{
		if (!isset($_SESSION['USUARIO_ID'])){         
			session_destroy();
			echo '<script>window.location.href = "LogOut";</script>';  
			exit();
		}
		SController('ConexionesBD','C_ConexionBD');
		$Instancia= new C_ConexionesBD();
		$this->conexion=$Instancia->Conectar(); 	
	}

	function Read()
	{
        $Colaborador_id = $_SESSION['USUARIO_ID'];
		$consulta="SELECT * FROM `colaborador` LEFT JOIN `usuario` ON `usuario_id`=`Colaborador_id` WHERE `Colaborador_id`='$Colaborador_id'";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function Update($Usua_Password)
   	{
		$Usuario_Id = $_SESSION['USUARIO_ID'];
		$consulta= "SELECT Usua_Password FROM usuario WHERE Usuario_Id ='$Usuario_Id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $row){
			$password = $row['Usua_Password'];
		}

		if($Usua_Password!==$password){
			$Usua_Password=MD5($Usua_Password);
			$consulta = "UPDATE `usuario` SET `Usua_Password`='$Usua_Password' WHERE `Usuario_Id`='$Usuario_Id'";		
			$resultado = $this->conexion->prepare($consulta);
			$resultado->execute();   
		}        

		$this->conexion=null;	
	}  		
	
	function BuscarFotografia()
	{
		$Colaborador_id = $_SESSION['USUARIO_ID'];
		$consulta="SELECT TO_BASE64 (`Colab_Fotografia`) AS `b64_Foto` FROM `glo_colaboradorimagen` WHERE `Colaborador_id`='$Colaborador_id'";
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;	
	}  		

	function SelectTipos($ttablamaestrouno_operacion,$ttablamaestrouno_tipo)
	{
		$consulta="SELECT `glo_tipotablamaestrouno`.`ttablamaestrouno_detalle` AS `Detalle` FROM `glo_tipotablamaestrouno` WHERE `glo_tipotablamaestrouno`.`ttablamaestrouno_operacion` = '$ttablamaestrouno_operacion' AND `glo_tipotablamaestrouno`.`ttablamaestrouno_tipo`= '$ttablamaestrouno_tipo' ORDER BY `Detalle` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

}