<?php 
    class C_ConexionesBD{
    
    public static function Conectar() 
    {
        $lista_datos = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT']."/". ".env"),true);
        foreach ($lista_datos as $key => $value) {
            $servidor = $value['server_1'];
            $usuario = $value['user_1'];
            $password = $value['password_1'];
            $nombre_bd = $value['database_1'];
            $puerto = $value['port_1'];
        }
        $opciones   = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
        try
            {
                $conexion = new PDO("mysql:host=".$servidor."; dbname=".$nombre_bd, $usuario, $password, $opciones);			
                return $conexion;
            }
        catch(Exception $e)
            {
                die("El error de Conexión es: ". $e->getMessage());
            }
    }

    public static function conectar2() 
    {        
        $lista_datos = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT']."/". ".env"),true);
        foreach ($lista_datos as $key => $value) {
            $servidor = $value['server_2'];
            $usuario = $value['user_2'];
            $password = $value['password_2'];
            $nombre_bd = $value['database_2'];
            $puerto = $value['port_2'];
        }
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
        try
            {
                $conexion = new PDO("mysql:host=".$servidor."; dbname=".$nombre_bd, $usuario, $password, $opciones);			
                return $conexion;
            }
        catch(Exception $e)
            {
                die("El error de Conexión es: ". $e->getMessage());
            }
    }

}
