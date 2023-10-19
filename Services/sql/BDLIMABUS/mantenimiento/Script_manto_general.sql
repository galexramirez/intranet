/*::::::::::::::.::::::::::::::::::: ACTUALIZAR CAMPO FECHA ::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::SOLO  SE PUEDE REALIZAR EN EL SERVIDOR 192.168.20.10 ::::::::::::::::::*/
/* SE DEBE ACTUALIZAR LOS CAMPOS FECHAS CON LOS VALORES NULL, POR LO QUE TENEMOS QUE REEMPLAZAR LAS FECHAS '0000-00-00' POR '2001-01-01' */

/* TABLA `csitecco_lbi1`.OT */
UPDATE IGNORE `csitecco_lbi1`.`OT` SET `ot_date_crea`='2001-01-01 01:01:01' WHERE `ot_date_crea`='0000-00-00 00:00:00';
UPDATE IGNORE `csitecco_lbi1`.`OT` SET `ot_date_ct`='2001-01-01 01:01:01' WHERE `ot_date_ct`='0000-00-00 00:00:00';
UPDATE IGNORE `csitecco_lbi1`.`OT` SET `ot_date_recep_aom`='2001-01-01 01:01:01' WHERE `ot_date_recep_aom`='0000-00-00 00:00:00';
UPDATE IGNORE `csitecco_lbi1`.`OT` SET `ot_inicio`='2001-01-01 01:01:01' WHERE `ot_inicio`='0000-00-00 00:00:00' OR `ot_inicio`='1900-01-00 00:00:00';
UPDATE IGNORE `csitecco_lbi1`.`OT` SET `ot_fin`='2001-01-01 01:01:01' WHERE `ot_fin`='0000-00-00 00:00:00' OR `ot_fin`='1900-01-00 00:00:00';
UPDATE IGNORE `csitecco_lbi1`.`OT` SET `ot_date_ca`='2001-01-01 01:01:01' WHERE `ot_date_ca`='0000-00-00 00:00:00';
UPDATE IGNORE `csitecco_lbi1`.`OT` SET `ot_date_rec_cgm`='2001-01-01 01:01:01' WHERE `ot_date_rec_cgm`='0000-00-00 00:00:00';

/* TABLA csitecco_lbi1.OTPRV */
UPDATE IGNORE `csitecco_lbi1`.`OTPRV` SET `otpv_date_prog`='2001-01-01' WHERE `otpv_date_prog`='0000-00-00';
UPDATE IGNORE `csitecco_lbi1`.`OTPRV` SET `otpv_inicio`='2001-01-01 01:01:01' WHERE `otpv_inicio`='0000-00-00 00:00:00';
UPDATE IGNORE `csitecco_lbi1`.`OTPRV` SET `otpv_fin`='2001-01-01 01:01:01' WHERE `otpv_fin`='0000-00-00 00:00:00' ;
UPDATE IGNORE `csitecco_lbi1`.`OTPRV` SET `otpv_date_cierra_ad`='2001-01-01 01:01:01' WHERE `otpv_date_cierra_ad`='0000-00-00 00:00:00' ;

/* TABLA `csitecco_lbi1`.vales*/
UPDATE IGNORE `csitecco_lbi1`.`vales` SET `va_date_genera`='2001-01-01 01:01:01' WHERE `va_date_genera`='0000-00-00 00:00:00';
UPDATE IGNORE `csitecco_lbi1`.`vales` SET `va_date_cierra`='2001-01-01 01:01:01' WHERE `va_date_cierra`='0000-00-00 00:00:00';
UPDATE IGNORE `csitecco_lbi1`.`vales` SET `va_date_cierre_adm`='2001-01-01 01:01:01' WHERE `va_date_cierre_adm`='0000-00-00 00:00:00';

