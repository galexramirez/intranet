/* 
MODIFICAR TABLA manto_ckl_kilometraje se agrega el campo:
ckl_km_kmcargaid para el control de la carga del kilometraje
se modifica el tipo de campo:
CKL_KM_USU_CARGA de int(11) a varchar(8)
*/
ALTER TABLE `manto_ckl_kilometraje` ADD `ckl_km_kmcargaid` INT(11) NOT NULL AFTER `CKL_KILOMETRAJEcol`;
ALTER TABLE `manto_ckl_kilometraje` CHANGE `CKL_KM_USU_CARGA` `CKL_KM_USU_CARGA` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

CREATE TABLE `manto_ckl_kilometraje` (
  `CKL_KM_FECHA` date NOT NULL,
  `CKL_KM_BUS` varchar(11) NOT NULL,
  `CKL_KM_KILOMETRAJE` int(11) NOT NULL,
  `CKL_KM_USU_CARGA` varchar(8) NOT NULL,
  `CKL_KM_FECHA_CARGA` datetime NOT NULL,
  `CKL_KM_HISTORIAL` varchar(500) DEFAULT NULL,
  `CKL_KM_MOTIVO` varchar(45) DEFAULT NULL,
  `CKL_KILOMETRAJEcol` varchar(45) DEFAULT NULL,
  `ckl_km_kmcargaid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE `manto_ckl_kilometraje` ADD PRIMARY KEY(`CKL_KM_FECHA`, `CKL_KM_BUS`); 

/*
CREAR TABLA manto_kmcarga donde se registraran todas las cargas de los kilometrajes
*/
CREATE TABLE `manto_kmcarga` (
  `kmcarga_id` int(11) NOT NULL,
  `kmcarga_nroregistros` int(11) NOT NULL,
  `kmcarga_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kmcarga_fechacarga` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kmcarga_usuarioid` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
ACTUALIZAR EL CAMPO manto_ckl_kilometraje.CKL_KM_USU_CARGA con el número de DNI del colaborador desde la tabla manto_usuario
*/
UPDATE `manto_ckl_kilometraje` SET `CKL_KM_USU_CARGA`=(SELECT `dni_usuario` FROM `manto_usuario` WHERE `cod_usuario`=`CKL_KM_USU_CARGA`);
