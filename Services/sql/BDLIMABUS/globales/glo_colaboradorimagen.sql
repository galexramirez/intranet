/* glo_colaboradorimagen - Registro de la fotografia del colaborador */
DROP TABLE IF EXISTS `BDLIMABUS`.`glo_colaboradorimagen`;
CREATE TABLE `BDLIMABUS`.`glo_colaboradorimagen` (
  `Colaborador_id` varchar(8) NOT NULL,
  `Colab_Fotografia` longblob,
  PRIMARY KEY (`Colaborador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;