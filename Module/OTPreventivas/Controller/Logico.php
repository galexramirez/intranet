<?php
class Logico
{
	var $Modulo = "OTPreventivas";
	function Contenido($NombreDeModuloVista)    
	{		
			
		MView('OTPreventivas','LocalView',compact('NombreDeModuloVista') );
			
	}

	public function SelectAnios()
    {
        //Ejecuta Modelo
        MModel('OTPreventivas', 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectAnios();

        $html = '<option value="">Año</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Anio'].'">'.$row['Anio'].'</option>';
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

    function CrearOTPrvCarga($inputFileName,$Anio)
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

        $otprvcarga_semanaprogramada    = $worksheet->getCell('B2')->getValue();
        $otprvcarga_fechacargada        = date("Y-m-d H:i:s");
        $otpv_date_genera               = $otprvcarga_fechacargada;

        // Se asigna el siguiente Id de manto_otprvcarga a otpv_cargaid
        $TablaBD = "manto_otprvcarga";
        $CampoId = "otprvcarga_Id";
        MModel('OTPreventivas', 'CRUD');
        $InstanciaAjax  = new CRUD();
        $MaxId          = $InstanciaAjax->MaxId($TablaBD,$CampoId);
        foreach ($MaxId as $row) {
            $otpv_cargaid = $row['MaxId']+1;  // Este campo sera tambien igual al ControlFacilitador_Id
        }
        if($otpv_cargaid==1){
            $TablaBD = "manto_otprvcarga";
            MModel('OTPreventivas', 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->TruncateTabla($TablaBD);    
        }
        
        $CantErrores = 0;
        for ($row = 2; $row <= $highestRow; $row++) {
            $cod_otpv           = $worksheet->getCell('A'.$row)->getValue();
            $otpv_semana        = $worksheet->getCell('B'.$row)->getValue();
            $otpv_turno         = $worksheet->getCell('C'.$row)->getValue();
            $otpv_date_prog     = $worksheet->getCell('D'.$row)->getValue();
            $otpv_bus           = $worksheet->getCell('E'.$row)->getValue();
            $otpv_frecuencia    = $worksheet->getCell('F'.$row)->getValue();
            $otpv_descripcion   = $worksheet->getCell('G'.$row)->getValue();
            $otpv_asociado      = $worksheet->getCell('H'.$row)->getValue();
            $UNIX_DATE          = ($otpv_date_prog - 25569) * 86400;
            $otpv_date_prog     = gmdate("Y-m-d", $UNIX_DATE);
            if (substr($otpv_date_prog, 0, 4)!=$Anio) {
                $CantErrores = $CantErrores+1;
                echo "No grabo linea ".$row." -> Fecha: ".$otpv_date_prog." Codigo OT: ".$cod_otpv." ERROR: NO corresponde al año seleccionado. <hr>"  ;
            }else{
                if (empty($cod_otpv) || empty($otpv_semana) || empty($otpv_turno) || empty($otpv_date_prog) || empty($otpv_bus) || empty($otpv_frecuencia) || empty($otpv_descripcion) || empty($otpv_asociado)){
                    $CantErrores = $CantErrores+1;
                    echo "No grabo linea ".$row." -> Fecha: ".$otpv_date_prog." Codigo OT: ".$cod_otpv." ERROR: Posible Datos INCOMPLETOS . <hr>"  ;
                }else{
                    MModel('OTPreventivas', 'CRUD');
                    $InstanciaAjax  = new CRUD();
                    $Respuesta      = $InstanciaAjax->CrearOTPrvDetalle($cod_otpv,$otpv_semana,$otpv_turno,$otpv_date_prog,$otpv_bus,$otpv_frecuencia,$otpv_descripcion,$otpv_asociado,$otpv_date_genera,$otpv_cargaid);
                    if(count($Respuesta)>0){
                        echo "No grabo linea ".$row." -> Fecha: ".$otpv_date_prog." Codigo OT: ".$cod_otpv." ERROR: "  ;
                        print_r($Respuesta);
                        echo "<br>";
                        $CantErrores = $CantErrores + 1;
                    }
                }
            }
        }
        $otprvcarga_nroregistros = $highestRow-$CantErrores-1;
        if($otprvcarga_nroregistros>0){
            MModel('OTPreventivas', 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->CrearOTPrvCarga($otprvcarga_semanaprogramada,$otprvcarga_fechacargada,$otprvcarga_nroregistros);
        }
        echo "Se cargaron ".($highestRow-$CantErrores-1)." de ".($highestRow-1);
    }

    function ValidarOTPrv($otprvcarga_semanaprogramada)
    {
        $validarOTPrv = true;
        MModel('OTPreventivas','CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->ValidarOTPrv($otprvcarga_semanaprogramada);

        foreach ($Respuesta as $row) {
            if($row['MinFechaProgramada'] <= date("Y-m-d")){
                $validarOTPrv = false;
            }
        }
        return $validarOTPrv;
    }

    public function SelectUsuario($Usua_Perfil)
    {
        //Ejecuta Modelo
        MModel('OTPreventivas', 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectUsuario($Usua_Perfil);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Usuario'].'">'.$row['Usuario'].'</option>';
        }
        echo $html;
    }

    public function SelectTecnico($otpv_asociado)
    {
        //Ejecuta Modelo
        MModel('OTPreventivas', 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTecnico($otpv_asociado);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Usuario'].'">'.$row['Usuario'].'</option>';
        }
        echo $html;
    }

    public function BuscarTecnico($otpv_asociado)
    {
        //Ejecuta Modelo
        MModel('OTPreventivas', 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarTecnico($otpv_asociado);

        $otpv_tecnico = "";

        foreach ($Respuesta as $row) {
            $otpv_tecnico = $row['otpv_tecnico'];
        }
        echo $otpv_tecnico;
    }

    public function SelectTipos($TtablaOTPreventivas_Operacion, $TtablaOTPreventivas_Tipo)
    {
        MModel('OTPreventivas', 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTipos($TtablaOTPreventivas_Operacion, $TtablaOTPreventivas_Tipo);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
        }
        echo $html;
    }

    public function CalculoKilometraje($otpv_bus,$otpv_inicio)
    {
        $kminicial = 0;
        $fechainicial = "";
        $kmfinal = 0;
        $fechafinal = $otpv_inicio;
        $ndias = 0;
        $kmhtml = "";

        MModel('OTPreventivas', 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CalculoKilometraje($otpv_bus,$otpv_inicio);
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
            $d1 = new DateTime($otpv_inicio);
            $d2 = new DateTime($fechainicial);
            $diff = date_diff($d1,$d2);
            $ndias = $diff->format('%a'); 
            $kmfinal = $kminicial + (480 * $ndias);
        }
        $kmhtml .= '<label for="" class="col-form-label form-control-sm">';
        $kmhtml .= 'DEL : '.number_format($kminicial,0,'.',' ').' KM AL '.date_format(date_create($fechainicial),"d-m-Y").'<br>'.'AL  : '.number_format($kmfinal,0,'.',' ').' KM AL '.date_format(date_create($fechafinal),"d-m-Y");
        $kmhtml .= '</label>';
        echo $kmhtml;
    }

    public function ValidarKm($otpv_bus,$otpv_inicio,$otpv_kmrealiza)
    {
        $kminicial = 0;
        $fechainicial = "";
        $kmfinal = 0;
        $fechafinal = $otpv_inicio;
        $ndias = 0;
        $validakm = "SI";

        MModel('OTPreventivas', 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CalculoKilometraje($otpv_bus,$otpv_inicio);
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
            $d1 = new DateTime($otpv_inicio);
            $d2 = new DateTime($fechainicial);
            $diff = date_diff($d1,$d2);
            $ndias = $diff->format('%a'); 
            $kmfinal = $kminicial + (480 * $ndias);
        }
        if ($otpv_kmrealiza > $kmfinal) {
            $validakm = "NO";
        }
        if ($otpv_kmrealiza < $kminicial) {
            $validakm = "NO";
        }
        echo $validakm;
    }

    public function EditarOTPrv($cod_otpv, $otpv_cgm_cierra, $otpv_tecnico, $otpv_inicio, $otpv_fin, $otpv_kmrealiza, $otpv_hmotor, $otpv_componente, $otpv_obs_as, $otpv_obs_cgm, $otpv_obs_cierre_ad, $otpv_obs_cierre_ad2, $otpv_obs_km, $otpv_estado, $otpv_turno, $otpv_date_prog, $otpv_bus, $otpv_fecuencia, $otpv_descripcion, $otpv_asociado)
    {
        $TablaBD = "glo_roles";
        $CampoBD = "roles_nombrecorto";
        MModel('OTPreventivas','CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$otpv_cgm_cierra);
        foreach ($Respuesta as $row) {
            $otpv_cgm_cierra = $row['roles_dni'];
        }

        MModel('OTPreventivas','CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->EditarOTPrv($cod_otpv, $otpv_cgm_cierra, $otpv_tecnico, $otpv_inicio, $otpv_fin, $otpv_kmrealiza, $otpv_hmotor, $otpv_componente, $otpv_obs_as, $otpv_obs_cgm, $otpv_obs_cierre_ad, $otpv_obs_cierre_ad2, $otpv_obs_km, $otpv_estado, $otpv_turno, $otpv_date_prog, $otpv_bus, $otpv_fecuencia, $otpv_descripcion, $otpv_asociado);
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

    public function AutoCompletar($NombreTabla,$NombreCampo)
    {
        $rpta_autocompletar = [];

        MModel('OTPreventivas','CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AutoCompletar($NombreTabla,$NombreCampo);
        foreach ($Respuesta as $row) {
            if($NombreCampo=="material_id"){
                $rpta_autocompletar[] = ["value" => $row['material_id'], "label" => "<strong>".$row['material_id']."</strong> ".$row['material_descripcion']];
            }else{
                $rpta_autocompletar[] = ["value" => $row['material_descripcion'], "label" => " <strong>".$row['material_id']."</strong>".$row['material_descripcion']];
            }
        }
		echo json_encode($rpta_autocompletar);
    }

    function DocumentRoot()
    {
        $miCarpeta = '';
        $miHost = $_SERVER['HTTP_HOST'];
        $miReferer = $_SERVER['HTTP_REFERER'];
        $miCarpeta = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
    }

    public function descargar_otprv($FechaInicioOTPrv,$FechaTerminoOTPrv)
    {
        MModel('OTPreventivas','CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->descargar_otprv($FechaInicioOTPrv,$FechaTerminoOTPrv);

        $mi_carpeta = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date       = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date       = str_replace(".", "", $date);
        $filename   = "OTs".$ib_Tipo."_".$date;
        $file_json  = $filename.".json";
        $data       = json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
        file_put_contents($mi_carpeta."/".$file_json, $data);
        echo $filename;
    }

    public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel('OTPreventivas','CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function ver_ot_prv($cod_ot_prv)
    {
        $html   = "";
        
        MModel('OTPreventivas','CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->ver_ot_prv($cod_ot_prv);
        foreach ($Respuesta as $row) {
            $cod_otpv               = $row['cod_otpv'];
            $otpv_semana            = $row['otpv_semana'];
            $otpv_turno             = $row['otpv_turno'];
            $otpv_date_prog         = $row['otpv_date_prog'];
            $otpv_bus               = $row['otpv_bus'];
            $otpv_frecuencia        = $row['otpv_fecuencia'];
            $otpv_descripcion       = $row['otpv_descripcion'];
            $otpv_asociado          = $row['otpv_asociado'];
            $otpv_estado            = $row['otpv_estado'];
            $otpv_genera            = $row['otpv_genera'];
            $otpv_date_genera       = $row['otpv_date_genera'];
            $otpv_cierra_ad         = $row['otpv_cierra_ad'];
            $otpv_date_cierra_ad    = $row['otpv_date_cierra_ad'];
            $otpv_tecnico           = $row['otpv_tecnico'];
            $otpv_inicio            = $row['otpv_inicio'];
            $otpv_fin               = $row['otpv_fin'];
            $otpv_kmrealiza         = $row['otpv_kmrealiza'];
            $otpv_hmotor            = $row['otpv_hmotor'];
            $otpv_cgm_cierra        = $row['otpv_cgm_cierra'];
            $otpv_obs_as            = $row['otpv_obs_as'];
            $otpv_obs_cgm           = $row['otpv_obs_cgm'];
            $otpv_obs_cierre_ad     = $row['otpv_obs_cierre_ad'];
        }
        

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
                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">OBSERVACIONES DE CGM (Máximo 4000 carácteres)</span>
                                        <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$otpv_obs_cgm.'</div>
                                    </div>
                                      <div class="form-group col-lg-10 mb-1">
                                        <span class="form-control-sm pl-0 mb-0 font-weight-bold">OBSERVACIONES CIERRE ADMINISTRATIVO</span>
                                        <div class="form-control-sm mb-1 overflow-auto h-50 border border-muted border-radius rounded">'.$otpv_obs_cierre_ad.'</div>
                                      </div>
                                </div>  											
                            </div>
                        </div>';

        echo $html;
    }

    public function otprv_observadas()
    {
        $rpta_otprv_observadas = "";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->otprv_observadas();

        foreach ($Respuesta as $row){
            if($row['cantidad_otpv']!="0"){
                $rpta_otprv_observadas = $row['cantidad_otpv'];
            }
        }

        echo $rpta_otprv_observadas;
    }

}