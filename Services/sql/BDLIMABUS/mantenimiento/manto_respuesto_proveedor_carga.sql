CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_repuesto_proveedor_carga` (
  `rpc_id` INT NOT NULL AUTO_INCREMENT,
  `rpc_nro_registros` INT NOT NULL,
  `rpc_prov_ruc` VARCHAR(11) NOT NULL,
  `rpc_prov_razon_social` VARCHAR(100) NOT NULL,
  `rpc_fecha_carga` DATETIME NOT NULL,
  `rpc_usuario_id_carga` VARCHAR(8) NOT NULL,
  `rpc_fecha_elimina` DATETIME NULL,
  `rpc_usuario_id_elimina` VARCHAR(8) NULL,
  `rpc_estado` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`rpc_id`))
ENGINE = InnoDB;