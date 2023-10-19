/*::: Semanas Cargadas en un determinado Año :::*/
SELECT DISTINCT `Calendario_Semana`
FROM `ProgramacionRegistroCarga`
LEFT JOIN Calendario
ON PrgRg_FechaProgramado=Calendario_Id
WHERE YEAR(PrgRg_FechaProgramado)=2021
ORDER BY Calendario_Semana DESC 

/*::: Fechas Programadas en una determinada semana :::*/
SELECT `PrgRg_Id`,`PrgRg_FechaProgramado`,`PrgRg_FechaCargada`,`PrgRg_Operacion`,`PrgRg_UsuarioId`
FROM `ProgramacionRegistroCarga`
LEFT JOIN Calendario
ON PrgRg_FechaProgramado=Calendario_Id
WHERE Calendario_Semana="2021-S28(12/07-18/07)"
ORDER BY PrgRg_FechaProgramado DESC 

/*::: Años en Programacion Registro Carga :::*/
SELECT DISTINCT YEAR(PrgRg_FechaProgramado)
FROM ProgramacionRegistroCarga 

/*::: Nomina ::*/
SELECT
ANY_VALUE(`Colab_FechaIngreso`) AS FechaIngreso,
YEAR(`Prog_Fecha`) AS Anio, 
MONTHNAME(`Prog_Fecha`) AS Mes,
ANY_VALUE(SUBSTRING(`Calendario_Semana`,7,2)) AS Semana,
`Prog_Fecha` AS Fecha, 
DAYNAME(`Prog_Fecha`) AS Dia, 
`Prog_CodigoColaborador` AS Codigo, 
ANY_VALUE(`Prog_Dni`) AS DNI, 
ANY_VALUE(`Prog_NombreColaborador`) AS ApellidosNombres, 
MIN(`Prog_HoraOrigen`) AS HoraInicio, 
MAX(`Prog_HoraDestino`) AS HoraTermino, 
SUBTIME(MAX(`Prog_HoraDestino`),MIN(`Prog_HoraOrigen`)) AS Amplitud, 
SEC_TO_TIME(SUM(TIME_TO_SEC(SUBTIME(`Prog_HoraDestino`,`Prog_HoraOrigen`)))) AS Duracion,
ANY_VALUE(`Colab_CargoActual`) AS TipoColaborador,
ANY_VALUE(`Prog_Servicio`) AS Servicio 
FROM `Programacion` 
LET JOIN (`colaborador`,`Calendario`)
ON (`Prog_Dni`=`colaborador`.`Colaborador_id` AND `Prog_Fecha`=`Calendario`.`Calendario_Id`)
GROUP BY `Prog_Fecha`,`Prog_CodigoColaborador` 
HAVING `Prog_Fecha`>='2021-06-28' AND `Prog_Fecha`<='2021-07-11' 

/*::: Años en Publicacion Carga :::*/
SELECT DISTINCT 
`Calendario`.`Calendario_Anio` AS Anio 
FROM `PublicacionRegistroCarga` 
LEFT JOIN `Calendario` 
ON `PubRg_SemanaPublicada` = `Calendario`.`Calendario_Semana`


/*::: SEMANAS PUBLICADAS POR PILOTO:::*/
SELECT DISTINCT `PublicacionRegistroCarga`.`PubRg_Id`,`PublicacionRegistroCarga`.`PubRg_SemanaPublicada`,`PublicacionRegistroCarga`.`PubRg_FechaPublicar`,`PublicacionRegistroCarga`.`PubRg_UsuarioId_Publicar`,`PublicacionRegistroCarga`.`PubRg_Estado`
FROM `Programacion`
LEFT JOIN `Calendario`
ON `Programacion`.`Prog_Fecha`=`Calendario`.`Calendario_Id`
LEFT JOIN `PublicacionRegistroCarga`
ON `Calendario`.`Calendario_Semana` = `PublicacionRegistroCarga`.`PubRg_SemanaPublicada` AND `PublicacionRegistroCarga`.`PubRg_Estado` = 'PUBLICADO'
WHERE YEAR(`Programacion`.`Prog_Fecha`)='2021' AND `Programacion`.`Prog_Dni`='10194188' 
ORDER BY `PubRg_SemanaPublicada` DESC 

