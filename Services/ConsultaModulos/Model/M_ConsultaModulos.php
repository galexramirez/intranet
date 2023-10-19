<?php
class Modulos_m 
	{	
	var $cnx;
	var $sql;
	var $rpta;
	var $cant;
	var $fila=array();

	function __construct()
		{
        SController('ConexionesBD','C_ConexionBD');
        $Instancia= new C_ConexionesBD();
        $this->cnx=$Instancia->Conectar(); 	
        }

	/// F. PARA VALIDAR INGRESO DE USUARIOS/ USUARIO, CONTRASEÑA / VALOS O NO VALISA
	function ModulosPorUsuario()
		{
            //$this->consulta="SELECT  Mod_Nombre,Mod_NombreVista,Mod_Icono,PER_ModInicio FROM Permisos LEFT JOIN Modulo ON PER_ModuloId= Modulo_Id  WHERE PER_UsuarioId='".$_SESSION['USUARIO_ID']."' ORDER BY Mod_NombreVista ";

            $this->consulta = " SELECT 
                                    `Modulo`.`Mod_Nombre`,
                                    `Modulo`.`Mod_NombreVista`,
                                    `Modulo`.`Mod_Icono`,
                                    `Modulo`.`mod_tipo`,
                                    `Modulo`.`mod_plegable`,
                                    CONCAT(IF(`Modulo`.`mod_plegable`='Ajustes',CONCAT('ZZ',`Modulo`.`mod_plegable`),`Modulo`.`mod_plegable`),`Modulo`.`Mod_NombreVista`) AS `indice`,
                                    `Permisos`.`PER_ModInicio`
                                FROM `Permisos`
                                LEFT JOIN `Modulo`
                                    ON `Permisos`.`PER_ModuloId`=`Modulo`.`Modulo_Id`
                                WHERE `Permisos`.`PER_UsuarioId`='".$_SESSION['USUARIO_ID']."'
                                UNION
                                SELECT 
                                    `Modulo`.`Mod_Nombre`,
                                    `Modulo`.`Mod_NombreVista`,
                                    `Modulo`.`Mod_Icono`,
                                    `Modulo`.`mod_tipo`,
                                    `Modulo`.`Mod_NombreVista` AS `mod_plegable`,
                                    CONCAT(IF(`Modulo`.`Mod_NombreVista`='Ajustes',CONCAT('ZZ',`Modulo`.`Mod_NombreVista`),`Modulo`.`Mod_NombreVista`),CONCAT('0',`Modulo`.`Mod_NombreVista`)) AS `indice`,
                                    'NO' AS `PER_ModInicio`
                                FROM `Modulo`
                                RIGHT JOIN 
                                    (SELECT DISTINCT `Modulo`.`mod_plegable` FROM `Permisos` LEFT JOIN `Modulo` ON  `Permisos`.`PER_ModuloId`=`Modulo`.`Modulo_Id` WHERE `Permisos`.`PER_UsuarioId`='".$_SESSION['USUARIO_ID']."') AS `t1` ON `Modulo`.`Mod_NombreVista`= `t1`.`mod_plegable`
                                WHERE `Modulo`.`mod_tipo`='Plegable'
                                ORDER BY `indice` ";
            

            $this->resultado = $this->cnx->prepare($this->consulta);
            $this->resultado->execute();
            $this->data=$this->resultado->fetchall(PDO::FETCH_ASSOC);
            return $this->data;
        }
    }