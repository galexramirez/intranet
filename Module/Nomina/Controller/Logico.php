<?php
session_start();
class Logico
{
	var $Modulo="Nomina";
	
	function Contenido($NombreDeModuloVista)    
	{		
		MView('Nomina','local_view',compact('NombreDeModuloVista') );
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
        $rpta_Diferencia    = "NO";
        $firstDate          = new DateTime($inicio);
        $secondDate         = new DateTime($final);
        $intvl              = $firstDate->diff($secondDate);
        
        if($intvl->days < $dias){
            $rpta_Diferencia = "SI";
        }
        echo $rpta_Diferencia;
    }

    public function calcular_diferencia_horas($horainicio,$horafinal)
    {
        $calculo    = '';
        $hinicial   = new DateTime($horainicio);
        $hfinal     = new DateTime($horafinal);
        
        $interval   = $hinicial->diff($hfinal);
        $hora       = $interval->format('%H');
        $minuto     = $interval->format('%i');
        $calculo    = mktime($hora,$minuto);

        echo date("H:i",$calculo);
    }

    public function DocumentRoot()
    {
        $mi_carpeta = '';
        $mi_host    = $_SERVER['HTTP_HOST'];
        $mi_referer = $_SERVER['HTTP_REFERER'];
        $mi_carpeta = substr($mi_referer,0,strpos($mi_referer,$mi_host)).$mi_host.'/';
        echo $mi_carpeta;
    }

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

    public function generar_nomina($ncar_anio, $ncar_periodo, $ncar_tipo, $ncar_fecha_inicio, $ncar_fecha_termino)
    {
        // Crea Carpeta por Años
        $mi_carpeta  = $_SERVER['DOCUMENT_ROOT']."/Services/json_nomina/".$ncar_anio;
        if (!file_exists($mi_carpeta)) {
            mkdir($mi_carpeta, 0777, true);
        }
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $nomina_carga_id = $InstanciaAjax->generar_nomina($ncar_anio, $ncar_periodo, $ncar_tipo, $ncar_fecha_inicio, $ncar_fecha_termino);

        switch ($ncar_periodo) {
            case "ENERO":
                $n_periodo = "01";
            break;
            case "FEBRERO":
                $n_periodo = "02"; 
            break;
            case "MARZO":
                $n_periodo = "03";
            break;
            case "ABRIL":
                $n_periodo = "04";
            break;
            case "MAYO":
                $n_periodo = "05";
            break;
            case "JUNIO":
                $n_periodo = "06";
            break;
            case "JULIO":
                $n_periodo = "07";
            break;
            case "AGOSTO":
                $n_periodo = "08";
            break;
            case "SETIEMBRE":
                $n_periodo = "09";
            break;
            case "OCTUBRE":
                $n_periodo = "10";
            break;
            case "NOVIEMBRE":
                $n_periodo = "11";
            break;
            case "DICIEMBRE":
                $n_periodo = "12";
            break;
        }

        switch ($ncar_tipo) {
            case "PROGRAMACION":
                $n_tipo = "01";
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax = new CRUD();
                $Respuesta = $InstanciaAjax->leer_nomina_programacion($ncar_fecha_inicio, $ncar_fecha_termino);      
            break;
            case "OPERACION":
                $n_tipo = "02";
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax = new CRUD();
                $Respuesta = $InstanciaAjax->leer_nomina_operacion($ncar_fecha_inicio, $ncar_fecha_termino);      
            break;
        }
        /* Calculo de Horas Totales de Nomina*/
        /* $sum_hora_0 = strtotime('00:00');
        $total_time = 0;
        foreach( $Respuesta as $row ) {
            $time_in_sec = strtotime($row['Duracion']) - $sum_hora_0;
            $total_time = $total_time + $time_in_sec;
        }
        $h = intval($total_time / 3600);
        $total_time = $total_time - ($h * 3600);
        $m = intval($total_time / 60);
        $total_horas = $h.":".$m; */

        $ncar_archivo = $ncar_anio."_M".$n_periodo."_T".$n_tipo."_".$nomina_carga_id.".json";
        $data = json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
        file_put_contents($mi_carpeta."/".$ncar_archivo, $data);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->editar_generar_nomina($nomina_carga_id, $ncar_archivo);

        echo "Generación Exitosa ...!!!";
    }

