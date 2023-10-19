<?php
session_start();
class Logico
{
    var $Modulo = "Comportamiento";
    // 1.0 CARGA PANTALLA PRINCIPAL DEL MODULO
    public function Contenido($NombreDeModuloVista)
    {
        MView($this->Modulo, 'local_view', compact('NombreDeModuloVista'));
    }
    
    //::::::::::::::::::::::::::::::::::::::::: COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::://

    public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

	function DocumentRoot()
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

    public function DetalleControlFacilitador($Nove_ProgramacionId,$Novedad_Id)
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
            $Respuesta=$InstanciaAjax->DetalleControlFacilitador($Nove_ProgramacionId, $Novedad_Id);
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
                                            <label for="" class="col-form-label form-control-sm">Servicio BUS</label>
                                            <label for="" class="form-control" form-control-sm>' . $row['Prog_ServBus'] . '</label>
                                        </div> 
                                    </div>    
                                    <div class="col-lg-3">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label form-control-sm">TIPO DE EVENTO</label>
                                            <label for="" class="form-control form-control-sm">' . $row['Prog_TipoEvento'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-1">
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
                                        <p class="form-text form-control-sm">' . $row['Nove_Descripcion'] . '</p>
                                    </div>    
                                </div>
                            </div>';
                $html .= '</div>';
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

    public function EstadoComportamiento($comportamiento_id)
    {
        $estadocomportamiento = "";
        $TablaBD = "ope_comportamiento";
        $CampoBD = "comportamiento_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$comportamiento_id);

        foreach ($Respuesta as $row) {
            $estadocomportamiento = $row['comp_estadocomportamiento'];
        }
        echo $estadocomportamiento;
    }

