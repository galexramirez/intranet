/* manto_materialespedidos - Registro del detalle de pedidos materiales y cantidades */ 
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_materialespedidos`;
CREATE TABLE `BDLIMABUS`.`manto_materialespedidos` (
  `mp_id` INT(11) NOT NULL AUTO_INCREMENT,
  `mp_pedidoid` INT(11) NOT NULL,
  `mp_materialid` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `mp_unidadmedida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `mp_cantidad` FLOAT NOT NULL,
  `mp_bus` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
  `mp_observaciones` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL, 
  PRIMARY KEY (`mp_id`)
) ENGINE=InnoDB;