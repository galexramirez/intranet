/* glo_tipotablausuario - Registro de los tipos de combos para el usuario */
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_tipotablausuario`;
CREATE TABLE `BDLIMABUS`.`glo_tipotablausuario` (
  `ttablausuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `ttablausuario_tipo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablausuario_operacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablausuario_detalle` varchar(250) CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (`ttablausuario_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;