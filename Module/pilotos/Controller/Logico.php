<?php
session_start();

class Logico
{
	var $Modulo = "pilotos";

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

    public function marcacion($lat, $long)
    {
        $Colaborador_id = $_SESSION['USUARIO_ID'];
        $marc_fecha_operacion = date("Y-m-d");
        $marc_hora_operacion = date("H:i:s");
        $marc_lugar_exacto = "Ubicación de Marcación NO Permitida";
        $marc_estado = "No Valida";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD('colaborador','Colaborador_id',$Colaborador_id);
        foreach ($Respuesta as $row) {
            $marc_dni = $row['Colaborador_id'];
            $marc_nombre_colaborador = $row['Colab_ApellidosNombres'];
            $marc_codigo_colaborador = $row['Colab_CodigoCortoPT'];
        }
        #1.........2.........3
        #.                   .
        #4                   5
        #.                   .
        #6.........7.........8

        #3...5...8
        #.       .
        #.       .
        #.       .
        #2       7
        #.       .
        #.       .
        #.       .
        #1...4...6

        #Coordenas Casa Surco        
        $lat1 = -12.160627;
        $lat2 = -12.160207;
        $lat3 = -12.159593;
        $lat4 = -12.160432;
        $lat5 = -12.159032;;
        $lat6 = -12.161004;
        $lat7 = -12.160419;
        $lat8 = -12.160010;
        $long1 = -76.993691;
        $long2 = -76.993184;
        $long3 = -76.992433;
        $long4 = -76.993987;
        $long5 = -76.992495;
        $long6 = -73.993018;
        $long7 = -76.992680;
        $long8 = -76.992310;

        if ($lat1 < $lat && $lat2 > $lat && $lat3 > $lat && $lat4 < $lat && $lat5 > $lat && $lat6 < $lat && $lat7 < $lat && $lat8 > $lat) {
            if ($long1 < $long && $long2 < $long && $long3 > $long && $long4 < $long && $long5 > $long && $long6 > $long && $long7 > $long && $long8 > $long) {
                $marc_lugar_exacto = "Casa Surco";
                $marc_estado = "Valida";
            }
        }

        #Coordenas Patio Norte        
        $lat1 = -11.921394834715267;
        $lat2 = -11.918754716843369;
        $lat3 = -11.915988601563201;
        $lat4 = -11.921793736965904;
        $lat5 = -11.916324525980418;
        $lat6 = -11.922029928808827;
        $lat7 = -11.91882295081099;
        $lat8 = -11.916628957087257;
        $long1 = -77.0474710133779;
        $long2 = -77.04683801208336;
        $long3 = -77.0466395286099;
        $long4 = -77.04696139365838;
        $long5 = -77.04599043401686;
        $long6 = -77.04643031625976;
        $long7 = -77.0458616879673;
        $long8 = -77.04541644125625;

        if (($lat1 < $lat) && ($lat2 > $lat) && ($lat3 > $lat) && ($lat4 < $lat) && ($lat5 > $lat) && ($lat6 < $lat) && ($lat7 < $lat) && ($lat8 > $lat)) {
            if (($long1 < $long) && ($long2 < $long) && ($long3 > $long) && ($long4 < $long) && ($long5 > $long) && ($long6 > $long) && ($long7 > $long) && ($long8 > $long)) {
                $marc_lugar_exacto = "Patio Norte";
                $marc_estado = "Valida";
            }
        }

        #Coordenas Estación Naranjal        
        $lat1 = -11.980055959430675;
        $lat2 = -11.981744802905412;
        $lat3 = -11.980522121523368;
        $lat4 = -11.980461774445775;
        $lat5 = -11.981652531087951;
        $lat6 = -11.98290713220871;
        $lat7 = -11.981671337230736;
        $lat8 = -11.980406674928368;
        $long1 = -77.05943114026195;
        $long2 = -77.0590878946353;
        $long3 = -77.05936952657233;
        $long4 = -77.05913885661067;
        $long5 = -77.05861507818088;
        $long6 = -77.05830737185475;
        $long7 = -77.0586024148323;
        $long8 = -77.05888404676932;

        if ($lat1 < $lat && $lat2 > $lat && $lat3 > $lat && $lat4 < $lat && $lat5 > $lat && $lat6 < $lat && $lat7 < $lat && $lat8 > $lat) {
            if ($long1 < $long && $long2 < $long && $long3 > $long && $long4 < $long && $long5 > $long && $long6 > $long && $long7 > $long && $long8 > $long) {
                $marc_lugar_exacto = "Estación Naranjal";
                $marc_estado = "Valida";
            }
        }

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->marcacion($lat,$long,$marc_dni,$marc_nombre_colaborador,$marc_codigo_colaborador,$marc_fecha_operacion,$marc_hora_operacion,$marc_lugar_exacto, $marc_estado);

        $html ='<h4>' . $marc_nombre_colaborador . '</h4>
                <span class="item" >Fecha y Hora : </span>' . $marc_fecha_operacion . '  ' . $marc_hora_operacion . '<br>
                <span class="item" >Ubicación :    </span>' . $marc_lugar_exacto . '<br>
                <span class="item" >Coordenadas :  </span>' . $lat . ' , ' . $long . '<br>
                <span class="item" >Estado :    </span>' . $marc_estado . '<br>';
        echo $html;
    }

    public function borrar_publicacion($comunicado_id, $comu_archivo)
    {
		$rpta_delete = True;
		$file_imagen = $_SERVER['DOCUMENT_ROOT']."/Services/image/comunicados/".$comu_archivo;
		if(unlink($file_imagen)){
			MModel($this->Modulo,'CRUD');
			$InstanciaAjax  = new CRUD();
			$Respuesta = $InstanciaAjax->borrar_publicacion($comunicado_id);
	
			print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);	
		}else{
			$rpta_delete = False;
		}
		return $rpta_delete;
    }

	public function crear_publicacion($comunicado_id, $comu_titulo, $comu_fecha_inicio, $comu_fecha_fin, $comu_proceso, $comu_destacado, $nombre_imagen, $comu_archivo)
	{
		$comu_estado = "ACTIVO";
		$imagen_nueva = $_SERVER['DOCUMENT_ROOT']."/Services/image/comunicados/".$nombre_imagen;
		if(move_uploaded_file($comu_archivo, $imagen_nueva)){
			MModel($this->Modulo,'CRUD');
        	$InstanciaAjax  = new CRUD();
        	$Respuesta = $InstanciaAjax->crear_publicacion($comu_titulo, $comu_fecha_inicio, $comu_fecha_fin, $comu_proceso, $comu_destacado, $nombre_imagen, $comu_estado);
			print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
		}else{
			echo "err1";
		}
	}

}