    public function CrearComportamiento($comp_programacionid, $comp_novedadid, $comp_tiponovedad, $comp_fechaoperacion, $comp_nombrecolaborador, $comp_descripcion, $comp_tabla, $comp_servicio, $comp_bus, $comp_nombrecgo, $comp_lugarexacto, $comp_lugar_origen, $comp_lugar_destino, $comp_horainicio, $comp_horafin, $comp_total_horas, $comp_detallenovedad, $comp_estadocomportamiento, $comp_reconoceresponsabilidad, $comp_grado_falta, $comp_codigofalta, $comp_faltacometida, $comp_monto, $comp_linkvideo, $comp_obs_log, $comp_operacion)
    {

        $comportamiento_id = $comp_novedadid;
        /*$TablaBD = "OPE_ControlFacilitador";
        $CampoBD = "Programacion_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$comp_programacionid);
        foreach ($Respuesta as $row) {
            $comp_controlfacilitadorid  = $row['ControlFacilitador_Id'];
            $comp_cfargid               = $row['CFaRg_Id'];
            $comp_turno                 = $row['Prog_TipoTabla'];
        }*/

        $TablaBD = "OPE_Novedad";
        $CampoBD = "Novedad_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$comp_novedadid);
        foreach ($Respuesta as $row) {
            $comp_openovedadid  = $row['OPE_NovedadId'];
            $comp_novedad       = $row['Nove_Novedad'];
            $comp_tipoorigen    = $row['Nove_TipoOrigen'];
            $comp_cfargid       = $row['Nove_CFaRgId'];
        }

        $TablaBD = "OPE_ControlFacilitadorRegistroCarga";
        $CampoBD = "CFaRg_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD, $CampoBD, $comp_cfargid);
        
        foreach ($Respuesta as $row) {
            $CFaRg_Estado = $row['CFaRg_Estado'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        if($CFaRg_Estado=="CERRADO"){
            $Respuesta=$InstanciaAjax->control_facilitador_id_hist($comp_programacionid);
        }
        if($CFaRg_Estado=="GENERADO"){
            $Respuesta=$InstanciaAjax->control_facilitador_id($comp_programacionid);
        }
        
        foreach ($Respuesta as $row) {
            $comp_controlfacilitadorid = $row['ControlFacilitador_Id'];
            $comp_turno                = $row['Prog_TipoTabla'];
        }

        $TablaBD = "colaborador";
        $CampoBD = "Colab_ApellidosNombres";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$comp_nombrecolaborador);
        foreach ($Respuesta as $row) {
            $comp_dni               = $row['Colaborador_id'];
            $comp_codigocolaborador = $row['Colab_CodigoCortoPT'];
            $comp_cargo_colaborador = $row['Colab_CargoActual'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$comp_nombrecgo);
        foreach ($Respuesta as $row) {
            $comp_codigocgo = $row['Colaborador_id'];
        }

        if($comp_estadocomportamiento=="CIERRE OPERACIONAL"){
            $comp_reportegdh="SI";
            $comp_premio = "NO";
        }else{
            $comp_reportegdh="NO";
            $comp_premio = "SI";
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        
        $Respuesta=$InstanciaAjax->CrearComportamiento($comportamiento_id, $comp_programacionid, $comp_novedadid, $comp_tiponovedad, $comp_fechaoperacion, $comp_nombrecolaborador,$comp_descripcion, $comp_tabla, $comp_servicio, $comp_bus, $comp_nombrecgo, $comp_lugarexacto, $comp_lugar_origen, $comp_lugar_destino, $comp_horainicio, $comp_horafin, $comp_total_horas, $comp_detallenovedad, $comp_estadocomportamiento, $comp_reconoceresponsabilidad, $comp_grado_falta, $comp_codigofalta, $comp_faltacometida, $comp_monto, $comp_linkvideo, $comp_obs_log, $comp_operacion, $comp_controlfacilitadorid, $comp_cfargid, $comp_turno, $comp_openovedadid, $comp_novedad, $comp_tipoorigen, $comp_dni, $comp_codigocolaborador, $comp_cargo_colaborador, $comp_codigocgo, $comp_reportegdh, $comp_premio);

    }

    public function EditarComportamiento($comportamiento_id, $comp_tiponovedad, $comp_fechaoperacion, $comp_nombrecolaborador, $comp_descripcion, $comp_tabla, $comp_servicio, $comp_bus, $comp_nombrecgo, $comp_lugarexacto, $comp_lugar_origen, $comp_lugar_destino, $comp_horainicio, $comp_horafin, $comp_totalhoras, $comp_detallenovedad, $comp_estadocomportamiento, $comp_reconoceresponsabilidad, $comp_grado_falta, $comp_codigofalta, $comp_faltacometida, $comp_monto, $comp_linkvideo, $comp_obs_log)
    {

        $TablaBD = "colaborador";
        $CampoBD = "Colab_ApellidosNombres";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$comp_nombrecolaborador);
        foreach ($Respuesta as $row) {
            $comp_dni               = $row['Colaborador_id'];
            $comp_codigocolaborador = $row['Colab_CodigoCortoPT'];
            $comp_cargo_colaborador = $row['Colab_CargoActual'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$comp_nombrecgo);
        foreach ($Respuesta as $row) {
            $comp_codigocgo = $row['Colaborador_id'];
        }

        if($comp_estadocomportamiento=="CIERRE OPERACIONAL"){
            $comp_reportegdh="SI";
            $comp_premio = "NO";
        }else{
            $comp_reportegdh="NO";
            $comp_premio = "SI";
        }

        $TablaBD = "ope_comportamiento";
        $CampoBD = "comportamiento_id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$comportamiento_id);
        foreach ($Respuesta as $row) {
            $comp_log = $row['comp_log'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        
        $Respuesta=$InstanciaAjax->EditarComportamiento($comportamiento_id, $comp_tiponovedad, $comp_fechaoperacion, $comp_nombrecolaborador,$comp_descripcion, $comp_tabla, $comp_servicio, $comp_bus, $comp_nombrecgo, $comp_lugarexacto, $comp_lugar_origen, $comp_lugar_destino, $comp_horainicio, $comp_horafin, $comp_totalhoras, $comp_detallenovedad, $comp_estadocomportamiento, $comp_reconoceresponsabilidad, $comp_grado_falta, $comp_codigofalta, $comp_faltacometida, $comp_monto, $comp_linkvideo, $comp_obs_log,  $comp_dni, $comp_codigocolaborador, $comp_cargo_colaborador, $comp_codigocgo, $comp_reportegdh, $comp_premio, $comp_log);

    }

    public function ExisteFechaOperacion($tlmtcarga_fechaoperacion)
    {
        $rpta_fechaoperacion = "NO";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->ExisteFechaOperacion($tlmtcarga_fechaoperacion);
        
        if (count($Respuesta)>0) {
            $rpta_fechaoperacion = 'SI';
        }
        echo $rpta_fechaoperacion;
    }

    function CrearTelemetriaCarga($inputFileName,$Anio,$telemetriacarga_fechaoperacion)
    {

        require_once 'Services/Composer/vendor/autoload.php';
          /**  Identify the type of $inputFileName  **/
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
         /**  Create a new Reader of the type that has been identified  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
         /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);
         /**  Hoja de trabajo de Excel  **/
        $worksheet = $spreadsheet->getActiveSheet();
         /**   Get the highest row number and column letter referenced in the worksheet   **/
        $highestRow = $worksheet->getHighestRow(); // e.g. 10

        $tlmtcarga_fechaoperacion = $telemetriacarga_fechaoperacion;

        // Se asigna el siguiente Id de ope_telemtriacarga
        $TablaBD = 'ope_telemetriacarga';
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD;
        $Respuesta=$InstanciaAjax->TablaVacia($TablaBD);
    
        foreach ($Respuesta as $row) {
            if ($row['Contar']==0) {
                $telemetriacarga_id = '1';
            } else {
                $TablaBD="ope_telemetriacarga";
                $CampoId="telemetriacarga_id";
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $MaxId = $InstanciaAjax->MaxId($TablaBD, $CampoId);
                foreach ($MaxId as $row) {
                    $telemetriacarga_id = $row['MaxId']+1;
                }
            }
        }

        // Se asigna el siguiente Id de ope_comportamiento
        $TablaBD = 'ope_comportamiento';
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD;
        $Respuesta=$InstanciaAjax->TablaVacia($TablaBD);
    
        foreach ($Respuesta as $row) {
            if($row['Contar']==0){
                $comportamiento_id = '22226';
            }else{
                $CampoId="comportamiento_id";
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $MaxId = $InstanciaAjax->MaxId($TablaBD,$CampoId);
                foreach ($MaxId as $row) {
                    $comportamiento_id = $row['MaxId']+1;
                }
            }
        }

        // Se inicializan las variables que no se registran en el archivo excel
        $comp_telemetriacargaid = $telemetriacarga_id;
        $comp_reportegdh = "SI";
        $comp_fechareportegdh = date("Y-m-d");
        $comp_tipoorigen = "TELEMETRIA";
        $comp_reconoceresponsabilidad = "NO";
        $comp_estadocomportamiento = "REPORTADO A GDH";
        $comp_codigocgo = $_SESSION['USUARIO_ID'];
        $comp_nombrecgo = ""; //falta busqueda
        $comp_novedad = "NOVEDAD_PILOTO";
        $comp_tiponovedad = "COMPORTAMIENBTO";
        $comp_detallenovedad = "NORMA_TRANSITO";
        $comp_programacionid = "0";
        $comp_controlfacilitadorid = "0";
        $comp_openovedadid = "0";
        $comp_novedadid = "0";
        $comp_tabla = "";
        $comp_servicio = "";
        $comp_linkvideo = "";
        $comp_premio = "NO";
        $comp_cfargid = "0";
        $comp_fechagenerar = date("Y-m-d H:i:s");

        // Se asigna el siguiente Id de ope_telemtriacarga
        $TablaBD="glo_roles";
        $CampoId="roles_dni";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoId,$comp_codigocgo);
        foreach ($Respuesta as $row) {
            $comp_nombrecgo = $row['roles_apellidosnombres'];
        }

        $CantErrores=0;
        for ($row = 2; $row <= $highestRow; $row++) {
            $comp_bus = $worksheet->getCell('A'.$row)->getValue();
            $comp_dni = $worksheet->getCell('B'.$row)->getValue();
            $comp_codigocolaborador = $worksheet->getCell('C'.$row)->getValue();
            $comp_nombrecolaborador = $worksheet->getCell('D'.$row)->getValue();
            $comp_lugarexacto = $worksheet->getCell('E'.$row)->getValue();
            $comp_fechaoperacion = $worksheet->getCell('F'.$row)->getValue();
            $comp_horainicio = $worksheet->getCell('G'.$row)->getValue();
            $comp_descripcion = $worksheet->getCell('H'.$row)->getValue();
            $comp_codigofalta = $worksheet->getCell('I'.$row)->getValue();
            $comp_faltacometida = $worksheet->getCell('J'.$row)->getValue();
            $comp_monto = $worksheet->getCell('K'.$row)->getValue();
            
            if(substr($comp_bus,0,2)=="21"){
                $comp_operacion = "TRONCAL";
            }else{
                if(substr($comp_bus,0,2)=="22"){
                    $comp_operacion = "ALIMENTADOR";
                }
            }
            $UNIX_DATE = ($comp_fechaoperacion - 25569) * 86400;
            $comp_fechaoperacion =gmdate("Y-m-d", $UNIX_DATE);
            
            $HoraConvertir=$comp_horainicio;
            $UNIX_HOUR = ($HoraConvertir - 25569) * 86400;
            $Horas=gmdate("H", $UNIX_HOUR);
            if ($HoraConvertir>=1) {
                $Horas=$Horas+24;
            }
            $UNIX_HOUR = ($HoraConvertir - 25569) * 86400;
            $Minuto=gmdate("i", $UNIX_HOUR);
            $comp_horainicio=$Horas.":".$Minuto;
            $comp_horafin = $comp_horainicio;

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            
            $Respuesta=$InstanciaAjax->CrearTelemetriaDetalle($comportamiento_id,$comp_programacionid,$comp_controlfacilitadorid,$comp_openovedadid,$comp_novedadid,$comp_novedad,$comp_tiponovedad,$comp_detallenovedad,$comp_descripcion,$comp_operacion,$comp_fechaoperacion,$comp_estadocomportamiento,$comp_dni,$comp_codigocolaborador,$comp_nombrecolaborador,$comp_codigocgo,$comp_nombrecgo,$comp_tabla,$comp_servicio,$comp_bus,$comp_lugarexacto,$comp_horainicio,$comp_horafin,$comp_linkvideo,$comp_codigofalta,$comp_faltacometida,$comp_monto,$comp_reconoceresponsabilidad,$comp_reportegdh,$comp_fechareportegdh,$comp_premio,$comp_cfargid,$comp_tipoorigen,$comp_telemetriacargaid,$comp_fechagenerar);
            
            if ($Respuesta==false) {
                $CantErrores=$CantErrores+1;
                echo "No grabo linea ".$row." -> Piloto: ".$comp_nombrecolaborador." Falta: ".$comp_codigofalta." ERROR en base de datos.<hr>"  ;
            }
        }
        $tlmtcarga_nroregistros = $highestRow-$CantErrores-1;
        if($tlmtcarga_nroregistros>0){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->CrearTelemetriaCarga($tlmtcarga_nroregistros,$tlmtcarga_fechaoperacion);
        }
        echo "Se cargaron ".($highestRow-$CantErrores-1)." de ".($highestRow-1);
    }

    public function select_tabla($prog_fecha, $operacion)
    {
        $cfarg_estado = "";
        $TablaBD = "OPE_ControlFacilitadorRegistroCarga";
        $CampoBD = "CFaRg_FechaCargada";

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$prog_fecha);
        
        foreach ($Respuesta as $row) {
            if($row['CFaRg_TipoOperacionCargada']==$operacion && $row['CFaRg_Estado']!='ELIMINADO'){
                $cfarg_estado = $row['CFaRg_Estado'];
            };
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        if($cfarg_estado=="CERRADO"){
            $Respuesta      = $InstanciaAjax->select_tabla_hist($prog_fecha, $operacion);
        }
        if($cfarg_estado=="GENERADO"){
            $Respuesta      = $InstanciaAjax->select_tabla($prog_fecha, $operacion);
        }
        
        $html = '<option value="">Seleccione una opcion</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Tabla'].'">'.$row['Tabla'].'</option>';
        }    

        echo $html;
    }
}