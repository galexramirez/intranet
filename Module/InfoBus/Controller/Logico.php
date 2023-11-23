<?php
session_start();

class Logico
{
	var $Modulo = "InfoBus";
	// 1.0 CARGA DATOS DE BUSQUEDA DE PILOTO
	function Contenido($NombreDeModuloVista)
	{
    	MView('InfoBus', 'LocalView', compact('NombreDeModuloVista'));
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

	public function BusesInfoBus()
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BusesInfoBus();

        $html = '<option value="">Bus</option>';
        $html = '<option value="TODOS">TODOS</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Buses'].'">'.$row['Buses'].'</option>';
        }
        echo $html;
    }

    public function InfoBusOTs($nro_ot)
    {
        $html = "";
        $valeshtml = "";
        $color = "";
        $tipo_ot = substr($nro_ot,0,1);
        $pnro_ot = substr($nro_ot,2,(strlen($nro_ot)-2));
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->InfoBusOTs($tipo_ot,$pnro_ot);
        foreach ($Respuesta as $row) {
            if($tipo_ot=="C"){
                $cod_ot = $row['cod_ot'];
                $ot_origen = $row['ot_origen'];
                $ot_bus = $row['ot_bus'];
                $ot_cgm_crea =$row['ot_cgm_crea'];
                $ot_date_crea =$row['ot_date_crea'];
                $ot_asociado =$row['ot_asociado'];
                $ot_resp_asoc =$row['ot_resp_asoc'];
                $ot_kilometraje =$row['ot_kilometraje'];
                $ot_hmotor =$row['ot_hmotor'];
                $ot_check =$row['ot_check'];
                $ot_descrip =$row['ot_descrip'];
                $ot_obs_cgm =$row['ot_obs_cgm'];
                $ot_cgm_ct =$row['ot_cgm_ct'];
                $ot_date_ct =$row['ot_date_ct'];
                $ot_inicio =$row['ot_inicio'];
                $ot_fin =$row['ot_fin'];
                $ot_sistema =$row['ot_sistema'];
                $ot_codfalla =$row['ot_codfalla'];
                $ot_at =$row['ot_at'];
                $ot_obs_asoc =$row['ot_obs_asoc'];
                $ot_montado =$row['ot_montado'];
                $ot_dmontado =$row['ot_dmontado'];
                $ot_busdmontado =$row['ot_busdmontado'];
                $ot_busmont =$row['ot_busmont'];
                $ot_motivo =$row['ot_motivo'];
                $ot_componente_raiz =$row['ot_componente_raiz'];
                $ot_tecnico =$row['ot_tecnico'];
                $ot_ca =$row['ot_ca'];
                $ot_date_ca =$row['ot_date_ca'];
                $ot_estado =$row['ot_estado'];
                $ot_obs_aom =$row['ot_obs_aom'];
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
            }else{
                $cod_otpv = $row['cod_otpv'];
                $otpv_semana = $row['otpv_semana'];
                $otpv_turno = $row['otpv_turno'];
                $otpv_date_prog = $row['otpv_date_prog'];
                $otpv_bus = $row['otpv_bus'];
                $otpv_frecuencia = $row['otpv_fecuencia'];
                $otpv_descripcion = $row['otpv_descripcion'];
                $otpv_asociado = $row['otpv_asociado'];
                $otpv_estado = $row['otpv_estado'];
                $otpv_genera = $row['otpv_genera'];
                $otpv_date_genera = $row['otpv_date_genera'];
                $otpv_cierra_ad = $row['otpv_cierra_ad'];
                $otpv_date_cierra_ad = $row['otpv_date_cierra_ad'];
                $otpv_tecnico = $row['otpv_tecnico'];
                $otpv_inicio = $row['otpv_inicio'];
                $otpv_fin = $row['otpv_fin'];
                $otpv_kmrealiza = $row['otpv_kmrealiza'];
                $otpv_hmotor = $row['otpv_hmotor'];
                $otpv_cgm_cierra = $row['otpv_cgm_cierra'];
                $otpv_obs_as = $row['otpv_obs_as'];
                $otpv_obs_cgm = $row['otpv_obs_cgm'];
                $otpv_obs_cierre_ad = $row['otpv_obs_cierre_ad'];
            }
        }

        // SE REVISA SI HAY INFORMACION DE OT CORRECTIVAS CON VALES
        $TablaBD = "manto_vales";
        $CampoBD = "va_ot";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$pnro_ot);
        foreach ($Respuesta as $row) {
            $cod_vale = $row['cod_vale'];
            $va_asociado = $row['va_asociado'];
            $va_estado = $row['va_estado'];
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

        if($tipo_ot=="C"){
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
                                                    <h6 class="font-weight-bold">N° '.$cod_ot.'</h6>
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
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">DESCRIPCION DE LA ACTIVIDAD (Verbo + Detalle)</span>
                                                <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$ot_descrip.'</div>
                                            </div>
                                        </div>
                                        <div class="row align-items-end border border-muted border-radius rounded">
                                            <div class="form-group col-lg-12 mb-1">
                                                <span class="form-control-sm pl-0 mb-0 font-weight-bold">OBSERVACIONES DE CGM (Máximo 200 carácteres)</span>
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
        }else{
            $html = '   <div class="row align-items-end">
                            <div class="col-lg-6">
                                <div class="form-group-sm mb-0" id="div_CodigoOT">
                                    <h4>Código OT: P-'.$cod_otpv.'</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row align-items-end">
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Semana</span> 
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_semana.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">	
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Turno</span> 
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_turno.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">	
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Fecha Prog..</span> 
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_date_prog.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Bus</span> 
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_bus.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">	
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Frec. Prog.:</span> 
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_frecuencia.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end mb-5">	
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Descripción</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <textarea readonly class="form-control form-control-sm mb-1 text-uppercase" rows="3">'.$otpv_descripcion.'</textarea>    
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-3">	
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Asociado</span> 
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_asociado.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">	
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Estado</span> 
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_estado.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">	
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Generado</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_genera.'</span>
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">el</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$otpv_date_genera.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">	
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Ultima Mod.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_cierra_ad.'</span>
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">el</span> 
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">'.$otpv_date_cierra_ad.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row align-items-end">
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Técnico Rp.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_tecnico.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Fecha Inicio</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_inicio.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Fecha Final</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_fin.'</span>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row align-items-end">
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Kilometraje</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_kmrealiza.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">Hora Motor</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_hmotor.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-3">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-bold">CGM Cierra</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group form-control-sm mb-1">
                                            <span class="form-control-sm pl-0 mb-0 font-weight-normal">:&nbsp'.$otpv_cgm_cierra.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-end  pl-3">
                                    <div class="form-group col-lg-10 mb-1">
                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">OBSERVACIONES DE ASOCIADO (Máximo 10000 carácteres)</span>
                                        <textarea class="form-control form-control-sm mb-1 text-uppercase" readonly id="otpv_obs_as" rows="3" placeholder="escribe algo aqui..." maxlength="10000">'.$otpv_obs_as.'</textarea>
                                      </div>
                                    <div class="form-group col-lg-10 mb-1">
                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">OBSERVACIONES DE CGM (Máximo 200 carácteres)</span>
                                        <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$otpv_obs_cgm.'</div>
                                    </div>
                                      <div class="form-group col-lg-10 mb-1">
                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">OBSERVACIONES CIERRE ADMINISTRATIVO</span>
                                        <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$otpv_obs_cierre_ad.'</div>
                                      </div>
                                </div>  											
                            </div>
                        </div>';
        }

        echo $html;
    }

    public function InfoBusVales($nro_ot)
    {
        $html = "";
        $pnro_ot = substr($nro_ot,2,(strlen($nro_ot)-2));
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->InfoBusVales($pnro_ot);
        foreach ($Respuesta as $row) {
            $cod_vale = $row['cod_vale'];
            $va_ot = $row['va_ot'];
            $va_bus = $row['va_bus'];
            $va_descrip = $row['va_descrip'];
            $va_asociado = $row['va_asociado'];
            $va_genera = $row['va_genera'];
            $va_responsable = $row['va_responsable'];
            $va_date_genera = $row['va_date_genera'];
            $va_garantia = $row['va_garantia'];
            $va_cierre_adm = $row['va_cierre_adm'];
            $va_estado = $row['va_estado'];
            $va_date_cierre_adm = $row['va_date_cierre_adm'];
            $va_obs_cgm = $row['va_obs_cgm'];
            $va_obs_aom = $row['va_obs_aom'];
            
            $Repuestoshtml = "";
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta2=$InstanciaAjax->InfoBusDetalleRepuestos($cod_vale);
            foreach ($Respuesta2 as $row) {
                $rv_repuesto = $row['rv_repuesto'];
                $rv_nroserie = $row['rv_nroserie'];
                $rv_desc = $row['rv_desc'];
                $rv_cantidad = $row['rv_cantidad'];
                $rv_unidad = $row['rv_unidad'];
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

    public function DescargarInfoBus($ib_FechaInicio,$ib_FechaTermino,$ib_Bus,$ib_Tipo,$ib_Sistema,$ib_Contenga, $ib_origen)
    {
        /*$micarpeta = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "OTs".$ib_Tipo."_".$date;
        $file_csv = $filename.".csv";
        //$file_out = $micarpeta."/".$file_txt;
        $file_out = "/tmp/".$file_csv;
        $file_put = $micarpeta."/".$file_csv;*/
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->DescargarInfoBus($ib_FechaInicio,$ib_FechaTermino,$ib_Bus,$ib_Tipo,$ib_Sistema,$ib_Contenga, $ib_origen);
        //$Respuesta=$InstanciaAjax->DescargarInfoBus($ib_FechaInicio,$ib_FechaTermino,$ib_Bus,$ib_Tipo,$ib_Sistema,$ib_Contenga, $ib_origen, $file_out);

        $micarpeta = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "OTs".$ib_Tipo."_".$date;
        $file_json = $filename.".json";
        $data=json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);
        echo $filename;
        
        //echo $file_csv;
    }

    function DocumentRoot()
    {
        $miCarpeta = '';
        $miHost = $_SERVER['HTTP_HOST'];
        $miReferer = $_SERVER['HTTP_REFERER'];
        $miCarpeta = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
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

    public function info_bus_km($bus_nro_externo)
    {
        $html = "";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->info_bus_km($bus_nro_externo);

        foreach ($Respuesta as $row) {
            $fecha = date_create($row['fecha']);
            $html  = number_format($row['km'],0,".",",").' AL '.date_format($fecha,"d/m/Y");
        }
        echo $html;
    }

}