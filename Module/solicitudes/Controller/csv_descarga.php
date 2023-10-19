<?php
$filename = $_GET['Archivo'];
$file_csv = $filename.".csv";

$JsData = file_get_contents("../../../Services/Json/".$filename.".json");
$data   = json_decode($JsData, true);


// CABECERA DE COLUMNAS
$header_args = array(
    'ID',
    'FECHA INGRESO',
    'FECHA_RECEPCION',
    'DNI',
    'APELLIDOS Y NOMBRES',
    'FECHA INICIO',
    'FECHA FIN',
    'TIPO',
    'CODIGO ADMINISTRATIVO',
    'DESCRIPCION',
    'ESTADO',
    'RESPUESTA',
    'DETALLE RESPUESTA',
    'REGISTRADO POR',
    'RESPONSABLE',
    'LOG'
);

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
        $row['solicitudes_id'],
        $row['soli_fecha_ingreso'],
        $row['soli_fecha_recepcion'],
        $row['soli_dni'],
        $row['soli_apellidos_nombres'],
        $row['soli_fecha_inicio'],
        $row['soli_fecha_fin'],
        $row['soli_tipo'],
        $row['soli_codigo_adm'],
        preg_replace("/[\r\n|\n|\r]+/", " ",$row['soli_descripcion']),
        $row['soli_estado'],
        $row['soli_respuesta'],
        preg_replace("/[\r\n|\n|\r]+/", " ",$row['soli_detalle_respuesta']),
        $row['soli_usuario_nombres'],
        $row['soli_responsable_nombres'],
        $row['soli_log']
    ];
}

foreach($data_array AS $data_item){
    fputcsv($output, $data_item);
}

unlink("../../../Services/Json/".$filename.".json");
exit();