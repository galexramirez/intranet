DROP DATABASE IF EXISTS `BDLIMABUS`;
CREATE DATABASE `BDLIMABUS` CHARACTER SET utf8; /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */

/* Accidentabilidad - Registro de las novedades de accidentes para el calculo de desempeño */
DROP TABLE IF EXISTS `BDLIMABUS`.`accidentabilidad`;
CREATE TABLE `accidentabilidad` (
  `Accidentabilidad_id` int NOT NULL AUTO_INCREMENT,
  `Acci_CodApl` int DEFAULT NULL,
  `Acci_FechaAccidente` date DEFAULT NULL,
  `Acci_HoraDeAccidente` time DEFAULT NULL,
  `Acci_NombreDeCgo` varchar(45) DEFAULT NULL,
  `Acci_DniPiloto` varchar(8) DEFAULT NULL,
  `Acci_CodigoPiloto` varchar(6) DEFAULT NULL,
  `Acci_NombreDePiloto` varchar(60) DEFAULT NULL,
  `Acci_FechaDeIngreso` date DEFAULT NULL,
  `Acci_AntiguedadDePiloto` varchar(100) DEFAULT NULL,
  `Acci_Tabla` varchar(45) DEFAULT NULL,
  `Acci_NumBus` varchar(45) DEFAULT NULL,
  `Acci_Servicio` varchar(45) DEFAULT NULL,
  `Acci_DireccionAccidente` varchar(80) DEFAULT NULL,
  `Acci_SentidoAccidente` varchar(45) DEFAULT NULL,
  `Acci_ClaseDeAccidente` varchar(45) DEFAULT NULL,
  `Acci_Evento` varchar(70) DEFAULT NULL,
  `Acci_OcurrenciaAccidente` varchar(2450) DEFAULT NULL,
  `Acci_PilotoReconoceResponsabilidad` varchar(20) DEFAULT NULL,
  `Acci_DañosVehiculoLbi` varchar(800) DEFAULT NULL,
  `Acci_Conciliado` varchar(20) DEFAULT NULL,
  `Acci_Moneda` varchar(45) DEFAULT NULL,
  `Acci_Monto` decimal(6,2) DEFAULT NULL,
  `Acci_TramitePolicial` varchar(45) DEFAULT NULL,
  `Acci_AsistioAccidente` varchar(45) DEFAULT NULL,
  `Acci_FaltaCometidaPorElPiloto` varchar(80) DEFAULT NULL,
  `Acci_FaltaCometida2` varchar(80) DEFAULT NULL,
  `Acci_ResponsabilidadDeFalta2` varchar(20) DEFAULT NULL,
  `Acci_GravedadDeEvento` varchar(45) DEFAULT NULL,
  `Acci_CostoTotalDeAccidente` decimal(9,2) DEFAULT NULL,
  `Acci_Responsabilidad` varchar(45) DEFAULT NULL,
  `Acci_FechaCarga` datetime DEFAULT NULL,
  PRIMARY KEY (`Accidentabilidad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5422 DEFAULT CHARSET=utf8mb3;

/* Acompañamientoi - Registro de las novedades de acompañamiento para el calculo de desempeño */
DROP TABLE IF EXISTS `BDLIMABUS`.`acompañamiento`;
CREATE TABLE `acompañamiento` (
  `Acompañamiento_id` int NOT NULL AUTO_INCREMENT,
  `Acomp_Num` int DEFAULT NULL,
  `Acomp_Evaluador` varchar(30) DEFAULT NULL,
  `Acomp_IdSeguimiento` varchar(30) DEFAULT NULL,
  `Acomp_Dia` varchar(15) DEFAULT NULL,
  `Acomp_Fecha` date DEFAULT NULL,
  `Acomp_Dni` varchar(8) DEFAULT NULL,
  `Acomp_Codigo` varchar(4) DEFAULT NULL,
  `Acomp_Nombre` varchar(50) DEFAULT NULL,
  `Acomp_Tabla` varchar(5) DEFAULT NULL,
  `Acomp_Inicio` time DEFAULT NULL,
  `Acomp_Fin` time DEFAULT NULL,
  `Acomp_Servicio` varchar(20) DEFAULT NULL,
  `Acomp_Bus` varchar(60) DEFAULT NULL,
  `Acomp_LugarOrigen` varchar(50) DEFAULT NULL,
  `Acomp_LugarDestino` varchar(50) DEFAULT NULL,
  `Acomp_Evento` varchar(50) DEFAULT NULL,
  `Acomp_Fecha2` date DEFAULT NULL,
  `Acomp_Tipo` varchar(50) DEFAULT NULL,
  `Acomp_Observaciones` varchar(65) DEFAULT NULL,
  `Acomp_CalificacionSeguridad` int DEFAULT NULL,
  `Acomp_CalificacionCalidad` int DEFAULT NULL,
  `Acomp_NotaFinal` int DEFAULT NULL,
  `Acomp_CumplimientoPlaneamiento` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Acompañamiento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8781 DEFAULT CHARSET=utf8mb3;

/* Buses - Registro de buses en el sistema*/
DROP TABLE IF EXISTS `BDLIMABUS`.`Buses`;
CREATE TABLE `BDLIMABUS`.`Buses` (
    `Bus_NroExterno` varchar(11) CHARACTER SET utf8 NOT NULL,
    `Bus_NroVid` varchar(5) CHARACTER SET utf8 NOT NULL,
    `Bus_NroPlaca` varchar(7) CHARACTER SET utf8 NOT NULL,
    `Bus_Operacion` varchar(45) CHARACTER SET utf8 NOT NULL,
    `Bus_Detalle` varchar(60) CHARACTER SET utf8 DEFAULT NULL
    `Bus_Tipo` varchar(50) CHARACTER SET utf8 NOT NULL,
    `Bus_Tipo2` varchar(11) CHARACTER SET utf8 NOT NULL,
    `Bus_Estado` varchar(20) CHARACTER SET utf8 NOT NULL,
    `Bus_Tanques` varchar(10) CHARACTER SET utf8 NOT NULL
PRIMARY KEY (`Bus_NroExterno`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Calendario - Registro de Fechas, Semanas y Años según SAF*/
DROP TABLE IF EXISTS `BDLIMABUS`.`Calendario`;
CREATE TABLE `BDLIMABUS`.`Calendario` ( 
    `Calendario_Id` DATE NOT NULL , 
    `Calendario_Anio` INT(4) NOT NULL , 
    `Calendario_TipoDia` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `Calendario_Semana` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
PRIMARY KEY (`Calendario_Id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8;

/* colaborador - Registrio de Colaboradores */
DROP TABLE IF EXISTS `BDLIMABUS`.`colaborador`;
CREATE TABLE `BDLIMABUS`.`colaborador` (
  `Colaborador_id` varchar(8) NOT NULL,
  `Colab_ApellidosNombres` varchar(60) NOT NULL,
  `Colab_CargoActual` varchar(45) NOT NULL,
  `Colab_Estado` varchar(15) NOT NULL,
  `Colab_FechaIngreso` date NOT NULL,
  `Colab_FechaCese` date DEFAULT NULL,
  `Colab_Email` varchar(80) NOT NULL,
  `Colab_Direccion` varchar(130) DEFAULT NULL,
  `Colab_Distrito` varchar(50) NOT NULL,
  `Colab_CodigoCortoPT` varchar(4) DEFAULT NULL,
  `Colab_PerfilEvaluacion` varchar(30) NOT NULL,
  PRIMARY KEY (`Colaborador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/* comportamiento - Registro de las novedades de comportamiento para el calculo de desempeño*/
DROP TABLE IF EXISTS `BDLIMABUS`.`comportamiento`;
CREATE TABLE `BDLIMABUS`.`comportamiento` (
  `Comportamiento_Id` int NOT NULL AUTO_INCREMENT,
  `Comp_ID` int DEFAULT NULL,
  `Comp_Nombre CGO` varchar(23) DEFAULT NULL,
  `Comp_FechaEvento` date DEFAULT NULL,
  `Comp_Dni` varchar(8) DEFAULT NULL,
  `Comp_CodPiloto` varchar(4) DEFAULT NULL,
  `Comp_NombrePiloto` varchar(50) DEFAULT NULL,
  `Comp_Bus` varchar(5) DEFAULT NULL,
  `Comp_TipoPiloto` varchar(15) DEFAULT NULL,
  `Comp_Tabla` varchar(20) DEFAULT NULL,
  `Comp_Servicio` varchar(30) DEFAULT NULL,
  `Comp_DetalleNovedad` varchar(35) DEFAULT NULL,
  `Comp_DescripNovedad` varchar(1200) DEFAULT NULL,
  `Comp_AccionDisciplinaria` varchar(1000) DEFAULT NULL,
  `Comp_CodigoDeFalta` varchar(7) DEFAULT NULL,
  `Comp_Monto` decimal(10,2) DEFAULT NULL,
  `Comp_ReconoceResp` varchar(10) DEFAULT NULL,
  `Comp_AfectaPremio` varchar(2) DEFAULT NULL,
  `Comp_TipoDisciplina` varchar(170) DEFAULT NULL,
  `Comp_Observacion` varchar(170) DEFAULT NULL,
  `Comp_FechaCarga` datetime DEFAULT NULL,
  PRIMARY KEY (`Comportamiento_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2305 DEFAULT CHARSET=utf8mb3;

/* comunicado - Registro de ubicación de los archivos png de los comunicados */
DROP TABLE IF EXISTS `BDLIMABUS`.`comunicado`;
CREATE TABLE `comunicado` (
  `Comunicado_Id` int NOT NULL AUTO_INCREMENT,
  `Comu_Titulo` varchar(200) DEFAULT NULL,
  `Comu_FechaInicio` date DEFAULT NULL,
  `Comu_FechaFin` date DEFAULT NULL,
  `Comu_Destacado` int DEFAULT NULL,
  `Comu_Archivo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`Comunicado_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=373 DEFAULT CHARSET=utf8mb3;

/* DesempenioOperaciones - ¿ ... ? */
DROP TABLE IF EXISTS `BDLIMABUS`.`DesempenioOperaciones`;
CREATE TABLE `BDLIMABUS`.`DesempenioOperaciones` (
  `DesempenioOperaciones_id` int NOT NULL AUTO_INCREMENT,
  `DesOpe_FechaEvento` date NOT NULL,
  `DesOpe_PeriodoAplicable` varchar(7) NOT NULL,
  `DesOpe_ColaboradorID` varchar(8) NOT NULL,
  `DesOpe_Evento` varchar(200) NOT NULL,
  `DesOpe_DetalleEvento` varchar(800) NOT NULL,
  `DesOpe_CriterioImpacto` varchar(20) NOT NULL,
  `DesOpe_Peso` int NOT NULL,
  `DesOpe_ColabReporta` varchar(8) NOT NULL,
  PRIMARY KEY (`DesempenioOperaciones_id`),
  KEY `DesOpe_ColaboradorID` (`DesOpe_ColaboradorID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

/* glo_colaboradorimagen - Registro de la fotografia del colaborador */
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_colaboradorimagen`;
CREATE TABLE `BDLIMABUS`.`glo_colaboradorimagen` (
  `Colaborador_id` varchar(8) NOT NULL,
  `Colab_Fotografia` longblob,
  PRIMARY KEY (`Colaborador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/* glo_objetos - Registro de objetos para el control de accesos*/
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_controlaccesos`;
CREATE TABLE `BDLIMABUS`.`glo_controlaccesos` (
  `controlaccesos_id` int(11) NOT NULL AUTO_INCREMENT,
  `cacces_perfil` varchar(30) NOT NULL,
  `cacces_moduloid` int(11) NOT NULL,
  `cacces_objetoid` int(11) NOT NULL,
  `cacces_acceso` varchar(2) NOT NULL,
PRIMARY KEY (`controlaccesos_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* glo_objetos - Registro de objetos para el control de accesos*/
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_objetos`;
CREATE TABLE `BDLIMABUS`.`glo_objetos` (
  `objetos_id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_moduloid` int(11) NOT NULL,
  `obj_nombre` varchar(100) NOT NULL,
  `obj_descripcion` varchar(200) NOT NULL,
PRIMARY KEY (`objetos_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* glo_roles - Registro de usuarios y sus diferentes tipos de perfil */
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_roles`;
CREATE TABLE `BDLIMABUS`.`glo_roles` (
    `roles_id` INT(11) NOT NULL  AUTO_INCREMENT ,
    `roles_dni` varchar(8) NOT NULL,
    `roles_apellidosnombres` varchar(60) NOT NULL,
    `roles_nombrecorto` varchar(60) NULL,
    `roles_perfil` varchar(45) NOT NULL,
    `roles_codigoatu` varchar(20) NULL,
    PRIMARY KEY (`roles_id`),
    KEY `roles_dni` (`roles_dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* glo_tipocambio - Registro del tipo de cambios moneda dolar*/
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_tipocambio`;
CREATE TABLE `BDLIMABUS`.`glo_tipocambio` ( 
    `tipocambio_id` int(11) NOT NULL AUTO_INCREMENT, 
    `tipocambio_fecha` DATE NOT NULL , 
    `tipocambio_moneda` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `tipocambio_tipo` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `tipocambio_valor` FLOAT NOT NULL , 
PRIMARY KEY (`tipocambio_id`)) ENGINE = InnoDB;

/* glo_tipotablamaestrouno - Registro de los tipos de combos para el colaborador */
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_tipotablamaestrouno`;
CREATE TABLE `BDLIMABUS`.`glo_tipotablamaestrouno` (
  `ttablamaestrouno_id` int(11) NOT NULL AUTO_INCREMENT,
  `ttablamaestrouno_tipo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablamaestrouno_operacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablamaestrouno_detalle` varchar(250) CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (`ttablamaestrouno_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* glo_tipotablausuario - Registro de los tipos de combos para el usuario */
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_tipotablausuario`;
CREATE TABLE `BDLIMABUS`.`glo_tipotablausuario` (
  `ttablausuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `ttablausuario_tipo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablausuario_operacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablausuario_detalle` varchar(250) CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (`ttablausuario_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* inasistencias - Registro de las novedades de accidentes para el calculo de desempeño */
DROP TABLE IF EXISTS `BDLIMABUS`.`inasistencias`;
CREATE TABLE `BDLIMABUS`.`inasistencias` (
  `Inasistencia_id` int NOT NULL AUTO_INCREMENT,
  `Inas_IdNovedad` varchar(20) DEFAULT NULL,
  `Inas_NombreCGO` varchar(25) DEFAULT NULL,
  `Inas_DNI` varchar(8) DEFAULT NULL,
  `Inas_CodPiloto` varchar(4) DEFAULT NULL,
  `Inas_NombrePiloto` varchar(60) DEFAULT NULL,
  `Inas_TipoPiloto` varchar(20) DEFAULT NULL,
  `Inas_FechaDeEvento` date DEFAULT NULL,
  `Inas_HoraInicio` time DEFAULT NULL,
  `Inas_HoraFinal` time DEFAULT NULL,
  `Inas_TotalHoras` time DEFAULT NULL,
  `Inas_Bus` varchar(10) DEFAULT NULL,
  `Inas_TipoBus` varchar(15) DEFAULT NULL,
  `Inas_Tabla` varchar(20) DEFAULT NULL,
  `Inas_Servicio` varchar(40) DEFAULT NULL,
  `Inas_TipoNovedad` varchar(35) DEFAULT NULL,
  `Inas_DetalleNovedad` varchar(40) DEFAULT NULL,
  `Inas_DescripNovedad` varchar(1300) DEFAULT NULL,
  `Inas_FechaCarga` datetime DEFAULT NULL,
  PRIMARY KEY (`Inasistencia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/* informativo - Registro de los informativos publicados */
DROP TABLE IF EXISTS `BDLIMABUS`.`informativo`;
CREATE TABLE `BDLIMABUS`.`informativo` (
  `Informativo_Id` int NOT NULL AUTO_INCREMENT,
  `Info_Titulo` varchar(100) DEFAULT NULL,
  `Info_Tipo` varchar(25) NOT NULL,
  `Info_Estado` varchar(45) DEFAULT NULL,
  `Info_RutaImagen` varchar(100) DEFAULT NULL,
  `Info_FechaPublicacion` datetime DEFAULT NULL,
  `Info_FechaEvaluacion` datetime DEFAULT NULL,
  `Info_FechaArchivo` datetime DEFAULT NULL,
  PRIMARY KEY (`Informativo_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/* manto_cargapreciomateriales - Registro de cargas desde archivo excel con los precios de materiales por proveedor */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_cargapreciomateriales`;
CREATE TABLE `BDLIMABUS`.`manto_cargapreciomateriales` ( 
  `cpm_id` INT(11) NOT NULL AUTO_INCREMENT , 
  `cpm_nroregistros` INT(11) NOT NULL ,
  `cpm_fechacarga` TIMESTAMP NOT NULL , 
  `cpm_responsablecarga` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `cpm_fechaeliminacion` TIMESTAMP NULL DEFAULT NULL, 
  `cpm_responsableeliminacion` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
  `cpm_estado` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  PRIMARY KEY (`cpm_id`)
) ENGINE = InnoDB;

/* manto_ckl_kilometraje - Registro de kilometraje diario por bus */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_ckl_kilometraje`;
CREATE TABLE `BDLIMABUS`.`manto_ckl_kilometraje` (
  `CKL_KM_FECHA` date NOT NULL,
  `CKL_KM_BUS` varchar(11) NOT NULL,
  `CKL_KM_KILOMETRAJE` int(11) NOT NULL,
  `CKL_KM_USU_CARGA` varchar(8) NOT NULL,
  `CKL_KM_FECHA_CARGA` datetime NOT NULL,
  `CKL_KM_HISTORIAL` varchar(500) DEFAULT NULL,
  `CKL_KM_MOTIVO` varchar(45) DEFAULT NULL,
  `CKL_KILOMETRAJEcol` varchar(45) DEFAULT NULL,
  `ckl_km_kmcargaid` int(11) NOT NULL,
  PRIMARY KEY (`CKL_KM_FECHA`,`CKL_KM_BUS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/* manto_cotizaciones - Resgistro de los datos de la cabecera para la solicitud de cotizaciones */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_cotizaciones`;
CREATE TABLE `BDLIMABUS`.`manto_cotizaciones` (
    `cotizacion_id` INT(11) NOT NULL AUTO_INCREMENT,
    `coti_fecha` TIMESTAMP NOT NULL ,
    `coti_pedidoid` INT(11) NOT NULL,
    `coti_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `coti_razonsocial` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `coti_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `coti_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `coti_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`cotizacion_id`)
) ENGINE=InnoDB;

/* manto_cotizacionesesimagen - Registro de imagenes para cotizacioneses */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_cotizacionesimagen`;
CREATE TABLE `BDLIMABUS`.`manto_cotizacionesimagen` ( 
    `cotimag_id`  INT(11) NOT NULL AUTO_INCREMENT ,
    `cotimag_cotizacionid` INT(11) NOT NULL ,
    `cotimag_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `cotimag_tipoimagen` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `cotimag_imagen` LONGBLOB NULL DEFAULT NULL , 
    `cotimag_usuarioid` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `cotimag_fecha` TIMESTAMP NOT NULL ,
    `cotimag_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`cotimag_id`)
) ENGINE = InnoDB;

/* manto_mantocarga - Registro de cargas desde archivo excel con los kilometros por bus */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_kmcarga`;
CREATE TABLE `BDLIMABUS`.`manto_kmcarga` ( 
    `kmcarga_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `kmcarga_nroregistros` INT(11) NOT NULL ,
    `kmcarga_fecha` TIMESTAMP NOT NULL , 
    `kmcarga_fechacarga` TIMESTAMP NOT NULL, 
    `kmcarga_usuarioid` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`kmcarga_id`)
) ENGINE = InnoDB;

/* manto_mantocarga - Registro de materiales */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_materiales`;
CREATE TABLE `BDLIMABUS`.`manto_materiales` ( 
  `material_id`  VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `material_macrosistema` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `material_sistema` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `material_tarjeta` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `material_condicion` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `material_flota` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `material_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
  `material_categoria` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
  `material_patrimonial` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `material_fechacreacion` DATE NOT NULL ,
  `material_responsablecreacion` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `material_observaciones` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
  `material_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `material_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  PRIMARY KEY (`material_id`)
) ENGINE = InnoDB;

/* manto_materialescotizaciones - Registro del detalle de las cotizaciones materiles y cantidades */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_materialescotizaciones`;
CREATE TABLE `BDLIMABUS`.`manto_materialescotizaciones` (
    `mc_id` INT(11) NOT NULL AUTO_INCREMENT,
    `mc_cotizacionid` INT(11) NOT NULL,
    `mc_materialid` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `mc_unidadmedida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `mc_cantidad` FLOAT NOT NULL,
    `mc_observaciones` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `mc_precioprovid` INT(11) NULL , 
    `mc_codproveedor` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `mc_moneda` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `mc_preciocotizacion` FLOAT NULL ,
    `mc_precio` FLOAT NULL ,
    `mc_preciosoles` FLOAT NULL ,
    `mc_fechavigencia` DATE NULL ,
    PRIMARY KEY (`mc_id`)
) ENGINE=InnoDB;

/* manto_materialesimagen - Registro de imagenes para materiales */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_materialesimagen`;
CREATE TABLE `BDLIMABUS`.`manto_materialesimagen` ( 
  `matimag_id`  INT(11) NOT NULL AUTO_INCREMENT ,
  `matimag_codproveedor` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `matimag_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `matimag_tipoimagen` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `matimag_imagen` LONGBLOB NULL DEFAULT NULL , 
  `matimag_usuarioid` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `matimag_fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `matimag_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  PRIMARY KEY (`matimag_id`)
) ENGINE = InnoDB;

/* manto_materialespedidos - Registro del detalle de pedidos materiales y cantidades */ 
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_materialespedidos`;
CREATE TABLE `BDLIMABUS`.`manto_materialespedidos` (
  `mp_id` INT(11) NOT NULL AUTO_INCREMENT,
  `mp_pedidoid` INT(11) NOT NULL,
  `mp_materialid` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `mp_unidadmedida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `mp_cantidad` FLOAT NOT NULL,
  `mp_observaciones` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  PRIMARY KEY (`mp_id`)
) ENGINE=InnoDB;

/* manto_ordencompra - Registro de los datos de la cabecera de la orden de compra */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_ordencompra`;
CREATE TABLE `BDLIMABUS`.`manto_ordencompra` (
    `ordencompra_id` INT(11) NOT NULL AUTO_INCREMENT,
    `orco_fecha` TIMESTAMP NOT NULL ,
    `orco_pedidoid` INT(11) NOT NULL,
    `orco_cotizacionid` INT(11) NOT NULL,
    `orco_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `orco_razonsocial` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `orco_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `orco_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `orco_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`ordencompra_id`)
) ENGINE=InnoDB;

/* manto_origenes - Registro de los tipos de origenes para las OT Correctivas */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_origenes`;
CREATE TABLE `BDLIMABUS`.`manto_origenes` (
  `cod_origen` int NOT NULL AUTO_INCREMENT,
  `or_nombre` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`cod_origen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/* manto_ot - Registro de las ordenes de trabajo correctivas */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_ot`;
CREATE TABLE `BDLIMABUS`.`manto_ot` (
  `cod_ot` int NOT NULL AUTO_INCREMENT,
  `ot_origen` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_bus` varchar(11) NOT NULL,
  `ot_kilometraje` int DEFAULT NULL,
  `ot_date_crea` datetime DEFAULT NULL,
  `ot_date_ct` datetime DEFAULT NULL,
  `ot_asociado` varchar(50) NOT NULL,
  `ot_hmotor` varchar(11) NOT NULL,
  `ot_cgm_crea` varchar(8) DEFAULT NULL,
  `ot_cgm_ct` varchar(8) DEFAULT NULL,
  `ot_estado` varchar(50) NOT NULL,
  `ot_reg_rec` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ot_resp_asoc` varchar(50) NOT NULL,
  `ot_descrip` varchar(10000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_tecnico` varchar(50) NOT NULL,
  `ot_check` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_obs_cgm` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_recep_aom` int DEFAULT NULL,
  `ot_date_recep_aom` datetime DEFAULT NULL,
  `ot_sistema` varchar(200) NOT NULL,
  `ot_inicio` datetime DEFAULT NULL,
  `ot_fin` datetime DEFAULT NULL,
  `ot_codfalla` varchar(50) NOT NULL,
  `ot_at` varchar(5000) NOT NULL,
  `ot_obs_asoc` varchar(5000) NOT NULL,
  `ot_montado` varchar(50) NOT NULL,
  `ot_dmontado` varchar(50) NOT NULL,
  `ot_busmont` varchar(11) NOT NULL,
  `ot_busdmont` varchar(11) NOT NULL,
  `ot_motivo` varchar(200) NOT NULL,
  `ot_obs_aom` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_ca` varchar(8) DEFAULT NULL,
  `ot_date_ca` datetime DEFAULT NULL,
  `ot_obs_km` int DEFAULT NULL,
  `ot_date_rec_cgm` datetime DEFAULT NULL,
  `ot_pin` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ot_componente_raiz` varchar(500) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  PRIMARY KEY (`cod_ot`),
  KEY `ot_cgm_crea` (`ot_cgm_crea`),
  KEY `ot_cgm_ct` (`ot_cgm_ct`),
  KEY `ot_bus` (`ot_bus`),
  KEY `ot_recep` (`ot_recep_aom`),
  KEY `ot_ca` (`ot_ca`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/* manto_otprv - Registro de las ordenes de trabajo preventivas */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_otprv`;
CREATE TABLE `BDLIMABUS`.`manto_otprv` (
  `cod_otpv` int NOT NULL,
  `otpv_semana` varchar(20) NOT NULL,
  `otpv_turno` varchar(10) NOT NULL,
  `otpv_date_prog` date DEFAULT NULL,
  `otpv_bus` varchar(10) NOT NULL COMMENT 'Orden de Trabajo Preventiva Numero Externo Bus',
  `otpv_fecuencia` varchar(20) NOT NULL,
  `otpv_descripcion` varchar(200) NOT NULL,
  `otpv_asociado` varchar(15) NOT NULL,
  `otpv_genera` varchar(8) DEFAULT NULL,
  `otpv_date_genera` datetime NOT NULL,
  `otpv_estado` varchar(15) NOT NULL,
  `otpv_cgm_cierra` varchar(8) DEFAULT NULL,
  `otpv_tecnico` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_inicio` datetime DEFAULT NULL,
  `otpv_fin` datetime DEFAULT NULL,
  `otpv_kmrealiza` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_hmotor` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_componente` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_obs_as` varchar(4000) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_obs_cgm` varchar(4000) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_cierra_ad` varchar(8) DEFAULT NULL,
  `otpv_date_cierra_ad` datetime DEFAULT NULL,
  `otpv_obs_cierre_ad` varchar(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_obs_km` int DEFAULT NULL,
  `otpv_cargaid` int DEFAULT NULL,
  PRIMARY KEY (`cod_otpv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/* manto_otprvcarga - Resgistro de carga desde archivo excel con las OT Preventivas */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_otprv`;
CREATE TABLE `BDLIMABUS`.`manto_otprvcarga` ( 
    `otprvcarga_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `otprvcarga_semanaprogramada` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `otprvcarga_nroregistros` INT(11) NOT NULL ,
    `otprvcarga_fechacargada` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `otprvcarga_usuarioid` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`otprvcarga_id`)
) ENGINE = InnoDB;

/* manto_pedidos - Registro de los datos de cabecera de pedidos */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_pedidos`;
CREATE TABLE `BDLIMABUS`.`manto_pedidos` (
    `pedido_id` INT(11) NOT NULL AUTO_INCREMENT,
    `pedi_fechacreacion` DATE NOT NULL ,
    `pedi_fecharequerimiento` DATE NULL ,
    `pedi_fechallegada` DATE NULL ,
    `pedi_urgencia` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pedi_bus` VARCHAR(10) NOT NULL,
    `pedi_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `pedi_cotizacion` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `pedi_ordencompra` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `pedi_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pedi_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`pedido_id`)
) ENGINE=InnoDB;

/* manto_pedidos - Registro de los datos de cabecera de pedidos */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_pedidos`;
CREATE TABLE `BDLIMABUS`.`manto_pedidos` (
    `pedido_id` INT(11) NOT NULL AUTO_INCREMENT,
    `pedi_fechacreacion` DATE NOT NULL ,
    `pedi_fecharequerimiento` DATE NULL ,
    `pedi_fechallegada` DATE NULL ,
    `pedi_urgencia` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pedi_bus` VARCHAR(10) NOT NULL,
    `pedi_centrocosto` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `pedi_ordcompdirecta` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,    
    `pedi_condicion` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `pedi_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `pedi_cotizacionid` int(11) NULL ,
    `pedi_ordencompraid` int(11) NULL ,
    `pedi_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pedi_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`pedido_id`)
) ENGINE=InnoDB;
/* manto_preciosproveedor - Registro de los precios por proveedor de materiales */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_preciosproveedor`;
CREATE TABLE `BDLIMABUS`.`manto_preciosproveedor` ( 
    `precioprov_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `precioprov_codproveedor` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `precioprov_marca` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `precioprov_procedencia` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `precioprov_unidadmedida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `precioprov_garantia` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `precioprov_moneda` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `precioprov_precio` FLOAT NULL ,
    `precioprov_preciosoles` FLOAT NULL ,
    `precioprov_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_razonsocial` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_materialid` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_documentacion` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `precioprov_fechavigencia` DATE NOT NULL ,
    `precioprov_cargaid` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_responsablecreacion` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_fechacreacion` DATE NOT NULL ,
    `precioprov_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `precioprov_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    PRIMARY KEY (`precioprov_id`)
) ENGINE = InnoDB;

/* manto_proveedores - Registro de los datos de proveedores */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_proveedores`;
CREATE TABLE `BDLIMABUS`.`manto_proveedores` ( 
    `prov_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `prov_razonsocial` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `prov_contacto` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `prov_cuentabancaria` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `prov_correo` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `prov_telefono` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `prov_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `prov_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    PRIMARY KEY (`prov_ruc`)
) ENGINE = InnoDB;

/* manto_rep_vale - Registro del detalle de repuestos por vale */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_rep_vale`;
CREATE TABLE `BDLIMABUS`.`manto_rep_vale` (
  `cod_rv` int NOT NULL AUTO_INCREMENT,
  `rv_vale` int NOT NULL,
  `rv_repuesto` varchar(20) NOT NULL,
  `rv_nroserie` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `rv_cantidad` decimal(10,2) NOT NULL,
  `rv_precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cod_rv`),
  KEY `rv_vale` (`rv_vale`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/* manto_repuestos - Registro de los repuestos utilizados en los vales */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_repuestos`;
CREATE TABLE `BDLIMABUS`.`manto_repuestos` (
  `rep_desc` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `rep_unida` varchar(10) NOT NULL,
  `rep_precio` decimal(10,2) NOT NULL,
  `rep_ingreso` varchar(20) NOT NULL,
  `cod_rep` varchar(20) NOT NULL,
  `rep_asociado` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`cod_rep`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/* manto_resp_asociado - Registro del personal responsable por asociado*/
DROP TABLE IF EXISTS 
CREATE TABLE `BDLIMABUS`.`manto_resp_asociado` (
  `cod_resasoc` int NOT NULL AUTO_INCREMENT,
  `ra_nombres` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ra_asociado` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`cod_resasoc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

