<?php 
    class C_ConexionesBD{
    
    public static function Conectar() 
    {        
        $servidor   = 'localhost';
        $nombre_bd  = 'BDLIMABUS';
        $usuario    = 'intranetdb';
        $password   = '56dh$*23rtDEif';					        
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
        $servidor   = 'localhost';
        $nombre_bd  = 'bdlimabus_hist';
        $usuario    = 'intranetdb';
        $password   = '56dh$*23rtDEif';					        

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
