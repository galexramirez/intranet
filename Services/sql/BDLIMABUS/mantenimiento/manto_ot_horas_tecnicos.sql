CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_ot_horas_tecnicos` (
  `horas_tecnicos_id` INT NOT NULL AUTO_INCREMENT,
  `ht_cod_ot` INT NOT NULL,
  `ht_tecnico_nombres` VARCHAR(50) NOT NULL,
  `ht_hora_inicio` DATETIME NOT NULL,
  `ht_hora_fin` DATETIME NOT NULL,
  PRIMARY KEY (`horas_tecnicos_id`))
ENGINE = InnoDB