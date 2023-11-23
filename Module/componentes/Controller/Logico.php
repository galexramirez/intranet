<?php
session_start();
class Logico
{
	var $Modulo = "componentes";

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
                if(strlen($calculo)>0 && $calculo!="0"){
                    $f = strtotime($calculo);
                    $rptaFecha = date("Y-m-d",$f);
                }
            break;
        }
        echo $rptaFecha;
    }

    public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
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

    public function DocumentRoot()
    {
        $miCarpeta = '';
        $miHost = $_SERVER['HTTP_HOST'];
        $miReferer = $_SERVER['HTTP_REFERER'];
        $miCarpeta = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
    }

    public function select_combo($nombre_tabla, $es_campo_unico, $campo_select, $campo_inicial, $condicion_where, $order_by)
	{
		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->select_combo($nombre_tabla, $es_campo_unico, $campo_select, $condicion_where, $order_by);

		$html = '<option value="">Seleccione una opcion</option>';
		
		if($campo_inicial!=""){
			$html .= '<option value="'.$campo_inicial.'">'.$campo_inicial.'</option>';
		}

		foreach ($Respuesta as $row) {
			if($row['detalle']!=$campo_inicial){
				$html .= '<option value="'.$row['detalle'].'">'.$row['detalle'].'</option>';
			}
		}
		echo $html;
	}

    function genera_codigo_patrimonial($comp_tipo_componente)
    {
        $comp_codigo_patrimonial = "";
        $correlativo = 1;
        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax  = new CRUD();
		$Respuesta      = $InstanciaAjax->correlativo_codigo_patrimonial($comp_tipo_componente);

        foreach ($Respuesta as $row) {
    		$correlativo = intval($row['correlativo']) + 1;
		}

        $comp_codigo_patrimonial = substr($comp_tipo_componente,0,3).'-'.substr('00000'.$correlativo,-5);

        echo $comp_codigo_patrimonial;
    }
}