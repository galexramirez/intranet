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

	function MaxId($TablaBD,$CampoId)
	{
		$consulta = "SELECT MAX(`$CampoId`) AS `MaxId` FROM `$TablaBD`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function MaxComponente($TablaBD,$CampoBD,$cod_buscar)
	{
		$consulta = "SELECT MAX(`$CampoBD`) AS `MaxComponente` FROM `$TablaBD` WHERE SUBSTRING(`$CampoBD`, 1, 6) = '$cod_buscar'";

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

	function AutoCompletar($NombreTabla,$NombreCampo)
	{
		$consulta="SELECT * FROM `$NombreTabla`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function auto_completar($tabla, $campo_asociado, $asociado, $campo_fecha, $fecha, $campo_tipo, $tipo)
	{
		$consulta = " SELECT * FROM `$tabla` WHERE `$tabla`.`$campo_asociado`='$asociado' AND `$campo_fecha`<'$fecha' AND `$campo_tipo`='$tipo' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function SelectAnios()
	{
		$consulta="SELECT DISTINCT `Calendario_Anio` AS Anio FROM `Calendario` WHERE `Calendario_Anio` > '2022' ORDER BY `Calendario_Anio` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		return $data;
		$this->conexion=null;
	}

	function unidad_medida()
	{
		$consulta="SELECT * FROM `manto_unidad_medida` ORDER BY `unidad_medida` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;

		$this->conexion=null;
	}

	function encontrar_dato($tabla, $campo_encontrar, $data_buscar)
	{
		$consulta="SELECT * FROM `$tabla` WHERE `$campo_encontrar` = '$data_buscar'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}
	
	function LeerMateriales()
	{
		$consulta = "SELECT *, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `roles_dni`=`material_responsablecreacion` LIMIT 1) AS `material_nombreresponsablecreacion`, IF(NOT EXISTS (SELECT `precioprov_materialid` FROM `manto_preciosproveedor` WHERE `manto_preciosproveedor`.`precioprov_materialid`=`manto_materiales`.`material_id` LIMIT 1),'NO','SI') AS `proveedor`, CONCAT(`manto_unidad_medida`.`unidad_medida`,' - ',`manto_unidad_medida`.`um_descripcion`) AS `mate_unidad_medida` FROM `manto_materiales` LEFT JOIN `manto_unidad_medida` ON `manto_unidad_medida`.`unidad_medida`=`manto_materiales`.`material_unidadmedida`";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function CrearMateriales($material_id,$material_descripcion, $material_unidadmedida, $material_patrimonial, $material_categoria,$material_estado,$material_observaciones,$material_usuario,$material_log, $material_obslog, $material_macrosistema, $material_sistema, $material_tarjeta, $material_condicion, $material_flota)
	{
        $material_responsablecreacion = $_SESSION['USUARIO_ID'];
		$material_fechacreacion = date("Y-m-d");
		$material_fechacreacion2 = date("Y-m-d H:i:s");
		$material_log2 = "<strong>".$material_estado."</strong> ".$material_fechacreacion2." ".$material_usuario." CREACIÓN : ".$material_obslog."<br>".$material_log;	

		$consulta = "INSERT INTO `manto_materiales`(`material_id`, `material_descripcion`, `material_unidadmedida`, `material_patrimonial`, `material_categoria`, `material_fechacreacion`, `material_responsablecreacion`, `material_observaciones`, `material_estado`, `material_log`, `material_macrosistema`, `material_sistema`, `material_tarjeta`, `material_condicion`, `material_flota`) VALUES ('$material_id','$material_descripcion', '$material_unidadmedida', '$material_patrimonial', '$material_categoria', '$material_fechacreacion', '$material_responsablecreacion', '$material_observaciones', '$material_estado', '$material_log2', '$material_macrosistema', '$material_sistema', '$material_tarjeta', '$material_condicion', '$material_flota')";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT *, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `roles_dni`=`material_responsablecreacion` LIMIT 1) AS `material_nombreresponsablecreacion` FROM `manto_materiales`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	

	function EditarMateriales($material_id,$material_descripcion, $material_unidadmedida, $material_patrimonial, $material_categoria,$material_observaciones,$material_usuario,$material_log,$material_estado, $material_obslog)
	{
		$material_fechacreacion2 = date("Y-m-d H:i:s");
		$material_log2 = "<strong>".$material_estado."</strong> ".$material_fechacreacion2." ".$material_usuario." EDICIÓN : ".$material_obslog."<br>".$material_log;	

		$consulta = "UPDATE `manto_materiales` SET `material_descripcion`='$material_descripcion', `material_patrimonial`='$material_patrimonial', `material_unidadmedida`= '$material_unidadmedida', `material_categoria`='$material_categoria',`material_observaciones`='$material_observaciones',`material_log`='$material_log2', `material_estado`='$material_estado' WHERE `material_id`='$material_id'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        
		$consulta = "SELECT *, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `roles_dni`=`material_responsablecreacion` LIMIT 1) AS `material_nombreresponsablecreacion` FROM `manto_materiales`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function LeerPreciosProveedor($asignarcod_ruc, $asignarcod_fecha)
	{
		$consulta = "SELECT ANY_VALUE(`manto_preciosproveedor`.`precioprov_id`) AS `precioprov_id`, `manto_preciosproveedor`.`precioprov_codproveedor`, ANY_VALUE(`manto_preciosproveedor`.`precioprov_descripcion`) AS `precioprov_descripcion`, ANY_VALUE(`manto_preciosproveedor`.`precioprov_marca`) AS `precioprov_marca`, ANY_VALUE(`manto_preciosproveedor`.`precioprov_procedencia`) AS `precioprov_procedencia`, ANY_VALUE(CONCAT(`manto_preciosproveedor`.`precioprov_unidadmedida`,' - ',`manto_unidad_medida`.`um_descripcion`)) AS `precioprov_unidadmedida`, ANY_VALUE(`manto_preciosproveedor`.`precioprov_garantia`) AS `precioprov_garantia`, ANY_VALUE(`manto_preciosproveedor`.`precioprov_moneda`) AS `precioprov_moneda`, ANY_VALUE(FORMAT(`manto_preciosproveedor`.`precioprov_precio`,2)) AS `precioprov_precio`, ANY_VALUE(FORMAT(`manto_preciosproveedor`.`precioprov_preciosoles`,2)) AS `precioprov_preciosoles`, `manto_preciosproveedor`.`precioprov_ruc`, ANY_VALUE(`manto_preciosproveedor`.`precioprov_razonsocial`) AS `precioprov_razonsocial`, ANY_VALUE(`manto_preciosproveedor`.`precioprov_materialid`) AS `precioprov_materialid`, ANY_VALUE(`manto_materiales`.`material_descripcion`) AS `precioprov_materialdescripcion`,  ANY_VALUE(`manto_preciosproveedor`.`precioprov_documentacion`) AS `precioprov_documentacion`, DATE_FORMAT(MAX(`precioprov_fechavigencia`),'%Y-%m-%d') AS `precioprov_maxfechavigencia`, ANY_VALUE(`manto_preciosproveedor`.`precioprov_cargaid`) AS `precioprov_cargaid`, ANY_VALUE((SELECT `glo_roles`.`roles_nombrecorto` FROM `glo_roles` WHERE `glo_roles`.`roles_dni`=`precioprov_responsablecreacion` LIMIT 1)) AS `precioprov_responsablecreacion`, ANY_VALUE(DATE_FORMAT(`manto_preciosproveedor`.`precioprov_fechacreacion`,'%Y-%m-%d')) AS `precioprov_fechacreacion`, ANY_VALUE(`manto_preciosproveedor`.`precioprov_estado`) AS `precioprov_estado`, ANY_VALUE(`manto_preciosproveedor`.`precioprov_log`) AS `precioprov_log`, ANY_VALUE(`precioprov_tipo`) AS `precioprov_tipo` FROM `manto_preciosproveedor` LEFT JOIN `manto_materiales` ON `manto_materiales`.`material_id` = `manto_preciosproveedor`.`precioprov_materialid` LEFT JOIN `manto_unidad_medida` ON `manto_unidad_medida`.`unidad_medida`=`manto_preciosproveedor`.`precioprov_unidadmedida` WHERE `manto_preciosproveedor`.`precioprov_ruc`='$asignarcod_ruc' AND `manto_preciosproveedor`.`precioprov_fechavigencia` <= '$asignarcod_fecha' GROUP BY `manto_preciosproveedor`.`precioprov_ruc`, `manto_preciosproveedor`.`precioprov_codproveedor`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function leer_precios_material($asignarcod_ruc, $asignarcod_fecha, $asignarcod_proveedor)
	{
		$consulta = "	SELECT 
							`manto_preciosproveedor`.`precioprov_id`, 
							`manto_preciosproveedor`.`precioprov_codproveedor`, 
							`manto_preciosproveedor`.`precioprov_descripcion`, 
							`manto_preciosproveedor`.`precioprov_marca`, 
							`manto_preciosproveedor`.`precioprov_procedencia`, 
							CONCAT(`manto_preciosproveedor`.`precioprov_unidadmedida`,' - ',`manto_unidad_medida`.`um_descripcion`) AS `precioprov_unidadmedida`, 
							`manto_preciosproveedor`.`precioprov_garantia`, 
							`manto_preciosproveedor`.`precioprov_moneda`, 
							FORMAT(`manto_preciosproveedor`.`precioprov_precio`,2) AS `precioprov_precio`, 
							FORMAT(`manto_preciosproveedor`.`precioprov_preciosoles`,2) AS `precioprov_preciosoles`, 
							`manto_preciosproveedor`.`precioprov_ruc`, 
							`manto_preciosproveedor`.`precioprov_razonsocial`, 
							`manto_preciosproveedor`.`precioprov_materialid`, 
							`manto_materiales`.`material_descripcion`,  
							`manto_preciosproveedor`.`precioprov_documentacion`, 
							DATE_FORMAT(`precioprov_fechavigencia`,'%Y-%m-%d') AS `precioprov_fechavigencia`, 
							`manto_preciosproveedor`.`precioprov_cargaid`, 
							(SELECT `colaborador`.`Colab_nombre_corto` FROM `colaborador` WHERE `colaborador`.`Colaborador_id`=`precioprov_responsablecreacion`) AS `precioprov_responsablecreacion`, 
							DATE_FORMAT(`manto_preciosproveedor`.`precioprov_fechacreacion`,'%Y-%m-%d') AS `precioprov_fechacreacion`, 
							`manto_preciosproveedor`.`precioprov_estado`, 
							`manto_preciosproveedor`.`precioprov_log`, 
							`manto_preciosproveedor`.`precioprov_tipo` 
						FROM 
							`manto_preciosproveedor` 
						LEFT JOIN 
							`manto_materiales` 
						ON 
							`manto_materiales`.`material_id` = `manto_preciosproveedor`.`precioprov_materialid` 
						LEFT JOIN 
							`manto_unidad_medida` 
						ON 
							`manto_unidad_medida`.`unidad_medida` = `manto_preciosproveedor`.`precioprov_unidadmedida` 
						WHERE 
							`manto_preciosproveedor`.`precioprov_ruc`='$asignarcod_ruc' AND 
							`manto_preciosproveedor`.`precioprov_fechavigencia` <= '$asignarcod_fecha' AND
							`manto_preciosproveedor`.`precioprov_codproveedor`='$asignarcod_proveedor'
						ORDER BY
							`precioprov_fechavigencia` DESC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
   	}   

	function CrearPreciosProveedor($precioprov_codproveedor, $precioprov_descripcion, $precioprov_marca, $precioprov_procedencia, $precioprov_unidadmedida, $precioprov_garantia, $precioprov_moneda, $precioprov_precio, $precioprov_preciosoles, $precioprov_ruc, $precioprov_razonsocial, $precioprov_materialid, $precioprov_documentacion, $precioprov_fechavigencia, $precioprov_cargaid, $precioprov_responsablecreacion, $precioprov_fechacreacion, $precioprov_estado, $precioprov_log, $precioprov_tipo)
	{
		$error		= [];
		$consulta 	= "INSERT INTO `manto_preciosproveedor` (`precioprov_codproveedor`, `precioprov_descripcion`, `precioprov_marca`, `precioprov_procedencia`, `precioprov_unidadmedida`, `precioprov_garantia`, `precioprov_moneda`, `precioprov_precio`, `precioprov_preciosoles`, `precioprov_ruc`, `precioprov_razonsocial`, `precioprov_materialid`, `precioprov_documentacion`, `precioprov_fechavigencia`, `precioprov_cargaid`, `precioprov_responsablecreacion`, `precioprov_fechacreacion`, `precioprov_estado`, `precioprov_log`, `precioprov_tipo`) VALUES ('$precioprov_codproveedor', '$precioprov_descripcion', '$precioprov_marca', '$precioprov_procedencia', '$precioprov_unidadmedida', '$precioprov_garantia', '$precioprov_moneda', '$precioprov_precio', '$precioprov_preciosoles', '$precioprov_ruc', '$precioprov_razonsocial', '$precioprov_materialid', '$precioprov_documentacion', '$precioprov_fechavigencia', '$precioprov_cargaid', '$precioprov_responsablecreacion', '$precioprov_fechacreacion', '$precioprov_estado', '$precioprov_log', '$precioprov_tipo')";

		$resultado 	= $this->conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		$valida 	= $resultado->rowCount();
		
		if($valida == 0){
			$error = $resultado->errorInfo();
		}

		return $error;
		$this->conexion=null;	
	}  	

	function buscar_codigo_proveedor( $precioprov_codproveedor, $precioprov_descripcion, $precioprov_unidadmedida, $precioprov_ruc, $precioprov_materialid )
	{
		$repp_estado = "ACTIVO";
		$consulta = " SELECT `repp_codigo` FROM `manto_repuesto_proveedor` WHERE `repp_codigo`='$precioprov_codproveedor' AND `repp_prov_ruc`='$precioprov_ruc' AND `repp_descripcion`='$precioprov_descripcion' AND `repp_unidad`='$precioprov_unidadmedida' AND `repp_estado`='$repp_estado' AND `repp_material_id`='$precioprov_materialid'";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $row){
			$repp_codigo = $row['repp_codigo'];
		}

        return $repp_codigo;
        $this->conexion=null;
	}
	function BuscarCodigoMateriales($ttablamateriales_tipo, $ttablamateriales_operacion, $ttablamateriales_detalle, $caracteres)
	{
		$consulta = "SELECT * FROM `manto_tipotablamateriales` WHERE `ttablamateriales_tipo` = '$ttablamateriales_tipo' AND `ttablamateriales_operacion` = '$ttablamateriales_operacion' AND SUBSTRING(`ttablamateriales_detalle`, 1, $caracteres) = '$ttablamateriales_detalle'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function LeerProveedores()
	{
        $consulta="SELECT * FROM `manto_proveedores`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function CrearProveedores($prov_ruc,$prov_razonsocial,$prov_contacto,$prov_cta_detraccion_soles,$prov_cta_banco_soles,$prov_cta_banco_dolares,$prov_cta_interbanco_soles,$prov_cta_interbanco_dolares,$prov_condicion_pago,$prov_correo,$prov_telefono,$prov_estado,$prov_log)
	{
		$consulta = "INSERT INTO `manto_proveedores`(`prov_ruc`, `prov_razonsocial`, `prov_contacto`, `prov_cta_detraccion_soles`, `prov_cta_banco_soles`,`prov_cta_banco_dolares`, `prov_cta_interbanco_soles`,`prov_cta_interbanco_dolares`, `prov_condicion_pago`, `prov_correo`, `prov_telefono`, `prov_estado`, `prov_log`) VALUES ('$prov_ruc','$prov_razonsocial','$prov_contacto','$prov_cta_detraccion_soles','$prov_cta_banco_soles','$prov_cta_banco_dolares','$prov_cta_interbanco_soles','$prov_cta_interbanco_dolares','$prov_condicion_pago','$prov_correo','$prov_telefono','$prov_estado', '$prov_log')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `manto_proveedores`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;	
	}  	
	
	function EditarProveedores($prov_ruc,$prov_razonsocial,$prov_contacto,$prov_cta_detraccion_soles,$prov_cta_banco_soles,$prov_cta_banco_dolares,$prov_cta_interbanco_soles,$prov_cta_interbanco_dolares,$prov_condicion_pago,$prov_correo,$prov_telefono,$prov_estado, $prov_log)
	{
		$consulta = "UPDATE `manto_proveedores` SET `prov_razonsocial`='$prov_razonsocial',`prov_contacto`='$prov_contacto',`prov_cta_detraccion_soles`='$prov_cta_detraccion_soles',`prov_cta_banco_soles`='$prov_cta_banco_soles', `prov_cta_banco_dolares`='$prov_cta_banco_dolares',`prov_cta_interbanco_soles`='$prov_cta_interbanco_soles', `prov_cta_interbanco_dolares`='$prov_cta_interbanco_dolares', `prov_condicion_pago`='$prov_condicion_pago', `prov_correo`='$prov_correo',`prov_telefono`='$prov_telefono', `prov_estado`='$prov_estado', `prov_log`='$prov_log' WHERE `prov_ruc`='$prov_ruc'";		

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_proveedores` WHERE `prov_ruc` ='$prov_ruc'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		

	function leer_repuesto_proveedor($repp_prov_ruc)
	{
        $consulta = "SELECT * FROM `manto_repuesto_proveedor` WHERE `repp_prov_ruc`='$repp_prov_ruc'";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   

	function crear_repuesto_proveedor($repp_prov_ruc, $repp_codigo, $repp_descripcion, $repp_unidad, $repp_estado, $repp_material_id, $repp_material_descripcion, $repp_log)
	{
		$repp_fecha_registro = date("Y-m-d H:i:s");
		$responsable_creacion = $_SESSION['USUARIO_ID'];
		$repp_log = "<strong>".$repp_estado."</strong> ".$repp_fecha_registro." ".$responsable_creacion." CREACION ";

		$consulta = " INSERT INTO `manto_repuesto_proveedor`(`repp_codigo`, `repp_descripcion`, `repp_unidad`, `repp_estado`, `repp_prov_ruc`, `repp_fecha_registro`,  `repp_material_id`, `repp_material_descripcion`, `repp_log`) VALUES ('$repp_codigo', '$repp_descripcion', '$repp_unidad', '$repp_estado', '$repp_prov_ruc', '$repp_fecha_registro',  '$repp_material_id', '$repp_material_descripcion', '$repp_log') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  	
	
	function editar_repuesto_proveedor($repp_prov_ruc, $repp_codigo, $repp_descripcion, $repp_unidad, $repp_estado, $repp_material_id, $repp_material_descripcion, $repp_log)
	{
		$repp_fecha_registro = date("Y-m-d H:i:s");
		$responsable_creacion = $_SESSION['USUARIO_ID'];
		$repp_log = "<strong>".$repp_estado."</strong> ".$repp_fecha_registro." ".$responsable_creacion." EDICION <br>".$repp_log;

		$consulta = " UPDATE `manto_repuesto_proveedor` SET `repp_descripcion` = '$repp_descripcion', `repp_unidad` = '$repp_unidad', `repp_estado` = '$repp_estado',  `repp_material_id`='$repp_material_id', `repp_material_descripcion`='$repp_material_descripcion', `repp_log` = '$repp_log' WHERE `repp_codigo` = '$repp_codigo' AND `repp_prov_ruc` = '$repp_prov_ruc'";		

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function LeerCargarPrecios($Anios)
	{
		$consulta = "SELECT `cpm_id`, `cpm_nroregistros`, UPPER(DATE_FORMAT(`cpm_fechacarga`, '%Y-%m-%d %W')) AS `cpm_fechacarga`, (SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `manto_cargapreciomateriales`.`cpm_responsablecarga` = `glo_roles`.`roles_dni` LIMIT 1) AS `cpm_responsablecarga`, UPPER(DATE_FORMAT(`cpm_fechaeliminacion`, '%Y-%m-%d %W')) AS `cpm_fechaeliminacion`,(SELECT `roles_nombrecorto` FROM `glo_roles` WHERE `manto_cargapreciomateriales`.`cpm_responsableeliminacion` = `glo_roles`.`roles_dni` LIMIT 1) AS `cpm_responsableeliminacion`, `cpm_estado`, `cpm_prov_razon_social` FROM `manto_cargapreciomateriales` WHERE SUBSTRING(`cpm_fechacarga`,1,4)='$Anios'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}   

	function CrearCargarPrecios($cpm_nroregistros, $cpm_fechacarga, $cpm_responsablecarga, $cpm_estado, $cpm_prov_ruc, $cpm_prov_razon_social)
	{
		$consulta = "INSERT INTO `manto_cargapreciomateriales` (`cpm_nroregistros`, `cpm_fechacarga`, `cpm_responsablecarga`, `cpm_estado`, `cpm_prov_ruc`, `cpm_prov_razon_social`) VALUES ('$cpm_nroregistros', '$cpm_fechacarga', '$cpm_responsablecarga', '$cpm_estado', '$cpm_prov_ruc', '$cpm_prov_razon_social')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}  	

	function LeerAsignarCodigos($asignarcod_ruc, $asignarcod_tipo)
	{
		$c_where = "";
		if($asignarcod_tipo == "SIN ASIGNAR"){
			$c_where = "AND `manto_preciosproveedor`.`precioprov_materialid`=''";
		}
		if($asignarcod_tipo == "SIN DOCUMENTACION"){
			$c_where = "AND `manto_preciosproveedor`.`precioprov_documentacion`='NO'";
		}
		if($asignarcod_tipo == "SIN ASIGNAR - SIN DOCUMENTACION"){
			$c_where = "AND `manto_preciosproveedor`.`precioprov_materialid`='' AND `manto_preciosproveedor`.`precioprov_documentacion`='NO'";
		}

		$consulta = "SELECT DISTINCT `manto_preciosproveedor`.`precioprov_codproveedor`, ANY_VALUE(`manto_preciosproveedor`.`precioprov_descripcion`) AS `precioprov_descripcion`, ANY_VALUE(CONCAT(`manto_preciosproveedor`.`precioprov_unidadmedida`,' - ',`manto_unidad_medida`.`um_descripcion`)) AS `precioprov_unidadmedida`, `manto_preciosproveedor`.`precioprov_ruc`, ANY_VALUE(`manto_proveedores`.`prov_razonsocial`) AS `precioprov_razonsocial`, `manto_preciosproveedor`.`precioprov_materialid`, `manto_materiales`.`material_descripcion` FROM `BDLIMABUS`.`manto_preciosproveedor` LEFT JOIN `BDLIMABUS`.`manto_materiales` ON `manto_materiales`.`material_id`=`manto_preciosproveedor`.`precioprov_materialid` LEFT JOIN `manto_unidad_medida` ON `manto_unidad_medida`.`unidad_medida`=`manto_preciosproveedor`.`precioprov_unidadmedida` LEFT JOIN `manto_proveedores` ON `manto_proveedores`.`prov_ruc`=`manto_preciosproveedor`.`precioprov_ruc` WHERE `manto_preciosproveedor`.`precioprov_ruc`='$asignarcod_ruc' ".$c_where;

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

		$this->conexion=null;
	}

	function BuscarAsignarCodigos($precioprov_codproveedor, $precioprov_ruc)
	{
		$consulta = "SELECT * FROM `manto_preciosproveedor` WHERE `precioprov_codproveedor`='$precioprov_codproveedor' AND `precioprov_ruc`='$precioprov_ruc'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        return $data;

        $this->conexion=null;	
	}

	function EditarAsignarCodigos($precioprov_id, $precioprov_materialid, $precioprov_estado, $precioprov_log)
	{
		$consulta = "UPDATE `manto_preciosproveedor` SET `precioprov_materialid`='$precioprov_materialid', `precioprov_estado`='$precioprov_estado', `precioprov_log`='$precioprov_log' WHERE `precioprov_id`='$precioprov_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

        $this->conexion=null;	
	}

	function GrabarImagen($matimag_codproveedor, $matimag_ruc, $matimag_tipoimagen, $matimag_imagen, $matimag_usuarioid, $matimag_fecha, $matimag_log)
	{
		$consulta="INSERT INTO `manto_materialesimagen`(`matimag_codproveedor`,	`matimag_ruc`, `matimag_tipoimagen`, `matimag_imagen`, `matimag_usuarioid`, `matimag_fecha`, `matimag_log`) VALUES ('$matimag_codproveedor', '$matimag_ruc', '$matimag_tipoimagen', '$matimag_imagen', '$matimag_usuarioid', '$matimag_fecha', '$matimag_log')";

		$resultado = $this->conexion->prepare($consulta);
 		$resultado->execute();
 		$this->conexion=null;
 	}

	function EditarImagen($matimag_codproveedor, $matimag_ruc, $matimag_tipoimagen, $matimag_imagen, $matimag_usuarioid, $matimag_fecha, $matimag_log)
	{
		$consulta="UPDATE `manto_materialesimagen` SET `matimag_imagen` = '$matimag_imagen', `matimag_log` = '$matimag_log' WHERE `matimag_codproveedor`='$matimag_codproveedor' AND `matimag_ruc`='$matimag_ruc' AND `matimag_tipoimagen`='$matimag_tipoimagen'";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
 		$this->conexion=null;
	}
 
	function BuscarImagen($matimag_codproveedor, $matimag_ruc, $matimag_tipoimagen)
	{
		$consulta="SELECT TO_BASE64 (`matimag_imagen`) AS `b64_Foto` FROM `manto_materialesimagen` WHERE `matimag_codproveedor`='$matimag_codproveedor' AND `matimag_ruc`='$matimag_ruc' AND `matimag_tipoimagen`='$matimag_tipoimagen'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

  		$this->conexion=null;	
	}  		

	function BuscarLogImagen($matimag_codproveedor, $matimag_ruc, $matimag_tipoimagen)
	{
		$consulta="SELECT `matimag_log` FROM `manto_materialesimagen` WHERE `matimag_codproveedor`='$matimag_codproveedor' AND `matimag_ruc`='$matimag_ruc' AND `matimag_tipoimagen`='$matimag_tipoimagen'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
  		$this->conexion=null;	
	}  		

	function AnularPreciosProveedor($precioprov_id, $precioprov_estado, $precioprov_log)
	{
		$consulta="UPDATE `manto_preciosproveedor` SET `precioprov_estado` = '$precioprov_estado', `precioprov_log` = '$precioprov_log' WHERE `precioprov_id`='$precioprov_id'";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
 		$this->conexion=null;
	}

	function EliminarCargarPreciosProveedor($cpm_id)
	{
		$cpm_estado = "ELIMINADO";
		$cpm_fechaeliminacion = date("Y-m-d H:i:s");
        $cpm_esponsableeliminacion = $_SESSION['USUARIO_ID'];
		$consulta="UPDATE `manto_cargarpreciosmateriales` SET `cpm_estado` = '$cpm_estado', `cpm_fechaeliminacion` = '$cpm_fechaeliminacion', `cpm_responsableeliminacion` = '$cpm_esponsableeliminacion' WHERE `cpm_id`='$cpm_id'";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
 		$this->conexion=null;
	}

	function EditarDocumentacion($precioprov_id, $precioprov_documentacion, $precioprov_log)
	{
		$consulta = "UPDATE `manto_preciosproveedor` SET `precioprov_documentacion`='$precioprov_documentacion', `precioprov_log`='$precioprov_log' WHERE `precioprov_id`='$precioprov_id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

        $this->conexion=null;	
	}

	function leer_tc_material_usuario()
	{
		$tc_variable = 'USUARIO';
		$consulta="SELECT * FROM `manto_tc_material` WHERE `tc_variable`='$tc_variable'";
   
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
   
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;
	}   
   
	function crear_tc_material_usuario($tc_material_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
		$tc_variable = 'USUARIO';
		$consulta = "INSERT INTO `manto_tc_material`(`tc_variable`, `tc_categoria1`, `tc_categoria2`, `tc_categoria3`) VALUES ('$tc_variable', '$tc_categoria1','$tc_categoria2','$tc_categoria3')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta = "SELECT * FROM `manto_tc_material` WHERE `tc_variable`='$tc_variable'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		  
	   	$this->conexion=null;	
	}  	
	
	function editar_tc_material_usuario($tc_material_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
	  	$consulta = "UPDATE `manto_tc_material` SET `tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2',`tc_categoria3`='$tc_categoria3' 	WHERE`tc_material_id`='$tc_material_id'";		
	  	$resultado = $this->conexion->prepare($consulta);
	  	$resultado->execute();   
		
	  	$consulta= "SELECT * FROM `manto_tc_material` WHERE `tc_material_id` ='$tc_material_id'";
	  	$resultado = $this->conexion->prepare($consulta);
	  	$resultado->execute();        
	  	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	  	print json_encode($data, JSON_UNESCAPED_UNICODE);
	  	$this->conexion=null;	
	}  		
	   
	function borrar_tc_material_usuario($tc_material_id)
	{
		$consulta = "DELETE FROM `manto_tc_material` WHERE `tc_material_id`='$tc_material_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}
   
	function leer_tc_material_sistema()
	{
		$tc_variable = 'SISTEMA';
		$consulta="SELECT * FROM `manto_tc_material` WHERE `tc_variable`='$tc_variable'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;
	}   
   
	function crear_tc_material_sistema($tc_material_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
		$tc_variable = 'SISTEMA';
		$consulta = "INSERT INTO `manto_tc_material`(`tc_variable`, `tc_categoria1`, `tc_categoria2`, `tc_categoria3`) VALUES ('$tc_variable', '$tc_categoria1','$tc_categoria2','$tc_categoria3')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
   
		$consulta = "SELECT * FROM `manto_tc_material` WHERE `tc_variable`='$tc_variable'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		  
		$this->conexion=null;	
	}  	
	   
	function editar_tc_material_sistema($tc_material_id, $tc_categoria1, $tc_categoria2, $tc_categoria3)
	{
		$consulta = "UPDATE `manto_tc_material` SET `tc_categoria1`='$tc_categoria1',`tc_categoria2`='$tc_categoria2',`tc_categoria3`='$tc_categoria3'WHERE`tc_material_id`='$tc_material_id'";	

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_tc_material` WHERE `tc_material_id` ='$tc_material_id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;	
	}  		
	   
	function borrar_tc_material_sistema($tc_material_id)
	{
		$consulta = "DELETE FROM `manto_tc_material` WHERE `tc_material_id`='$tc_material_id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}

	function leer_unidad()
	{
        $consulta="SELECT * FROM `manto_unidad_medida`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   
		 
	function crear_unidad($unidad_medida, $um_descripcion)
	{
		$consulta = "INSERT INTO `manto_unidad_medida`(`unidad_medida`, `um_descripcion`) VALUES ('$unidad_medida', '$um_descripcion')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "SELECT * FROM `manto_unidad_medida`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;	
	}  	
	
	function editar_unidad($unidad_medida, $um_descripcion)
	{
		$consulta = "UPDATE `manto_unidad_medida` SET `um_descripcion`='$um_descripcion' WHERE `unidad_medida`='$unidad_medida'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta= "SELECT * FROM `manto_unidad_medida` WHERE `unidad_medida` ='$unidad_medida'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;	
	}  		
	
	function borrar_unidad($unidad_medida)
	{
		$consulta = "DELETE FROM `manto_unidad_medida` WHERE `unidad_medida`='$unidad_medida'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
        $this->conexion=null;	
	}  		

}