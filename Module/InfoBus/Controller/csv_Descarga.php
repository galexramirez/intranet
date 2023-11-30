<?php
$filename   = $_GET['Archivo'];
$tipo       = $_GET['Tipo'];
$file_csv   = $filename.".csv";

$JsData = file_get_contents("../../../Services/Json/".$filename.".json");
$data= json_decode($JsData, true);


// CABECERA DE COLUMNAS
$header_args = array('C/P NUMERO OT',
    'ESTADO',
    'FECHA APERTURA-PROGRAMADA',
    'GENERA OT',
    'BUS',
    'ORIGEN-FRECUENCIA',
    'ASOCIADO',
    'RESP. ASOCIADO',
    'DESCRIPCION',
    'KILOMETRAJE',
    'HORA MOTOR',
    'SISTEMA',
    'CODIGO FALLA',
    'CHECK',
    'INICIO ACTIVIDAD',
    'FIN ACTIVIDAD',
    'DURACION ACTIVIDAD',
    'ACCION TOMADA',
    'OBS ASOCIADO',
    'TECNICO DE ACTIVIDAD',
    'COMPONENTE MONTADO',
    'COMPONENTE DESMONTADO',
    'BUS MONTADO',
    'BUS DESMONTADO',
    'MOTIVO',
    'FECHA CIERRE TECNICO',
    'CGM CIERRE TECNICO',
    'OBS CGM',
    'FECHA CIERRE ADM',
    'RESPONSABLE CIERRE ADM',
    'OBS CIERRE ADMINISTRATIVO',
    'SEMANA',
    'TURNO',
    'PUBLICACION');

// redirect output to client browser
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="'.$file_csv.'"');
header('Cache-Control: max-age=0');

// create a file using php
$output = fopen( 'php://output', 'w' );

// clean up output buffer
ob_end_clean();

// write header to csv file
fputcsv($output, $header_args);

// write actual content to csv file
switch ($tipo)
{
	case "GENERAL":
        foreach ($data as $row) {
            $data_array[] = [$row['ib_nro_ot'],
                            $row['ib_estado'],
                            $row['ib_fecha_genera'],
                            $row['ib_cgm_genera'],
                            $row['ib_bus'],
                            $row['ib_orig_frec'],
                            $row['ib_asociado'],
                            $row['ib_tecn_resp'],
                            $row['ib_desc_acti'],
                            $row['ib_km'],
                            $row['ib_hmotor'],
                            $row['ib_sistema'],
                            $row['ib_codfalla'],
                            $row['ib_check'],
                            $row['ib_inicio'],
                            $row['ib_fin'],
                            $row['ib_duracion_actividad'],
                            preg_replace("/[\r\n|\n|\r]+/", " ",$row['ib_accion_tomada']),
                            preg_replace("/[\r\n|\n|\r]+/", " ",$row['ib_obs_asoc']),
                            $row['ib_tecnico'],
                            $row['ib_montado'],
                            $row['ib_dmontado'],
                            $row['ib_busmont'],
                            $row['ib_busdmont'],
                            $row['ib_motivo'], 
                            $row['ib_fecha_cierre_tecnico'],
                            $row['ib_cgm_cierre_tecnico'],
                            preg_replace("/[\r\n|\n|\r]+/", " ",$row['ib_obs_cgm']),
                            $row['ib_date_ca'],
                            $row['ib_ca'],
                            $row['ib_obs_aom'],
                            $row['ib_semana'], 
                            $row['ib_turno'],
                            $row['ib_publicacion']]; 
        }
    break;
            
    case "CORRECTIVAS":
        foreach ($data as $row) {
            $data_array[] = [$row['cod_ot'],
                            $row['ot_estado'],
                            $row['ot_date_crea'],
                            $row['ot_cgm_crea'],
                            $row['ot_bus'],
                            $row['ot_origen'],
                            $row['ot_asociado'],
                            $row['ot_resp_asoc'],
                            $row['ot_descrip'],
                            $row['ot_kilometraje'],
                            $row['ot_hmotor'],
                            $row['ot_sistema'],
                            $row['ot_codfalla'],
                            $row['ot_check'],
                            $row['ot_inicio'],
                            $row['ot_fin'],
                            $row['ot_duracion_actividad'],
                            preg_replace("/[\r\n|\n|\r]+/", " ",$row['ot_at']),
                            preg_replace("/[\r\n|\n|\r]+/", " ",$row['ot_obs_asoc']),
                            $row['ot_tecnico'],
                            $row['ot_montado'],
                            $row['ot_dmontado'],
                            $row['ot_busmont'],
                            $row['ot_busdmont'],
                            $row['ot_motivo'],
                            $row['ot_date_ct'],
                            $row['ot_cgm_ct'],
                            preg_replace("/[\r\n|\n|\r]+/", " ",$row['ot_obs_cgm']),
                            $row['ot_date_ca'],
                            $row['ot_ca'],
                            $row['ot_obs_aom'],
                            $row['ot_semana'],
                            $row['ot_turno'],
                            $row['ot_publicacion']];
        }
    break;

    case "PREVENTIVAS":
        foreach ($data as $row) {
            $data_array[] = [$row['cod_otpv'],
                            $row['otpv_estado'],
                            $row['otpv_date_prog'],
                            $row['otpv_genera'],
                            $row['otpv_bus'],
                            $row['otpv_fecuencia'],
                            $row['otpv_asociado'],
                            $row['otpv_tecnico'],
                            $row['otpv_descripcion'],
                            $row['otpv_kmrealiza'],
                            $row['otpv_hmotor'],
                            $row['otpv_sistema'],
                            $row['otpv_codfalla'],
                            $row['otpv_check'],
                            $row['otpv_inicio'],
                            $row['otpv_fin'],
                            $row['otpv_duracion_actividad'],
                            preg_replace("/[\r\n|\n|\r]+/", " ",$row['otpv_acciontomada']),
                            preg_replace("/[\r\n|\n|\r]+/", " ",$row['otpv_obs_as']),
                            $row['otpv_tecnico2'],
                            $row['otpv_montado'],
                            $row['otpv_dmontado'],
                            $row['otpv_busmont'],
                            $row['otpv_busdmont'],
                            $row['otpv_motivo'],
                            $row['otpv_date_cierre_tecnico'],
                            $row['otpv_cgm_cierra'],
                            preg_replace("/[\r\n|\n|\r]+/", " ",$row['otpv_obs_cgm']),
                            $row['otpv_date_cierra_ad'],
                            $row['otpv_cierra_ad'],
                            $row['otpv_obs_cierre_ad'],
                            $row['otpv_semana'],
                            $row['otpv_turno'],
                            $row['otpv_date_genera']];
        }
    break;
}

foreach($data_array AS $data_item){
    fputcsv($output, $data_item);
}

unlink("../../../Services/Json/".$filename.".json");
exit();