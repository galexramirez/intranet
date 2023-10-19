/* manto_inventario_registro - Registro de los datos de cabecera de inventario */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_inventario_registro`;
CREATE TABLE `BDLIMABUS`.`manto_inventario_registro` (
    `inventario_registro_id` INT(11) NOT NULL AUTO_INCREMENT,
    `invr_fecha_creacion` DATE NOT NULL ,
    `invr_almacen_id` INT(11) NOT NULL ,
    `invr_movimiento` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invr_tipo_movimiento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invr_tipo_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_nro_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_nombre_entrega` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_centro_costo` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `invr_usuario_id` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `invr_campo_1` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_campo_2` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_campo_3` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invr_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invr_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`inventario_registro_id`)
) ENGINE=InnoDB;

/* manto_inventario_movimiento - Registro de los datos de movimiento de inventario */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_inventario_movimiento`;
CREATE TABLE `BDLIMABUS`.`manto_inventario_movimiento` (
    `inventario_movimiento_id` INT(11) NOT NULL AUTO_INCREMENT,
    `invm_inventario_registro_id` INT(11) NOT NULL ,
    `invm_fecha_creacion` DATE NOT NULL ,
    `invm_almacen_id` INT(11) NOT NULL ,
    `invm_movimiento` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invm_tipo_movimiento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invm_tipo_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_nro_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_centro_costo` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `invm_material_id`  VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `invm_material_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_material_patrimonial` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `invn_unidad_medida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `invm_cantidad` FLOAT NOT NULL,
    `invm_moneda` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_precio` FLOAT NULL ,
    `invm_precio_soles` FLOAT NULL ,
    `invm_campo_1` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_campo_2` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_campo_3` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `invm_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    PRIMARY KEY (`inventario_movimiento_id`)
) ENGINE=InnoDB;

/* manto_almacen - Registro de los datos de cabecera de almacenes */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_almacen`;
CREATE TABLE `BDLIMABUS`.`manto_almacen` (
    `almacen_id` INT(11) NOT NULL AUTO_INCREMENT,
    `alm_fecha_creacion` DATE NOT NULL ,
    `alm_descripcion` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `alm_ubicacion` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `alm_dimensiones` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `alm_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `alm_campo_1` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `alm_campo_2` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `alm_campo_3` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `alm_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `alm_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`almacen_id`)
) ENGINE=InnoDB;

/* manto_tt_almacen - Registro de los datos de tipo de categorias para inventario */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_tc_inventario`;

CREATE TABLE `BDLIMABUS`.`manto_tc_inventario` (
  `tc_inventario_id` int(11) NOT NULL AUTO_INCREMENT,
  `tcin_tipo` varchar(45) CHARACTER SET utf8 NOT NULL,
  `tcin_operacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `tcin_detalle` varchar(250) CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (`tc_inventario_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* manto_material_almacen - Registro de asignacion de materiales a un almacen */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_material_almacen`;
CREATE TABLE `BDLIMABUS`.`manto_material_almacen` (
    `material_almacen_id` int(11) NOT NULL AUTO_INCREMENT,
    `malm_material_id` VARCHAR(45) NOT NULL,
    `malm_almacen_id` int(11) NOT NULL,
    `malm_usuario_id` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `malm_fecha` DATETIME NOT NULL,
    PRIMARY KEY (`material_almacen_id`)
) ENGINE=InnoDB;
INSERT INTO manto_material_almacen (malm_material_id, malm_almacen_id, malm_usuario_id, malm_fecha)
SELECT material_id, '1' AS `alamcen_id`, '00000001' AS `usuario_id`, '2022-02-11 10:18:00' AS `fecha` FROM manto_materiales;

/* manto_patrimonial_registro - Registro de los datos de cabecera de registro patrimonial */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_patrimonial_registro`;
CREATE TABLE `BDLIMABUS`.`manto_patrimonial_registro` (
    `patrimonial_registro_id` INT(11) NOT NULL AUTO_INCREMENT,
    `preg_fecha_creacion` DATE NOT NULL ,
    `preg_almacen_id` INT(11) NOT NULL ,
    `preg_movimiento` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `preg_tipo_movimiento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `preg_tipo_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `preg_nro_documento` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `preg_material_id`  VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `preg_material_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `preg_unidad_medida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `preg_cantidad` FLOAT NOT NULL,
    `preg_usuario_id` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `preg_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `preg_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`patrimonial_registro_id`)
) ENGINE=InnoDB;

/* manto_patrimonial_movimiento - Registro de los datos de movimiento de patrimonial */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_patrimonial_movimiento`;
CREATE TABLE `BDLIMABUS`.`manto_patrimonial_movimiento` (
    `patrimonial_movimiento_id` INT(11) NOT NULL AUTO_INCREMENT,
    `pmov_patrimonial_registro_id` INT(11) NOT NULL ,
    `pmov_fecha_creacion` DATE NOT NULL ,
    `pmov_patrimonial_id` INT(11) NOT NULL ,
    `pmov_patr_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `pmov_movimiento` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pmov_unidad_medida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `pmov_cantidad` FLOAT NOT NULL,
    `pmov_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    PRIMARY KEY (`patrimonial_movimiento_id`)
) ENGINE=InnoDB;

/* manto_patrimonial - Registro de codigo patrimonial */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_patrimonial`;

CREATE TABLE `BDLIMABUS`.`manto_patrimonial` ( 
    `patrimonial_id`  VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `patr_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `patr_fechacreacion` DATE NOT NULL ,
    `patr_usuario_id` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `patr_observaciones` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `patr_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `patr_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    PRIMARY KEY (`patrimonial_id`)
) ENGINE = InnoDB;