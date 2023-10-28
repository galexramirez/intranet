CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_inspeccion_detalle` (
  `inspeccion_detalle_id` INT NOT NULL AUTO_INCREMENT,
  `inspeccion_id` INT NOT NULL,
  `insp_colaborador_id` VARCHAR(8) NULL,
  `insp_fecha_detalle` DATETIME NULL,
  `insp_bus` VARCHAR(11) NOT NULL,
  `insp_detalle_estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`inspeccion_detalle_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_inspeccion_codigo` (
  `inspeccion_codigo_id` INT NOT NULL AUTO_INCREMENT,
  `insp_bus_tipo` VARCHAR(45) NOT NULL,
  `insp_orden` INT NOT NULL,  
  `insp_codigo` VARCHAR(45) NOT NULL,
  `insp_descripcion` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`inspeccion_codigo_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_inspeccion_registro` (
  `inspeccion_id` INT NOT NULL AUTO_INCREMENT,
  `insp_fecha_programada` DATE NOT NULL,
  `insp_bus_tipo` VARCHAR(15) NOT NULL,
  `insp_seleccion_buses` VARCHAR(15) NOT NULL,
  `insp_usuario_id_genera` VARCHAR(8) NULL,
  `insp_fecha_genera` DATETIME NOT NULL,
  `insp_usuario_id_cierra` VARCHAR(8) NOT NULL,
  `insp_fecha_cierre` DATETIME NOT NULL,
  `insp_estado` VARCHAR(45) NOT NULL,
  `insp_log` VARCHAR(1000) NULL,
  PRIMARY KEY (`inspeccion_registro_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_tc_inspeccion` (
  `tc_inspeccion_id` INT NOT NULL AUTO_INCREMENT,
  `tc_variable` VARCHAR(45) NOT NULL,
  `tc_ficha` VARCHAR(45) NOT NULL,
  `tc_categoria1` VARCHAR(45) NOT NULL,
  `tc_categoria2` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`tc_inspeccion_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_inspeccion_bus` (
  `inspeccion_bus_id` INT NOT NULL AUTO_INCREMENT,
  `inspeccion_id` INT NOT NULL,
  `insp_bus` VARCHAR(11) NOT NULL,
  `insp_codigo` VARCHAR(45) NULL,
  `insp_descripcion` VARCHAR(250) NULL,
  `insp_estado_codigo` VARCHAR(45) NULL,
  PRIMARY KEY (`inspeccion_bus_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_inspeccion_componente` (
  `inspeccion_componente_id` INT NOT NULL AUTO_INCREMENT,
  `insp_bus_tipo` VARCHAR(45) NOT NULL,
  `insp_codigo` VARCHAR(45) NOT NULL,
  `insp_componente` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`inspeccion_componente_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_inspeccion_falla_accion` (
  `inspeccion_falla_accion_id` INT NOT NULL AUTO_INCREMENT,
  `insp_bus_tipo` VARCHAR(45) NOT NULL,
  `insp_codigo` VARCHAR(45) NOT NULL,
  `insp_componente` VARCHAR(100) NOT NULL,
  `insp_falla` VARCHAR(45) NOT NULL,
  `insp_accion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`inspeccion_falla_accion_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_inspeccion_posicion` (
  `inspeccion_posicion_id` INT NOT NULL AUTO_INCREMENT,
  `insp_bus_tipo` VARCHAR(45) NOT NULL,
  `insp_codigo` VARCHAR(45) NOT NULL,
  `insp_componente` VARCHAR(100) NOT NULL,
  `insp_posicion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`inspeccion_posicion_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_inspeccion_movimiento` (
  `inspeccion_movimiento_id` INT NOT NULL AUTO_INCREMENT,
  `inspeccion_id` INT NOT NULL,
  `insp_bus_tipo` VARCHAR(45) NOT NULL,
  `insp_bus` VARCHAR(11) NOT NULL,
  `insp_codigo` VARCHAR(45) NOT NULL,
  `insp_descripcion` VARCHAR(250) NOT NULL,
  `insp_componente` VARCHAR(100) NOT NULL,
  `insp_posicion` VARCHAR(100) NOT NULL,
  `insp_falla` VARCHAR(45) NOT NULL,
  `insp_accion` VARCHAR(45) NOT NULL,
  `insp_fecha` DATETIME NOT NULL,
  `insp_usuario_id` VARCHAR(8) NOT NULL,
  `insp_movimiento_estado` VARCHAR(45) NOT NULL,
  `insp_usuario_id_anula` VARCHAR(8) NULL,
  `insp_fecha_anula` DATETIME NULL,
  `insp_orden_trabajo_id` INT NULL,
  PRIMARY KEY (`inspeccion_movimiento_id`))
ENGINE = InnoDB;
