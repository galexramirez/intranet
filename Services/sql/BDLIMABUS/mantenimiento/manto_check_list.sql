CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_check_list_registro` (
  `check_list_registro_id` INT NOT NULL AUTO_INCREMENT,
  `check_list_id` INT NOT NULL,
  `chl_fecha` DATE NOT NULL,
  `chl_bus` VARCHAR(11) NOT NULL,
  `chl_kilometraje` INT NOT NULL,
  `chl_usuario_id_genera` VARCHAR(8) NOT NULL,
  `chl_fecha_genera` DATETIME NOT NULL,
  `chl_codigo_piloto` VARCHAR(4) NOT NULL,
  `chl_dni_piloto` VARCHAR(8) NOT NULL,
  `chl_nombre_piloto` VARCHAR(60) NOT NULL,
  `chl_estado` VARCHAR(45) NOT NULL,
  `chl_log` VARCHAR(1000) NULL,
  PRIMARY KEY (`check_list_registro_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_check_list_observaciones` (
  `check_list_observaciones_id` INT NOT NULL AUTO_INCREMENT,
  `check_list_id` INT NOT NULL,
  `chl_codigo` VARCHAR(45) NOT NULL,
  `chl_descripcion` VARCHAR(250) NOT NULL,
  `chl_componente` VARCHAR(100) NOT NULL,
  `chl_posicion` VARCHAR(100) NOT NULL,
  `chl_falla` VARCHAR(45) NOT NULL,
  `chl_accion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`check_list_observaciones_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_check_list_codigo` (
  `check_list_codigo_id` INT NOT NULL AUTO_INCREMENT,
  `chl_orden` INT NOT NULL,
  `chl_bus_tipo` VARCHAR(45) NOT NULL,
  `chl_codigo` VARCHAR(45) NOT NULL,
  `chl_descripcion` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`check_list_codigo_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_check_list_componente` (
  `check_list_componente_id` INT NOT NULL AUTO_INCREMENT,
  `chl_bus_tipo` VARCHAR(45) NOT NULL,
  `chl_codigo` VARCHAR(45) NOT NULL,
  `chl_componente` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`check_list_componente_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_check_list_falla_accion` (
  `check_list_falla_accion_id` INT NOT NULL AUTO_INCREMENT,
  `chl_bus_tipo` VARCHAR(45) NOT NULL,
  `chl_codigo` VARCHAR(45) NOT NULL,
  `chl_componente` VARCHAR(100) NOT NULL,
  `chl_falla` VARCHAR(45) NOT NULL,
  `chl_accion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`check_list_falla_accion_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_check_list_posicion` (
  `check_list_posicion_id` INT NOT NULL AUTO_INCREMENT,
  `chl_bus_tipo` VARCHAR(250) NOT NULL,
  `chl_codigo` VARCHAR(45) NOT NULL,
  `chl_componente` VARCHAR(100) NOT NULL,
  `chl_posicion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`check_list_posicion_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `BDLIMABUS`.`manto_tc_check_list` (
  `tc_check_list_id` INT NOT NULL AUTO_INCREMENT,
  `tc_variable` VARCHAR(45) NOT NULL,
  `tc_categoria1` VARCHAR(45) NOT NULL,
  `tc_categoria2` VARCHAR(45) NOT NULL,
  `tc_categoria3` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`tc_check_list_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `manto_check_list_falla_via` (
  `check_list_falla_via_id` INT NOT NULL AUTO_INCREMENT,
  `check_list_id` INT NOT NULL,
  `fav_codigo` VARCHAR(45) NOT NULL,
  `fav_descripcion` VARCHAR(250) NOT NULL,
  `fav_componente` VARCHAR(100) NOT NULL,
  `fav_posicion` VARCHAR(100) NOT NULL,
  `fav_falla` VARCHAR(45) NOT NULL,
  `fav_accion` VARCHAR(45) NOT NULL,
  `fav_novedad_id` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`check_list_falla_via_id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `manto_falla_via_codigo` (
  `falla_via_codigo_id` INT NOT NULL AUTO_INCREMENT,
  `fav_orden` INT NOT NULL,
  `fav_bus_tipo` VARCHAR(45) NOT NULL,
  `fav_codigo` VARCHAR(45) NOT NULL,
  `fav_descripcion` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`falla_via_codigo_id`))
ENGINE = InnoDB;
CREATE TABLE IF NOT EXISTS `manto_falla_via_componente` (
  `falla_via_componente_id` INT NOT NULL AUTO_INCREMENT,
  `fav_bus_tipo` VARCHAR(45) NOT NULL,
  `fav_codigo` VARCHAR(45) NOT NULL,
  `fav_componente` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`falla_via_componente_id`))
ENGINE = InnoDB;
CREATE TABLE IF NOT EXISTS `manto_falla_via_falla_accion` (
  `falla_via_falla_accion_id` INT NOT NULL AUTO_INCREMENT,
  `fav_bus_tipo` VARCHAR(45) NOT NULL,
  `fav_codigo` VARCHAR(45) NOT NULL,
  `fav_componente` VARCHAR(100) NOT NULL,
  `fav_falla` VARCHAR(45) NOT NULL,
  `fav_accion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`falla_via_falla_accion_id`))
ENGINE = InnoDB;
CREATE TABLE IF NOT EXISTS `manto_falla_via_posicion` (
  `falla_via_posicion_id` INT NOT NULL AUTO_INCREMENT,
  `fav_bus_tipo` VARCHAR(250) NOT NULL,
  `fav_codigo` VARCHAR(45) NOT NULL,
  `fav_componente` VARCHAR(100) NOT NULL,
  `fav_posicion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`falla_via_posicion_id`))
ENGINE = InnoDB;