<?php
class Logico
{
	var $Modulo = "Kilometraje";
    // 1.0 CARGA DATOS DE BUSQUEDA DE PILOTO
	function Contenido($NombreDeModuloVista)    
	{		
		MView($this->Modulo,'LocalView',compact('NombreDeModuloVista') );
	}

    public function SelectTipos($TtablaKilometraje_Operacion, $TtablaKilometraje_Tipo)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTipos($TtablaKilometraje_Operacion, $TtablaKilometraje_Tipo);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
        }
        echo $html;
    }

    public function CalculoFecha($inicio,$calculo)
    {
        $rptaFecha = "";
        if($inicio=="hoy"){
                if($calculo=="0"){
                    $rptaFecha = date("Y-m-d");
                }
                if(strlen($calculo)>0 && $calculo!="0"){
                    $f = strtotime($calculo);
                    $rptaFecha = date("Y-m-d",$f);
                }
        }else{
            if(strlen($calculo)>0 && $calculo!="0"){
                $d = strtotime($inicio);
                $f = strtotime($calculo,$d);
                $rptaFecha = date("Y-m-d",$f);
            }
        }
        echo $rptaFecha;
    }

	public function SelectAnios()
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectAnios();

        $html = '<option value="">Año</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Anio'].'">'.$row['Anio'].'</option>';
        }
        echo $html;
    }

    function CrearKmCarga($inputFileName,$Anio,$kmcarga_fecha)
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

        $kmcarga_fechacarga = date("Y-m-d H:i:s");
        $ckl_km_fecha = $kmcarga_fecha;
        $ckl_km_fecha_carga = $kmcarga_fechacarga;

        // Se asigna el siguiente Id de manto_Kmcarga a otpv_cargaid
        $TablaBD="manto_kmcarga";
        $CampoId="kmcarga_id";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $MaxId = $InstanciaAjax->MaxId($TablaBD,$CampoId);
        foreach ($MaxId as $row) {
            $ckl_km_kmcargaid = $row['MaxId']+1;  // Este campo sera tambien igual al ControlFacilitador_Id
        }
        
        $CantErrores=0;
        for ($row = 2; $row <= $highestRow; $row++) {
            $ckl_km_bus = $worksheet->getCell('A'.$row)->getValue();
            $ckl_km_kilometraje = $worksheet->getCell('B'.$row)->getValue();
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->CrearKmDetalle($ckl_km_fecha,$ckl_km_bus,$ckl_km_kilometraje,$ckl_km_fecha_carga,$ckl_km_kmcargaid);
            if ($Respuesta==false) {
                $CantErrores=$CantErrores+1;
                echo "No grabo linea ".$row." -> Bus: ".$ckl_km_bus." Kilometraje: ".$ckl_km_kilometraje." ERROR Km de Bus existe en base de datos.<hr>"  ;
            }
        }
        $kmcarga_nroregistros = $highestRow-$CantErrores-1;
        if($kmcarga_nroregistros>0){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->CrearKmCarga($kmcarga_nroregistros,$kmcarga_fecha,$kmcarga_fechacarga);

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->ObservadoKmCarga($kmcarga_fecha);

        }
        echo "Se cargaron ".($highestRow-$CantErrores-1)." de ".($highestRow-1);
    }

    public function CreacionTablaKm($NombreTabla, $FechaInicioKm, $FechaTerminoKm, $TipoBusKm)
    {
        $tablahtml = "";
        switch ($NombreTabla)
        {
            case 'tablaKm':
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->CrearColumnasKm($FechaInicioKm, $FechaTerminoKm, $TipoBusKm);
      
                $tablahtml =    "<table id='tablaKm' class='table table-striped table-bordered table-condensed w-100'>
                                    <thead class='text-center'>
                                        <tr>
                                            <th>GRAF.</th>
                                            <th>ID BUS</th>
                                            <th>TIPO BUS</th>";
                                            
                foreach ($Respuesta as $row) {
                    $pFechaInicioKm = strtotime($row['fecha']);
                    switch (date("D",$pFechaInicioKm))
                    {
                        case "Sun":
                            $tdia = "DOMINGO";
                        break;
                        case "Mon":
                            $tdia = "LUNES";
                        break;
                        case "Tue":
                            $tdia = "MARTES";
                        break;
                        case "Wed":
                            $tdia = "MIERCOLES";
                        break;
                        case "Thu":
                            $tdia = "JUEVES";
                        break;
                        case "Fri":
                            $tdia = "VIERNES";
                        break;
                        case "Sat":
                            $tdia = "SABADO";
                        break;
                    }
                    $tablahtml .= "<th>".date("Y-m-d",$pFechaInicioKm) . " ".$tdia."</th>";
                }
                                            
                $tablahtml .=          "</tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>";
            break;

            //default: ;
        }
        echo $tablahtml;    
    }

    public function CrearColumnasKm($FechaInicioKm, $FechaTerminoKm, $TipoBusKm)
    {
        $columnaskm = "";
        $boton = "<div class='text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnGraficoKm'><i class='bi bi-graph-up'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-graph-up' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z'/></svg></i></button></div></div>";
        
        $columnaskm .= '[{"defaultContent": "'.$boton.'"},';
        $columnaskm .= '{"data": "bus"},';
        $columnaskm .= '{"data": "tipobus"}';

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CrearColumnasKm($FechaInicioKm, $FechaTerminoKm, $TipoBusKm);

        foreach ($Respuesta as $row) {
            $pFechaInicioKm = strtotime( $row['fecha'] );
            $columnaskm .= ',{"data": "'.date("Y-m-d",$pFechaInicioKm).'"}';
        }
        
        $columnaskm .= "]";
        echo $columnaskm;
    }

    public function LeerKm($FechaInicioKm,$FechaTerminoKm,$TipoKm,$TipoBusKm)
    {
        $aKilometros    = array();
        $abus           = array();
        $bus            = "";
        $tipobus        = "";

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      =$InstanciaAjax->LeerKm($FechaInicioKm, $FechaTerminoKm, $TipoBusKm);
        
        foreach ($Respuesta as $row) {
            if($bus == ""){
                $bus        = $row['bus'];
                $tipobus    = $row['tipobus'];
            }
            if($bus != $row['bus']){
                $abus['bus']        = $bus;
                $abus['tipobus']    = $tipobus;
                $aKilometros[]      = $abus;
                $bus                = $row['bus'];
                $tipobus            = $row['tipobus'];
            }
            switch($TipoKm)
            {
                case "TODOS":
                    if($row['kmrecorrido']>490){
                        $abus[$row['fecha']] = "<p class='text-danger font-weight-bold'>".$row['kmrecorrido']."</p><p class='text-danger'>".$row['kmacumulado']."</p>";
                    }else{
                        $abus[$row['fecha']] = "<p class='font-weight-bold'>".$row['kmrecorrido']."</p>".$row['kmacumulado'];
                    }
                break;
                case "RECORRIDO":
                    if($row['kmrecorrido']>490){
                        $abus[$row['fecha']] = "<p class='text-danger'>".$row['kmrecorrido']."</p>";
                    }else{
                        $abus[$row['fecha']] = $row['kmrecorrido'];
                    }
                break;
                case "ACUMULADO":
                    if($row['kmrecorrido']>490){
                        $abus[$row['fecha']] = "<p class='text-danger'>".$row['kmacumulado']."</p>";
                    }else{
                        $abus[$row['fecha']] = $row['kmacumulado'];
                    }
                break;
                default: ;
            }
        }
        $abus['bus']        = $bus;
        $abus['tipobus']    = $tipobus;
        $aKilometros[]      = $abus;
        print json_encode($aKilometros, JSON_UNESCAPED_UNICODE);
    }

    public function BusesKm()
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BusesKm();

        $html = '<option value="">Buses</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Buses'].'">'.$row['Buses'].'</option>';
        }
        echo $html;
    }

    public function ValidarKm($km_bus,$km_fecha,$km_kilometraje)
    {
        $validakm = "SI";

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CalculoKilometraje($km_bus,$km_fecha);
        
        foreach ($Respuesta as $row) {
            if($row['km_siguiente']!=null){
                if ($km_kilometraje > $row['km_siguiente']) {
                    $validakm = "NO";
                }
            }
            if ($row['km_anterior']!=null) {
                if ($km_kilometraje < $row['km_anterior']) {
                    $validakm = "NO";
                }
            }
        }
        echo $validakm;
    }

    public function ValidarFechaCarga()
    {
        $fechacarga = "";
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->ValidarFechaCarga();
        
        foreach ($Respuesta as $row) {
            $d = strtotime($row['ultimafechacarga']);
            $fechacarga = date("Y-m-d",strtotime("+1 Days",$d));
        }
        echo $fechacarga;
    }
}