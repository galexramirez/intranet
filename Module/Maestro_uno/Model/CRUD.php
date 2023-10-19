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
        $consulta="SELECT `Colaborador_id`, `Colab_ApellidosNombres`, `Colab_nombre_corto`, `Colab_CargoActual`, `Colab_Estado`, DATE_FORMAT(`Colab_FechaIngreso`,'%Y-%m-%d') AS `Colab_FechaIngreso`, DATE_FORMAT(`Colab_FechaCese`,'%Y-%m-%d') AS `Colab_FechaCese`, `Colab_Email`, `Colab_Direccion`, `Colab_Distrito`, `Colab_CodigoCortoPT`, `Colab_PerfilEvaluacion`, (SELECT `Colaborador_id` FROM `glo_colaboradorimagen` WHERE `glo_colaboradorimagen`.`Colaborador_id`=`colaborador`.`Colaborador_id` AND `glo_colaboradorimagen`.`Colab_Fotografia`!='') AS `Colab_Foto` FROM `colaborador`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function Create($Colaborador_id,$Colab_ApellidosNombres,$Colab_CargoActual,$Colab_Estado,$Colab_FechaIngreso,$Colab_FechaCese,$Colab_Email,$Colab_Direccion,$Colab_Distrito,$Colab_CodigoCortoPT,$Colab_PerfilEvaluacion, $Colab_nombre_corto)
   	{
		$consulta = "INSERT INTO `colaborador`(`Colaborador_id`, `Colab_ApellidosNombres`, `Colab_CargoActual`, `Colab_Estado`, `Colab_FechaIngreso`, `Colab_FechaCese`,`Colab_Email`, `Colab_Direccion`, `Colab_Distrito`, `Colab_CodigoCortoPT`, `Colab_PerfilEvaluacion`, `Colab_nombre_corto`) VALUES ('$Colaborador_id','$Colab_ApellidosNombres','$Colab_CargoActual','$Colab_Estado','$Colab_FechaIngreso',$Colab_FechaCese,'$Colab_Email','$Colab_Direccion','$Colab_Distrito','$Colab_CodigoCortoPT','$Colab_PerfilEvaluacion', '$Colab_nombre_corto')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "INSERT INTO `glo_colaboradorimagen`(`Colaborador_id`) VALUES ('$Colaborador_id')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta= "SELECT * FROM colaborador WHERE Colaborador_id ='$Colaborador_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
	}
	
	function Update($Colaborador_id,$Colab_ApellidosNombres,$Colab_CargoActual,$Colab_Estado,$Colab_FechaIngreso,$Colab_FechaCese,$Colab_Email,$Colab_Direccion,$Colab_Distrito,$Colab_CodigoCortoPT,$Colab_PerfilEvaluacion, $Colab_nombre_corto)
   	{
		$consulta = "UPDATE `colaborador` SET `Colaborador_id`='$Colaborador_id',`Colab_ApellidosNombres`='$Colab_ApellidosNombres',`Colab_CargoActual`='$Colab_CargoActual',`Colab_Estado`='$Colab_Estado',`Colab_FechaIngreso`='$Colab_FechaIngreso',`Colab_FechaCese`=$Colab_FechaCese, `Colab_Email`='$Colab_Email', `Colab_Direccion`='$Colab_Direccion',`Colab_Distrito`='$Colab_Distrito',`Colab_CodigoCortoPT`='$Colab_CodigoCortoPT',`Colab_PerfilEvaluacion`='$Colab_PerfilEvaluacion', `Colab_nombre_corto`='$Colab_nombre_corto' WHERE `Colaborador_id`='$Colaborador_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM colaborador WHERE Colaborador_id ='$Colaborador_id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function Delete($Colaborador_id)
   	{
		$consulta = "DELETE FROM `colaborador` WHERE `Colaborador_id`='$Colaborador_id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "DELETE FROM `glo_colaboradorimagen` WHERE `Colaborador_id`='$Colaborador_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$this->conexion=null;	
	}  		

	function FotografiaMaestroUno($Colaborador_id)
	{
		$consulta="SELECT TO_BASE64 (`Colab_Fotografia`) AS `b64_Foto` FROM `glo_colaboradorimagen` WHERE `Colaborador_id`='$Colaborador_id'";
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;	
	}  		

	function GrabarFotografia($Colaborador_id,$Colab_Fotografia)
	{
		$consulta="UPDATE `glo_colaboradorimagen` SET `Colab_Fotografia`= '$Colab_Fotografia' WHERE `Colaborador_id`='$Colaborador_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

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

	function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
	{
		$consulta="SELECT * FROM `$TablaBD` WHERE `$CampoBD` = '$DataBuscar'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

}