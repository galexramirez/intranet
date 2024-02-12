<?php 

require_once "conexion/conexion.class.php";
require_once "respuestas.class.php";

class ot extends conexion {

    private $table = "manto_ots";
    private $ot_id = "";
    private $dni = "";
    private $nombre = "";
    private $direccion = "";
    private $codigoPostal = "";
    private $genero = "";
    private $telefono = "";
    private $fechaNacimiento = "0000-00-00";
    private $correo = "";
    private $token = "";
//912bc00f049ac8464472020c5cd06759

    public function lista_ot($pagina = 1){
        $inicio  = 0 ;
        $cantidad = 100;
        if($pagina > 1){
            $inicio = ($cantidad * ($pagina - 1)) +1 ;
            $cantidad = $cantidad * $pagina;
        }
        $query = "  SELECT 
                        CONCAT_WS('-',SUBSTRING(`ot_tipo`,1,1),SUBSTRING(CONCAT('00000000',`ot_id`),-8)) AS `ot_id`, 
                        `ot_estado`, 
                        DATE_FORMAT(`ot_fecha_registro`,'%Y-%m-%d %H:%i') AS `ot_fecha`, 
                        `colaborador`.`Colab_nombre_corto` AS `ot_cgm_genera`, 
                        `ot_bus`, 
                        `ot_origen`, 
                        `ot_nombre_proveedor` AS `ot_proveedor`, 
                        `ot_actividad`, 
                        `ot_kilometraje`,
                        IF(`tvale`.`nvale`>'0',SUBSTRING(CONCAT('00',`tvale`.`nvale`),-2),'') AS `ot_vales`
                    FROM " . $this->table . "
                    LEFT JOIN 
                        (SELECT `manto_vale`.`va_ot_id`, COUNT(*) AS `nvale` FROM `manto_vale` GROUP BY `manto_vale`.`va_ot_id`) AS `tvale` 
                    ON 
                        `tvale`.`va_ot_id`=`manto_ots`.`ot_id`
                    LEFT JOIN
                        `colaborador`
                    ON 
                        `colaborador`.`Colaborador_id`=`manto_ots`.`ot_cgm_id` 
                    LIMIT 
                    $inicio, $cantidad ";
        $datos = parent::obtener_datos($query);
        return ($datos);
    }

    public function obtener_ot($ot_id){
        $query = "SELECT * FROM " . $this->table . " WHERE `ot_id` = '$ot_id'";
        return parent::obtener_datos($query);
    }
    


}


?>