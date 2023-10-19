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

	function Permisos($cacces_nombremodulo,$cacces_nombreobjeto)
	{
		$rptapermisos = "";
		$cacces_moduloid = "";
		$cacces_objetosid = "";
		$cacces_perfil = $_SESSION['USU_PERFIL'];

		$consulta = "SELECT * FROM `Modulo` WHERE `Modulo`.`Mod_Nombre` = '$cacces_nombremodulo'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $row){
			$cacces_moduloid = $row['Modulo_Id'];
		}

		$consulta = "SELECT * FROM `glo_objetos` WHERE `glo_objetos`.`obj_nombre` = '$cacces_nombreobjeto'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $row){
			$cacces_objetosid = $row['objetos_id'];
		}

		$consulta="SELECT * FROM `glo_controlaccesos` WHERE `cacces_perfil` = '$cacces_perfil' AND `cacces_moduloid` = '$cacces_moduloid' AND `cacces_objetosid` = '$cacces_objetosid'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($data as $row){
			$rptapermisos = $row['cacces_acceso'];
		}
		return $rptapermisos;
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

	///:: REPORTE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

	function buscar_costo_accidentes($fecha_inicio, $fecha_termino)
	{
		$consulta = "SELECT 
						`OPE_Accidentes`.`Accidentes_Id`  AS `codigo_aplicacion`,
						`OPE_Accidentes`.`Acci_FechaOperacion`  AS `fecha_accidente`,
						`OPE_AccidentesInformePreliminar`.`Acci_NombreColaborador` AS `nombre_piloto`,
						`OPE_AccidentesInformePreliminar`.`Acci_Bus` AS `bus`,
						`Buses`.`Bus_NroPlaca` AS `placa`,
						`OPE_AccidentesInformePreliminar`.`Acci_Operacion` AS `operacion`,
						FORMAT(`OPE_AccidentesInformePreliminar`.`Acci_MontoConciliado`,2) AS `monto_conciliado`,
						FORMAT(`ope_accidentes_costo`.`acos_monto_cotizado`,2) AS `monto_cotizado`,
						IF(ISNULL(`ope_accidentes_costo`.`acos_estado`)='1','PENDIENTE',`ope_accidentes_costo`.`acos_estado`) AS `estado_final`,
						IF(ISNULL(`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadAccidente`),'EN INVESTIGACION',`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadAccidente`) AS `responsabilidad`,
						IF(`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadAccidente`='DIRECTA',IF(ISNULL(`ope_accidentes_costo`.`acos_firma_convenio`)='1','PENDIENTE',`ope_accidentes_costo`.`acos_firma_convenio`),IF(`OPE_AccidentesInvestigacion`.`Acci_ResponsabilidadAccidente`='NO','NO APLICA','')) AS `firma_convenio`
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
						`ope_accidentes_costo`
					ON
						`OPE_Accidentes`.`Accidentes_Id` = `ope_accidentes_costo`.`acos_accidentes_id`
					WHERE
						`OPE_Accidentes`.`Acci_FechaOperacion` >= '$fecha_inicio' AND
						`OPE_Accidentes`.`Acci_FechaOperacion` <= '$fecha_termino' AND
						`OPE_AccidentesInformePreliminar`.`Acci_DanosMateriales` = 'CON_DAÑOS_MATERIALES'
					ORDER BY
						`OPE_Accidentes`.`Accidentes_Id` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}   

	function buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo)
	{
		$consulta  ="SELECT TO_BASE64 (`$campo_archivo`) AS `b64_file` FROM `$tabla` WHERE `$campo_buscar`='$dato_buscar' AND `$campo_tipo_archivo`='$dato_tipo_archivo'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
  		
		return $data;
  		$this->conexion=null;	
	}

	function grabar_imagen($accidentes_id, $acci_tipo_imagen, $acci_imagen)
	{
		$acci_imagen_fecha 		= date("Y-m-d H:i:s");
		$acci_imagen_usuario_id = $_SESSION['USUARIO_ID'];		

		$consulta = "INSERT INTO `ope_accidentes_costo_imagen`(`accidentes_id`, `acci_tipo_imagen`, `acci_imagen`, `acci_imagen_fecha`, `acci_imagen_usuario_id`) VALUES ('$accidentes_id', '$acci_tipo_imagen', '$acci_imagen', '$acci_imagen_fecha', '$acci_imagen_usuario_id')";

		$resultado = $this->conexion->prepare($consulta);
 		$resultado->execute();   

 		$this->conexion=null;	
 	}

	function editar_imagen($accidentes_id, $acci_tipo_imagen, $acci_imagen)
	{
		$acci_imagen_fecha 		= date("Y-m-d H:i:s");
		$acci_imagen_usuario_id = $_SESSION['USUARIO_ID'];		

		$consulta = "UPDATE `ope_accidentes_costo_imagen` SET `acci_imagen`='$acci_imagen', `acci_imagen_fecha`='$acci_imagen_fecha', `acci_imagen_usuario_id`='$acci_imagen_usuario_id', `acci_imagen_fecha`='$acci_imagen_fecha', `acci_imagen_usuario_id`='$acci_imagen_usuario_id'  WHERE `accidentes_id`='$accidentes_id' AND `acci_tipo_imagen`='$acci_tipo_imagen'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$this->conexion=null;	
	}

	function crear_costo_accidente($accidentes_id, $acos_monto_mano_obra, $acos_monto_insumos, $acos_costo_manto, $acos_monto_impuesto, $acos_monto_cotizado)
	{
		$acos_fecha_creacion	= date("Y-m-d H:i:s");
		$acos_usuario_id_crea	= $_SESSION['USUARIO_ID'];
		$acos_nombre_usuario	= $_SESSION['Usua_NombreCorto'];
		$acos_estado			= 'CERRADO';
		$acos_log				= $acos_fecha_creacion." ".$acos_estado." ".$acos_nombre_usuario. " CREACION";

		$consulta = "INSERT INTO `ope_accidentes_costo`	(`acos_accidentes_id`, `acos_monto_cotizado`, `acos_monto_mano_obra`, `acos_monto_insumos`, `acos_costo_manto`, `acos_monto_impuesto`, `acos_estado`, `acos_fecha_creacion`, `acos_fecha_cierre`, `acos_log`, `acos_usuario_id_crea`, `acos_usuario_id_cierra`) VALUES ('$accidentes_id', '$acos_monto_cotizado', '$acos_monto_mano_obra', '$acos_monto_insumos', '$acos_costo_manto', '$acos_monto_impuesto', '$acos_estado', '$acos_fecha_creacion', '$acos_fecha_creacion', '$acos_log', '$acos_usuario_id_crea', '$acos_usuario_id_crea')";

		$resultado = $this->conexion->prepare($consulta);
 		$resultado->execute();   

 		$this->conexion=null;	
 	}

	function editar_costo_accidente($accidentes_id, $acos_monto_mano_obra, $acos_monto_insumos, $acos_costo_manto, $acos_monto_impuesto, $acos_monto_cotizado)
	{
		$acos_fecha_cierre		= date("Y-m-d H:i:s");
		$acos_usuario_id_cierra	= $_SESSION['USUARIO_ID'];
		$acos_nombre_usuario	= $_SESSION['Usua_NombreCorto'];
		$acos_estado			= 'CERRADO';
		
		$consulta  	= "SELECT * FROM `ope_accidentes_costo` WHERE `acos_accidentes_id` = '$accidentes_id' ";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data 		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $row){
			$acos_log = $row['acos_log'];
		}
	
		$acos_log	= $acos_fecha_cierre." ".$acos_estado." ".$acos_nombre_usuario." EDICION <br>".$acos_log;

		$consulta = " UPDATE `ope_accidentes_costo` SET `acos_monto_cotizado` = '$acos_monto_cotizado', `acos_monto_mano_obra` = '$acos_monto_mano_obra', `acos_monto_insumos` = '$acos_monto_insumos', `acos_costo_manto` = '$acos_costo_manto', `acos_monto_impuesto` = '$acos_monto_impuesto', `acos_estado` = '$acos_estado', `acos_fecha_cierre` = '$acos_fecha_cierre', `acos_log` = '$acos_log', `acos_usuario_id_cierra` = '$acos_usuario_id_cierra' WHERE `acos_accidentes_id` = '$accidentes_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		 $this->conexion=null;	
	}

	function cerrar_firma_convenio($accidentes_id)
	{
		$acos_fecha_convenio	= date("Y-m-d H:i:s");
		$acos_usuario_id_cierra	= $_SESSION['USUARIO_ID'];
		$acos_nombre_usuario	= $_SESSION['Usua_NombreCorto'];
		$acos_firma_convenio	= 'CERRADO';
		
		$consulta  	= "SELECT * FROM `ope_accidentes_costo` WHERE `acos_accidentes_id` = '$accidentes_id' ";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$data 		= $resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $row){
			$acos_log = $row['acos_log'];
		}
	
		$acos_log	= $acos_fecha_convenio." ".$acos_firma_convenio." ".$acos_nombre_usuario." CIERRE FIRMA CONVENIO <br>".$acos_log;

		$consulta = " UPDATE `ope_accidentes_costo` SET `acos_firma_convenio` = '$acos_firma_convenio', `acos_log` = '$acos_log' WHERE `acos_accidentes_id` = '$accidentes_id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		 $this->conexion=null;	
	}
 
}