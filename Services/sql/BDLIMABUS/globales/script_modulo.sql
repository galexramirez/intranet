ALTER TABLE `BDLIMABUS`.`Modulo` 
ADD COLUMN `mod_plegable` VARCHAR(25) NOT NULL AFTER `Mod_Icono`;

UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Ajustes' WHERE `Modulo_Id` = '1'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '2'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '3'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Ajustes' WHERE `Modulo_Id` = '4'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '5'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '12'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '13'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Ajustes' WHERE `Modulo_Id` = '15'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '18'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '19';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Mantenimiento' WHERE `Modulo_Id` = '20';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Ajustes' WHERE `Modulo_Id` = '21'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '22';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Mantenimiento' WHERE `Modulo_Id` = '24';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Ajustes' WHERE `Modulo_Id` = '25'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Mantenimiento' WHERE `Modulo_Id` = '26';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Mantenimiento' WHERE `Modulo_Id` = '27';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Mantenimiento' WHERE `Modulo_Id` = '28';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Mantenimiento' WHERE `Modulo_Id` = '29';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Ajustes' WHERE `Modulo_Id` = '30'; 
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Mantenimiento' WHERE `Modulo_Id` = '31';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Mantenimiento' WHERE `Modulo_Id` = '32';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '33';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '34';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '35';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Operaciones' WHERE `Modulo_Id` = '36';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Mantenimiento' WHERE `Modulo_Id` = '37';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Mantenimiento' WHERE `Modulo_Id` = '38';
UPDATE `BDLIMABUS`.`Modulo` SET `mod_plegable` = 'Mantenimiento' WHERE `Modulo_Id` = '39';

INSERT INTO `BDLIMABUS`.`Modulo`
(`Mod_Nombre`,
`Mod_NombreVista`,
`Mod_Icono`,
`mod_plegable`)
VALUES
('Plegable Ajustes','Ajustes','<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">   <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"></path> </svg>','Ajustes'),
('Plegable Operaciones','Operaciones','<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">   <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/> </svg>','Operaciones'),
('Plegable Mantenimiento','Mantenimiento','<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">   <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3c0-.269-.035-.53-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814L1 0Zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708ZM3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026L3 11Z"></path> </svg>','Mantenimiento');
