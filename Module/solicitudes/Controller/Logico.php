<?php
class Logico
{
	var $Modulo = "solicitudes";

	function Contenido($NombreDeModuloVista)    
	{		
		MView($this->Modulo,'local_view',compact('NombreDeModuloVista') );
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
                if($calculo=="0h"){
                    $rptaFecha = date("Y-m-d H:i:s");
                }
                if(strlen($calculo)>0 && $calculo!="0" && $calculo!="0h"){
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

	public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

	function DocumentRoot()
    {
        $miCarpeta = '';
        $miHost = $_SERVER['HTTP_HOST'];
        $miReferer = $_SERVER['HTTP_REFERER'];
        $miCarpeta = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
    }

	public function descargar_solicitudes($fecha_inicio, $fecha_termino)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->descargar_solicitudes($fecha_inicio, $fecha_termino);

        $micarpeta      = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date           = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date           = str_replace(".", "", $date);
        $filename       = "Solicitudes".$ib_Tipo."_".$date;
        $file_json      = $filename.".json";
        $data           = json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);
        
        echo $filename;
    }

	public function select_roles($roles_perfil, $roles_campo)
	{
		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax  = new CRUD();
		$Respuesta      = $InstanciaAjax->select_roles($roles_perfil, $roles_campo);

		$html = '<option value="">Seleccione una opcion</option>';

		foreach ($Respuesta as $row) {
			$html .= '<option value="'.$row['nombres'].'">'.$row['nombres'].'</option>';
		}
		echo $html;
	}

    public function permisos($objeto)
	{
        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax  = new CRUD();
		$Respuesta      = $InstanciaAjax->permisos($this->Modulo, $objeto);

        echo $Respuesta;
	}

    public function SelectTipos($operacion, $tipo)
	{
		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax  = new CRUD();
		$Respuesta      = $InstanciaAjax->SelectTipos($operacion, $tipo);

		$html = '<option value="">Seleccione una opcion</option>';

		foreach ($Respuesta as $row) {
			$html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
		}
		echo $html;
	}

    public function leer_solicitudes($fecha_inicio, $fecha_termino){
        $t_where_solo_solicitudes = "";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax 	= new CRUD();
        $Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_solo_solicitudes");
        if ($Respuesta=="SI"){
            $t_where_solo_solicitudes = " AND `soli_tipo` != 'CARTAS' ";
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax 	= new CRUD();
        $Respuesta		= $InstanciaAjax->leer_solicitudes($fecha_inicio, $fecha_termino, $t_where_solo_solicitudes);
    }

    public function leer_solicitudes_activas($fecha_inicio, $fecha_termino){
        $t_where_solo_solicitudes = "";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax 	= new CRUD();
        $Respuesta		= $InstanciaAjax->Permisos($this->Modulo,"btn_solo_solicitudes");
        if ($Respuesta=="SI"){
            $t_where_solo_solicitudes = " AND `soli_tipo` != 'CARTAS' ";
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax 	= new CRUD();
        $Respuesta		= $InstanciaAjax->leer_solicitudes_activas($fecha_inicio, $fecha_termino, $t_where_solo_solicitudes);
    }

    public function validacion_solicitudes($fecha_ingreso, $fecha_recepcion, $fecha_inicio, $dni){
        $rpta_validacion_solicitudes    = "";
        $dia_anticipacion               = "";
        $dia_operaciones                = "";
        $nro_solicitudes_anio           = "";

        if($fecha_inicio!="" && $fecha_recepcion!=""){
            $first_date         = new DateTime($fecha_inicio);
            $second_date        = new DateTime($fecha_recepcion);
            $intvl              = $first_date->diff($second_date);
            $dia_anticipacion   = $intvl->days;
        }

        if($fecha_ingreso!="" && $fecha_recepcion!=""){
            $fecha_ingreso      = substr($fecha_ingreso,0,10);
            $first_date         = new DateTime($fecha_ingreso);
            $second_date        = new DateTime($fecha_recepcion);
            $intvl              = $first_date->diff($second_date);    
            $dia_operaciones    = $intvl->days;
        }

        if($dni!="" && $fecha_inicio!=""){
            $fecha_inicio_anio  = date("Y-m-d",strtotime($fecha_inicio."-1 year"));
            $fecha_fin_anio     = $fecha_inicio;

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->solicitudes_anio($dni, $fecha_inicio_anio, $fecha_fin_anio);

            foreach($Respuesta as $row){
                $nro_solicitudes_anio = $row['nro_solicitudes_anio'];
            }

        }

        $rpta_validacion_solicitudes = '<strong>Anticipación: '.$dia_anticipacion.'d | En Operaciones: '.$dia_operaciones.'d | Solicitudes al Año: '.$nro_solicitudes_anio.'</strong>';
        echo $rpta_validacion_solicitudes;
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