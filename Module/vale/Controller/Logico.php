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
                if(strlen($calculo)>0 && $calculo!="0"){
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

    public function generar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $va_tipo, $array_data)
	{
        $TablaBD = "colaborador";
        $CampoBD = "Colaborador_id";
        $va_cierre_adm = $_SESSION['USUARIO_ID'];

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_cierre_adm);
        foreach ($Respuesta as $row) {
            $nombre_cierre_adm = $row['Colab_nombre_corto'];
        }

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
        $Respuesta      = $InstanciaAjax->generar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $va_obs_aom, $va_estado, $nombre_cierre_adm, $va_tipo, $va_ruc);

        $vr_vale = $vale_id;

        foreach($array_data as $row){
            $vr_id                  = $row['vr_id'];
            $vr_descripcion         = $row['vr_descripcion'];
            $vr_repuesto            = $row['vr_repuesto'];
            $vr_nroserie            = $row['vr_nroserie'];
            $vr_cantidad_requerida            = $row['vr_cantidad_requerida'];
            $vr_tipo                = $row['vr_tipo'];
            $vr_precio              = '0';
            $vr_unidad_medida       = '';
            $vr_material_id         = '';
            $vr_precio_proveedor_id = '0';
            $vr_moneda              = ''; 
            $vr_precio_soles        = '0';
            $vr_fecha_vigencia      = $va_date_genera;


            if($vr_repuesto!=""){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->BuscarCodigoRepuesto($vr_repuesto, $va_ruc, $va_date_genera, $vr_tipo);
                foreach ($Respuesta as $row2) {
                    $vr_precio              = $row2['precioprov_preciosoles'];
                    $vr_unidad_medida       = $row2['unidad_medida'];
                    $vr_material_id         = $row2['precioprov_materialid'];
                    $vr_precio_proveedor_id = $row2['precioprov_id'];
                    $vr_moneda              = $row2['precioprov_moneda']; 
                    $vr_precio_soles        = $row2['precioprov_preciosoles'];
                    $vr_fecha_vigencia      = $row2['precioprov_fechavigencia'];
                }
            }
    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->crear_detalle_repuestos($vr_vale, $vr_id, $vr_repuesto, $vr_nroserie, $vr_cantidad_requerida, $vr_precio, $vr_unidad_medida, $vr_material_id, $vr_precio_proveedor_id, $vr_moneda, $vr_precio_soles, $vr_fecha_vigencia, $vr_tipo, $vr_descripcion);    
        }
    }

    public function editar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $va_tipo, $array_data)
	{
    
        $va_cierre_adm  = $_SESSION['USUARIO_ID'];

        $TablaBD = "colaborador";
        $CampoBD = "Colaborador_id";
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_cierre_adm);
        foreach ($Respuesta as $row) {
            $nombre_cierre_adm = $row['Colab_nombre_corto'];
        }

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

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->editar_vale($vale_id, $va_ot_id, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $nombre_cierre_adm, $va_tipo, $va_ruc);

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->eliminar_detalle_repuestos($vale_id);

        $vr_vale = $vale_id;

        foreach($array_data as $row){
            $vr_id                  = $row['vr_id'];
            $vr_descripcion         = $row['vr_descripcion'];
            $vr_repuesto            = $row['vr_repuesto'];
            $vr_nroserie            = $row['vr_nroserie'];
            $vr_cantidad_requerida            = $row['vr_cantidad_requerida'];
            $vr_tipo                = $row['vr_tipo'];
            $vr_precio              = '0';
            $vr_unidad_medida       = '';
            $vr_material_id         = '';
            $vr_precio_proveedor_id = '0';
            $vr_moneda              = ''; 
            $vr_precio_soles        = '0';
            $vr_fecha_vigencia      = $va_date_genera;


            if($vr_repuesto!=""){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax  = new CRUD();
                $Respuesta      = $InstanciaAjax->BuscarCodigoRepuesto($vr_repuesto, $va_ruc, $va_date_genera, $vr_tipo);
                foreach ($Respuesta as $row2) {
                    $vr_precio              = $row2['precioprov_precio'];
                    $vr_unidad_medida       = $row2['unidad_medida'];
                    $vr_material_id         = $row2['precioprov_materialid'];
                    $vr_precio_proveedor_id = $row2['precioprov_id'];
                    $vr_moneda              = $row2['precioprov_moneda']; 
                    $vr_precio_soles        = $row2['precioprov_preciosoles'];
                    $vr_fecha_vigencia      = $row2['precioprov_fechavigencia'];
                }
            }
    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->crear_detalle_repuestos($vr_vale, $vr_id, $vr_repuesto, $vr_nroserie, $vr_cantidad_requerida, $vr_precio, $vr_unidad_medida, $vr_material_id, $vr_precio_proveedor_id, $vr_moneda, $vr_precio_soles, $vr_fecha_vigencia, $vr_tipo, $vr_descripcion);
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
            $rpta_autocompletar[] = ["value" => $row[$NombreCampo], "label" => "<strong>".$row[$NombreCampo]."</strong> ".$row['precioprov_descripcion']];
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