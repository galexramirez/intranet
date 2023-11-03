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
            $data_array[] = [$row['ot_id'],
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


foreach($data_array AS $data_item){
    fputcsv($output, $data_item);
}

unlink("../../../Services/Json/".$filename.".json");
exit();