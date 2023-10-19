<?php
$filename = $_GET['Archivo'];
$file_csv = $filename.".csv";

$JsData = file_get_contents("../../../Services/Json/".$filename.".json");
$data   = json_decode($JsData, true);


// CABECERA DE COLUMNAS
$header_args = array('CODIGO VALE',
'ESTADO',
'CODIGO OT',
'BUS',
'ORIGEN',
'ASOCIADO',
'RESPONSABLE_ASOCIADO',
'DESCRIPCION_ACTIVIDAD',
'GENERA',
'FECHA_GENERA',
'OBSERVACIONES CGM',
'TIPO REPUESTO',
'CODIGO REPUESTO',
'DESCRIPCION_REPUESTO',
'NRO. SERIE',
'CANTIDAD',
'UNIDAD',
'CIERRE_ADMINISTRATIVO',
'FECHA_CIERRE_ADM.',
'HORA CIERRE ADM.',
'OBSERVACIONES_AOM');

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
    $data_array[] = [
        $row['cod_vale'],
        $row['va_estado'],
        $row['va_ot'],
        $row['ot_bus'],
        $row['ot_origen'],
        $row['va_asociado'],
        $row['va_responsable'],
        preg_replace("/[\r\n|\n|\r]+/", " ",$row['ot_descrip']),
        $row['va_genera'],
        $row['va_date_genera'],
        preg_replace("/[\r\n|\n|\r]+/", " ",$row['va_obs_cgm']),
        $row['va_garantia'],
        $row['rv_repuesto'],
        preg_replace("/[\r\n|\n|\r]+/", " ",$row['rep_desc']),
        $row['rv_nroserie'],
        $row['rv_cantidad'],
        $row['rep_unidad'],
        $row['va_cierre_adm'],
        $row['va_date_cierre_adm'],
        $row['va_time_cierre_adm'],
        preg_replace("/[\r\n|\n|\r]+/", " ",$row['va_obs_aom'])
    ];
        }

foreach($data_array AS $data_item){
    fputcsv($output, $data_item);
}

unlink("../../../Services/Json/".$filename.".json");
exit();