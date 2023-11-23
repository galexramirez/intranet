<?php
session_start();
class Logico
{
    var $Modulo = "Inasistencias";

    public function Contenido($NombreDeModuloVista)
    {
        MView($this->Modulo, 'local_view', compact('NombreDeModuloVista'));
    }
    
    ///:: COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

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

	public function DocumentRoot()
    {
        $miCarpeta = '';
        $miHost    = $_SERVER['HTTP_HOST'];
        $miReferer = $_SERVER['HTTP_REFERER'];
        $miCarpeta = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
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

    public function select_tipos($operacion, $tipo)
	{
		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax  = new CRUD();
		$Respuesta      = $InstanciaAjax->select_tipos($operacion, $tipo);

		$html = '<option value="">Seleccione una opcion</option>';

		foreach ($Respuesta as $row) {
			$html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
		}
		echo $html;
	}

    public function detalle_control_facilitador($Nove_ProgramacionId,$Novedad_Id)
    {
        $html = "";

        $TablaBD = "OPE_Novedad";
        $CampoBD = "Novedad_Id";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Novedad_Id);
        foreach ($Respuesta as $row) {
            $Nove_CFaRgId = $row['Nove_CFaRgId'];
        }

        $TablaBD = "OPE_ControlFacilitadorRegistroCarga";
        $CampoBD = "CFaRg_Id";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Nove_CFaRgId);
        foreach ($Respuesta as $row) {
            $CFaRg_Estado = $row['CFaRg_Estado'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        if($CFaRg_Estado=="GENERADO"){
            $Respuesta=$InstanciaAjax->detalle_control_facilitador($Nove_ProgramacionId, $Novedad_Id);
        }
        if($CFaRg_Estado=="CERRADO"){
            $Respuesta=$InstanciaAjax->detalle_control_facilitador_hist($Nove_ProgramacionId, $Novedad_Id);
        }

        foreach ($Respuesta as $row) {
                $html .= '<div class="card border-success mb-3">';
                $html .=    '<div class="card-body card-novedades">
                                <div class="row align-items-end">
                                    <div class="col-lg-4">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">NOMBRES Y APELLIDOS</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_NombreColaborador'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">TABLA</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_Tabla'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">BUS</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_Bus'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">SERVICIO</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_Servicio'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">H. ORIGEN</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_HoraOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">H. DESTINO</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_HoraDestino'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">L. ORIGEN</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_LugarOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">L. DESTINO</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_LugarDestino'] . '</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">SERVICIO BUS</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_ServBus'] . '</label>
                                        </div> 
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">TIPO DE EVENTO</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_TipoEvento'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">KM.</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_KmXPuntos'] . '</label>
                                        </div>
                                    </div>    
                                </div>   
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">TIPO DE TABLA</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_TipoTabla'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-7">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label form-control-sm">OBSERVACIONES</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_Observaciones'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-3">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label form-control-sm">GENERADO POR</label>
                                            <label for="" class="form-control form-control-sm">' . $row['CFaci_UsuarioId'] . '</label>
                                        </div>            
                                    </div>    
                                </div>
                            </div>';
                $html .= '</div>';
                $html .= '<div class="card mb-3">';
                $html .=    '<div class="card-header">
                                <div class="row align-items-end">
                                    <div class="col-lg-12">    	
                                        <h6 class="card-title">'.$row['Novedad_Id'] . " | " . $row['Nove_Novedad'] . " | " . $row['Nove_TipoNovedad'] . " | " . $row['Nove_DetalleNovedad'] . " | Generado por: " . $row['Nove_UsuarioId'] .'</h6>
                                    </div>
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-12">    
                                        <p class="form-text">' . $row['Nove_Descripcion'] . '</p>
                                    </div>    
                                </div>
                            </div>';
                $html .= '</div>';
        }
        echo $html;
    }

    public function select_tabla($Prog_Fecha, $operacion)
    {
        $cfarg_estado = "";
        $TablaBD = "OPE_ControlFacilitadorRegistroCarga";
        $CampoBD = "CFaRg_FechaCargada";

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Prog_Fecha);
        
        foreach ($Respuesta as $row) {
            if($row['CFaRg_TipoOperacionCargada']==$operacion && $row['CFaRg_Estado']!='ELIMINADO'){
                $cfarg_estado = $row['CFaRg_Estado'];
            };
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        if($cfarg_estado=="CERRADO"){
            $Respuesta      = $InstanciaAjax->select_tabla_hist($Prog_Fecha, $operacion);
        }
        if($cfarg_estado=="GENERADO"){
            $Respuesta      = $InstanciaAjax->select_tabla($Prog_Fecha, $operacion);
        }
        
        $html = '<option value="">Seleccione una opcion</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Tabla'].'">'.$row['Tabla'].'</option>';
        }    

