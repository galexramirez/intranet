/* manto_unidad_medida - Registro de los tipos de unidades de medidas para materiales */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_unidad_medida`;
CREATE TABLE `BDLIMABUS`.`manto_unidad_medida` (
  `unidad_medida` varchar(15) NOT NULL,
  `um_descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`unidad_medida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;