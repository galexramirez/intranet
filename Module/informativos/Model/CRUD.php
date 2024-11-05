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
		$comu_estado = "ACTIVO";
        $consulta="SELECT `Comunicado_Id`, `Comu_Titulo`, `Comu_FechaInicio`, `Comu_FechaFin`, `Comu_Destacado`, `Comu_Archivo`, `Comu_Proceso`, `Comu_Estado` FROM `comunicado` WHERE `Comu_Estado`='".$comu_estado."'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function Create($comu_titulo, $comu_fecha_inicio, $comu_fecha_fin, $comu_proceso, $comu_destacado, $nombre_imagen, $comu_estado)
   	{
		$consulta = "INSERT INTO `comunicado` (`Comu_Titulo`, `Comu_FechaInicio`, `Comu_FechaFin`, `Comu_Destacado`, `Comu_Archivo`, `Comu_Proceso`, `Comu_Estado`) VALUES ('$comu_titulo', '$comu_fecha_inicio', '$comu_fecha_fin', '$comu_destacado', '$nombre_imagen', '$comu_proceso', '$comu_estado')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

        $this->conexion=null;
	}
	
	function Delete($comunicado_id)
   	{
		$comu_estado = "INACTIVO";
		$consulta = "UPDATE `comunicado` SET `Comu_Estado`='$comu_estado' WHERE `Comunicado_Id`='$comunicado_id'";		
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

	function buscar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$consulta = "SELECT `$nombre_tabla`.`$campo_buscar` FROM `$nombre_tabla` WHERE ".$condicion_where;

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}

}