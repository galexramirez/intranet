<?php
session_start();

class Logico
{
	var $Modulo = "desempeno_piloto";

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

    public function cargar_desempeno_piloto($nombre_piloto, $fecha_inicio, $fecha_termino)
    {
        $html = '';
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD('colaborador', 'Colab_ApellidosNombres', $nombre_piloto);
        foreach ($Respuesta as $row) {
            $dni = $row['Colaborador_id'];
            $email = $row['Colab_Email'];
            $direccion = $row['Colab_Direccion'];
            $distrito = $row['Colab_Distrito'];
            $cargo = $row['Colab_CargoActual'];
            $codigo_operacion = $row['Colab_CodigoCortoPT'];
            $fecha_ingreso = $row['Colab_FechaIngreso'];
            $fecha_cese = $row['Colab_FechaCese'];
            $estado_laboral = $row['Colab_Estado'];
            $fecha_anterior = new DateTime($fecha_ingreso);
            $fecha_actual = new DateTime();
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
            $t_src = ' <img id="fotografia" src="data:image/jpg;base64,'.$fotografia.'" height="260px" width="180px" class="img-responsive"> ';
        }else{
            $t_src = ' <img id="fotografia" src="/Module/desempeno_piloto/View/Img/perfil.jpg" height="260px" width="180px" class="img-responsive"> ';
        }

        $html  = '  <div class = "row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 rounded shadow-sm bg-white ml-4 mr-2" >
                            <div class="row">
                                <div class="col-sm-4 p-1 py-3">
                                    '.$t_src.'
                                </div>
                                <div class="col-sm-8 form-control-sm p-3 ficha_datos_piloto" >
                                    <h5>'.$nombre_piloto.'</h5>
                                    <b>DNI : </b>'.$dni.'<br>
                                    <b>e-mail : </b>'.$email.'<br>
                                    <b>Dirección : </b>'.$direccion.'<br>
                                    <b>Disttrito : </b>'.$distrito.'<br>
                                    <br>
                                    Cargo : '.$cargo.'</br>
                                    Código de Operación : '.$codigo_operacion.'</br>
                                    Antiguedad : '.$antiguedad.'</br>
                                    Fecha Ingreso : '.$fecha_ingreso.'</br>
                                    Fecha Cese : '.$fecha_cese.'</br>
                                    Estado Laboral : '.$estado_laboral.'</br>
                                </div>
                            </div>
                        </div>';
        $html .= '      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 rounded shadow-sm bg-white mr-2">
                            <h6>Desempeño</h6>
                        </div>';
        $html .= '      <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 rounded shadow-sm bg-white mr-2">
                            <h6>Eventos</h6>
                        </div>
                    </div>';
        echo $html;
    }

}