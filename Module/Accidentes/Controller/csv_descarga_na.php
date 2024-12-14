<?php
$filename = $_GET['Archivo'];
$file_na_csv = "informe_naturaleza".".csv";

$data   = json_decode($filename, true);
foreach ($data as $key => $value) {
    if($value['tipo']=="naturaleza"){
        $file_url_na = "../../../Services/files/json/".$value["file_json"];
        $js_data_na = file_get_contents($file_url_na);
        $data_na = json_decode($js_data_na,true);
        break;
    }
}


// CABECERA DE COLUMNAS
$header_na_args = array(
    'Numero IP', 
    'Acci_Tipo', 
    'Acci_Descripcion', 
    'Acci_Nombre', 
    'Acci_Dni', 
    'Acci_Edad', 
    'Acci_Genero', 
    'Acci_Placa', 
    'acci_origen'
);

// redirect output to client browser
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="'.$file_na_csv.'"');
header('Cache-Control: max-age=0');

// create a file using php
$output_na = fopen( 'php://output', 'w' );

// clean up output buffer
ob_end_clean();

// write header to csv file
fputcsv($output_na, $header_na_args);

// write actual content to csv file
foreach ($data_na as $key => $row) {
    $data_array_na[] = [
        $row['Accidentes_Id'], 
        $row['Acci_Tipo'], 
        $row['Acci_Descripcion'], 
        $row['Acci_Nombre'], 
        $row['Acci_Dni'], 
        $row['Acci_Edad'], 
        $row['Acci_Genero'], 
        $row['Acci_Placa'], 
        $row['acci_origen']];
}

foreach($data_array_na as $data_item_na){
    fputcsv($output_na, $data_item_na);
}
fclose($output_na);
unlink($file_url_na);
exit();