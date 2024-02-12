<?php 

require_once 'conexion/conexion.class.php';
require_once 'respuestas.class.php';

class auth extends conexion{
    
    public function login($json){
        $_respuestas = new respuestas;
        $datos = json_decode($json,true);
        if(!isset($datos['usuario']) || !isset($datos["password"])){
            // ERROR CON LOS CAMPOS
            return $_respuestas->error_400();
        }else{
            // TODO ESTA BIEN
            $usuario = $datos['usuario'];
            $password = $datos['password'];
            $password = parent::encriptar($password);
            $datos = $this->obtener_datos_usuario($usuario);
            if($datos){
                // VERIRIFICAR SI LA CONTRASEÑA ES IGUAL
                if($password == $datos[0]['Usua_Password']){
                    if($datos[0]['Usua_Estado'] == "ACTIVO"){
                        // CREAR TOKEN
                        $verificar  = $this->insertar_token($datos[0]['Usuario_Id']);
                        if($verificar){
                            // SI SE GUARDO
                            $result = $_respuestas->response;
                            $result["result"] = array( "token" => $verificar );
                            return $result;
                        }else{
                            // ERROR AL GUARDAR
                            return $_respuestas->error_500("Error interno, No hemos podido guardar");
                        }
                    }else{
                        // EL USUARIO ESTA INACTIVO
                        return $_respuestas->error_200("El usuario esta inactivo");
                    }
                }else{
                    // LA CONTRASEÑA NO ES IGUAL
                    return $_respuestas->error_200("El password es invalido");
                }
            }else{
                // NO EXISTE EL USUARIO
                return $_respuestas->error_200("El usuario ".$usuario."  no existe ");
            }
        }
    }
    
    private function obtener_datos_usuario($correo){
        $query = " SELECT `Usuario_Id`,`Usua_Password`,`Usua_Estado` FROM `usuario` WHERE `Usua_UsuarioWeb` = '$correo'";
        $datos = parent::obtener_datos($query);
        if(isset($datos[0]["Usuario_Id"])){
            return $datos;
        }else{
            return 0;
        }
    }
    
    private function insertar_token($usuario_id){
        $val = true;
        $token = bin2hex(openssl_random_pseudo_bytes(16,$val));
        $date = date("Y-m-d H:i");
        $estado = "ACTIVO";
        $query = "INSERT INTO `glo_usuario_token` (`utok_usuario_id`,`utok_token`,`utok_estado`,`utok_fecha`) VALUES ('$usuario_id','$token','$estado','$date')";
        $verifica = parent::non_query($query);
        if($verifica){
            return $token;
        }else{
            return 0;
        }
    }
        
}

?>