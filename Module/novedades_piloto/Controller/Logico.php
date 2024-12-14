<?php
session_start();
class Logico
{
    var $Modulo = "novedades_piloto";

    public function Contenido($NombreDeModuloVista)
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

    public function ver_inasistencias($inasistencias_id)
    {
        $html       = "";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->ver_inasistencias($inasistencias_id);
        foreach ($Respuesta as $row) {
            $html = '   <div class="modal-body">
                            <div class="row align-items-end">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">INASISTENCIAS ID</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inasistencias_id'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">TIPO NOVEDAD</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_tiponovedad'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">FECHA</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_fechaoperacion'].'</span>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">NOMBRE DE PILOTO</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_nombrecolaborador'].'</span>
                                    </div> 
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-12">
                                    <span class="col-form-label form-control-sm font-weight-bold">DESCRIPCION DE NOVEDAD</span>
                                    <div class="form-control-sm overflow-auto h-100 border border-muted border-radius rounded">'.$row['inas_descripcion'].'</div>
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">TABLA</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_tabla'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">SERVICIO</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_servicio'].'</span>
                                    </div> 
                                </div>	
                                <div class="col-lg-2">    
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">BUS</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_bus'].'</span>
                                    </div>            
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">PERSONAL QUE REPORTA</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_nombrecgo'].'</span>
                                    </div> 
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">LUGAR EXACTO / ESTACION O PAREDERO DE REFERENCIA</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_lugarexacto'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">LUGAR ORIGEN</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_lugar_origen'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">LUGAR DESTINO</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_lugar_destino'].'</span>
                                    </div> 
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">H. INICIO</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_horainicio'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">H. FIN</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_horafin'].'</span>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">TOTAL HORAS</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_totalhoras'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">DETALLE NOVEDAD</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_detallenovedad'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">ESTADO</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_estadoinasistencias'].'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">PERSONAL QUE SUSCRIBE LA INFORMACION</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['Colab_ApellidosNombres'].'</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">FECHA Y HORA DE ELABORACION</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['inas_fechaedicion'].'</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
        echo $html;
    }

    public function ver_comportamiento($comportamiento_id)
    {
        $html       = "";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->ver_comportamiento($comportamiento_id);
        foreach ($Respuesta as $row) {
            $html = '   <div class="modal-body">
                            <div class="row align-items-end">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">COMPORTAMIENT.ID</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comportamiento_id'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                          <span class="col-form-label form-control-sm font-weight-bold">TIPO NOVEDAD</span>
                                          <span class="form-control form-control-sm" font-weight-normal>'.$row['comp_tiponovedad'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">FECHA</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_fechaoperacion'].'</span>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">NOMBRE DE PILOTO</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_nombrecolaborador'].'</span>
                                    </div> 
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">DESCRIPCION DE NOVEDAD</span>
                                        <div class="form-control-sm overflow-auto h-100 border border-muted border-radius rounded">'.$row['comp_descripcion'].'</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">TABLA</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_tabla'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                          <span class="col-form-label form-control-sm font-weight-bold">SERVICIO</span>
                                          <span class="form-control form-control-sm font-weight-normal">'.$row['comp_servicio'].'</span>
                                    </div> 
                                </div>	
                                <div class="col-lg-2">    
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">BUS</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_bus'].'</span>
                                    </div>            
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">PERSONAL QUE REPORTA</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_nombrecgo'].'</span>
                                    </div> 
                                </div>
                              </div>
                              <div class="row align-items-end">
                                  <div class="col-lg-6">
                                      <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">LUGAR EXACTO / ESTACION O PRADERO DE REFERENCIA</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_lugarexacto'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">LUGAR ORIGEN</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_lugar_origen'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">LUGAR DESTINO</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_lugar_destino'].'</span>
                                          </select>
                                    </div> 
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">HORA INICIO</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_horainicio'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">HORA FIN</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_horafin'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">TOTAL HORAS</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_total_horas'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">DETALLE NOVEDAD</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_detallenovedad'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">ESTADO</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_estadocomportamiento'].'</span>
                                    </div> 
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-2">    
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">RECON.RESPONSAB</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_reconoceresponsabilidad'].'</span>
                                    </div>            
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">MONTO S/.</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_monto'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">LINK VIDEO</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_linkvideo'].'</span>
                                    </div> 
                                </div>
                                <div class="col-lg-2">    
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">CODIGO FALTA</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_codigofalta'].'</span>
                                    </div>            
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">FALTA COMETIDA</span>
                                        <div class="form-control-sm overflow-auto h-100 border border-muted border-radius rounded">'.$row['comp_faltacometida'].'</div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row align-items-end">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">PERSONAL QUE SUSCRIBE INFORMACION</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['Colab_ApellidosNombres'].'</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <span class="col-form-label form-control-sm font-weight-bold">FECHA Y HORA DE ELABORACION</span>
                                        <span class="form-control form-control-sm font-weight-normal">'.$row['comp_fechaedicion'].'</span>
                                    </div>
                                </div>
                            </div>
                        </div> ';
        }
        echo $html;
    }

    function crear_novedad_carga($input_file_name, $anio)
	{
        require_once 'Services/Composer/vendor/autoload.php';
		$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($input_file_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($input_file_name);
		$worksheet = $spreadsheet->getActiveSheet();
		$highestRow = $worksheet->getHighestRow();
        $noco_fecha = date('Y-m-d H:i:s');
        $noco_codigo_carga = date('Ymd-'.substr((string)microtime(), 1, 8));
        $noco_codigo_carga = str_replace(".", "", $noco_codigo_carga);
        $noco_usuario_id = $_SESSION['USUARIO_ID'];
        for ($row = 2; $row <= $highestRow; $row++) {
            $noco_novedad_id = date('Ymd-'.substr((string)microtime(), 1, 8));
            $noco_novedad_id = str_replace(".", "", $noco_novedad_id);    
            $noco_colaborador_id    = $worksheet->getCell('B'.$row)->getValue();
            $noco_novedad           = $worksheet->getCell('D'.$row)->getValue();
            $noco_fecha_inicio      = $worksheet->getCell('E'.$row)->getValue();
            $noco_fecha_fin         = $worksheet->getCell('F'.$row)->getValue();
			$UNIX_DATE = ($noco_fecha_inicio - 25569) * 86400;
            $noco_fecha_inicio =gmdate("Y-m-d", $UNIX_DATE);
            $UNIX_DATE = ($noco_fecha_fin - 25569) * 86400;
            $noco_fecha_fin =gmdate("Y-m-d", $UNIX_DATE);
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->crear_novedad_detalle($noco_novedad_id, $noco_colaborador_id, $noco_novedad, $noco_fecha_inicio, $noco_fecha_fin, $noco_codigo_carga);
            
            if ($Respuesta==false) {
                $CantErrores=$CantErrores+1;
                echo "No grabo linea ".$row." -> Fecha Inicio: ".$noco_fecha_inicio." - DNI : ".$noco_colaborador_id." - Novedad : ".$noco_novedad."<hr>"  ;
            }
        }
        $noco_registros = $highestRow-$CantErrores-1;
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->crear_novedad_carga($noco_codigo_carga, $noco_fecha, $noco_registros, $noco_usuario_id);
        
        echo "Se cargaron ".($noco_registros)." de ".($highestRow-1);

	}

}
