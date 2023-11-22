<?php
session_start();
class Logico
{
    var $Modulo="Accidentes";

    // 1.0 CARGA PANTALLA PRINCIPAL DEL MODULO
    public function Contenido($NombreDeModuloVista)
    {
        MView($this->Modulo, 'LocalView', compact('NombreDeModuloVista'));
    }
    
    //::::::::::::::::::::::::::::::::::::::::: AACIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::://

    public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

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

    public function antiguedad($inicio,$final)
    {
        $n_dias = '';
        $n_meses = '';
        $n_anios = '';
        $rpta_antiguedad = '';

        $firstDate  = new DateTime($inicio);
        if($final!=''){
            $secondDate = new DateTime();    
        }else{
            $secondDate = new DateTime($final);
        }
        
        $intvl = $firstDate->diff($secondDate);
        $n_anios = $intvl->y;
        $n_meses = $intvl->m;
        $n_dias = $intvl->d ;

        if($n_anios>0){ 
            if($n_anios==1){
                $rpta_antiguedad = $n_anios.' año ';
            }else{
                $rpta_antiguedad = $n_anios.' años ';
            }
        }
        if($n_meses>0){ 
            if($n_meses==1){
                $rpta_antiguedad .= $n_meses.' mes ';
            }else{
                $rpta_antiguedad .= $n_meses.' meses ';
            }
        }
        if($n_dias>0){ 
            if($n_dias==1){
                $rpta_antiguedad .= $n_dias.' dia ';
            }else{
                $rpta_antiguedad .= $n_dias.' dias ';
            }
        }

        echo $rpta_antiguedad;
    }

    public function BuscarColaborador($Acci_NombreColaborador)
    {
        //Ejecuta Modelo
        $TablaBD = "colaborador";
        $CampoBD = "Colab_ApellidosNombres";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_NombreColaborador);
        foreach ($Respuesta as $row) {
            $Acci_Dni = $row['Colaborador_id'];
            $Acci_CodigoColaborador = $row['Colab_CodigoCortoPT'];
        }
        $aColaborador[] = ["Acci_Dni" => $Acci_Dni,"Acci_CodigoColaborador" => $Acci_CodigoColaborador ];
        print json_encode($aColaborador, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    }

    public function BuscarNroPlaca($Acci_Bus)
    {
        //Ejecuta Modelo
        $TablaBD = "Buses";
        $CampoBD = "Bus_NroExterno";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_Bus);
        foreach ($Respuesta as $row) {
            $Acci_NroPlaca = $row['Bus_NroPlaca'];
        }
        echo $Acci_NroPlaca;
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
                                            <label for="" class="col-form-label">Nombres y Apellidos</label>
                                            <label for="" class="form-control">' . $row['Prog_NombreColaborador'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tabla</label>
                                            <label for="" class="form-control">' . $row['Prog_Tabla'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Bus</label>
                                            <label for="" class="form-control">' . $row['Prog_Bus'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Servicio</label>
                                            <label for="" class="form-control">' . $row['Prog_Servicio'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">H. Origen</label>
                                            <label for="" class="form-control">' . $row['Prog_HoraOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                </div>
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">H. Destino</label>
                                            <label for="" class="form-control">' . $row['Prog_HoraDestino'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">L. Origen</label>
                                            <label for="" class="form-control">' . $row['Prog_LugarOrigen'] . '</label>
                                        </div>            
                                    </div>    
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">L. Destino</label>
                                            <label for="" class="form-control">' . $row['Prog_LugarDestino'] . '</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Servicio Bus</label>
                                            <label for="" class="form-control">' . $row['Prog_ServBus'] . '</label>
                                        </div> 
                                    </div>    
                                    <div class="col-lg-3">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tipo de Evento</label>
                                            <label for="" class="form-control">' . $row['Prog_TipoEvento'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label for="" class="col-form-label">KM.</label>
                                            <label for="" class="form-control">' . $row['Prog_KmXPuntos'] . '</label>
                                        </div>
                                    </div>    
                                </div>   
                                <div class="row align-items-end">
                                    <div class="col-lg-2">    
                                        <div class="form-group">
                                            <label for="" class="col-form-label">Tipo de Tabla</label>
                                            <label for="" class="form-control">' . $row['Prog_TipoTabla'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-7">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label">Observaciones</label>
                                            <label for="" class="form-control">' . $row['Prog_Observaciones'] . '</label>
                                        </div>            
                                    </div>
                                    <div class="col-lg-3">    
                                        <div class="form-group"> 
                                            <label for="" class="col-form-label">Generado por</label>
                                            <label for="" class="form-control">' . $row['CFaci_UsuarioId'] . '</label>
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

    public function CodigoQR($Accidentes_Id,$Acci_TipoAccidente,$Acci_TipoEvento,$Acci_Bus,$Acci_NombreColaborador,$Acci_Lugar,$Acci_Comisaria,$Acci_Hospital,$Tipo)
    {
        include('Services/Resources/phpqrcode/qrlib.php'); 

        $TablaBD = "Buses";
        $CampoBD = "Bus_NroPlaca";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_Bus);

        foreach ($Respuesta as $row) {
            $Bus_NroPlaca = $row['Bus_NroPlaca'];
        }