    public function listar_nomina_json($fecha_inicio, $fecha_termino, $tipo_nomina)
    {
        $nomina_array = array();
        $ncar_tipo = $tipo_nomina;
        $ncar_estado = "GENERADO";
        $meses_array = array(
            '01' => 'ENERO',
            '02' => 'FEBRERO',
            '03' => 'MARZO',
            '04' => 'ABRIL',
            '05' => 'MAYO',
            '06' => 'JUNIO',
            '07' => 'JULIO',
            '08' => 'AGOSTO',
            '09' => 'SETIEMBRE',
            '10' => 'OCTUBRE',
            '11' => 'NOVIEMBRE',
            '12' => 'DICIEMBRE',
        );

        /* Conseguimos todos los meses y años entre la fecha inicial y fecha terminio */
        $mes_anio = array();
        $mes_inicio = date("m", strtotime("$fecha_inicio"));
        $anio_inicio =  date("Y", strtotime("$fecha_inicio"));
        $limite = date("Y-m", strtotime("$fecha_termino"));
        $nuevo = 0;
        $m = 0;
        while($nuevo!=$limite){
            $nuevo = date("Y-m", mktime(0, 0, 0, $mes_inicio+$m, 1, $anio_inicio));
            $n_mes = date("m", mktime(0, 0, 0, $mes_inicio+$m, 1, $anio_inicio));
            $n_anio = date("Y", mktime(0, 0, 0, $mes_inicio+$m, 1, $anio_inicio));
            $m++;
            $mes_anio[] = array(
                'mes' => $n_mes,
                'anio' => $n_anio,
              );
        }
        
        /* Recorremos el array de meses y años */
        foreach($mes_anio as $row){
            $anio = $row['anio'];
            $mes = $row['mes'];
            $nombre_mes = $meses_array[$mes];
            $ncar_archivo = "";

            /* Buscamos el nombre del archivo */
            MModel($this->Modulo,'CRUD');
            $instancia_ajax = new CRUD();
            $respuesta = $instancia_ajax->buscar_dato("ope_nomina_carga", "ncar_archivo", "ncar_anio='$anio' AND ncar_periodo='$nombre_mes' AND ncar_tipo='$ncar_tipo' AND ncar_estado='$ncar_estado'");

            foreach ($respuesta as $row) {
                $ncar_archivo = $row['ncar_archivo'];
            }

            if($ncar_archivo!==""){
                $mi_carpeta = $_SERVER['DOCUMENT_ROOT']."/Services/json_nomina/".$anio;
                $file_data = file_get_contents($mi_carpeta."/".$ncar_archivo);
                $data_array = json_decode($file_data, true);
    
                $nomina_filtrada = array_filter($data_array, function ($item) use ($fecha_inicio, $fecha_termino) {
                    return $item['Fecha'] >= $fecha_inicio && $item['Fecha'] <= $fecha_termino;
                });
                $nomina_array = array_merge($nomina_array, $nomina_filtrada);    
            }
        }

        $nomina_array = array_values($nomina_array);

        print json_encode($nomina_array, JSON_UNESCAPED_UNICODE);
    }