/*:::::::::::::::::::::::::::: ELIMINAR TABLAS A COPIAR DE csittecco_lbi1 ::::::::::::::::::::::::::::*/
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_bus`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_ckl_kilometraje`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_origenes`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_ot`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_otprv`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_programacion_pt`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_rep_vale`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_repuestos`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_resp_asociado`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_usuario`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_vales`;

/*::::::::::::::::::::::::::: COPIAR TABLAS DE csitecco_lbi1 A BDLIMABUS ::::::::::::::::::::::::::::::*/
RENAME TABLE `csitecco_lbi1`.`bus` TO `BDLIMABUS`.`manto_bus`;
RENAME TABLE `csitecco_lbi1`.`CKL_KILOMETRAJE` TO `BDLIMABUS`.`manto_ckl_kilometraje`;
RENAME TABLE `csitecco_lbi1`.`origenes` TO `BDLIMABUS`.`manto_origenes`;
RENAME TABLE `csitecco_lbi1`.`OT` TO `BDLIMABUS`.`manto_ot`;
RENAME TABLE `csitecco_lbi1`.`OTPRV` TO `BDLIMABUS`.`manto_otprv`;
RENAME TABLE `csitecco_lbi1`.`PROGRAMACION_PT` TO `BDLIMABUS`.`manto_programacion_pt`;
RENAME TABLE `csitecco_lbi1`.`rep_vale` TO `BDLIMABUS`.`manto_rep_vale`;
RENAME TABLE `csitecco_lbi1`.`repuestos` TO `BDLIMABUS`.`manto_repuestos`;
RENAME TABLE `csitecco_lbi1`.`resp_asociado` TO `BDLIMABUS`.`manto_resp_asociado`;
RENAME TABLE `csitecco_lbi1`.`usuario` TO `BDLIMABUS`.`manto_usuario`;
RENAME TABLE `csitecco_lbi1`.`vales` TO `BDLIMABUS`.`manto_vales`;

/*:::::::::::::::::::::::::::. PROCESOS DE ACTULIZACION DE TABLAS DE MANTO ::::::::::::::::::::::::::::::::::::::*/
/*
MODIFICAR LA TABLA manto_usuario se agrega el campo:
dni_usuario para registrar el numero de DNI del usuario
*/
ALTER TABLE `BDLIMABUS`.`manto_usuario` ADD `dni_usuario` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `usu_prg`;
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`=`cod_usuario`;
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='43474013' WHERE `cod_usuario`='1';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='41782444' WHERE `cod_usuario`='2';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='45051884' WHERE `cod_usuario`='3';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000004' WHERE `cod_usuario`='4';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='10796107' WHERE `cod_usuario`='5';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000006' WHERE `cod_usuario`='6';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000007' WHERE `cod_usuario`='7';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000008' WHERE `cod_usuario`='8';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='41030963' WHERE `cod_usuario`='9';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='09969811' WHERE `cod_usuario`='10';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='41933089' WHERE `cod_usuario`='11';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000012' WHERE `cod_usuario`='12';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000013' WHERE `cod_usuario`='13';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000014' WHERE `cod_usuario`='14';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000015' WHERE `cod_usuario`='15';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000016' WHERE `cod_usuario`='16';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000017' WHERE `cod_usuario`='17';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='41728477' WHERE `cod_usuario`='18';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='41728477' WHERE `cod_usuario`='19';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000020' WHERE `cod_usuario`='20';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000021' WHERE `cod_usuario`='21';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000022' WHERE `cod_usuario`='22';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000023' WHERE `cod_usuario`='23';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='43578022' WHERE `cod_usuario`='24';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='10796325' WHERE `cod_usuario`='25';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000026' WHERE `cod_usuario`='26';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000027' WHERE `cod_usuario`='27';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='25781973' WHERE `cod_usuario`='28';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000029' WHERE `cod_usuario`='29';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000030' WHERE `cod_usuario`='30';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000031' WHERE `cod_usuario`='31';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='41519006' WHERE `cod_usuario`='32';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000033' WHERE `cod_usuario`='33';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='09476356' WHERE `cod_usuario`='34';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='05411053' WHERE `cod_usuario`='35';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='10392434' WHERE `cod_usuario`='36';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='09049515' WHERE `cod_usuario`='37';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000038' WHERE `cod_usuario`='38';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='44129812' WHERE `cod_usuario`='39';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000040' WHERE `cod_usuario`='40';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000041' WHERE `cod_usuario`='41';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000042' WHERE `cod_usuario`='42';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000043' WHERE `cod_usuario`='43';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000044' WHERE `cod_usuario`='44';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000045' WHERE `cod_usuario`='45';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000046' WHERE `cod_usuario`='46';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='44499233' WHERE `cod_usuario`='47';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='43548301' WHERE `cod_usuario`='48';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='48276124' WHERE `cod_usuario`='49';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='47659398' WHERE `cod_usuario`='50';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000051' WHERE `cod_usuario`='51';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000052' WHERE `cod_usuario`='52';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000053' WHERE `cod_usuario`='53';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000054' WHERE `cod_usuario`='54';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='42462055' WHERE `cod_usuario`='55';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000056' WHERE `cod_usuario`='56';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000057' WHERE `cod_usuario`='57';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='48222016' WHERE `cod_usuario`='58';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000059' WHERE `cod_usuario`='59';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='46109476' WHERE `cod_usuario`='60';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000061' WHERE `cod_usuario`='61';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='41715160' WHERE `cod_usuario`='62';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='42812456' WHERE `cod_usuario`='63';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='71629524' WHERE `cod_usuario`='64';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='41561836' WHERE `cod_usuario`='65';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='75393991' WHERE `cod_usuario`='66';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='42953312' WHERE `cod_usuario`='67';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='44959794' WHERE `cod_usuario`='68';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='74750211' WHERE `cod_usuario`='69';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='00000070' WHERE `cod_usuario`='70';
UPDATE `BDLIMABUS`.`manto_usuario` SET `dni_usuario`='48041411' WHERE `cod_usuario`='71';

