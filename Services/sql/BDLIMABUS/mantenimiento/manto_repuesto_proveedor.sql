CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_repuesto_proveedor` (
  `repuesto_proveedor_id` INT NOT NULL AUTO_INCREMENT,
  `repp_codigo` VARCHAR(45) NOT NULL,
  `repp_descripcion` VARCHAR(200) NOT NULL,
  `repp_unidad` VARCHAR(10) NOT NULL,
  `repp_estado` VARCHAR(15) NOT NULL,
  `repp_prov_ruc` VARCHAR(11) NOT NULL,
  `repp_fecha_registro` DATETIME NOT NULL,
  `repp_log` VARCHAR(1000) NULL,
  PRIMARY KEY (`repuesto_proveedor_id`))
ENGINE = InnoDB;