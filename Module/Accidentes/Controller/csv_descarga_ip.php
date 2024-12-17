<?php
$filename = $_GET['Archivo'];
$date = date('d-m-Y-'.substr((string)microtime(), 1, 8));
$date = str_replace(".", "", $date);
$file_ip_csv = "informe_preliminar_".$date.".csv";

$data   = json_decode($filename, true);
foreach ($data as $key => $value) {
    if($value['tipo']=="ip"){
        $file_url_ip = "../../../Services/files/json/".$value["file_json"];
        $js_data_ip = file_get_contents($file_url_ip);
        $data_ip = json_decode($js_data_ip,true); 
        break;
    }
}

// CABECERA DE COLUMNAS
$header_ip_args = array(
    'Numero IP', 
    'Operacion', 
    'TipoAccidente', 
    'ClaseAccidente', 
    'DanosMateriales', 
    'Lesiones', 
    'Fatalidad', 
    'Otro', 
    'OtroDescripcion', 
    'TipoEvento', 
    'Fecha', 
    'Hora', 
    'Dni', 
    'CodigoColaborador', 
    'NombreColaborador', 
    'Tabla', 
    'Servicio', 
    'Bus', 
    'Lugar', 
    'Sentido', 
    'CodigoCGO', 
    'NombreCGO', 
    'CodigoPersonalApoyo', 
    'NombrePersonalApoyo', 
    'km_perdidos', 
    'Conciliacion', 
    'MontoConciliado', 
    'Hospital', 
    'ReconoceResponsabilidad', 
    'Comisaria', 
    'DocReporte', 
    'DocConciliacion', 
    'DocPartePolicial', 
    'DocOficioPeritaje', 
    'DocReporteAtencion', 
    'DocDenunciaPolicial', 
    'DocCitacionManifestacion', 
    'DocOtro', 
    'DocOtroDescripcion', 
    'HoraFinAtencion', 
    'HorasTrabajadas', 
    'Descripcion', 
    'CodigoSuscribeInformacion', 
    'NombreSuscribeInformacion', 
    'FechaElaboracionInforme', 
    'Objeto', 
    'HoraLlegadaProcurador', 
    'CodigoCGM', 
    'NombreCGM', 
    'CodigoPersonalApoyoManto', 
    'NombrePersonalApoyoManto', 
    'NumeroOT', 
    'EstadoInformePreliminar', 
    'UsuarioId_Generar', 
    'FechaGenerar', 
    'UsuarioId_Edicion', 
    'FechaEdicion', 
    'UsuarioId_Cerrar', 
    'FechaCerrar', 
    'log_ip', 
    'lugar_referencia'
);

// redirect output to client browser
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="'.$file_ip_csv.'"');
header('Cache-Control: max-age=0');

// create a file using php
$output_ip = fopen( 'php://output', 'w' );

// clean up output buffer
ob_end_clean();

// write header to csv file
fputcsv($output_ip, $header_ip_args);

// write actual content to csv file
foreach ($data_ip as $key => $row) {
    $data_array_ip[] = [
        $row['Accidentes_Id'], 
        $row['Acci_Operacion'], 
        $row['Acci_TipoAccidente'], 
        $row['Acci_ClaseAccidente'], 
        $row['Acci_DanosMateriales'], 
        $row['Acci_Lesiones'], 
        $row['Acci_Fatalidad'], 
        $row['Acci_Otro'], 
        $row['Acci_OtroDescripcion'], 
        $row['Acci_TipoEvento'], 
        $row['Acci_Fecha'], 
        $row['Acci_Hora'], 
        $row['Acci_Dni'], 
        $row['Acci_CodigoColaborador'], 
        $row['Acci_NombreColaborador'], 
        $row['Acci_Tabla'], 
        $row['Acci_Servicio'], 
        $row['Acci_Bus'], 
        $row['Acci_Lugar'], 
        $row['Acci_Sentido'], 
        $row['Acci_CodigoCGO'], 
        $row['Acci_NombreCGO'], 
        $row['Acci_CodigoPersonalApoyo'], 
        $row['Acci_NombrePersonalApoyo'], 
        $row['Acci_km_perdidos'], 
        $row['Acci_Conciliacion'], 
        $row['Acci_MontoConciliado'], 
        $row['Acci_Hospital'], 
        $row['Acci_ReconoceResponsabilidad'], 
        $row['Acci_Comisaria'], 
        $row['Acci_DocReporte'], 
        $row['Acci_DocConciliacion'], 
        $row['Acci_DocPartePolicial'], 
        $row['Acci_DocOficioPeritaje'], 
        $row['Acci_DocReporteAtencion'], 
        $row['Acci_DocDenunciaPolicial'], 
        $row['Acci_DocCitacionManifestacion'], 
        $row['Acci_DocOtro'], 
        $row['Acci_DocOtroDescripcion'], 
        $row['Acci_HoraFinAtencion'], 
        $row['Acci_HorasTrabajadas'], 
        preg_replace("/[\r\n|\n|\r]+/", " ",$row['Acci_Descripcion']), 
        $row['Acci_CodigoSuscribeInformacion'], 
        $row['Acci_NombreSuscribeInformacion'], 
        $row['Acci_FechaElaboracionInforme'], 
        $row['Acci_Objeto'], 
        $row['Acci_HoraLlegadaProcurador'], 
        $row['Acci_CodigoCGM'], 
        $row['Acci_NombreCGM'], 
        $row['Acci_CodigoPersonalApoyoManto'], 
        $row['Acci_NombrePersonalApoyoManto'], 
        $row['Acci_NumeroOT'], 
        $row['Acci_EstadoInformePreliminar'], 
        $row['Acci_UsuarioId_Generar'], 
        $row['Acci_FechaGenerar'], 
        $row['Acci_UsuarioId_Edicion'], 
        $row['Acci_FechaEdicion'], 
        $row['Acci_UsuarioId_Cerrar'], 
        $row['Acci_FechaCerrar'], 
        $row['acci_log_ip'], 
        $row['acci_lugar_referencia']];
}

foreach($data_array_ip as $data_item_ip){
    fputcsv($output_ip, $data_item_ip);
}
fclose($output_ip);
unlink($file_url_ip);

exit();