    public function generar_horarios_nomina($chn_fecha, $chn_operacion)
    {
        $rpta_ghn = "";
        $chn_tipo_nomina = "PROGRAMACION";
        $chn_estado = "GENERADO";
        $chn_usuario_crea =  $_SESSION['USUARIO_ID'];
        $chn_fecha_crea = date("Y-m-d H:i:s");
        $periodo_id = "";
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->buscar_dato("glo_periodo", "periodo_id", "`peri_fecha_inicio`<='".$chn_fecha."' AND `peri_fecha_termino`>='".$chn_fecha."'");
        foreach($Respuesta as $row){
            $periodo_id = $row['periodo_id'];
        }

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD("glo_periodo", "periodo_id", $periodo_id);
        foreach($Respuesta as $row){
            $chn_anio = $row['peri_anio'];
            $chn_periodo = $row['peri_mes'];
        }
 
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $resp = $InstanciaAjax->generar_carga_horarios_nomina($chn_anio, $chn_periodo, $chn_tipo_nomina, $chn_fecha, $chn_operacion, $chn_usuario_crea, $chn_fecha_crea, $chn_estado);
        if(substr($resp,0,1)!="E"){
            $horarios_nomina_carga_id = $resp;
        }
        $rpta_ghn .= $this->error_pdo($resp);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->leer_horarios_nomina_programacion($chn_fecha, $chn_operacion);      
        $hn_dni = "";
        $hn_codigo_colaborador = "";
        $hn_nombre_colaborador = "";
        $prog_hora_origen = "";
        $prog_hora_destino = "";
        $prog_lugar_destino = "";
        $prog_servicio = "";
        
        foreach($Respuesta as $row){
            $dni_fin = "";
            if($hn_dni!=$row['Prog_Dni']){
                if($hn_dni==""){
                    $hn_dni=$row['Prog_Dni'];
                    $hn_codigo_colaborador = $row['Prog_CodigoColaborador'];
                    $hn_nombre_colaborador = $row['Prog_NombreColaborador'];
                    $hn_tipo_marcacion = "INGRESO";
                    $hn_hora = $row['Prog_HoraOrigen'];
                    $hn_lugar = $row['Prog_LugarOrigen'];
                    $hn_servicio = $row['Prog_Servicio'];
                    $prog_hora_origen = $row['Prog_HoraOrigen'];
                    $prog_hora_destino = $row['Prog_HoraDestino'];
                    $prog_lugar_destino = $row['Prog_LugarDestino'];
                    $prog_servicio = $row['Prog_Servicio'];
                    MModel($this->Modulo,'CRUD');
                    $InstanciaAjax = new CRUD();
                    $resp = $InstanciaAjax->generar_horarios_nomina($horarios_nomina_carga_id, $chn_anio, $chn_periodo, $chn_tipo_nomina, $chn_operacion, $chn_fecha, $hn_dni, $hn_codigo_colaborador, $hn_nombre_colaborador, $hn_hora, $hn_servicio, $hn_lugar, $hn_tipo_marcacion, $this->fecha_hora($hn_hora,$chn_fecha));
                    $rpta_ghn .= $this->error_pdo($resp);
                }else{
                    if($this->diff_horas($prog_hora_destino,"mayor",$prog_hora_origen,$chn_fecha)){
                        $hn_tipo_marcacion = "SALIDA";
                        $hn_hora = $prog_hora_destino;
                        $hn_lugar = $prog_lugar_destino;
                        $hn_servicio = $prog_servicio;
                        MModel($this->Modulo,'CRUD');
                        $InstanciaAjax = new CRUD();
                        $resp = $InstanciaAjax->generar_horarios_nomina($horarios_nomina_carga_id, $chn_anio, $chn_periodo, $chn_tipo_nomina, $chn_operacion, $chn_fecha, $hn_dni, $hn_codigo_colaborador, $hn_nombre_colaborador, $hn_hora, $hn_servicio, $hn_lugar, $hn_tipo_marcacion, $this->fecha_hora($hn_hora,$chn_fecha));    
                        $rpta_ghn .= $this->error_pdo($resp);
                    }
                    $hn_dni=$row['Prog_Dni'];
                    $hn_codigo_colaborador = $row['Prog_CodigoColaborador'];
                    $hn_nombre_colaborador = $row['Prog_NombreColaborador'];
                    $hn_tipo_marcacion = "INGRESO";
                    $hn_hora = $row['Prog_HoraOrigen'];
                    $hn_lugar = $row['Prog_LugarOrigen'];
                    $hn_servicio = $row['Prog_Servicio'];
                    $prog_hora_origen = $row['Prog_HoraOrigen'];
                    $prog_hora_destino = $row['Prog_HoraDestino'];
                    $prog_lugar_destino = $row['Prog_LugarDestino'];
                    $prog_servicio = $row['Prog_Servicio'];
                    MModel($this->Modulo,'CRUD');
                    $InstanciaAjax = new CRUD();
                    $resp = $InstanciaAjax->generar_horarios_nomina($horarios_nomina_carga_id, $chn_anio, $chn_periodo, $chn_tipo_nomina, $chn_operacion, $chn_fecha, $hn_dni, $hn_codigo_colaborador, $hn_nombre_colaborador, $hn_hora, $hn_servicio, $hn_lugar, $hn_tipo_marcacion, $this->fecha_hora($hn_hora,$chn_fecha));    
                    $rpta_ghn .= $this->error_pdo($resp);
                    $dni_fin = "1";
                }
            }else{
                if($row['Prog_HoraOrigen']==$prog_hora_destino){
                    $prog_hora_origen = $row['Prog_HoraOrigen'];
                    $prog_hora_destino = $row['Prog_HoraDestino'];
                    $prog_lugar_destino = $row['Prog_LugarDestino'];
                    $prog_servicio = $row['Prog_Servicio'];
                }else{
                    if($this->diff_horas($row['Prog_HoraOrigen'],"mayor",$prog_hora_destino,$chn_fecha)){
                        $hn_codigo_colaborador = $row['Prog_CodigoColaborador'];
                        $hn_nombre_colaborador = $row['Prog_NombreColaborador'];
                        $hn_tipo_marcacion = "SALIDA";
                        $hn_hora = $prog_hora_destino;
                        $hn_lugar = $prog_lugar_destino;
                        $hn_servicio = $prog_servicio;
                        MModel($this->Modulo,'CRUD');
                        $InstanciaAjax = new CRUD();
                        $resp = $InstanciaAjax->generar_horarios_nomina($horarios_nomina_carga_id, $chn_anio, $chn_periodo, $chn_tipo_nomina, $chn_operacion, $chn_fecha, $hn_dni, $hn_codigo_colaborador, $hn_nombre_colaborador, $hn_hora, $hn_servicio, $hn_lugar, $hn_tipo_marcacion, $this->fecha_hora($hn_hora,$chn_fecha));
                        $rpta_ghn .= $this->error_pdo($resp);
                        $hn_tipo_marcacion = "INGRESO";
                        $hn_hora = $row['Prog_HoraOrigen'];
                        $hn_lugar = $row['Prog_LugarOrigen'];
                        $hn_servicio = $row['Prog_Servicio'];
                        MModel($this->Modulo,'CRUD');
                        $InstanciaAjax = new CRUD();
                        $resp = $InstanciaAjax->generar_horarios_nomina($horarios_nomina_carga_id, $chn_anio, $chn_periodo, $chn_tipo_nomina, $chn_operacion, $chn_fecha, $hn_dni, $hn_codigo_colaborador, $hn_nombre_colaborador, $hn_hora, $hn_servicio, $hn_lugar, $hn_tipo_marcacion, $this->fecha_hora($hn_hora,$chn_fecha));
                        $rpta_ghn .= $this->error_pdo($resp);
                        $prog_hora_origen = $row['Prog_HoraOrigen'];
                        $prog_hora_destino = $row['Prog_HoraDestino'];
                        $prog_lugar_destino = $row['Prog_LugarDestino'];
                        $prog_servicio = $row['Prog_Servicio'];
                    }
                }
            }
        }
        if($dni_fin=="1"){
            $rhora = $this->diff_horas($prog_hora_destino,"mayor",$prog_hora_origen,$chn_fecha);
        }else{
            $rhora = $this->diff_horas($prog_hora_origen,"mayor",$prog_hora_destino,$chn_fecha);
        }
        if($rhora){
            $hn_tipo_marcacion = "SALIDA";
            $hn_hora = $prog_hora_destino;
            $hn_lugar = $prog_lugar_destino;
            $hn_servicio = $prog_servicio;
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax = new CRUD();
            $resp = $InstanciaAjax->generar_horarios_nomina($horarios_nomina_carga_id, $chn_anio, $chn_periodo, $chn_tipo_nomina, $chn_operacion, $chn_fecha, $hn_dni, $hn_codigo_colaborador, $hn_nombre_colaborador, $hn_hora, $hn_servicio, $hn_lugar, $hn_tipo_marcacion, $this->fecha_hora($hn_hora,$chn_fecha));
            $rpta_ghn .= $this->error_pdo($resp);
        }
        if($rpta_ghn===""){
            echo "Generación Exitosa ...!!!";
        } else {
            echo $rpta_ghn;
        }
        
    }

