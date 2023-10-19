/* glo_objetos - Registro de objetos para el control de accesos*/
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_controlaccesos`;
CREATE TABLE `BDLIMABUS`.`glo_controlaccesos` (
  `controlaccesos_id` int(11) NOT NULL AUTO_INCREMENT,
  `cacces_perfil` varchar(30) NOT NULL,
  `cacces_moduloid` int(11) NOT NULL,
  `cacces_objetoid` int(11) NOT NULL,
  `cacces_acceso` varchar(2) NOT NULL,
PRIMARY KEY (`controlaccesos_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;