/* glo_tipotablamaestrouno - Registro de los tipos de combos para el colaborador */
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_tipotablamaestrouno`;
CREATE TABLE `BDLIMABUS`.`glo_tipotablamaestrouno` (
  `ttablamaestrouno_id` int(11) NOT NULL AUTO_INCREMENT,
  `ttablamaestrouno_tipo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablamaestrouno_operacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablamaestrouno_detalle` varchar(250) CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (`ttablamaestrouno_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;