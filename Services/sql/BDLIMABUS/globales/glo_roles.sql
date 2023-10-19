/* glo_roles - Registro de usuarios y sus diferentes tipos de perfil */
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_roles`;
CREATE TABLE `BDLIMABUS`.`glo_roles` (
    `roles_id` INT(11) NOT NULL  AUTO_INCREMENT ,
    `roles_dni` varchar(8) NOT NULL,
    `roles_apellidosnombres` varchar(60) NOT NULL,
    `roles_nombrecorto` varchar(60) NULL,
    `roles_perfil` varchar(45) NOT NULL,
    `roles_codigoatu` varchar(20) NULL,
    PRIMARY KEY (`roles_id`),
    KEY `roles_dni` (`roles_dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
