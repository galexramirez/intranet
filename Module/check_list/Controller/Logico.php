<?php
session_start();
class Logico
{
	var $Modulo="check_list";

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
            $html .= "<option value='".$campo_inicial."'>".$campo_inicial."</option>";
		}

		foreach ($Respuesta as $row) {
			if($row['detalle']!=$campo_inicial){
                $html .= "<option value='".$row['detalle']."'>".$row['detalle']."</option>";
			}
		}
		echo $html;
	}

    public function select_codigo_check_list($chl_bus_tipo)
	{
		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->select_codigo_check_list($chl_bus_tipo);

		$html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
			$html .= '<option value="'.$row['chl_codigo'].'">'.$row['chl_codigo'].' - '.$row['chl_descripcion'].'</option>';
		}
		echo $html;
	}

    public function select_codigo_falla_via($fav_bus_tipo)
	{
		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->select_codigo_falla_via($fav_bus_tipo);

		$html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
			$html .= '<option value="'.$row['fav_codigo'].'">'.$row['fav_codigo'].' - '.$row['fav_descripcion'].'</option>';
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

    public function descargar_arbol($chl_bus_tipo)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->descargar_arbol($chl_bus_tipo);

        $micarpeta = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "ARBOL CHECK LIST ".$chl_bus_tipo."_".$date;
        $file_json = $filename.".json";
        $data=json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);
        echo $filename;
    }

    public function descargar_arbol_falla_via($fav_bus_tipo)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->descargar_arbol_falla_via($fav_bus_tipo);

        $micarpeta = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $filename = "ARBOL FALLA EN VIA ".$fav_bus_tipo."_".$date;
        $file_json = $filename.".json";
        $data=json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);
        echo $filename;
    }

    public function crear_check_list_registro($check_list_id, $chl_fecha, $chl_bus, $chl_kilometraje, $chl_nombre_piloto, $chl_estado, $a_data_observaciones, $a_data_falla_via)
    {
        $chl_usuario_id_genera = $_SESSION['USUARIO_ID'];
        $chl_nombres_usuario = $_SESSION['Usua_NombreCorto'];
        $chl_fecha_genera = date("Y-m-d H:i:s");
        $chl_log = $chl_fecha_genera." ".$chl_estado." ".$chl_nombres_usuario. " CREACION";

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD("colaborador","Colab_ApellidosNombres",$chl_nombre_piloto);
        foreach ($Respuesta as $row){
            $chl_codigo_piloto = $row['Colab_CodigoCortoPT'];
            $chl_dni_piloto = $row['Colaborador_id'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->crear_check_list_registro($check_list_id, $chl_fecha, $chl_bus, $chl_kilometraje, $chl_nombre_piloto, $chl_estado, $chl_usuario_id_genera, $chl_fecha_genera,$chl_dni_piloto, $chl_codigo_piloto, $chl_log );

        foreach ($a_data_observaciones as $row){
            $chl_codigo = $row->chl_codigo;
            $chl_descripcion = $row->chl_descripcion;
            $chl_componente = $row->chl_componente;
            $chl_posicion = $row->chl_posicion;
            $chl_falla = $row->chl_falla;
            $chl_accion = $row->chl_accion;

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->crear_check_list_observaciones($check_list_id, $chl_codigo, $chl_descripcion, $chl_componente, $chl_posicion, $chl_falla, $chl_accion );
        }

        foreach ($a_data_falla_via as $row){
            $fav_novedad_id = $row->fav_novedad_id;
            $fav_descripcion_novedad = $row->fav_descripcion_novedad;
            $fav_codigo = $row->fav_codigo;
            $fav_descripcion_codigo = $row->fav_descripcion_codigo;
            $fav_componente = $row->fav_componente;
            $fav_posicion = $row->fav_posicion;
            $fav_falla = $row->fav_falla;
            $fav_accion = $row->fav_accion;

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->crear_check_list_falla_via($check_list_id, $fav_novedad_id, $fav_descripcion_novedad, $fav_codigo, $fav_descripcion_codigo, $fav_componente, $fav_posicion, $fav_falla, $fav_accion );
        }

    }

    public function editar_check_list_registro($check_list_id, $chl_fecha, $chl_bus, $chl_kilometraje, $chl_nombre_piloto, $chl_estado, $a_data_observaciones, $a_data_falla_via)
    {
        $chl_usuario_id_genera = $_SESSION['USUARIO_ID'];
        $chl_nombres_usuario = $_SESSION['Usua_NombreCorto'];
        $chl_fecha_genera = date("Y-m-d H:i:s");

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD("manto_check_list_registro", "check_list_id", $check_list_id);
        foreach ($Respuesta as $row){
            $chl_log = $row['chl_log'];
        }
        $chl_log = $chl_fecha_genera." ".$chl_estado." ".$chl_nombres_usuario. " EDICION <br>".$chl_log;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD("colaborador","Colab_ApellidosNombres",$chl_nombre_piloto);
        foreach ($Respuesta as $row){
            $chl_codigo_piloto = $row['Colab_CodigoCortoPT'];
            $chl_dni_piloto = $row['Colaborador_id'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->editar_check_list_registro($check_list_id, $chl_fecha, $chl_bus, $chl_kilometraje, $chl_nombre_piloto, $chl_estado, $chl_usuario_id_genera, $chl_fecha_genera,$chl_dni_piloto, $chl_codigo_piloto, $chl_log );

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->borrar_check_list_observaciones($check_list_id);
        
        foreach ($a_data_observaciones as $row){
            $chl_codigo = $row->chl_codigo;
            $chl_descripcion = $row->chl_descripcion;
            $chl_componente = $row->chl_componente;
            $chl_posicion = $row->chl_posicion;
            $chl_falla = $row->chl_falla;
            $chl_accion = $row->chl_accion;

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->crear_check_list_observaciones($check_list_id, $chl_codigo, $chl_descripcion, $chl_componente, $chl_posicion, $chl_falla, $chl_accion );
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->borrar_check_list_falla_via($check_list_id);

        foreach ($a_data_falla_via as $row){
            $fav_novedad_id = $row->fav_novedad_id;
            $fav_descripcion_novedad = $row->fav_descripcion_novedad;
            $fav_codigo = $row->fav_codigo;
            $fav_descripcion_codigo = $row->fav_descripcion_codigo;
            $fav_componente = $row->fav_componente;
            $fav_posicion = $row->fav_posicion;
            $fav_falla = $row->fav_falla;
            $fav_accion = $row->fav_accion;

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax = new CRUD();
            $Respuesta = $InstanciaAjax->crear_check_list_falla_via($check_list_id, $fav_novedad_id, $fav_descripcion_novedad, $fav_codigo, $fav_descripcion_codigo, $fav_componente, $fav_posicion, $fav_falla, $fav_accion );
        }

    }

    public function cerrar_check_list_registro($check_list_id)
    {
        $chl_log = '';
        $chl_estado = 'CERRADO';
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD("manto_check_list_registro", "check_list_id", $check_list_id);
        foreach ($Respuesta as $row){
            $chl_log = $row['chl_log'];
        }

        $chl_nombres_usuario = $_SESSION['Usua_NombreCorto'];
        $chl_fecha_genera = date("Y-m-d H:i:s");
        $chl_log = $chl_fecha_genera." ".$chl_estado." ".$chl_nombres_usuario. " CAMBIO DE ESTADO <br>".$chl_log;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->cerrar_check_list_registro($check_list_id, $chl_estado, $chl_log);
    }

    public function anular_check_list_registro($check_list_id)
    {
        $chl_log = '';
        $chl_estado = 'ANULADO';
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD("manto_check_list_registro", "check_list_id", $check_list_id);
        foreach ($Respuesta as $row){
            $chl_log = $row['chl_log'];
        }

        $chl_nombres_usuario = $_SESSION['Usua_NombreCorto'];
        $chl_fecha_genera = date("Y-m-d H:i:s");
        $chl_log = $chl_fecha_genera." ".$chl_estado." ".$chl_nombres_usuario. " CAMBIO DE ESTADO <br>".$chl_log;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->anular_check_list_registro($check_list_id, $chl_estado, $chl_log);
    }

}