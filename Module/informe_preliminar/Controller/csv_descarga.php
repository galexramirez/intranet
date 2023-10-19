<?php
$filename   = $_GET['Archivo'];
$file_csv   = $filename.".csv";

$JsData = file_get_contents("../../../Services/Json/".$filename.".json");
$data= json_decode($JsData, true);


// CABECERA DE COLUMNAS
$header_args = array(   'COD. APLICACION',
                        'FECHA ACCID.',
                        'PILOTO',
                        'BUS',
                        'PLACA',
                        'OPERACION',
                        'TIPO',
                        'CLASE',
                        'EVENTO',
                        'CONSECUENCIAS',
                        'DAÑOS MATERIALES',
                        'PIL.REC.RESP.',
                        'RESPONSABIL.',
                        'NRO.SINIESTRO',
                        'DETALLE DAÑOS');

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

        foreach ($data as $row) {
            $data_array[] = [   $row['codigo_aplicacion'],
                                $row['fecha_accidente'],
                                $row['nombre_piloto'],
                                $row['bus'],
                                $row['nro_placa'],
                                $row['operacion'],
                                $row['tipo'],
                                $row['clase'],
                                $row['evento'],
                                $row['consecuencias'],
                                $row['danos'],
                                $row['piloto_reconoce_responsabilidad'],
                                $row['responsabilidad'],
                                $row['nro_siniestro'],
                                preg_replace("/[\r\n|\n|\r]+/", " ",$row['detalle_danos']) ]; 
        }

foreach($data_array AS $data_item){
    fputcsv($output, $data_item);
}

unlink("../../../Services/Json/".$filename.".json");
exit();