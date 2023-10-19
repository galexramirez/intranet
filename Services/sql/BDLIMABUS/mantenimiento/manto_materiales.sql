/* manto_materiales - Registro de materiales y servicios */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_materiales`;

CREATE TABLE `BDLIMABUS`.`manto_materiales` ( 
    `material_id`  VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `material_macrosistema` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `material_sistema` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `material_tarjeta` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `material_condicion` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `material_flota` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `material_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `material_categoria` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `material_patrimonial` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `material_unidadmedida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `material_fechacreacion` DATE NOT NULL ,
    `material_responsablecreacion` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `material_observaciones` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `material_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `material_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    PRIMARY KEY (`material_id`)
) ENGINE = InnoDB;