        //$file_png = $_SERVER['DOCUMENT_ROOT']."/Services/QRcode/qr.png";
        $ecc = 'H';
        $tamaño = '5';
        $file_png = 'QRcode_'.date('d-m-Y-H-i-s').'.png';
        $codeContents = 'Registro N° '.$Accidentes_Id.' '.$Acci_TipoAccidente.':'.$Acci_TipoEvento.' Bus: '.$Acci_Bus.' Placa: '.$Bus_NroPlaca.' Piloto: '.$Acci_NombreColaborador.' Lugar: '.$Acci_Lugar.' Comisaria: '.$Acci_Comisaria.' Clínica: '.$Acci_Hospital;

        // generating
        QRcode::png($codeContents,$file_png,$ecc,$tamaño);
        
        $Acci_Imagen = addslashes(file_get_contents($file_png));
        $Acci_TipoImagen = "CodigoQR";

        $crear_qr = "";
        $TablaBD = "OPE_AccidentesImagen";
        $CampoBD = "Accidentes_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Accidentes_Id);
        
        foreach ($Respuesta as $row) {
            if($Accidentes_Id == $row['Accidentes_Id'] && $Acci_TipoImagen==$row['Acci_TipoImagen']){
                $crear_qr = "EXISTE";
            };
        }
        
        //Ejecuta Modelo
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();

        if($Tipo=="CREAR"){
            if($crear_qr==""){
                $Respuesta=$InstanciaAjax->GrabarImagen($Accidentes_Id,$Acci_TipoImagen,$Acci_Imagen);
            }
        }else{
            $Respuesta=$InstanciaAjax->EditarImagen($Accidentes_Id,$Acci_TipoImagen,$Acci_Imagen);
        }
       
