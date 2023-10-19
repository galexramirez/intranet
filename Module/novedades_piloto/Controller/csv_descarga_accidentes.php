<?php
$filename = $_GET['Archivo'];
$file_csv = $filename.".csv";

$JsData = file_get_contents("../../../Services/Json/".$filename.".json");
$data   = json_decode($JsData, true);


// CABECERA DE COLUMNAS
$header_args = array(   'ACCIDENTE ID', 
                        'NOMBRES CGO',                         
                        'FECHA', 
                        'HORA', 
                        'NRO. DNI PILOTO', 
                        'CODIGO PILOTO',
                        'NOMBRES DE PILOTO',
                        'BUS', 
                        'TIPO BUS',
                        'TABLA', 
                        'SERVICIO', 
                        'LUGAR', 
                        'SENTIDO', 
                        'TIPO DE ACCIDENTE', 
                        'EVENTO', 
                        'DESCRIPCION', 
                        'DAÑOS MATERIALES', 
                        'FACTOR DETERMINANTE', 
                        'RESPOS. DETERMINANTE', 
                        'FACTOR CONTRIBUTIVO', 
                        'RESPOS. CONTRIBUTIVO',
                        'CODIGO FALTA',
                        'FALTA RIT',
                        'RECONONCE RESPONSABILIDAD',
                        'AFECTA BONO',
                        'RESPONSABILIDAD',
                        'TIPO DISCIPLINA',
                        'GESTIONA',
                        'TIEMPO INVESTIGACION',
                        'FECHA REGISTRO'
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
            $data_array[] = [   $row['Accidentes_Id'], 
                                $row['Acci_NombreCGO'], 
                                $row['Acci_Fecha'], 
                                $row['Acci_Hora'], 
                                $row['Acci_Dni'], 
                                $row['Acci_CodigoColaborador'], 
                                $row['Acci_NombreColaborador'],
                                $row['Acci_Bus'], 
                                $row['Bus_Tipo2'],
                                $row['Acci_Tabla'], 
                                $row['Acci_Servicio'], 
                                $row['Acci_Lugar'], 
                                $row['Acci_Sentido'], 
                                $row['Acci_TipoAccidente'], 
                                $row['Acci_TipoEvento'], 
                                preg_replace("/[\r\n|\n|\r]+/", " ",$row['Acci_Descripcion']), 
                                $row['Acci_DanosMateriales'],                                 
                                $row['Acci_FactorDeterminante'], 
                                $row['Acci_ResponsabilidadDeterminante'], 
                                $row['Acci_FactorContributivo'], 
                                $row['Acci_ResponsabilidadContributivo'], 
                                $row['Acci_CodigoRIT'],
                                $row['Acci_DescripcionRIT'],
                                $row['Acci_ReconoceResponsabilidad'],
                                $row['acci_afecta_premio'],
                                $row['Acci_ResponsabilidadAccidente'],
                                $row['Acci_AccionDisciplinaria'],
                                $row['acci_nombre_usuario_cierre'],
                                $row['Acci_TiempoInvestigacion'],
                                $row['Acci_Fecha_Cierre']
                            ];
        }


foreach($data_array AS $data_item){
    fputcsv($output, $data_item);
}

unlink("../../../Services/Json/".$filename.".json");
exit();