/*::: PUNTUALIDAD :::*/
SELECT `Programacion_Id`, 
`Prog_CodigoColaborador`, 
`Prog_NombreColaborador`, 
`Prog_Tabla`, 
time_format(`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, 
time_format(`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, 
`Prog_Servicio`, 
`Prog_Bus`, 
`Prog_LugarOrigen`, 
`Prog_LugarDestino`, 
`Prog_TipoEvento`, 
time_format(`Punt_HoraSalida`,'%H:%i') AS `Punt_HoraSalida`, 
`Punt_Observaciones` 
FROM `Programacion` 
LEFT JOIN `Puntualidad` 
ON `Programacion`.`Programacion_Id` = `Puntualidad`.`Punt_ProgramacionId` 
WHERE `Prog_Fecha` = '2021/09/13' AND `Prog_TipoEvento` = 'INICIO AUTOBUS' AND `Prog_HoraOrigen`>'03:00' AND `Prog_HoraOrigen`<'19:00' 
ORDER BY `Prog_HoraOrigen` ASC 

/*::: COLUMNA BUS EN CONTROL FACILITADOR :::*/
SET @bus=''; SET @colBus=0;
SELECT `ControlFacilitador_Id`,`Prog_CodigoColaborador`,`Prog_NombreColaborador`,`Prog_Tabla`,TIME_FORMAT(`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`,TIME_FORMAT(`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`,`Prog_Servicio`,`Prog_ServBus`,`Prog_Bus`,`Prog_LugarOrigen`,`Prog_LugarDestino`,`Prog_TipoEvento`,`Prog_Observaciones`,`Prog_KmXPuntos`,`Prog_TipoTabla`,`Prog_NPlaca`,`Prog_NVid`,`CFaci_EventoId`,IF (@bus!=`Prog_Bus`, IF (@colBus=0, @colBus:=1, @colBus:=0 ), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END) AS `xB` FROM `ControlFacilitador` WHERE `Prog_Fecha`='2022-02-05' AND `Prog_Operacion`='TRONCAL' AND `CFaci_Estado`= 1 ORDER BY `ControlFacilitador_Id`, `Prog_Bus` ASC

/*::: REPORTE DE CAMBIOS DE BUS :::*/
SELECT 
	`CNove_Fecha`,  `usuario`.`Usua_NombreCorto`, `CNove_TipoOrigen`, `CNOVE_FechaOperacion`, 
	`CNove_NovedadId`, `CNOVE_NoveVersion`, `OPE_Novedad`.`Nove_Novedad`, `OPE_Novedad`.`Nove_TipoNovedad`, `OPE_Novedad`.`Nove_DetalleNovedad`, `OPE_Novedad`.`Nove_Descripcion`,  
	`CNove_ControlFacilitadorId` AS `ControlFacilitador_Id`, `CNOVE_CFaciVersion`, `unioncontrolfacilitador`.`dniactual`, `unioncontrolfacilitador`.`Prog_CodigoColaborador`, `unioncontrolfacilitador`.`Prog_NombreColaborador`, `unioncontrolfacilitador`.`Prog_Tabla`, `unioncontrolfacilitador`.`Prog_HoraOrigen`, `unioncontrolfacilitador`.`Prog_HoraDestino`, `unioncontrolfacilitador`.`Prog_Servicio`, `unioncontrolfacilitador`.`Prog_ServBus`, `unioncontrolfacilitador`.`Prog_LugarOrigen`, `unioncontrolfacilitador`.`Prog_LugarDestino`, `unioncontrolfacilitador`.`Prog_TipoEvento`, `unioncontrolfacilitador`.`Prog_Observaciones`, `unioncontrolfacilitador`.`Prog_KmXPuntos`, `busactual` AS `Prog_Bus` ,`busactual`, `OPE_ControlFacilitadorEDT`.`Prog_bus` AS `busanterior`, IF(`busactual`<>`OPE_ControlFacilitadorEDT`.`Prog_bus`,'SI','NO') AS `cambiobus`, `OPE_ControlFacilitadorEDT`.`Prog_Dni` AS `dnianterior`, `OPE_ControlFacilitadorEDT`.`Prog_CodigoColaborador` AS `CodigoColaboradorAnterior`, `OPE_ControlFacilitadorEDT`.`Prog_NombreColaborador` AS `NombreColaboradorAnterior` , IF(`dniactual`<>`OPE_ControlFacilitadorEDT`.`Prog_Dni`,'SI','NO') AS `cambiopiloto`, `unioncontrolfacilitador`.`Prog_Operacion`, `unioncontrolfacilitador`.`Prog_colBus`,`unioncontrolfacilitador`.`Prog_colTabla`
FROM 
	`OPE_ControlCambiosNovedad` 
LEFT JOIN `usuario`
	ON `CNove_UsuarioId` = `usuario`.`Usuario_Id`
LEFT JOIN `OPE_Novedad` 
	ON `Novedad_Id`=`CNove_NovedadId` 
LEFT JOIN `OPE_ControlFacilitadorEDT` 
	ON `ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNove_CFaciVersion`-1 
LEFT JOIN 
	(SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Operacion`, `Prog_Dni` AS `dniactual`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT(`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus` AS `busactual`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, ROUND(`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT` FROM `OPE_ControlFacilitador` WHERE `Prog_Fecha`='2022-05-16' AND `Prog_Operacion`='TRONCAL' 
     UNION 
     SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Operacion`, `Prog_Dni` AS `dniactual`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, TIME_FORMAT(`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus` AS `busactual`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, ROUND(`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT` FROM `OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`='2022-05-16' AND `Prog_Operacion`='TRONCAL') AS `unioncontrolfacilitador` 
	ON `unioncontrolfacilitador`.`ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `unioncontrolfacilitador`.`CFaci_Version`=`CNove_CFaciVersion` 
WHERE 
	`CNove_TipoOrigen`='ASOCIACION' AND `CNove_CFaciVersion`>'1' AND `CNove_FechaOperacion`='2022-05-16' AND `busactual`<>`OPE_ControlFacilitadorEDT`.`Prog_bus` AND `unioncontrolfacilitador`.`Prog_Operacion`='TRONCAL'


SELECT 
`CNove_ControlFacilitadorId` AS `ControlFacilitador_Id`, `CNOVE_CFaciVersion`, `ucf`.`Prog_Dni`, `ucf`.`Prog_CodigoColaborador`, `ucf`.`Prog_NombreColaborador`, `ucf`.`Prog_Tabla`, TIME_FORMAT(`ucf`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, TIME_FORMAT(`uCF`.`Prog_HoraDestino`,'%H:%i') AS `Prog_HoraDestino`, `ucf`.`Prog_Servicio`, `ucf`.`Prog_ServBus`, `ucf`.`Prog_Bus`, `ucf`.`Prog_LugarOrigen`, `ucf`.`Prog_LugarDestino`, `ucf`.`Prog_TipoEvento`, `ucf`.`Prog_Observaciones`, ROUND(`ucf`.`Prog_KmXPuntos`,3) AS `Prog_KmXPuntos`,`ucf`.`Prog_TipoTabla`, `ucf`.`Prog_NPlaca`, `ucf`.`Prog_NVid`, `ucf`.`Prog_IdManto`, `ucf`.`Prog_Sentido`, `ucf`.`Prog_BusManto`, `ucf`.`Prog_colBus`, `ucf`.`Prog_colTabla`, `OPE_ControlFacilitadorEDT`.`Prog_bus` AS `busanterior`,`CNove_NovedadId`,`CNOVE_NoveVersion`,`OPE_Novedad`.`Nove_Novedad`,`OPE_Novedad`.`Nove_TipoNovedad`,`OPE_Novedad`.`Nove_DetalleNovedad` `OPE_Novedad`.`Nove_Descripcion`
FROM 
	`OPE_ControlCambiosNovedad` 
LEFT JOIN `usuario`
	ON `CNove_UsuarioId` = `usuario`.`Usuario_Id`
LEFT JOIN `OPE_Novedad` 
	ON `Novedad_Id`=`CNove_NovedadId` 
LEFT JOIN `OPE_ControlFacilitadorEDT` 
	ON `ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `CFaci_Version`=`CNove_CFaciVersion`-1 
LEFT JOIN 
	(SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Operacion`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT` FROM `OPE_ControlFacilitador` UNION SELECT `ControlFacilitador_Id`, `CFaci_Version`, `Prog_Operacion`, `Prog_Dni`, `Prog_CodigoColaborador`, `Prog_NombreColaborador`, `Prog_Tabla`, `Prog_HoraOrigen`, `Prog_HoraDestino`, `Prog_Servicio`, `Prog_ServBus`, `Prog_Bus`, `Prog_LugarOrigen`, `Prog_LugarDestino`, `Prog_TipoEvento`, `Prog_Observaciones`, `Prog_KmXPuntos`, `Prog_TipoTabla`, `Prog_NPlaca`, `Prog_NVid`, `Prog_IdManto`, `Prog_Sentido`, `Prog_BusManto`, IF(@bus!=`Prog_Bus`,IF(@colBus=0, @colBus:=1, @colBus:=0), @colBus:=@colBus) AS `Prog_colBus`, (CASE WHEN @bus!=`Prog_Bus` THEN @bus:=`Prog_Bus` END ) AS `xB`, IF(@tabla!=`Prog_Tabla`,IF(@colTabla=0, @colTabla:=1, @colTabla:=0 ), @colTabla:= @colBus ) AS `Prog_colTabla`, (CASE WHEN @tabla!=`Prog_Tabla` THEN @tabla:=`Prog_Tabla` END) AS `xT` FROM `OPE_ControlFacilitadorEDT`) AS `ucf` ON `ucf`.`ControlFacilitador_Id` = `CNove_ControlFacilitadorId` AND `ucf`.`CFaci_Version`=`CNove_CFaciVersion` AND `ucf`.`Prog_Fecha`='2022-05-16' AND `ucf`.`Prog_Operacion`='TRONCAL'
WHERE 
`CNove_TipoOrigen`='ASOCIACION' AND `CNove_CFaciVersion`>'1' AND `CNove_FechaOperacion`='2022-05-16' AND `ucf`.`Prog_Bus`<>`OPE_ControlFacilitadorEDT`.`Prog_bus` AND `ucf`.`Prog_Operacion`='TRONCAL'

/*::::::: REPORTE DE SALIDA DE FLOTA ORIGINAL :::::::::::*/
SET @SalidaBus=0; 
SELECT 
	`OPE_ControlFacilitador`.`ControlFacilitador_Id` AS `Prog_Id`, 
	`OPE_ControlFacilitador`.`Prog_Operacion`,
	`OPE_ControlFacilitador`.`Prog_NombreColaborador`, 
	`OPE_ControlFacilitador`.`Prog_Tabla`, 
	time_format( `OPE_ControlFacilitador`.`Prog_HoraOrigen`,'%H:%i') AS `Prog_HoraOrigen`, 
	time_format(`OPE_ControlFacilitador`.`Prog_HoraDestino` ,'%H:%i') AS `Prog_HoraDestino`, 
	`OPE_ControlFacilitador`.`Prog_Servicio`,
	`OPE_ControlFacilitador`.`Prog_IdManto`, 
	`ucf`.`Prog_Bus`, 
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
		`Prog_TipoEvento`='$Prog_TipoEvento' AND 
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
		`Prog_TipoEvento`='$Prog_TipoEvento' AND
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
	`OPE_ControlFacilitador`.`Prog_HoraOrigen`=`td`.`Prog_HoraOrigen` 
WHERE 
	`OPE_ControlFacilitador`.`Prog_Fecha`='$Prog_Fecha' AND 
	`OPE_ControlFacilitador`.`Prog_HoraDestino`>='$horainicio_SalidaFlota' AND 
	`OPE_ControlFacilitador`.`Prog_HoraDestino`<='$horatermino_SalidaFlota' AND
	`OPE_ControlFacilitador`.`Prog_TipoEvento`='$Prog_TipoEvento'
ORDER BY 
	`Prog_HoraDestino` ASC


/*::::::: REPORTE DE SALIDA DE FLOTA ACTUAL :::::::::::*/
SET @SalidaBus=0; 
SELECT 
	`OPE_ControlFacilitador`.`ControlFacilitador_Id` AS `Prog_Id`, 
	`OPE_ControlFacilitador`.`Prog_Operacion`,
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
		) AS `cfd` 
	GROUP BY 
		`cfd`.`NroDespacho`
	) AS `td` 
ON 
	`td`.`Prog_Bus`=`OPE_ControlFacilitador`.`Prog_Bus` AND 
	`OPE_ControlFacilitador`.`Prog_HoraOrigen`=`td`.`Prog_HoraInicio` 
WHERE 	
	`OPE_ControlFacilitador`.`Prog_Fecha`='$Prog_Fecha' AND 
	`OPE_ControlFacilitador`.`Prog_HoraDestino`>='$horainicio_SalidaFlota' AND 
	`OPE_ControlFacilitador`.`Prog_HoraDestino`<='$horatermino_SalidaFlota' AND
	`OPE_ControlFacilitador`.`Prog_TipoEvento`='$Prog_TipoEvento' 
ORDER BY 
	`Prog_HoraDestino` ASC

/*::::::: REPORTE DE TRABAJO TABLA :::::::::::*/
SET @SalidaBus=0;
SELECT *,
	time_format(TIMEDIFF(`OPE_ControlFacilitador`.`Prog_HoraOrigen`,'00:20:00'),'%H:%i') AS `Prog_HoraMantenimiento` 
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
			`Prog_Fecha`='2022-07-04' AND 
			`Prog_Bus`!='' AND
         	`Prog_Operacion`='TRONCAL'
        ORDER BY 
			`Prog_HoraOrigen`,`Prog_ServBus`
		) AS `cfd` 
	GROUP BY 
		`cfd`.`NroDespacho`
	) AS `td` 
	ON 
		`td`.`Prog_Bus1`=`OPE_ControlFacilitador`.`Prog_Bus` AND 
		`OPE_ControlFacilitador`.`Prog_HoraOrigen`=`td`.`Prog_HoraInicio` 
WHERE 
	`Prog_Fecha`='2022-07-04' AND 
	`Prog_Operacion`='TRONCAL' AND 
	`Prog_TipoEvento`='INICIO AUTOBUS' AND 
	`Prog_HoraOrigen`>='03:00:00' AND 
	`Prog_HoraDestino`<='08:00:00' 
ORDER BY 
	`Prog_HoraOrigen`

/*:::::::::::::INFO BUS :::::::::::::::::::::::::*/
SELECT CONCAT_WS('-','C',`cod_ot`) AS `ib_nro_ot`, `ot_estado` AS `ib_estado`, `ot_date_crea` AS `ib_fecha_genera`, (SELECT `manto_usuario`.`usu_nombres` FROM `manto_usuario` WHERE `manto_usuario`.`cod_usuario`=`ot_cgm_crea`) AS `ib_cgm_genera`, `ot_origen` AS `ib_orig_frec`, `ot_asociado` AS `ib_asociado`, `ot_resp_asoc` AS `ib_tecn_resp`, `ot_descrip` AS `ib_desc_acti`, `ot_date_ct` AS `ib_fecha_cierre_tecnico`, (SELECT `manto_usuario`.`usu_nombres` FROM `manto_usuario` WHERE `manto_usuario`.`cod_usuario`=`ot_cgm_ct`) AS `ib_cgm_cierre_tecnico`, `ot_date_ca` AS `ib_fecha_cierre_adm`, (SELECT `manto_usuario`.`usu_nombres` FROM `manto_usuario` WHERE `manto_usuario`.`cod_usuario`=`ot_ca`) AS `ib_resp_cierre_adm`, `ot_bus` AS `ib_bus`, `ot_kilometraje` AS `ib_km`, (SELECT COUNT(*) FROM `manto_vales` WHERE `manto_vales`.`va_ot`=`cod_ot` ) AS `ib_cant_vales` FROM `manto_ot` WHERE `ot_date_crea`>='2022-07-01' AND `ot_date_crea`<='2022-08-01' AND `ot_bus`='21003'
UNION
SELECT CONCAT_WS('-','P',`cod_otpv`) AS `ib_nro_ot`, `otpv_estado` AS `ib_estado`, `otpv_date_genera` AS `ib_fecha_genera`, (SELECT `manto_usuario`.`usu_nombres` FROM `manto_usuario` WHERE `manto_usuario`.`cod_usuario`=`otpv_genera`) AS `ib_cgm_genera`, `otpv_fecuencia` AS `ib_orig_frec`, `otpv_asociado` AS `ib_asociado`, `otpv_tecnico` AS `ib_tecn_resp`, `otpv_descripcion` AS `ib_desc_acti`, `otpv_fin` AS `ib_fecha_cierre_tecnico`, (SELECT `manto_usuario`.`usu_nombres` FROM `manto_usuario` WHERE `manto_usuario`.`cod_usuario`=`otpv_cgm_cierra`) AS `ib_cgm_cierre_tecnico`, `otpv_date_cierra_ad` AS `ib_fecha_cierre_adm`, (SELECT `manto_usuario`.`usu_nombres` FROM `manto_usuario` WHERE `manto_usuario`.`cod_usuario`=`otpv_cierra_ad`) AS `ib_resp_cierre_adm`, `otpv_bus` AS `ib_bus`, `otpv_kmrealiza` AS `ib_km`, (SELECT COUNT(*) FROM `manto_vales` WHERE `manto_vales`.`va_ot`=`cod_otpv` ) AS `ib_cant_vales` FROM `manto_otprv` WHERE `otpv_date_genera`>='2022-07-01' AND `otpv_date_genera`<='2022-08-01' AND `otpv_bus`='21003'