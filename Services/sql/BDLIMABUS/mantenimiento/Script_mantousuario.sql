/*
MODIFICAR LA TABLA manto_usuario se agrega el campo:
dni_usuario para registrar el numero de DNI del usuario
*/
ALTER TABLE `manto_usuario` ADD `dni_usuario` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `usu_prg`;
UPDATE `manto_usuario` SET `dni_usuario`=`cod_usuario`;

CREATE TABLE `manto_usuario` (
  `cod_usuario` int(11) NOT NULL,
  `usu_apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_nombres` varchar(50) CHARACTER SET utf8 NOT NULL,
  `usu_usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `usu_password` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `usu_estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `usu_tipo` varchar(100) CHARACTER SET utf8 NOT NULL,
  `usu_cgm` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `usu_fnc_cgm` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `usu_aom` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `usu_eco` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `usu_prg` varchar(5) COLLATE utf8_spanish_ci NOT NULL COMMENT 'permite cargar OT prventivas y  programacion y modificar',
  `dni_usuario` varchar(8) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*
Se actuliza el campo dni_usuario
*/
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='1'
UPDATE `manto_usuario` SET `dni_usuario`='41782444' WHERE `cod_usuario`='2'
UPDATE `manto_usuario` SET `dni_usuario`='45051884' WHERE `cod_usuario`='3'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='4'
UPDATE `manto_usuario` SET `dni_usuario`='10796107' WHERE `cod_usuario`='5'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='6'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='7'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='8'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='9'
UPDATE `manto_usuario` SET `dni_usuario`='09969811' WHERE `cod_usuario`='10'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='11'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='12'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='13'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='14'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='15'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='16'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='17'
UPDATE `manto_usuario` SET `dni_usuario`='41728477' WHERE `cod_usuario`='18'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='19'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='20'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='21'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='22'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='23'
UPDATE `manto_usuario` SET `dni_usuario`='43578022' WHERE `cod_usuario`='24'
UPDATE `manto_usuario` SET `dni_usuario`='10796325' WHERE `cod_usuario`='25'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='26'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='27'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='28'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='29'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='30'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='31'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='32'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='33'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='34'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='35'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='36'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='37'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='38'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='39'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='40'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='41'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='42'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='43'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='44'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='45'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='46'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='47'
UPDATE `manto_usuario` SET `dni_usuario`='43548301' WHERE `cod_usuario`='48'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='49'
UPDATE `manto_usuario` SET `dni_usuario`='47659398' WHERE `cod_usuario`='50'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='51'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='52'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='53'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='54'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='55'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='56'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='57'
UPDATE `manto_usuario` SET `dni_usuario`='48222016' WHERE `cod_usuario`='58'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='59'
UPDATE `manto_usuario` SET `dni_usuario`='46109476' WHERE `cod_usuario`='60'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='61'
UPDATE `manto_usuario` SET `dni_usuario`='41715160' WHERE `cod_usuario`='62'
UPDATE `manto_usuario` SET `dni_usuario`='42812456' WHERE `cod_usuario`='63'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='64'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='65'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='66'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='67'
UPDATE `manto_usuario` SET `dni_usuario`='44959794' WHERE `cod_usuario`='68'
UPDATE `manto_usuario` SET `dni_usuario`='' WHERE `cod_usuario`='69'