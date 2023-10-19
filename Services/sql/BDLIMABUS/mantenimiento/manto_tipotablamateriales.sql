
CREATE TABLE `BDLIMABUS`.`manto_tipotablamateriales` (
  `ttablamateriales_id` int(11) NOT NULL AUTO_INCREMENT,
  `ttablamateriales_tipo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablamateriales_operacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablamateriales_detalle` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ttablamateriales_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;