<?php
session_start();
class CRUD
{	
	var $conexion;
	var $conexio2;
	var $objeto;

	function __construct()
	{
		if (!isset($_SESSION['USUARIO_ID'])){
			session_destroy();
			echo '<script>window.location.href = "LogOut";</script>';
			exit();
		}
		SController('ConexionesBD','C_ConexionBD');
		$Instancia			= new C_ConexionesBD();
		$this->conexion		= $Instancia->Conectar();
		$this->conexion2	= $Instancia->conectar2();
	}

	///:: FACILITADOR CARGA :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

	function LeerFacilitadorCarga($Calendario_Semana)
	{
		$consulta = "SELECT `CFaRg_Id`, UPPER(DATE_FORMAT(`CFaRg_FechaCargada`, '%Y-%m-%d %W')) AS `CFaRg_FechaCargada`, `CFaRg_TipoOperacionCargada`, DATE_FORMAT(`CFaRg_FechaGenerar`,'%Y-%m-%d %H:%i:%s') AS `CFaRg_FechaGenerar`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitadorRegistroCarga`.`CFaRg_UsuarioId_Generar` = `colaborador`.`Colaborador_id`) AS `CFaRg_UsuarioId_Generar`, DATE_FORMAT(`CFaRg_FechaCerrar`,'%Y-%m-%d %H:%i:%s') AS `CFaRg_FechaCerrar`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitadorRegistroCarga`.`CFaRg_UsuarioId_Cerrar` = `colaborador`.`Colaborador_id`) AS `CFaRg_UsuarioId_Cerrar`, DATE_FORMAT(`CFaRg_FechaEliminar`,'%Y-%m-%d %H:%i:%s') AS `CFaRg_FechaEliminar`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitadorRegistroCarga`.`CFaRg_UsuarioId_Eliminar` = `colaborador`.`Colaborador_id`) AS `CFaRg_UsuarioId_Eliminar`, `CFaRg_Estado` FROM `OPE_ControlFacilitadorRegistroCarga` LEFT JOIN `Calendario` ON `CFaRg_FechaCargada`=`Calendario_Id` WHERE `Calendario_Semana`='$Calendario_Semana' ORDER BY `CFaRg_FechaCargada` DESC ";
		
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;
   	}   

	function BorrarFacilitadorCarga($CFaRg_Id)
	{
		$CFaRg_FechaEliminar = date("Y-m-d H:i:s");
		$CFaRg_UsuarioId_Eliminar = $_SESSION['USUARIO_ID'];		
		$CFaRg_Estado = "ELIMINADO";

		$consulta = "UPDATE `OPE_ControlFacilitadorRegistroCarga` SET `CFaRg_Estado`='$CFaRg_Estado', `CFaRg_FechaEliminar`='$CFaRg_FechaEliminar', `CFaRg_UsuarioId_Eliminar`='$CFaRg_UsuarioId_Eliminar'  WHERE `CFaRg_Id`='$CFaRg_Id'";		
  		$resultado = $this->conexion->prepare($consulta);

		$resultado->execute();   
        $this->conexion=null;	
	}  		

	function BuscarFacilitadorCarga($CFaRg_FechaCargada,$CFaRg_TipoOperacionCargada)
	{
		$CFaRg_Estado1 = "GENERADO";
		$CFaRg_Estado2 = "CERRADO";

		$consulta="SELECT * FROM `OPE_ControlFacilitadorRegistroCarga` WHERE `CFaRg_FechaCargada`='$CFaRg_FechaCargada' AND `CFaRg_TipoOperacionCargada`='$CFaRg_TipoOperacionCargada' AND (`CFaRg_Estado` = '$CFaRg_Estado1' OR `CFaRg_Estado` = '$CFaRg_Estado2' )";
   		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$valida = $resultado->rowCount();
		
		if($valida==0){
			return true; 
		}else{
			return false;
		}
		
		$this->conexion=null;
	}

	function AniosFacilitadorCarga()
	{
		$consulta="SELECT DISTINCT `Calendario_Anio` AS Anio FROM `Calendario` WHERE `Calendario_Anio` > '2021' ORDER BY `Calendario_Anio` DESC";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        return $data;
		$this->conexion=null;
   	}   
   