/* 
MODIFICAR TABLA manto_ckl_kilometraje se agrega el campo:
ckl_km_kmcargaid para el control de la carga del kilometraje
se modifica el tipo de campo:
CKL_KM_USU_CARGA de int(11) a varchar(8)
*/
ALTER TABLE `BDLIMABUS`.`manto_ckl_kilometraje` ADD `ckl_km_kmcargaid` INT(11) NOT NULL AFTER `CKL_KILOMETRAJEcol`;
ALTER TABLE `BDLIMABUS`.`manto_ckl_kilometraje` CHANGE `CKL_KM_USU_CARGA` `CKL_KM_USU_CARGA` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
/* ALTER TABLE `manto_ckl_kilometraje` ADD PRIMARY KEY(`CKL_KM_FECHA`, `CKL_KM_BUS`); */
/*
ACTUALIZAR EL CAMPO manto_ckl_kilometraje.CKL_KM_USU_CARGA con el número de DNI del colaborador desde la tabla manto_usuario
*/
UPDATE `BDLIMABUS`.`manto_ckl_kilometraje` SET `CKL_KM_USU_CARGA`='2' WHERE `CKL_KM_USU_CARGA`='';
UPDATE `BDLIMABUS`.`manto_ckl_kilometraje` SET `CKL_KM_USU_CARGA`=(SELECT `dni_usuario` FROM `BDLIMABUS`.`manto_usuario` WHERE `cod_usuario`=`CKL_KM_USU_CARGA`);

