DROP TABLE IF EXISTS `BDLIMABUS`.`ope_novedad_colaborador_carga`;
CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`ope_novedad_colaborador_carga` (
  `novedad_carga_id` INT NOT NULL AUTO_INCREMENT,
  `noco_codigo_carga` VARCHAR(45) NOT NULL,
  `noco_fecha` DATETIME NOT NULL,
  `noco_registros` INT NOT NULL,
  `noco_usuario_id` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`novedad_carga_id`))
ENGINE = InnoDB;

DROP TABLE IF EXISTS `BDLIMABUS`.`ope_novedad_colaborador_detalle`;
CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`ope_novedad_colaborador_detalle` (
  `novedad_detalle_id` INT NOT NULL AUTO_INCREMENT,
  `noco_novedad_id` VARCHAR(45) NOT NULL,
  `noco_colaborador_id` VARCHAR(8) NOT NULL,
  `noco_novedad` VARCHAR(250) NOT NULL,
  `noco_fecha_inicio` DATE NULL,
  `noco_fecha_fin` DATE NULL,
  `noco_codigo_carga` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`novedad_detalle_id`))
ENGINE = InnoDB;