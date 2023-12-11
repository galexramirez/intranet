CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_tc_orden_trabajo` (
  `tc_ot_id` INT NOT NULL AUTO_INCREMENT,
  `tc_variable` VARCHAR(45) NOT NULL,
  `tc_categoria1` VARCHAR(45) NOT NULL,
  `tc_categoria2` VARCHAR(45) NOT NULL,
  `tc_categoria3` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`tc_ot_id`))
ENGINE = InnoDB;