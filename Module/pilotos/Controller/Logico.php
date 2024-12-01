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
        $marc_fecha_operacion = date("Y-m-d H:i:s");
        $marc_lugar_exacto = "Ubicación de Marcación NO Permitida";
        $marc_estado = "No Valida";
        $html = "";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD('colaborador','Colaborador_id',$Colaborador_id);
        foreach ($Respuesta as $row) {
            $marc_dni = $row['Colaborador_id'];
            $marc_nombre_colaborador = $row['Colab_ApellidosNombres'];
            $marc_codigo_colaborador = $row['Colab_CodigoCortoPT'];
        }

        #1.......2
        #.       .
        #.       .
        #.       .
        #.       .
        #.       .
        #.       .
        #.       .
        #3.......4

        #Coordenas Casa Surco        
        $lat1 = -12.1595742430295;
        $lat2 = -12.159936997737;
        $lat3 = -12.1606295280957;
        $lat4 = -12.1610346810639;
        $long1 = -76.9924230077935;
        $long2 = -76.9921483120487;
        $long3 = -76.9937097405501;
        $long4 = -76.9930157723528;

        if($lat1 > $lat && $lat2 > $lat && $lat3 < $lat && $lat4 < $lat && $long1 > $long && $long2 > $long && $long3 < $long && $long4 > $long){
            $marc_lugar_exacto = "Casa Surco";
            $marc_estado = "Valida";
        }

        #Coordenas Patio Norte        
        $lat1 = -11.9157720329169;
        $lat2 = -11.9161192141405;
        $lat3 = -11.9220213824317;
        $lat4 = -11.9220368917796;
        $long1 = -77.0470824790299;
        $long2 = -77.0453118401244;
        $long3 = -77.0476863208938;
        $long4 = -77.0454707046195;

        if (($lat1 > $lat) && ($lat2 > $lat) && ($lat3 < $lat) && ($lat4 < $lat) && ($long1 < $long) && ($long2 > $long) && ($long3 < $long) && ($long4 > $long) ) {
            $marc_lugar_exacto = "Patio Norte";
            $marc_estado = "Valida";
        }

        #Coordenas Oficina Patio Norte        
        $lat1 = -11.9162656842965;
        $lat2 = -11.9162722453176;
        $lat3 = -11.9163831265493;
        $lat4 = -11.9163982168909;
        $long1 = -77.0465767356311;
        $long2 = -77.0463769110572;
        $long3 = -77.0465727123175;
        $long4 = -77.046378922714;

        if (($lat1 > $lat) && ($lat2 > $lat) && ($lat3 < $lat) && ($lat4 < $lat) && ($long1 < $long) && ($long2 > $long) && ($long3 < $long) && ($long4 > $long) ) {
            $marc_lugar_exacto = "Oficina Patio Norte";
            $marc_estado = "Valida";
        }

        #Coordenas Oficina Despacho Flota Patio Norte
        $lat1 = -11.9212628695617;
        $lat2 = -11.9212721480758;
        $lat3 = -11.9213714281567;
        $lat4 = -11.9213872016241;
        $long1 = -77.0474894964805;
        $long2 = -77.0473358712159;
        $long3 = -77.0474487194041;
        $long4 = -77.0473377678241;

        if (($lat1 > $lat) && ($lat2 > $lat) && ($lat3 < $lat) && ($lat4 < $lat) && ($long1 < $long) && ($long2 > $long) && ($long3 < $long) && ($long4 > $long) ) {
            $marc_lugar_exacto = "Despacho Patio Norte";
            $marc_estado = "Valida";
        }

        #Coordenas Estación Naranjal
        $lat1 = -11.9798459564829;
        $lat2 = -11.9797688765794;
        $lat3 = -11.9830575995716;
        $lat4 = -11.9829419810833;
        $long1 = -77.0595639872281;
        $long2 = -77.0584739756305;
        $long3 = -77.0593801298502;
        $long4 = -77.0581325262143;

        if (($lat1 > $lat) && ($lat2 > $lat) && ($lat3 < $lat) && ($lat4 < $lat) && ($long1 < $long) && ($long2 > $long) && ($long3 < $long) && ($long4 > $long) ) {
            $marc_lugar_exacto = "Estación Naranjal";
            $marc_estado = "Valida";
        }

        #Coordenas Relevo en Estacion Naranjal
        $lat1 = -11.980565009559998;
        $lat2 = -11.98055845009674;
        #$lat3 = ;
        #$lat4 = ;
        $long1 = -77.05931858744312;
        $long2 = -77.05917777147602;
        #$long3 = ;
        #$long4 = ;

        if (($lat1 > $lat) && ($lat2 > $lat) && ($lat3 < $lat) && ($lat4 < $lat) && ($long1 < $long) && ($long2 > $long) && ($long3 < $long) && ($long4 > $long) ) {
            $marc_lugar_exacto = "Relevo en Estación Naranjal";
            $marc_estado = "Valida";
        }

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->marcacion($lat,$long,$marc_dni,$marc_nombre_colaborador,$marc_codigo_colaborador,$marc_fecha_operacion,$marc_lugar_exacto, $marc_estado);
        
        $html ='<h4>' . $marc_nombre_colaborador . '</h4>
                <span class="item" >Fecha y Hora : </span>' . $marc_fecha_operacion . '<br>
                <span class="item" >Ubicación :    </span>' . $marc_lugar_exacto . '<br>
                <span class="item" >Estado :    </span>' . $marc_estado . '<br>';
        echo $html;
    }

    public function borrar_publicacion($comunicado_id, $comu_imagen, $comu_pdf)
    {
		$rpta_delete = True;
        if($comu_pdf!=""){
            $file_pdf = $_SERVER['DOCUMENT_ROOT']."/Services/files/pdf/comunicados/".$comu_pdf;
            if(unlink($file_pdf)){

            }else{
                $rpta_delete = False;
            }
        }
        if($rpta_delete){
            $file_imagen = $_SERVER['DOCUMENT_ROOT']."/Services/files/image/comunicados/".$comu_imagen;
            if(unlink($file_imagen)){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax  = new CRUD();
                $Respuesta = $InstanciaAjax->borrar_publicacion($comunicado_id);
        
                print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);	
            }else{
                $rpta_delete = False;
            }    
        }
		return $rpta_delete;
    }

	public function crear_publicacion($comu_titulo, $comu_fecha_inicio, $comu_fecha_fin, $comu_categoria, $comu_destacado, $nombre_imagen, $comu_imagen, $nombre_pdf, $comu_pdf, $comu_video, $comu_link)
	{
		$comu_estado = "ACTIVO";
        $pdf_ok = True;
        if($nombre_pdf!=""){
            $pdf_nuevo = $_SERVER['DOCUMENT_ROOT']."/Services/files/pdf/comunicados/".$nombre_pdf;
            if(move_uploaded_file($comu_pdf, $pdf_nuevo)){
                
            }else{
                $pdf_ok = False;
            }
        }
		$imagen_nueva = $_SERVER['DOCUMENT_ROOT']."/Services/files/image/comunicados/".$nombre_imagen;
		if(move_uploaded_file($comu_imagen, $imagen_nueva)){
            if($pdf_ok){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax  = new CRUD();
                $Respuesta = $InstanciaAjax->crear_publicacion($comu_titulo, $comu_fecha_inicio, $comu_fecha_fin, $comu_categoria, $comu_destacado, $nombre_imagen, $comu_estado, $nombre_pdf, $comu_video, $comu_link);
                print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);    
            }else{
                echo "err2";
            }
		}else{
			echo "err1";
		}
	}

    public function cargar_desempeno_piloto()
    {
        $html = '';
        $colaborador_id = $_SESSION['USUARIO_ID'];
        $fecha_hoy = date("Y-m-d");
        $acci_responsabilidad = "DIRECTA";
        $estado_comportamiento = "CIERRE OPERACIONAL";
        $estado_ausencia = "CIERRE OPERACIONAL";
        $icon_card_list = '<i class="bi bi-card-list"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16"><path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/><path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/></svg></i>';

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->buscar_dato('glo_periodo', 'periodo_id', "`peri_fecha_inicio` <= '".$fecha_hoy."' AND `peri_fecha_termino` >= '".$fecha_hoy."'");
        foreach ($Respuesta as $row) {
			$periodo_id = $row['periodo_id'];
		}
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD('glo_periodo', 'periodo_id', $periodo_id);
        foreach ($Respuesta as $row) {
            $mes_actual = $row['peri_mes'];
            $fecha_inicio_actual = $row['peri_fecha_inicio'];
            $fecha_termino_actual = $row['peri_fecha_termino'];
            $peri_fecha_inicio_actual = $row['peri_fecha_inicio'];
        }
        $peri_fecha_termino_anterior = date("Y-m-d",strtotime($peri_fecha_inicio_actual."- 1 days"));
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->buscar_dato('glo_periodo', 'periodo_id', "`peri_fecha_inicio` <= '".$peri_fecha_termino_anterior."' AND `peri_fecha_termino` >= '".$peri_fecha_termino_anterior."'");
        foreach ($Respuesta as $row) {
			$periodo_id = $row['periodo_id'];
		}
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD('glo_periodo', 'periodo_id', $periodo_id);
        foreach ($Respuesta as $row) {
            $mes_anterior = $row['peri_mes'];
            $fecha_inicio_anterior = $row['peri_fecha_inicio'];
            $fecha_termino_anterior = $row['peri_fecha_termino'];
        }
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->accidentes_piloto($colaborador_id, $fecha_inicio_anterior, $fecha_termino_anterior, $acci_responsabilidad);
        $accidentes_anterior = "";
        foreach ($Respuesta as $row) {
            $accidentes_anterior .= '<p><button id="' . $row['Accidentabilidad_id'] . '" class="btn btn-outline btn_accidente" data-toggle="modal" data-target="#modal_accidentabilidad" type="button" style="padding: 0px; border:0px;">'.$icon_card_list.'</button> '. $row['Acci_FechaAccidenteF'] . " - " . ucfirst(strtolower($row['Acci_Evento'])) . '</p>';
        }
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->accidentes_piloto($colaborador_id, $fecha_inicio_actual, $fecha_termino_actual, $acci_responsabilidad);
        $accidentes_actual = "";
        foreach ($Respuesta as $row) {
            $accidentes_actual .= '<p><button id="' . $row['Accidentabilidad_id'] . '" class="btn btn-outline-light btn_accidente" data-toggle="modal" data-target="#modal_accidentabilidad" type="button" style="padding: 0px; border:0px;">'.$icon_card_list.'</button> '. $row['Acci_FechaAccidenteF'] . " - " . ucfirst(strtolower($row['Acci_Evento'])) . '</p>';
        }
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->punto_fijo_piloto($colaborador_id, $fecha_inicio_anterior, $fecha_termino_anterior);
        $punto_fijo_anterior = "";
        foreach ($Respuesta as $row) {
            $punto_fijo_anterior .= '<p><button id="' . $row['PuntoFijo_id'] . '" class="btn btn-outline btn_punto_fijo" data-toggle="modal" data-target="#modal_punto_fijo"   type="button" style="padding: 0px; border:0px;">'.$icon_card_list.'</button> '. $row['Puntofijo_FechaDelEvento'] . ' - ' . $row['Puntofijo_TipologiaMulta'] . ' - ' . $row['Puntofijo_AccionCorrectiva'] . '</p>';
        }
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->punto_fijo_piloto($colaborador_id, $fecha_inicio_actual, $fecha_termino_actual);
        $punto_fijo_actual = "";
        foreach ($Respuesta as $row) {
            $punto_fijo_actual .= '<p><button id="' . $row['PuntoFijo_id'] . '" class="btn btn-outline btn_punto_fijo" data-toggle="modal" data-target="#modal_punto_fijo"   type="button" style="padding: 0px; border:0px;">'.$icon_card_list.'</button> '. $row['Puntofijo_FechaDelEvento'] . ' - ' . $row['Puntofijo_TipologiaMulta'] . ' - ' . $row['Puntofijo_AccionCorrectiva'] . '</p>';
        }
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->acompanamiento_piloto($colaborador_id, $fecha_inicio_anterior, $fecha_termino_anterior);
        $acompanamiento_anterior = "";
        foreach ($Respuesta as $row) {
            $acompanamiento_anterior .= '<p><button id="' . $row['Acompañamiento_id'] . '" class="btn btn-outline btn_acompaniamiento"  data-toggle="modal" data-target="#modal_acompaniamiento" type="button" style="padding: 0px; border:0px;">'.$icon_card_list.'</button>'. $row['Acomp_FechaF'] .' - Nota Final : ' . substr("000" . $row['Acomp_NotaFinal'], -3) . '</p>';
        }
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->acompanamiento_piloto($colaborador_id, $fecha_inicio_actual, $fecha_termino_actual);
        $acompanamiento_actual = "";
        foreach ($Respuesta as $row) {
            $acompanamiento_actual .= '<p><button id="' . $row['Acompañamiento_id'] . '" class="btn btn-outline btn_acompanamiento"  data-toggle="modal" data-target="#modal_acompanamiento" type="button" style="padding: 0px; border:0px;">'.$icon_card_list.'</button>'. $row['Acomp_FechaF'] .' - Nota Final : ' . substr("000" . $row['Acomp_NotaFinal'], -3) . '</p>';
        }
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->comportamiento_piloto($colaborador_id, $fecha_inicio_anterior, $fecha_termino_anterior, $estado_comportamiento);
        $comportamiento_anterior = "";
        foreach ($Respuesta as $row) {
            $comportamiento_anterior .= '<p><button id="' . $row['Comportamiento_id'] . '" class="btn btn-outline btn_comportamiento" data-toggle="modal" data-target="#modal_comportamiento"   type="button" style="padding: 0px; border:0px;">'.$icon_card_list.'</button>'. $row['Comp_FechaEventoF'] . ' - ' . $row['Comp_DetalleNovedad'] . ' - ' . $row['Comp_TipoDisciplina'] . '</p>';
        }
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->comportamiento_piloto($colaborador_id, $fecha_inicio_actual, $fecha_termino_actual, $estado_comportamiento);
        $comportamiento_actual = "";
        foreach ($Respuesta as $row) {
            $comportamiento_actual .= '<p><button id="' . $row['Comportamiento_id'] . '" class="btn btn-outline btn_comportamiento" data-toggle="modal" data-target="#modal_comportamiento"   type="button" style="padding: 0px; border:0px;">'.$icon_card_list.'</button>'. $row['Comp_FechaEventoF'] . ' - ' . $row['Comp_DetalleNovedad'] . ' - ' . $row['Comp_TipoDisciplina'] . '</p>';
        }
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->ausencia_piloto($colaborador_id, $fecha_inicio_anterior, $fecha_termino_anterior, $estado_ausencia);
        $ausencia_anterior = "";
        foreach ($Respuesta as $row) {
            $ausencia_anterior .= '<p><button id="'. $row['Inasistencia_id'] .'" class="btn btn-outline btn_ausencia" data-toggle="modal" data-target="#modal_ausencia" type="button" style="padding: 0px; border:0px;">'.$icon_card_list.'</button> '. $row['Inas_FechaDeEventoF'] . ' - ' . $row['Inas_TipoNovedad'] . ' - ' . $row['Inas_TotalHoras'] . '</p>';
        } 
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->ausencia_piloto($colaborador_id, $fecha_inicio_actual, $fecha_termino_actual, $estado_ausencia);
        $ausencia_actual = "";
        foreach ($Respuesta as $row) {
            $ausencia_actual .= '<p><button id="'. $row['Inasistencia_id'] .'" class="btn btn-outline btn_ausencia" data-toggle="modal" data-target="#modal_ausencia" type="button" style="padding: 0px; border:0px;">'.$icon_card_list.'</button> '. $row['Inas_FechaDeEventoF'] . ' - ' . $row['Inas_TipoNovedad'] . ' - ' . $row['Inas_TotalHoras'] . '</p>';
        }
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD('colaborador', 'Colaborador_Id', $colaborador_id);
        foreach ($Respuesta as $row) {
            $dni = $row['Colaborador_id'];
            $nombre_piloto = $row['Colab_ApellidosNombres'];
            $email = $row['Colab_Email'];
            $direccion = $row['Colab_Direccion'];
            $distrito = $row['Colab_Distrito'];
            $cargo = $row['Colab_CargoActual'];
            $codigo_operacion = $row['Colab_CodigoCortoPT'];
            if($row['Colab_FechaIngreso']==NULL){
                $fecha_ingreso = "";
            }else{
                $fecha_ingreso = date("d/m/Y",strtotime($row['Colab_FechaIngreso']));
            }
            $estado_laboral = $row['Colab_Estado'];
            $fecha_anterior = new DateTime($row['Colab_FechaIngreso']);
            if($row['Colab_FechaCese']==NULL){
                $fecha_actual = new DateTime();
                $fecha_cese = "";
            }else{
                $fecha_actual = new DateTime($row['Colab_FechaCese']);
                $fecha_cese = date("d/m/Y",strtotime($row['Colab_FechaCese']));
            }
            $antiguedad_diff = date_diff($fecha_anterior, $fecha_actual);
            $anios = $antiguedad_diff->y;
            $meses = $antiguedad_diff->m;
            $dias = $antiguedad_diff->d;
            $t_anios = ' años ';
            $t_meses = ' meses ';
            $t_dias = ' días ';
            if($anios=='1'){$t_anios=' año ';}
            if($meses=='1'){$t_meses=' mes ';}
            if($dias=='1'){$t_dias=' mes ';}
            $antiguedad = $anios.$t_anios.$meses.$t_meses.$dias.$t_dias;
        }
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD('glo_colaboradorimagen', 'Colaborador_id', $dni);
        $fotografia = '';
        foreach ($Respuesta as $row) {
            $fotografia = base64_encode($row['Colab_Fotografia']);
        }
        if($fotografia!=''){
            $t_src = ' <img id="fotografia" src="data:image/jpg;base64,'.$fotografia.'"  class="card-img" alt="..."> ';
        }else{
            $t_src = ' <img id="fotografia" src="/Module/pilotos/View/Img/perfil.jpg" class="card-img" alt="..."> ';
        }
        $html  = '  <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                '.$t_src.'
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">'.$nombre_piloto.'</h5>
                                    <b>DNI : </b>'.$dni.'</br>
                                    <b>e-mail : </b>'.$email.'</br>
                                    <b>Dirección : </b>'.$direccion.'</br>
                                    <b>Disttrito : </b>'.$distrito.'</br>
                                    <br>
                                    <small class="text-muted">Cargo : '.$cargo.'</small></br>
                                    <small class="text-muted">Código de Operación : '.$codigo_operacion.'</small></br>
                                    <small class="text-muted">Antiguedad : '.$antiguedad.'</small></br>
                                    <small class="text-muted">Fecha Ingreso : '.$fecha_ingreso.'</small></br>
                                    <small class="text-muted">Fecha Cese : '.$fecha_cese.'</small></br>
                                    <small class="text-muted">Estado Laboral : '.$estado_laboral.'</small></br>
                                </div>
                            </div>
                        </div>
                    </div>';
        $html .= '  <div class="card" style="max-width: 540px;">
                        <div class="card-body">
                            <h5 class="card-title">NOVEDADES '.$mes_anterior.'</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Datos reportados del '.date("d/m/Y",strtotime($fecha_inicio_anterior)).' al '.date("d/m/Y",strtotime($fecha_termino_anterior)).'</h6>
                            <div id="accordion_anterior">
                                <h3>Accidentes</h3>
                                <div>
                                    '.$accidentes_anterior.'
                                </div>
                                <h3>Punto Fijo</h3>
                                <div>
                                    '.$punto_fijo_anterior.'
                                </div>
                                <h3>Acompañamiento</h3>
                                <div>
                                    '.$acompanamiento_anterior.'
                                </div>
                                <h3>Comportamiento</h3>
                                <div>
                                    '.$comportamiento_anterior.'
                                </div>
                                <h3>Ausencia</h3>
                                <div>
                                    '.$ausencia_anterior.'
                                </div>
                            </div>
                        </div>
                    </div>';
        $html .= '  <div class="card" style="max-width: 540px;">
                        <div class="card-body">
                            <h5 class="card-title">NOVEDADES '.$mes_actual.'</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Datos reportados del '.date("d/m/Y",strtotime($fecha_inicio_actual)).' al '.date("d/m/Y",strtotime($fecha_termino_actual)).'</h6>
                            <div id="accordion_actual">
                                <h3>Accidentes</h3>
                                <div>
                                    '.$accidentes_actual.'
                                </div>
                                <h3>Punto Fijo</h3>
                                <div>
                                    '.$punto_fijo_actual.'
                                </div>
                                <h3>Acompañamiento</h3>
                                <div>
                                    '.$acompanamiento_actual.'
                                </div>
                                <h3>Comportamiento</h3>
                                <div>
                                    '.$comportamiento_actual.'
                                </div>
                                <h3>Ausencia</h3>
                                <div>
                                    '.$ausencia_actual.'
                                </div>
                            </div>
                        </div>
                    </div>';
        $html .= '  <div class="row modal fade" id="modal_accidentabilidad" tabindex="-1" role="dialog" aria-labelledby="accidentabilidadModalLabel" aria-hidden="true">
	                    <div class="modal-dialog modal-lg" role="document">
	                        <div class="modal-content">
	            			    <div class="modal-header">
	                                <h5 class="modal-title" id="accidentabilidadModalLabel"></h5>
	                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
	                                </button>
	                            </div>
			  	                <form id="form_accidentabilidad">    
	      		                    <div class="modal-body" id="modal_body_accidentabilidad">
                                    </div>
                                </form>
                            </div>  
                        </div>
                    </div>';
        $html .= '  <div class="row modal fade" id="modal_punto_fijo" tabindex="-1" role="dialog" aria-labelledby="puntofijoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="puntofijoModalLabel"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_punto_fijo">    
                                    <div class="modal-body" id="modal_body_punto_fijo">
                                    </div>
                                </form>
                            </div>  
                        </div>
                    </div>';
        $html .= '  <div class="row modal fade" id="modal_acompanamiento" tabindex="-1" role="dialog" aria-labelledby="acompanamientoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="acompanamientoModalLabel"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_acompanamiento">    
                                    <div class="modal-body" id="modal_body_acompanamiento">
                                    </div>
                                </form>
                            </div>  
                        </div>
                    </div>';
        $html .= '  <div class="row modal fade" id="modal_comportamiento" tabindex="-1" role="dialog" aria-labelledby="comportamientoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="comportamientoModalLabel"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_comportamiento">
                                    <div class="modal-body" id="modal_body_comportamiento">
                                    </div>
                                </form>
                            </div>  
                        </div>
                    </div>';
        $html .= '  <div class="row modal fade" id="modal_ausencia" tabindex="-1" role="dialog" aria-labelledby="ausenciaModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ausenciaModalLabel"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="form_ausencia">
                                    <div class="modal-body" id="modal_body_ausencia">
                                    </div>
                                </form>
                            </div>  
                        </div>
                    </div>';
        echo $html;
    }

    public function data_accidente($accidente_id)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->data_accidente($accidente_id);
        $html = "";
        foreach ($Respuesta as $row) {
            $html = '<span class="item" >Fecha Accidente:        </span>' . $row['Acci_FechaAccidente'] . ' ' . $row['Acci_HoraDeAccidente'] . '<br>
                <span class="item" >Evento:                 </span>' . $row['Acci_Evento'] . '<br>
                <span class="item" >Piloto Reconoce Responsabilidad:   </span>' . $row['Acci_PilotoReconoceResponsabilidad'] . '<br>
                <span class="item" >Gravedad de Evento:     </span>' . $row['Acci_GravedadDeEvento'] . '<br>
                <hr class="separadorsimple">
                <span class="item" >Ocurrencia Accidente:   </span>' . $row['Acci_OcurrenciaAccidente'] . '
                <hr class="separadorsimple">
                <span class="item" >Nombre de CGO:          </span>' . $row['Acci_NombreDeCgo'] . '<br>
                <span class="item" >Código Piloto:          </span>' . $row['Acci_CodigoPiloto'] . '<br>
                <span class="item" >Antigüedad Piloto:      </span>' . $row['Acci_AntiguedadDePiloto'] . ' Años<br>
                <span class="item" >Tabla:                  </span>' . $row['Acci_Tabla'] . '<br>
                <span class="item" >N° Bus:                 </span>' . $row['Acci_NumBus'] . '<br>
                <span class="item" >Servicio:               </span>' . $row['Acci_Servicio'] . '<br>
                <span class="item" >Dirección Accidente:    </span>' . $row['Acci_DireccionAccidente'] . '<br>
                <span class="item" >Sentido Accidente:      </span>' . $row['Acci_SentidoAccidente'] . '<br>
                <span class="item" >Clase Accidente:        </span>' . $row['Acci_ClaseDeAccidente'] . '<br>
                <span class="item" >Daños Vehículo LBI:     </span>' . $row['Acci_DañosVehiculoLbi'] . '<br>
                <span class="item" >Conciliado:             </span>' . $row['Acci_Conciliado'] . '<br>
                <span class="item" >Moneda:                 </span>' . $row['Acci_Moneda'] . '<br>
                <span class="item" >Monto:                  </span>' . $row['Acci_Monto'] . '<br>
                <span class="item" >Trámite Policial:       </span>' . $row['Acci_TramitePolicial'] . '<br>
                <span class="item" >Asistió Accidente:      </span>' . $row['Acci_AsistioAccidente'] . '<br>
                <span class="item" >Falta Cometida:         </span>' . $row['Acci_FaltaCometidaPorElPiloto'] . '<br>
                <span class="item" >Falta Cometida:         </span>' . $row['Acci_FaltaCometida2'] . '<br>
                <span class="item" >Responsabilidad:        </span>' . $row['Acci_ResponsabilidadDeFalta2'] . '<br>
                <span class="item" >Costo Accidente:        </span>' . $row['Acci_CostoTotalDeAccidente'] . '<br>';
        }
        echo $html;
    }

    public function data_punto_fijo($punto_fijo_id)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->data_punto_fijo($punto_fijo_id);
        $html = "";
        foreach ($Respuesta as $row) {
            $html = '<span class="item">Fecha Evento:            </span>' . $row['Puntofijo_FechaDelEvento'] . '<br>   
                    <span class="item">Tipología Multa:         </span>' . $row['Puntofijo_TipologiaMulta'] . '<hr>
                    <span class="item">Infracción:              </span>' . $row['Puntofijo_Infraccion'] . '
                    <hr>
                    <span class="item">Id Sistema:              </span>' . $row['PuntoFijo_id'] . '<br>
                    <span class="item">Evaluador:               </span>' . $row['Puntofijo_Evaluador'] . '<br>
                    <span class="item">Franja Horaria:          </span>' . $row['Puntofijo_FranjaHoraria'] . '<br>
                    <span class="item">Estado:                  </span>' . $row['Puntofijo_Estado'] . '<br>
                    <span class="item">DNI:                     </span>' . $row['Puntofijo_Dni'] . '<br>
                    <span class="item">Código:                  </span>' . $row['Puntofijo_Codigo'] . '<br>
                    <span class="item">Nombre Operador:         </span>' . $row['Puntofijo_NombreOperador'] . '<br>
                    <span class="item">Tabla:                   </span>' . $row['Puntofijo_Tabla'] . '<br>
                    <span class="item">Hora Inspección:         </span>' . $row['Puntofijo_HoraInspeccion'] . '<br>
                    <span class="item">Bus:                     </span>' . $row['Puntofijo_Bus'] . '<br>
                    <span class="item">Lugar Inspección:        </span>' . $row['Puntofijo_LugarInspeccion'] . '<br>
                    <span class="item">Sentido:                 </span>' . $row['Puntofijo_Sentido'] . '
                    <hr>
                    <span class="item">Calificación:            </span>' . $row['Puntofijo_Calificacion'] . '<br>
                    <span class="item">Monto Multa:             </span>' . $row['Puntofijo_MontoDeMulta'] . '<br>
                    <span class="item">Puntos LBI:              </span>' . $row['Puntofijo_PuntosLbi'] . '<br>
                    <span class="item">Nro Video:               </span>' . $row['Puntofijo_NroVideo'] . '<br>
                    <span class="item">Tipo Evaluación:         </span>' . $row['Puntofijo_TipoDeEvaluacion'] . '<br>
                    <span class="item">Acción Correctiva:       </span>' . $row['Puntofijo_AccionCorrectiva'] . '<br>
                    <span class="item">Fecha Acción Correctiva: </span>' . $row['Puntofijo_FechaAC'] . '<br>
                    <span class="item">Observaciones:           </span>' . $row['Puntofijo_Observaciones'] . '<br>
                    <span class="item">Piloto:                  </span>' . $row['Puntofijo_Piloto'] . '<br>';
        }
        echo $html;
    }

    public function data_acompanamiento($acompanamiento_id)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->data_acompanamiento($acompanamiento_id);
        $html = "";
        foreach ($Respuesta as $row) {
            $html = '   <span class="item">Fecha:                   </span>' . $row['Acomp_Fecha'] . '<br>
                        <span class="item">Calificación Seguridad:  </span>' . $row['Acomp_CalificacionSeguridad'] . '<br>
                        <span class="item">Calificación Calidad:    </span>' . $row['Acomp_CalificacionCalidad'] . '<br>
                        <span class="item">Nota Final:              </span>' . $row['Acomp_NotaFinal'] . '<br>
                        <span class="item">Observaciones:           </span>' . $row['Acomp_Observaciones'] . '<br>
                        <hr class="separadorsimple">
                        <span class="item">Id Sistema:              </span>' . $row['Acompañamiento_id'] . '<br>
                        <span class="item">Número:                  </span>' . $row['Acomp_Num'] . '<br>
                        <span class="item">Evaluador:               </span>' . $row['Acomp_Evaluador'] . '<br>
                        <span class="item">Id Seguimiento:          </span>' . $row['Acomp_IdSeguimiento'] . '<br>
                        <span class="item">Día:                     </span>' . $row['Acomp_Dia'] . '<br>
                        <span class="item">Código:                  </span>' . $row['Acomp_Codigo'] . '<br>
                        <span class="item">Tabla:                   </span>' . $row['Acomp_Tabla'] . '<br>
                        <span class="item">Inicio:                  </span>' . $row['Acomp_Inicio'] . '<br>
                        <span class="item">Fin:                     </span>' . $row['Acomp_Fin'] . '<br>
                        <span class="item">Servicio:                </span>' . $row['Acomp_Servicio'] . '<br>
                        <span class="item">Bus:                     </span>' . $row['Acomp_Bus'] . '<br>
                        <span class="item">Lugar Origen:            </span>' . $row['Acomp_LugarOrigen'] . '<br>
                        <span class="item">Lugar Destino:           </span>' . $row['Acomp_LugarDestino'] . '<br>
                        <span class="item">Evento:                  </span>' . $row['Acomp_Evento'] . '<br>
                        <span class="item">Fecha:                   </span>' . $row['Acomp_Fecha2'] . '<br>
                        <span class="item">Tipo:                    </span>' . $row['Acomp_Tipo'] . '<br>
                        <span class="item">Cumplimiento Planeamiento:</span>'. $row['Acomp_CumplimientoPlaneamiento'] . '<br>';
        }
        echo $html;
    }

    public function data_comportamiento($comportamiento_id)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->data_comportamiento($comportamiento_id);
        $html = "";
        foreach ($Respuesta as $row) {
            $html = '   <span class="item">Fecha Evento:              </span>' . $row['Comp_FechaEvento'] . '<br>
                        <span class="item">Detalle Novedad:           </span>' . $row['Comp_DetalleNovedad'] . '<br>
                        <span class="item">Tipo Disciplina:           </span>' . $row['Comp_TipoDisciplina'] . '<hr>
                        <span class="item">Descripción Novedad:       </span>' . $row['Comp_DescripNovedad'] . '<hr>
                        <span class="item">Id-Sistema:                </span>' . $row['Comportamiento_Id'] . '<br>
                        <span class="item">Nombre CGO:                </span>' . $row['Comp_NombreCGO'] . '<br>
                        <span class="item">DNI:                       </span>' . $row['Comp_Dni'] . '<br>
                        <span class="item">Código Piloto:             </span>' . $row['Comp_CodPiloto'] . '<br>
                        <span class="item">Nombre Piloto:             </span>' . $row['Comp_NombrePiloto'] . '<br>
                        <span class="item">Bus:                       </span>' . $row['Comp_Bus'] . '<br>
                        <span class="item">Tipo Piloto:               </span>' . $row['Comp_TipoPiloto'] . '<br>
                        <span class="item">Tabla:                     </span>' . $row['Comp_Tabla'] . '<br>
                        <span class="item">Servicio:                  </span>' . $row['Comp_Servicio'] . '<br>
                        <span class="item">Acción Disciplinaria:      </span>' . $row['Comp_AccionDisciplinaria'] . '<br>
                        <span class="item">Código Falta:              </span>' . $row['Comp_CodigoDeFalta'] . '<br>
                        <span class="item">Monto:                     </span>' . $row['Comp_Monto'] . '<br>
                        <span class="item">Reconoce Responsabilidad:  </span>' . $row['Comp_ReconoceResp'] . '<br>
                        <span class="item">Afecta Premio:             </span>' . $row['Comp_AfectaPremio'] . '<br>
                        <span class="item">Observación:               </span>' . $row['Comp_Observacion'] . '<br>';
        }
        echo $html;
    }

    public function data_ausencia($ausencia_id)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->data_ausencia($ausencia_id);
        $html = "";
        foreach ($Respuesta as $row) {
            $html = '   <span class="item">Fecha Evento:        </span>' . $row['Inas_FechaDeEvento'] . '<br>
                        <span class="item">Detalle Novedad:     </span>' . $row['Inas_DetalleNovedad'] . '<hr>
                        <span class="item">Descripción Novedad: </span>' . $row['Inas_DescripNovedad'] . '<hr>
                        <span class="item">Id Sistema:          </span>' . $row['Inasistencia_id'] . '<br>
                        <span class="item">Nombre CGO:          </span>' . $row['Inas_NombreCGO'] . '<br>
                        <span class="item">DNI:                 </span>' . $row['Inas_DNI'] . '<br>
                        <span class="item">Situación:           </span>' . $row['Inas_Situacion'] . '<br>
                        <span class="item">Código Piloto:       </span>' . $row['Inas_CodPiloto'] . '<br>
                        <span class="item">Nombre Piloto:       </span>' . $row['Inas_NombrePiloto'] . '<br>
                        <span class="item">Tipo Piloto:         </span>' . $row['Inas_TipoPiloto'] . '<br>
                        <span class="item">Hora Inicio:         </span>' . $row['Inas_HoraInicio'] . '<br>
                        <span class="item">Hora Final:          </span>' . $row['Inas_HoraFinal'] . '<br>
                        <span class="item">Total Horas:         </span>' . $row['Inas_TotalHoras'] . '<br>
                        <span class="item">Bus:                 </span>' . $row['Inas_Bus'] . '<br>
                        <span class="item">Tipo Bus:            </span>' . $row['Inas_TipoBus'] . '<br>
                        <span class="item">Tabla:               </span>' . $row['Inas_Tabla'] . '<br>
                        <span class="item">Servicio:            </span>' . $row['Inas_Servicio'] . '<br>
                        <span class="item">Tipo Novedad:        </span>' . $row['Inas_TipoNovedad'] . '<br>';
        }
        echo $html;
    }

}