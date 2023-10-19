/*ope_solicitudes - Registro de las solicitudes de pilotos*/
DROP TABLE IF EXISTS `BDLIMABUS`.`ope_solicitudes`;
CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`ope_solicitudes` (
  `solicitudes_id` INT NOT NULL,
  `soli_fecha_ingreso` TIMESTAMP NOT NULL,
  `soli_fecha_recepcion` DATE NULL,
  `soli_tipo` VARCHAR(45) NOT NULL,
  `soli_dni` VARCHAR(8) NOT NULL,
  `soli_fecha_inicio` DATE NOT NULL,
  `soli_fecha_fin` DATE NOT NULL,
  `soli_codigo_adm` VARCHAR(100) NULL,
  `soli_descripcion` VARCHAR(500) NOT NULL,
  `soli_estado` VARCHAR(15) NOT NULL,
  `soli_respuesta` VARCHAR(45) NOT NULL,
  `soli_detalle_respuesta` VARCHAR(500) NOT NULL,
  `soli_usuario` VARCHAR(8) NOT NULL,
  `soli_responsable` VARCHAR(8) NULL,
  `soli_log` VARCHAR(1000) NOT NULL,
  PRIMARY KEY (`solicitudes_id`))
ENGINE = InnoDB