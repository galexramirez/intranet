CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_tc_vale` (
  `tc_vale_id` INT NOT NULL AUTO_INCREMENT,
  `tc_variable` VARCHAR(45) NOT NULL,
  `tc_categoria1` VARCHAR(45) NOT NULL,
  `tc_categoria2` VARCHAR(45) NOT NULL,
  `tc_categoria3` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`tc_vale_id`))
ENGINE = InnoDB;