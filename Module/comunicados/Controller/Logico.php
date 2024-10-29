<?php
session_start();

class Logico
{
	var $Modulo = "comunicados";

    function Contenido($NombreDeModuloVista)
	{
    	MView($this->Modulo, 'local_view', compact('NombreDeModuloVista'));
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
        $miCarpeta = '';
        $miHost = $_SERVER['HTTP_HOST'];
        $miReferer = $_SERVER['HTTP_REFERER'];
        $miCarpeta = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
    }

    public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

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

    public function auto_completar($NombreTabla,$NombreCampo)
    {
        $rpta_auto_completar = [];

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->auto_completar($NombreTabla,$NombreCampo);
        foreach ($Respuesta as $row) {
                $rpta_auto_completar[] = ["value" => $row[$NombreCampo], "label" => $row[$NombreCampo]];
        }
		echo json_encode($rpta_auto_completar);
    }

    public function usuario_id()
    {
        $usuario_id = $_SESSION['USUARIO_ID'];
        echo $usuario_id;
    }
}