        echo $html;
    }

    public function select_bus($operacion)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->select_bus($operacion);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Bus'].'">'.$row['Bus'].'</option>';
        }
        echo $html;
    }

    public function buscar_servicio($Prog_Fecha,$Prog_Tabla)
    {
        $estado_cerrado = "";
        $estado_generado = "";
        $TablaBD = "OPE_ControlFacilitadorRegistroCarga";
        $CampoBD = "CFaRg_FechaCargada";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Prog_Fecha);
        
        foreach ($Respuesta as $row) {
            if($row['CFaRg_Estado']=='CERRADO'){
                $estado_cerrado = "CERRADO";
            };
            if($row['CFaRg_Estado']=='GENERADO'){
                $estado_generado = "GENERADO";
            };
        }

        $Servicio = '';

        if($estado_cerrado=="CERRADO"){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->buscar_servicio_hist($Prog_Fecha,$Prog_Tabla);
            foreach ($Respuesta as $row) {
                $Servicio = $row['Prog_Servicio'];
            }
        }
        if($estado_generado=="GENERADO"){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->buscar_servicio($Prog_Fecha,$Prog_Tabla);
            foreach ($Respuesta as $row) {
                $Servicio = $row['Prog_Servicio'];
            }
        }
        echo $Servicio;
    }

    public function estado_inasistencias($inasistencias_id)
    {
        $estado_inasistencias = "";
        $TablaBD = "ope_inasistencias";
        $CampoBD = "inasistencias_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$inasistencias_id);

        foreach ($Respuesta as $row) {
            $estado_inasistencias = $row['inas_estadoinasistencias'];
        }
        echo $estado_inasistencias;
    }

    public function crear_inasistencias($inas_programacionid, $inas_novedadid, $inasistencias_id, $inas_tiponovedad, $inas_detallenovedad, $inas_fechaoperacion,$inas_nombrecolaborador, $inas_descripcion, $inas_tabla, $inas_servicio, $inas_bus, $inas_nombrecgo, $inas_lugarexacto, $inas_horainicio, $inas_horafin, $inas_totalhoras, $inas_obs_log, $inas_estadoinasistencias, $inas_lugar_origen, $inas_lugar_destino)
    {
        $inasistencias_id = $inas_novedadid;
        /* $TablaBD = "OPE_ControlFacilitador";
        $CampoBD = "Programacion_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$inas_programacionid);
        foreach ($Respuesta as $row) {
            $inas_controlfacilitadorid  = $row['ControlFacilitador_Id'];
            $inas_operacion             = $row['Prog_Operacion'];
            $inas_cfargid               = $row['CFaRg_Id'];
            $inas_turno                 = $row['Prog_TipoTabla'];
        } */

        $TablaBD = "OPE_Novedad";
        $CampoBD = "Novedad_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$inas_novedadid);
        foreach ($Respuesta as $row) {
            $inas_openovedadid  = $row['OPE_NovedadId'];
            $inas_novedad       = $row['Nove_Novedad'];
            $inas_operacion     = $row['Nove_Operacion'];
            $inas_cfargid       = $row['Nove_CFaRgId'];
        }

        $TablaBD = "OPE_ControlFacilitadorRegistroCarga";
        $CampoBD = "CFaRg_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD, $CampoBD, $inas_cfargid);
        
        foreach ($Respuesta as $row) {
            $CFaRg_Estado = $row['CFaRg_Estado'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        if($CFaRg_Estado=="CERRADO"){
            $Respuesta=$InstanciaAjax->control_facilitador_id_hist($inas_programacionid);
        }
        if($CFaRg_Estado=="GENERADO"){
            $Respuesta=$InstanciaAjax->control_facilitador_id($inas_programacionid);
        }
        
        foreach ($Respuesta as $row) {
            $inas_controlfacilitadorid = $row['ControlFacilitador_Id'];
            $inas_turno                = $row['Prog_TipoTabla'];
        }

        $TablaBD = "colaborador";
        $CampoBD = "colab_apellidosnombres";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$inas_nombrecolaborador);
        foreach ($Respuesta as $row) {
            $inas_dni               = $row['Colaborador_id'];
            $inas_codigocolaborador = $row['Colab_CodigoCortoPT'];
            $inas_cargo_colaborador = $row['Colab_CargoActual'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$inas_nombrecgo);
        foreach ($Respuesta as $row) {
            $inas_codigocgo = $row['Colaborador_id'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->crear_inasistencias($inas_programacionid, $inas_novedadid, $inasistencias_id, $inas_tiponovedad, $inas_detallenovedad, $inas_fechaoperacion, $inas_nombrecolaborador, $inas_descripcion, $inas_tabla, $inas_servicio, $inas_bus, $inas_nombrecgo, $inas_lugarexacto, $inas_horainicio,$inas_horafin,$inas_totalhoras, $inas_controlfacilitadorid, $inas_operacion, $inas_cfargid, $inas_openovedadid, $inas_novedad, $inas_dni, $inas_codigocolaborador,$inas_codigocgo, $inas_estadoinasistencias, $inas_turno, $inas_cargo_colaborador, $inas_obs_log, $inas_lugar_origen, $inas_lugar_destino);
    }

    public function editar_inasistencias($inasistencias_id, $inas_tiponovedad, $inas_detallenovedad, $inas_fechaoperacion, $inas_nombrecolaborador, $inas_descripcion, $inas_tabla, $inas_servicio, $inas_bus, $inas_nombrecgo, $inas_lugarexacto, $inas_horainicio, $inas_horafin, $inas_totalhoras, $inas_obs_log, $inas_estadoinasistencias, $inas_lugar_origen, $inas_lugar_destino)
    {
        $TablaBD = "colaborador";
        $CampoBD = "colab_apellidosnombres";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$inas_nombrecolaborador);
        foreach ($Respuesta as $row) {
            $inas_dni               = $row['Colaborador_id'];
            $inas_codigocolaborador = $row['Colab_CodigoCortoPT'];
            $inas_cargo_colaborador = $row['Colab_CargoActual'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$inas_nombrecgo);
        foreach ($Respuesta as $row) {
            $inas_codigocgo = $row['Colaborador_id'];
        }

        $TablaBD = "ope_inasistencias";
        $CampoBD = "inasistencias_id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$inasistencias_id);
        foreach ($Respuesta as $row) {
            $inas_log = $row['inas_log'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->editar_inasistencias($inasistencias_id, $inas_tiponovedad, $inas_detallenovedad, $inas_fechaoperacion, $inas_nombrecolaborador,$inas_descripcion, $inas_tabla, $inas_servicio, $inas_bus, $inas_nombrecgo, $inas_lugarexacto, $inas_horainicio, $inas_horafin, $inas_totalhoras, $inas_dni,$inas_codigocolaborador, $inas_codigocgo, $inas_estadoinasistencias, $inas_cargo_colaborador, $inas_obs_log, $inas_log, $inas_lugar_origen, $inas_lugar_destino);

    }

}