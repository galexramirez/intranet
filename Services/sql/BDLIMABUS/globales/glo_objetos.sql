/* glo_objetos - Registro de objetos para el control de accesos*/
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_objetos`;
CREATE TABLE `BDLIMABUS`.`glo_objetos` (
  `objetos_id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_moduloid` int(11) NOT NULL,
  `obj_nombre` varchar(100) NOT NULL,
  `obj_descripcion` varchar(200) NOT NULL,
PRIMARY KEY (`objetos_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;