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

	///:: REPORTE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

	function buscar_informe_preliminar($fecha_inicio, $fecha_termino)
	{
		$consulta = "SELECT 
						`OPE_AccidentesImagen`.`Acci_TipoImagen` AS `doc_adj`,
						`OPE_Accidentes`.`Accidentes_Id`  AS `codigo_aplicacion`,
						`OPE_Accidentes`.`Acci_FechaOperacion`  AS `fecha_accidente`,
						`OPE_AccidentesInformePreliminar`.`Acci_NombreColaborador` AS `nombre_piloto`,
						`OPE_AccidentesInformePreliminar`.`Acci_Bus` AS `bus`,
						`Buses`.`Bus_NroPlaca` AS `nro_placa`,
						`OPE_AccidentesInformePreliminar`.`Acci_Operacion` AS `operacion`,
						`OPE_AccidentesInformePreliminar`.`Acci_TipoAccidente` AS `tipo`,
						`OPE_AccidentesInformePreliminar`.`Acci_ClaseAccidente` AS `clase`,
						`OPE_AccidentesInformePreliminar`.`Acci_TipoEvento` AS `evento`,
						`OPE_AccidentesInformePreliminar`.`Acci_Lesiones` AS `consecuencias`,
						`OPE_AccidentesInformePreliminar`.`Acci_DanosMateriales` AS `danos`,
						`OPE_AccidentesInformePreliminar`.`Acci_ReconoceResponsabilidad` AS `piloto_reconoce_responsabilidad`,
						`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadAccidente` AS `responsabilidad`,
						`OPE_AccidentesInvestigacion`.`acci_nro_siniestro` AS `nro_siniestro`
					FROM
						`OPE_Accidentes`
					LEFT JOIN
						`OPE_AccidentesInformePreliminar`
					ON
						`OPE_Accidentes`.`Accidentes_Id` = `OPE_AccidentesInformePreliminar`.`Accidentes_Id`
					LEFT JOIN
						`OPE_AccidentesInvestigacion`
					ON
						`OPE_Accidentes`.`Accidentes_Id` = `OPE_AccidentesInvestigacion`.`Accidentes_Id`
					LEFT JOIN
						`Buses`
					ON
						`OPE_AccidentesInformePreliminar`.`Acci_Bus`=`Buses`.`Bus_NroExterno`
					LEFT JOIN
						`OPE_AccidentesImagen`
					ON
						`OPE_AccidentesImagen`.`Accidentes_Id`=`OPE_Accidentes`.`Accidentes_Id` AND 
						`OPE_AccidentesImagen`.`Acci_TipoImagen`='PDF'
					WHERE
						`OPE_Accidentes`.`Acci_FechaOperacion` >= '$fecha_inicio' AND
						`OPE_Accidentes`.`Acci_FechaOperacion` <= '$fecha_termino'
					ORDER BY
						`OPE_Accidentes`.`Accidentes_Id` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}   

	function descargar_informe_preliminar($fecha_inicio, $fecha_termino)
	{
		$consulta = "SELECT 
						`OPE_AccidentesImagen`.`Acci_TipoImagen` AS `doc_adj`,
						`OPE_Accidentes`.`Accidentes_Id`  AS `codigo_aplicacion`,
						`OPE_Accidentes`.`Acci_FechaOperacion`  AS `fecha_accidente`,
						`OPE_AccidentesInformePreliminar`.`Acci_NombreColaborador` AS `nombre_piloto`,
						`OPE_AccidentesInformePreliminar`.`Acci_Bus` AS `bus`,
						`Buses`.`Bus_NroPlaca` AS `nro_placa`,
						`OPE_AccidentesInformePreliminar`.`Acci_Operacion` AS `operacion`,
						`OPE_AccidentesInformePreliminar`.`Acci_TipoAccidente` AS `tipo`,
						`OPE_AccidentesInformePreliminar`.`Acci_ClaseAccidente` AS `clase`,
						`OPE_AccidentesInformePreliminar`.`Acci_TipoEvento` AS `evento`,
						`OPE_AccidentesInformePreliminar`.`Acci_Lesiones` AS `consecuencias`,
						`OPE_AccidentesInformePreliminar`.`Acci_DanosMateriales` AS `danos`,
						`OPE_AccidentesInformePreliminar`.`Acci_ReconoceResponsabilidad` AS `piloto_reconoce_responsabilidad`,
						`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadAccidente` AS `responsabilidad`,
						`OPE_AccidentesInvestigacion`.`acci_nro_siniestro` AS `nro_siniestro`,
						(SELECT GROUP_CONCAT(CONCAT_WS(', ',CONCAT('COD.COLOR: ',`OPE_AccidentesReparacion`.`Acci_CodigoColor`),CONCAT('POSICION(COD.SECCION BUS): ',`OPE_AccidentesReparacion`.`Acci_SeccionBus`),`OPE_AccidentesReparacion`.`Acci_DescripcionReparacion`)) FROM `OPE_AccidentesReparacion` WHERE `OPE_AccidentesReparacion`.`Accidentes_Id`=`OPE_Accidentes`.`Accidentes_Id`) AS `detalle_danos`
					FROM
						`OPE_Accidentes`
					LEFT JOIN
						`OPE_AccidentesInformePreliminar`
					ON
						`OPE_Accidentes`.`Accidentes_Id` = `OPE_AccidentesInformePreliminar`.`Accidentes_Id`
					LEFT JOIN
						`OPE_AccidentesInvestigacion`
					ON
						`OPE_Accidentes`.`Accidentes_Id` = `OPE_AccidentesInvestigacion`.`Accidentes_Id`
					LEFT JOIN
						`Buses`
					ON
						`OPE_AccidentesInformePreliminar`.`Acci_Bus`=`Buses`.`Bus_NroExterno`
					LEFT JOIN
						`OPE_AccidentesImagen`
					ON
						`OPE_AccidentesImagen`.`Accidentes_Id`=`OPE_Accidentes`.`Accidentes_Id` AND 
						`OPE_AccidentesImagen`.`Acci_TipoImagen`='PDF'
					WHERE
						`OPE_Accidentes`.`Acci_FechaOperacion` >= '$fecha_inicio' AND
						`OPE_Accidentes`.`Acci_FechaOperacion` <= '$fecha_termino'
					ORDER BY
						`OPE_Accidentes`.`Accidentes_Id` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}   

	function pdf_informe_preliminar($accidentes_id)
	{
		$consulta 	= "SELECT *, (SELECT `Bus_NroPlaca`FROM `Buses` WHERE `Bus_NroExterno` = `Acci_Bus`) AS `Bus_NroPlaca`, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `roles_dni` = `Acci_UsuarioId_Edicion` LIMIT 1) AS `CGOSuscribe` FROM `OPE_AccidentesInformePreliminar` WHERE `Accidentes_Id`='$accidentes_id'";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function buscar_data_bd($TablaBD, $CampoBD, $DataBuscar)
	{
		$consulta	= "SELECT * FROM `$TablaBD` WHERE `$CampoBD` = '$DataBuscar'";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);

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