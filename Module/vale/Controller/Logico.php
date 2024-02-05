<?php
class Logico
{
	var $Modulo = "vale";

	function Contenido($NombreDeModuloVista)    
	{		
		MView($this->Modulo,'local_view',compact('NombreDeModuloVista') );
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

    public function CalculoFecha($inicio,$calculo)
    {
        $rptaFecha = "";
        switch ($inicio)
        {
            case "hoy":
                if($calculo=="0"){
                    $rptaFecha = date("Y-m-d");
                }
                if($calculo=="H"){
                    $rptaFecha = date("Y-m-d H:i");
                }
                if(strlen($calculo)>1 && ($calculo!="0" || $calculo!="H")){
                    $f = strtotime($calculo);
                    $rptaFecha = date("Y-m-d",$f);
                }
            break;
            
        }
        echo $rptaFecha;
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

    public function DocumentRoot()
    {
        $mi_carpeta = '';
        $mi_host    = $_SERVER['HTTP_HOST'];
        $mi_referer = $_SERVER['HTTP_REFERER'];
        $mi_carpeta = substr($mi_referer,0,strpos($mi_referer,$mi_host)).$mi_host.'/';
        echo $mi_carpeta;
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
			$html .= '<option value="'.$campo_inicial.'">'.$campo_inicial.'</option>';
		}

		foreach ($Respuesta as $row) {
			if($row['detalle']!=$campo_inicial){
				$html .= '<option value="'.$row['detalle'].'">'.$row['detalle'].'</option>';
			}
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
                                    <table id="tabla_ver_detalle_repuestos" class="table table-striped table-bordered table-condensed w-100">
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
                            <div class="col-lg-12 mb-0">
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

    public function generar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_obs_cgm, $va_obs_aom, $va_estado, $va_tipo, $array_data)
	{
        $va_cierre_adm = $_SESSION['USUARIO_ID'];
        $nombre_cierre_adm = $_SESSION['Usua_NombreCorto'];
        $va_ot_id = (int) $va_ot_id;

        $TablaBD = "colaborador";
        $CampoBD = "Colab_nombre_corto";
        if($va_genera!="") {
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_genera);
            foreach ($Respuesta as $row) {
                $va_genera = $row['Colaborador_id'];
            }
        }        

        $va_ruc     = "";
        $TablaBD    = "manto_proveedores";
        $CampoBD    = "prov_razonsocial";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_asociado);
        foreach ($Respuesta as $row) {
            $va_ruc = $row['prov_ruc'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->generar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_obs_cgm, $va_obs_aom, $va_estado, $nombre_cierre_adm, $va_tipo, $va_ruc);

        $vr_vale_id = $Respuesta;

        foreach($array_data as $row){
            $vr_id                  = $row['vr_id'];
            $vr_repuesto            = $row['vr_repuesto'];
            $vr_cod_patrimonial     = $row['vr_cod_patrimonial'];
            $vr_descripcion         = $row['vr_descripcion'];
            $vr_nroserie            = $row['vr_nroserie'];
            $vr_cantidad_requerida  = $row['vr_cantidad_requerida'];
            $vr_cantidad_despachada = $row['vr_cantidad_despachada'];
            $vr_cantidad_utilizada  = $row['vr_cantidad_utilizada'];

            if($vr_repuesto!=""){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->BuscarCodigoRepuesto($vr_repuesto, $va_ruc, $va_date_genera, $va_tipo);
                foreach ($Respuesta as $row2) {
                    $vr_unidad_medida       = $row2['unidad_medida'];
                    $vr_moneda              = $row2['precioprov_moneda']; 
                    $vr_precio              = $row2['precioprov_precio'];
                    $vr_precio_soles        = $row2['precioprov_preciosoles'];
                    $vr_material_id         = $row2['precioprov_materialid'];
                    $vr_precio_proveedor_id = $row2['precioprov_id'];
                    $vr_fecha_vigencia      = $row2['precioprov_fechavigencia'];
                }
            }
    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->crear_detalle_repuestos($vr_vale_id, $vr_id, $vr_repuesto, $vr_cod_patrimonial, $vr_descripcion, $vr_nroserie, $vr_cantidad_requerida, $vr_cantidad_despachada, $vr_cantidad_utilizada, $va_tipo, $vr_unidad_medida, $vr_moneda, $vr_precio, $vr_precio_soles, $vr_material_id, $vr_precio_proveedor_id, $vr_fecha_vigencia);    
        }

        echo $vr_vale_id;
    }

    public function editar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_obs_cgm, $va_obs_aom, $va_estado, $va_tipo, $array_data)
	{
        $va_cierre_adm  = $_SESSION['USUARIO_ID'];
        $nombre_cierre_adm = $_SESSION['Usua_NombreCorto'];
        $va_ot_id = (int) $va_ot_id;

        $TablaBD = "colaborador";
        $CampoBD = "Colab_nombre_corto";

        if($va_genera!=""){
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_genera);
            foreach ($Respuesta as $row) {
                $va_genera = $row['Colaborador_id'];
            }
        }        

