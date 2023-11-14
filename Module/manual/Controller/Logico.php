<?php
session_start();
class Logico
{
	var $Modulo="manual";

	public function Contenido($NombreDeModuloVista)    
	{		
		MView($this->Modulo,'local_view',compact('NombreDeModuloVista') );
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

    public function select_combo($nombre_tabla, $es_campo_unico, $campo_select, $campo_inicial, $condicion_where)
	{
		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->select_combo($nombre_tabla, $es_campo_unico, $campo_select, $condicion_where);

		$html = '<option value="">Seleccione una opcion</option>';
		
		if($campo_inicial!=""){
            $html .= "<option value='".$campo_inicial."'>".$campo_inicial."</option>";
		}

		foreach ($Respuesta as $row) {
			if($row['detalle']!=$campo_inicial){
                $html .= "<option value='".$row['detalle']."'>".$row['detalle']."</option>";
			}
		}
		echo $html;
	}

    public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function buscar_data_bd($tabla, $c_where)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->buscar_data_bd($tabla, $c_where);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
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
            
            //default: ;
        }
        echo $rptaFecha;
    }

    public function CompararFechaActual($fecha)
    {
        $rptaComparar = "";
        $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
        $fecha_entrada = strtotime($fecha);
            
        if($fecha_actual > $fecha_entrada){
            $rptaComparar = "MAYOR";
        }else{
            $rptaComparar = "MENOR IGUAL";
        }
        echo $rptaComparar;
    }

    public function DiferenciaFecha($inicio,$final)
    {
        $rpta_Diferencia = "NO";
        $firstDate  = new DateTime($inicio);
        $secondDate = new DateTime($final);
        $intvl = $firstDate->diff($secondDate);
        
        if($intvl->days < "366"){
            $rpta_Diferencia = "SI";
        }
        echo $rpta_Diferencia;
    }

    public function dias_diferencia_fechas($inicio,$final)
    {
        $rpta_dias = "";
        $firstDate  = new DateTime($inicio);
        $secondDate = new DateTime($final);
        $intvl = $firstDate->diff($secondDate);
        $rpta_dias = $intvl->days;

        echo $rpta_dias;
    }

    public function AutoCompletar($NombreTabla,$NombreCampo, $va_asociado, $va_date_genera, $va_tipo)
    {
        $rpta_autocompletar = [];
        $va_ruc             = "";
        $TablaBD            = "manto_proveedores";
        $CampoBD            = "prov_razonsocial";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_asociado);
        foreach ($Respuesta as $row) {
            $va_ruc = $row['prov_ruc'];
        }

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo, $va_ruc, $va_date_genera, $va_tipo);
        foreach ($Respuesta as $row) {
            $rpta_autocompletar[] = ["value" => $row[$NombreCampo], "label" => "<strong>".$row[$NombreCampo]."</strong> ".$row['precioprov_descripcion']];
        }
		echo json_encode($rpta_autocompletar);
    }

    public function DocumentRoot()
    {
        $mi_carpeta = '';
        $mi_host    = $_SERVER['HTTP_HOST'];
        $mi_referer = $_SERVER['HTTP_REFERER'];
        $mi_carpeta = substr($mi_referer,0,strpos($mi_referer,$mi_host)).$mi_host.'/';
        echo $mi_carpeta;
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

    public function contar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$rpta_contar_dato = "";
        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax = new CRUD();
		$Respuesta = $InstanciaAjax->contar_dato($nombre_tabla, $campo_buscar, $condicion_where);

        foreach ($Respuesta as $row) {
			$rpta_contar_dato = $row['cantidad'];
		}
		echo $rpta_contar_dato;
	}


}