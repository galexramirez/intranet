/* manto_materiales_orden_compra - Registro de los datos del detalle de la orden de compra */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_material_orden_compra`;
CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_material_orden_compra` (
  `moc_id` INT NOT NULL,
  `moc_orden_compra_id` INT NOT NULL,
  `moc_cotizacion_id` INT NOT NULL,
  `moc_pedido_id` INT NOT NULL,
  `moc_material_id` VARCHAR(45) NOT NULL,
  `moc_unidad_medida` VARCHAR(15) NOT NULL,
  `moc_cantidad` FLOAT NOT NULL,
  `moc_moneda` VARCHAR(15) NOT NULL,
  `moc_precio_soles` FLOAT NOT NULL,
  `moc_observaciones` VARCHAR(100) NULL,
  PRIMARY KEY (`moc_id`)
  )ENGINE = InnoDB;