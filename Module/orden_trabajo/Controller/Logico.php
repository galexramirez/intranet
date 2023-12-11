<?php
class Logico
{
	var $Modulo = "orden_trabajo";
    
	function Contenido($NombreDeModuloVista)    
	{		
		MView($this->Modulo,'LocalView',compact('NombreDeModuloVista') );
	}

    public function DocumentRoot()
    {
        $mi_carpeta = '';
        $mi_host    = $_SERVER['HTTP_HOST'];
        $mi_referer = $_SERVER['HTTP_REFERER'];
        $mi_carpeta = substr($mi_referer,0,strpos($mi_referer,$mi_host)).$mi_host.'/';
        echo $mi_carpeta;
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

    public function MayorFecha($inicio,$final)
    {
        $rpta_Mayor = "NO";
        $fecha_inicio = strtotime( $inicio );
        $fecha_final = strtotime( $final );
        
        if( $fecha_final > $fecha_inicio ) {
            $rpta_Mayor = "SI";
        }  
        echo $rpta_Mayor;
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

    public function calcular_diferencia_horas($horainicio,$horafinal)
    {
        $calculo    = '';
        $hora_n     = intval(substr($horafinal,0,2));
        $hora_24    = 24;
        if($hora_n>$hora_24){
        	$horafinal = "2023-01-02".substr(("0".($hora_n-$hora_24)),-2).substr($horafinal,2,2);
        	$horainicio = "2023-01-01".$horainicio;
        }
        $hinicial   = new DateTime($horainicio);
        $hfinal     = new DateTime($horafinal);
        
        $interval   = $hinicial->diff($hfinal);
        $hora       = $interval->format('%H');
        $minuto     = $interval->format('%i');
        $calculo    = mktime($hora,$minuto);

        echo date("H:i",$calculo);
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

    public function CrearOT($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_date_crea, $ot_date_ct, $ot_asociado, $ot_hmotor, $ot_cgm_crea, $ot_cgm_ct, $ot_estado, $ot_resp_asoc, $ot_descrip, $ot_tecnico, $ot_check, $ot_obs_cgm, $ot_sistema, $ot_inicio, $ot_fin, $ot_codfalla, $ot_at, $ot_obs_asoc, $ot_montado, $ot_dmontado, $ot_busmont, $ot_busdmont, $ot_motivo, $ot_obs_aom, $ot_ca, $ot_date_ca, $ot_componente_raiz, $ot_obs_aom2, $ot_accidentes_id, $ot_semana_cierre, $ot_cod_vinculada, $array_data)
    {
        if($ot_kilometraje==""){
            $ot_kilometraje="0";
        }
        
        $TablaBD = "glo_roles";
        $CampoBD = "roles_nombrecorto";

        if($ot_cgm_crea!=""){
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ot_cgm_crea);
            foreach ($Respuesta as $row) {
                $ot_cgm_crea = $row['roles_dni'];
            }
        }        

        if($ot_cgm_ct!=""){
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ot_cgm_ct);
            foreach ($Respuesta as $row) {
                $ot_cgm_ct = $row['roles_dni'];
            }
            if($ot_date_ct==""){
                $ot_date_ct = date("Y:m:d H:i:s");
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CrearOT($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_date_crea, $ot_date_ct, $ot_asociado, $ot_hmotor, $ot_cgm_crea, $ot_cgm_ct, $ot_estado, $ot_resp_asoc, $ot_descrip, $ot_tecnico, $ot_check, $ot_obs_cgm, $ot_sistema, $ot_inicio, $ot_fin, $ot_codfalla, $ot_at, $ot_obs_asoc, $ot_montado, $ot_dmontado, $ot_busmont, $ot_busdmont, $ot_motivo, $ot_obs_aom, $ot_ca, $ot_date_ca, $ot_componente_raiz, $ot_obs_aom2, $ot_accidentes_id, $ot_semana_cierre, $ot_cod_vinculada);

        $ht_ot_id = $ot_id;
        foreach($array_data as $row){
            $ht_tecnico_nombres = $row['tecnico_nombres'];
            $ht_hora_inicio     = $row['hora_inicio'];
            $ht_hora_fin        = $row['hora_fin'];
    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->crear_horas_tecnicos($ht_ot_id, $ht_tecnico_nombres, $ht_hora_inicio, $ht_hora_fin);    
        }
    }

    public function CargarVales($ot_id)
    {
        $valeshtml = "";
        $TablaBD = "manto_vales";
        $CampoBD = "va_ot";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ot_id);
        foreach ($Respuesta as $row) {
            $cod_vale = $row['cod_vale'];
            $va_asociado = $row['va_asociado'];
            $va_estado = $row['va_estado'];
            $valeshtml .= ' <div class="row">
                                <div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center">
                                    <div class="form-group form-control-sm mb-1">
                                        <label for="" class="form-control-sm pl-0 mb-0">'.$cod_vale.'</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center">
                                    <div class="form-group form-control-sm mb-1">
                                        <label for="" class="form-control-sm pl-0 mb-0">'.$va_asociado.'</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center">
                                    <div class="form-group form-control-sm mb-1">
                                        <label for="" class="form-control-sm pl-0 mb-0">'.$va_estado.'</label>
                                    </div>
                                </div>
                            </div>';
        }
        echo $valeshtml;
    }

    public function SelectUsuario($Usua_Perfil)
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectUsuario($Usua_Perfil);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Usuario'].'">'.$row['Usuario'].'</option>';
        }
        echo $html;
    }

