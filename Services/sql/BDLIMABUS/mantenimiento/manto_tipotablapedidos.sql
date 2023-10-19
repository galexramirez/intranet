CREATE TABLE `BDLIMABUS`.`manto_tipotablapedidos` (
  `ttablapedidos_id` int(11) NOT NULL AUTO_INCREMENT,
  `ttablapedidos_tipo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablapedidos_operacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablapedidos_detalle` varchar(250) CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (`ttablapedidos_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;