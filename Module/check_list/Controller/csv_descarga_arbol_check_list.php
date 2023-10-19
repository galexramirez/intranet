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
    $data_array[] = [$row['chl_bus_tipo'],
                    $row['chl_orden'],
                    $row['chl_codigo'],
                    $row['chl_descripcion'],
                    $row['chl_componente'],
                    $row['chl_posicion'],
                    $row['chl_falla'],
                    $row['chl_accion']]; 
}


foreach($data_array AS $data_item){
    fputcsv($output, $data_item);
}

unlink("../../../Services/Json/".$filename.".json");
exit();