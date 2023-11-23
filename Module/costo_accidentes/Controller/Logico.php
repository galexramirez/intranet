<?php
session_start();
class Logico
{
    var $Modulo="costo_accidentes";

    // 1.0 CARGA PANTALLA PRINCIPAL DEL MODULO
    public function Contenido($NombreDeModuloVista)
    {
        MView($this->Modulo, 'local_view', compact('NombreDeModuloVista'));
    }
    
    //::::::::::::::::::::::::::::::::::::::::: COSTO ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::://

    public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function buscar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$rpta_buscar_dato = "";
        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->buscar_dato($nombre_tabla, $campo_buscar, $condicion_where);

        foreach ($Respuesta as $row) {
			$rpta_buscar_dato = $row[$campo_buscar];
		}
		echo $rpta_buscar_dato;
	}

	public function CalculoFecha($inicio,$calculo)
    {
        $rptaFecha = "";
        switch ($inicio)
        {
            case "hoy":
                if($calculo=="0"){
                    $rptaFecha = date("Y-m-d");
                }
                if(strlen($calculo)>0 && $calculo!="0"){
                    $f = strtotime($calculo);
                    $rptaFecha = date("Y-m-d",$f);
                }
            break;
        }
        echo $rptaFecha;
    }

    public function DiferenciaFecha($inicio,$final,$dias)
    {
        $rpta_Diferencia = "NO";
        $firstDate  = new DateTime($inicio);
        $secondDate = new DateTime($final);
        $intvl = $firstDate->diff($secondDate);
        
        if($intvl->days < $dias){
            $rpta_Diferencia = "SI";
        }
        echo $rpta_Diferencia;
    }
    
    function DocumentRoot()
    {
        $miCarpeta  = '';
        $miHost     = $_SERVER['HTTP_HOST'];
        $miReferer  = $_SERVER['HTTP_REFERER'];
        $miCarpeta  = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
    }

    function buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo, $nombre_archivo)
    {
        $b64_file       = "";
        $b64_file_name  = "";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD;
        $Respuesta      = $InstanciaAjax->buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo);

        foreach($Respuesta as $row){
            $b64_file = $row['b64_file'];
        }

        if($b64_file!=""){
            $mi_carpeta     = $_SERVER['DOCUMENT_ROOT']."/Services/pdf";
            $date           = date('d-m-Y-'.substr((string)microtime(), 1, 8));
            $date           = str_replace(".", "", $date);
            $b64_file_name  = $nombre_archivo."_v".$date.".pdf";
            $b64_file       = base64_decode($b64_file,true);
            file_put_contents($mi_carpeta."/".$b64_file_name, $b64_file);        
        }

        echo $b64_file_name;
    }

    function unlink_pdf($archivo){
        $rpta_unlink_pdf = "ELIMINADO";
        $mi_carpeta  = $_SERVER['DOCUMENT_ROOT']."/Services/pdf";
        
        unlink($mi_carpeta.'/'.$archivo);
        
        if(file_exists($mi_carpeta.'/'.$archivo)){
            $rpta_unlink_pdf = "NO ELIMINADO";
        }
        
        echo $rpta_unlink_pdf;
    }
}