	function SemanasFacilitadorCarga($Calendario_Anio)
	{
        $consulta="SELECT DISTINCT `Calendario_Semana` AS Semana FROM `Calendario` WHERE `Calendario_Anio`='$Calendario_Anio' ORDER BY `Calendario_Semana` DESC ";
 
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);
        return $data;
		$this->conexion=null;
   	}   

	function BuscarSemanaFacilitadorCarga($CFaRg_FechaCargada,$Semana)
	{
		$consulta="SELECT * FROM `Calendario` WHERE `Calendario_Id`='$CFaRg_FechaCargada' AND `Calendario_Semana`='$Semana'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$valida = $resultado->rowCount();
	
		if($valida==0){
			return false; 
		}else{
			return true;
		}

	   $this->conexion=null;
	}
   
	function DetalleFacilitador($CFaRg_FechaCargada,$CFaRg_TipoOperacionCargada,$Opcion)
	{
		$consulta="SELECT * FROM `Programacion` WHERE `Prog_Fecha`='$CFaRg_FechaCargada' AND `Prog_Operacion`='$CFaRg_TipoOperacionCargada' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		if($Opcion==1){
			$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		}else{
			$data=$resultado->rowCount();
		}
		return $data;
		$this->conexion=null;
	}   
	
	function CrearDetalleFacilitador($Programacion_Id,$Prog_Codigo,$Prog_Operacion,$Prog_Fecha,$Prog_Dni,$Prog_CodigoColaborador,$Prog_NombreColaborador,$Prog_Tabla,$Prog_HoraOrigen,$Prog_HoraDestino,$Prog_Servicio,$Prog_ServBus,$Prog_Bus,$Prog_LugarOrigen,$Prog_LugarDestino,$Prog_TipoEvento,$Prog_Observaciones,$Prog_KmXPuntos,$Prog_TipoTabla,$Prog_NPlaca,$Prog_NVid, $CFaRg_Id, $CFaci_Estado, $Prog_IdManto, $Prog_Sentido, $Prog_BusManto, $Prog_Viajes, $CFaci_Campo1, $CFaci_Campo2, $CFaci_Campo3)
	{
		
		$CFaci_UsuarioId = $_SESSION['USUARIO_ID'];		
		$CFaci_ProcesoOrigen = "PROGRAMACION"; // 0:Proviene de Programacion, 1:Proviene de Control Facilitador
		$CFaci_Novedad = "NO"; // [SI] NOVEDAD, [NO] NOVEDAD
		$CFaci_Version = 1;
	 	
		$consulta = "INSERT INTO `OPE_ControlFacilitador`(`Programacion_Id`,`Prog_Codigo`, `Prog_Operacion`, `Prog_Fecha`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`,`CFaRg_Id`, `CFaci_Estado`, `CFaci_UsuarioId`, `CFaci_ProcesoOrigen`, `CFaci_Novedad`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, `CFaci_Version`, `Prog_Viajes`, `CFaci_Campo1`, `CFaci_Campo2`, `CFaci_Campo3`) VALUES ('$Programacion_Id','$Prog_Codigo','$Prog_Operacion','$Prog_Fecha','$Prog_Dni','$Prog_CodigoColaborador','$Prog_NombreColaborador','$Prog_Tabla','$Prog_HoraOrigen','$Prog_HoraDestino',TRIM('$Prog_Servicio'),'$Prog_ServBus','$Prog_Bus',TRIM('$Prog_LugarOrigen'),TRIM('$Prog_LugarDestino'),TRIM('$Prog_TipoEvento'),'$Prog_Observaciones','$Prog_KmXPuntos','$Prog_TipoTabla','$Prog_NPlaca','$Prog_NVid','$CFaRg_Id','$CFaci_Estado','$CFaci_UsuarioId','$CFaci_ProcesoOrigen','$CFaci_Novedad','$Prog_IdManto', '$Prog_Sentido','$Prog_BusManto','$CFaci_Version', '$Prog_Viajes', '$CFaci_Campo1', '$CFaci_Campo2', '$CFaci_Campo3')";
	 	$resultado = $this->conexion->prepare($consulta);
	 	$resultado->execute();   

		$valida = $resultado->rowCount();
	
		if($valida==0){
			return false; 
		}else{
			return true;
		}

		$this->conexion=null;	
	}

	function CrearFacilitadorCarga($CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada)
	{
	 	$CFaRg_FechaGenerar = date("Y-m-d H:i:s");
		$CFaRg_UsuarioId_Generar = $_SESSION['USUARIO_ID'];
		$CFaRg_Estado = "GENERADO";
	 
		$consulta1 = "INSERT INTO `OPE_ControlFacilitadorRegistroCarga`(`CFaRg_FechaCargada`, `CFaRg_TipoOperacionCargada`, `CFaRg_FechaGenerar`, `CFaRg_UsuarioId_Generar`,`CFaRg_Estado`) VALUES ('$CFaRg_FechaCargada','$CFaRg_TipoOperacionCargada','$CFaRg_FechaGenerar','$CFaRg_UsuarioId_Generar','$CFaRg_Estado')";
		$resultado1 = $this->conexion->prepare($consulta1);
		$resultado1->execute();

		$consulta2= "SELECT * FROM OPE_ControlFacilitadorRegistroCarga WHERE `CFaRg_FechaCargada`='$CFaRg_FechaCargada' AND `CFaRg_TipoOperacionCargada`='$CFaRg_TipoOperacionCargada' AND `CFaRg_Estado`='$CFaRg_Estado' ";
		$resultado2 = $this->conexion->prepare($consulta2);
		$resultado2->execute();
		$data=$resultado2->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row){
            $CFaRg_Id = $row['CFaRg_Id'];
        }
		return $CFaRg_Id;
		$this->conexion=null;

	}  	

	function CerrarFacilitadorCarga($CFaRg_Id)
	{
		 $CFaRg_FechaCerrar = date("Y-m-d H:i:s");
		 $CFaRg_UsuarioId_Cerrar = $_SESSION['USUARIO_ID'];
		 $CFaRg_Estado = "CERRADO";
 
		 $consulta = "UPDATE `OPE_ControlFacilitadorRegistroCarga` SET `CFaRg_Estado`='$CFaRg_Estado', `CFaRg_FechaCerrar`='$CFaRg_FechaCerrar', `CFaRg_UsuarioId_Cerrar`='$CFaRg_UsuarioId_Cerrar'  WHERE `CFaRg_Id`='$CFaRg_Id'";		
		 $resultado = $this->conexion->prepare($consulta);
 
		 $resultado->execute();   
		 $this->conexion=null;	
	}  		
	
	function BorrarDetalleFacilitador($CFaRg_Id, $CFaRg_FechaCargada)
	{
		$consulta  = "DELETE FROM `OPE_ControlFacilitador` WHERE `CFaRg_Id`='$CFaRg_Id'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
		
		$consulta  = "DELETE FROM `OPE_ControlFacilitadorEDT` WHERE `CFaRg_Id`='$CFaRg_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta  = "DELETE FROM `ope_despachoflota` WHERE `Prog_Fecha`='$CFaRg_FechaCargada'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta  = "DELETE FROM `ope_despachoflotaregistrocarga` WHERE `dfrg_fecha`='$CFaRg_FechaCargada'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta  = "DELETE FROM `OPE_ControlFacilitadorReportes` WHERE `Repo_CFaRgId`='$CFaRg_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$this->conexion=null;	
  	}  		

	function buscar_control_facilitador($CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada) // BDLIMABUS En lógico para el cierre del control facilitador carga
	{
		$consulta = " SELECT * FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$CFaRg_FechaCargada' AND `Prog_Operacion`='$CFaRg_TipoOperacionCargada' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;	
	}  		
  
	function crear_control_facilitador_historico($CFaRg_Id)
	{
		$consulta = " INSERT INTO `bdlimabus_hist`.`OPE_ControlFacilitador`	(`ControlFacilitador_Id`, `Programacion_Id`, `Prog_Codigo`, `Prog_Operacion`, `Prog_Fecha`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, `Prog_Viajes`, `CFaRg_Id`, `CFaci_Estado`, `CFaci_UsuarioId`, `CFaci_Novedad`, `CFaci_ProcesoOrigen`, `CFaci_Version`, `CFaci_Campo1`, `CFaci_Campo2`, `CFaci_Campo3`) SELECT `ControlFacilitador_Id`, `Programacion_Id`, `Prog_Codigo`, `Prog_Operacion`, `Prog_Fecha`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, `Prog_Viajes`, `CFaRg_Id`, `CFaci_Estado`, `CFaci_UsuarioId`, `CFaci_Novedad`, `CFaci_ProcesoOrigen`, `CFaci_Version`, `CFaci_Campo1`, `CFaci_Campo2`, `CFaci_Campo3` FROM `BDLIMABUS`.`OPE_ControlFacilitador` WHERE `OPE_ControlFacilitador`.`CFaRg_Id`='$CFaRg_Id' ";

		$resultado = $this->conexion2->prepare($consulta);
  	 	$resultado->execute();
  		$this->conexion2 = null;
	}

	function borrar_control_facilitador($CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada) // BDLIMABUS En lógico elimina control facilitador por día y operación para copiarlos a bdlimabus_hist
	{
		$consulta = "DELETE FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$CFaRg_FechaCargada' AND `Prog_Operacion`='$CFaRg_TipoOperacionCargada'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$this->conexion = null;	
	}
	  
	//:: DETALLE DEL CONTROL FACILITADOR ::::::::::::::::::::::::::::::::::::::::::::::::::://

	function LeerControlFacilitador($Prog_Fecha, $Prog_Operacion, $ViajesCancelados) // BDLIMABUS consulta datatable y estado GENERADO 
	{
		$Prog_TipoEvento 			= "ANULADO";
		$twhere_viajes_cancelados 	= "";

		if($ViajesCancelados=="NO"){
			$twhere_viajes_cancelados = " AND `OPE_ControlFacilitador`.`Prog_TipoEvento`<>'$Prog_TipoEvento' ";
		}

		$consulta 	= "SET @bus=''; SET @colBus=0; SET @tabla=''; SET @colTabla=0;";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$consulta 	= "SELECT 
						`OPE_ControlFacilitador`.`ControlFacilitador_Id`,
						`OPE_ControlFacilitador`.`Prog_CodigoColaborador`,
						`OPE_ControlFacilitador`.`Prog_NombreColaborador`,
						`OPE_ControlFacilitador`.`Prog_Tabla`,
						TIME_FORMAT(`OPE_ControlFacilitador`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`,
						TIME_FORMAT(`OPE_ControlFacilitador`.`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`,
						`OPE_ControlFacilitador`.`Prog_Servicio`,
						`OPE_ControlFacilitador`.`Prog_ServBus`,
						`OPE_ControlFacilitador`.`Prog_Bus`,
						`OPE_ControlFacilitador`.`Prog_LugarOrigen`,
						`OPE_ControlFacilitador`.`Prog_LugarDestino`,
						`OPE_ControlFacilitador`.`Prog_TipoEvento`,
						`OPE_ControlFacilitador`.`Prog_Observaciones`,
						ROUND(`OPE_ControlFacilitador`.`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`,
						`OPE_ControlFacilitador`.`Prog_TipoTabla`,
						`OPE_ControlFacilitador`.`Prog_NPlaca`,
						`OPE_ControlFacilitador`.`Prog_NVid`,
						`OPE_ControlFacilitador`.`Prog_IdManto`,
						`OPE_ControlFacilitador`.`Prog_Sentido`,
						`OPE_ControlFacilitador`.`Prog_BusManto`,
						IF(`OPE_ControlFacilitador`.`CFaci_Novedad`='SI', IF(`t1`.`CNove_TipoOrigen`='CREACION','CREACION',`OPE_ControlFacilitador`.`CFaci_Novedad`),`OPE_ControlFacilitador`.`CFaci_Novedad`) AS `CFaci_Novedad`,
						`OPE_ControlFacilitadorReportes`.`Repo_Estado` AS `CFaci_Reporte`,
						IF(@bus!=`OPE_ControlFacilitador`.`Prog_Bus`, IF(@colBus=0, @colBus:=1, @colBus:=0 ), @colBus:= @colBus ) AS `Prog_colBus`,
						(CASE WHEN @bus!=`OPE_ControlFacilitador`.`Prog_Bus` THEN @bus:=`OPE_ControlFacilitador`.`Prog_Bus` END ) AS `xB`,IF(@tabla!=`OPE_ControlFacilitador`.`Prog_Tabla`, IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`,
						(CASE WHEN @tabla!=`OPE_ControlFacilitador`.`Prog_Tabla` THEN @tabla:=`OPE_ControlFacilitador`.`Prog_Tabla` END ) AS `xT`,
						`OPE_ControlFacilitador`.`Prog_Viajes`,
						`OPE_ControlFacilitador`.`CFaci_Campo1`,
						`OPE_ControlFacilitador`.`CFaci_Campo2`,
						`OPE_ControlFacilitador`.`CFaci_Campo3`,
						IF(`OPE_ControlFacilitadorEDT`.`Prog_Bus`!=`OPE_ControlFacilitador`.`Prog_Bus`,IF(`OPE_ControlFacilitadorEDT`.`Prog_Dni`!=`OPE_ControlFacilitador`.`Prog_Dni`, CONCAT_WS('  |  ',`OPE_ControlFacilitadorEDT`.`Prog_Bus`,CONCAT_WS(' - ',`OPE_ControlFacilitadorEDT`.`Prog_CodigoColaborador`,`OPE_ControlFacilitadorEDT`.`Prog_NombreColaborador`)),`OPE_ControlFacilitadorEDT`.`Prog_Bus`),IF(`OPE_ControlFacilitadorEDT`.`Prog_Dni`!=`OPE_ControlFacilitador`.`Prog_Dni`,CONCAT_WS(' - ',`OPE_ControlFacilitadorEDT`.`Prog_CodigoColaborador`,`OPE_ControlFacilitadorEDT`.`Prog_NombreColaborador`),'')) AS `Prog_CambiosBusPiloto`
					FROM 
						`OPE_ControlFacilitador` 
					LEFT JOIN 
						`OPE_ControlFacilitadorEDT` 
					ON 
						`OPE_ControlFacilitadorEDT`.`ControlFacilitador_Id`=`OPE_ControlFacilitador`.`ControlFacilitador_Id` AND
						`OPE_ControlFacilitadorEDT`.`CFaci_Version`='1'
					LEFT JOIN
						( SELECT DISTINCT `CNove_ControlFacilitadorId`, `CNove_TipoOrigen` FROM `OPE_ControlCambiosNovedad` WHERE `CNove_TipoOrigen`='CREACION') AS `t1`
					ON 
						`t1`.`CNove_ControlFacilitadorId`=`OPE_ControlFacilitador`.`ControlFacilitador_Id`  AND `t1`.`CNove_TipoOrigen`='CREACION'
					LEFT JOIN 
						`OPE_ControlFacilitadorReportes` 
					ON 
						`OPE_ControlFacilitadorReportes`.`Repo_ProgramacionId` = `OPE_ControlFacilitador`.`Programacion_Id`
					WHERE 
						`OPE_ControlFacilitador`.`Prog_Fecha`='$Prog_Fecha' AND 
						`OPE_ControlFacilitador`.`Prog_Operacion`='$Prog_Operacion' 
						".$twhere_viajes_cancelados."
					ORDER BY 
						`OPE_ControlFacilitador`.`ControlFacilitador_Id` ASC";

		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;
	}   

	function leer_control_facilitador_hist($Prog_Fecha,$Prog_Operacion,$ViajesCancelados) // bdlimabus_hist consulta datatable y estado CERRADO 
	{
		$Prog_TipoEvento 			= "ANULADO";
		$twhere_viajes_cancelados 	= "";

		if($ViajesCancelados=="NO"){
			$twhere_viajes_cancelados = " AND `OPE_ControlFacilitador`.`Prog_TipoEvento`<>'$Prog_TipoEvento' ";
		}

		$consulta 	= "SET @bus=''; SET @colBus=0; SET @tabla=''; SET @colTabla=0;";
		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();

		$consulta 	= "SELECT 
						`OPE_ControlFacilitador`.`ControlFacilitador_Id`,
						`OPE_ControlFacilitador`.`Prog_CodigoColaborador`,
						`OPE_ControlFacilitador`.`Prog_NombreColaborador`,
						`OPE_ControlFacilitador`.`Prog_Tabla`,
						TIME_FORMAT(`OPE_ControlFacilitador`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`,
						TIME_FORMAT(`OPE_ControlFacilitador`.`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`,
						`OPE_ControlFacilitador`.`Prog_Servicio`,
						`OPE_ControlFacilitador`.`Prog_ServBus`,
						`OPE_ControlFacilitador`.`Prog_Bus`,
						`OPE_ControlFacilitador`.`Prog_LugarOrigen`,
						`OPE_ControlFacilitador`.`Prog_LugarDestino`,
						`OPE_ControlFacilitador`.`Prog_TipoEvento`,
						`OPE_ControlFacilitador`.`Prog_Observaciones`,
						ROUND(`OPE_ControlFacilitador`.`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`,
						`OPE_ControlFacilitador`.`Prog_TipoTabla`,
						`OPE_ControlFacilitador`.`Prog_NPlaca`,
						`OPE_ControlFacilitador`.`Prog_NVid`,
						`OPE_ControlFacilitador`.`Prog_IdManto`,
						`OPE_ControlFacilitador`.`Prog_Sentido`,
						`OPE_ControlFacilitador`.`Prog_BusManto`,
						IF(`OPE_ControlFacilitador`.`CFaci_Novedad`='SI', IF(`t1`.`CNove_TipoOrigen`='CREACION','CREACION',`OPE_ControlFacilitador`.`CFaci_Novedad`),`OPE_ControlFacilitador`.`CFaci_Novedad`) AS `CFaci_Novedad`,
						`OPE_ControlFacilitadorReportes`.`Repo_Estado` AS `CFaci_Reporte`,
						IF(@bus!=`OPE_ControlFacilitador`.`Prog_Bus`, IF(@colBus=0, @colBus:=1, @colBus:=0 ), @colBus:= @colBus ) AS `Prog_colBus`,
						(CASE WHEN @bus!=`OPE_ControlFacilitador`.`Prog_Bus` THEN @bus:=`OPE_ControlFacilitador`.`Prog_Bus` END ) AS `xB`,IF(@tabla!=`OPE_ControlFacilitador`.`Prog_Tabla`, IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`,
						(CASE WHEN @tabla!=`OPE_ControlFacilitador`.`Prog_Tabla` THEN @tabla:=`OPE_ControlFacilitador`.`Prog_Tabla` END ) AS `xT`,
						`OPE_ControlFacilitador`.`Prog_Viajes`,
						`OPE_ControlFacilitador`.`CFaci_Campo1`,
						`OPE_ControlFacilitador`.`CFaci_Campo2`,
						`OPE_ControlFacilitador`.`CFaci_Campo3`,
						IF(`OPE_ControlFacilitadorEDT`.`Prog_Bus`!=`OPE_ControlFacilitador`.`Prog_Bus`,IF(`OPE_ControlFacilitadorEDT`.`Prog_Dni`!=`OPE_ControlFacilitador`.`Prog_Dni`, CONCAT_WS('  |  ',`OPE_ControlFacilitadorEDT`.`Prog_Bus`,CONCAT_WS(' - ',`OPE_ControlFacilitadorEDT`.`Prog_CodigoColaborador`,`OPE_ControlFacilitadorEDT`.`Prog_NombreColaborador`)),`OPE_ControlFacilitadorEDT`.`Prog_Bus`),IF(`OPE_ControlFacilitadorEDT`.`Prog_Dni`!=`OPE_ControlFacilitador`.`Prog_Dni`,CONCAT_WS(' - ',`OPE_ControlFacilitadorEDT`.`Prog_CodigoColaborador`,`OPE_ControlFacilitadorEDT`.`Prog_NombreColaborador`),'')) AS `Prog_CambiosBusPiloto`
					FROM 
						`bdlimabus_hist`.`OPE_ControlFacilitador` 
					LEFT JOIN 
						`BDLIMABUS`.`OPE_ControlFacilitadorEDT` 
					ON 
						`OPE_ControlFacilitadorEDT`.`ControlFacilitador_Id`=`OPE_ControlFacilitador`.`ControlFacilitador_Id` AND
						`OPE_ControlFacilitadorEDT`.`CFaci_Version`='1'
					LEFT JOIN
						( SELECT DISTINCT `CNove_ControlFacilitadorId`, `CNove_TipoOrigen` FROM `OPE_ControlCambiosNovedad` WHERE `CNove_TipoOrigen`='CREACION') AS `t1`
					ON 
						`t1`.`CNove_ControlFacilitadorId`=`OPE_ControlFacilitador`.`ControlFacilitador_Id`  AND `t1`.`CNove_TipoOrigen`='CREACION'
					LEFT JOIN 
						`OPE_ControlFacilitadorReportes` 
					ON 
						`OPE_ControlFacilitadorReportes`.`Repo_ProgramacionId` = `OPE_ControlFacilitador`.`Programacion_Id`
					WHERE 
						`OPE_ControlFacilitador`.`Prog_Fecha`='$Prog_Fecha' AND 
						`OPE_ControlFacilitador`.`Prog_Operacion`='$Prog_Operacion' 
						".$twhere_viajes_cancelados."
					ORDER BY 
						`OPE_ControlFacilitador`.`ControlFacilitador_Id` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
		$this->conexion=null;
	}

	function CrearControlFacilitador($Programacion_Id,$Prog_Codigo,$Prog_Operacion,$Prog_Fecha,$Prog_Dni,$Prog_CodigoColaborador,$Prog_NombreColaborador,$Prog_Tabla,$Prog_HoraOrigen,$Prog_HoraDestino,$Prog_Servicio,$Prog_ServBus,$Prog_Bus,$Prog_LugarOrigen,$Prog_LugarDestino,$Prog_TipoEvento,$Prog_Observaciones,$Prog_KmXPuntos,$Prog_TipoTabla,$Prog_NPlaca,$Prog_NVid,$Prog_Sentido,$Prog_BusManto,$Prog_IdManto,$CFaRg_Id,$CFaci_Estado,$CFaci_UsuarioId,$CFaci_Novedad,$CFaci_ProcesoOrigen,$CFaci_Version, $Prog_Viajes, $CFaci_Campo1, $CFaci_Campo2, $CFaci_Campo3) // BDLIMABUS En Lógico se agrega un nuevo registro del control facilitador
	{
        $consulta = "INSERT INTO `OPE_ControlFacilitador`(`Programacion_Id`, `Prog_Codigo`, `Prog_Operacion`, `Prog_Fecha`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_Sentido`,`Prog_BusManto`,`Prog_IdManto`,`CFaRg_Id`, `CFaci_Estado`, `CFaci_UsuarioId`, `CFaci_Novedad`, `CFaci_ProcesoOrigen`, `CFaci_Version`, `Prog_Viajes`, `CFaci_Campo1`, `CFaci_Campo2`, `CFaci_Campo3`) VALUES ('$Programacion_Id','$Prog_Codigo','$Prog_Operacion','$Prog_Fecha','$Prog_Dni','$Prog_CodigoColaborador','$Prog_NombreColaborador','$Prog_Tabla','$Prog_HoraOrigen','$Prog_HoraDestino','$Prog_Servicio','$Prog_ServBus','$Prog_Bus','$Prog_LugarOrigen','$Prog_LugarDestino','$Prog_TipoEvento','$Prog_Observaciones','$Prog_KmXPuntos','$Prog_TipoTabla','$Prog_NPlaca','$Prog_NVid','$Prog_Sentido','$Prog_BusManto','$Prog_IdManto','$CFaRg_Id','$CFaci_Estado','$CFaci_UsuarioId','$CFaci_Novedad','$CFaci_ProcesoOrigen','$CFaci_Version', '$Prog_Viajes', '$CFaci_Campo1', '$CFaci_Campo2', '$CFaci_Campo3')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion=null;
	}  	

	function CrearControlFacilitadorEDT($ControlFacilitador_Id,$Programacion_Id,$Prog_Codigo,$Prog_Operacion,$Prog_Fecha,$Prog_Dni,$Prog_CodigoColaborador,$Prog_NombreColaborador,$Prog_Tabla,$Prog_HoraOrigen,$Prog_HoraDestino,$Prog_Servicio,$Prog_ServBus,$Prog_Bus,$Prog_LugarOrigen,$Prog_LugarDestino,$Prog_TipoEvento,$Prog_Observaciones,$Prog_KmXPuntos,$Prog_TipoTabla,$Prog_NPlaca,$Prog_NVid,$Prog_Sentido,$Prog_BusManto,$Prog_IdManto,$CFaRg_Id,$CFaci_Estado,$CFaci_UsuarioId,$CFaci_Novedad,$CFaci_ProcesoOrigen,$CFaci_Version, $Prog_Viajes, $CFaci_Campo1, $CFaci_Campo2, $CFaci_Campo3)
	{
		$EDT_FechaEdicion = date("Y-m-d H:i:s");
		$EDT_UsuarioId_Edicion = $_SESSION['USUARIO_ID'];

		$consulta = "INSERT INTO `OPE_ControlFacilitadorEDT`(`ControlFacilitador_Id`, `Programacion_Id`, `Prog_Codigo`, `Prog_Operacion`, `Prog_Fecha`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_Sentido`,`Prog_BusManto`,`Prog_IdManto`,`CFaRg_Id`, `CFaci_Estado`, `CFaci_UsuarioId`, `CFaci_Novedad`, `CFaci_ProcesoOrigen`, `EDT_FechaEdicion`, `EDT_UsuarioId_Edicion`, `CFaci_Version`, `Prog_Viajes`, `CFaci_Campo1`, `CFaci_Campo2`, `CFaci_Campo3`) VALUES ('$ControlFacilitador_Id','$Programacion_Id','$Prog_Codigo','$Prog_Operacion','$Prog_Fecha','$Prog_Dni','$Prog_CodigoColaborador','$Prog_NombreColaborador','$Prog_Tabla','$Prog_HoraOrigen','$Prog_HoraDestino','$Prog_Servicio','$Prog_ServBus','$Prog_Bus','$Prog_LugarOrigen','$Prog_LugarDestino','$Prog_TipoEvento','$Prog_Observaciones','$Prog_KmXPuntos','$Prog_TipoTabla','$Prog_NPlaca','$Prog_NVid','$Prog_Sentido','$Prog_BusManto','$Prog_IdManto','$CFaRg_Id','$CFaci_Estado','$CFaci_UsuarioId','$CFaci_Novedad','$CFaci_ProcesoOrigen','$EDT_FechaEdicion','$EDT_UsuarioId_Edicion','$CFaci_Version', '$Prog_Viajes', '$CFaci_Campo1', '$CFaci_Campo2', '$CFaci_Campo3')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion=null;
	}  	

	function EditarControlFacilitador($ControlFacilitador_Id,$Programacion_Id,$Prog_Codigo,$Prog_Operacion,$Prog_Fecha,$Prog_Dni,$Prog_CodigoColaborador,$Prog_NombreColaborador,$Prog_Tabla,$Prog_HoraOrigen,$Prog_HoraDestino,$Prog_Servicio,$Prog_ServBus,$Prog_Bus,$Prog_LugarOrigen,$Prog_LugarDestino,$Prog_TipoEvento,$Prog_Observaciones,$Prog_KmXPuntos,$Prog_TipoTabla,$Prog_NPlaca,$Prog_NVid,$Prog_Sentido,$Prog_BusManto,$Prog_IdManto,$CFaRg_Id,$CFaci_Estado,$CFaci_Novedad,$CFaci_ProcesoOrigen,$CFaci_Version, $Prog_Viajes, $CFaci_Campo1, $CFaci_Campo2, $CFaci_Campo3) // BDLIMABUS En Lógico se edita un registro del control facilitador
	{
		$CFaci_UsuarioId = $_SESSION['USUARIO_ID'];
            
		$consulta = "UPDATE `OPE_ControlFacilitador` SET `Prog_Dni`='$Prog_Dni',`Prog_CodigoColaborador`='$Prog_CodigoColaborador',`Prog_NombreColaborador`='$Prog_NombreColaborador',`Prog_Tabla`='$Prog_Tabla',`Prog_HoraOrigen`='$Prog_HoraOrigen',`Prog_HoraDestino`='$Prog_HoraDestino',`Prog_Servicio`='$Prog_Servicio',`Prog_ServBus`='$Prog_ServBus',`Prog_Bus`='$Prog_Bus',`Prog_LugarOrigen`='$Prog_LugarOrigen',`Prog_LugarDestino`='$Prog_LugarDestino',`Prog_TipoEvento`='$Prog_TipoEvento',`Prog_Observaciones`='$Prog_Observaciones',`Prog_KmXPuntos`='$Prog_KmXPuntos',`Prog_TipoTabla`='$Prog_TipoTabla',`Prog_NPlaca`='$Prog_NPlaca',`Prog_NVid`='$Prog_NVid',`Prog_Sentido`='$Prog_Sentido',`Prog_BusManto`='$Prog_BusManto',`CFaci_Estado`='$CFaci_Estado',`CFaci_UsuarioId`='$CFaci_UsuarioId',`CFaci_Novedad`='$CFaci_Novedad',`CFaci_Version`='$CFaci_Version', `Prog_Viajes`='$Prog_Viajes', `CFaci_Campo1`='$CFaci_Campo1', `CFaci_Campo2`='$CFaci_Campo2', `CFaci_Campo3`='$CFaci_Campo3' WHERE `ControlFacilitador_Id`='$ControlFacilitador_Id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion=null;
	}  	

	function EditarTotalBus($ControlFacilitador_IdACT, $CFaci_EstadoACT, $CFaci_NovedadACT, $CFaci_VersionACT, $Prog_Bus2, $Prog_NPlaca2, $Prog_NVid2, $Prog_BusManto2) // BDLIMABUS En Lógico editar total control facilitador
	{
		$CFaci_UsuarioId = $_SESSION['USUARIO_ID'];
            
		$consulta = "UPDATE `OPE_ControlFacilitador` SET `Prog_Bus`='$Prog_Bus2',`Prog_NPlaca`='$Prog_NPlaca2',`Prog_NVid`='$Prog_NVid2',`Prog_BusManto`='$Prog_BusManto2',`CFaci_Estado`='$CFaci_EstadoACT',`CFaci_UsuarioId`='$CFaci_UsuarioId',`CFaci_Novedad`='$CFaci_NovedadACT',`CFaci_Version`='$CFaci_VersionACT' WHERE `ControlFacilitador_Id`='$ControlFacilitador_IdACT'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion=null;
	}  	

	function EditarControlFacilitadorNovedad($ControlFacilitador_Id,$CFaci_Novedad)
	{
		// Se actualizan los datos de la linea modificada
		$consulta = "UPDATE `OPE_ControlFacilitador` SET `CFaci_Novedad`='$CFaci_Novedad' WHERE `ControlFacilitador_Id`='$ControlFacilitador_Id'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$this->conexion=null;	
	}

	function SelectUsuario()
	{
		$Usua_Perfil = "PILOTO";
		$consulta="SELECT DISTINCT `glo_roles`.`roles_apellidosnombres` AS `Usuario` FROM `glo_roles` WHERE `glo_roles`.`roles_perfil` = '$Usua_Perfil' ORDER BY `Usuario` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function SelectUsuarioActual($Prog_Fecha,$Prog_Operacion)
	{
		$consulta="SELECT DISTINCT `Prog_NombreColaborador` AS `Usuario` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' AND `Prog_Operacion`='$Prog_Operacion' ORDER BY `Usuario` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function SelectBus($Prog_Operacion)
	{
		$consulta="SELECT `Buses`.`Bus_NroExterno` AS `Bus` FROM `Buses` WHERE `Buses`.`Bus_Operacion` = '$Prog_Operacion' ORDER BY `Bus` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function SelectIdMantoActual($Prog_Fecha,$Prog_Operacion)
	{
		$consulta="SELECT ANY_VALUE(`Prog_Bus`) AS `Bus`, ANY_VALUE(`Prog_ServBus`) AS `ServBus`, ANY_VALUE(`Prog_Servicio`) AS `Servicio`, ROUND(SUM(`Prog_KmXPuntos`),0) AS `Km`, TIME_FORMAT(MIN(`Prog_HoraOrigen`),'%H:%i') AS `HoraInicio`, TIME_FORMAT(MAX(`Prog_HoraDestino`),'%H:%i') AS `HoraTermino`, ANY_VALUE(`Prog_BusManto`) AS `BusManto`, `Prog_IdManto` AS `IdManto` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' AND `Prog_Operacion`='$Prog_Operacion' AND `Prog_IdManto`<>'' GROUP BY `Prog_IdManto` ORDER BY `Prog_IdManto`";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function SelectBusCambio($Prog_Fecha,$Prog_Operacion)
	{
		$consulta="SELECT `Prog_Bus` AS `Bus` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' AND `Prog_Operacion`='$Prog_Operacion' AND `Prog_Bus`<>'' GROUP BY `Prog_Bus` ORDER BY `Prog_Bus`";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function CodigoColaborador($Prog_NombreColaborador)
	{
		$consulta="SELECT DISTINCT * FROM `colaborador` WHERE `colaborador`.`Colab_ApellidosNombres` = '$Prog_NombreColaborador' AND `colaborador`.`Colab_CodigoCortoPT`!=''";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function BuscarColaborador($Prog_Fecha,$Prog_Operacion,$Prog_Dni1)
	{
		$consulta="SELECT * FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha` = '$Prog_Fecha' AND `Prog_Operacion` = '$Prog_Operacion' AND `Prog_Dni` = '$Prog_Dni1'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function BuscarBus($Prog_Fecha,$Prog_Operacion,$Prog_Bus)
	{
		$consulta="SELECT * FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha` = '$Prog_Fecha' AND `Prog_Operacion` = '$Prog_Operacion' AND `Prog_Bus` = '$Prog_Bus' LIMIT 1";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function BuscarIdManto($Prog_Fecha,$Prog_Operacion,$Prog_IdManto)
	{
		$consulta="SELECT * FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha` = '$Prog_Fecha' AND `Prog_Operacion` = '$Prog_Operacion' AND `Prog_IdManto` = '$Prog_IdManto'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function BusNroVid($Prog_Bus)
	{
		$consulta="SELECT `Buses`.`Bus_NroVid` AS `NroVID` FROM `Buses` WHERE `Buses`.`Bus_NroExterno` = '$Prog_Bus'";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function BusNroPlaca($Prog_Bus)
	{
		$consulta="SELECT `Buses`.`Bus_NroPlaca` AS `NroPlaca` FROM `Buses` WHERE `Buses`.`Bus_NroExterno` = '$Prog_Bus'";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}
	
	function SelectTipos($Prog_Operacion,$Ttabla_Tipo)
	{
		$consulta="SELECT `TipoTabla`.`Ttabla_Detalle` AS 'Detalle' FROM `TipoTabla` WHERE `TipoTabla`.`Ttabla_Operacion` = '$Prog_Operacion' AND `TipoTabla`.`Ttabla_Tipo` = '$Ttabla_Tipo' ORDER BY `Detalle` ASC";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function ValidarControlFacilitador($Prog_Fecha,$Prog_Operacion)
	{
		$CFaRg_Estado1 = "GENERADO";
		$CFaRg_Estado2 = "CERRADO";

		$consulta="SELECT * FROM `OPE_ControlFacilitadorRegistroCarga` WHERE `CFaRg_FechaCargada`='$Prog_Fecha' AND `CFaRg_TipoOperacionCargada`='$Prog_Operacion' AND (`CFaRg_Estado`='$CFaRg_Estado1' OR `CFaRg_Estado`='$CFaRg_Estado2')";
   		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;		
		$this->conexion=null;
	}

	function InconsistenciasControlFacilitador($Prog_Fecha,$Prog_Operacion,$Orden)
	{
		switch ($Orden)
   		{
			case 'COLABORADOR':
				$consulta="SELECT `ControlFacilitador_Id`,`Prog_NombreColaborador`,`Prog_Dni`,`Prog_Bus`,`Prog_HoraOrigen`,`Prog_HoraDestino`,`Prog_Servicio`,`Prog_IdManto`, `Prog_TipoEvento` FROM `OPE_ControlFacilitador` WHERE `Prog_Operacion`='$Prog_Operacion' AND `Prog_Fecha`='$Prog_Fecha' ORDER BY `OPE_ControlFacilitador`.`Prog_Dni`,`OPE_ControlFacilitador`.`Prog_HoraOrigen` ASC";
			break;
			case 'BUS':
				$consulta="SELECT `ControlFacilitador_Id`,`Prog_Bus`,`Prog_HoraOrigen`,`Prog_HoraDestino`,`Prog_IdManto`, `Prog_Servicio`, `Prog_TipoEvento` FROM `OPE_ControlFacilitador` WHERE `Prog_Operacion`='$Prog_Operacion' AND `Prog_Fecha`='$Prog_Fecha' AND `Prog_Bus`!='' ORDER BY `OPE_ControlFacilitador`.`Prog_Bus`,`OPE_ControlFacilitador`.`Prog_HoraOrigen` ASC";
			break;
		}
				 
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function InconsistenciasPiloto($Prog_Fecha,$Prog_Operacion,$Prog_NombreColaborador,$Prog_HoraOrigen,$Prog_HoraDestino,$ControlFacilitador_Id)
	{
		if(!empty($Prog_HoraOrigen) && empty($Prog_HoraDestino)){
			$consulta="SELECT * FROM `OPE_ControlFacilitador` WHERE `ControlFacilitador_Id`<>'$ControlFacilitador_Id' AND `Prog_Operacion`='$Prog_Operacion' AND `Prog_Fecha`='$Prog_Fecha' AND `Prog_NombreColaborador`='$Prog_NombreColaborador' AND `Prog_HoraOrigen`< '$Prog_HoraOrigen' AND `Prog_HoraDestino`>'$Prog_HoraOrigen' ORDER BY `Prog_HoraOrigen` LIMIT 1";
		}
		
		if(empty($Prog_HoraOrigen) && !empty($Prog_HoraDestino)){
			$consulta="SELECT * FROM `OPE_ControlFacilitador` WHERE `ControlFacilitador_Id`<>'$ControlFacilitador_Id' AND `Prog_Operacion`='$Prog_Operacion' AND `Prog_Fecha`='$Prog_Fecha' AND `Prog_NombreColaborador`='$Prog_NombreColaborador' AND `Prog_HoraOrigen`< '$Prog_HoraDestino' AND `Prog_HoraDestino`>'$Prog_HoraDestino' ORDER BY `Prog_HoraOrigen` LIMIT 1";
		}

				 
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}
	
	function InconsistenciasBus($Prog_Fecha,$Prog_Operacion,$Prog_Bus,$Prog_HoraOrigen,$Prog_HoraDestino,$ControlFacilitador_Id)
	{
		if(!empty($Prog_HoraOrigen) && empty($Prog_HoraDestino)){
			$consulta="SELECT * FROM `OPE_ControlFacilitador` WHERE `ControlFacilitador_Id`<>'$ControlFacilitador_Id' AND `Prog_Operacion`='$Prog_Operacion' AND `Prog_Fecha`='$Prog_Fecha' AND `Prog_Bus`='$Prog_Bus' AND `Prog_HoraOrigen`< '$Prog_HoraOrigen' AND `Prog_HoraDestino`>'$Prog_HoraOrigen' ORDER BY `Prog_HoraOrigen` LIMIT 1";
		}
		
		if(empty($Prog_HoraOrigen) && !empty($Prog_HoraDestino)){
			$consulta="SELECT * FROM `OPE_ControlFacilitador` WHERE `ControlFacilitador_Id`<>'$ControlFacilitador_Id' AND `Prog_Operacion`='$Prog_Operacion' AND `Prog_Fecha`='$Prog_Fecha' AND `Prog_Bus`='$Prog_Bus' AND `Prog_HoraOrigen`< '$Prog_HoraDestino' AND `Prog_HoraDestino`>'$Prog_HoraDestino' ORDER BY `Prog_HoraOrigen` LIMIT 1";
		}
				 
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

	function CambiosControlFacilitador($ControlFacilitador_Id)
	{
		$consulta="SELECT `CFaci_Version`, `CNove_Fecha`, `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`,`Prog_Tabla`,	TIME_FORMAT( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT( `Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitador`.`CFaci_UsuarioId` = `colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId`, `CNove_OPENovedadId`, `CNove_NovedadId`,	`CNove_TipoOrigen`, `Nove_Novedad`, `Nove_TipoNovedad`,	`Nove_DetalleNovedad`, `Nove_Descripcion`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `u_novedad`.`Nove_UsuarioId` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId` FROM `OPE_ControlFacilitador` LEFT JOIN `OPE_ControlCambiosNovedad` ON `ControlFacilitador_Id`= `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNOVE_CFaciVersion` LEFT JOIN  (SELECT `OPE_NovedadId`,`Novedad_Id`,`Nove_Version`,`Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, `Nove_UsuarioId` FROM `OPE_Novedad` UNION SELECT `OPE_NovedadId`,`Novedad_Id`,`Nove_Version`,`Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, `Nove_UsuarioId` FROM `OPE_NovedadEDT`) `u_novedad` ON `CNove_OPENovedadId` = `OPE_NovedadId` AND `CNOVE_NoveVersion`=`Nove_Version` WHERE `ControlFacilitador_Id`='$ControlFacilitador_Id' UNION SELECT  `CFaci_Version`, `CNove_Fecha`, `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`,`Prog_Tabla`,	TIME_FORMAT( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT( `Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitadorEDT`.`CFaci_UsuarioId` = `colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId`, `CNove_OPENovedadId`, `CNove_NovedadId`,	`CNove_TipoOrigen`, `Nove_Novedad`, `Nove_TipoNovedad`,	`Nove_DetalleNovedad`, `Nove_Descripcion`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `u_novedad`.`Nove_UsuarioId` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId` FROM `OPE_ControlFacilitadorEDT` LEFT JOIN `OPE_ControlCambiosNovedad` ON `ControlFacilitador_Id`= `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNOVE_CFaciVersion` LEFT JOIN  (SELECT `OPE_NovedadId`,`Novedad_Id`,`Nove_Version`,`Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, `Nove_UsuarioId` FROM `OPE_Novedad` UNION SELECT `OPE_NovedadId`,`Novedad_Id`,`Nove_Version`,`Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, `Nove_UsuarioId` FROM `OPE_NovedadEDT`) `u_novedad` ON `CNove_OPENovedadId` = `OPE_NovedadId` AND `CNOVE_NoveVersion`=`Nove_Version` WHERE `ControlFacilitador_Id`='$ControlFacilitador_Id' ORDER BY `CFaci_Version`,`CNove_Fecha` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function cambios_control_facilitador_hist($ControlFacilitador_Id)
	{
		$consulta="SELECT `CFaci_Version`, `CNove_Fecha`, `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`,`Prog_Tabla`,	TIME_FORMAT( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT( `Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitador`.`CFaci_UsuarioId` = `colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId`, `CNove_OPENovedadId`, `CNove_NovedadId`,	`CNove_TipoOrigen`, `Nove_Novedad`, `Nove_TipoNovedad`,	`Nove_DetalleNovedad`, `Nove_Descripcion`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `u_novedad`.`Nove_UsuarioId` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` LEFT JOIN `OPE_ControlCambiosNovedad` ON `ControlFacilitador_Id`= `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNOVE_CFaciVersion` LEFT JOIN  (SELECT `OPE_NovedadId`,`Novedad_Id`,`Nove_Version`,`Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, `Nove_UsuarioId` FROM `OPE_Novedad` UNION SELECT `OPE_NovedadId`,`Novedad_Id`,`Nove_Version`,`Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, `Nove_UsuarioId` FROM `OPE_NovedadEDT`) `u_novedad` ON `CNove_OPENovedadId` = `OPE_NovedadId` AND `CNOVE_NoveVersion`=`Nove_Version` WHERE `ControlFacilitador_Id`='$ControlFacilitador_Id' UNION SELECT  `CFaci_Version`, `CNove_Fecha`, `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`,`Prog_Tabla`,	TIME_FORMAT( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT( `Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitadorEDT`.`CFaci_UsuarioId` = `colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId`, `CNove_OPENovedadId`, `CNove_NovedadId`,	`CNove_TipoOrigen`, `Nove_Novedad`, `Nove_TipoNovedad`,	`Nove_DetalleNovedad`, `Nove_Descripcion`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `u_novedad`.`Nove_UsuarioId` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId` FROM `OPE_ControlFacilitadorEDT` LEFT JOIN `OPE_ControlCambiosNovedad` ON `ControlFacilitador_Id`= `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNOVE_CFaciVersion` LEFT JOIN  (SELECT `OPE_NovedadId`,`Novedad_Id`,`Nove_Version`,`Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, `Nove_UsuarioId` FROM `OPE_Novedad` UNION SELECT `OPE_NovedadId`,`Novedad_Id`,`Nove_Version`,`Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, `Nove_UsuarioId` FROM `OPE_NovedadEDT`) `u_novedad` ON `CNove_OPENovedadId` = `OPE_NovedadId` AND `CNOVE_NoveVersion`=`Nove_Version` WHERE `ControlFacilitador_Id`='$ControlFacilitador_Id' ORDER BY `CFaci_Version`,`CNove_Fecha` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function ValidarControlFacilitadorCarga($Prog_Fecha)
	{
		$CFaRg_Estado1 = "GENERADO";
		$CFaRg_Estado2 = "CERRADO";

		$consulta="SELECT * FROM `OPE_ControlFacilitadorRegistroCarga` WHERE `CFaRg_FechaCargada`='$Prog_Fecha' AND (`CFaRg_Estado`='$CFaRg_Estado1' OR `CFaRg_Estado`='$CFaRg_Estado2')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function KmRecorridos($Prog_Operacion,$Prog_Sentido,$Prog_Servicio,$Prog_LugarOrigen,$Prog_LugarDestino)
	{
		$rptaData = 0;

		$consulta = "SELECT ROUND(SUM(`Dist_Kilometros`),3) AS `KmRecorridos`  FROM `OPE_Distancias` WHERE `Dist_Operacion`='$Prog_Operacion' AND `Dist_Sentido`='$Prog_Sentido' AND `Dist_Servicio`='$Prog_Servicio' AND `Dist_Orden` >= (SELECT `Dist_Orden` FROM `OPE_Distancias` WHERE `Dist_Operacion`='$Prog_Operacion' AND `Dist_Sentido`='$Prog_Sentido' AND `Dist_Servicio`='$Prog_Servicio' AND `Dist_LugarOrigen`='$Prog_LugarOrigen') AND `Dist_Orden` <= (SELECT `Dist_Orden` FROM `OPE_Distancias` WHERE `Dist_Operacion`='$Prog_Operacion' AND `Dist_Sentido`='$Prog_Sentido' AND `Dist_Servicio`='$Prog_Servicio' AND `Dist_LugarDestino`='$Prog_LugarDestino')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $row){
			$rptaData = $row['KmRecorridos'];
		}

		echo $rptaData;
		$this->conexion=null;
	}

	function ListarReporte($ControlFacilitador_Id)
	{
		$Repo_TipoId = "DESPACHOFLOTA";
		$consulta = "SELECT *, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitadorReportes`.`Repo_UsuarioId_Generar` = `colaborador`.`Colaborador_id`) AS `Repo_UsuarioCrear`, DATE_FORMAT(`Repo_FechaGenerar`,'%d-%m-%Y %H:%i') AS `Repo_FechaCrear`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitadorReportes`.`Repo_UsuarioId_Edicion` = `colaborador`.`Colaborador_id`) AS `Repo_UsuarioEditar`,  DATE_FORMAT(`Repo_FechaEdicion`,'%d-%m-%Y %H:%i') AS `Repo_FechaEditar`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_ControlFacilitadorReportes`.`Repo_UsuarioId_Cerrar` = `colaborador`.`Colaborador_id`) AS `Repo_UsuarioAtender`, DATE_FORMAT(`Repo_FechaCerrar`,'%d-%m-%Y %H:%i') AS `Repo_FechaAtender` FROM `OPE_ControlFacilitador` LEFT JOIN `OPE_ControlFacilitadorReportes` ON `Repo_ProgramacionId`=`Programacion_Id` AND `Repo_TipoId`='$Repo_TipoId' WHERE `ControlFacilitador_Id`='$ControlFacilitador_Id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;	
	}

	function CerrarReporte($Programacion_Id)
	{
		$Repo_TipoId = "DESPACHOFLOTA";
		$Repo_FechaCerrar = date("Y-m-d H:i:s");
		$Repo_UsuarioId_Cerrar = $_SESSION['USUARIO_ID'];		
		$Repo_Estado = "ATENDIDO";

		// Se actualizan los datos de la linea modificada
		$consulta = "UPDATE `OPE_ControlFacilitadorReportes` SET `Repo_Estado`='$Repo_Estado',`Repo_UsuarioId_Cerrar`='$Repo_UsuarioId_Cerrar',`Repo_FechaCerrar`='$Repo_FechaCerrar' WHERE `Repo_ProgramacionId`='$Programacion_Id' AND `Repo_TipoId`='$Repo_TipoId'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$this->conexion=null;
	}

	function horas_trabajadas($operacion, $fecha, $codigo, $hora)
	{
		$consulta = "SELECT
						`OPE_ControlFacilitador`.`Prog_Operacion`,
						`OPE_ControlFacilitador`.`Prog_Fecha`, 
						`OPE_ControlFacilitador`.`Prog_CodigoColaborador`,
						ADDTIME(TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME( `OPE_ControlFacilitador`.`Prog_HoraDestino`,`OPE_ControlFacilitador`.`Prog_HoraOrigen`)))),'%H:%i'),TIME_FORMAT(SEC_TO_TIME(TIME_TO_SEC(SUBTIME('$hora',MAX(`OPE_ControlFacilitador`.`Prog_HoraDestino`)))),'%H:%i')) AS `horas_trabajadas`
					FROM 
						`OPE_ControlFacilitador` 
					WHERE
						`OPE_ControlFacilitador`.`Prog_Operacion`='$operacion' AND
						`OPE_ControlFacilitador`.`Prog_Fecha`='$fecha' AND
						`OPE_ControlFacilitador`.`Prog_HoraDestino`<='$hora'
					GROUP BY 
						`OPE_ControlFacilitador`.`Prog_CodigoColaborador`
					HAVING
						`OPE_ControlFacilitador`.`Prog_CodigoColaborador`='$codigo' ";

		$resultado 	= $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data		= $resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}
	//::::::::::::::::::::::::::::::::::::::::: NOVEDAD CARGA :::::::::::::::::::::::::::::::::::::::::::::://

	function BuscarNovedadCarga($Nove_FechaOperacion, $Nove_Estado)
	{
		$twhere_estado = "";
		if($Nove_Estado != ""){
			$twhere_estado = " AND `OPE_Novedad`.`Nove_Estado`='$Nove_Estado' ";
		}
		$consulta="SELECT `OPE_NovedadId`,`Novedad_Id`, `Nove_ProgramacionId`, `Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, CONCAT(SUBSTRING(`Nove_Descripcion`,1,30),' ...') AS `Nove_Descripcion`, `Nove_Operacion`, `Nove_FechaOperacion`, `Nove_Dni`, `Nove_CodigoColaborador`, `Nove_NombreColaborador`, `Nove_Tabla`, `Nove_HoraOrigen`, `Nove_HoraDestino`, `Nove_Servicio`, `Nove_Bus`, `Nove_LugarOrigen`, `Nove_LugarDestino`, `Nove_LugarExacto`, TIME_FORMAT( `Nove_HoraInicio`,'%H:%i') AS `Nove_HoraInicio`, TIME_FORMAT( `Nove_HoraFin`,'%H:%i') AS `Nove_HoraFin`, `Nove_Estado`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_Novedad`.`Nove_UsuarioId` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId`, `Nove_ProcesoOrigen`, DATE_FORMAT(`Nove_Fecha`,'%d-%m-%Y %H:%i') AS `Nove_Fecha`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_Novedad`.`Nove_UsuarioId_Edicion` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId_Edicion`, DATE_FORMAT(`Nove_FechaEdicion`,'%d-%m-%Y %H:%i') AS `Nove_FechaEdicion`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_Novedad`.`Nove_UsuarioId_Eliminar` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId_Eliminar`, DATE_FORMAT(`Nove_FechaEliminar`,'%d-%m-%Y %H:%i') AS `Nove_FechaEliminar`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_Novedad`.`Nove_UsuarioId_Cerrar` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId_Cerrar`, DATE_FORMAT(`Nove_FechaCerrar`,'%d-%m-%Y %H:%i') AS `Nove_FechaCerrar` FROM `OPE_Novedad` WHERE `Nove_FechaOperacion`='$Nove_FechaOperacion' ".$twhere_estado;

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}
	
	function CrearNovedad($Novedad_Id,$Programacion_Id,$Nove_Novedad,$Nove_TipoNovedad,$Nove_DetalleNovedad, $Nove_Descripcion,$Prog_Operacion,$Prog_Fecha,$Prog_Dni,$Prog_CodigoColaborador,$Prog_NombreColaborador,$Prog_Tabla,$Prog_HoraOrigen,$Prog_HoraDestino,$Prog_Servicio,$Prog_Bus,$Prog_LugarOrigen,$Prog_LugarDestino,$Nove_Estado,$CFaci_ProcesoOrigen,$Nove_Fecha,$CFaRg_Id, $Nove_LugarExacto,$Nove_HoraInicio,$Nove_HoraFin,$Nove_Version,$Nove_TipoOrigen)
	{
		$Nove_UsuarioId = $_SESSION['USUARIO_ID'];

		$consulta = "INSERT INTO `OPE_Novedad`(`Novedad_Id`,`Nove_ProgramacionId`, `Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, `Nove_Operacion`, `Nove_FechaOperacion`, `Nove_Dni`, `Nove_CodigoColaborador`, `Nove_NombreColaborador`, `Nove_Tabla`, `Nove_HoraOrigen`, `Nove_HoraDestino`, `Nove_Servicio`, `Nove_Bus`, `Nove_LugarOrigen`, `Nove_LugarDestino`, `Nove_Estado`, `Nove_UsuarioId`, `Nove_ProcesoOrigen`, `Nove_Fecha`, `Nove_CFaRgId`, `Nove_LugarExacto`,`Nove_HoraInicio`,`Nove_HoraFin`,`Nove_UsuarioId_Edicion`,`Nove_FechaEdicion`, `Nove_Version`, `Nove_TipoOrigen` ) VALUES ('$Novedad_Id','$Programacion_Id','$Nove_Novedad','$Nove_TipoNovedad','$Nove_DetalleNovedad','$Nove_Descripcion','$Prog_Operacion','$Prog_Fecha','$Prog_Dni','$Prog_CodigoColaborador','$Prog_NombreColaborador','$Prog_Tabla','$Prog_HoraOrigen','$Prog_HoraDestino','$Prog_Servicio','$Prog_Bus','$Prog_LugarOrigen','$Prog_LugarDestino','$Nove_Estado','$Nove_UsuarioId','$CFaci_ProcesoOrigen','$Nove_Fecha','$CFaRg_Id', '$Nove_LugarExacto','$Nove_HoraInicio','$Nove_HoraFin','$Nove_UsuarioId','$Nove_Fecha','$Nove_Version','$Nove_TipoOrigen')";
			
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion=null;
	}  	

	function CrearNovedadCargaEDT($OPE_NovedadId,$Novedad_Id,$Nove_Novedad,$Nove_TipoNovedad,$Nove_DetalleNovedad,$Nove_Descripcion,$Nove_LugarExacto,$Nove_HoraInicio,$Nove_HoraFin,$Nove_ProgramacionId, $Nove_Operacion,$Nove_FechaOperacion,$Nove_Dni,$Nove_CodigoColaborador,$Nove_NombreColaborador,$Nove_Tabla,$Nove_HoraOrigen,$Nove_HoraDestino,$Nove_Servicio,$Nove_Bus,$Nove_LugarOrigen,$Nove_LugarDestino,$Nove_Estado,$Nove_UsuarioId,$Nove_ProcesoOrigen,$Nove_Fecha,$Nove_CFaRgId,$Nove_UsuarioId_Edicion,$Nove_FechaEdicion,$Nove_UsuarioId_Eliminar,$Nove_FechaEliminar,$Nove_UsuarioId_Cerrar,$Nove_FechaCerrar,$Nove_Version,$Nove_TipoOrigen)
	{
		$EDT_UsuarioId_Edicion = $_SESSION['USUARIO_ID'];
		$EDT_FechaEdicion = date("Y-m-d H:i:s");

		$consulta = "INSERT INTO `OPE_NovedadEDT`(`EDT_FechaEdicion`, `EDT_UsuarioId_Edicion`, `OPE_NovedadId`, `Novedad_Id`, `Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`,`Nove_LugarExacto`,`Nove_HoraInicio`,`Nove_HoraFin`, `Nove_ProgramacionId`, `Nove_Operacion`, `Nove_FechaOperacion`, `Nove_Dni`, `Nove_CodigoColaborador`, `Nove_NombreColaborador`, `Nove_Tabla`, `Nove_HoraOrigen`, `Nove_HoraDestino`, `Nove_Servicio`, `Nove_Bus`, `Nove_LugarOrigen`, `Nove_LugarDestino`, `Nove_Estado`, `Nove_UsuarioId`, `Nove_ProcesoOrigen`, `Nove_Fecha`, `Nove_CFaRgId`, `Nove_UsuarioId_Eliminar`,`Nove_FechaEliminar`,`Nove_UsuarioId_Cerrar`,`Nove_FechaCerrar`, `Nove_UsuarioId_Edicion`, `Nove_FechaEdicion`, `Nove_Version`, `Nove_TipoOrigen` ) VALUES ('$EDT_FechaEdicion','$EDT_UsuarioId_Edicion','$OPE_NovedadId','$Novedad_Id','$Nove_Novedad','$Nove_TipoNovedad','$Nove_DetalleNovedad','$Nove_Descripcion','$Nove_LugarExacto','$Nove_HoraInicio','$Nove_HoraFin','$Nove_ProgramacionId','$Nove_Operacion','$Nove_FechaOperacion','$Nove_Dni','$Nove_CodigoColaborador','$Nove_NombreColaborador','$Nove_Tabla','$Nove_HoraOrigen','$Nove_HoraDestino','$Nove_Servicio','$Nove_Bus','$Nove_LugarOrigen','$Nove_LugarDestino','$Nove_Estado','$Nove_UsuarioId','$Nove_ProcesoOrigen','$Nove_Fecha','$Nove_CFaRgId',IF('$Nove_UsuarioId_Eliminar' = '', NULL, '$Nove_UsuarioId_Eliminar'),IF('$Nove_FechaEliminar' = '', NULL, '$Nove_FechaEliminar'),IF('$Nove_UsuarioId_Cerrar' = '', NULL, '$Nove_UsuarioId_Cerrar'),IF('$Nove_FechaCerrar' = '', NULL, '$Nove_FechaCerrar'),'$Nove_UsuarioId_Edicion','$Nove_FechaEdicion','$Nove_Version','$Nove_TipoOrigen')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}  	
	
	function EditarNovedadCarga($OPE_NovedadId,$Novedad_Id,$Nove_Novedad,$Nove_TipoNovedad,$Nove_DetalleNovedad,$Nove_Descripcion,$Nove_LugarExacto,$Nove_HoraInicio,$Nove_HoraFin,$Nove_Version)
	{
	
		$consulta = "UPDATE `OPE_Novedad` SET `Novedad_Id`='$Novedad_Id',`Nove_Novedad`='$Nove_Novedad',`Nove_TipoNovedad`='$Nove_TipoNovedad',`Nove_DetalleNovedad`='$Nove_DetalleNovedad',`Nove_Descripcion`='$Nove_Descripcion',`Nove_LugarExacto`='$Nove_LugarExacto',`Nove_HoraInicio`='$Nove_HoraInicio',`Nove_HoraFin`='$Nove_HoraFin',`Nove_Version`='$Nove_Version' WHERE `OPE_NovedadId`='$OPE_NovedadId'";	
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

	 	$this->conexion=null;	
	}  		

	function ListarNovedad($OPE_NovedadId)
	{
		$consulta="SELECT `Novedad_Id`,`Nove_Novedad`,`Nove_TipoNovedad`,`Nove_DetalleNovedad`,`Nove_Descripcion` FROM `OPE_Novedad` WHERE `OPE_NovedadId`='$OPE_NovedadId'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}

	function ValidarNovedad($Prog_Fecha,$Prog_Operacion)
	{
		$CFaci_Novedad = "SI"; // [SI] NOVEDAD, [NO] NOVEDAD 

		$consulta = " SELECT * FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha` = '$Prog_Fecha' AND `Prog_Operacion` = '$Prog_Operacion' AND `CFaci_Novedad` = '$CFaci_Novedad' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$valida = $resultado->rowCount();

		if($valida==0){
			return false; 
		}else{
			return true;
		}
		$this->conexion=null;
	}

	function SelectNovedad($Prog_Fecha,$Prog_Operacion,$Programacion_Id)
	{
		$Nove_Estado = "PENDIENTE";
		$Nove_Estado1 = "ANULADO";
		
		if($Programacion_Id==0){
			$consulta="SELECT `OPE_NovedadId`,`Novedad_Id`,`Nove_Novedad`,`Nove_TipoNovedad`,`Nove_DetalleNovedad`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_Novedad`.`Nove_Dni` = `colaborador`.`Colaborador_id`) AS `Nove_NombreCorto`,`Nove_Bus`,DATE_FORMAT(`Nove_Fecha`,'%d-%m-%Y %H:%i') AS `Nove_Fecha`, `Nove_Estado` FROM `OPE_Novedad` WHERE `Nove_FechaOperacion`='$Prog_Fecha' AND `Nove_Operacion`='$Prog_Operacion' AND `Nove_Estado`= '$Nove_Estado' ORDER BY `OPE_NovedadId`";
		}else{
			$consulta="SELECT `OPE_NovedadId`,`Novedad_Id`,`Nove_Novedad`,`Nove_TipoNovedad`,`Nove_DetalleNovedad`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_Novedad`.`Nove_Dni` = `colaborador`.`Colaborador_id`) AS `Nove_NombreCorto`,`Nove_Bus`,DATE_FORMAT(`Nove_Fecha`,'%d-%m-%Y %H:%i') AS `Nove_Fecha`, `Nove_Estado` FROM `OPE_Novedad` WHERE `Nove_FechaOperacion`='$Prog_Fecha' AND `Nove_Operacion`='$Prog_Operacion' AND `Nove_Estado`= '$Nove_Estado' OR (`Nove_Estado`= '$Nove_Estado1' AND `Nove_ProgramacionId`= '$Programacion_Id') ORDER BY `OPE_NovedadId`";
		}

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function CrearControlCambiosNovedad($CNove_ProcesoOrigen,$CNove_ProgramacionId,$CNove_NovedadId,$CNove_Fecha,$CNove_ControlFacilitadorId,$CNove_TipoOrigen,$CNove_CFaRgId,$CNove_OPENovedadId,$CNove_FechaOperacion,$CNove_CFaciVersion,$CNove_NoveVersion)
	{
		$CNove_UsuarioId = $_SESSION['USUARIO_ID'];
		
		$consulta = "INSERT INTO `OPE_ControlCambiosNovedad`(`CNove_ProcesoOrigen`, `CNove_ProgramacionId`, `CNove_NovedadId`, `CNove_Fecha`, `CNove_UsuarioId`,`CNove_ControlFacilitadorId`,`CNove_TipoOrigen`,`CNove_CFaRgId`,`CNove_OPENovedadId`,`CNove_FechaOperacion`, `CNove_CFaciVersion`, `CNove_NoveVersion`) VALUES ('$CNove_ProcesoOrigen','$CNove_ProgramacionId','$CNove_NovedadId','$CNove_Fecha','$CNove_UsuarioId','$CNove_ControlFacilitadorId','$CNove_TipoOrigen','$CNove_CFaRgId','$CNove_OPENovedadId','$CNove_FechaOperacion','$CNove_CFaciVersion','$CNove_NoveVersion')";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();

		$this->conexion=null;
	}  	

	function BorrarNovedadCarga($CFaRg_Id)
	{
		$consulta = "DELETE FROM `OPE_Novedad` WHERE `Nove_CFaRgId`='$CFaRg_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$consulta = "DELETE FROM `OPE_NovedadEDT` WHERE `Nove_CFaRgId`='$CFaRg_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$this->conexion=null;	
	}  		

	function BorrarControlCambiosNovedad($CFaRg_Id)
	{
		$consulta = "DELETE FROM `OPE_ControlCambiosNovedad` WHERE `CNove_CFaRgId`='$CFaRg_Id'";		

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;	
	}

	function CerrarNovedadCarga($OPE_NovedadId)
	{
	 	$Nove_FechaCerrar = date("Y-m-d H:i:s");
	 	$Nove_UsuarioId_Cerrar = $_SESSION['USUARIO_ID'];
		$Nove_Estado = "CERRADO"; 

	 	$consulta = "UPDATE `OPE_Novedad` SET `Nove_Estado`='$Nove_Estado', `Nove_FechaCerrar`='$Nove_FechaCerrar', `Nove_UsuarioId_Cerrar`='$Nove_UsuarioId_Cerrar'  WHERE `OPE_NovedadId`='$OPE_NovedadId'";		
		$resultado = $this->conexion->prepare($consulta);
	 	$resultado->execute();   

		$this->conexion=null;
	}  		

	function AbrirNovedadCarga($OPE_NovedadId)
	{
		$Nove_Estado = "PENDIENTE";

	 	$consulta = "UPDATE `OPE_Novedad` SET `Nove_Estado`='$Nove_Estado', `Nove_FechaCerrar`=NULL, `Nove_UsuarioId_Cerrar`=NULL WHERE `OPE_NovedadId`='$OPE_NovedadId'";		
		$resultado = $this->conexion->prepare($consulta);
	 	$resultado->execute();   

		$this->conexion=null;
	}  		

	function EliminarNovedadCarga($OPE_NovedadId)
	{
	 	$Nove_FechaEliminar = date("Y-m-d H:i:s");
	 	$Nove_UsuarioId_Eliminar = $_SESSION['USUARIO_ID'];		
	 	$Nove_Estado = "ANULADO"; 

	 	$consulta = "UPDATE `OPE_Novedad` SET `Nove_Estado`='$Nove_Estado', `Nove_FechaEliminar`='$Nove_FechaEliminar', `Nove_UsuarioId_Eliminar`='$Nove_UsuarioId_Eliminar'  WHERE `OPE_NovedadId`='$OPE_NovedadId'";		
		$resultado = $this->conexion->prepare($consulta);
	 	$resultado->execute();   

		$this->conexion=null;
	}  		

	function HistorialNovedadCarga($Novedad_Id)
	{
		$consulta="SELECT `OPE_NovedadId`,`Novedad_Id`, `Nove_ProgramacionId`, `Nove_Novedad`, `Nove_TipoNovedad`, `Nove_DetalleNovedad`, `Nove_Descripcion`, `Nove_Operacion`, `Nove_FechaOperacion`, `Nove_Dni`, `Nove_CodigoColaborador`, `Nove_NombreColaborador`, `Nove_Tabla`, `Nove_HoraOrigen`, `Nove_HoraDestino`, `Nove_Servicio`, `Nove_Bus`, `Nove_LugarOrigen`, `Nove_LugarDestino`, `Nove_LugarExacto`, `Nove_HoraInicio`, `Nove_HoraFin`, `Nove_Estado`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_NovedadEDT`.`Nove_UsuarioId` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId`, `Nove_ProcesoOrigen`, DATE_FORMAT(`Nove_Fecha`,'%d-%m-%Y %H:%i') AS `Nove_Fecha`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_NovedadEDT`.`Nove_UsuarioId_Edicion` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId_Edicion`, DATE_FORMAT(`Nove_FechaEdicion`,'%d-%m-%Y %H:%i') AS `Nove_FechaEdicion`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_NovedadEDT`.`Nove_UsuarioId_Eliminar` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId_Eliminar`, DATE_FORMAT(`Nove_FechaEliminar`,'%d-%m-%Y %H:%i') AS `Nove_FechaEliminar`, (SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `OPE_NovedadEDT`.`Nove_UsuarioId_Cerrar` = `colaborador`.`Colaborador_id`) AS `Nove_UsuarioId_Cerrar`, DATE_FORMAT(`Nove_FechaCerrar`,'%d-%m-%Y %H:%i') AS `Nove_FechaCerrar`, `Nove_Version`  FROM `OPE_NovedadEDT` WHERE `Novedad_Id`='$Novedad_Id' ORDER BY `Nove_Version` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	//::::::::::::::::::::::::::::::::::::::::: DETALLE DEL NOVEDAD :::::::::::::::::::::::::::::::::::::::::::::://

	function DetalleNovedadCarga($Nove_FechaOperacion)
	{
		$consulta="SET @ProgId=0; SET @colProgId=0;";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$consulta = "SELECT 
						`u_cf_v_ant`.`ControlFacilitador_Id` AS `ControlFacilitador_Id_ant`,
						`u_cf_v_ant`.`Prog_CodigoColaborador` AS `Prog_CodigoColaborador_ant`,
						`u_cf_v_ant`.`Prog_NombreColaborador` AS `Prog_NombreColaborador_ant`,
						`u_cf_v_ant`.`Prog_Tabla` AS `Prog_Tabla_ant`,
						TIME_FORMAT(`u_cf_v_ant`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen_ant`,
						TIME_FORMAT(`u_cf_v_ant`.`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino_ant`, 
						`u_cf_v_ant`.`Prog_Servicio` AS `Prog_Servicio_ant`,
						`u_cf_v_ant`.`Prog_ServBus` AS `Prog_ServBus_ant`,
						`u_cf_v_ant`.`Prog_Bus` AS `Prog_Bus_ant`,
						`u_cf_v_ant`.`Prog_LugarOrigen` AS `Prog_LugarOrigen_ant`,
						`u_cf_v_ant`.`Prog_LugarDestino` AS `Prog_LugarDestino_ant`,
						`u_cf_v_ant`.`Prog_TipoEvento` AS `Prog_TipoEvento_ant`,
						`u_cf_v_ant`.`Prog_Observaciones` AS `Prog_Observaciones_ant`,
						`u_cf_v_ant`.`Prog_KmXPuntos` AS `Prog_KmXPuntos_ant`,
						`u_cf_v_ant`.`Prog_Sentido` AS `Prog_Sentido_ant`,
						`u_cf_v_ant`.`Prog_TipoTabla` AS `Prog_TipoTabla_ant`,
						`u_cf_v_ant`.`Prog_NPlaca` AS `Prog_NPlaca_ant`,
						`u_cf_v_ant`.`Prog_IdManto` AS `Prog_IdManto_ant`,
						`u_cf_v_ant`.`Prog_NVid` AS `Prog_NVid_ant`,
						`u_cf_v_ant`.`CFaci_Novedad` AS `CFaci_Novedad_ant`,
						(SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `u_cf_v_ant`.`CFaci_UsuarioId` = `colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId_ant`, 
						`u_cf_v_ant`.`CFaci_Estado` AS `CFaci_Estado_ant`, 
						`u_controlfacilitador`.`ControlFacilitador_Id`,
						`u_controlfacilitador`.`Prog_CodigoColaborador`,
						`u_controlfacilitador`.`Prog_NombreColaborador`,
						`u_controlfacilitador`.`Prog_Tabla`,
						TIME_FORMAT(`u_controlfacilitador`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`,
						TIME_FORMAT(`u_controlfacilitador`.`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, 
						`u_controlfacilitador`.`Prog_Servicio`,
						`u_controlfacilitador`.`Prog_ServBus`,
						`u_controlfacilitador`.`Prog_Bus`,
						`u_controlfacilitador`.`Prog_LugarOrigen`,
						`u_controlfacilitador`.`Prog_LugarDestino`,
						`u_controlfacilitador`.`Prog_TipoEvento`,
						`u_controlfacilitador`.`Prog_Observaciones`,
						`u_controlfacilitador`.`Prog_KmXPuntos`,
						`u_controlfacilitador`.`Prog_Sentido`,
						`u_controlfacilitador`.`Prog_TipoTabla`,
						`u_controlfacilitador`.`Prog_NPlaca`,
						`u_controlfacilitador`.`Prog_NVid`,
						`u_controlfacilitador`.`Prog_IdManto`,
						`u_controlfacilitador`.`CFaci_Novedad`,
						(SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `u_controlfacilitador`.`CFaci_UsuarioId` = `colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId`, 
						`u_controlfacilitador`.`CFaci_Estado`, 
						`OPE_ControlCambiosNovedad`.`ControlNovedad_Id`, 
						`OPE_ControlCambiosNovedad`.`CNove_ProcesoOrigen`, 
						`OPE_ControlCambiosNovedad`.`CNove_ProgramacionId`, 
						`OPE_ControlCambiosNovedad`.`CNove_NovedadId`, 
						DATE_FORMAT(`OPE_ControlCambiosNovedad`.`CNove_Fecha`,'%d-%m-%Y %H:%i') AS `CNove_Fecha`,
						`OPE_ControlCambiosNovedad`.`CNove_UsuarioId`,
						`OPE_ControlCambiosNovedad`.`CNove_ControlFacilitadorId`,
						`OPE_ControlCambiosNovedad`.`CNove_TipoOrigen`,
						`u_novedad`.`Novedad_Id`,
						`u_novedad`.`Nove_Novedad`,
						`u_novedad`.`Nove_TipoNovedad`,
						IF(@ProgId!=`OPE_ControlCambiosNovedad`.`CNove_ProgramacionId`, IF(@colProgId=0, @colProgId:=1, @colProgId:=0 ), @colProgId := @colProgId ) AS `colProgId`,
						(CASE WHEN @ProgId!=`OPE_ControlCambiosNovedad`.`CNove_ProgramacionId` THEN @ProgId:=`CNove_ProgramacionId` END ) AS `xB` 
					FROM 
						`OPE_ControlCambiosNovedad` 
					LEFT JOIN 
						(SELECT 
							`OPE_NovedadId`,
							`Novedad_Id`,
							`Nove_Version`,
							`Nove_Novedad`,
							`Nove_TipoNovedad`
						FROM 
							`OPE_Novedad`
						UNION
						SELECT 
							`OPE_NovedadId`,
							`Novedad_Id`,
							`Nove_Version`,
							`Nove_Novedad`,
							`Nove_TipoNovedad` 
						FROM 
							`OPE_NovedadEDT`) `u_novedad`
					ON 
						`u_novedad`.`OPE_NovedadId`=`OPE_ControlCambiosNovedad`.`CNove_OPENovedadId` AND 
						`u_novedad`.`Nove_Version`=`OPE_ControlCambiosNovedad`.`CNove_NoveVersion` 
					LEFT JOIN 
						(SELECT 
							`ControlFacilitador_Id`, 
							`Prog_CodigoColaborador`, 
							`Prog_NombreColaborador`, 
							`Prog_Tabla`, 
							`Prog_HoraOrigen`, 
							`Prog_HoraDestino`, 
							`Prog_Servicio`, 
							`Prog_ServBus`, 
							`Prog_Bus`, 
							`Prog_LugarOrigen`, 
							`Prog_LugarDestino`, 
							`Prog_TipoEvento`, 
							`Prog_Observaciones`, 
							`Prog_KmXPuntos`, 
							`Prog_Sentido`,
							`Prog_TipoTabla`, 
							`Prog_NPlaca`, 
							`Prog_NVid`,
							`Prog_IdManto`,
							`CFaci_Novedad`, 
							`CFaci_UsuarioId`, 
							`CFaci_Estado`, 
							`CFaci_Version` 
						FROM 
							`OPE_ControlFacilitador` 
						UNION 
						SELECT 
							`ControlFacilitador_Id`, 
							`Prog_CodigoColaborador`, 
							`Prog_NombreColaborador`,
							`Prog_Tabla`,
							`Prog_HoraOrigen`,
							`Prog_HoraDestino`,
							`Prog_Servicio`,
							`Prog_ServBus`,
							`Prog_Bus`,
							`Prog_LugarOrigen`,
							`Prog_LugarDestino`,
							`Prog_TipoEvento`,
							`Prog_Observaciones`,
							`Prog_KmXPuntos`,
							`Prog_Sentido`,
							`Prog_TipoTabla`,
							`Prog_NPlaca`,
							`Prog_NVid`,
							`Prog_IdManto`,
							`CFaci_Novedad`,
							`CFaci_UsuarioId`,
							`CFaci_Estado`,
							`CFaci_Version`
						FROM 
							`OPE_ControlFacilitadorEDT`) `u_controlfacilitador` 
					ON 
						`OPE_ControlCambiosNovedad`.`CNove_ControlFacilitadorId`=`u_controlfacilitador`.`ControlFacilitador_Id` AND 
						`OPE_ControlCambiosNovedad`.`CNOVE_CFaciVersion`=`u_controlfacilitador`.`CFaci_Version`
					LEFT JOIN 
						(SELECT 
							`ControlFacilitador_Id`, 
							`Prog_CodigoColaborador`, 
							`Prog_NombreColaborador`, 
							`Prog_Tabla`, 
							`Prog_HoraOrigen`, 
							`Prog_HoraDestino`, 
							`Prog_Servicio`, 
							`Prog_ServBus`, 
							`Prog_Bus`, 
							`Prog_LugarOrigen`, 
							`Prog_LugarDestino`, 
							`Prog_TipoEvento`, 
							`Prog_Observaciones`, 
							`Prog_KmXPuntos`, 
							`Prog_Sentido`,
							`Prog_TipoTabla`, 
							`Prog_NPlaca`, 
							`Prog_NVid`, 
							`Prog_IdManto`,
							`CFaci_Novedad`, 
							`CFaci_UsuarioId`, 
							`CFaci_Estado`, 
							`CFaci_Version` 
						FROM 
							`OPE_ControlFacilitador` 
						UNION 
						SELECT 
							`ControlFacilitador_Id`, 
							`Prog_CodigoColaborador`, 
							`Prog_NombreColaborador`,
							`Prog_Tabla`,
							`Prog_HoraOrigen`,
							`Prog_HoraDestino`,
							`Prog_Servicio`,
							`Prog_ServBus`,
							`Prog_Bus`,
							`Prog_LugarOrigen`,
							`Prog_LugarDestino`,
							`Prog_TipoEvento`,
							`Prog_Observaciones`,
							`Prog_KmXPuntos`,
							`Prog_Sentido`,
							`Prog_TipoTabla`,
							`Prog_NPlaca`,
							`Prog_NVid`,
							`Prog_IdManto`,
							`CFaci_Novedad`,
							`CFaci_UsuarioId`,
							`CFaci_Estado`,
							`CFaci_Version`
						FROM 
							`OPE_ControlFacilitadorEDT`) `u_cf_v_ant` 
					ON 
						`OPE_ControlCambiosNovedad`.`CNove_ControlFacilitadorId`=`u_cf_v_ant`.`ControlFacilitador_Id` AND 
						(`OPE_ControlCambiosNovedad`.`CNOVE_CFaciVersion`-1)=`u_cf_v_ant`.`CFaci_Version` 
					WHERE 
						`OPE_ControlCambiosNovedad`.`CNove_FechaOperacion`='$Nove_FechaOperacion' 
					ORDER BY 
						`OPE_ControlCambiosNovedad`.`CNove_NovedadId`,`OPE_ControlCambiosNovedad`.`CNove_Fecha`, `OPE_ControlCambiosNovedad`.`CNove_ProgramacionId` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}

	function detalle_novedad_carga_hist($Nove_FechaOperacion)
	{
		$consulta="SET @ProgId=0; SET @colProgId=0;";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$consulta = "SELECT 
						`u_cf_v_ant`.`ControlFacilitador_Id` AS `ControlFacilitador_Id_ant`,
						`u_cf_v_ant`.`Prog_CodigoColaborador` AS `Prog_CodigoColaborador_ant`,
						`u_cf_v_ant`.`Prog_NombreColaborador` AS `Prog_NombreColaborador_ant`,
						`u_cf_v_ant`.`Prog_Tabla` AS `Prog_Tabla_ant`,
						TIME_FORMAT(`u_cf_v_ant`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen_ant`,
						TIME_FORMAT(`u_cf_v_ant`.`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino_ant`, 
						`u_cf_v_ant`.`Prog_Servicio` AS `Prog_Servicio_ant`,
						`u_cf_v_ant`.`Prog_ServBus` AS `Prog_ServBus_ant`,
						`u_cf_v_ant`.`Prog_Bus` AS `Prog_Bus_ant`,
						`u_cf_v_ant`.`Prog_LugarOrigen` AS `Prog_LugarOrigen_ant`,
						`u_cf_v_ant`.`Prog_LugarDestino` AS `Prog_LugarDestino_ant`,
						`u_cf_v_ant`.`Prog_TipoEvento` AS `Prog_TipoEvento_ant`,
						`u_cf_v_ant`.`Prog_Observaciones` AS `Prog_Observaciones_ant`,
						`u_cf_v_ant`.`Prog_KmXPuntos` AS `Prog_KmXPuntos_ant`,
						`u_cf_v_ant`.`Prog_Sentido` AS `Prog_Sentido_ant`,
						`u_cf_v_ant`.`Prog_TipoTabla` AS `Prog_TipoTabla_ant`,
						`u_cf_v_ant`.`Prog_NPlaca` AS `Prog_NPlaca_ant`,
						`u_cf_v_ant`.`Prog_IdManto` AS `Prog_IdManto_ant`,
						`u_cf_v_ant`.`Prog_NVid` AS `Prog_NVid_ant`,
						`u_cf_v_ant`.`CFaci_Novedad` AS `CFaci_Novedad_ant`,
						(SELECT `Colab_nombre_corto` FROM `BDLIMABUS`.`colaborador` WHERE `u_cf_v_ant`.`CFaci_UsuarioId` = `colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId_ant`, 
						`u_cf_v_ant`.`CFaci_Estado` AS `CFaci_Estado_ant`, 
						`u_controlfacilitador`.`ControlFacilitador_Id`,
						`u_controlfacilitador`.`Prog_CodigoColaborador`,
						`u_controlfacilitador`.`Prog_NombreColaborador`,
						`u_controlfacilitador`.`Prog_Tabla`,
						TIME_FORMAT(`u_controlfacilitador`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`,
						TIME_FORMAT(`u_controlfacilitador`.`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, 
						`u_controlfacilitador`.`Prog_Servicio`,
						`u_controlfacilitador`.`Prog_ServBus`,
						`u_controlfacilitador`.`Prog_Bus`,
						`u_controlfacilitador`.`Prog_LugarOrigen`,
						`u_controlfacilitador`.`Prog_LugarDestino`,
						`u_controlfacilitador`.`Prog_TipoEvento`,
						`u_controlfacilitador`.`Prog_Observaciones`,
						`u_controlfacilitador`.`Prog_KmXPuntos`,
						`u_controlfacilitador`.`Prog_Sentido`,
						`u_controlfacilitador`.`Prog_TipoTabla`,
						`u_controlfacilitador`.`Prog_NPlaca`,
						`u_controlfacilitador`.`Prog_NVid`,
						`u_controlfacilitador`.`Prog_IdManto`,
						`u_controlfacilitador`.`CFaci_Novedad`,
						(SELECT `Colab_nombre_corto` FROM `BDLIMABUS`.`colaborador` WHERE `u_controlfacilitador`.`CFaci_UsuarioId` = `colaborador`.`Colaborador_id`) AS `CFaci_UsuarioId`, 
						`u_controlfacilitador`.`CFaci_Estado`, 
						`OPE_ControlCambiosNovedad`.`ControlNovedad_Id`, 
						`OPE_ControlCambiosNovedad`.`CNove_ProcesoOrigen`, 
						`OPE_ControlCambiosNovedad`.`CNove_ProgramacionId`, 
						`OPE_ControlCambiosNovedad`.`CNove_NovedadId`, 
						DATE_FORMAT(`OPE_ControlCambiosNovedad`.`CNove_Fecha`,'%d-%m-%Y %H:%i') AS `CNove_Fecha`,
						`OPE_ControlCambiosNovedad`.`CNove_UsuarioId`,
						`OPE_ControlCambiosNovedad`.`CNove_ControlFacilitadorId`,
						`OPE_ControlCambiosNovedad`.`CNove_TipoOrigen`,
						`u_novedad`.`Novedad_Id`,
						`u_novedad`.`Nove_Novedad`,
						`u_novedad`.`Nove_TipoNovedad`,
						IF(@ProgId!=`OPE_ControlCambiosNovedad`.`CNove_ProgramacionId`, IF(@colProgId=0, @colProgId:=1, @colProgId:=0 ), @colProgId := @colProgId ) AS `colProgId`,
						(CASE WHEN @ProgId!=`OPE_ControlCambiosNovedad`.`CNove_ProgramacionId` THEN @ProgId:=`CNove_ProgramacionId` END ) AS `xB` 
					FROM 
						`BDLIMABUS`.`OPE_ControlCambiosNovedad` 
					LEFT JOIN 
						(SELECT 
							`OPE_NovedadId`,
							`Novedad_Id`,
							`Nove_Version`,
							`Nove_Novedad`,
							`Nove_TipoNovedad`
						FROM 
							`BDLIMABUS`.`OPE_Novedad`
						UNION
						SELECT 
							`OPE_NovedadId`,
							`Novedad_Id`,
							`Nove_Version`,
							`Nove_Novedad`,
							`Nove_TipoNovedad` 
						FROM 
							`BDLIMABUS`.`OPE_NovedadEDT`) `u_novedad`
					ON 
						`u_novedad`.`OPE_NovedadId`=`OPE_ControlCambiosNovedad`.`CNove_OPENovedadId` AND 
						`u_novedad`.`Nove_Version`=`OPE_ControlCambiosNovedad`.`CNove_NoveVersion` 
					LEFT JOIN 
						(SELECT 
							`ControlFacilitador_Id`, 
							`Prog_CodigoColaborador`, 
							`Prog_NombreColaborador`, 
							`Prog_Tabla`, 
							`Prog_HoraOrigen`, 
							`Prog_HoraDestino`, 
							`Prog_Servicio`, 
							`Prog_ServBus`, 
							`Prog_Bus`, 
							`Prog_LugarOrigen`, 
							`Prog_LugarDestino`, 
							`Prog_TipoEvento`, 
							`Prog_Observaciones`, 
							`Prog_KmXPuntos`, 
							`Prog_Sentido`,
							`Prog_TipoTabla`, 
							`Prog_NPlaca`, 
							`Prog_NVid`,
							`Prog_IdManto`,
							`CFaci_Novedad`, 
							`CFaci_UsuarioId`, 
							`CFaci_Estado`, 
							`CFaci_Version` 
						FROM 
							`bdlimabus_hist`.`OPE_ControlFacilitador` 
						UNION 
						SELECT 
							`ControlFacilitador_Id`, 
							`Prog_CodigoColaborador`, 
							`Prog_NombreColaborador`,
							`Prog_Tabla`,
							`Prog_HoraOrigen`,
							`Prog_HoraDestino`,
							`Prog_Servicio`,
							`Prog_ServBus`,
							`Prog_Bus`,
							`Prog_LugarOrigen`,
							`Prog_LugarDestino`,
							`Prog_TipoEvento`,
							`Prog_Observaciones`,
							`Prog_KmXPuntos`,
							`Prog_Sentido`,
							`Prog_TipoTabla`,
							`Prog_NPlaca`,
							`Prog_NVid`,
							`Prog_IdManto`,
							`CFaci_Novedad`,
							`CFaci_UsuarioId`,
							`CFaci_Estado`,
							`CFaci_Version`
						FROM 
							`BDLIMABUS`.`OPE_ControlFacilitadorEDT`) `u_controlfacilitador` 
					ON 
						`OPE_ControlCambiosNovedad`.`CNove_ControlFacilitadorId`=`u_controlfacilitador`.`ControlFacilitador_Id` AND 
						`OPE_ControlCambiosNovedad`.`CNOVE_CFaciVersion`=`u_controlfacilitador`.`CFaci_Version`
					LEFT JOIN 
						(SELECT 
							`ControlFacilitador_Id`, 
							`Prog_CodigoColaborador`, 
							`Prog_NombreColaborador`, 
							`Prog_Tabla`, 
							`Prog_HoraOrigen`, 
							`Prog_HoraDestino`, 
							`Prog_Servicio`, 
							`Prog_ServBus`, 
							`Prog_Bus`, 
							`Prog_LugarOrigen`, 
							`Prog_LugarDestino`, 
							`Prog_TipoEvento`, 
							`Prog_Observaciones`, 
							`Prog_KmXPuntos`, 
							`Prog_Sentido`,
							`Prog_TipoTabla`, 
							`Prog_NPlaca`, 
							`Prog_NVid`, 
							`Prog_IdManto`,
							`CFaci_Novedad`, 
							`CFaci_UsuarioId`, 
							`CFaci_Estado`, 
							`CFaci_Version` 
						FROM 
							`bdlimabus_hist`.`OPE_ControlFacilitador` 
						UNION 
						SELECT 
							`ControlFacilitador_Id`, 
							`Prog_CodigoColaborador`, 
							`Prog_NombreColaborador`,
							`Prog_Tabla`,
							`Prog_HoraOrigen`,
							`Prog_HoraDestino`,
							`Prog_Servicio`,
							`Prog_ServBus`,
							`Prog_Bus`,
							`Prog_LugarOrigen`,
							`Prog_LugarDestino`,
							`Prog_TipoEvento`,
							`Prog_Observaciones`,
							`Prog_KmXPuntos`,
							`Prog_Sentido`,
							`Prog_TipoTabla`,
							`Prog_NPlaca`,
							`Prog_NVid`,
							`Prog_IdManto`,
							`CFaci_Novedad`,
							`CFaci_UsuarioId`,
							`CFaci_Estado`,
							`CFaci_Version`
						FROM 
							`BDLIMABUS`.`OPE_ControlFacilitadorEDT`) `u_cf_v_ant` 
					ON 
						`OPE_ControlCambiosNovedad`.`CNove_ControlFacilitadorId`=`u_cf_v_ant`.`ControlFacilitador_Id` AND 
						(`OPE_ControlCambiosNovedad`.`CNOVE_CFaciVersion`-1)=`u_cf_v_ant`.`CFaci_Version` 
					WHERE 
						`OPE_ControlCambiosNovedad`.`CNove_FechaOperacion`='$Nove_FechaOperacion' 
					ORDER BY 
						`OPE_ControlCambiosNovedad`.`CNove_NovedadId`,`OPE_ControlCambiosNovedad`.`CNove_Fecha`, `OPE_ControlCambiosNovedad`.`CNove_ProgramacionId` ASC";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}

	//:::::::::::::::::::::::::::::::::::::::::: GENERALES :::::::::::::::::::::::::::::::::::::::::::::::::::::://

	function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
	{
		$consulta="SELECT * FROM `$TablaBD` WHERE `$CampoBD` = '$DataBuscar'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;

	}

	function TablaVacia($NombreTabla)
	{
		$consulta="SELECT COUNT(*) AS `Contar` FROM `$NombreTabla` ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function Botones($Objeto, $Tipo, $Nombre, $Estado)
	{
		$rptaData = "";

		if($Estado == ""){
			$consulta="SELECT * FROM `GLO_Html` WHERE `Html_Objeto` = '$Objeto' AND `Html_Tipo` = '$Tipo' AND `Html_Nombre` = '$Nombre'";	
		}else{
			$consulta="SELECT * FROM `GLO_Html` WHERE `Html_Objeto` = '$Objeto' AND `Html_Tipo` = '$Tipo' AND `Html_Nombre` = '$Nombre' AND `Html_Estado` = '$Estado'";
		}
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $row){
			$rptaData = $row['Html_Data'];
		}

		return $rptaData;
		$this->conexion=null;

	}

	function ResumenOperacion($Prog_Fecha)
	{
		$consulta = "SELECT `Nove_TipoNovedad`, COUNT(*) AS `cantidad` FROM `OPE_Novedad` WHERE `Nove_FechaOperacion` = '$Prog_Fecha' GROUP BY `Nove_TipoNovedad` ORDER BY COUNT(*) ASC";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function CambioBus($Prog_Fecha)
	{
		$CNove_TipoOrigen = 'ASOCIACION';
		$consulta = "SELECT DISTINCT `ucf`.`Prog_Bus`, `OPE_ControlFacilitadorEDT`.`Prog_Bus` AS `busanterior` FROM `OPE_ControlCambiosNovedad` LEFT JOIN `OPE_Novedad` ON `Novedad_Id`=`CNove_NovedadId` LEFT JOIN `OPE_ControlFacilitadorEDT` ON `ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNove_CFaciVersion`-1 LEFT JOIN (SELECT `ControlFacilitador_Id`, `Prog_Fecha`, `CFaci_Version`, `Prog_Bus` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' UNION SELECT `ControlFacilitador_Id`, `Prog_Fecha`, `CFaci_Version`, `Prog_Bus` FROM `OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$Prog_Fecha') AS `ucf` ON `ucf`.`ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `ucf`.`CFaci_Version`=`CNove_CFaciVersion` AND `ucf`.`Prog_Fecha`='$Prog_Fecha' WHERE `CNove_TipoOrigen`='$CNove_TipoOrigen' AND `CNove_CFaciVersion`>'1' AND `CNove_FechaOperacion`='$Prog_Fecha' AND `ucf`.`Prog_Bus`<>`OPE_ControlFacilitadorEDT`.`Prog_Bus`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->rowCount();
		
		return $data;
		$this->conexion=null;
	}

	function cambio_bus_hist($Prog_Fecha)
	{
		$CNove_TipoOrigen = 'ASOCIACION';
		$consulta = "SELECT DISTINCT `ucf`.`Prog_Bus`, `OPE_ControlFacilitadorEDT`.`Prog_Bus` AS `busanterior` FROM `OPE_ControlCambiosNovedad` LEFT JOIN `OPE_Novedad` ON `Novedad_Id`=`CNove_NovedadId` LEFT JOIN `OPE_ControlFacilitadorEDT` ON `ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNove_CFaciVersion`-1 LEFT JOIN (SELECT `ControlFacilitador_Id`, `Prog_Fecha`, `CFaci_Version`, `Prog_Bus` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' UNION SELECT `ControlFacilitador_Id`, `Prog_Fecha`, `CFaci_Version`, `Prog_Bus` FROM `OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$Prog_Fecha') AS `ucf` ON `ucf`.`ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `ucf`.`CFaci_Version`=`CNove_CFaciVersion` AND `ucf`.`Prog_Fecha`='$Prog_Fecha' WHERE `CNove_TipoOrigen`='$CNove_TipoOrigen' AND `CNove_CFaciVersion`>'1' AND `CNove_FechaOperacion`='$Prog_Fecha' AND `ucf`.`Prog_Bus`<>`OPE_ControlFacilitadorEDT`.`Prog_Bus`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->rowCount();
		
		return $data;
		$this->conexion=null;
	}

	function varadas($Prog_Fecha)
	{
		$consulta = "SELECT `Nove_TipoNovedad`,`Nove_DetalleNovedad`, COUNT(*) AS `cantidad` FROM `OPE_Novedad` WHERE `Nove_FechaOperacion` = '$Prog_Fecha' AND `Nove_TipoNovedad`='FALLA_BUS' AND `Nove_DetalleNovedad`='CON_VARADA' GROUP BY `Nove_TipoNovedad`, `Nove_DetalleNovedad` ORDER BY COUNT(*) ASC";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function cambio_piloto($Prog_Fecha)
	{
		$CNove_TipoOrigen = 'ASOCIACION';
		$consulta = "SELECT DISTINCT `ucf`.`Prog_Dni`, `OPE_ControlFacilitadorEDT`.`Prog_Dni` AS `busanterior` FROM `OPE_ControlCambiosNovedad` LEFT JOIN `OPE_Novedad` ON `Novedad_Id`=`CNove_NovedadId` LEFT JOIN `OPE_ControlFacilitadorEDT` ON `ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNove_CFaciVersion`-1 LEFT JOIN (SELECT `ControlFacilitador_Id`, `Prog_Fecha`, `CFaci_Version`, `Prog_Dni` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' UNION SELECT `ControlFacilitador_Id`, `Prog_Fecha`, `CFaci_Version`, `Prog_Dni` FROM `OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$Prog_Fecha') AS `ucf` ON `ucf`.`ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `ucf`.`CFaci_Version`=`CNove_CFaciVersion` AND `ucf`.`Prog_Fecha`='$Prog_Fecha' WHERE `CNove_TipoOrigen`='$CNove_TipoOrigen' AND `CNove_CFaciVersion`>'1' AND `CNove_FechaOperacion`='$Prog_Fecha' AND `ucf`.`Prog_Dni`<>`OPE_ControlFacilitadorEDT`.`Prog_Dni`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->rowCount();
		
		return $data;
		$this->conexion=null;
	}

	function cambio_piloto_hist($Prog_Fecha)
	{
		$CNove_TipoOrigen = 'ASOCIACION';
		$consulta = "SELECT DISTINCT `ucf`.`Prog_Dni`, `OPE_ControlFacilitadorEDT`.`Prog_Dni` AS `busanterior` FROM `OPE_ControlCambiosNovedad` LEFT JOIN `OPE_Novedad` ON `Novedad_Id`=`CNove_NovedadId` LEFT JOIN `OPE_ControlFacilitadorEDT` ON `ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNove_CFaciVersion`-1 LEFT JOIN (SELECT `ControlFacilitador_Id`, `Prog_Fecha`, `CFaci_Version`, `Prog_Dni` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` WHERE `Prog_Fecha`='$Prog_Fecha' UNION SELECT `ControlFacilitador_Id`, `Prog_Fecha`, `CFaci_Version`, `Prog_Dni` FROM `OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$Prog_Fecha') AS `ucf` ON `ucf`.`ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `ucf`.`CFaci_Version`=`CNove_CFaciVersion` AND `ucf`.`Prog_Fecha`='$Prog_Fecha' WHERE `CNove_TipoOrigen`='$CNove_TipoOrigen' AND `CNove_CFaciVersion`>'1' AND `CNove_FechaOperacion`='$Prog_Fecha' AND `ucf`.`Prog_Dni`<>`OPE_ControlFacilitadorEDT`.`Prog_Dni`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->rowCount();
		
		return $data;
		$this->conexion=null;
	}

	function km_comercial($prog_fecha)
	{
		$tipo_evento = "('EXPEDICION', 'VIAJE ADICIONAL', 'VACIO - O')";
		$consulta = "	SELECT
							`Prog_Operacion`,
							ROUND(SUM(`Prog_KmXPuntos`),2) AS `km_comercial`
						FROM
							`OPE_ControlFacilitador`
						WHERE
							`Prog_Fecha`='$prog_fecha' AND
							`Prog_TipoEvento` IN $tipo_evento
						GROUP BY
							`Prog_Operacion`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;

	}

	function km_comercial_hist($prog_fecha)
	{
		$tipo_evento = "('EXPEDICION', 'VIAJE ADICIONAL', 'VACIO - O')";
		$consulta = "	SELECT
							`Prog_Operacion`,
							ROUND(SUM(`Prog_KmXPuntos`),2) AS `km_comercial`
						FROM
						`bdlimabus_hist`.`OPE_ControlFacilitador`
						WHERE
							`Prog_Fecha`='$prog_fecha' AND
							`Prog_TipoEvento` IN $tipo_evento
						GROUP BY
							`Prog_Operacion`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;

	}

	function km_adicional($Prog_Fecha, $prog_operacion)
	{
		$consulta = "SELECT ROUND(SUM(`Prog_KmXPuntos`),3) AS `km_adicional` FROM `OPE_ControlFacilitador` WHERE `Prog_TipoEvento`='VIAJE ADICIONAL' AND `Prog_Fecha`='$Prog_Fecha' AND `Prog_Operacion`='$prog_operacion'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function km_adicional_hist($Prog_Fecha, $prog_operacion)
	{
		$consulta = "SELECT ROUND(SUM(`Prog_KmXPuntos`),3) AS `km_adicional` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` WHERE `Prog_TipoEvento`='VIAJE ADICIONAL' AND `Prog_Fecha`='$Prog_Fecha' AND `Prog_Operacion`='$prog_operacion'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function km_perdido($Prog_Fecha, $prog_operacion)
	{
		$consulta = "SELECT ROUND(SUM(`Prog_KmXPuntos`),3) AS `km_perdido` FROM `OPE_ControlFacilitador` WHERE `Prog_TipoEvento`='VIAJE PERDIDO' AND `Prog_Fecha`='$Prog_Fecha'  AND `Prog_Operacion`='$prog_operacion'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function km_perdido_hist($Prog_Fecha, $prog_operacion)
	{
		$consulta = "SELECT ROUND(SUM(`Prog_KmXPuntos`),3) AS `km_perdido` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` WHERE `Prog_TipoEvento`='VIAJE PERDIDO' AND `Prog_Fecha`='$Prog_Fecha'  AND `Prog_Operacion`='$prog_operacion'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function BusesReten($Prog_Fecha)
	{
		$consulta = "SELECT COUNT(*) AS `busesreten` FROM `OPE_ControlFacilitador` WHERE `Prog_Servicio`='BUS RETEN' AND `Prog_Fecha`='$Prog_Fecha' AND `Prog_Bus`<>'00000' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function buses_reten_hist($Prog_Fecha)
	{
		$consulta = "SELECT COUNT(*) AS `busesreten` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` WHERE `Prog_Servicio`='BUS RETEN' AND `Prog_Fecha`='$Prog_Fecha' AND `Prog_Bus`<>'00000' ";
		$resultado = $this->conexion2->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion2=null;
	}

	function RetrasoOperacion($Prog_Fecha)
	{
		$consulta = "SELECT COUNT(*) AS `retrasooperacion` FROM `OPE_ControlFacilitadorReportes` LEFT JOIN `OPE_ControlFacilitador` ON `Repo_ControlFacilitadorId`=`ControlFacilitador_Id` WHERE `Repo_TipoId`='DESPACHOFLOTA' AND `Prog_Fecha`='$Prog_Fecha' AND `Repo_Estado`='ATENDIDO' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function retraso_operacion_hist($Prog_Fecha)
	{
		$consulta = "SELECT COUNT(*) AS `retrasooperacion` FROM `OPE_ControlFacilitadorReportes` LEFT JOIN `bdlimabus_hist`.`OPE_ControlFacilitador` ON `Repo_ControlFacilitadorId`=`ControlFacilitador_Id` WHERE `Repo_TipoId`='DESPACHOFLOTA' AND `Prog_Fecha`='$Prog_Fecha' AND `Repo_Estado`='ATENDIDO' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function NombreUsuario()
	{
        if (isset($_SESSION['USUARIO_ID'])) {
            $Usuario_Id = $_SESSION['USUARIO_ID'];
            
            $consulta = "SELECT `Colab_nombre_corto` AS `nombrecorto` FROM `colaborador` WHERE `Colaborador_id` = '$Usuario_Id' ";
            $resultado = $this->conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
		$this->conexion=null;
	}

	function Reporteop($fechaReporteop,$tipoReporteop,$operacionReporteop)
	{
		if($tipoReporteop=='NOVEDADES'){
			$consulta = "	SELECT 
								`Nove_UsuarioId` AS 'cgo_dni', 
								(SELECT `Colab_nombre_corto` FROM `colaborador` WHERE `Colaborador_id`=`Nove_UsuarioId`) AS `cgo_nombres`,
								UPPER(DATE_FORMAT(`Nove_FechaOperacion`,'%W')) AS `dia`,
								`Nove_FechaOperacion` AS `fecha`,
								`Nove_CodigoColaborador` AS `piloto_codigo`,
								`Nove_Dni` AS `piloto_dni`,
								`Nove_NombreColaborador` AS `piloto_nombres`,
								`Nove_Tabla` AS `tabla`,
								TIME_FORMAT(`Nove_HoraOrigen`,'%H:%i') AS `hora_origen`,
								TIME_FORMAT(`Nove_HoraDestino`,'%H:%i') AS `hora_destino`,
								`Nove_Servicio` AS `servicio`,
								`Nove_Bus` AS `bus`,
								`Nove_LugarOrigen` AS `lugar_origen`,
								`Nove_LugarDestino` AS `lugar_destino`,
								`Novedad_Id` AS `novedad_id`,
								`Prog_TipoTabla` AS `turno`,
								`Nove_Novedad` AS `novedad_1`,
								`Nove_TipoNovedad` AS `tipo_novedad_1`,
								`Nove_DetalleNovedad` AS `detalle_novedad_1`,
								`Nove_Descripcion` AS `descripcion_adicional`
							FROM 
								`OPE_Novedad`
							LEFT JOIN
								`OPE_ControlFacilitador`
							ON
								`OPE_ControlFacilitador`.`Programacion_Id`=`OPE_Novedad`.`Nove_ProgramacionId`
							WHERE 
								`Nove_FechaOperacion`='$fechaReporteop' AND 
								`Nove_Operacion`='$operacionReporteop'";
		}else{
			$CFaci_Version = '1';
			$consulta="SET @bus=''; SET @colBus=0; SET @tabla=''; SET @colTabla=0;";
			$resultado = $this->conexion->prepare($consulta);
			$resultado->execute();        
	
			switch ($tipoReporteop)
			{
				case 'CONTROL FACILITADOR ORIGINAL':
					$consulta = "SELECT `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT(`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, ROUND(`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, '' AS `busanterior`, '' AS `pilotoanterior`, '' AS `CNove_NovedadId`, '' AS `Nove_Novedad`, '' AS `Nove_TipoNovedad`, '' AS `Nove_DetalleNovedad`, '' AS `Nove_Descripcion`, `Prog_Viajes` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop' AND `CFaci_Version`='$CFaci_Version' UNION SELECT `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT(`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, ROUND(`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, '' AS `busanterior`, '' AS `pilotoanterior`, '' AS `CNove_NovedadId`, '' AS `Nove_Novedad`, '' AS `Nove_TipoNovedad`, '' AS `Nove_DetalleNovedad`, '' AS `Nove_Descripcion`, `Prog_Viajes` FROM `OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop' AND `CFaci_Version`='$CFaci_Version'";
				break;
				
				case 'CAMBIO BUS':
					$consulta="SELECT 
					`CNove_ControlFacilitadorId` AS `ControlFacilitador_Id`, `CNOVE_CFaciVersion`, `ucf`.`Prog_Dni`, `ucf`.`Prog_CodigoColaborador`, `ucf`.`Prog_NombreColaborador`, `ucf`.`Prog_Tabla`, TIME_FORMAT(`ucf`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`ucf`.`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `ucf`.`Prog_Servicio`, `ucf`.`Prog_ServBus`, `ucf`.`Prog_Bus`, `ucf`.`Prog_LugarOrigen`, `ucf`.`Prog_LugarDestino`, `ucf`.`Prog_TipoEvento`, `ucf`.`Prog_Observaciones`, ROUND(`ucf`.`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`,`ucf`.`Prog_TipoTabla`, `ucf`.`Prog_NPlaca`, `ucf`.`Prog_NVid`, `ucf`.`Prog_IdManto`, `ucf`.`Prog_Sentido`, `ucf`.`Prog_BusManto`, `ucf`.`Prog_colBus`, `ucf`.`Prog_colTabla`, `OPE_ControlFacilitadorEDT`.`Prog_bus` AS `busanterior`, `CNove_NovedadId`, `CNOVE_NoveVersion`, `OPE_Novedad`.`Nove_Novedad`, `OPE_Novedad`.`Nove_TipoNovedad`, `OPE_Novedad`.`Nove_DetalleNovedad`, `OPE_Novedad`.`Nove_Descripcion`, '' AS `pilotoanterior`, `ucf`.`Prog_Viajes`
					FROM 
						`OPE_ControlCambiosNovedad` 
					LEFT JOIN `OPE_Novedad` 
						ON `Novedad_Id`=`CNove_NovedadId` 
					LEFT JOIN `OPE_ControlFacilitadorEDT` 
						ON `ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNove_CFaciVersion`-1 
					LEFT JOIN (SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Fecha`, `Prog_Operacion`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, `Prog_Viajes` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop' UNION SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Fecha`, `Prog_Operacion`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, `Prog_Viajes` FROM `OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop') AS `ucf` ON `ucf`.`ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `ucf`.`CFaci_Version`=`CNove_CFaciVersion` AND `ucf`.`Prog_Fecha`='$fechaReporteop' AND `ucf`.`Prog_Operacion`='$operacionReporteop'
					WHERE 
					`CNove_TipoOrigen`='ASOCIACION' AND `CNove_CFaciVersion`>'1' AND `CNove_FechaOperacion`='$fechaReporteop' AND `ucf`.`Prog_Bus`<>`OPE_ControlFacilitadorEDT`.`Prog_bus` AND `ucf`.`Prog_Operacion`='$operacionReporteop'";
				break;
	
				case 'CAMBIO PILOTO':
					$consulta="SELECT 
					`CNove_ControlFacilitadorId` AS `ControlFacilitador_Id`, `CNOVE_CFaciVersion`, `ucf`.`Prog_Dni`, `ucf`.`Prog_CodigoColaborador`, `ucf`.`Prog_NombreColaborador`, `ucf`.`Prog_Tabla`, TIME_FORMAT(`ucf`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`ucf`.`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `ucf`.`Prog_Servicio`, `ucf`.`Prog_ServBus`, `ucf`.`Prog_Bus`, `ucf`.`Prog_LugarOrigen`, `ucf`.`Prog_LugarDestino`, `ucf`.`Prog_TipoEvento`, `ucf`.`Prog_Observaciones`, ROUND(`ucf`.`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`,`ucf`.`Prog_TipoTabla`, `ucf`.`Prog_NPlaca`, `ucf`.`Prog_NVid`, `ucf`.`Prog_IdManto`, `ucf`.`Prog_Sentido`, `ucf`.`Prog_BusManto`, `ucf`.`Prog_colBus`, `ucf`.`Prog_colTabla`, '' AS `busanterior`, `CNove_NovedadId`, `CNOVE_NoveVersion`, `OPE_Novedad`.`Nove_Novedad`, `OPE_Novedad`.`Nove_TipoNovedad`, `OPE_Novedad`.`Nove_DetalleNovedad`, `OPE_Novedad`.`Nove_Descripcion`, `OPE_ControlFacilitadorEDT`.`Prog_NombreColaborador` AS `pilotoanterior`, `ucf`.`Prog_Viajes`
					FROM 
						`OPE_ControlCambiosNovedad` 
					LEFT JOIN `OPE_Novedad` 
						ON `Novedad_Id`=`CNove_NovedadId` 
					LEFT JOIN `OPE_ControlFacilitadorEDT` 
						ON `ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNove_CFaciVersion`-1 
					LEFT JOIN (SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Fecha`, `Prog_Operacion`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, `Prog_Viajes` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop' UNION SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Fecha`, `Prog_Operacion`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, `Prog_Viajes` FROM `OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop') AS `ucf` ON `ucf`.`ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `ucf`.`CFaci_Version`=`CNove_CFaciVersion` AND `ucf`.`Prog_Fecha`='$fechaReporteop' AND `ucf`.`Prog_Operacion`='$operacionReporteop'
					WHERE 
					`CNove_TipoOrigen`='ASOCIACION' AND `CNove_CFaciVersion`>'1' AND `CNove_FechaOperacion`='$fechaReporteop' AND `ucf`.`Prog_Dni`<>`OPE_ControlFacilitadorEDT`.`Prog_Dni` AND `ucf`.`Prog_Operacion`='$operacionReporteop'";
				break;
	
				case 'HISTORIAL CAMBIOS':
					$consulta = "SELECT `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT(`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, ROUND(`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, '' AS `busanterior`, '' AS `pilotoanterior`, '' AS `CNove_NovedadId`, '' AS `Nove_Novedad`, '' AS `Nove_TipoNovedad`, '' AS `Nove_DetalleNovedad`, '' AS `Nove_Descripcion`, `CFaci_Version`, DATE_FORMAT(`EDT_FechaEdicion`,'%d-%m-%Y %H:%i:%s') AS `EDT_FechaEdicion`, `Prog_Viajes` FROM `OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop'";
				break;	
			}	
		}

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}   

	function reporte_op_hist($fechaReporteop,$tipoReporteop,$operacionReporteop)
	{
		if($tipoReporteop=='NOVEDADES'){
			$consulta = "	SELECT 
								`Nove_UsuarioId` AS 'cgo_dni', 
								(SELECT `Colab_nombre_corto` FROM `BDLIMABUS`.`colaborador` WHERE `Colaborador_id`=`Nove_UsuarioId`) AS `cgo_nombres`,
								UPPER(DATE_FORMAT(`Nove_FechaOperacion`,'%W')) AS `dia`,
								`Nove_FechaOperacion` AS `fecha`,
								`Nove_CodigoColaborador` AS `piloto_codigo`,
								`Nove_Dni` AS `piloto_dni`,
								`Nove_NombreColaborador` AS `piloto_nombres`,
								`Nove_Tabla` AS `tabla`,
								TIME_FORMAT(`Nove_HoraOrigen`,'%H:%i') AS `hora_origen`,
								TIME_FORMAT(`Nove_HoraDestino`,'%H:%i') AS `hora_destino`,
								`Nove_Servicio` AS `servicio`,
								`Nove_Bus` AS `bus`,
								`Nove_LugarOrigen` AS `lugar_origen`,
								`Nove_LugarDestino` AS `lugar_destino`,
								`Novedad_Id` AS `novedad_id`,
								`Prog_TipoTabla` AS `turno`,
								`Nove_Novedad` AS `novedad_1`,
								`Nove_TipoNovedad` AS `tipo_novedad_1`,
								`Nove_DetalleNovedad` AS `detalle_novedad_1`,
								`Nove_Descripcion` AS `descripcion_adicional`
							FROM 
								`BDLIMABUS`.`OPE_Novedad`
							LEFT JOIN
								`bdlimabus_hist`.`OPE_ControlFacilitador`
							ON
								`OPE_ControlFacilitador`.`Programacion_Id`=`OPE_Novedad`.`Nove_ProgramacionId`
							WHERE 
								`Nove_FechaOperacion`='$fechaReporteop' AND 
								`Nove_Operacion`='$operacionReporteop'";
		}else{
			$CFaci_Version = '1';
			$consulta="SET @bus=''; SET @colBus=0; SET @tabla=''; SET @colTabla=0;";
			$resultado = $this->conexion->prepare($consulta);
			$resultado->execute();        
	
			switch ($tipoReporteop)
			{
				case 'CONTROL FACILITADOR ORIGINAL':
					$consulta = "SELECT `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT(`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, ROUND(`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, '' AS `busanterior`, '' AS `pilotoanterior`, '' AS `CNove_NovedadId`, '' AS `Nove_Novedad`, '' AS `Nove_TipoNovedad`, '' AS `Nove_DetalleNovedad`, '' AS `Nove_Descripcion`, `Prog_Viajes` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop' AND `CFaci_Version`='$CFaci_Version' UNION SELECT `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT(`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, ROUND(`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, '' AS `busanterior`, '' AS `pilotoanterior`, '' AS `CNove_NovedadId`, '' AS `Nove_Novedad`, '' AS `Nove_TipoNovedad`, '' AS `Nove_DetalleNovedad`, '' AS `Nove_Descripcion`, `Prog_Viajes` FROM `BDLIMABUS`.`OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop' AND `CFaci_Version`='$CFaci_Version'";
				break;
				
				case 'CAMBIO BUS':
					$consulta="SELECT 
					`CNove_ControlFacilitadorId` AS `ControlFacilitador_Id`, `CNOVE_CFaciVersion`, `ucf`.`Prog_Dni`, `ucf`.`Prog_CodigoColaborador`, `ucf`.`Prog_NombreColaborador`, `ucf`.`Prog_Tabla`, TIME_FORMAT(`ucf`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`ucf`.`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `ucf`.`Prog_Servicio`, `ucf`.`Prog_ServBus`, `ucf`.`Prog_Bus`, `ucf`.`Prog_LugarOrigen`, `ucf`.`Prog_LugarDestino`, `ucf`.`Prog_TipoEvento`, `ucf`.`Prog_Observaciones`, ROUND(`ucf`.`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`,`ucf`.`Prog_TipoTabla`, `ucf`.`Prog_NPlaca`, `ucf`.`Prog_NVid`, `ucf`.`Prog_IdManto`, `ucf`.`Prog_Sentido`, `ucf`.`Prog_BusManto`, `ucf`.`Prog_colBus`, `ucf`.`Prog_colTabla`, `OPE_ControlFacilitadorEDT`.`Prog_bus` AS `busanterior`, `CNove_NovedadId`, `CNOVE_NoveVersion`, `OPE_Novedad`.`Nove_Novedad`, `OPE_Novedad`.`Nove_TipoNovedad`, `OPE_Novedad`.`Nove_DetalleNovedad`, `OPE_Novedad`.`Nove_Descripcion`, '' AS `pilotoanterior`, `ucf`.`Prog_Viajes`
					FROM 
						`BDLIMABUS`.`OPE_ControlCambiosNovedad` 
					LEFT JOIN `BDLIMABUS`.`OPE_Novedad` 
						ON `Novedad_Id`=`CNove_NovedadId` 
					LEFT JOIN `BDLIMABUS`.`OPE_ControlFacilitadorEDT` 
						ON `ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNove_CFaciVersion`-1 
					LEFT JOIN (SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Fecha`, `Prog_Operacion`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, `Prog_Viajes` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop' UNION SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Fecha`, `Prog_Operacion`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, `Prog_Viajes` FROM `BDLIMABUS`.`OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop') AS `ucf` ON `ucf`.`ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `ucf`.`CFaci_Version`=`CNove_CFaciVersion` AND `ucf`.`Prog_Fecha`='$fechaReporteop' AND `ucf`.`Prog_Operacion`='$operacionReporteop'
					WHERE 
					`CNove_TipoOrigen`='ASOCIACION' AND `CNove_CFaciVersion`>'1' AND `CNove_FechaOperacion`='$fechaReporteop' AND `ucf`.`Prog_Bus`<>`OPE_ControlFacilitadorEDT`.`Prog_bus` AND `ucf`.`Prog_Operacion`='$operacionReporteop'";
				break;
	
				case 'CAMBIO PILOTO':
					$consulta="SELECT 
					`CNove_ControlFacilitadorId` AS `ControlFacilitador_Id`, `CNOVE_CFaciVersion`, `ucf`.`Prog_Dni`, `ucf`.`Prog_CodigoColaborador`, `ucf`.`Prog_NombreColaborador`, `ucf`.`Prog_Tabla`, TIME_FORMAT(`ucf`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`ucf`.`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `ucf`.`Prog_Servicio`, `ucf`.`Prog_ServBus`, `ucf`.`Prog_Bus`, `ucf`.`Prog_LugarOrigen`, `ucf`.`Prog_LugarDestino`, `ucf`.`Prog_TipoEvento`, `ucf`.`Prog_Observaciones`, ROUND(`ucf`.`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`,`ucf`.`Prog_TipoTabla`, `ucf`.`Prog_NPlaca`, `ucf`.`Prog_NVid`, `ucf`.`Prog_IdManto`, `ucf`.`Prog_Sentido`, `ucf`.`Prog_BusManto`, `ucf`.`Prog_colBus`, `ucf`.`Prog_colTabla`, '' AS `busanterior`, `CNove_NovedadId`, `CNOVE_NoveVersion`, `OPE_Novedad`.`Nove_Novedad`, `OPE_Novedad`.`Nove_TipoNovedad`, `OPE_Novedad`.`Nove_DetalleNovedad`, `OPE_Novedad`.`Nove_Descripcion`, `OPE_ControlFacilitadorEDT`.`Prog_NombreColaborador` AS `pilotoanterior`, `ucf`.`Prog_Viajes`
					FROM 
						`BDLIMABUS`.`OPE_ControlCambiosNovedad` 
					LEFT JOIN `BDLIMABUS`.`OPE_Novedad` 
						ON `Novedad_Id`=`CNove_NovedadId` 
					LEFT JOIN `BDLIMABUS`.`OPE_ControlFacilitadorEDT` 
						ON `ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNove_CFaciVersion`-1 
					LEFT JOIN (SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Fecha`, `Prog_Operacion`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, `Prog_Viajes` FROM `bdlimabus_hist`.`OPE_ControlFacilitador` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop' UNION SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Fecha`, `Prog_Operacion`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, `Prog_Viajes` FROM `BDLIMABUS`.`OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop') AS `ucf` ON `ucf`.`ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `ucf`.`CFaci_Version`=`CNove_CFaciVersion` AND `ucf`.`Prog_Fecha`='$fechaReporteop' AND `ucf`.`Prog_Operacion`='$operacionReporteop'
					WHERE 
					`CNove_TipoOrigen`='ASOCIACION' AND `CNove_CFaciVersion`>'1' AND `CNove_FechaOperacion`='$fechaReporteop' AND `ucf`.`Prog_Dni`<>`OPE_ControlFacilitadorEDT`.`Prog_Dni` AND `ucf`.`Prog_Operacion`='$operacionReporteop'";
				break;
	
				case 'HISTORIAL CAMBIOS':
					$consulta = "SELECT `ControlFacilitador_Id`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT(`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, ROUND(`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT`, '' AS `busanterior`, '' AS `pilotoanterior`, '' AS `CNove_NovedadId`, '' AS `Nove_Novedad`, '' AS `Nove_TipoNovedad`, '' AS `Nove_DetalleNovedad`, '' AS `Nove_Descripcion`, `CFaci_Version`, DATE_FORMAT(`EDT_FechaEdicion`,'%d-%m-%Y %H:%i:%s') AS `EDT_FechaEdicion`, `Prog_Viajes` FROM `BDLIMABUS`.`OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='$fechaReporteop' AND `Prog_Operacion`='$operacionReporteop'";
				break;	
			}	
		}

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		$this->conexion=null;
	}   

	function ValidarNovedad_ControlFacilitador($OPE_NovedadId, $Novedad_Id, $Nove_Version)
	{
		$consulta = " SELECT * FROM `OPE_ControlCambiosNovedad` LEFT JOIN `OPE_ControlFacilitador` ON `CNove_ControlFacilitadorId`=`ControlFacilitador_Id` AND `CNOVE_CFaciVersion`=`CFaci_Version` WHERE `CNOVE_OPENovedadId`='$OPE_NovedadId' AND `CNove_NovedadId`='$Novedad_Id' AND `CNOVE_NoveVersion`='$Nove_Version' ";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
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

	function BuscarServBus($Prog_Operacion,$Prog_Fecha,$Prog_IdManto)
	{
		$consulta="SELECT `OPE_ControlFacilitador`.`Prog_ServBus` FROM `OPE_ControlFacilitador` WHERE `OPE_ControlFacilitador`.`Prog_Operacion` = '$Prog_Operacion' AND `OPE_ControlFacilitador`.`Prog_Fecha` = '$Prog_Fecha' AND `OPE_ControlFacilitador`.`Prog_IdManto` = '$Prog_IdManto' LIMIT 1";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function auto_completar($nombre_tabla, $nombre_campo)
	{
		$consulta="SELECT * FROM `$nombre_tabla`";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function generar_consulta($consulta_sql)
	{
		$resultado = $this->conexion->prepare($consulta_sql);
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

	function buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo)
	{
		$consulta  ="SELECT TO_BASE64 (`$campo_archivo`) AS `b64_file` FROM `$tabla` WHERE `$campo_buscar`='$dato_buscar' AND `$campo_tipo_archivo`='$dato_tipo_archivo'";
		$resultado = $this->conexion->prepare($consulta);
  		$resultado->execute();   
  		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
  		
		return $data;
  		$this->conexion=null;	
	}

	function grabar_imagen($novedad_id, $nove_tipo_imagen, $nove_imagen)
	{
		$nove_imagen_fecha		= date("Y-m-d H:i:s");
		$nove_imagen_usuario_id	= $_SESSION['USUARIO_ID'];		

		$consulta = "INSERT INTO `ope_novedad_imagen`(`novedad_id`, `nove_tipo_imagen`, `nove_imagen`, `nove_imagen_fecha`, `nove_imagen_usuario_id`) VALUES ('$novedad_id', '$nove_tipo_imagen', '$nove_imagen', '$nove_imagen_fecha', '$nove_imagen_usuario_id')";

		$resultado = $this->conexion->prepare($consulta);
 		$resultado->execute();   

 		$this->conexion=null;	
 	}

	function editar_imagen($novedad_id, $nove_tipo_imagen, $nove_imagen)
	{
		$nove_imagen_fecha 		= date("Y-m-d H:i:s");
		$nove_imagen_usuario_id = $_SESSION['USUARIO_ID'];		

		$consulta = "UPDATE `ope_novedad_imagen` SET `nove_imagen`='$nove_imagen', `nove_imagen_fecha`='$nove_imagen_fecha', `nove_imagen_usuario_id`='$nove_imagen_usuario_id', `nove_imagen_fecha`='$nove_imagen_fecha', `nove_imagen_usuario_id`='$nove_imagen_usuario_id'  WHERE `novedad_id`='$novedad_id' AND `nove_tipo_imagen`='$nove_tipo_imagen'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   

		$this->conexion=null;	
	}

	function LeerTipoTablas()
	{
        $consulta="SELECT * FROM `TipoTabla`";

        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   
		 
	function CrearTipoTablas($Ttabla_Id,$Ttabla_Tipo,$Ttabla_Operacion,$Ttabla_Detalle)
	{
		$consulta = "INSERT INTO `TipoTabla`(`Ttabla_Tipo`, `Ttabla_Operacion`, `Ttabla_Detalle`)
					 VALUES ('$Ttabla_Tipo','$Ttabla_Operacion','$Ttabla_Detalle')";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `TipoTabla`";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  	
	
	function EditarTipoTablas($Ttabla_Id,$Ttabla_Tipo,$Ttabla_Operacion,$Ttabla_Detalle)
	{
		$consulta = "UPDATE `TipoTabla` SET `Ttabla_Tipo`='$Ttabla_Tipo',`Ttabla_Operacion`='$Ttabla_Operacion',`Ttabla_Detalle`='$Ttabla_Detalle' WHERE `Ttabla_Id` ='$Ttabla_Id'";		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		
		$consulta= "SELECT * FROM `TipoTabla` WHERE `Ttabla_Id` ='$Ttabla_Id'";
        $resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;	
	}  		
	
	function BorrarTipoTablas($Ttabla_Id)
	{
		$consulta = "DELETE FROM `TipoTabla` WHERE `Ttabla_Id`='$Ttabla_Id'";		
  		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $this->conexion=null;	
	}  		

}