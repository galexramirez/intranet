CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`glo_usuario_token` (
  `usuario_token_id` INT NOT NULL AUTO_INCREMENT,
  `utok_usuario_id` VARCHAR(8) NOT NULL,
  `utok_token` VARCHAR(45) NOT NULL,
  `utok_estado` VARCHAR(8) NOT NULL,
  `utok_fecha` DATETIME NOT NULL,
  PRIMARY KEY (`usuario_token_id`))
ENGINE = InnoDB;