<?php
$filename   = $_GET['archivo'];
$file_csv   = $filename.".csv";

$JsData = file_get_contents("../../../Services/Json/".$filename.".json");
$data = json_decode($JsData, true);

// CABECERA DE COLUMNAS
$header_args = array(   'FLOTA',
                        'ORDEN',
                        'CODIGO',
                        'DESCRIPCION',
                        'COMPONENTE',
                        'POSICION',
                        'FALLA',
                        'ACCION'
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
    $data_array[] = [$row['fav_bus_tipo'],
                    $row['fav_orden'],
                    $row['fav_codigo'],
                    $row['fav_descripcion'],
                    $row['fav_componente'],
                    $row['fav_posicion'],
                    $row['fav_falla'],
                    $row['fav_accion']]; 
}


foreach($data_array AS $data_item){
    fputcsv($output, $data_item);
}

unlink("../../../Services/Json/".$filename.".json");
exit();