/* TABLA manto_ot */
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_date_crea` `ot_date_crea` DATETIME NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_date_ct` `ot_date_ct` DATETIME NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_date_recep_aom` `ot_date_recep_aom` DATETIME NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_inicio` `ot_inicio` DATETIME NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_fin` `ot_fin` DATETIME NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_date_ca` `ot_date_ca` DATETIME NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_date_rec_cgm` `ot_date_rec_cgm` DATETIME NULL;

UPDATE `BDLIMABUS`.`manto_ot` SET `ot_date_crea`=NULL WHERE `ot_date_crea`='2001-01-01 01:01:01';
UPDATE `BDLIMABUS`.`manto_ot` SET `ot_date_ct`=NULL WHERE `ot_date_ct`='2001-01-01 01:01:01';
UPDATE `BDLIMABUS`.`manto_ot` SET `ot_date_recep_aom`=NULL WHERE `ot_date_recep_aom`='2001-01-01 01:01:01';
UPDATE `BDLIMABUS`.`manto_ot` SET `ot_inicio`=NULL WHERE `ot_inicio`='2001-01-01 01:01:01';
UPDATE `BDLIMABUS`.`manto_ot` SET `ot_fin`=NULL WHERE `ot_fin`='2001-01-01 01:01:01';
UPDATE `BDLIMABUS`.`manto_ot` SET `ot_date_ca`=NULL WHERE `ot_date_ca`='2001-01-01 01:01:01';
UPDATE `BDLIMABUS`.`manto_ot` SET `ot_date_rec_cgm`=NULL WHERE `ot_date_rec_cgm`='2001-01-01 01:01:01';

/*
ACTUALIZAR LOS CAMPOS con el número de DNI del colaborador
manto_ot.cgm_crea, manto_ot.cgm_ct, manto_ot.ot_ca, manto.ot_recep_aom
*/
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_cgm_crea` `ot_cgm_crea` VARCHAR(8) NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_cgm_ct` `ot_cgm_ct` VARCHAR(8) NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_ca` `ot_ca` VARCHAR(8) NULL;
UPDATE `BDLIMABUS`.`manto_ot` SET `ot_cgm_crea`=(SELECT `dni_usuario` FROM `BDLIMABUS`.`manto_usuario` WHERE `cod_usuario`=`ot_cgm_crea`);
UPDATE `BDLIMABUS`.`manto_ot` SET `ot_cgm_ct`=(SELECT `dni_usuario` FROM `BDLIMABUS`.`manto_usuario` WHERE `cod_usuario`=`ot_cgm_ct`);
UPDATE `BDLIMABUS`.`manto_ot` SET `ot_ca`=(SELECT `dni_usuario` FROM `BDLIMABUS`.`manto_usuario` WHERE `cod_usuario`=`ot_ca`);

