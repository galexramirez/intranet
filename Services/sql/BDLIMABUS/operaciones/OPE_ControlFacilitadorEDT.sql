CREATE TABLE `BDLIMABUS`.`OPE_ControlFacilitadorEDT` (
    `EDT_Id` int(11) NOT NULL AUTO_INCREMENT,
    `EDT_FechaEdicion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `EDT_UsuarioId_Edicion` varchar(8) NOT NULL,
    `ControlFacilitador_Id` int(11) NOT NULL,
    `Programacion_Id` int(11) NOT NULL,
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
    `Prog_Viajes` VARCHAR(45) CHARACTER SET utf8 NOT NULL ,
    `CFaRg_Id` int(11) NOT NULL,
    `CFaci_Estado` varchar(15) NOT NULL,
    `CFaci_UsuarioId` varchar(8) NOT NULL,
    `CFaci_Novedad` varchar(2) DEFAULT NULL,
    `CFaci_ProcesoOrigen` varchar(15) NOT NULL,
    `CFaci_Version` int(11) NOT NULL,
    `CFaci_Campo1` VARCHAR(45) CHARACTER SET utf8 NOT NULL ,
    `CFaci_Campo2` VARCHAR(45) CHARACTER SET utf8 NOT NULL ,
    `CFaci_Campo3` VARCHAR(45) CHARACTER SET utf8 NOT NULL ,
PRIMARY KEY (`EDT_Id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;