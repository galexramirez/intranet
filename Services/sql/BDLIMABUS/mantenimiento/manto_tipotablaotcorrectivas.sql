CREATE TABLE `BDLIMABUS`.`manto_tipotablaotcorrectivas` (
  `ttablaotcorrectivas_id` int(11) NOT NULL AUTO_INCREMENT,
  `ttablaotcorrectivas_tipo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablaotcorrectivas_operacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ttablaotcorrectivas_detalle` varchar(250) CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (`ttablaotcorrectivas_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

