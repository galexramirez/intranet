CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_vale_repuestos` (
  `vale_repuestos_id` INT NOT NULL AUTO_INCREMENT,
  `vr_vale_id` INT NOT NULL,
  `vr_id` INT NOT NULL,
  `vr_tipo` VARCHAR(45) NOT NULL,
  `vr_repuesto` VARCHAR(20) NOT NULL,
  `vr_nroserie` VARCHAR(20) NULL,
  `vr_material_id` VARCHAR(45) NULL,
  `vr_cod_patrimonial_despacho` VARCHAR(9) NULL,
  `vr_cod_patrimonial_recepcion` VARCHAR(9) NULL,
  `vr_descripcion` VARCHAR(200) NULL,
  `vr_unidad_medida` VARCHAR(15) NULL,
  `vr_moneda` VARCHAR(15) NULL,
  `vr_precio` DECIMAL(10,2) NULL,
  `vr_precio_soles` FLOAT NULL,
  `vr_precio_proveedor_id` INT NULL,
  `vr_fecha_vigencia` DATE NULL,
  `vr_cantidad_requerida` DECIMAL(10,2) NOT NULL,
  `vr_cantidad_despachada` DECIMAL(10,2) NULL,
  `vr_cantidad_utilizada` DECIMAL(10,2) NULL,
  PRIMARY KEY (`vale_repuestos_id`))
ENGINE = InnoDB;