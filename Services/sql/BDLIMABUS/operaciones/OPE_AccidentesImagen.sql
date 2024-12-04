CREATE TABLE `BDLIMABUS`.`OPE_AccidentesImagen` ( 
`OPE_AcciImagenId`  INT(11) NOT NULL AUTO_INCREMENT ,
`Accidentes_Id` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_TipoImagen` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_ImagenUsuarioId` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_ImagenFecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
`Acci_Archivo` varchar(100) DEFAULT NOT NULL,
`Acci_Log` varchar(1000) DEFAULT NULL,
PRIMARY KEY (`OPE_AcciImagenId`)) ENGINE = InnoDB;


UPDATE BDLIMABUS.OPE_AccidentesImagen
SET Acci_Archivo=CONCAT(Accidentes_Id,'_qr_code.png')
WHERE Acci_TipoImagen='CodigoQR';
UPDATE BDLIMABUS.OPE_AccidentesImagen
SET Acci_Archivo=CONCAT(Accidentes_Id,'_',LOWER(Acci_TipoImagen),'.jpg')
WHERE 
SUBSTRING(Acci_TipoImagen,1,2) ='Im' OR
SUBSTRING(Acci_TipoImagen,1,2) ='Ma';
UPDATE BDLIMABUS.OPE_AccidentesImagen
SET Acci_Archivo=CONCAT(Accidentes_Id,'_ip.pdf')
WHERE 
SUBSTRING(Acci_TipoImagen,1,2) ='IP';
UPDATE BDLIMABUS.OPE_AccidentesImagen
SET Acci_Archivo=CONCAT(Accidentes_Id,'_doc_adj.pdf')
WHERE 
SUBSTRING(Acci_TipoImagen,1,2) ='PD';