    private function error_pdo($error)
    {
        $rpta_error = "";
        if(substr($error,0,1)=="E"){
            $rpta_error = $error;
        }
        return $rpta_error;
    } 

    private function diff_horas($hora1, $cond, $hora2, $fecha)
    {
        $rpta_diff = False;
        $harr = ["00","01","02","03","04","05","06","07","08"];
        if(intval(substr($hora1,0,2))>=24){
            $nhora1 = str_replace(intval(substr($hora1,0,2)),$harr[intval(substr($hora1,0,2))-24],$hora1);
            $nhora1 = date("Y-m-d",strtotime($fecha."+ 1 days"))." ".$nhora1;
            if(intval(substr($hora2,0,2))>=24){
                $nhora2 = str_replace(intval(substr($hora2,0,2)),$harr[intval(substr($hora2,0,2))-24],$hora2);
                $nhora2 = date("Y-m-d",strtotime($fecha."+ 1 days"))." ".$nhora2;
            }else{
                $nhora2 = $fecha." ".$hora2;
            }
        }else{
            $nhora1 = $hora1;
            if(intval(substr($hora2,0,2))>=24){
                $nhora2 = str_replace(intval(substr($hora2,0,2)),$harr[intval(substr($hora2,0,2))-24],$hora2);
                $nhora2 = date("Y-m-d",strtotime($fecha."+ 1 days"))." ".$nhora2;
                $nhora1 = $fecha." ".$hora1;
            }else{
                $nhora2 = $hora2;
            }
        }
        $hora_i = new DateTime($nhora1);
        $hora_f = new DateTime($nhora2);
        if($cond=="mayor"){
            if($hora_i > $hora_f){
                $rpta_diff = True;
            }
        }elseif($cond=="menor"){
            if($hora_i < $hora_f){
                $rpta_diff = True;
            }
        }
        return $rpta_diff;
    }

    private function fecha_hora($hora, $fecha)
    {
        $rpta_fecha_hora = "";
        $harr = ["00","01","02","03","04","05","06","07","08"];
        if(intval(substr($hora,0,2))>=24){
            $nhora1 = str_replace(intval(substr($hora,0,2)),$harr[intval(substr($hora,0,2))-24],$hora);
            $rpta_fecha_hora = date("Y-m-d",strtotime($fecha."+ 1 days"))." ".$nhora1;
        }else{
            $rpta_fecha_hora = $fecha." ".$hora;
        }
        return $rpta_fecha_hora;
    }

}