    public function SelectTecnico($ot_asociado)
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTecnico($ot_asociado);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Usuario'].'">'.$row['Usuario'].'</option>';
        }
        echo $html;
    }

    public function BuscarTecnico($ot_asociado)
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarTecnico($ot_asociado);

        $ot_tecnico = "";

        foreach ($Respuesta as $row) {
            $ot_tecnico = $row['ot_tecnico'];
        }
        echo $ot_tecnico;
    }

    public function SelectTipos($ttablaotcorrectivas_operacion, $ttablaotcorrectivas_tipo)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTipos($ttablaotcorrectivas_operacion, $ttablaotcorrectivas_tipo);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
        }
        echo $html;
    }

    public function CalculoKilometraje($ot_bus,$ot_inicio)
    {
        $kminicial = 0;
        $fechainicial = "";
        $kmfinal = 0;
        $fechafinal = $ot_inicio;
        $ndias = 0;
        $kmhtml = "";

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CalculoKilometraje($ot_bus,$ot_inicio);
        foreach ($Respuesta as $row) {
            if(!is_null($row['kminicial'])){
                $kminicial = $row['kminicial'];
            }
            if(!is_null($row['fechainicial'])){
                $fechainicial = $row['fechainicial'];
            }
            if(!is_null($row['kmfinal'])){
                $kmfinal = $row['kmfinal'];
            }
            if(!is_null($row['fechafinal'])){
                $fechafinal = $row['fechafinal'];
            }
        }
        if($kmfinal == 0){
            $d1 = new DateTime($ot_inicio);
            $d2 = new DateTime($fechainicial);
            $diff = date_diff($d1,$d2);
            $ndias = $diff->format('%a'); 
            $kmfinal = $kminicial + (480 * $ndias);
        }
        $kmhtml .= '<label for="" class="form-control-sm pl-0 mb-0">';
        $kmhtml .= number_format($kminicial,0,'.',' ').' KM AL '.date_format(date_create($fechainicial),"d-m-Y").' Y '.number_format($kmfinal,0,'.',' ').' KM AL '.date_format(date_create($fechafinal),"d-m-Y");
        $kmhtml .= '</label>';
        echo $kmhtml;
    }

    public function ValidarKm($ot_bus,$ot_inicio,$ot_kilometraje)
    {
        $kminicial = 0;
        $fechainicial = "";
        $kmfinal = 0;
        $fechafinal = $ot_inicio;
        $ndias = 0;
        $validakm = "SI";

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CalculoKilometraje($ot_bus,$ot_inicio);
        foreach ($Respuesta as $row) {
            if(!is_null($row['kminicial'])){
                $kminicial = $row['kminicial'];
            }
            if(!is_null($row['fechainicial'])){
                $fechainicial = $row['fechainicial'];
            }
            if(!is_null($row['kmfinal'])){
                $kmfinal = $row['kmfinal'];
            }
            if(!is_null($row['fechafinal'])){
                $fechafinal = $row['fechafinal'];
            }
        }
        if($kmfinal == 0){
            $d1 = new DateTime($ot_inicio);
            $d2 = new DateTime($fechainicial);
            $diff = date_diff($d1,$d2);
            $ndias = $diff->format('%a'); 
            $kmfinal = $kminicial + (480 * $ndias);
        }
        if ($ot_kilometraje > $kmfinal) {
            $validakm = "NO";
        }
        if ($ot_kilometraje < $kminicial) {
            $validakm = "NO";
        }
        echo $validakm;
    }

    public function EditarOT($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_date_crea, $ot_date_ct, $ot_asociado, $ot_hmotor, $ot_cgm_crea, $ot_cgm_ct, $ot_estado, $ot_resp_asoc, $ot_descrip, $ot_tecnico, $ot_check, $ot_obs_cgm, $ot_sistema, $ot_inicio, $ot_fin, $ot_codfalla, $ot_at, $ot_obs_asoc, $ot_montado, $ot_dmontado, $ot_busmont, $ot_busdmont, $ot_motivo, $ot_obs_aom, $ot_ca, $ot_date_ca, $ot_componente_raiz, $ot_obs_aom2, $ot_accidentes_id, $ot_semana_cierre, $ot_cod_vinculada, $array_data)
    {
        $TablaBD = "glo_roles";
        $CampoBD = "roles_nombrecorto";

        if($ot_cgm_crea!=""){
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ot_cgm_crea);
            foreach ($Respuesta as $row) {
                $ot_cgm_crea = $row['roles_dni'];
            }
        }        

        if($ot_cgm_ct!=""){
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ot_cgm_ct);
            foreach ($Respuesta as $row) {
                $ot_cgm_ct = $row['roles_dni'];
            }
            if($ot_date_ct==""){
                $ot_date_ct = date("Y:m:d H:i:s");
            }
        }        

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->EditarOT($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_date_crea, $ot_date_ct, $ot_asociado, $ot_hmotor, $ot_cgm_crea, $ot_cgm_ct, $ot_estado, $ot_resp_asoc, $ot_descrip, $ot_tecnico, $ot_check, $ot_obs_cgm, $ot_sistema, $ot_inicio, $ot_fin, $ot_codfalla, $ot_at, $ot_obs_asoc, $ot_montado, $ot_dmontado, $ot_busmont, $ot_busdmont, $ot_motivo, $ot_obs_aom, $ot_ca, $ot_date_ca, $ot_componente_raiz, $ot_obs_aom2, $ot_accidentes_id, $ot_semana_cierre, $ot_cod_vinculada);


        $ht_ot_id = $ot_id;
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->eliminar_horas_tecnicos($ht_ot_id);

        foreach($array_data as $row){
            $ht_tecnico_nombres = $row['tecnico_nombres'];
            $ht_hora_inicio     = $row['hora_inicio'];
            $ht_hora_fin        = $row['hora_fin'];
    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->crear_horas_tecnicos($ht_ot_id, $ht_tecnico_nombres, $ht_hora_inicio, $ht_hora_fin);    
        }
    }

    public function BusesOT()
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BusesOT();

        $html = '<option value="">Bus</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Buses'].'">'.$row['Buses'].'</option>';
        }
        echo $html;
    }

    public function AsociadoOT()
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AsociadoOT();

        $html = '<option value="">Seleccione una opcion</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Asociado'].'">'.$row['Asociado'].'</option>';
        }
        echo $html;
    }

    public function Origenes($ot_origen)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->Origenes();

        $html = '<option value="">Seleccione una opcion</option>';
        if($ot_origen!=""){
            $html = '<option value="'.$ot_origen.'">'.$ot_origen.'</option>';
        }
       
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Origenes'].'">'.$row['Origenes'].'</option>';
        }
        echo $html;
    }

    public function ver_ot($ot_id)
    {
        $html       = "";
        $valeshtml  = "";
        $color      = "";
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->ver_ot($ot_id);
        foreach ($Respuesta as $row) {
            $ot_id             = $row['ot_id'];
            $ot_origen          = $row['ot_origen'];
            $ot_bus             = $row['ot_bus'];
            $ot_cgm_crea        = $row['ot_cgm_crea'];
            $ot_date_crea       = $row['ot_date_crea'];
            $ot_asociado        = $row['ot_asociado'];
            $ot_resp_asoc       = $row['ot_resp_asoc'];
            $ot_kilometraje     = $row['ot_kilometraje'];
            $ot_hmotor          = $row['ot_hmotor'];
            $ot_check           = $row['ot_check'];
            $ot_descrip         = $row['ot_descrip'];
            $ot_obs_cgm         = $row['ot_obs_cgm'];
            $ot_cgm_ct          = $row['ot_cgm_ct'];
            $ot_date_ct         = $row['ot_date_ct'];
            $ot_inicio          = $row['ot_inicio'];
            $ot_fin             = $row['ot_fin'];
            $ot_sistema         = $row['ot_sistema'];
            $ot_codfalla        = $row['ot_codfalla'];
            $ot_at              = $row['ot_at'];
            $ot_obs_asoc        = $row['ot_obs_asoc'];
            $ot_montado         = $row['ot_montado'];
            $ot_dmontado        = $row['ot_dmontado'];
            $ot_busdmontado     = $row['ot_busdmontado'];
            $ot_busmont         = $row['ot_busmont'];
            $ot_motivo          = $row['ot_motivo'];
            $ot_componente_raiz = $row['ot_componente_raiz'];
            $ot_tecnico         = $row['ot_tecnico'];
            $ot_ca              = $row['ot_ca'];
            $ot_date_ca         = $row['ot_date_ca'];
            $ot_estado          = $row['ot_estado'];
            $ot_obs_aom         = $row['ot_obs_aom'];
            $ot_accidentes_id   = $row['ot_accidentes_id'];
            $ot_semana_cierre   = $row['ot_semana_cierre'];
            $ot_cod_vinculada   = $row['ot_cod_vinculada'];
                switch($ot_estado)
                {
                    case "CERRADO":
                        $color = "success";
                    break;
                    case "OBSERVADO":
                        $color = "danger";
                    break;
                    case "ANULADO":
                        $color = "primary";
                    break;
                    case "ABIERTO":
                        $color = "warning";
                    break;
                    case "PENDIENTE CT":
                        $color = "warning";
                    break;
                }
            }

        // SE REVISA SI HAY INFORMACION DE OT CORRECTIVAS CON VALES
        $TablaBD = "manto_vales";
        $CampoBD = "va_ot";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ot_id);
        foreach ($Respuesta as $row) {
            $cod_vale       = $row['cod_vale'];
            $va_asociado    = $row['va_asociado'];
            $va_estado      = $row['va_estado'];
            $valeshtml .= ' <div class="row">
                                <div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center">
                                    <div class="form-group form-control-sm mb-1">
                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$cod_vale.'</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center">
                                    <div class="form-group form-control-sm mb-1">
                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_asociado.'</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center">
                                    <div class="form-group form-control-sm mb-1">
                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_estado.'</span>    
                                    </div>
                                </div>
                            </div>';
        }

            $html = '   <div class="row d-flex justify-content-araound">
                            <div class="col-lg-6">
                                <div class="row border border-muted border-radius rounded mb-2">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-1 border border-muted border-radius rounded d-flex justify-content-center">
                                                <div class="form-group form-control-sm mb-1 align-self-center">
                                                    <h6 class="font-weight-bold">LBI</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm text-center">
                                                    <soan class="form-control-sm pl-0 mb-0 font-weight-bold">Ord.Trabajo</span>
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">MT-F-04</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm text-center">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">ORIGEN</span>
                                                    <br>
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_origen.'</span>
                                                </div>
                                            </div>	
                                            <div class="col-lg-3 border border-muted border-radius rounded d-flex align-items-center">
                                                <div class="form-group form-control-sm mb-1 text-center">
                                                    <h6 class="font-weight-bold">N° '.$ot_id.'</h6>
                                                </div>
                                            </div>		
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm mb-1 text-center">
                                                    <h6 class="font-weight-bold">BUS</h6>
                                                    <h6 class="font-weight-bold">'.$ot_bus.'</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="row align-items-end border border-muted border-radius rounded">
                                                    <div class="form-group form-control-sm mb-1">	
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">GENERO:</span> 
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_cgm_crea.'</span>
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">EL</span> 
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_date_crea.'</span>
                                                    </div>
                                                </div>
                                                <div class="row align-items-end border border-muted border-radius rounded">
                                                    <div class="form-group form-control-sm mb-1">
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">ASOCIADO:</span> 
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_asociado.'</span>
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">RESP:</span> 
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_resp_asoc.'</span>
                                                    </div>
                                                </div>
                                            </div>	
                                        </div>
                                    </div>
                                </div>
                                <div class="row border border-muted border-radius rounded mb-2">
                                    <div class="col-lg-12">	
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="col-lg-4 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm text-center">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">KILOMETRAJE</span>
                                                    <br>
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_kilometraje.'</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm text-center">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">HORA MOTOR:</span> 
                                                    <br>
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_hmotor.'</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm text-center">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">CHECK:</span> 
                                                    <br>
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_check.'</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="col-lg-6 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm text-center">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">N° IP:</span> 
                                                    <br>
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_accidentes_id.'</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm text-center">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">OT VINCULADA:</span> 
                                                    <br>
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_cod_vinculada.'</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">DESCRIPCION DE LA ACTIVIDAD (Verbo + Detalle)</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_descrip.'</div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">OBSERVACIONES DE CGM (Máximo 1000 carácteres)</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_obs_cgm.'</div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group form-control-sm mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">CIERRE TECNICO POR:</span> 
                                                <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_cgm_ct.'</span>
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">EL</span> 
                                                <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_date_ct.'</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border border-muted border-radius rounded">
                                    <div class="col-lg-12">	
                                        <div class="row">
                                            <div class="col-lg-6 border border-muted border-radius rounded d-flex align-items-center">
                                                <div class="form-group form-control-sm mb-1 text-center">
                                                    <h6 class="font-weight-bold">CIERRE (ACCION TOMADA)</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row border border-muted border-radius rounded">
                                                    <div class="form-group form-control-sm mb-1">
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">INICIO:</span> 
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_inicio.'</span>	
                                                    </div>
                                                </div>
                                                <div class="row border border-muted border-radius rounded">
                                                    <div class="form-group form-control-sm mb-1">	
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">FINALIZO:</span> 
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_fin.'</span>	
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm mb-1">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">SISTEMA:</span> 
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_sistema.'</span>	
                                                </div>
                                            </div>
                                            <div class="col-lg-6 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm mb-1">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">CODIGO FALLA:</span> 
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_codfalla.'</span>	
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">DESCRIPCION DE ACCION TOMADA (Máximo 13000 carácteres)</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_at.'</div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">OBSERVACIONES DE ASOCIADO:</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_obs_asoc.'</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row border border-muted border-radius rounded mb-2">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center bg-info text-white">
                                                <div class="form-group form-control-sm mb-1">
                                                    <label for="" class="form-control-sm pl-0 mb-0">N° VALE</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center bg-info text-white">
                                                <div class="form-group form-control-sm mb-1">
                                                    <label for="" class="form-control-sm pl-0 mb-0">ASOCIADO</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center bg-info text-white">
                                                <div class="form-group form-control-sm mb-1">
                                                    <label for="" class="form-control-sm pl-0 mb-0">ESTADO</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="div_vales">
                                            '.$valeshtml.'
                                        </div>
                                    </div>
                                </div>
                                <div class="row border border-muted border-radius rounded mb-2">
                                    <div class="col-lg-12">
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group form-control-sm mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">N° Serie o codigo de Componente Montado :</span> 
                                                <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_montado.'</span>	
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group form-control-sm mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">N° Serie o codigo de Componente Desmontado :</span> 
                                                <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_dmontado.'</span>	
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm mb-1">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">Se desmonto del bus :</span> 
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_busdmontado.'</span>	
                                                </div>
                                            </div>
                                            <div class="col-lg-6 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm mb-1">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">Para el bus :</span> 
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_busmont.'</span>	
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group form-control-sm mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">Motivo Montaje :</span> 
                                                <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_motivo.'</span>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group form-control-sm mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">Componente Raiz :</span> 
                                                <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_componente_raiz.'</span>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group form-control-sm mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">TECNICO ASOCIADO :</span> 
                                                <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_tecnico.'</span>	
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border border-muted border-radius rounded mb-2">
                                    <div class="col-lg-12">
                                        <div class="container-fluid caja">
                                            <div class="row w-100 p-0 m-0">
                                               <div class="col-lg-12">
                                                   <div class="table-responsive" id="div_tabla_ver_horas_tecnicos">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                                <div class="row border border-muted border-radius rounded mb-2">
                                    <div class="col-lg-12">
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="col-lg-12">
                                                <div class="form-group form-control-sm mb-1" id="div_ot_ca">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">CIERRE ADMINISTRATIVO POR:</span> 
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_ca.'</span>
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">EL</span> 
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_date_ca.'</span>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="col-lg-12">
                                                <div class="form-group form-control-sm mb-1">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">SEMANA CIERRE:</span> 
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_semana_cierre.'</span>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="col-lg-12">
                                                <div class="form-group form-control-sm mb-1">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">ESTADO ACTUAL DE LA OT :</span> 
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal text-'.$color.'">'.$ot_estado.'</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">OBSERVACIONES DE CIERRE ADMINISTRATIVO:</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_obs_aom.'</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';

        echo $html;
    }

    public function ver_vale($ot_id)
    {
        $html = "";
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->ver_vale($ot_id);
        foreach ($Respuesta as $row) {
            $cod_vale           = $row['cod_vale'];
            $va_ot              = $row['va_ot'];
            $va_bus             = $row['va_bus'];
            $va_descrip         = $row['va_descrip'];
            $va_asociado        = $row['va_asociado'];
            $va_genera          = $row['va_genera'];
            $va_responsable     = $row['va_responsable'];
            $va_date_genera     = $row['va_date_genera'];
            $va_garantia        = $row['va_garantia'];
            $va_cierre_adm      = $row['va_cierre_adm'];
            $va_estado          = $row['va_estado'];
            $va_date_cierre_adm = $row['va_date_cierre_adm'];
            $va_obs_cgm         = $row['va_obs_cgm'];
            $va_obs_aom         = $row['va_obs_aom'];
            
            $Repuestoshtml = "";
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta2     = $InstanciaAjax->ver_detalle_repuesto($cod_vale);
            foreach ($Respuesta2 as $row) {
                $rv_repuesto    = $row['rv_repuesto'];
                $rv_nroserie    = $row['rv_nroserie'];
                $rv_desc        = $row['rv_desc'];
                $rv_cantidad    = $row['rv_cantidad'];
                $rv_unidad      = $row['rv_unidad'];
                $Repuestoshtml .= ' <tr>
                                        <th>'.$rv_repuesto.'</th>
                                        <th>'.$rv_nroserie.'</th>
                                        <th>'.$rv_desc.'</th>
                                        <th>'.$rv_cantidad.'</th>
                                        <th>'.$rv_unidad.'</th>
                                    </tr>';
            }

            $html .= '  <div class="row d-flex justify-content-araound mb-3 bg-light border border-muted border-radius rounded">
                            <div class="col-lg-12">                            
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-4">
                                        <div class="form-group form-control-sm mb-1">
                                            <h6 class="font-weight-bold">N° '.$cod_vale.'</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group form-control-sm mb-1">
                                            <h6 class="font-weight-bold">N° OT :'.$va_ot.'</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group form-control-sm mb-1">
                                            <h6 class="font-weight-bold">BUS :'.$va_bus.'</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-12">
                                        <div class="form-group form-control-sm mb-1 text-truncate">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">DESC. ACTIVIDAD :</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_descrip.'</span>	
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-6">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">ASOCIADO :</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_asociado.'</span>	
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">RESP. :</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_responsable.'</span>	
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-12">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">GENERA :</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_genera.'</span>	
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">EL</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_date_genera.'</span>	
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-12">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">CIERRE ADM. :</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_cierre_adm.'</span>	
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">EL</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_date_cierre_adm.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-6">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">REG.REPUESTO :</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_garantia.'</span>	
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">ESTADO :</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_estado.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-araound">

                                    <div class="table-responsive">        
                                        <table id="tablaVerDetalleRepuestos" class="table table-striped table-bordered table-condensed w-100">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>CODIGO</th>
                                                    <th>NRO.SERIE</th>
                                                    <th>DESCRIPCION REPUESTOS</th>
                                                    <th>CANT.</th>
                                                    <th>UNID.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                '.$Repuestoshtml.'            
                                            </tbody>
                                        </table>

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-12">                                
                                        <div class="form-group form-control-sm mb-0">
                                            <span class="form-control-sm mb-0 font-weight-bold">OBSERVACIONES DE CGM :</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-12">
                                        <div class="form-group form-control-sm mb-0">
                                            <div class="form-control-sm pl-0 mb-0 overflow-auto h-250 border border-muted border-radius rounded">'.$va_obs_cgm.'</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-12">
                                        <div class="form-group form-control-sm mb-0">
                                            <span class="form-control-sm mb-0 font-weight-bold">OBSERVACIONES DE AOM :</span>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-lg-12">
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-12">
                                        <div class="form-group form-control-sm mb-2">
                                            <div class="form-control-sm mb-2 overflow-auto h-250 border border-muted border-radius rounded">'.$va_obs_aom.'</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
        echo $html;
    }

    public function descargar_ot($FechaInicioOT,$FechaTerminoOT)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->descargar_ot($FechaInicioOT,$FechaTerminoOT);

        $mi_carpeta = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date       = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date       = str_replace(".", "", $date);
        $filename   = "OTs_".$date;
        $file_json  = $filename.".json";
        $data       = json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
        file_put_contents($mi_carpeta."/".$file_json, $data);
        echo $filename;
    }

    public function ot_observadas()
    {
        $rpta_ot_observadas = "";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->ot_observadas();

        foreach ($Respuesta as $row){
            if($row['cantidad_ot']!="0"){
                $rpta_ot_observadas = $row['cantidad_ot'];
            }
        }

        echo $rpta_ot_observadas;
    }

    public function validar_estado_cerrado($tabla, $semana, $estado)
    {
        $rpta_validar_estado = "";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->validar_estado_cerrado($tabla, $semana, $estado);

        foreach ($Respuesta as $row){
            $rpta_validar_estado = $row['registro'];
        }
        echo $rpta_validar_estado;
    }

    public function validar_semana($tabla, $campo_semana, $semana)
    {
        $rpta_validar_semana = "";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->validar_semana($tabla, $campo_semana, $semana);

        foreach ($Respuesta as $row){
            $rpta_validar_semana = $row['registro'];
        }
        echo $rpta_validar_semana;
    }

    public function generar_cierre_semanal($otc_semana){
        $rpta_cierre_semanal = "";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->codigos_repuestos($otc_semana);

        foreach ($Respuesta as $row){
            $cod_rv         = $row['cod_rv'];
            $ruc            = $row['va_ruc'];
            $fecha_vigencia = $row['va_date_cierre_adm'];
            $repuesto       = $row['rv_repuesto'];

            MModel($this->Modulo,'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta2     = $InstanciaAjax->precios_repuestos($ruc, $fecha_vigencia, $repuesto);

            foreach ($Respuesta2 as $row2){
                $rv_precio              = $row2['precio']; 
                $rv_unidad_medida       = $row2['unidad_medida']; 
                $rv_material_id         = $row2['material_id'];
                $rv_precio_proveedor_id = $row2['precio_proveedor_id'];
                $rv_moneda              = $row2['moneda'];
                $rv_precio_soles        = $row2['precio_soles'];
                $rv_fecha_vigencia      = $row2['fecha_vigencia'];
                $rv_tipo                = $row2['tipo'];
                $rv_descripcion         = $row2['descripcion'];

                MModel($this->Modulo,'CRUD');
                $InstanciaAjax  = new CRUD();
                $Respuesta2     = $InstanciaAjax->editar_repuestos_vale($cod_rv, $rv_precio, $rv_unidad_medida, $rv_material_id, $rv_precio_proveedor_id, $rv_moneda, $rv_precio_soles, $rv_fecha_vigencia, $rv_tipo, $rv_descripcion);
            }
        }

        $rpta_cierre_semanal = "Se realizo con éxito el cierre semanal";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->generar_cierre_semanal($otc_semana);
        $rpta_cierre_semanal = "Se realizo con éxito el cierre semanal";

        echo $rpta_cierre_semanal;
    }

}