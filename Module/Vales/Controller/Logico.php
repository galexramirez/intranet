<?php
session_start();
class Logico
{
	var $Modulo = "Vales";

	function Contenido($NombreDeModuloVista)    
	{		
		MView('Vales','local_view',compact('NombreDeModuloVista') );
	}

    public function generar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $array_data)
	{
        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";
        $va_cierre_adm = $_SESSION['USUARIO_ID'];

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_cierre_adm);
        foreach ($Respuesta as $row) {
            $nombre_cierre_adm = $row['roles_nombrecorto'];
        }

        $TablaBD = "glo_roles";
        $CampoBD = "roles_nombrecorto";
        if($va_genera!="") {
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_genera);
            foreach ($Respuesta as $row) {
                $va_genera = $row['roles_dni'];
            }
        }        

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->generar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $va_obs_aom, $va_estado, $nombre_cierre_adm);

        $rv_vale = $cod_vale;

        foreach($array_data as $row){
            $rv_id       = $row['rv_id'];
            $rv_repuesto = $row['rv_repuesto'];
            $rv_nroserie = $row['rv_nroserie'];
            $rv_cantidad = $row['rv_cantidad'];
            $rv_unidad   = $row['rv_unidad'];

            $TablaBD = "manto_repuestos";
            $CampoBD = "cod_rep";
    
            if($rv_repuesto!=""){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$rv_repuesto);
                foreach ($Respuesta as $row) {
                    $rv_precio = $row['rep_precio'];
                }
            }
    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->crear_detalle_repuestos($rv_vale, $rv_id, $rv_repuesto, $rv_nroserie, $rv_cantidad, $rv_precio, $rv_unidad);
        }
    }

    public function editar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $array_data)
	{
    
        $va_cierre_adm  = $_SESSION['USUARIO_ID'];

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";
        
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_cierre_adm);
        foreach ($Respuesta as $row) {
            $nombre_cierre_adm = $row['roles_nombrecorto'];
        }

        $TablaBD = "glo_roles";
        $CampoBD = "roles_nombrecorto";

        if($va_genera!=""){
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_genera);
            foreach ($Respuesta as $row) {
                $va_genera = $row['roles_dni'];
            }
        }        

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->editar_vales($cod_vale, $va_ot, $va_genera, $va_date_genera, $va_asociado, $va_responsable, $va_garantia, $va_obs_cgm, $tva_obs_aom, $va_obs_aom, $va_estado, $nombre_cierre_adm);

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->eliminar_detalle_repuestos($cod_vale);

        $rv_vale = $cod_vale;

        foreach($array_data as $row){
            $rv_id       = $row['rv_id'];
            $rv_repuesto = $row['rv_repuesto'];
            $rv_nroserie = $row['rv_nroserie'];
            $rv_cantidad = $row['rv_cantidad'];
            $rv_unidad   = $row['rv_unidad'];

            $TablaBD = "manto_repuestos";
            $CampoBD = "cod_rep";
    
            if($rv_repuesto!=""){
                MModel($this->Modulo,'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$rv_repuesto);
                foreach ($Respuesta as $row) {
                    $rv_precio = $row['rep_precio'];
                }
            }
    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->crear_detalle_repuestos($rv_vale, $rv_id, $rv_repuesto, $rv_nroserie, $rv_cantidad, $rv_precio, $rv_unidad);
        }
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

    public function SelectResponsable($va_asociado)
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectResponsable($va_asociado);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Usuario'].'">'.$row['Usuario'].'</option>';
        }
        echo $html;
    }

    public function BuscarResponsable($va_asociado)
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarResponsable($va_asociado);

        $va_responsable = "";

        foreach ($Respuesta as $row) {
            $va_responsable = $row['va_responsable'];
        }
        echo $va_responsable;
    }

    public function BuscarOT($va_ot)
    {
        $rpta_ot        = "";
        $rpta_bus       = "";
        $rpta_descrip   = "";

        $TablaBD = "manto_ot";
        $CampoBD = "cod_ot";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$va_ot);
        foreach ($Respuesta as $row) {
            $rpta_ot        = $row['cod_ot'];
            $rpta_bus       = $row['ot_bus'];
            $rpta_descrip   = $row['ot_origen']." - ".$row['ot_descrip'];
        }
        $data[] = ["va_ot" => $rpta_ot, "va_bus" => $rpta_bus, "va_descrip" => $rpta_descrip];

		print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

    }

    public function SelectTipos($ttablavales_operacion, $ttablavales_tipo)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTipos($ttablavales_operacion, $ttablavales_tipo);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
        }
        echo $html;
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

    public function BusesVales()
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BusesVales();

        $html = '<option value="">Bus</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Buses'].'">'.$row['Buses'].'</option>';
        }
        echo $html;
    }

    public function AsociadoVales()
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AsociadoVales();

        $html = '<option value="">Seleccione una opcion</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Asociado'].'">'.$row['Asociado'].'</option>';
        }
        echo $html;
    }

    public function AutoCompletar($NombreTabla,$NombreCampo)
    {
        $rpta_autocompletar = [];

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo);
        foreach ($Respuesta as $row) {
            if($NombreCampo=="cod_rep"){
                $rpta_autocompletar[] = ["value" => $row['cod_rep'], "label" => "<strong>".$row['cod_rep']."</strong> ".$row['rep_desc']];
            }else{
                $rpta_autocompletar[] = ["value" => $row['rep_desc'], "label" => $row['cod_rep']." <strong>".$row['rep_desc']."</strong>"];
            }
        }
		echo json_encode($rpta_autocompletar);
    }

    public function BuscarCodigoRepuesto($rv_repuesto)
    {
        $a_data = [];
        $TablaBD = "manto_repuestos";
        $CampoBD = "cod_rep";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$rv_repuesto);
        foreach ($Respuesta as $row) {
            $a_data[] = ["rv_desc" => $row['rep_desc'], "rv_unidad" => $row['rep_unida']];
        }

        echo json_encode($a_data);
    }

    public function BuscarDescripcionRepuesto($rv_desc)
    {
        $a_data = [];
        $TablaBD = "manto_repuestos";
        $CampoBD = "rep_desc";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$rv_desc);
        foreach ($Respuesta as $row) {
            $a_data[] = ["rv_repuesto" => $row['cod_rep'], "rv_unidad" => $row['rep_unida']];
        }

        echo json_encode($a_data);
    }

    public function descargar_vales($FechaInicioVales,$FechaTerminoVales)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->descargar_vales($FechaInicioVales,$FechaTerminoVales);

        $mi_carpeta = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date       = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date       = str_replace(".", "", $date);
        $filename   = "Vales_".$date;
        $file_json  = $filename.".json";
        $data       = json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
        file_put_contents($mi_carpeta."/".$file_json, $data);
        echo $filename;
    }

    function DocumentRoot()
    {
        $mi_carpeta = '';
        $mi_host    = $_SERVER['HTTP_HOST'];
        $mi_referer = $_SERVER['HTTP_REFERER'];
        $mi_carpeta = substr($mi_referer,0,strpos($mi_referer,$mi_host)).$mi_host.'/';
        echo $mi_carpeta;
    }

    public function vales_observadas()
    {
        $rpta_vales_observadas = "";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->vales_observadas();

        foreach ($Respuesta as $row){
            if($row['cantidad_vales']!="0"){
                $rpta_vales_observadas = $row['cantidad_vales'];
            }
        }

        echo $rpta_vales_observadas;
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

}