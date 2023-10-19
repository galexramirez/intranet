/* glo_tipocambio - Registro del tipo de cambios moneda dolar*/
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_tipocambio`;
CREATE TABLE `BDLIMABUS`.`glo_tipocambio` ( 
    `tipocambio_id` int(11) NOT NULL AUTO_INCREMENT, 
    `tipocambio_fecha` DATE NOT NULL , 
    `tipocambio_moneda` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `tipocambio_tipo` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `tipocambio_valor` FLOAT NOT NULL , 
PRIMARY KEY (`tipocambio_id`)) ENGINE = InnoDB;