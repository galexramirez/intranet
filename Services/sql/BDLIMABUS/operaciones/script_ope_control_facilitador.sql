ALTER TABLE `BDLIMABUS`.`OPE_ControlFacilitador` 
ADD INDEX `prog_fecha` (`Prog_Fecha` ASC) VISIBLE;

ALTER TABLE `BDLIMABUS`.`OPE_ControlFacilitador` 
ADD INDEX `prog_fecha_prog_operacion` (`Prog_Fecha` ASC, `Prog_Operacion` ASC) VISIBLE;

DELETE FROM `BDLIMABUS`.`OPE_ControlFacilitadorRegistroCarga` WHERE `CFaRg_FechaCargada`<'2023-04-22';
DELETE FROM `BDLIMABUS`.`OPE_ControlFacilitador` WHERE `Prog_Fecha`<'2023-04-22';
DELETE FROM `BDLIMABUS`.`OPE_ControlFacilitadorEDT` WHERE `Prog_Fecha`<'2023-04-22';
DELETE FROM `BDLIMABUS`.`OPE_Novedad` WHERE `Nove_FechaOperacion`<'2023-04-22';
DELETE FROM `BDLIMABUS`.`OPE_NovedadEDT` WHERE `Nove_FechaOperacion`<'2023-04-22';
DELETE FROM `BDLIMABUS`.`OPE_ControlCambiosNovedad` WHERE `CNOVE_FechaOperacion`<'2023-04-22';
DELETE FROM `BDLIMABUS`.`ope_despachoflota` WHERE `Prog_Operacion`<'2023-04-22';
DELETE FROM `BDLIMABUS`.`ope_despachoflotaregistrocarga` WHERE `dfrg_fecha`<'2023-04-22';
DELETE FROM `BDLIMABUS`.`OPE_ControlFacilitadorReportes` WHERE `Repo_FechaGenerar`<'2023-04-22';

CREATE TABLE `bdlimabus_hist`.`OPE_ControlFacilitador` (
  `cf_id` int NOT NULL AUTO_INCREMENT,
  `ControlFacilitador_Id` int NOT NULL,
  `Programacion_Id` int NOT NULL,
  `Prog_Codigo` varchar(45) NOT NULL,
  `Prog_Operacion` varchar(45) NOT NULL,
  `Prog_Fecha` date NOT NULL,
  `Prog_Dni` varchar(8) NOT NULL,
  `Prog_CodigoColaborador` varchar(4) NOT NULL,
  `Prog_NombreColaborador` varchar(60) NOT NULL,
  `Prog_Tabla` varchar(45) NOT NULL,
  `Prog_HoraOrigen` time NOT NULL,
  `Prog_HoraDestino` time NOT NULL,
  `Prog_Servicio` varchar(45) NOT NULL,
  `Prog_ServBus` varchar(45) NOT NULL,
  `Prog_Bus` varchar(45) NOT NULL,
  `Prog_LugarOrigen` varchar(50) NOT NULL,
  `Prog_LugarDestino` varchar(50) NOT NULL,
  `Prog_TipoEvento` varchar(50) NOT NULL,
  `Prog_Observaciones` varchar(120) NOT NULL,
  `Prog_KmXPuntos` float NOT NULL,
  `Prog_TipoTabla` varchar(45) NOT NULL,
  `Prog_NPlaca` varchar(45) NOT NULL,
  `Prog_NVid` varchar(45) NOT NULL,
  `Prog_IdManto` varchar(45) NOT NULL,
  `Prog_Sentido` varchar(45) NOT NULL,
  `Prog_BusManto` varchar(45) NOT NULL,
  `Prog_Viajes` varchar(45) NOT NULL,
  `CFaRg_Id` int NOT NULL,
  `CFaci_Estado` varchar(15) NOT NULL,
  `CFaci_UsuarioId` varchar(8) NOT NULL,
  `CFaci_Novedad` varchar(2) DEFAULT NULL,
  `CFaci_ProcesoOrigen` varchar(15) NOT NULL,
  `CFaci_Version` int NOT NULL,
  `CFaci_Campo1` varchar(45) NOT NULL,
  `CFaci_Campo2` varchar(45) NOT NULL,
  `CFaci_Campo3` varchar(45) NOT NULL,
  PRIMARY KEY (`cf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `bdlimabus_hist`.`OPE_ControlFacilitadorEDT` (
  `cf_edt_id` int NOT NULL AUTO_INCREMENT,
  `EDT_Id` int NOT NULL,
  `EDT_FechaEdicion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EDT_UsuarioId_Edicion` varchar(8) NOT NULL,
  `ControlFacilitador_Id` int NOT NULL,
  `Programacion_Id` int NOT NULL,
  `Prog_Codigo` varchar(45) NOT NULL,
  `Prog_Operacion` varchar(45) NOT NULL,
  `Prog_Fecha` date NOT NULL,
  `Prog_Dni` varchar(8) NOT NULL,
  `Prog_CodigoColaborador` varchar(4) NOT NULL,
  `Prog_NombreColaborador` varchar(60) NOT NULL,
  `Prog_Tabla` varchar(45) NOT NULL,
  `Prog_HoraOrigen` time NOT NULL,
  `Prog_HoraDestino` time NOT NULL,
  `Prog_Servicio` varchar(45) NOT NULL,
  `Prog_ServBus` varchar(45) NOT NULL,
  `Prog_Bus` varchar(45) NOT NULL,
  `Prog_LugarOrigen` varchar(50) NOT NULL,
  `Prog_LugarDestino` varchar(50) NOT NULL,
  `Prog_TipoEvento` varchar(50) NOT NULL,
  `Prog_Observaciones` varchar(120) NOT NULL,
  `Prog_KmXPuntos` float NOT NULL,
  `Prog_TipoTabla` varchar(45) NOT NULL,
  `Prog_NPlaca` varchar(45) NOT NULL,
  `Prog_NVid` varchar(45) NOT NULL,
  `Prog_IdManto` varchar(45) NOT NULL,
  `Prog_Sentido` varchar(45) NOT NULL,
  `Prog_BusManto` varchar(45) NOT NULL,
  `Prog_Viajes` varchar(45) NOT NULL,
  `CFaRg_Id` int NOT NULL,
  `CFaci_Estado` varchar(15) NOT NULL,
  `CFaci_UsuarioId` varchar(8) NOT NULL,
  `CFaci_Novedad` varchar(2) DEFAULT NULL,
  `CFaci_ProcesoOrigen` varchar(15) NOT NULL,
  `CFaci_Version` int NOT NULL,
  `CFaci_Campo1` varchar(45) NOT NULL,
  `CFaci_Campo2` varchar(45) NOT NULL,
  `CFaci_Campo3` varchar(45) NOT NULL,
  PRIMARY KEY (`cf_edt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