/*
ACTUALIZA LOS CAMPOS PARA QUE ACEPTEN NULL
*/
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_kilometraje` `ot_kilometraje` INT(11) NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_recep_aom` `ot_recep_aom` INT(11) NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_obs_km` `ot_obs_km` INT(11) NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_reg_rec` `ot_reg_rec` VARCHAR(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_pin` `ot_pin` VARCHAR(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
/*
SE ACTUALIZA EL CAMPO ot_obs_gcm POR ot_obs_cgm
*/
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_obs_gcm` `ot_obs_cgm` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
/*
SE ACTUALIZA EL CAMPO ot_descrip para aceptar 13000 caracteres
*/
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_descrip` `ot_descrip` VARCHAR(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_at` `ot_at` VARCHAR(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_obs_asoc` `ot_obs_asoc` VARCHAR(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `BDLIMABUS`.`manto_ot` CHANGE `ot_obs_aom` `ot_obs_aom` VARCHAR(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

/* TABLA manto_otprv*/
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_date_prog` `otpv_date_prog` DATE NULL;
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_inicio` `otpv_inicio` DATETIME NULL;
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_fin` `otpv_fin` DATETIME NULL;
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_date_cierra_ad` `otpv_date_cierra_ad` DATETIME NULL;

UPDATE `BDLIMABUS`.`manto_otprv` SET `otpv_date_prog`=NULL WHERE `otpv_date_prog`='2001-01-01';
UPDATE `BDLIMABUS`.`manto_otprv` SET `otpv_inicio`=NULL WHERE `otpv_inicio`='2001-01-01 01:01:01';
UPDATE `BDLIMABUS`.`manto_otprv` SET `otpv_fin`=NULL WHERE `otpv_fin`='2001-01-01 01:01:01';
UPDATE `BDLIMABUS`.`manto_otprv` SET `otpv_date_cierra_ad`=NULL WHERE `otpv_date_cierra_ad`='2001-01-01 01:01:01';

/*
SE ACTUALIZAN LOS CAMPOS QUE DEBEN CONTENER DATOS NULL
*/
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_tecnico` `otpv_tecnico` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_kmrealiza` `otpv_kmrealiza` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_hmotor` `otpv_hmotor` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_componente` `otpv_componente` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_obs_as` `otpv_obs_as` VARCHAR(12000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_obs_cgm` `otpv_obs_cgm` VARCHAR(4000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_obs_cierre_ad` `otpv_obs_cierre_ad` VARCHAR(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

/*
CREACION DEL CAMPO otpv_cargaid DONDE SE REGISTRA EL ID DEL REGISTRO CARGA
*/
ALTER TABLE `BDLIMABUS`.`manto_otprv` ADD `otpv_cargaid` INT(11) NULL AFTER `otpv_obs_km`;

/*
ACTUALIZAR LOS CAMPOS con el número de DNI del colaborador
manto_otprv.otpv_genera, manto_otprv.otpv_cgm_cierra, manto_otprv.otpv_cierra_ad
*/
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_genera` `otpv_genera` VARCHAR(8) NULL;
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_cgm_cierra` `otpv_cgm_cierra` VARCHAR(8) NULL;
ALTER TABLE `BDLIMABUS`.`manto_otprv` CHANGE `otpv_cierra_ad` `otpv_cierra_ad` VARCHAR(8) NULL;

UPDATE `BDLIMABUS`.`manto_otprv` SET `otpv_genera`=(SELECT `dni_usuario` FROM `BDLIMABUS`.`manto_usuario` WHERE `cod_usuario`=`otpv_genera`);
UPDATE `BDLIMABUS`.`manto_otprv` SET `otpv_cgm_cierra`=(SELECT `dni_usuario` FROM `BDLIMABUS`.`manto_usuario` WHERE `cod_usuario`=`otpv_cgm_cierra`);
UPDATE `BDLIMABUS`.`manto_otprv` SET `otpv_cierra_ad`=(SELECT `dni_usuario` FROM `BDLIMABUS`.`manto_usuario` WHERE `cod_usuario`=`otpv_cierra_ad`);

/* TABLA manto_vales */
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_date_genera` `va_date_genera` DATETIME NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_date_cierra` `va_date_cierra` DATETIME NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_date_cierre_adm` `va_date_cierre_adm` DATETIME NULL;
UPDATE `BDLIMABUS`.`manto_vales` SET `va_date_genera`=NULL WHERE `va_date_genera`='2001-01-01 01:01:01';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_date_cierra`=NULL WHERE `va_date_cierra`='2001-01-01 01:01:01';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_date_cierre_adm`=NULL WHERE `va_date_cierre_adm`='2001-01-01 01:01:01';
/*
ACTUALIZAR LOS CAMPOS con el número de DNI del colaborador
manto_vales.va_genera, manto_vales.va_tecnico, manto_vales.va_cierra, manto_vales.va_cierre_adm, manto_vales.va_usurep
*/
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_genera` `va_genera` VARCHAR(8) NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_tecnico` `va_tecnico` VARCHAR(8) NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_cierra` `va_cierra` VARCHAR(8) NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_cierre_adm` `va_cierre_adm` VARCHAR(8) NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_usurep` `va_usurep` VARCHAR(8) NULL;
UPDATE `BDLIMABUS`.`manto_vales` SET `va_genera`=(SELECT `dni_usuario` FROM `BDLIMABUS`.`manto_usuario` WHERE `cod_usuario`=`va_genera`);
UPDATE `BDLIMABUS`.`manto_vales` SET `va_tecnico`=(SELECT `dni_usuario` FROM `BDLIMABUS`.`manto_usuario` WHERE `cod_usuario`=`va_tecnico`);
UPDATE `BDLIMABUS`.`manto_vales` SET `va_cierra`=(SELECT `dni_usuario` FROM `BDLIMABUS`.`manto_usuario` WHERE `cod_usuario`=`va_cierra`);
UPDATE `BDLIMABUS`.`manto_vales` SET `va_cierre_adm`=(SELECT `dni_usuario` FROM `BDLIMABUS`.`manto_usuario` WHERE `cod_usuario`=`va_cierre_adm`);
/*
SE ACTUALIZA EL CAMPO GARATIA EN LONGITUD A 45
*/
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_garantia` `va_garantia` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_recepcion` `va_recepcion` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_obs_cgm` `va_obs_cgm` VARCHAR(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_obs_aom` `va_obs_aom` VARCHAR(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_estado` `va_estado` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_rep` `va_rep` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_modif` `va_modif` INT(11) NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_ot` `va_ot` INT(11) NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_asociado` `va_asociado` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_responsable` `va_responsable` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_garantia` `va_garantia` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `BDLIMABUS`.`manto_vales` CHANGE `va_obs_aom` `va_obs_aom` VARCHAR(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
/*
SE AGREGA CAMPO rv_nroserie PARA LOS REPUESTOS (ALAMCENARA EL NRO. SERIE DEL REPUESTO)
*/
ALTER TABLE `manto_rep_vale` ADD `rv_nroserie` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `cod_rv`;
ALTER TABLE `manto_rep_vale` ADD `rv_id` INT NOT NULL AFTER `rv_repuesto`;

/*::::::::::::::::::::::::::::::::::: VACIAR TABLAS MANTO TRABAJADAS :::::::::::::::::::::::::::::::::::::*/
/*::::::::::::::::::::::::: SE REALIZA EN EL SERVIDOR 192.168.20.29 ::::::::::::::::::::::::::::::::*/
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_cargapreciomateriales`;
CREATE TABLE `BDLIMABUS`.`manto_cargapreciomateriales` ( 
    `cpm_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `cpm_nroregistros` INT(11) NOT NULL ,
    `cpm_fechacarga` TIMESTAMP NOT NULL , 
    `cpm_responsablecarga` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `cpm_fechaeliminacion` TIMESTAMP NULL DEFAULT NULL, 
    `cpm_responsableeliminacion` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `cpm_estado` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
PRIMARY KEY (`cpm_id`)) ENGINE = InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_cotizaciones`;
CREATE TABLE `BDLIMABUS`.`manto_cotizaciones` (
    `cotizacion_id` INT(11) NOT NULL AUTO_INCREMENT,
    `coti_fecha` TIMESTAMP NOT NULL ,
    `coti_pedidoid` INT(11) NOT NULL,
    `coti_tipo` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `coti_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `coti_razonsocial` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `coti_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `coti_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `coti_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`cotizacion_id`)
) ENGINE=InnoDB;
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
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_kmcarga`;
CREATE TABLE `BDLIMABUS`.`manto_kmcarga` ( 
    `kmcarga_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `kmcarga_nroregistros` INT(11) NOT NULL ,
    `kmcarga_fecha` TIMESTAMP NOT NULL , 
    `kmcarga_fechacarga` TIMESTAMP NOT NULL, 
    `kmcarga_usuarioid` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`kmcarga_id`)
) ENGINE = InnoDB;
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
    `material_unidadmedida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `material_fechacreacion` DATE NOT NULL ,
    `material_responsablecreacion` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `material_observaciones` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `material_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `material_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    PRIMARY KEY (`material_id`)
) ENGINE = InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_materialescotizaciones`;
CREATE TABLE `BDLIMABUS`.`manto_materialescotizaciones` (
    `mc_id` INT(11) NOT NULL AUTO_INCREMENT,
    `mc_cotizacionid` INT(11) NOT NULL,
    `mc_materialid` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `mc_unidadmedida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `mc_cantidad` FLOAT NOT NULL,
    `mc_cantidad_cotizacion` FLOAT NULL ,
    `mc_cantidad_solicitada` FLOAT NULL ,
    `mc_observaciones` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `mc_precioprovid` INT(11) NULL , 
    `mc_codproveedor` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `mc_moneda` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `mc_preciocotizacion` FLOAT NULL ,
    `mc_precio` FLOAT NULL ,
    `mc_preciosoles` FLOAT NULL ,
    `mc_fechavigencia` DATE NULL ,
    `mc_seleccion` VARCHAR(2) NOT NULL ,
    PRIMARY KEY (`mc_id`)
) ENGINE=InnoDB;
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
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_materialespedidos`;
CREATE TABLE `BDLIMABUS`.`manto_materialespedidos` (
  `mp_id` INT(11) NOT NULL AUTO_INCREMENT,
  `mp_pedidoid` INT(11) NOT NULL,
  `mp_materialid` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `mp_unidadmedida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `mp_cantidad` FLOAT NOT NULL,
  `mp_observaciones` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, 
  PRIMARY KEY (`mp_id`)
) ENGINE=InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_material_orden_compra`;
CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_material_orden_compra` (
  `moc_id` INT NOT NULL,
  `moc_orden_compra_id` INT NOT NULL,
  `moc_cotizacion_id` INT NOT NULL,
  `moc_pedido_id` INT NOT NULL,
  `moc_material_id` VARCHAR(45) NOT NULL,
  `moc_unidad_medida` VARCHAR(15) NOT NULL,
  `moc_cantidad` FLOAT NOT NULL,
  `moc_moneda` VARCHAR(15) NOT NULL,
  `moc_precio_soles` FLOAT NOT NULL,
  `moc_observaciones` VARCHAR(100) NULL,
  PRIMARY KEY (`moc_id`)
  )ENGINE = InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_ordencompra`;
CREATE TABLE `BDLIMABUS`.`manto_ordencompra` (
    `ordencompra_id` INT(11) NOT NULL AUTO_INCREMENT,
    `orco_fecha` TIMESTAMP NOT NULL ,
    `orco_pedidoid` INT(11) NOT NULL,
    `orco_cotizacionid` INT(11) NOT NULL,
    `orco_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `orco_razonsocial` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `orco_subtotal` FLOAT NOT NULL, 
    `orco_igv` FLOAT NOT NULL, 
    `orco_total` FLOAT NOT NULL,  
    `orco_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `orco_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `orco_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`ordencompra_id`)
) ENGINE=InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_otprvcarga`;
CREATE TABLE `BDLIMABUS`.`manto_otprvcarga` ( 
    `otprvcarga_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `otprvcarga_semanaprogramada` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `otprvcarga_nroregistros` INT(11) NOT NULL ,
    `otprvcarga_fechacargada` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `otprvcarga_usuarioid` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`otprvcarga_id`)
) ENGINE = InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_pedidos`;
CREATE TABLE `BDLIMABUS`.`manto_pedidos` (
    `pedido_id` INT(11) NOT NULL AUTO_INCREMENT,
    `pedi_tipo` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pedi_fechacreacion` DATE NOT NULL ,
    `pedi_fecharequerimiento` DATE NULL ,
    `pedi_fechallegada` DATE NULL ,
    `pedi_prioridad` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pedi_bus` VARCHAR(10) NOT NULL,
    `pedi_centrocosto` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `pedi_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `pedi_cotizacionid` int(11) NULL ,
    `pedi_ordencompraid` int(11) NULL ,
    `pedi_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pedi_estado_obs` VARCHAR(100) NULL ,
    `pedi_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`pedido_id`)
) ENGINE=InnoDB;
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


DROP TABLE IF EXISTS `BDLIMABUS`.`manto_inventario_registro`;
CREATE TABLE `BDLIMABUS`.`manto_inventario_registro` (
    `inventario_registro_id` INT(11) NOT NULL AUTO_INCREMENT,
    `invr_fecha_creacion` DATE NOT NULL ,
    `invr_almacen_id` INT(11) NOT NULL ,
    `invr_movimiento` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invr_tipo_movimiento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invr_tipo_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_nro_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_nombre_entrega` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_centro_costo` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `invr_usuario_id` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `invr_campo_1` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_campo_2` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_campo_3` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invr_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`inventario_registro_id`)
) ENGINE=InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_inventario_movimiento`;
CREATE TABLE `BDLIMABUS`.`manto_inventario_movimiento` (
    `inventario_movimiento_id` INT(11) NOT NULL AUTO_INCREMENT,
    `invm_inventario_registro_id` INT(11) NOT NULL ,
    `invm_fecha_creacion` DATE NOT NULL ,
    `invm_almacen_id` INT(11) NOT NULL ,
    `invm_movimiento` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invm_tipo_movimiento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invm_tipo_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_nro_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_centro_costo` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `invm_material_id`  VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `invm_material_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_material_patrimonial` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invn_unidad_medida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `invm_cantidad` FLOAT NOT NULL,
    `invm_moneda` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_precio` FLOAT NULL ,
    `invm_precio_soles` FLOAT NULL ,
    `invm_campo_1` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_campo_2` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_campo_3` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    PRIMARY KEY (`inventario_movimiento_id`)
) ENGINE=InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_almacen`;
CREATE TABLE `BDLIMABUS`.`manto_almacen` (
    `almacen_id` INT(11) NOT NULL AUTO_INCREMENT,
    `alm_fecha_creacion` DATE NOT NULL ,
    `alm_descripcion` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `alm_ubicacion` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `alm_dimensiones` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `alm_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `alm_campo_1` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `alm_campo_2` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `alm_campo_3` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `alm_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `alm_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`almacen_id`)
) ENGINE=InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_material_almacen`;
CREATE TABLE `BDLIMABUS`.`manto_material_almacen` (
    `material_almacen_id` int(11) NOT NULL AUTO_INCREMENT,
    `malm_material_id` VARCHAR(45) NOT NULL,
    `malm_almacen_id` int(11) NOT NULL,
    `malm_usuario_id` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `malm_fecha` DATETIME NOT NULL,
    PRIMARY KEY (`material_almacen_id`)
) ENGINE=InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_patrimonial_registro`;
CREATE TABLE `BDLIMABUS`.`manto_patrimonial_registro` (
    `patrimonial_registro_id` INT(11) NOT NULL AUTO_INCREMENT,
    `preg_fecha_creacion` DATE NOT NULL ,
    `preg_almacen_id` INT(11) NOT NULL ,
    `preg_movimiento` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `preg_tipo_movimiento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `preg_tipo_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `preg_nro_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `preg_material_id`  VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `preg_material_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `preg_unidad_medida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `preg_cantidad` FLOAT NOT NULL,
    `preg_usuario_id` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `preg_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `preg_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`patrimonial_registro_id`)
) ENGINE=InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_patrimonial_movimiento`;
CREATE TABLE `BDLIMABUS`.`manto_patrimonial_movimiento` (
    `patrimonial_movimiento_id` INT(11) NOT NULL AUTO_INCREMENT,
    `pmov_patrimonial_registro_id` INT(11) NOT NULL ,
    `pmov_fecha_creacion` DATE NOT NULL ,
    `pmov_patrimonial_id` INT(11) NOT NULL ,
    `pmov_patr_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `pmov_movimiento` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pmov_unidad_medida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `pmov_cantidad` FLOAT NOT NULL,
    `pmov_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    PRIMARY KEY (`patrimonial_movimiento_id`)
) ENGINE=InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_patrimonial`;
CREATE TABLE `BDLIMABUS`.`manto_patrimonial` ( 
    `patrimonial_id`  VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `patr_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `patr_fechacreacion` DATE NOT NULL ,
    `patr_usuario_id` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `patr_observaciones` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `patr_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `patr_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    PRIMARY KEY (`patrimonial_id`)
) ENGINE = InnoDB;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_unidad_medida`;
CREATE TABLE `BDLIMABUS`.`manto_unidad_medida` (
  `unidad_medida` varchar(15) NOT NULL,
  `um_descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`unidad_medida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `BDLIMABUS`.`manto_proveedores`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_tipotablamateriales`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_tipotablaotcorrectivas`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_tipotablaotpreventivas`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_tipotablapedidos`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_tipotablavales`;
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_tc_inventario`;

RENAME TABLE `BDLIMABUS2`.`manto_proveedores` TO `BDLIMABUS`.`manto_proveedores`;
RENAME TABLE `BDLIMABUS2`.`manto_tipotablamateriales` TO `BDLIMABUS`.`manto_tipotablamateriales`;
RENAME TABLE `BDLIMABUS2`.`manto_tipotablaotcorrectivas` TO `BDLIMABUS`.`manto_tipotablaotcorrectivas`;
RENAME TABLE `BDLIMABUS2`.`manto_tipotablaotpreventivas` TO `BDLIMABUS`.`manto_tipotablaotpreventivas`;
RENAME TABLE `BDLIMABUS2`.`manto_tipotablapedidos` TO `BDLIMABUS`.`manto_tipotablapedidos`;
RENAME TABLE `BDLIMABUS2`.`manto_tipotablavales` TO `BDLIMABUS`.`manto_tipotablavales`;
RENAME TABLE `BDLIMABUS2`.`manto_tc_inventario` TO `BDLIMABUS`.`manto_tc_inventario`;