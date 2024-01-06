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

	function select_combo($nombre_tabla, $es_campo_unico, $campo_select, $condicion_where, $order_by)
	{
		$distinct 	= "";
		$c_where 	= "";
		$c_order_by = "";
		if($es_campo_unico == "SI"){
			$distinct = "DISTINCT";
		}
		if($condicion_where!==""){
			$c_where = "WHERE ".$condicion_where;
		}
		if($order_by!==""){
			$c_order_by = "ORDER BY ".$order_by;
		}
		$consulta = "SELECT ".$distinct." `$nombre_tabla`.`$campo_select` AS `detalle` FROM `$nombre_tabla` ".$c_where." ".$c_order_by;
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}


	function LeerVales($FechaInicioVales,$FechaTerminoVales)
	{
		$consulta = "SELECT `cod_vale`, IF(`va_ot`='0','',`va_ot`) AS `va_ot`, `manto_ot`.`ot_bus` AS `va_bus`, `manto_ot`.`ot_origen` AS `va_origen`, `va_asociado`, `va_responsable`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`va_genera` LIMIT 1) AS `va_genera`, DATE_FORMAT(`va_date_genera`,'%d-%m-%Y %H:%i') AS `va_date_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`va_cierra` LIMIT 1) AS `va_cierra`, DATE_FORMAT(`va_date_cierra`,'%d-%m-%Y %H:%i') AS `va_date_cierra`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`va_cierre_adm` LIMIT 1) AS `va_cierre_adm`, DATE_FORMAT(`va_date_cierre_adm`,'%d-%m-%Y %H:%i') AS `va_date_cierre_adm`, `va_estado` FROM `manto_vales` LEFT JOIN `manto_ot` ON `cod_ot`=`va_ot` WHERE DATE_FORMAT(`va_date_genera`,'%Y-%m-%d')>='$FechaInicioVales' AND DATE_FORMAT(`va_date_genera`,'%Y-%m-%d')<='$FechaTerminoVales'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function cargar_detalle_repuestos($cod_vale)
	{
		$consulta="SELECT `rv_id`, `cod_rv`, `rv_repuesto`, `rv_nroserie`, `rv_cantidad`, `rv_precio`, `rep_desc` AS `rv_desc`, `rep_unida` AS `rv_unidad` FROM `manto_rep_vale` LEFT JOIN `manto_repuestos` ON `cod_rep`=`rv_repuesto` WHERE `rv_vale`='$cod_vale'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}
	
	function generar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $va_obs_aom, $va_estado, $nombre_cierre_adm)
	{
        $va_cierre_adm = $_SESSION['USUARIO_ID'];
		$va_date_cierre_adm = date("Y-m-d H:i:s");
		$va_obs_aom = date_format(date_create($va_date_cierre_adm),"d-m-Y H:i")." ".$nombre_cierre_adm.": Registro Sistema ".$va_obs_aom;
		if($va_ot==""){
			$va_ot='0';
		}
		$consulta="INSERT INTO `manto_vales`(`cod_vale`, `va_ot`, `va_genera`, `va_date_genera`, `va_asociado`, `va_responsable`, `va_cierre_adm`, `va_date_cierre_adm`, `va_garantia`, `va_obs_cgm`, `va_obs_aom`, `va_estado`) VALUES ('$cod_vale', '$va_ot', '$va_genera', '$va_date_genera', '$va_asociado', '$va_responsable', '$va_cierre_adm', '$va_date_cierre_adm', '$va_garantia', '$va_obs_cgm', '$va_obs_aom', '$va_estado')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        
		$this->conexion=null;
	}

	function crear_detalle_repuestos($rv_vale, $rv_id, $rv_repuesto, $rv_nroserie, $rv_cantidad, $rv_precio)
	{
		$consulta="INSERT INTO `manto_rep_vale`(`rv_vale`, `rv_id`, `rv_repuesto`, `rv_nroserie`, `rv_cantidad`, `rv_precio`) VALUES ('$rv_vale', '$rv_id', '$rv_repuesto', '$rv_nroserie', '$rv_cantidad', '$rv_precio')";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$this->conexion=null;
	}

	function eliminar_detalle_repuestos($cod_rv)
	{
		$consulta="DELETE FROM `manto_rep_vale` WHERE `rv_vale`='$cod_rv'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
		$this->conexion=null;
	}

	function cargar_vales($cod_vale)
	{
		$consulta="SELECT `cod_vale`, `va_ot`, `manto_ot`.`ot_bus` AS `va_bus`, `manto_ot`.`ot_origen` AS `va_origen`, `va_asociado`, `va_responsable`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`va_genera` LIMIT 1) AS `va_genera`, `va_date_genera`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`va_cierre_adm` LIMIT 1) AS `va_cierre_adm`, `va_date_cierre_adm`, `va_estado`, `va_garantia`, CONCAT(`manto_ot`.`ot_origen`,' - ',`manto_ot`.`ot_descrip`) AS `va_descrip`, `va_obs_cgm`, `va_obs_aom` FROM `manto_vales` LEFT JOIN `manto_ot` ON `cod_ot`=`va_ot` WHERE `cod_vale`='$cod_vale'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function SelectUsuario($Usua_Perfil)
	{
		switch ($Usua_Perfil){
			case 'CGM':
				$consulta="SELECT `glo_roles`.`roles_nombrecorto` AS `Usuario` FROM `glo_roles` WHERE `roles_perfil` = '$Usua_Perfil' ORDER BY `Usuario` ASC";
			break;
			
			case 'TECNICO':
				$ra_asociado = "LBI";
				$consulta="SELECT DISTINCT `manto_resp_asociado`.`ra_nombres` AS `Usuario` FROM `manto_resp_asociado` WHERE `ra_asociado` <> '$ra_asociado' ORDER BY `Usuario` ASC ";
			break;
			
			default: ;
		}

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function SelectResponsable($va_asociado)
	{
		$consulta="SELECT DISTINCT `manto_resp_asociado`.`ra_nombres` AS `Usuario` FROM `manto_resp_asociado` WHERE `ra_asociado` = '$va_asociado' ORDER BY `Usuario` ASC ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function BuscarResponsable($va_asociado)
	{
		$consulta="SELECT `manto_resp_asociado`.`ra_nombres` AS `va_responsable` FROM `manto_resp_asociado` WHERE `ra_asociado` = '$va_asociado' ORDER BY `va_responsable` ASC LIMIT 1";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function SelectTipos($ttablavales_operacion,$ttablavales_tipo)
	{
		$consulta="SELECT `manto_tipotablavales`.`ttablavales_detalle` AS `Detalle` FROM `manto_tipotablavales` WHERE `manto_tipotablavales`.`ttablavales_operacion` = '$ttablavales_operacion' AND `manto_tipotablavales`.`ttablavales_tipo`= '$ttablavales_tipo' ORDER BY `Detalle` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function editar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $nombre_cierre_adm)
	{
        $va_cierre_adm 		= $_SESSION['USUARIO_ID'];
		$va_date_cierre_adm = date("Y-m-d H:i:s");
		$va_obs_aom 		= $va_estado." ".date_format(date_create($va_date_cierre_adm),"d-m-Y H:i")." ".$nombre_cierre_adm." Editar: ".$va_obs_aom."<br>".$tva_obs_aom;

		$consulta = "UPDATE `manto_vales` SET `va_ot`=IF('$va_ot'='','0','$va_ot'),`va_genera`='$va_genera',`va_date_genera`='$va_date_genera',`va_asociado`='$va_asociado',`va_responsable`='$va_responsable',`va_cierre_adm`='$va_cierre_adm',`va_date_cierre_adm`='$va_date_cierre_adm',`va_garantia`='$va_garantia', `va_obs_cgm`='$va_obs_cgm', `va_obs_aom`='$va_obs_aom', `va_estado`='$va_estado' WHERE `cod_vale`='$cod_vale'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
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

	function MaxId($TablaBD,$CampoId)
	{
		$consulta = "SELECT MAX(`$CampoId`) AS `MaxId` FROM `$TablaBD`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
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

	function BusesVales()
	{
		$consulta = "SELECT DISTINCT `CKL_KM_BUS` AS `Buses` FROM `manto_ckl_kilometraje` ORDER BY `Buses` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;

		$this->conexion=null;
   	}   

	function AsociadoVales()
	{
		$consulta = "SELECT DISTINCT `ra_asociado` AS `Asociado` FROM `manto_resp_asociado` WHERE `ra_asociado`!='' ORDER BY `Asociado` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;

		$this->conexion=null;
   	}   

	function LeerRepuestos()
	{
        $consulta="SELECT * FROM `manto_repuestos`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearRepuestos($cod_rep,$rep_desc,$rep_unida,$rep_precio,$rep_ingreso,$rep_asociado)
	{
		$consulta = "INSERT INTO `manto_repuestos`(`cod_rep`,`rep_desc`,`rep_unida`,`rep_precio`,`rep_ingreso`,`rep_asociado`) VALUES ('$cod_rep','$rep_desc','$rep_unida','$rep_precio','$rep_ingreso','$rep_asociado')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `manto_repuestos`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarRepuestos($cod_rep,$rep_desc,$rep_unida,$rep_precio,$rep_ingreso,$rep_asociado)
	{
		$consulta = "UPDATE `manto_repuestos` SET `rep_desc`='$rep_desc',`rep_unida`='$rep_unida',`rep_precio`='$rep_precio',`rep_ingreso`='$rep_ingreso',`rep_asociado`='$rep_asociado' WHERE `cod_rep`='$cod_rep'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_repuestos` WHERE `cod_rep` ='$cod_rep'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarRepuestos($cod_resasoc)
	{
		$consulta = "DELETE FROM `manto_resp_asociado` WHERE `cod_resasoc`='$cod_resasoc'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function LeerReporte($FechaInicioReporte,$FechaTerminoReporte)
	{
		//$consulta = "SELECT `manto_vales`.`cod_vale`, `manto_vales`.`va_estado`, `manto_vales`.`va_ot`, `manto_vales`.`va_asociado`, `manto_vales`.`va_responsable`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_vales`.`va_genera` LIMIT 1) AS `va_genera`, DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d') AS `va_date_genera`, `manto_vales`.`va_obs_cgm`, `manto_vales`.`va_garantia`, `manto_ot`.`ot_bus`, `manto_ot`.`ot_origen`, `manto_ot`.`ot_descrip`, (SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_vales`.`va_cierre_adm` LIMIT 1) AS `va_cierre_adm`, DATE_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%Y-%m-%d') AS `va_date_cierre_adm`, TIME_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%H:%i') AS `va_time_cierre_adm`, `manto_vales`.`va_obs_aom`, `manto_rep_vale`.`rv_repuesto`, `manto_rep_vale`.`rv_cantidad`, `manto_repuestos`.`rep_desc`, `manto_repuestos`.`rep_unida` AS `rep_unidad` FROM `manto_rep_vale`, `manto_repuestos`, `manto_vales` LEFT JOIN `manto_ot` ON `manto_vales`.`va_ot`=`manto_ot`.`cod_ot` WHERE `manto_vales`.`va_date_genera`>='$FechaInicioReporte' AND `manto_vales`.`va_date_genera`<='$FechaTerminoReporte' AND `manto_vales`.`cod_vale`=`manto_rep_vale`.`rv_vale` AND `manto_rep_vale`.`rv_repuesto`=`manto_repuestos`.`cod_rep` ORDER BY `manto_vales`.`va_date_genera`, `manto_vales`.`cod_vale` ASC";

		$consulta = "(SELECT 
						`manto_vales`.`cod_vale`, 
						`manto_vales`.`va_estado`, 
						`manto_vales`.`va_ot`, 
						`manto_vales`.`va_asociado`, 
						`manto_vales`.`va_responsable`, 
						(SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_vales`.`va_genera` LIMIT 1) AS `va_genera`,
						DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d') AS `va_date_genera`, 
						`manto_vales`.`va_obs_cgm`, 
						`manto_vales`.`va_garantia`,
						`manto_ot`.`ot_bus`, 
						`manto_ot`.`ot_origen`, 
						`manto_ot`.`ot_descrip`, 
						(SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_vales`.`va_cierre_adm` LIMIT 1) AS `va_cierre_adm`,
						DATE_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%Y-%m-%d') AS `va_date_cierre_adm`, 
						TIME_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%H:%i') AS `va_time_cierre_adm`, 
						`manto_vales`.`va_obs_aom`, 
						`manto_rep_vale`.`rv_repuesto`, 
						`manto_rep_vale`.`rv_cantidad`,
						`manto_repuestos`.`rep_desc`, 
						`manto_repuestos`.`rep_unida` AS `rep_unidad` 
					FROM 
						`manto_rep_vale`,
						`manto_repuestos`,
						`manto_vales`
					LEFT JOIN
						`manto_ot`
					ON
						`manto_vales`.`va_ot`=`manto_ot`.`cod_ot`
					WHERE 
						`manto_vales`.`va_date_genera`>='$FechaInicioReporte' AND
						`manto_vales`.`va_date_genera`<='$FechaTerminoReporte' AND
						`manto_vales`.`cod_vale` = `manto_rep_vale`.`rv_vale` AND
						`manto_rep_vale`.`rv_repuesto`=`manto_repuestos`.`cod_rep`
					ORDER BY
						`manto_vales`.`va_date_genera` DESC
					)
					UNION
					(SELECT
						`manto_vales`.`cod_vale`, 
						`manto_vales`.`va_estado`, 
						`manto_vales`.`va_ot`, 
						`manto_vales`.`va_asociado`, 
						`manto_vales`.`va_responsable`, 
						(SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_vales`.`va_genera` LIMIT 1) AS `va_genera`,
						DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d') AS `va_date_genera`, 
						`manto_vales`.`va_obs_cgm`, 
						`manto_vales`.`va_garantia`,
						`manto_ot`.`ot_bus`, 
						`manto_ot`.`ot_origen`, 
						`manto_ot`.`ot_descrip`, 
						(SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`manto_vales`.`va_cierre_adm` LIMIT 1) AS 	`va_cierre_adm`, 
						DATE_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%Y-%m-%d') AS `va_date_cierre_adm`, 
						TIME_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%H:%i') AS `va_time_cierre_adm`, 
						`manto_vales`.`va_obs_aom`, 
						'' AS `rv_repuesto`, 
						'' AS `rv_cantidad`,
						'' AS `rep_desc`, 
						'' AS `rep_unidad`
					FROM
						`manto_vales`
					LEFT JOIN
						`manto_ot`
					ON
						`manto_vales`.`va_ot`=`manto_ot`.`cod_ot`
					WHERE
						NOT EXISTS (
							SELECT 
								`manto_rep_vale`.`rv_vale`
							FROM
								`manto_rep_vale`
							WHERE
								`manto_vales`.`cod_vale`=`manto_rep_vale`.`rv_vale`) AND
								DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d')>='$FechaInicioReporte' AND
								DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d')<='$FechaTerminoReporte'
					ORDER BY
						`manto_vales`.`va_date_genera` DESC
					);";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function AutoCompletar($NombreTabla,$NombreCampo)
	{
		$consulta="SELECT * FROM `$NombreTabla`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function descargar_vales($FechaInicioVales,$FechaTerminoVales)
	{
		$consulta = "SELECT 
							`manto_vales`.`cod_vale`, 
							`manto_vales`.`va_estado`, 
							`manto_vales`.`va_ot`, 
							`manto_vales`.`va_asociado`, 
							`manto_vales`.`va_responsable`, 
							(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_Id`=`manto_vales`.`va_genera`) AS `va_genera`,
							DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d') AS `va_date_genera`, 
							`manto_vales`.`va_obs_cgm`, 
							`manto_vales`.`va_garantia`,
							`manto_ot`.`ot_bus`, 
							`manto_ot`.`ot_origen`, 
							`manto_ot`.`ot_descrip`, 
							(SELECT  `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_Id`=`manto_vales`.`va_cierre_adm`) AS `va_cierre_adm`,
							DATE_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%Y-%m-%d') AS `va_date_cierre_adm`, 
							TIME_FORMAT(`manto_vales`.`va_date_cierre_adm`,'%H:%i') AS `va_time_cierre_adm`, 
							`manto_vales`.`va_obs_aom`, 
							`manto_rep_vale`.`rv_repuesto`, 
							`manto_rep_vale`.`rv_nroserie`, 
							`manto_rep_vale`.`rv_cantidad`,
							`manto_repuestos`.`rep_desc`, 
							`manto_repuestos`.`rep_unida` AS `rep_unidad` 
						FROM 
							`manto_vales`
						LEFT JOIN `manto_rep_vale`
						ON `manto_rep_vale`.`rv_vale`=`manto_vales`.`cod_vale`
						LEFT JOIN `manto_repuestos`
						ON `manto_repuestos`.`cod_rep`=`manto_rep_vale`.`rv_repuesto`
						LEFT JOIN `manto_ot`
						ON `manto_vales`.`va_ot`=`manto_ot`.`cod_ot`
						WHERE 
							DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d')>='$FechaInicioVales' AND
							DATE_FORMAT(`manto_vales`.`va_date_genera`,'%Y-%m-%d')<='$FechaTerminoVales'
						ORDER BY
							`manto_vales`.`cod_vale` ASC	";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}   


	function vales_observadas()
	{

		$consulta = " SELECT COUNT(*) AS `cantidad_vales` FROM `manto_vales` WHERE `va_estado`='OBSERVADO' AND `va_date_genera`>'2022-12-31'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		return $data;
		$this->conexion=null;
	}

	function buscar_estado($tabla, $campo_estado, $estado, $campo_fecha, $fecha_inicio)
	{
		$consulta = " SELECT * FROM `$tabla` WHERE `$campo_estado`='$estado' AND `$campo_fecha`>'$fecha_inicio'";
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