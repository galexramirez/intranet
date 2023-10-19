CREATE TABLE `BDLIMABUS`.`manto_tipotablavales` (
  `ttablavales_id` int(11) NOT NULL AUTO_INCREMENT,
  `ttablavales_tipo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablavales_operacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablavales_detalle` varchar(250) CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (`ttablavales_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;