        $va_ruc     = "";    
        $TablaBD    = "manto_proveedores";
        $CampoBD    = "prov_razonsocial";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_asociado);
        foreach ($Respuesta as $row) {
            $va_ruc = $row['prov_ruc'];
        }

        $va_log = "";
        $TablaBD    = "manto_vale";
        $CampoBD    = "vale_id";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$vale_id);
        foreach ($Respuesta as $row) {
            $va_log = $row['va_log'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->editar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_obs_cgm, $va_obs_aom, $va_estado, $nombre_cierre_adm, $va_tipo, $va_ruc, $va_log);

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->eliminar_detalle_repuestos($vale_id);

        $vr_vale_id = $vale_id;

        foreach($array_data as $row){
            $vr_id                  = $row['vr_id'];
            $vr_repuesto            = $row['vr_repuesto'];
            $vr_cod_patrimonial     = $row['vr_cod_patrimonial'];
            $vr_descripcion         = $row['vr_descripcion'];
            $vr_nroserie            = $row['vr_nroserie'];
            $vr_cantidad_requerida  = $row['vr_cantidad_requerida'];
            $vr_cantidad_despachada = $row['vr_cantidad_despachada'];
            $vr_cantidad_utilizada  = $row['vr_cantidad_utilizada'];

            if($vr_repuesto!==""){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax  = new CRUD();
                $Respuesta      = $InstanciaAjax->BuscarCodigoRepuesto($vr_repuesto, $va_ruc, $va_date_genera, $va_tipo);
                foreach ($Respuesta as $row2) {
                    $vr_unidad_medida       = $row2['unidad_medida'];
                    $vr_moneda              = $row2['precioprov_moneda']; 
                    $vr_precio              = $row2['precioprov_precio'];
                    $vr_precio_soles        = $row2['precioprov_preciosoles'];
                    $vr_material_id         = $row2['precioprov_materialid'];
                    $vr_precio_proveedor_id = $row2['precioprov_id'];
                    $vr_fecha_vigencia      = $row2['precioprov_fechavigencia'];
                }
            }
    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->crear_detalle_repuestos($vr_vale_id, $vr_id, $vr_repuesto, $vr_cod_patrimonial, $vr_descripcion, $vr_nroserie, $vr_cantidad_requerida, $vr_cantidad_despachada, $vr_cantidad_utilizada, $va_tipo, $vr_unidad_medida, $vr_moneda, $vr_precio, $vr_precio_soles, $vr_material_id, $vr_precio_proveedor_id, $vr_fecha_vigencia);
        }
    }

    public function AutoCompletar($NombreTabla,$NombreCampo, $va_asociado, $va_date_genera, $va_tipo)
    {
        $rpta_autocompletar = [];
        $va_ruc             = "";
        $TablaBD            = "manto_proveedores";
        $CampoBD            = "prov_razonsocial";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_asociado);
        foreach ($Respuesta as $row) {
            $va_ruc = $row['prov_ruc'];
        }

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo, $va_ruc, $va_date_genera, $va_tipo);
        foreach ($Respuesta as $row) {
            $rpta_autocompletar[] = ["value" => $row[$NombreCampo], "label" => "<strong>".$row[$NombreCampo]."</strong> ".$row['precioprov_descripcion'] ];
        }
		echo json_encode($rpta_autocompletar);
    }

    public function BuscarCodigoRepuesto($vr_repuesto, $va_asociado, $va_date_genera, $va_tipo)
    {
        $va_ruc     = "";    
        $TablaBD    = "manto_proveedores";
        $CampoBD    = "prov_razonsocial";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_asociado);
        foreach ($Respuesta as $row) {
            $va_ruc = $row['prov_ruc'];
        }

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarCodigoRepuesto($vr_repuesto, $va_ruc, $va_date_genera, $va_tipo);
        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function descargar_vale($fecha_inicio_listado,$fecha_termino_listado)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->descargar_vale($fecha_inicio_listado,$fecha_termino_listado);

        $mi_carpeta = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date       = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date       = str_replace(".", "", $date);
        $filename   = "Vales_".$date;
        $file_json  = $filename.".json";
        $data       = json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
        file_put_contents($mi_carpeta."/".$file_json, $data);
        echo $filename;
    }

    public function vales_observados()
    {
        $rpta_vales_observados = "";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->vales_observados();

        foreach ($Respuesta as $row){
            if($row['cantidad_vales']!="0"){
                $rpta_vales_observados = $row['cantidad_vales'];
            }
        }

        echo $rpta_vales_observados;
    }
}