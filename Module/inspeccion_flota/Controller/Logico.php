<?php
session_start();
class Logico
{
	var $Modulo="inspeccion_flota";

	public function Contenido($NombreDeModuloVista)    
	{		
		MView($this->Modulo,'local_view',compact('NombreDeModuloVista') );
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
            //$html .= '<option value="'.$campo_inicial.'">'.$campo_inicial.'</option>';
            $html .= "<option value='".$campo_inicial."'>".$campo_inicial."</option>";
		}

		foreach ($Respuesta as $row) {
			if($row['detalle']!=$campo_inicial){
				//$html .= '<option value="'.$row['detalle'].'">'.$row['detalle'].'</option>';
                $html .= "<option value='".$row['detalle']."'>".$row['detalle']."</option>";
			}
		}
		echo $html;
	}

    public function select_codigo_inspeccion($insp_bus_tipo)
	{
		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->select_codigo_inspeccion($insp_bus_tipo);

		$html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
			$html .= '<option value="'.$row['insp_codigo'].'">'.$row['insp_codigo'].' - '.$row['insp_descripcion'].'</option>';
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

    public function buscar_data_bd($tabla, $c_where)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->buscar_data_bd($tabla, $c_where);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
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

    public function CompararFechaActual($fecha)
    {
        $rptaComparar = "";
        $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
        $fecha_entrada = strtotime($fecha);
            
        if($fecha_actual > $fecha_entrada){
            $rptaComparar = "MAYOR";
        }else{
            $rptaComparar = "MENOR IGUAL";
        }
        echo $rptaComparar;
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

    public function dias_diferencia_fechas($inicio,$final)
    {
        $rpta_dias = "";
        $firstDate  = new DateTime($inicio);
        $secondDate = new DateTime($final);
        $intvl = $firstDate->diff($secondDate);
        $rpta_dias = $intvl->days;

        echo $rpta_dias;
    }

    public function AutoCompletar($NombreTabla,$NombreCampo, $va_asociado, $va_date_genera, $va_tipo)
    {
        $rpta_autocompletar = [];
        $va_ruc             = "";
        $TablaBD            = "manto_proveedores";
        $CampoBD            = "prov_razonsocial";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_asociado);
        foreach ($Respuesta as $row) {
            $va_ruc = $row['prov_ruc'];
        }

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo, $va_ruc, $va_date_genera, $va_tipo);
        foreach ($Respuesta as $row) {
            $rpta_autocompletar[] = ["value" => $row[$NombreCampo], "label" => "<strong>".$row[$NombreCampo]."</strong> ".$row['precioprov_descripcion']];
        }
		echo json_encode($rpta_autocompletar);
    }

    public function DocumentRoot()
    {
        $mi_carpeta = '';
        $mi_host    = $_SERVER['HTTP_HOST'];
        $mi_referer = $_SERVER['HTTP_REFERER'];
        $mi_carpeta = substr($mi_referer,0,strpos($mi_referer,$mi_host)).$mi_host.'/';
        echo $mi_carpeta;
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

    public function crear_inspeccion($insp_bus_tipo, $insp_fecha_programada, $insp_seleccion_buses, $a_data)
    {
        $inspeccion_id = '0';
		$insp_usuario_id_genera = $_SESSION['USUARIO_ID'];
		$nombres_usuario 	= $_SESSION['Usua_NombreCorto'];
		$insp_estado 		= 'ABIERTO';
		$insp_fecha_genera = date('Y-m-d H:i:s');
		$insp_log 			= $insp_fecha_genera.' '.$nombres_usuario.' ESTADO: '.$insp_estado;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $inspeccion_id = $InstanciaAjax->crear_inspeccion($insp_fecha_programada, $insp_bus_tipo,  $insp_seleccion_buses,  $insp_usuario_id_genera, $insp_fecha_genera, $insp_estado, $insp_log );

        $insp_detalle_estado = "PENDIENTE";
        if($insp_seleccion_buses=="PARCIAL"){
            foreach($a_data as $row){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax = new CRUD();        
                $Respuesta=$InstanciaAjax->crear_inspeccion_detalle($inspeccion_id, $row, $insp_detalle_estado );
            }
        }else{
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->buscar_data_bd("Buses", "`Bus_Tipo2`='".$insp_bus_tipo."' AND `Bus_Estado`='DISPONIBLE' AND `Bus_Tipo`='UNIDAD' ORDER BY `Bus_NroExterno` ASC");
            foreach($Respuesta as $row){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax = new CRUD();
                $Respuesta=$InstanciaAjax->crear_inspeccion_detalle($inspeccion_id, $row['Bus_NroExterno'], $insp_detalle_estado );
            }
        }
    }

    public function cerrar_inspeccion($inspeccion_id)
    {
		$insp_usuario_id    = $_SESSION['USUARIO_ID'];
        $nombres_usuario 	= $_SESSION['Usua_NombreCorto'];
		$insp_estado 		= 'CERRADO';
		$insp_fecha_registro = date('Y-m-d H:i:s');

        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->BuscarDataBD("manto_inspeccion_detalle", "inspeccion_id", $inspeccion_id);
        $insp_detalle_estado = "NO INSPECCIONADO";
        foreach ($Respuesta as $row) {
			if($row['insp_detalle_estado']=="PENDIENTE"){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax = new CRUD();        
                $Respuesta=$InstanciaAjax->editar_inspeccion_detalle($inspeccion_id, $insp_usuario_id, $insp_fecha_registro, $row['insp_bus'], $insp_detalle_estado);        
            };
		}

        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->buscar_dato("manto_inspeccion_registro", "insp_log", "`inspeccion_id`='".$inspeccion_id."'");
        foreach ($Respuesta as $row) {
			$insp_log = $row['insp_log'];
		}

        $insp_log .= $insp_fecha_registro.' '.$nombres_usuario.' ESTADO: '.$insp_estado;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->cerrar_inspeccion($inspeccion_id, $insp_fecha_registro, $insp_estado, $insp_log, $insp_usuario_id );
    }

    public function anular_inspeccion($inspeccion_id)
    {
		$insp_usuario_id    = $_SESSION['USUARIO_ID'];
        $nombres_usuario 	= $_SESSION['Usua_NombreCorto'];
		$insp_estado 		= 'ANULADO';
		$insp_fecha_registro = date('Y-m-d H:i:s');

        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->BuscarDataBD("manto_inspeccion_detalle", "inspeccion_id", $inspeccion_id);
        $insp_detalle_estado = "ANULADO";
        foreach ($Respuesta as $row) {
			if($row['insp_detalle_estado']=="PENDIENTE"){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax = new CRUD();        
                $Respuesta=$InstanciaAjax->editar_inspeccion_detalle($inspeccion_id, $insp_usuario_id, $insp_fecha_registro, $row['insp_bus'], $insp_detalle_estado);        
            };
		}

        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->buscar_dato("manto_inspeccion_registro", "insp_log", "`inspeccion_id`='".$inspeccion_id."'");
        foreach ($Respuesta as $row) {
			$insp_log = $row['insp_log'];
		}

        $insp_log .= $insp_fecha_registro.' '.$nombres_usuario.' ESTADO: '.$insp_estado;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->anular_inspeccion($inspeccion_id, $insp_fecha_registro, $insp_estado, $insp_log, $insp_usuario_id );
    }

    public function buscar_inspeccion_bus($inspeccion_id, $insp_bus, $tipo_data)
    {
        $html = "";
        $a_data = [];

		MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD("manto_inspeccion_registro","inspeccion_id",$inspeccion_id);

        foreach ($Respuesta as $row){
            $insp_bus_tipo = $row['insp_bus_tipo'];
        }

		MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->bus_inspeccion_codigo($insp_bus_tipo);

        if($tipo_data=="html"){
            foreach ($Respuesta as $row) {
                if($row['insp_bus_tipo']=="ARTICULADO"){
                    $colorBorder =  'border-secondary mb-3';
                }
                if($row['insp_bus_tipo']=="ALIMENTADOR"){
                    $colorBorder =  'border-warning mb-3';
                }	
                $html .=	'<div class="card '.$colorBorder.'">
                                <div class="card-header card_header_codigo_'. $row["insp_codigo"] .'" id="card_header_codigo_'. $row["insp_codigo"] .'">
                                    <div class="d-flex justify-content-between">
                                        <div class="p2">
                                            <h6 class="card-title" id="codigo_'.$row["insp_codigo"].'"> '. $row["insp_codigo"] .'. - '.$row["insp_descripcion"] . '</h6>
                                        </div>
                                        <div class="p2" id="div_thumbs_'.$row["insp_codigo"].'">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-block">
                                    <div class="d-flex justify-content-center">
                                        <div class="col-sm-3 ml-1 d-flex align-items-center justify-content-center bg-success rounded">
                                            <button type="button" class="btn btn-success btn-sm" onclick="f_codigo_correcto('. $row["insp_codigo"] .')">Correcto</a>
                                        </div>
                                        <div class="col-sm-6 ml-1 d-flex align-items-center justify-content-center bg-warning rounded">
                                            <button type="button" class="btn btn-warning btn-sm" onclick="f_codigo_no_inspeccionado('. $row["insp_codigo"] .')">No Inspeccionado</a>
                                        </div>
                                        <div class="col-sm-3 ml-1 d-flex align-items-center justify-content-center bg-danger rounded">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="f_codigo_observado('. $row["insp_codigo"] .')">Observado</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }
            echo $html;    
        }else{
            foreach ($Respuesta as $row) {
                $a_data[] = ["inspeccion_id" => $inspeccion_id, "insp_bus" => $insp_bus, "insp_codigo" => $row['insp_codigo'], "insp_descripcion" => $row['insp_descripcion'], "insp_estado_codigo" => ''];
            }
            print json_encode($a_data, JSON_UNESCAPED_UNICODE);
        }
	}

    public function guardar_inspeccion_bus($a_data_bus, $a_data_movimiento)
    {
		$insp_usuario_id       = $_SESSION['USUARIO_ID'];
		$insp_detalle_estado   = 'CERRADO';
		$insp_fecha_detalle    = date('Y-m-d H:i:s');

        foreach ($a_data_bus as $row) {
            $insp_bus = $row->insp_bus;
            $inspeccion_id = $row->inspeccion_id;
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax = new CRUD();        
            $Respuesta=$InstanciaAjax->guardar_inspeccion_bus($inspeccion_id, $insp_bus, $row->insp_codigo, $row->insp_descripcion, $row->insp_estado_codigo );
        }
        
        foreach ($a_data_movimiento as $row){
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax = new CRUD();        
            $Respuesta = $InstanciaAjax->guardar_inspeccion_movimiento($row->inspeccion_id, $row->insp_bus_tipo, $row->insp_bus, $row->insp_codigo, $row->insp_descripcion, $row->insp_componente, $row->insp_posicion, $row->insp_falla, $row->insp_accion, $insp_fecha_detalle, $insp_usuario_id );
        }
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();        
        $Respuesta=$InstanciaAjax->editar_inspeccion_detalle($inspeccion_id, $insp_usuario_id, $insp_fecha_detalle, $insp_bus, $insp_detalle_estado);
    }

    public function crear_falla($inspeccion_id, $insp_bus_tipo, $insp_bus, $insp_codigo, $insp_descripcion, $insp_componente, $insp_posicion, $insp_falla, $insp_accion)
    {
		$insp_usuario_id = $_SESSION['USUARIO_ID'];
		$insp_fecha    = date('Y-m-d H:i:s');
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();        
        $Respuesta = $InstanciaAjax->guardar_inspeccion_movimiento($inspeccion_id, $insp_bus_tipo, $insp_bus, $insp_codigo, $insp_descripcion, $insp_componente, $insp_posicion, $insp_falla, $insp_accion, $insp_fecha, $insp_usuario_id );

    }

    public function descargar_arbol($insp_bus_tipo)
    {

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->descargar_arbol($insp_bus_tipo);

        $micarpeta = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "ARBOL ".$insp_bus_tipo."_".$date;
        $file_json = $filename.".json";
        $data=json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);
        echo $filename;
    }
}