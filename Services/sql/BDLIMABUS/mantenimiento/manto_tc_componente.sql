DROP TABLE IF EXISTS `BDLIMABUS`.`manto_tc_componente`;
CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_tc_componente` (
  `tc_componente_id` INT NOT NULL AUTO_INCREMENT,
  `tc_ficha` VARCHAR(45) NOT NULL,
  `tc_categoria1` VARCHAR(45) NOT NULL,
  `tc_categoria2` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`tc_componente_id`))
ENGINE = InnoDB