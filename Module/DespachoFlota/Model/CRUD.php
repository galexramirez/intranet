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

	function buscar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$consulta = "SELECT `$nombre_tabla`.`$campo_buscar` FROM `$nombre_tabla` WHERE ".$condicion_where;

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		return $data;   
		$this->conexion=null;
	}

	function BuscarProgramacion($Prog_Fecha,$turno_DespachoFlota)
	{
		$Repo_TipoId = "DESPACHOFLOTA";
		
		$consulta = "SELECT `ControlFacilitador_Id`,`Programacion_Id`,`Prog_Operacion`,`Prog_Fecha`,`Prog_CodigoColaborador`,`Prog_NombreColaborador`, time_format( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, time_format(`Prog_HoraDestino` ,'%H:%i') AS `Prog_HoraDestino` ,time_format(`dflo_horaentregamanto`,'%H:%i') AS Prog_HoraMantenimiento, `Prog_TipoEvento`, `Prog_Servicio`, `Prog_Bus`, `Prog_Tabla`,`Repo_Estado` FROM `ope_despachoflota` LEFT JOIN `OPE_ControlFacilitadorReportes` ON `Repo_ProgramacionId`=`Programacion_Id` AND `Repo_TipoId` = '$Repo_TipoId' WHERE `Prog_Fecha` = '$Prog_Fecha' AND `dflo_turno` = '$turno_DespachoFlota' ORDER BY `Prog_HoraDestino` ASC ";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
        $this->conexion=null;
   	}   
		 
	function NuevoDespachoFlota($ControlFacilitador_Id,$Programacion_Id,$Repo_Descripcion,$Repo_BusCambio,$Repo_HoraSalida,$Repo_Motivo,$Repo_CFaRgId)
	{
		$Repo_Estado = "PENDIENTE";
		$Repo_TipoId = "DESPACHOFLOTA";
		$Repo_UsuarioId_Generar = $_SESSION['USUARIO_ID'];
		$Repo_FechaGenerar = date("Y-m-d H:i:s");

		$consulta = "INSERT INTO `OPE_ControlFacilitadorReportes`(`Repo_TipoId`, `Repo_ProgramacionId`, `Repo_ControlFacilitadorId`, `Repo_BusCambio`, `Repo_HoraSalida`, `Repo_Motivo`, `Repo_Descripcion`, `Repo_Estado`, `Repo_UsuarioId_Generar`, `Repo_FechaGenerar`,`Repo_CFaRgId`) VALUES ('$Repo_TipoId','$Programacion_Id','$ControlFacilitador_Id','$Repo_BusCambio','$Repo_HoraSalida','$Repo_Motivo','$Repo_Descripcion','$Repo_Estado','$Repo_UsuarioId_Generar','$Repo_FechaGenerar','$Repo_CFaRgId') ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;
	}

	function EditarDespachoFlota($ControlFacilitador_Id,$Programacion_Id,$Repo_Descripcion,$Repo_BusCambio,$Repo_HoraSalida,$Repo_Motivo)
	{
		$Repo_TipoId = "DESPACHOFLOTA";
		$Repo_UsuarioId_Edicion = $_SESSION['USUARIO_ID'];
		$Repo_FechaEdicion = date("Y-m-d H:i:s");

		$consulta = "UPDATE `OPE_ControlFacilitadorReportes` SET `Repo_BusCambio`='$Repo_BusCambio', `Repo_HoraSalida`='$Repo_HoraSalida', `Repo_Motivo`='$Repo_Motivo', `Repo_Descripcion`='$Repo_Descripcion', `Repo_UsuarioId_Edicion`='$Repo_UsuarioId_Edicion', `Repo_FechaEdicion`='$Repo_FechaEdicion' WHERE `Repo_TipoId`='$Repo_TipoId' AND `Repo_ProgramacionId`='$Programacion_Id' AND `Repo_ControlFacilitadorId`='$ControlFacilitador_Id' ";

		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
		$this->conexion=null;
		echo $consulta;
	}

	function BuscarReporte($ControlFacilitador_Id)
	{
		$Repo_TipoId = "DESPACHOFLOTA";
		$consulta = "SELECT * FROM `ope_despachoflota` LEFT JOIN `OPE_ControlFacilitadorReportes` ON `Repo_ProgramacionId`=`Programacion_Id` AND `Repo_TipoId`='$Repo_TipoId' WHERE `ControlFacilitador_Id`='$ControlFacilitador_Id'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->conexion=null;	
	}

	function ExisteDespachoFlotaTurno($Prog_Fecha,$turno_DespachoFlota)
	{
		$consulta="SELECT * FROM `ope_despachoflotaregistrocarga` WHERE `dfrg_fecha`='$Prog_Fecha' AND `dfrg_turno`='$turno_DespachoFlota'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function BuscarSalidaFlota($Prog_Fecha,$Prog_Operacion,$tipo_SalidaFlota)
	{
		$Prog_TipoEvento = "INICIO AUTOBUS";
		$Prog_Tabla = "OP11";
		$TiempoMantenimiento = "00:20:00"; // 20 minutos de anticipación
		$CFaci_Version = "1";
		$Vacio = "";
		$KmTablaCorta = "200";
		$TablaCorta = "TABLA CORTA";

		$consulta="SET @SalidaBus=0;";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		switch ($tipo_SalidaFlota)
		{
			case "ORIGINAL":
				$consulta = "SELECT 
								`OPE_ControlFacilitador`.`ControlFacilitador_Id` AS `Prog_Id`, 
								`OPE_ControlFacilitador`.`Prog_Operacion`,
								`OPE_ControlFacilitador`.`Prog_CodigoColaborador`, 
								`OPE_ControlFacilitador`.`Prog_NombreColaborador`, 
								`OPE_ControlFacilitador`.`Prog_Tabla`, 
								time_format( `OPE_ControlFacilitador`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, 
								time_format(`OPE_ControlFacilitador`.`Prog_HoraDestino` ,'%H:%i') AS `Prog_HoraDestino`, 
								`OPE_ControlFacilitador`.`Prog_Servicio`, 
								`OPE_ControlFacilitador`.`Prog_IdManto`, 
								`ucf`.`Prog_Bus`, 
								time_format(TIMEDIFF(`OPE_ControlFacilitador`.`Prog_HoraOrigen`,'$TiempoMantenimiento'),'%H:%i') AS `Prog_HoraMantenimiento`, 
								'$Vacio' AS `Prog_BusCambio`, 
								IF(`td`.`Prog_KmTotal`<'$KmTablaCorta',IF(`Prog_Tabla`='$Prog_Tabla','$Vacio','$TablaCorta'),'$Vacio') AS `Prog_TablaCorta`, `OPE_ControlFacilitador`.`Prog_BusManto`, 
								time_format(`td`.`Prog_HoraInicio`,'%H:%i') AS `Prog_HoraInicio`, 
								time_format(`td`.`Prog_HoraTermino`,'%H:%i') AS `Prog_HoraTermino`, 
								`td`.`Prog_KmTotal` AS `Prog_KmTotal` 
							FROM 
								`OPE_ControlFacilitador` 
							LEFT JOIN 
								(SELECT 
									`ControlFacilitador_Id`,
									`Prog_Bus`,
									`Prog_Fecha`,
									`CFaci_Version`,
									`Prog_TipoEvento` 
								FROM 
									`OPE_ControlFacilitador` 
								WHERE 
									`Prog_Fecha`='$Prog_Fecha' AND 
									`CFaci_Version`='$CFaci_Version' AND 
									`Prog_TipoEvento`='$Prog_TipoEvento' 
								UNION 
								SELECT 
									`ControlFacilitador_Id`,
									`Prog_Bus`,
									`Prog_Fecha`,
									`CFaci_Version`,
									`Prog_TipoEvento` 
								FROM 
									`OPE_ControlFacilitadorEDT` 
								WHERE 
									`Prog_Fecha`='$Prog_Fecha' AND 
									`CFaci_Version`='$CFaci_Version' AND 
									`Prog_TipoEvento`='$Prog_TipoEvento'
								) AS `ucf` 
							ON 
								`ucf`.`ControlFacilitador_Id`=`OPE_ControlFacilitador`.`ControlFacilitador_Id` 
							LEFT JOIN 
								(SELECT 
									`cfd`.`NroDespacho`, 
									ANY_VALUE(`cfd`.`Prog_ServBus`) AS `Prog_ServBus`, 
									MIN(`cfd`.`Prog_HoraOrigen`) AS `Prog_HoraInicio`, 
									MAX(`cfd`.`Prog_HoraDestino`) AS `Prog_HoraTermino`, 
									ROUND(SUM(`cfd`.`Prog_KmXPuntos`),0) AS `Prog_KmTotal`, 
									ANY_VALUE(`cfd`.`Prog_Bus`) AS `Prog_Bus` 
								FROM 
									(SELECT *, 
										IF(`Prog_TipoEvento`='$Prog_TipoEvento', @SalidaBus:=@SalidaBus+1, @SalidaBus) AS `NroDespacho` 
									FROM 
										`OPE_ControlFacilitador` 
									WHERE 
										`Prog_Fecha`='$Prog_Fecha' AND 
										`Prog_Bus`!='$Vacio'
									) AS `cfd` 
								GROUP BY 
									`cfd`.`NroDespacho`
								) AS `td` 
							ON 
								`td`.`Prog_Bus`=`OPE_ControlFacilitador`.`Prog_Bus` AND 
								`OPE_ControlFacilitador`.`Prog_HoraOrigen`=`td`.`Prog_HoraInicio` 
							WHERE 
								`OPE_ControlFacilitador`.`Prog_Fecha`='$Prog_Fecha' AND 
								`OPE_ControlFacilitador`.`Prog_Operacion`='$Prog_Operacion' AND 
								`OPE_ControlFacilitador`.`Prog_TipoEvento`='$Prog_TipoEvento' 
							ORDER BY 
								`Prog_HoraOrigen` ASC";
			break;

			case "ACTUAL":
				$consulta = "SELECT 
								`OPE_ControlFacilitador`.`ControlFacilitador_Id` AS `Prog_Id`, 
								`OPE_ControlFacilitador`.`Prog_Operacion`,
								`OPE_ControlFacilitador`.`Prog_CodigoColaborador`, 
								`OPE_ControlFacilitador`.`Prog_NombreColaborador`, 
								`OPE_ControlFacilitador`.`Prog_Tabla`, 
								time_format( `OPE_ControlFacilitador`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, 
								time_format(`OPE_ControlFacilitador`.`Prog_HoraDestino` ,'%H:%i') AS `Prog_HoraDestino`, 
								`OPE_ControlFacilitador`.`Prog_Servicio`,
								`OPE_ControlFacilitador`.`Prog_IdManto`, 
								`OPE_ControlFacilitador`.`Prog_Bus`, 
								time_format(TIMEDIFF(`OPE_ControlFacilitador`.`Prog_HoraOrigen`,'$TiempoMantenimiento'),'%H:%i') AS `Prog_HoraMantenimiento`,
								'$Vacio' AS `Prog_BusCambio`, 
								IF(`td`.`Prog_KmTotal`<'$KmTablaCorta',IF(`Prog_Tabla`='$Prog_Tabla','$Vacio','$TablaCorta'),'$Vacio') AS `Prog_TablaCorta`, 
								`OPE_ControlFacilitador`.`Prog_BusManto`,
								time_format(`td`.`Prog_HoraInicio`,'%H:%i') AS `Prog_HoraInicio`,
								time_format(`td`.`Prog_HoraTermino`,'%H:%i') AS `Prog_HoraTermino`,
								`td`.`Prog_KmTotal` AS `Prog_KmTotal`
							FROM 
								`OPE_ControlFacilitador` 
							LEFT JOIN 
								(SELECT 
									`cfd`.`NroDespacho`, 
									ANY_VALUE(`cfd`.`Prog_ServBus`) AS `Prog_ServBus`, 
									MIN(`cfd`.`Prog_HoraOrigen`) AS `Prog_HoraInicio`, 
									MAX(`cfd`.`Prog_HoraDestino`) AS `Prog_HoraTermino`, 
									ROUND(SUM(`cfd`.`Prog_KmXPuntos`),0) AS `Prog_KmTotal`, 
									ANY_VALUE(`cfd`.`Prog_Bus`) AS `Prog_Bus` 
								FROM 
									(SELECT *,
										IF(`Prog_TipoEvento`='$Prog_TipoEvento', @SalidaBus:=@SalidaBus+1, @SalidaBus) AS `NroDespacho` 
									FROM 
										`OPE_ControlFacilitador` 
									WHERE 
										`Prog_Fecha`='$Prog_Fecha' AND 
										`Prog_Bus`!='$Vacio'
									ORDER BY
									`OPE_ControlFacilitador`.`ControlFacilitador_Id`
									) AS `cfd` 
								GROUP BY 
									`cfd`.`NroDespacho`
								) AS `td` 
							ON 
								`OPE_ControlFacilitador`.`Prog_Bus`=`td`.`Prog_Bus` AND 
								`OPE_ControlFacilitador`.`Prog_HoraOrigen`=`td`.`Prog_HoraInicio` AND
								`OPE_ControlFacilitador`.`Prog_ServBus`=`td`.`Prog_ServBus`
							WHERE 	
								`OPE_ControlFacilitador`.`Prog_Fecha`='$Prog_Fecha' AND 
								`OPE_ControlFacilitador`.`Prog_Operacion`='$Prog_Operacion' AND
								`OPE_ControlFacilitador`.`Prog_TipoEvento`='$Prog_TipoEvento' 
							ORDER BY 
								`Prog_HoraOrigen` ASC";
			break;

			default:

		}

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
   	}   

	function BuscarInformeDespacho($Prog_Fecha,$Prog_Operacion,$turno_InformeDespacho)
	{
		$Prog_TipoEvento = 'INICIO AUTOBUS';
		$TiempoMantenimiento = '00:20:00'; // 20 minutos de anticipación
		$Repo_TipoId = "DESPACHOFLOTA";
		$Tiempo_0 = "00:00";
		$Repo_Status1 = "NORMAL";
		$Repo_Status2 = "RETRASO";

		$consulta = "SELECT 
						`Prog_Operacion`,
						`Prog_CodigoColaborador`,
						`Prog_NombreColaborador`, 
						`Prog_Tabla`, 
						time_format(`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, 
						time_format(`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, 
						`Prog_Servicio`, 
						`Prog_IdManto`, 
						`Prog_Bus`, 
						time_format(`dflo_horaentregamanto`,'%H:%i') AS `Prog_HoraMantenimiento`, 
						time_format(IF(`Repo_HoraSalida` IS NULL,`Prog_HoraDestino`,`Repo_HoraSalida`),'%H:%i') AS `Repo_HoraReal`, 
						IF(`Repo_HoraSalida` IS NULL,'$Tiempo_0',time_format(TIMEDIFF(`Repo_HoraSalida`,`Prog_HoraDestino`),'%H:%i')) AS `Repo_OnTime`, 
						IF(`Repo_HoraSalida`>`Prog_HoraDestino`,'$Repo_Status2','$Repo_Status1') AS `Repo_Status`, 
						`Repo_BusCambio`, 
						`Repo_Descripcion` 
					FROM 
						`ope_despachoflota` 
					LEFT JOIN 
						`OPE_ControlFacilitadorReportes` 
					ON 
						`Repo_ProgramacionId`=`Programacion_Id` AND 
						`Repo_TipoId` = '$Repo_TipoId' 
					WHERE 
						`Prog_Fecha` = '$Prog_Fecha' AND 
						`Prog_Operacion` = '$Prog_Operacion' AND
						`dflo_turno` = '$turno_InformeDespacho' 
					ORDER BY 
						`Prog_HoraDestino` ASC";

		$resultado = $this->conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
        $this->conexion=null;
	}   

	function BuscarInformeLlegada($Prog_Fecha,$Prog_Operacion,$tipo_InformeLlegada)
	{
		$Prog_TipoEvento = 'FIN AUTOBUS';
		$Prog_TipoEvento2 = 'RETANQUEO';
		$CFaci_Version = "1";
		$Vacio = "";

        switch ($tipo_InformeLlegada) 
		{
            case "ORIGINAL":
				$consulta = "SELECT `Prog_Operacion`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, time_format( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, time_format(`Prog_HoraDestino` ,'%H:%i') AS `Prog_HoraDestino` , `Prog_Servicio`, `Prog_IdManto`, `Prog_Bus`, IF (`Prog_BusManto`='MANTENIMIENTO',`Prog_BusManto`,'$Vacio' ) AS `Prog_BusManto`, `Prog_Observaciones` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha` = '$Prog_Fecha' AND 
				`OPE_ControlFacilitador`.`Prog_Operacion`='$Prog_Operacion' AND
				`OPE_ControlFacilitador`.`CFaci_Version`='$CFaci_Version' AND
				`Prog_TipoEvento` IN ('$Prog_TipoEvento','$Prog_TipoEvento2')
				UNION
				SELECT `Prog_Operacion`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, time_format( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, time_format(`Prog_HoraDestino` ,'%H:%i') AS `Prog_HoraDestino` , `Prog_Servicio`, `Prog_IdManto`, `Prog_Bus`, IF (`Prog_BusManto`='MANTENIMIENTO',`Prog_BusManto`,'$Vacio' ) AS `Prog_BusManto`, `Prog_Observaciones` FROM `OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha` = '$Prog_Fecha' AND 
				`OPE_ControlFacilitadorEDT`.`Prog_Operacion`='$Prog_Operacion' AND
				`OPE_ControlFacilitadorEDT`.`CFaci_Version`='$CFaci_Version' AND
				`Prog_TipoEvento` IN ('$Prog_TipoEvento','$Prog_TipoEvento2')";
            break;

            case "ACTUAL":
				$consulta = "SELECT `Prog_Operacion`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, time_format( `Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, time_format(`Prog_HoraDestino` ,'%H:%i') AS `Prog_HoraDestino` , `Prog_Servicio`, `Prog_IdManto`, `Prog_Bus`, IF (`Prog_BusManto`='MANTENIMIENTO',`Prog_BusManto`,'$Vacio' ) AS `Prog_BusManto`, `Prog_Observaciones` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha` = '$Prog_Fecha'  AND 
				`OPE_ControlFacilitador`.`Prog_Operacion`='$Prog_Operacion' AND
				`Prog_TipoEvento` IN ('$Prog_TipoEvento','$Prog_TipoEvento2') ORDER BY `Prog_HoraDestino` ASC";
            break;
        }
   
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
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

	function SelectBus($Prog_Operacion)
	{
		$consulta="SELECT `Buses`.`Bus_NroExterno` AS `Bus` FROM `Buses` WHERE `Buses`.`Bus_Operacion` = '$Prog_Operacion' ORDER BY `Bus` ASC";

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

	function TrabajoTablas($Prog_Fecha,$Prog_Operacion,$HoraInicio,$HoraTermino,$Prog_TipoEvento,$TiempoMantenimiento,$KmTablaCorta)
	{
		$vacio = "";
		$TablaCorta = "TABLA CORTA";
		$Prog_Tabla = "OP11";
		$consulta = "SET @SalidaBus=0;";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
	
		$consulta = "	SELECT *,
							time_format(TIMEDIFF(`OPE_ControlFacilitador`.`Prog_HoraOrigen`,'$TiempoMantenimiento'),'%H:%i') AS `Prog_HoraMantenimiento`,
							IF(`td`.`Prog_KmTotal`<'$KmTablaCorta',IF(`Prog_Tabla`='$Prog_Tabla','$vacio','$TablaCorta'),'$vacio') AS `Prog_TablaCorta`
						FROM 
							`OPE_ControlFacilitador` 
						LEFT JOIN 
							(SELECT 
								`cfd`.`NroDespacho`, 
								ANY_VALUE(`cfd`.`Prog_ServBus`) AS `Prog_ServBus1`, 
								MIN(`cfd`.`Prog_HoraOrigen`) AS `Prog_HoraInicio`, 
								MAX(`cfd`.`Prog_HoraDestino`) AS `Prog_HoraTermino`, 
								ROUND(SUM(`cfd`.`Prog_KmXPuntos`),0) AS `Prog_KmTotal`, 
								ANY_VALUE(`cfd`.`Prog_Bus`) AS `Prog_Bus1` 
							FROM 
								(SELECT *,
									IF(`Prog_TipoEvento`='INICIO AUTOBUS', @SalidaBus:=@SalidaBus+1, @SalidaBus) AS `NroDespacho` 
								FROM 
									`OPE_ControlFacilitador` 
								WHERE 
									`Prog_Fecha`='$Prog_Fecha' AND 
									`Prog_Bus`!='$vacio' AND
									`Prog_Operacion`='$Prog_Operacion'
								) AS `cfd` 
							GROUP BY 
								`cfd`.`NroDespacho`
							) AS `td` 
						ON 
							`td`.`Prog_Bus1`=`OPE_ControlFacilitador`.`Prog_Bus` AND 
							`OPE_ControlFacilitador`.`Prog_HoraOrigen`=`td`.`Prog_HoraInicio` 
						WHERE 
							`Prog_Fecha`='$Prog_Fecha' AND 
							`Prog_Operacion`='$Prog_Operacion' AND 
							`Prog_TipoEvento`='$Prog_TipoEvento' AND 
							`Prog_HoraOrigen`>='$HoraInicio' AND 
							`Prog_HoraOrigen`<='$HoraTermino'
						ORDER BY 
							`Prog_HoraOrigen` ASC";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function CrearSalidaFlota($ControlFacilitador_Id, $Programacion_Id, $Prog_Codigo, $Prog_Operacion, $Prog_Fecha, $Prog_Dni, $Prog_CodigoColaborador, $Prog_NombreColaborador, $Prog_Tabla, $Prog_HoraOrigen, $Prog_HoraDestino, $Prog_Servicio, $Prog_ServBus, $Prog_Bus, $Prog_LugarOrigen, $Prog_LugarDestino, $Prog_TipoEvento, $Prog_Observaciones, $Prog_KmXPuntos, $Prog_TipoTabla, $Prog_NPlaca, $Prog_NVid, $Prog_IdManto, $Prog_Sentido, $Prog_BusManto, $CFaRg_Id, $CFaci_Estado, $CFaci_UsuarioId, $CFaci_Novedad, $CFaci_ProcesoOrigen, $CFaci_Version, $dflo_nrodespacho, $dflo_tablacorta, $dflo_horainiciotabla, $dflo_horaterminotabla, $dflo_kmtotal, $dflo_turno, $dflo_obsmanto, $dflo_horaentregamanto, $dflo_dfrgid)
	{
		$consulta="INSERT INTO `ope_despachoflota`(`ControlFacilitador_Id`, `Programacion_Id`, `Prog_Codigo`, `Prog_Operacion`, `Prog_Fecha`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, `CFaRg_Id`, `CFaci_Estado`, `CFaci_UsuarioId`, `CFaci_Novedad`, `CFaci_ProcesoOrigen`, `CFaci_Version`, `dflo_nrodespacho`, `dflo_tablacorta`, `dflo_horainiciotabla`, `dflo_horaterminotabla`, `dflo_kmtotal`, `dflo_turno`, `dflo_obsmanto`, `dflo_horaentregamanto`, `dflo_dfrgid`) VALUES ('$ControlFacilitador_Id ', '$Programacion_Id', '$Prog_Codigo', '$Prog_Operacion', '$Prog_Fecha', '$Prog_Dni', '$Prog_CodigoColaborador', '$Prog_NombreColaborador', '$Prog_Tabla', '$Prog_HoraOrigen', '$Prog_HoraDestino', '$Prog_Servicio', '$Prog_ServBus', '$Prog_Bus', '$Prog_LugarOrigen', '$Prog_LugarDestino', '$Prog_TipoEvento ', '$Prog_Observaciones', '$Prog_KmXPuntos', '$Prog_TipoTabla', '$Prog_NPlaca', '$Prog_NVid', '$Prog_IdManto', '$Prog_Sentido', '$Prog_BusManto', '$CFaRg_Id', '$CFaci_Estado', '$CFaci_UsuarioId', '$CFaci_Novedad', '$CFaci_ProcesoOrigen', '$CFaci_Version', '$dflo_nrodespacho', '$dflo_tablacorta', '$dflo_horainiciotabla', '$dflo_horaterminotabla', '$dflo_kmtotal', '$dflo_turno', '$dflo_obsmanto', '$dflo_horaentregamanto','$dflo_dfrgid')";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion=null;
	}

	function ExisteSalidaFlota($Prog_Fecha,$Prog_Operacion,$TurnoSalidaFlota)
	{
		$consulta = "SELECT * FROM `ope_despachoflotaregistrocarga` WHERE `dfrg_fecha`='$Prog_Fecha' AND `dfrg_operacion`='$Prog_Operacion' AND `dfrg_turno`='$TurnoSalidaFlota'";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		return $data;
		$this->conexion=null;
	}

	function TurnoInformeDespacho($Prog_Fecha,$Prog_Operacion)
	{
		$consulta="SELECT `dfrg_turno` AS `turno`, time_format(`dfrg_horainicio`,'%H:%i') AS `horainicio`, time_format(`dfrg_horatermino`,'%H:%s') AS `horatermino`, `dfrg_estado` FROM `ope_despachoflotaregistrocarga` WHERE `dfrg_fecha`='$Prog_Fecha' AND `dfrg_operacion`='$Prog_Operacion'";
		  
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		  
		return $data;
		$this->conexion=null;
	}

	function TurnoDespachoFlota($Prog_Fecha)
	{
		$consulta="SELECT DISTINCT `dfrg_turno` AS `turno` FROM `ope_despachoflotaregistrocarga` WHERE `dfrg_fecha`='$Prog_Fecha'";
		  
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

	function MaxId($TablaBD,$CampoId)
	{
		$consulta = "SELECT MAX(`$CampoId`) AS `MaxId` FROM `$TablaBD`";
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();        

		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
		$this->conexion=null;
	}

	function CrearDespachoFlotaCarga($dfrg_fecha, $dfrg_operacion, $dfrg_turno, $dfrg_horainicio, $dfrg_horatermino)
	{
		$dfrg_fechagenerar = date("Y-m-d H:i:s");
		$dfrg_estado = "GENERADO";
		$dfrg_usuarioid_generar = $_SESSION['USUARIO_ID'];
		$consulta = "INSERT INTO `ope_despachoflotaregistrocarga`(`dfrg_fecha`, `dfrg_operacion`, `dfrg_turno`, `dfrg_horainicio`, `dfrg_horatermino`, `dfrg_fechagenerar`, `dfrg_usuarioid_generar`, `dfrg_estado`) VALUES ('$dfrg_fecha', '$dfrg_operacion', '$dfrg_turno', '$dfrg_horainicio', '$dfrg_horatermino', '$dfrg_fechagenerar', '$dfrg_usuarioid_generar', '$dfrg_estado')";
		
		$resultado = $this->conexion->prepare($consulta);
		$resultado->execute();
		$this->conexion=null;

	}
}