/* colaborador - Registrio de Colaboradores */
DROP TABLE IF EXISTS `BDLIMABUS`.`colaborador`;
CREATE TABLE `BDLIMABUS`.`colaborador` (
  `Colaborador_id` varchar(8) NOT NULL,
  `Colab_ApellidosNombres` varchar(60) NOT NULL,
  `Colab_CargoActual` varchar(45) NOT NULL,
  `Colab_Estado` varchar(15) NOT NULL,
  `Colab_FechaIngreso` date NOT NULL,
  `Colab_FechaCese` date DEFAULT NULL,
  `Colab_Email` varchar(80) NOT NULL,
  `Colab_Direccion` varchar(130) DEFAULT NULL,
  `Colab_Distrito` varchar(50) NOT NULL,
  `Colab_CodigoCortoPT` varchar(4) DEFAULT NULL,
  `Colab_PerfilEvaluacion` varchar(30) NOT NULL,
  PRIMARY KEY (`Colaborador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

UPDATE `BDLIMABUS`.`colaborador` SET `Colab_nombre_corto` = (SELECT `Usua_NombreCorto` FROM `BDLIMABUS`.`usuario` WHERE `Usuario_Id`=`Colaborador_id`);