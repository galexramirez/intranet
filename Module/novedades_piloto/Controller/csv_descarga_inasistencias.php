<?php
$filename = $_GET['Archivo'];
$file_csv = $filename.".csv";

$JsData = file_get_contents("../../../Services/Json/".$filename.".json");
$data   = json_decode($JsData, true);


// CABECERA DE COLUMNAS
$header_args = array(   'NOVEDAD ID',
                        'NOMBRES CGO',                        
                        'CODIGO PILOTO',
                        'NOMBRES PILOTO',
                        'NRO. DNI PILOTO',
                        'CARGO PILOTO',
                        'FECHA',
                        'HORA INICIO',
                        'HORA FIN',
                        'TOTAL HORAS',
                        'BUS',
                        'TIPO BUS',
                        'TABLA',
                        'SERVICIO',
                        'LUGAR ORIGEN',
                        'LUGAR DESTINO',
                        'TIPO DE NOVEDAD',
                        'DETALLE DE NOVEDAD',
                        'DESCRIPCION',
                        'TURNO'
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
            $data_array[] = [   $row['inas_novedadid'],
                                $row['inas_nombrecgo'],                    
                                $row['inas_codigocolaborador'],
                                $row['inas_nombrecolaborador'],
                                $row['inas_dni'],
                                $row['inas_cargo_colaborador'],
                                $row['inas_fechaoperacion'],
                                $row['inas_horainicio'],
                                $row['inas_horafin'],
                                $row['inas_totalhoras'],
                                $row['inas_bus'],
                                $row['Bus_Tipo2'],
                                $row['inas_tabla'],
                                $row['inas_servicio'],
                                $row['inas_lugar_origen'],
                                $row['inas_lugar_destino'],
                                $row['inas_tiponovedad'],
                                $row['inas_detallenovedad'],
                                preg_replace("/[\r\n|\n|\r]+/", " ",$row['inas_descripcion']),
                                $row['inas_turno']
                            ];
        }


foreach($data_array AS $data_item){
    fputcsv($output, $data_item);
}

unlink("../../../Services/Json/".$filename.".json");
exit();
