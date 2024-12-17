<?php
$filename = $_GET['Archivo'];
$date = date('d-m-Y-'.substr((string)microtime(), 1, 8));
$date = str_replace(".", "", $date);
$file_re_csv = "informe_reparacion_".$date.".csv";

$data   = json_decode($filename, true);
foreach ($data as $key => $value) {
    if($value['tipo']=="reparacion"){
        $file_url_re = "../../../Services/files/json/".$value["file_json"];
        $js_data_re = file_get_contents($file_url_re);
        $data_re = json_decode($js_data_re,true);
        break;
    }
}

// CABECERA DE COLUMNAS
$header_re_args = array(
    'Numero IP', 
    'CodigoColor', 
    'SeccionBus', 
    'DescripcionReparacion'
);

// redirect output to client browser
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="'.$file_re_csv.'"');
header('Cache-Control: max-age=0');

// create a file using php
$output_re = fopen( 'php://output', 'w' );

// clean up output buffer
ob_end_clean();

// write header to csv file
fputcsv($output_re, $header_re_args);

// write actual content to csv file
foreach ($data_re as $key => $row) {
    $data_array_re[] = [
        $row['Accidentes_Id'], 
        $row['Acci_CodigoColor'], 
        $row['Acci_SeccionBus'], 
        preg_replace("/[\r\n|\n|\r]+/", " ",$row['Acci_DescripcionReparacion'])];
}

foreach($data_array_re as $data_item_re){
    fputcsv($output_re, $data_item_re);
}
fclose($output_re);
unlink($file_url_re);

exit();