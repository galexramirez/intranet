<?php
class Logico
{
	var $Modulo = "orden_trabajo";
    
	function Contenido($NombreDeModuloVista)    
	{		
		MView($this->Modulo,'local_view',compact('NombreDeModuloVista') );
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

    public function buscar_data($nombre_tabla, $campo_buscar, $condicion_where)
	{
        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->buscar_data($nombre_tabla, $campo_buscar, $condicion_where);

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

    public function crear_ot($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_fecha_registro, $ot_nombre_proveedor, $ot_cgm, $ot_estado, $ot_actividad, $ot_ejecucion, $ot_obs_cgm, $ot_sistema, $ot_obs_proveedor, $ot_semana_cierre, $ot_tipo, $array_data)
    {
        $ot_ruc_proveedor = "";
        $ot_cgm_id = "";

        if($ot_kilometraje==""){
            $ot_kilometraje="0";
        }
        
        if($ot_cgm!==""){
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->BuscarDataBD("colaborador", "Colab_nombre_corto", $ot_cgm);
            foreach ($Respuesta as $row) {
                $ot_cgm_id = $row['Colaborador_id'];
            }
        }        

        if($ot_nombre_proveedor!==""){
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->BuscarDataBD("manto_proveedores", "prov_razonsocial", $ot_nombre_proveedor);
            foreach ($Respuesta as $row) {
                $ot_ruc_proveedor = $row['prov_ruc'];
            }
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->crear_ot($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_fecha_registro, $ot_ruc_proveedor, $ot_nombre_proveedor, $ot_cgm_id, $ot_estado, $ot_actividad, $ot_ejecucion, $ot_obs_cgm, $ot_sistema, $ot_obs_proveedor, $ot_semana_cierre, $ot_tipo);

        $ht_ot_id = $Respuesta;
        foreach($array_data as $row){
            $ht_tecnico_nombres = $row['tecnico_nombres'];
            $ht_hora_inicio     = $row['hora_inicio'];
            $ht_hora_fin        = $row['hora_fin'];
    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->crear_horas_tecnicos($ht_ot_id, $ht_tecnico_nombres, $ht_hora_inicio, $ht_hora_fin);    
        }
        echo $ht_ot_id;
    }

    public function cargar_vales($ot_id)
    {
        $valeshtml = "";
        $TablaBD = "manto_vale";
        $CampoBD = "va_ot_id";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ot_id);
        foreach ($Respuesta as $row) {
            $va_ot_id = $row['va_ot_id'];
            $va_asociado = $row['va_asociado'];
            $va_estado = $row['va_estado'];
            $valeshtml .= ' <div class="row">
                                <div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center">
                                    <div class="form-group form-control-sm mb-1">
                                        <label for="" class="form-control-sm pl-0 mb-0">'.$va_ot_id.'</label>
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

    public function editar_ot($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_fecha_registro, $ot_nombre_proveedor, $ot_cgm, $ot_estado, $ot_actividad, $ot_ejecucion, $ot_obs_cgm, $ot_sistema, $ot_obs_proveedor, $ot_semana_cierre, $ot_tipo, $array_data)
    {
        $ot_ruc_proveedor = "";
        $ot_cgm_id = "";
        $ot_log_anterior = "";

        if($ot_kilometraje==""){
            $ot_kilometraje="0";
        }
        
        if($ot_cgm!==""){
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->BuscarDataBD("colaborador", "Colab_nombre_corto", $ot_cgm);
            foreach ($Respuesta as $row) {
                $ot_cgm_id = $row['Colaborador_id'];
            }
        }        

        if($ot_nombre_proveedor!==""){
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->BuscarDataBD("manto_proveedores", "prov_razonsocial", $ot_nombre_proveedor);
            foreach ($Respuesta as $row) {
                $ot_ruc_proveedor = $row['prov_ruc'];
            }
        }

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD("manto_ots", "ot_id", $ot_id);
        foreach ($Respuesta as $row) {
            $ot_log_anterior = $row['ot_log'];
        }

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->editar_ot($ot_id, $ot_origen, $ot_bus, $ot_kilometraje, $ot_fecha_registro, $ot_ruc_proveedor, $ot_nombre_proveedor, $ot_cgm_id, $ot_estado, $ot_actividad, $ot_ejecucion, $ot_obs_cgm, $ot_sistema, $ot_obs_proveedor, $ot_semana_cierre, $ot_tipo, $ot_log_anterior);

        $ht_ot_id = $ot_id;
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->eliminar_horas_tecnicos($ht_ot_id);

        foreach($array_data as $row){
            $ht_tecnico_nombres = $row['tecnico_nombres'];
            $ht_hora_inicio     = date('Y-m-d H:i',strtotime($row['hora_inicio']));
            $ht_hora_fin        = date('Y-m-d H:i',strtotime($row['hora_fin']));
    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->crear_horas_tecnicos($ht_ot_id, $ht_tecnico_nombres, $ht_hora_inicio, $ht_hora_fin);    
        }
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
            $ot_id      = $row['ot_id'];
    		$ot_estado	= $row['ot_estado'];
    		$ot_origen	= $row['ot_origen'];
    		$ot_tipo	= $row['ot_tipo'];
    		$ot_bus	    = $row['ot_bus'];
    		$ot_ruc_proveedor	    = $row['ot_ruc_proveedor'];
    		$ot_nombre_proveedor    = $row['ot_nombre_proveedor'];
    		$ot_cgm_nombres	        = $row['ot_cgm_nombres'];
    		$ot_fecha_registro	    = $row['ot_fecha_registro'];
    		$ot_actividad	        = $row['ot_actividad'];
    		$ot_actividad_vincular	= $row['ot_actividad_vincular'];
    		$ot_kilometraje	  = $row['ot_kilometraje'];
    		$ot_sistema	      = $row['ot_sistema'];
    		$ot_ejecucion	  = $row['ot_ejecucion'];
    		$ot_obs_proveedor = $row['ot_obs_proveedor'];
    		$ot_obs_cgm	      = $row['ot_obs_cgm'];
    		$ot_log	          = $row['ot_log'];
    		$ot_semana_cierre = $row['ot_semana_cierre'];
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
        $TablaBD = "manto_vale";
        $CampoBD = "va_ot_id";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ot_id);
        foreach ($Respuesta as $row) {
            $vale_id     = $row['vale_id'];
            $va_asociado = $row['va_asociado'];
            $va_estado   = $row['va_estado'];
            $valeshtml .= ' <div class="row">
                                <div class="col-lg-4 border border-muted border-radius rounded d-flex justify-content-center">
                                    <div class="form-group form-control-sm mb-1">
                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$vale_id.'</span>
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
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_cgm_nombres.'</span>
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">EL</span> 
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_fecha_registro.'</span>
                                                    </div>
                                                </div>
                                                <div class="row align-items-end border border-muted border-radius rounded">
                                                    <div class="form-group form-control-sm mb-1">
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">ASOCIADO:</span> 
                                                        <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_nombre_proveedor.'</span>
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
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">SISTEMA:</span> 
                                                    <br>
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_sistema.'</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 border border-muted border-radius rounded">
                                                <div class="form-group form-control-sm text-center">
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-bold">TIPO:</span> 
                                                    <br>
                                                    <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$ot_tipo.'</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">ACTIVIDAD</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_actividad.'</div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">ACTIVIDAD VINCULADA</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_actividad_vincular.'</div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">EJECUCION DE ACTIVIDAD - DESCRIBA DETALLADAMENTE</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_ejecucion.'</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border border-muted border-radius rounded">
                                    <div class="col-lg-12">	
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">OBSERVACIONES PROVEEDOR</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_obs_proveedor.'</div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">OBSERVACIONES CGM</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_obs_cgm.'</div>
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
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">LOG</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_log.'</div>
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
            $vale_id            = $row['vale_id'];
            $va_ot_id           = $row['va_ot_id'];
            $va_bus             = $row['va_bus'];
            $va_actividad       = $row['va_actividad'];
            $va_asociado        = $row['va_asociado'];
            $va_genera_nombre   = $row['va_genera_nombre'];
            $va_date_genera     = $row['va_date_genera'];
            $va_estado          = $row['va_estado'];
            $va_obs_cgm         = $row['va_obs_cgm'];
            $va_obs_aom         = $row['va_obs_aom'];
            $va_log             = $row['va_log'];
            
            $Repuestoshtml = "";
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta2     = $InstanciaAjax->ver_detalle_repuesto($vale_id);
            foreach ($Respuesta2 as $row) {
                $vr_repuesto    = $row['vr_repuesto'];
                $vr_cod_patrimonial = $row['vr_cod_patrimonial'];
                $vr_descripcion = $row['vr_descripcion'];
                $vr_nroserie    = $row['vr_nroserie'];
                $vr_cantidad_requerida  = $row['vr_cantidad_requerida'];
                $vr_cantidad_despachada = $row['vr_cantidad_despachada'];
                $vr_cantidad_utilizada  = $row['vr_cantidad_utilizada'];
                $vr_unidad      = $row['rv_unidad'];
                $Repuestoshtml .= ' <tr>
                                        <th>'.$vr_repuesto.'</th>
                                        <th>'.$vr_cod_patrimonial.'</th>
                                        <th>'.$vr_nroserie.'</th>
                                        <th>'.$vr_descripcion.'</th>
                                        <th>'.$vr_cantidad_requerida.'</th>
                                        <th>'.$vr_cantidad_despachada.'</th>
                                        <th>'.$vr_cantidad_utilizada.'</th>
                                        <th>'.$vr_unidad.'</th>
                                    </tr>';
            }

            $html .= '  <div class="row d-flex justify-content-araound mb-3 bg-light border border-muted border-radius rounded">
                            <div class="col-lg-12">                            
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-4">
                                        <div class="form-group form-control-sm mb-1">
                                            <h6 class="font-weight-bold">N° VALE '.$vale_id.'</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group form-control-sm mb-1">
                                            <h6 class="font-weight-bold">N° OT :'.$va_ot_id.'</h6>
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
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_actividad.'</span>	
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
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">GENERA :</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_genera_nombre.'</span>	
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-6">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">EL</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$va_date_genera.'</span>	
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
                                                <th>COD.PAT.</th>
                                                <th>NRO.SERIE</th>
                                                <th>DESCRIPCION REPUESTOS</th>
                                                <th>C.REQ.</th>
                                                <th>C.DES.</th>
                                                <th>C.UTI.</th>
                                                <th>UNIDAD</th>
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
                                    <div class="col-lg-4">                                
                                        <div class="form-group form-control-sm mb-0">
                                            <span class="form-control-sm mb-0 font-weight-bold">OBSERVACIONES DE CGM</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group form-control-sm mb-0">
                                            <span class="form-control-sm mb-0 font-weight-bold">OBSERVACIONES DE AOM</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group form-control-sm mb-0">
                                            <span class="form-control-sm mb-0 font-weight-bold">LOG</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row d-flex justify-content-araound">
                                    <div class="col-lg-4">
                                        <div class="form-group form-control-sm mb-4">
                                            <div class="form-control-sm mb-4 overflow-auto border border-muted border-radius rounded" style="height: 50px;">'.$va_obs_cgm.'</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group form-control-sm mb-4">
                                            <div class="form-control-sm mb-4 overflow-auto border border-muted border-radius rounded" style="height: 50px;">'.$va_obs_aom.'</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group form-control-sm mb-4">
                                            <div class="form-control-sm mb-4 overflow-auto border border-muted border-radius rounded" style="height: 50px;">'.$va_log.'</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
        echo $html;
    }

    public function descargar_ot($fecha_inicio_ot, $fecha_termino_ot)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->descargar_ot($fecha_inicio_ot,$fecha_termino_ot);

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

    public function crear_orden_trabajo($ot_origen, $ot_nombre_proveedor, $a_data)
    {
        $not_ot_id = "";
        $novedad_id = "";
        $ot_actividad = "";
        $ot_tipo = "";
        $ot_ruc_proveedor = "";

        foreach ($a_data as $row){
            if($novedad_id===""){
                $novedad_id = $row['id'];
            }else{
                $novedad_id .= " , ".$row['id'];
            }
            if($ot_actividad===""){
                $ot_actividad = $row['ot_accion'];
            }else{
                $ot_actividad .= " ".$row['ot_accion'];
            }
        }

        foreach($a_data as $row){
            $not_bus = $row['bus'];
            $not_novedad_id = $row['id'];
            $not_origen_novedad = $row['origen'];
            $not_tipo_novedad = $row['tipo_novedad'];
            $not_operacion = $row['operacion'];
            if($not_ot_id===""){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax  = new CRUD();
                $Respuesta = $InstanciaAjax->buscar_dato("manto_ot_origen", "or_tipo_ot", "`or_nombre`='$ot_origen'");
        
                foreach ($Respuesta as $row) {
                    $ot_tipo = $row['or_tipo_ot'];
                }
        
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax  = new CRUD();
                $Respuesta = $InstanciaAjax->buscar_dato("manto_proveedores", "prov_ruc", "`prov_razonsocial`='$ot_nombre_proveedor'");
        
                foreach ($Respuesta as $row) {
                    $ot_ruc_proveedor = $row['prov_ruc'];
                }
        
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax  = new CRUD();
                $Respuesta = $InstanciaAjax->crear_orden_trabajo($ot_origen, $ot_ruc_proveedor, $ot_nombre_proveedor, $ot_tipo, $not_bus, $ot_actividad, $novedad_id);
        
                $not_ot_id = $Respuesta;
        
            }
            if($not_ot_id!==""){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax  = new CRUD();
                $Respuesta = $InstanciaAjax->genera_novedad_ot($not_origen_novedad, $not_tipo_novedad, $not_novedad_id, $not_operacion, $not_bus, $ot_tipo, $not_ot_id);
            }
        }

        echo $not_ot_id;

    }

    public function validar_novedades_vincular_ot($a_data)
    {
        $rpta_validar = "";
        $rpta_vacios = "";
        $rpta_ot = "";
        $valores_bus = array_column($a_data, 'bus');
        $valores_unicos = array_unique($valores_bus);
        if(count($valores_unicos)>1){
            $rpta_validar = "Revisar buses diferentes. ";
        }
        foreach ($a_data as $row){
            if( empty($row['componente']) || empty($row['posicion']) || empty($row['falla']) || empty($row['accion']) ){
               $rpta_vacios = 'vacios'; 
            }
            if( $row['ot_id']!==null){
                $rpta_ot = 'existe'; 
            }
        }
        if($rpta_vacios==="vacios"){
            $rpta_validar .= "Revisar campos vacios. ";
        }
        if($rpta_ot==="existe"){
            $rpta_validar .= "Revisar novedades ya vinculadas. ";
        }
        echo $rpta_validar;
    }

    public function validar_novedades_desvincular_ot($a_data)
    {
        $rpta_validar = "";
        $rpta_estado = "";
        $valores_ot = array_column($a_data, 'ot_id');
        $valores_unicos = array_unique($valores_ot);
        if(count($valores_unicos)>1){
            $rpta_validar = "Revisar Nro. OT. ";
        }
        foreach ($a_data as $row){
            if( $row['ot_estado']!=="VINCULADO" ){
               $rpta_estado = 'OTs NO Vinculadas'; 
            }
        }
        $rpta_validar .= $rpta_estado;
        echo $rpta_validar;
    }

    public function vincular_orden_trabajo($ot_id, $a_data)
    {
        $novedad_id = "";
        $ot_actividad_vincular = "";
        $ot_actividad_vincular_edt = "";
        $ot_log = "";
        $ot_estado = "";
        $ot_tipo = "";
        $validar = "";
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD("manto_ots","ot_id",$ot_id);

        foreach ($Respuesta as $row){
            $ot_log = $row['ot_log'];
            $ot_estado = $row['ot_estado'];
            $ot_actividad_vincular_edt = $row['ot_actividad_vincular'];
            $ot_tipo = $row['ot_tipo'];
            $ot_bus = $row['ot_bus'];
        }

        if($ot_estado==="CERADO"){
            $msq_error_estado = "Revisar Estado de la OT";
            $validar = "invalido";
        }

        foreach ($a_data as $row){
            if($row['bus']!==$ot_bus){
                $msq_error_bus = "Revisar Buses";
                $validar = "invalido";
            }
        }

        if($validar==="invalido"){
            echo $msq_error_estado." ".$msq_error_bus;
            exit();
        }else{
            foreach ($a_data as $row){
                if($novedad_id===""){
                    $novedad_id = $row['id'];
                }else{
                    $novedad_id .= " , ".$row['id'];
                }
                if($ot_actividad_vincular===""){
                    $ot_actividad_vincular = $row['ot_accion'];
                }else{
                    $ot_actividad_vincular .= " ".$row['ot_accion'];
                }
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax = new CRUD();
                $Respuesta = $InstanciaAjax->vincular_novedad_ot($row['origen'], $row['tipo_novedad'], $row['id'], $row['operacion'], $row['bus'], $ot_tipo, $ot_id);
            }
    
            $ot_actividad_vincular = $ot_actividad_vincular." ".$ot_actividad_vincular_edt;
            
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->vincular_orden_trabajo($ot_id, $ot_actividad_vincular, $ot_estado, $ot_log, $novedad_id);
            echo "se vinculo";
        }
    }

    public function desvincular_orden_trabajo($a_data)
    {
        $novedad_id = "";
        $ot_log = "";
        $ot_estado = "";
        $ot_id = "";

        foreach ($a_data as $row){
            $ot_id = substr($row['ot_id'],3,15);
            if($novedad_id===""){
                $novedad_id = $row['id'];
            }else{
                $novedad_id .= " , ".$row['id'];
            }
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->desvincular_novedad_ot($row['origen'], $row['tipo_novedad'], $row['id'], $row['operacion'], $row['bus'], $row['ot_id'], $row['ot_estado']);
        }
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD("manto_ots", "ot_id", $ot_id);
        
        foreach ($Respuesta as $row){
            $ot_log = $row['ot_log'];
            $ot_estado = $row['ot_estado'];
        }
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->desvincular_orden_trabajo($ot_id, $ot_estado, $ot_log, $novedad_id);
        
        echo "se desvinculo"; 
    }

    public function recodificar_novedad($nope_tipo_novedad, $nope_novedad_id, $nope_componente, $nope_posicion, $nope_falla, $nope_accion)
    {
        echo "llego a logico";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->eliminar_codificar_novedad($nope_tipo_novedad, $nope_novedad_id);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->codificar_novedad($nope_tipo_novedad, $nope_novedad_id, $nope_componente, $nope_posicion, $nope_falla, $nope_accion);
    }
}