<?php 

require_once "conexion/conexion.class.php";
require_once "respuestas.class.php";

class ot extends conexion {

    private $table = "manto_ots";
    private $ot_id = "";
    private $ot_estado = "";
    private $ot_origen = "";
    private $ot_tipo = "";
    private $ot_bus = "";
    private $ot_ruc_proveedor = "";
    private $ot_nombre_proveedor = "";
    private $ot_cgm_id = "";
    private $ot_fecha_registro = "";
    private $ot_actividad = "";
    private $ot_actividad_vincular = "";
    private $ot_kilometraje = "0";
    private $ot_sistema = "";
    private $ot_ejecucion = "";
    private $ot_obs_proveedor = "";
    private $ot_obs_cgm = "";
    private $ot_log = "";
    private $ot_semana_cierre = "";
    private $dni = "";
    private $nombre = "";
    private $correo = "";
    private $token = "";

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
    
    public function post($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);
        if(!isset($datos['token'])){
                return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $array_token = $this->buscar_token();
            if($array_token){
                if(!isset($datos['nombre']) || !isset($datos['dni']) || !isset($datos['correo'])){
                    return $_respuestas->error_400();
                }else{
                    $this->nombre = $datos['nombre'];
                    $this->dni = $datos['dni'];
                    $this->correo = $datos['correo'];
                    if(isset($datos['ot_estado'])) { $this->ot_estado = $datos['ot_estado']; }
                    if(isset($datos['ot_origen'])) { $this->ot_origen = $datos['ot_origen']; }
                    if(isset($datos['ot_tipo'])) { $this->ot_tipo = $datos['ot_tipo']; }
                    if(isset($datos['ot_bus'])) { $this->ot_bus = $datos['ot_bus']; }
                    if(isset($datos['ot_ruc_proveedor'])) { $this->ot_ruc_proveedor = $datos['ot_ruc_proveedor']; }
                    if(isset($datos['ot_nombre_proveedor'])) { $this->ot_nombre_proveedor = $datos['ot_nombre_proveedor']; }
                    if(isset($datos['ot_cgm_id'])) { $this->ot_cgm_id = $datos['ot_cgm_id']; }
                    if(isset($datos['ot_fecha_registro'])) { $this->ot_fecha_registro = $datos['ot_fecha_registro']; }
                    if(isset($datos['ot_actividad'])) { $this->ot_actividad = $datos['ot_actividad']; }
                    if(isset($datos['ot_actividad_vincular'])) { $this->ot_actividad_vincular = $datos['ot_actividad_vincular']; }
                    if(isset($datos['ot_kilometraje'])) { $this->ot_kilometraje = $datos['ot_kilometraje']; }
                    if(isset($datos['ot_sistema'])) { $this->ot_sistema = $datos['ot_sistema']; }
                    if(isset($datos['ot_ejecucion'])) { $this->ot_ejecucion = $datos['ot_ejecucion']; }
                    if(isset($datos['ot_obs_proveedor'])) { $this->ot_obs_proveedor = $datos['ot_obs_proveedor']; }
                    if(isset($datos['ot_obs_cgm'])) { $this->ot_obs_cgm = $datos['ot_obs_cgm']; }
                    if(isset($datos['ot_log'])) { $this->ot_log = $datos['ot_log']; }
                    if(isset($datos['ot_semana_cierre'])) { $this->ot_semana_cierre = $datos['ot_semana_cierre']; }
                    $resp = $this->insertar_ot();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "ot_id" => $resp
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }
            }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }
    }

    private function insertar_ot(){
        $query = " INSERT INTO " . $this->table . " ( `ot_estado`, `ot_origen`, `ot_tipo`, `ot_bus`, `ot_ruc_proveedor`, `ot_nombre_proveedor`, `ot_cgm_id`, `ot_fecha_registro`, `ot_actividad`, `ot_actividad_vincular`, `ot_kilometraje`, `ot_sistema`, `ot_ejecucion`, `ot_obs_proveedor`, `ot_obs_cgm`, `ot_log`, `ot_semana_cierre` ) VALUES ('" . $this->ot_estado . "','" . $this->ot_origen ."','" . $this->ot_tipo . "','"  . $this->ot_bus . "','" . $this->ot_ruc_proveedor . "','" . $this->ot_nombre_proveedor . "','" . $this->ot_cgm_id . "','" . $this->ot_fecha_registro . "','" . $this->ot_actividad . "','" . $this->ot_actividad_vincular . "','" . $this->ot_kilometraje . "','" . $this->ot_sistema . "','" . $this->ot_ejecucion . "','" . $this->ot_obs_proveedor . "','" . $this->ot_obs_cgm . "','" . $this->ot_log . "','" . $this->ot_semana_cierre . "')";
        $resp = parent::non_query_id($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }
    
    public function put($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);
        if(!isset($datos['token'])){
            return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $array_token =   $this->buscar_token();
            if($array_token){
                if(!isset($datos['ot_id'])){
                    return $_respuestas->error_400();
                }else{
                    $this->ot_id = $datos['ot_id'];
                    if(isset($datos['nombre'])) { $this->nombre = $datos['nombre']; }
                    if(isset($datos['dni'])) { $this->dni = $datos['dni']; }
                    if(isset($datos['correo'])) { $this->correo = $datos['correo']; }
                    if(isset($datos['ot_id'])) { $this->ot_id = $datos['ot_id']; }
                    if(isset($datos['ot_estado'])) { $this->ot_estado = $datos['ot_estado']; }
                    if(isset($datos['ot_origen'])) { $this->ot_origen = $datos['ot_origen']; }
                    if(isset($datos['ot_tipo'])) { $this->ot_tipo = $datos['ot_tipo']; }
                    if(isset($datos['ot_bus'])) { $this->ot_bus = $datos['ot_bus']; }
                    if(isset($datos['ot_ruc_proveedor'])) { $this->ot_ruc_proveedor = $datos['ot_ruc_proveedor']; }
                    if(isset($datos['ot_nombre_proveedor'])) { $this->ot_nombre_proveedor = $datos['ot_nombre_proveedor']; }
                    if(isset($datos['ot_cgm_id'])) { $this->ot_cgm_id = $datos['ot_cgm_id']; }
                    if(isset($datos['ot_fecha_registro'])) { $this->ot_fecha_registro = $datos['ot_fecha_registro']; }
                    if(isset($datos['ot_actividad'])) { $this->ot_actividad = $datos['ot_actividad']; }
                    if(isset($datos['ot_actividad_vincular'])) { $this->ot_actividad_vincular = $datos['ot_actividad_vincular']; }
                    if(isset($datos['ot_kilometraje'])) { $this->ot_kilometraje = $datos['ot_kilometraje']; }
                    if(isset($datos['ot_sistema'])) { $this->ot_sistema = $datos['ot_sistema']; }
                    if(isset($datos['ot_ejecucion'])) { $this->ot_ejecucion = $datos['ot_ejecucion']; }
                    if(isset($datos['ot_obs_proveedor'])) { $this->ot_obs_proveedor = $datos['ot_obs_proveedor']; }
                    if(isset($datos['ot_obs_cgm'])) { $this->ot_obs_cgm = $datos['ot_obs_cgm']; }
                    if(isset($datos['ot_log'])) { $this->ot_log = $datos['ot_log']; }
                    if(isset($datos['ot_semana_cierre'])) { $this->ot_semana_cierre = $datos['ot_semana_cierre']; }
                    $resp = $this->modificar_ot();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "ot_id" => $this->ot_id
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }
            }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }
    }
 
    private function modificar_ot(){
        $query = " UPDATE " . $this->table . " SET `ot_id` ='" . $this->ot_id . "', `ot_estado` = '" . $this->ot_estado . "', `ot_origen` = '" . $this->ot_origen . "', `ot_tipo` = '" .$this->ot_tipo . "', `ot_bus` = '" . $this->ot_bus . "', `ot_ruc_proveedor` = '" . $this->ot_ruc_proveedor . "', `ot_nombre_proveedor` = '" . $this->ot_nombre_proveedor . "', `ot_cgm_id` = '" . $this->ot_cgm_id . "', `ot_fecha_registro` = '" . $this->ot_fecha_registro . "', `ot_actividad` = '" . $this->ot_actividad . "', `ot_actividad_vincular` = '" . $this->ot_actividad_vincular . "', `ot_kilometraje` = '" . $this->ot_kilometraje . "', `ot_sistema` = '" . $this->ot_sistema . "', `ot_ejecucion` = '" . $this->ot_ejecucion . "', `ot_obs_proveedor` = '" . $this->ot_obs_proveedor . "', `ot_obs_cgm` = '" . $this->ot_obs_cgm . "', `ot_log` = '" . $this->ot_log . "', `ot_semana_cierre` = '" . $this->ot_semana_cierre . "' WHERE `ot_id` = '" . $this->ot_id . "'"; 
        $resp = parent::non_query($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }

    public function delete($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);
        if(!isset($datos['token'])){
            return $_respuestas->error_401();
        }else{
            $this->token = $datos['token'];
            $array_token = $this->buscar_token();
            if($array_token){
                if(!isset($datos['ot_id'])){
                    return $_respuestas->error_400();
                }else{
                    $this->ot_id = $datos['ot_id'];
                    $resp = $this->eliminar_ot();
                    if($resp){
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "ot_id" => $this->ot_id
                        );
                        return $respuesta;
                    }else{
                        return $_respuestas->error_500();
                    }
                }
            }else{
                return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
            }
        }
    }

    private function eliminar_ot(){
        $query = "DELETE FROM " . $this->table . " WHERE `ot_id`= '" . $this->ot_id . "'";
        $resp = parent::non_query($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }

    private function buscar_token(){
        $query = " SELECT `usuario_token_id`, `utok_usuario_id`, `utok_estado` from `glo_usuario_token` WHERE `utok_token` = '" . $this->token . "' AND `utok_estado` = 'ACTIVO'";
        $resp = parent::obtener_datos($query);
        if($resp){
            return $resp;
        }else{
            return 0;
        }
    }

    private function actualizar_token($token_id){
        $date = date("Y-m-d H:i");
        $query = " UPDATE `glo_usuario_token` SET `utok_fecha` = '$date' WHERE `utok_token_id` = '$token_id' ";
        $resp = parent::non_query($query);
        if($resp >= 1){
            return $resp;
        }else{
            return 0;
        }
    }

}

?>