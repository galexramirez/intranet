CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`glo_manual` (
  `manual_id` INT NOT NULL AUTO_INCREMENT,
  `man_modulo_id` INT NULL,
  `man_titulo` VARCHAR(100) NOT NULL,
  `man_usuario_genera` VARCHAR(8) NOT NULL,
  `man_fecha_genera` DATETIME NOT NULL,
  `man_log` VARCHAR(1000) NULL,
  PRIMARY KEY (`manual_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`glo_manual_html` (
  `manual_html_id` INT NOT NULL AUTO_INCREMENT,
  `manual_id` INT NOT NULL,
  `man_html` LONGTEXT NULL,
  PRIMARY KEY (`manual_html_id`))
ENGINE = InnoDB;