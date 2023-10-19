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
                        'CARGO DE PILOTO',
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
                        'CODIGO FALTA',
                        'MONTO',
                        'RECONOCE RESPONSABILIDAD',
                        'AFECTA PREMIO',
                        'FALTA COMETIDA',
                        'FECHA QUE GENERA',
                        'FECHA QUE CIERRA',
                        'TIEMPO ATENCION'
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
            $data_array[] = [   $row['comp_novedadid'],
                                $row['comp_nombrecgo'],
                                $row['comp_codigocolaborador'],
                                $row['comp_nombrecolaborador'],
                                $row['comp_dni'],
                                $row['comp_cargo_colaborador'],
                                $row['comp_fechaoperacion'],
                                $row['comp_horainicio'],
                                $row['comp_horafin'],
                                $row['comp_total_horas'],
                                $row['comp_bus'],
                                $row['Bus_Tipo2'],
                                $row['comp_tabla'],
                                $row['comp_servicio'],
                                $row['comp_lugar_origen'],
                                $row['comp_lugar_destino'],
                                $row['comp_tiponovedad'],
                                $row['comp_detallenovedad'],
                                preg_replace("/[\r\n|\n|\r]+/", " ",$row['comp_descripcion']),
                                $row['comp_codigofalta'],
                                $row['comp_monto'],
                                $row['comp_reconoceresponsabilidad'],
                                $row['comp_afectapremio'],
                                $row['comp_faltacometida'],
                                $row['comp_fechagenerar'],
                                $row['comp_fechacerrar'],
                                $row['comp_tiempo_atencion']
                            ];
        }


foreach($data_array AS $data_item){
    fputcsv($output, $data_item);
}

unlink("../../../Services/Json/".$filename.".json");
exit();
