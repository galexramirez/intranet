<?php
$filename = $_GET['Archivo'];
$file_csv = $filename.".csv";

$JsData = file_get_contents("../../../Services/Json/".$filename.".json");
$data   = json_decode($JsData, true);


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
foreach ($data as $row) {
    $data_array[] = [$row['cod_otpv'],
                    $row['otpv_estado'],
                    $row['otpv_date_prog'],
                    $row['otpv_genera'],
                    $row['otpv_bus'],
                    $row['otpv_frecuencia'],
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
                    $row['otpv_tecnico'],
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


foreach($data_array AS $data_item){
    fputcsv($output, $data_item);
}

unlink("../../../Services/Json/".$filename.".json");
exit();