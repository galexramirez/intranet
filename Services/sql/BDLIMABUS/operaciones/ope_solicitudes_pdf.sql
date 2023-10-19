/*ope_solicitudes_pdf - Registro de las solicitudes de pilotos en formato PDF*/
DROP TABLE IF EXISTS `BDLIMABUS`.`ope_solicitudes_pdf`;
CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`ope_solicitudes_pdf` (
  `spdf_id` INT NOT NULL AUTO_INCREMENT,
  `spdf_solicitudes_id` INT NOT NULL,
  `spdf_pdf` LONGBLOB NULL,
  `spdf_log` VARCHAR(1000) NULL,
  PRIMARY KEY (`spdf_id`))
ENGINE = InnoDB