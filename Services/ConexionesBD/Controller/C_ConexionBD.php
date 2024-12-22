<?php 
    class C_ConexionesBD{
    
    public static function Conectar() 
    {
        $lista_datos = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT']."/". ".env"),true);
        foreach ($lista_datos as $key => $value) {
            $servidor = $value['SERVER_1'];
            $usuario = $value['USER_1'];
            $password = $value['PASSWORD_1'];
            $nombre_bd = $value['DATABASE_1'];
            $puerto = $value['PORT_1'];
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
            $servidor = $value['SERVER_2'];
            $usuario = $value['USER_2'];
            $password = $value['PASSWORD_2'];
            $nombre_bd = $value['DATABASE_2'];
            $puerto = $value['PORT_2'];
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
