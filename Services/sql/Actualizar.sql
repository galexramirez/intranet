UPDATE `colaborador`
 SET `Colab_CargoActual`='PILOTO BUS ALIMENTADOR' 
 WHERE `Colab_CargoActual` = 'PILOTO DE BUS ALIMENTADOR'

UPDATE `colaborador`
 SET `Colab_CargoActual`='PILOTO BUS ARTICULADO' 
 WHERE `Colab_CargoActual` = 'PILOTO DE BUS ARTICULADO'

 UPDATE `colaborador`
  SET `Colaborador_id` = '09635884'
  WHERE `colaborador`.`Colaborador_id` = '9635884' 

UPDATE `colaborador`
  SET `Colaborador_id` = '00821813'
  WHERE `colaborador`.`Colaborador_id` = '821813' 

ALTER TABLE `colaborador` 
  CHANGE `Colab_PrefilEvaluacion` 
  `Colab_PerfilEvaluacion` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;