<?php
session_start();
class CRUD
{	
	var $conexion;

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

	function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
	{
		$consulta="SELECT * FROM `$TablaBD` WHERE `$CampoBD` = '$DataBuscar'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function datos_grafico_pie($tabla, $campo, $fecha_inicio, $fecha_termino, $campo_fecha, $valor, $categoria)
	{
		$consulta	= " SELECT `$campo` AS `$categoria`, COUNT(*) AS `$valor` FROM `$tabla` WHERE `$tabla`.`$campo_fecha`>='$fecha_inicio' AND `$campo_fecha`<='$fecha_termino' GROUP BY `$campo` ";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data	= $resultado->fetchAll(PDO::FETCH_ASSOC);
		
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;
	}

}