        // eliminar archivo png generado
        unlink($file_png);
    }

    public function GrabarImagen($Accidentes_Id, $Acci_TipoImagen, $Acci_Imagen){
        $imagen_nueva_ruta = $_SERVER['DOCUMENT_ROOT']."/Services/image/imagen_nueva.jpg";
        $ancho_nuevo = 600;
        $alto_nuevo = 400;

        $imagen_original = imagecreatefromjpeg($Acci_Imagen);
        if($imagen_original !== false){
            $ancho_original = imagesx($imagen_original);
            $alto_original = imagesy($imagen_original);
    
            if($ancho_original <= $ancho_nuevo && $alto_original <= $alto_nuevo){
                move_uploaded_file($Acci_Imagen, $imagen_nueva_ruta);
            }else{
                if($ancho_original >= $alto_original){ // imagen horizontal
                    //$ancho_nuevo = $ancho_nuevo;
                    $alto_nuevo = ($ancho_nuevo * $alto_original) / $ancho_original;
                }else{ // imagen vertical
                    //$alto_nuevo = $alto_nuevo;
                    $ancho_nuevo = ($ancho_original / $alto_original) * $alto_nuevo;
                }
                $imagen_nueva = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
                imagecopyresampled($imagen_nueva, $imagen_original, 0, 0, 0, 0, $ancho_nuevo, $alto_nuevo, $ancho_original, $alto_original);  
                imagejpeg($imagen_nueva, $imagen_nueva_ruta, 100);  
            }
    
            $acci_imagen_nueva = addslashes(file_get_contents($imagen_nueva_ruta));
    
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->GrabarImagen($Accidentes_Id,$Acci_TipoImagen,$acci_imagen_nueva);
    
            unlink($imagen_nueva_ruta);    
        }else{
            echo "No se pudo crear la imagen.";
        }
    }

    public function EditarImagen($Accidentes_Id,$Acci_TipoImagen,$Acci_Imagen){
        $imagen_nueva_ruta = $_SERVER['DOCUMENT_ROOT']."/Services/image/imagen_nueva.jpg";
        $ancho_nuevo = 600;
        $alto_nuevo = 400;

        $imagen_original = imagecreatefromjpeg($Acci_Imagen);
        if($imagen_original !== false){
            $ancho_original = imagesx($imagen_original);
            $alto_original = imagesy($imagen_original);
    
            if($ancho_original <= $ancho_nuevo && $alto_original <= $alto_nuevo){
                move_uploaded_file($Acci_Imagen, $imagen_nueva_ruta);
            }else{
                if($ancho_original >= $alto_original){ // imagen horizontal
                    //$ancho_nuevo = $ancho_nuevo;
                    $alto_nuevo = ($ancho_nuevo * $alto_original) / $ancho_original;
                }else{ // imagen vertical
                    //$alto_nuevo = $alto_nuevo;
                    $ancho_nuevo = ($ancho_original / $alto_original) * $alto_nuevo;
                }
                $imagen_nueva = imagecreatetruecolor($ancho_nuevo, $alto_nuevo);
                imagecopyresampled($imagen_nueva, $imagen_original, 0, 0, 0, 0, $ancho_nuevo, $alto_nuevo, $ancho_original, $alto_original);  
                imagejpeg($imagen_nueva, $imagen_nueva_ruta, 100);  
            }
    
            $acci_imagen_nueva = addslashes(file_get_contents($imagen_nueva_ruta));
    
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->EditarImagen($Accidentes_Id,$Acci_TipoImagen,$acci_imagen_nueva);
    
            unlink($imagen_nueva_ruta);
    
        }else{
            echo "No se pudo crear la imagen.";
        }
    }

    public function EstadoInformePreliminar($Accidentes_Id)
    {
        $EstadoInformePreliminar = "";
        $TablaBD = "OPE_AccidentesInformePreliminar";
        $CampoBD = "Accidentes_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Accidentes_Id);

        foreach ($Respuesta as $row) {
            $EstadoInformePreliminar = $row['Acci_EstadoInformePreliminar'];
        }
        echo $EstadoInformePreliminar;
    }

    public function CargarNovedad($Nove_ProgramacionId,$Novedad_Id)
    {
        $aAccidente = array();
        $TablaBD = "OPE_Novedad";
        $CampoBD = "Novedad_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Novedad_Id);

        $EstadoInformePreliminar = "PENDIENTE";
        foreach ($Respuesta as $row) {
            $TablaBD = "Buses";
            $CampoBD = "Bus_NroExterno";
            $Acci_Bus = $row['Nove_Bus'];
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta2     = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_Bus);
            foreach ($Respuesta2 as $row2) {
                $Acci_NroPlaca = $row2['Bus_NroPlaca'];
            }

            $operacion  = $row['Nove_Operacion'];
            $fecha      = $row['Nove_FechaOperacion'];
            $codigo     = $row['Nove_Dni'];
            $hora       = $row['Nove_HoraInicio'];
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->horas_trabajadas($operacion, $fecha, $codigo, $hora);
    
            foreach ($Respuesta as $row3) {
                $horas_trabajadas = $row3['horas_trabajadas'];
            }

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->km_perdidos($Novedad_Id, $operacion, $Acci_Bus, $fecha);
    
            foreach ($Respuesta as $row4) {
                $km_perdidos = $row4['km_perdidos'];
            }

            $aAccidente[] = ["Acci_TipoAccidente" => $row['Nove_TipoNovedad'],"Acci_ClaseAccidente" => $row['Nove_DetalleNovedad'],"Acci_Descripcion" => $row['Nove_Descripcion'], "Acci_Fecha" => $row['Nove_FechaOperacion'], "Acci_Dni" => $row['Nove_Dni'], "Acci_CodigoColaborador" => $row['Nove_CodigoColaborador'], "Acci_NombreColaborador" => $row['Nove_NombreColaborador'], "Acci_Tabla" => $row['Nove_Tabla'], "Acci_Servicio" => $row['Nove_Servicio'], "Acci_NroPlaca" => $Acci_NroPlaca, "Acci_Bus" => $row['Nove_Bus'], "Acci_Hora" => $row['Nove_HoraInicio'], "Acci_HoraFinAtencion" => '00:00:00', "Acci_EstadoInformePreliminar" => $EstadoInformePreliminar, "Acci_Operacion" => $row['Nove_Operacion'], "Acci_HorasTrabajadas" => $horas_trabajadas, "Acci_km_perdidos" => $km_perdidos, "acci_lugar_referencia" => $row['Nove_LugarExacto']];
        }
        print json_encode($aAccidente, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX

    }

    public function CrearInformePreliminar($Accidentes_Id, $Acci_ClaseAccidente, $Acci_TipoAccidente, $Acci_DanosMateriales, $Acci_Lesiones, $Acci_Fatalidad, $Acci_Otro,$Acci_OtroDescripcion, $Acci_TipoEvento, $Acci_Fecha, $Acci_Hora, $Acci_NombreColaborador, $Acci_Tabla, $Acci_Servicio, $Acci_Lugar, $Acci_Bus, $Acci_Sentido,$Acci_km_perdidos, $Acci_Conciliacion, $Acci_MontoConciliado, $Acci_NombreCGO, $Acci_NombrePersonalApoyo, $Acci_ReconoceResponsabilidad, $Acci_Hospital, $Acci_Comisaria,$Acci_HoraFinAtencion, $Acci_HorasTrabajadas, $Acci_Objeto, $Acci_HoraLlegadaProcurador, $Acci_NombreCGM, $Acci_NombrePersonalApoyoManto, $Acci_NumeroOT, $Acci_DocReporte,$Acci_DocConciliacion, $Acci_DocPartePolicial, $Acci_DocOficioPeritaje, $Acci_DocReporteAtencion, $Acci_DocDenunciaPolicial, $Acci_DocCitacionManifestacion, $Acci_DocOtro,$Acci_DocOtroDescripcion, $Acci_Descripcion, $Nove_ProgramacionId, $Novedad_Id, $Acci_Operacion, $acci_lugar_referencia)
    {
        $TablaBD = 'OPE_AccidentesInformePreliminar';
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD;
        $Respuesta=$InstanciaAjax->TablaVacia($TablaBD);
    
        $Accidentes_Id                  = $Novedad_Id;
        $Acci_FechaElaboracionInforme   = date("Y-m-d H:i:s");
		$Acci_CodigoSuscribeInformacion = $_SESSION['USUARIO_ID'];

        $TablaBD = "colaborador";
        $CampoBD = "Colaborador_id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_CodigoSuscribeInformacion);
        
        foreach ($Respuesta as $row) {
            $Acci_NombreSuscribeInformacion = $row['Colab_ApellidosNombres'];
        }

        $CampoBD = "Colab_ApellidosNombres";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_NombreColaborador);

        foreach ($Respuesta as $row) {
            $Acci_Dni = $row['Colaborador_id'];
            $Acci_CodigoColaborador = $row['Colab_CodigoCortoPT'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_NombreCGO);

        foreach ($Respuesta as $row) {
            $Acci_CodigoCGO = $row['Colaborador_id'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_NombrePersonalApoyo);

        foreach ($Respuesta as $row) {
            $Acci_CodigoPersonalApoyo = $row['Colaborador_id'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_NombreCGM);

        foreach ($Respuesta as $row) {
            $Acci_CodigoCGM = $row['Colaborador_id'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_NombrePersonalApoyoManto);

        foreach ($Respuesta as $row) {
            $Acci_CodigoPersonalApoyoManto = $row['Colaborador_id'];
        }

        if($Acci_MontoConciliado==""){
            $Acci_MontoConciliado = 0;
        }

        $TablaBD = "OPE_Novedad";
        $CampoBD = "Novedad_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Novedad_Id);
        
        foreach ($Respuesta as $row) {
            $Acci_OPENovedadId      = $row['OPE_NovedadId'];
            $Acci_Operacion         = $row['Nove_Operacion'];
            $Acci_FechaOperacion    = $row['Nove_FechaOperacion'];
            $Acci_CFaRgId           = $row['Nove_CFaRgId'];
        }

        $TablaBD = "OPE_ControlFacilitadorRegistroCarga";
        $CampoBD = "CFaRg_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_CFaRgId);
        
        foreach ($Respuesta as $row) {
            $CFaRg_Estado = $row['CFaRg_Estado'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        if($CFaRg_Estado=="CERRADO"){
            $Respuesta=$InstanciaAjax->control_facilitador_id_hist($Nove_ProgramacionId);
        }
        if($CFaRg_Estado=="GENERADO"){
            $Respuesta=$InstanciaAjax->control_facilitador_id($Nove_ProgramacionId);
        }
        foreach ($Respuesta as $row) {
            $Acci_ControlFacilitadorId = $row['ControlFacilitador_Id'];
        }

        $crear_ip = "";
        $TablaBD = "OPE_Accidentes";
        $CampoBD = "Accidentes_Id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Accidentes_Id);
        
        foreach ($Respuesta as $row) {
            if($Accidentes_Id = $row['Accidentes_Id']){
                $crear_ip = "EXISTE";
            };
        }

        if($crear_ip==""){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->CrearAccidentes($Accidentes_Id,$Nove_ProgramacionId,$Acci_ControlFacilitadorId,$Acci_OPENovedadId,$Novedad_Id,$Acci_Operacion,$Acci_FechaOperacion,$Acci_CFaRgId);
    
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->CrearInformePreliminar($Accidentes_Id, $Acci_ClaseAccidente, $Acci_TipoAccidente, $Acci_DanosMateriales, $Acci_Lesiones, $Acci_Fatalidad, $Acci_Otro, $Acci_OtroDescripcion, $Acci_TipoEvento, $Acci_Fecha, $Acci_Hora, $Acci_Dni, $Acci_CodigoColaborador, $Acci_NombreColaborador, $Acci_Tabla, $Acci_Servicio, $Acci_Lugar, $Acci_Bus, $Acci_Sentido, $Acci_km_perdidos, $Acci_Conciliacion, $Acci_MontoConciliado, $Acci_CodigoCGO, $Acci_NombreCGO, $Acci_CodigoPersonalApoyo, $Acci_NombrePersonalApoyo, $Acci_ReconoceResponsabilidad, $Acci_Hospital, $Acci_Comisaria, $Acci_HoraFinAtencion, $Acci_HorasTrabajadas, $Acci_Objeto, $Acci_HoraLlegadaProcurador, $Acci_CodigoCGM, $Acci_NombreCGM, $Acci_CodigoPersonalApoyoManto, $Acci_NombrePersonalApoyoManto, $Acci_NumeroOT, $Acci_DocReporte, $Acci_DocConciliacion, $Acci_DocPartePolicial, $Acci_DocOficioPeritaje, $Acci_DocReporteAtencion, $Acci_DocDenunciaPolicial, $Acci_DocCitacionManifestacion, $Acci_DocOtro, $Acci_DocOtroDescripcion, $Acci_Descripcion, $Acci_CodigoSuscribeInformacion, $Acci_NombreSuscribeInformacion, $Acci_FechaElaboracionInforme, $Acci_Operacion, $acci_lugar_referencia);
        }
    }

    public function EditarInformePreliminar($Accidentes_Id,$Acci_ClaseAccidente,$Acci_TipoAccidente,$Acci_DanosMateriales,$Acci_Lesiones,$Acci_Fatalidad,$Acci_Otro,$Acci_OtroDescripcion,$Acci_TipoEvento,$Acci_Fecha,$Acci_Hora,$Acci_NombreColaborador,$Acci_Tabla,$Acci_Servicio,$Acci_Lugar,$Acci_Bus,$Acci_Sentido,$Acci_ViajesPerdidos,$Acci_Conciliacion,$Acci_MontoConciliado,$Acci_NombreCGO,$Acci_NombrePersonalApoyo,$Acci_ReconoceResponsabilidad,$Acci_Hospital,$Acci_Comisaria,$Acci_HoraFinAtencion,$Acci_HorasTrabajadas,$Acci_Objeto,$Acci_HoraLlegadaProcurador,$Acci_NombreCGM,$Acci_NombrePersonalApoyoManto,$Acci_NumeroOT,$Acci_DocReporte,$Acci_DocConciliacion,$Acci_DocPartePolicial,$Acci_DocOficioPeritaje,$Acci_DocReporteAtencion,$Acci_DocDenunciaPolicial,$Acci_DocCitacionManifestacion,$Acci_DocOtro,$Acci_DocOtroDescripcion,$Acci_Descripcion, $acci_lugar_referencia)
    {
        $Acci_FechaElaboracionInforme = date("Y-m-d H:i:s");
		$Acci_CodigoSuscribeInformacion = $_SESSION['USUARIO_ID'];

        $TablaBD = "colaborador";
        $CampoBD = "Colaborador_id";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_CodigoSuscribeInformacion);

        foreach ($Respuesta as $row) {
            $Acci_NombreSuscribeInformacion = $row['Colab_ApellidosNombres'];
        }

        $CampoBD = "Colab_ApellidosNombres";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_NombreColaborador);

        foreach ($Respuesta as $row) {
            $Acci_Dni = $row['Colaborador_id'];
            $Acci_CodigoColaborador = $row['Colab_CodigoCortoPT'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_NombreCGO);

        foreach ($Respuesta as $row) {
            $Acci_CodigoCGO = $row['Colaborador_id'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_NombrePersonalApoyo);

        foreach ($Respuesta as $row) {
            $Acci_CodigoPersonalApoyo = $row['Colaborador_id'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_NombreCGM);

        foreach ($Respuesta as $row) {
            $Acci_CodigoCGM = $row['Colaborador_id'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_NombrePersonalApoyoManto);

        foreach ($Respuesta as $row) {
            $Acci_CodigoPersonalApoyoManto = $row['Colaborador_id'];
        }

        if($Acci_MontoConciliado==""){
            $Acci_MontoConciliado = 0;
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->EditarInformePreliminar($Accidentes_Id,$Acci_ClaseAccidente,$Acci_TipoAccidente,$Acci_DanosMateriales,$Acci_Lesiones,$Acci_Fatalidad,$Acci_Otro,$Acci_OtroDescripcion,$Acci_TipoEvento,$Acci_Fecha,$Acci_Hora,$Acci_Dni,$Acci_CodigoColaborador,$Acci_NombreColaborador,$Acci_Tabla,$Acci_Servicio,$Acci_Lugar,$Acci_Bus,$Acci_Sentido,$Acci_ViajesPerdidos,$Acci_Conciliacion,$Acci_MontoConciliado,$Acci_CodigoCGO,$Acci_NombreCGO,$Acci_CodigoPersonalApoyo,$Acci_NombrePersonalApoyo,$Acci_ReconoceResponsabilidad,$Acci_Hospital,$Acci_Comisaria,$Acci_HoraFinAtencion,$Acci_HorasTrabajadas,$Acci_Objeto,$Acci_HoraLlegadaProcurador,$Acci_CodigoCGM,$Acci_NombreCGM,$Acci_CodigoPersonalApoyoManto,$Acci_NombrePersonalApoyoManto,$Acci_NumeroOT,$Acci_DocReporte,$Acci_DocConciliacion,$Acci_DocPartePolicial,$Acci_DocOficioPeritaje,$Acci_DocReporteAtencion,$Acci_DocDenunciaPolicial,$Acci_DocCitacionManifestacion,$Acci_DocOtro,$Acci_DocOtroDescripcion,$Acci_Descripcion,$Acci_CodigoSuscribeInformacion,$Acci_NombreSuscribeInformacion,$Acci_FechaElaboracionInforme, $acci_lugar_referencia);
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

    public function SelectTablaAccidente($Prog_Fecha)
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

        $html = '<option value="">Seleccione una opcion</option>';

        if($estado_cerrado=="CERRADO"){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->select_tabla_accidente_hist($Prog_Fecha);
            foreach ($Respuesta as $row) {
                $html .= '<option value="'.$row['Tabla'].'">'.$row['Tabla'].'</option>';
            }    
        }
        if($estado_generado=="GENERADO"){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta=$InstanciaAjax->SelectTablaAccidente($Prog_Fecha);
            foreach ($Respuesta as $row) {
                $html .= '<option value="'.$row['Tabla'].'">'.$row['Tabla'].'</option>';
            }    
        }

        echo $html;
    }

    public function SelectBus()
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectBus();

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Bus'].'">'.$row['Bus'].'</option>';
        }
        echo $html;
    }

    public function BuscarServicio($Prog_Fecha,$Prog_Tabla)
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
            $Respuesta=$InstanciaAjax->BuscarServicio($Prog_Fecha,$Prog_Tabla);
            foreach ($Respuesta as $row) {
                $Servicio = $row['Prog_Servicio'];
            }
        }
        echo $Servicio;
    }

    public function SelectTipos($TtablaAccidentes_Operacion, $TtablaAccidentes_Tipo)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTipos($TtablaAccidentes_Operacion, $TtablaAccidentes_Tipo);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
        }
        echo $html;
    }

    public function DatosCalculados($Accidentes_Id)
    {
        $Acci_NumeroOT = '';
        $Acci_DatosRegistro = '';
        $Acci_Trafico = "";
        $Acci_FechaCierreReporte = date("Y-m-d");

        // SE BUSCA LA DATA EN LA TABLA OPE_AccidentesInformePreliminar
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $TablaBD = 'OPE_AccidentesInformePreliminar';
        $CampoBD = 'Accidentes_Id';
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Accidentes_Id);
        foreach ($Respuesta as $row) {
            $Acci_CodigoCGO     = $row['Acci_CodigoCGO'];
            $Acci_Fecha         = $row['Acci_Fecha'];
            $Acci_Hora          = $row['Acci_Hora'];
            $Acci_NumeroOT      = $row['Acci_NumeroOT'];
            $Acci_Dni           = $row['Acci_Dni'];
            $Acci_FechaCerrar   = $row['Acci_FechaCerrar'];
            $Acci_DocReporteAtencion = $row['Acci_DocReporteAtencion'];
        }

        // SE GENERA EL CAMPO Acci_DatosRegistro = nombre corto cgo + fecha + hora
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $TablaBD = 'colaborador';
        $CampoBD = 'Colaborador_id';
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_CodigoCGO);
        foreach ($Respuesta as $row) {
            $Acci_NombreCortoCGO = $row['Colab_nombre_corto'];
        }
        $Acci_DatosRegistro = $Acci_NombreCortoCGO."-".substr($Acci_FechaCerrar,8,2)."-".substr($Acci_FechaCerrar,5,2)."-".substr($Acci_FechaCerrar,1,2)."_".substr($Acci_Hora,0,5);

        // SE GENERA EL CAMPO Acci_Trafico segun la hora del accidente
        if(strtotime($Acci_Hora)>=strtotime("06:00:00") && strtotime($Acci_Hora)<strtotime("09:00:00")){
            $Acci_Trafico = "HORA PUNTA AM";
        }
        if(strtotime($Acci_Hora)>=strtotime("09:00:00") && strtotime($Acci_Hora)<strtotime("17:00:00")){
            $Acci_Trafico = "HORA VALLE";
        }
        if(strtotime($Acci_Hora)>=strtotime("17:00:00") && strtotime($Acci_Hora)<strtotime("20:00:00")){
            $Acci_Trafico = "HORA PUNTA PM";
        }
        if(strtotime($Acci_Hora)>=strtotime("20:00:00") && strtotime($Acci_Hora)<strtotime("24:00:00")){
            $Acci_Trafico = "NOCHE";
        }
        if(strtotime($Acci_Hora)>=strtotime("24:00:00") && strtotime($Acci_Hora)<strtotime("30:00:00")){
            $Acci_Trafico = "MADRUGADA";
        }

        //  Cantidad de Accidentes es los ultimos 12 meses
        $Fecha_Inicio = date("Y-m-d",strtotime("-12 month",strtotime($Acci_Fecha)));
        $Fecha_Termino = date("Y-m-d",strtotime($Acci_Fecha));
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->CantidadAccidentes($Acci_Dni,$Fecha_Inicio,$Fecha_Termino);
        foreach ($Respuesta as $row) {
            $Acci_Reincidencia = $row['CantidadAccidentes'];
        }

        // Calculo del tiempo de investigacion en dias fecha cierre de reporte menos(-) fecha registro = cierre de informe preliminar
        $firstDate  = new DateTime($Acci_FechaCierreReporte);
        $secondDate = new DateTime($Acci_FechaCerrar);
        $intvl = $firstDate->diff($secondDate);
        $Acci_TiempoInvestigacion = $intvl->days;

        // Calculo del delay de registro en dias fecha registro = cierre de informe preliminar menos(-) fecha de accidente
        $firstDate  = new DateTime($Acci_FechaCerrar);
        $secondDate = new DateTime($Acci_Fecha);
        $intvl = $firstDate->diff($secondDate);
        $Acci_DelayRegistro = $intvl->days;

        // Cumplimiento de la meta Registro
        $nAcci_DelayRegistro = (int)$Acci_DelayRegistro;
        if($nAcci_DelayRegistro<=1){
            $Acci_CumplimientoRegistro = "On Time";
        }else{
            $Acci_CumplimientoRegistro = "Off Time";
        }

        $aDatosCalculados[] = ["Acci_NumeroOT" => $Acci_NumeroOT, "Acci_DatosRegistro" => $Acci_DatosRegistro, "Acci_Trafico" => $Acci_Trafico, "Acci_Reincidencia" => $Acci_Reincidencia, "Acci_FechaCierreReporte" => $Acci_FechaCierreReporte, "Acci_FechaRegistro" => date("Y-m-d",strtotime($Acci_FechaCerrar)), "Acci_TiempoInvestigacion" => $Acci_TiempoInvestigacion, "Acci_DelayRegistro" => $Acci_DelayRegistro, "Acci_CumplimientoRegistro" => $Acci_CumplimientoRegistro, "Acci_DocReporteAtencion" => $Acci_DocReporteAtencion ];

        print json_encode($aDatosCalculados, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
    }

    public function GravedadEvento($Acci_Frecuencia,$Acci_Probabilidad,$Acci_Severidad)
    {
        $nSuma = 0;
        $rptaGravedadEvento = "";
        
        if($Acci_Frecuencia==""){$Acci_Frecuencia=0;}
        if($Acci_Probabilidad==""){$Acci_Probabilidad=0;}
        if($Acci_Severidad==""){$Acci_Severidad=0;}
        
        $nSuma = $Acci_Frecuencia + $Acci_Probabilidad + $Acci_Severidad;

        if($nSuma < 1){
          $rptaGravedadEvento = "";
        }else{
          if($nSuma <= 4){
            $rptaGravedadEvento = "LEVE";
          }else{
            if($nSuma <= 6){
              $rptaGravedadEvento = "SERIO";
            }else{
              $rptaGravedadEvento = "MAYOR";
            }
          }
        }
        echo $rptaGravedadEvento;
    }

    public function ResponsabilidadAccidente($Acci_ResponsabilidadContributivo,$Acci_ResponsabilidadDeterminante)
    {
        $rptaResponsabilidadAccidente="";
        if($Acci_ResponsabilidadContributivo==""){
            $rptaResponsabilidadAccidente="";
        }else{
            if($Acci_ResponsabilidadDeterminante=="PILOTO"){
                $rptaResponsabilidadAccidente="DIRECTA";
            }else{
                if($Acci_ResponsabilidadContributivo=="PILOTO"){
                    $rptaResponsabilidadAccidente="INDIRECTA";
                }else{
                    $rptaResponsabilidadAccidente="NO";
                }
            }
        }
        echo $rptaResponsabilidadAccidente;
    }

    public function CumplimientoMeta($Acci_TipoExpediente,$Acci_TiempoInvestigacion)
    {
        $rptaCumplimientoMeta="";
        $nAcci_TiempoInvestigacion = (int)$Acci_TiempoInvestigacion;
        switch ($Acci_TipoExpediente)
        {
            case "CRITICO":
                $Tiempo = 3;
            break;
            case "EXTEMPORANEO":
                $Tiempo = 30;
            break;
            case "INVESTIGACION":
                $Tiempo = 60;
            break;
            case "REGULAR":
                $Tiempo = 7;
            break;
        }
        if($nAcci_TiempoInvestigacion <= $Tiempo){
            $rptaCumplimientoMeta="On Time";
        }else{
            $rptaCumplimientoMeta="Off Time";
        }
        echo $rptaCumplimientoMeta;
    }

    public function CodigoRIT($Acci_GradoFalta)
    {
        $html = '<option value="">Seleccione una opcion</option>';
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $TablaBD = 'ope_accidentesmatriz';
        $CampoBD = 'acmt_campo';
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Acci_GradoFalta);
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['acmt_busqueda'].'">'.$row['acmt_busqueda'].'</option>';
        }
        echo $html;
    }

    public function DescripcionRIT($Acci_CodigoRIT,$Acci_GradoFalta)
    {
        $rptaDescripcionRIT = "";
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->DescripcionRIT($Acci_CodigoRIT,$Acci_GradoFalta);
        foreach ($Respuesta as $row) {
            $rptaDescripcionRIT .= $row['acmt_respuesta'];
        }
        echo $rptaDescripcionRIT;
    }

    public function AccionDisciplinaria($Acci_CodigoRIT, $Acci_Reincidencia)
    {
        $rptaAccionDisciplinaria = "";
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->AccionDisciplinaria($Acci_CodigoRIT,$Acci_Reincidencia);
        foreach ($Respuesta as $row) {
            $rptaAccionDisciplinaria .= $row['acmt_respuesta'];
        }
        echo $rptaAccionDisciplinaria;
    }

    public function PDFInformePreliminar($Accidentes_Id)
    {
        $micarpeta = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date = str_replace(".", "", $date);
        $id_date = $Accidentes_Id."_".$date;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Imagen = $InstanciaAjax->BuscarImagenPDF($Accidentes_Id);
        $filename = "Imagen".$Accidentes_Id."_".$date;
        $file_json = $filename.".json";
        $data = json_encode($Imagen, JSON_UNESCAPED_UNICODE);

        file_put_contents($micarpeta."/".$file_json, $data);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $InformePreliminar = $InstanciaAjax->PDFInformePreliminar($Accidentes_Id);
        $filename = "InformePreliminar".$Accidentes_Id."_".$date;
        $file_json = $filename.".json";
        $data = json_encode($InformePreliminar, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $TablaBD = 'OPE_AccidentesNaturaleza';
        $CampoBD = 'Accidentes_Id';
        $Naturaleza = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Accidentes_Id);
        $filename = "Naturaleza".$Accidentes_Id."_".$date;
        $file_json = $filename.".json";
        $data = json_encode($Naturaleza, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $TablaBD = 'OPE_AccidentesReparacion';
        $CampoBD = 'Accidentes_Id';
        $Reparacion = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Accidentes_Id);
        $filename = "Reparacion".$Accidentes_Id."_".$date;
        $file_json = $filename.".json";
        $data = json_encode($Reparacion, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);

        echo $id_date;
    }

    public function DocumentRoot()
    {
        $miCarpeta = '';
        $miHost = $_SERVER['HTTP_HOST'];
        $miReferer = $_SERVER['HTTP_REFERER'];
        $miCarpeta = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
    }

    public function horas_trabajadas($operacion, $fecha, $codigo, $hora)
    {
        $rpta_horas_trabajadas = "";
        $CFaRg_Estado = "";

        $TablaBD = "OPE_ControlFacilitadorRegistroCarga";
        $CampoBD = "CFaRg_FechaCargada";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$fecha);

        foreach ($Respuesta as $row) {
            if($row['CFaRg_TipoOperacionCargada']==$operacion && $row['CFaRg_Estado']!="ELIMINADO"){
                $CFaRg_Estado = $row['CFaRg_Estado'];
            };
        }

        if($CFaRg_Estado=="CERRADO"){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->horas_trabajadas_hist($operacion, $fecha, $codigo, $hora);    
        }
        if($CFaRg_Estado=="GENERADO"){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->horas_trabajadas($operacion, $fecha, $codigo, $hora);    
        }

        foreach ($Respuesta as $row) {
            $rpta_horas_trabajadas = $row['horas_trabajadas'];
        }

        echo $rpta_horas_trabajadas;
    }

    public function km_perdidos($Accidentes_Id, $operacion, $bus, $fecha_operacion)
    {
        $rpta_km_perdidos = "";
        $CFaRg_Estado = "";

        $TablaBD = "OPE_ControlFacilitadorRegistroCarga";
        $CampoBD = "CFaRg_FechaCargada";
        
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$fecha_operacion);

        foreach ($Respuesta as $row) {
            if($row['CFaRg_TipoOperacionCargada']==$operacion && $row['CFaRg_Estado']!="ELIMINADO"){
                $CFaRg_Estado = $row['CFaRg_Estado'];
            };
        }

        if($CFaRg_Estado=="CERRADO"){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->km_perdidos_hist($Accidentes_Id, $operacion, $bus, $fecha_operacion);
        }
        if($CFaRg_Estado=="GENERADO"){
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->km_perdidos($Accidentes_Id, $operacion, $bus, $fecha_operacion);
        }     

        foreach ($Respuesta as $row) {
            $rpta_km_perdidos = $row['km_perdidos'];
        }
        echo $rpta_km_perdidos;
    }

    public function guardar_pdf_informe_preliminar($Accidentes_Id)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->cerrar_pdf_informe_preliminar($Accidentes_Id);

        $micarpeta  = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date       = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date       = str_replace(".", "", $date);
        $id_date    = $Accidentes_Id."_".$date;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Imagen         = $InstanciaAjax->BuscarImagenPDF($Accidentes_Id);
        $filename       = "Imagen".$Accidentes_Id."_".$date;
        $file_json      = $filename.".json";
        $data           = json_encode($Imagen, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $InformePreliminar = $InstanciaAjax->PDFInformePreliminar($Accidentes_Id);
        $filename = "InformePreliminar".$Accidentes_Id."_".$date;
        $file_json = $filename.".json";
        $data = json_encode($InformePreliminar, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $TablaBD = 'OPE_AccidentesNaturaleza';
        $CampoBD = 'Accidentes_Id';
        $Naturaleza = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Accidentes_Id);
        $filename = "Naturaleza".$Accidentes_Id."_".$date;
        $file_json = $filename.".json";
        $data = json_encode($Naturaleza, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $TablaBD = 'OPE_AccidentesReparacion';
        $CampoBD = 'Accidentes_Id';
        $Reparacion = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Accidentes_Id);
        $filename = "Reparacion".$Accidentes_Id."_".$date;
        $file_json = $filename.".json";
        $data = json_encode($Reparacion, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);
        
        $Id_DateJS = $id_date;
        MController($this->Modulo,'pdf');
        $pdf = new pdf();
        $pdf->AliasNbPages();

        $Data_Imagen            = $pdf->LoadData("Imagen".$Id_DateJS);
        $Data_InformePreliminar = $pdf->LoadData("InformePreliminar".$Id_DateJS);
        $Data_Naturaleza        = $pdf->LoadData("Naturaleza".$Id_DateJS);
        $Data_Reparacion        = $pdf->LoadData("Reparacion".$Id_DateJS);

        foreach($Data_InformePreliminar as $row){
            $Accidentes_Id          = $row['Accidentes_Id'];
            $Acci_TipoAccidente     = $row['Acci_TipoAccidente'];
            $Acci_Bus               = $row['Acci_Bus'];
            $Bus_NroPlaca           = $row['Bus_NroPlaca'];
            $Acci_NombreColaborador = $row['Acci_NombreColaborador'];
        }

        $pdf->SetFont('Arial','',14);
        $pdf->GeneraProgramacion($Data_InformePreliminar, $Data_Imagen, $Data_Naturaleza, $Data_Reparacion);
        $pdf->Output("Services/Json/IP-".$Accidentes_Id.".pdf",'F');

        $Acci_TipoImagen  = 'IP_PDF';

        $Acci_Imagen      = addslashes(file_get_contents('Services/Json/IP-'.$Accidentes_Id.'.pdf'));

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->GrabarImagen($Accidentes_Id,$Acci_TipoImagen,$Acci_Imagen);

        unlink("Services/Json/Imagen".$Id_DateJS.".json");
        unlink("Services/Json/InformePreliminar".$Id_DateJS.".json");
        unlink("Services/Json/Naturaleza".$Id_DateJS.".json");
        unlink("Services/Json/Reparacion".$Id_DateJS.".json");
        unlink("Services/Json/IP-".$Accidentes_Id.".pdf");
    }

    public function permisos($nombre_modulo, $nombre_objeto)
    {
        $rpta_permisos = "";

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->Permisos($nombre_modulo, $nombre_objeto);
        $rpta_permisos  = $Respuesta;
        echo $rpta_permisos;
    }

    public function buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo, $nombre_archivo)
    {
        $b64_file       = "";
        $b64_file_name  = "";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD;
        $Respuesta      = $InstanciaAjax->buscar_pdf($tabla, $campo_archivo, $campo_buscar, $dato_buscar, $campo_tipo_archivo, $dato_tipo_archivo);

        foreach($Respuesta as $row){
            $b64_file = $row['b64_file'];
        }

        if($b64_file!=""){
            $mi_carpeta     = $_SERVER['DOCUMENT_ROOT']."/Services/pdf";
            $date           = date('d-m-Y-'.substr((string)microtime(), 1, 8));
            $date           = str_replace(".", "", $date);
            $b64_file_name  = $nombre_archivo."_v".$date.".pdf";
            $b64_file       = base64_decode($b64_file,true);
            file_put_contents($mi_carpeta."/".$b64_file_name, $b64_file);        
        }

        echo $b64_file_name;
    }

    public function unlink_pdf($archivo)
    {
        $rpta_unlink_pdf = "ELIMINADO";
        $mi_carpeta  = $_SERVER['DOCUMENT_ROOT']."/Services/pdf";
        
        unlink($mi_carpeta.'/'.$archivo);
        
        if(file_exists($mi_carpeta.'/'.$archivo)){
            $rpta_unlink_pdf = "NO ELIMINADO";
        }
        
        echo $rpta_unlink_pdf;
    }
}