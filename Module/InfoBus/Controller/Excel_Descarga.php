<?php
$filename = $_GET['Archivo'];
$tipo = $_GET['Tipo'];
$file_excel = $filename.".xlsx";
$fila = 2;

require_once '../../../Services/Composer/vendor/autoload.php';

$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$hojaActiva = $spreadsheet->getActiveSheet();
$hojaActiva->setTitle($tipo);

$JsData = file_get_contents("../../../Services/Json/".$filename.".json");
$data= json_decode($JsData, true);

// CABECERA DE COLUMNAS
$hojaActiva->setCellValue('A1','C/P NUMERO OT');
$hojaActiva->setCellValue('B1','ESTADO');
$hojaActiva->setCellValue('C1','FECHA APERTURA-PROGRAMADA');
$hojaActiva->setCellValue('D1','GENERA OT');
$hojaActiva->setCellValue('E1','BUS');
$hojaActiva->setCellValue('F1','ORIGEN-FRECUENCIA');
$hojaActiva->setCellValue('G1','ASOCIADO');
$hojaActiva->setCellValue('H1','RESP. ASOCIADO');
$hojaActiva->setCellValue('I1','DESCRIPCION');
$hojaActiva->setCellValue('J1','KILOMETRAJE');
$hojaActiva->setCellValue('K1','HORA MOTOR');
$hojaActiva->setCellValue('L1','SISTEMA');
$hojaActiva->setCellValue('M1','CODIGO FALLA');
$hojaActiva->setCellValue('N1','CHECK');
$hojaActiva->setCellValue('O1','INICIO ACTIVIDAD');
$hojaActiva->setCellValue('P1','FIN ACTIVIDAD');
$hojaActiva->setCellValue('Q1','DURACION ACTIVIDAD');
$hojaActiva->setCellValue('R1','ACCION TOMADA');
$hojaActiva->setCellValue('S1','OBS ASOCIADO');
$hojaActiva->setCellValue('T1','TECNICO DE ACTIVIDAD');
$hojaActiva->setCellValue('U1','COMPONENTE MONTADO');
$hojaActiva->setCellValue('V1','COMPONENTE DESMONTADO');
$hojaActiva->setCellValue('W1','BUS MONTADO');
$hojaActiva->setCellValue('X1','BUS DESMONTADIO');
$hojaActiva->setCellValue('Y1','MOTIVO');
$hojaActiva->setCellValue('Z1','FECHA CIERRE TECNICO');
$hojaActiva->setCellValue('AA1','CGM CIERRE TECNICO');
$hojaActiva->setCellValue('AB1','OBS CGM');
$hojaActiva->setCellValue('AC1','FECHA CIERRE ADM');
$hojaActiva->setCellValue('AD1','RESPONSABLE CIERRE ADM');
$hojaActiva->setCellValue('AE1','OBS CIERRE ADMINISTRATIVO');
$hojaActiva->setCellValue('AF1','SEMANA');
$hojaActiva->setCellValue('AG1','TURNO');
$hojaActiva->setCellValue('AH1','PUBLICACION');

switch ($tipo)
{
	case "GENERAL":
        foreach ($data as $row) {
            $hojaActiva->setCellValue('A'.$fila, $row["ib_nro_ot"]);
            $hojaActiva->setCellValue('B'.$fila, $row['ib_estado']);
            $hojaActiva->setCellValue('C'.$fila, $row['ib_fecha_genera']);
            $hojaActiva->setCellValue('D'.$fila, $row['ib_cgm_genera']);
            $hojaActiva->setCellValue('E'.$fila, $row['ib_bus']);
            $hojaActiva->setCellValue('F'.$fila, $row['ib_orig_frec']);
            $hojaActiva->setCellValue('G'.$fila, $row['ib_asociado']);
            $hojaActiva->setCellValue('H'.$fila, $row['ib_tecn_resp']);
            $hojaActiva->setCellValue('I'.$fila, $row['ib_desc_acti']);
            $hojaActiva->setCellValue('J'.$fila, $row['ib_km']);
            $hojaActiva->setCellValue('K'.$fila, $row['ib_hmotor']);
            $hojaActiva->setCellValue('L'.$fila, $row['ib_sistema']);
            $hojaActiva->setCellValue('M'.$fila, $row['ib_codfalla']);
            $hojaActiva->setCellValue('N'.$fila, $row['ib_check']);
            $hojaActiva->setCellValue('O'.$fila, $row['ib_inicio']);
            $hojaActiva->setCellValue('P'.$fila, $row['ib_fin']);
            $hojaActiva->setCellValue('Q'.$fila, $row['ib_duracion_actividad']);
            $hojaActiva->setCellValue('R'.$fila, $row['ib_accion_tomada']);
            $hojaActiva->setCellValue('S'.$fila, $row['ib_obs_asoc']);
            $hojaActiva->setCellValue('T'.$fila, $row['ib_tecnico']);
            $hojaActiva->setCellValue('U'.$fila, $row['ib_montado']);
            $hojaActiva->setCellValue('V'.$fila, $row['ib_dmontado']);
            $hojaActiva->setCellValue('W'.$fila, $row['ib_busmont']);
            $hojaActiva->setCellValue('X'.$fila, $row['ib_busdmont']);
            $hojaActiva->setCellValue('Y'.$fila, $row['ib_motivo']); 
            $hojaActiva->setCellValue('Z'.$fila, $row['ib_fecha_cierre_tecnico']);
            $hojaActiva->setCellValue('AA'.$fila, $row['ib_cgm_cierre_tecnico']);
            $hojaActiva->setCellValue('AB'.$fila, $row['ib_obs_cgm']);
            $hojaActiva->setCellValue('AC'.$fila, $row['ib_date_ca']);
            $hojaActiva->setCellValue('AD'.$fila, $row['ib_ca']);
            $hojaActiva->setCellValue('AE'.$fila, $row['ib_obs_aom']);
            $hojaActiva->setCellValue('AF'.$fila, $row['ib_semana']); 
            $hojaActiva->setCellValue('AG'.$fila, $row['ib_turno']);
            $hojaActiva->setCellValue('AH'.$fila, $row['ib_publicacion']); 
            $fila++;
        }
    break;
            
    case "CORRECTIVAS":
        foreach ($data as $row) {
            $hojaActiva->setCellValue('A'.$fila, $row['cod_ot']);
            $hojaActiva->setCellValue('B'.$fila, $row['ot_estado']);
            $hojaActiva->setCellValue('C'.$fila, $row['ot_date_crea']);
            $hojaActiva->setCellValue('D'.$fila, $row['ot_cgm_crea']);
            $hojaActiva->setCellValue('E'.$fila, $row['ot_bus']);
            $hojaActiva->setCellValue('F'.$fila, $row['ot_origen']);
            $hojaActiva->setCellValue('G'.$fila, $row['ot_asociado']);
            $hojaActiva->setCellValue('H'.$fila, $row['ot_resp_asoc']);
            $hojaActiva->setCellValue('I'.$fila, $row['ot_descrip']);
            $hojaActiva->setCellValue('J'.$fila, $row['ot_kilometraje']);
            $hojaActiva->setCellValue('K'.$fila, $row['ot_hmotor']);
            $hojaActiva->setCellValue('L'.$fila, $row['ot_sistema']);
            $hojaActiva->setCellValue('M'.$fila, $row['ot_codfalla']);
            $hojaActiva->setCellValue('N'.$fila, $row['ot_check']);
            $hojaActiva->setCellValue('O'.$fila, $row['ot_inicio']);
            $hojaActiva->setCellValue('P'.$fila, $row['ot_fin']);
            $hojaActiva->setCellValue('Q'.$fila, $row['ot_duracion_actividad']);
            $hojaActiva->setCellValue('R'.$fila, $row['ot_at']);
            $hojaActiva->setCellValue('S'.$fila, $row['ot_obs_asoc']);
            $hojaActiva->setCellValue('T'.$fila, $row['ot_tecnico']);
            $hojaActiva->setCellValue('U'.$fila, $row['ot_montado']);
            $hojaActiva->setCellValue('V'.$fila, $row['ot_dmontado']);
            $hojaActiva->setCellValue('W'.$fila, $row['ot_busmont']);
            $hojaActiva->setCellValue('X'.$fila, $row['ot_busdmont']);
            $hojaActiva->setCellValue('Y'.$fila, $row['ot_motivo']);
            $hojaActiva->setCellValue('Z'.$fila, $row['ot_date_ct']);
            $hojaActiva->setCellValue('AA'.$fila, $row['ot_cgm_ct']);
            $hojaActiva->setCellValue('AB'.$fila, $row['ot_obs_cgm']);
            $hojaActiva->setCellValue('AC'.$fila, $row['ot_date_ca']);
            $hojaActiva->setCellValue('AD'.$fila, $row['ot_ca']);
            $hojaActiva->setCellValue('AE'.$fila, $row['ot_obs_aom']);
            $hojaActiva->setCellValue('AF'.$fila, $row['ot_semana']); // NO EXISTE
            $hojaActiva->setCellValue('AG'.$fila, $row['ot_turno']); // NO EXISTE
            $hojaActiva->setCellValue('AH'.$fila, $row['ot_publicacion']); // NO EXISTE 
            $fila++;
        }
    break;

    case "PREVENTIVAS":
        foreach ($data as $row) {
            $hojaActiva->setCellValue('A'.$fila, $row['cod_otpv']);
            $hojaActiva->setCellValue('B'.$fila, $row['otpv_estado']);
            $hojaActiva->setCellValue('C'.$fila, $row['otpv_date_prog']);
            $hojaActiva->setCellValue('D'.$fila, $row['otpv_genera']);
            $hojaActiva->setCellValue('E'.$fila, $row['otpv_bus']);
            $hojaActiva->setCellValue('F'.$fila, $row['otpv_frecuencia']);
            $hojaActiva->setCellValue('G'.$fila, $row['otpv_asociado']);
            $hojaActiva->setCellValue('H'.$fila, $row['otpv_tecnico']);
            $hojaActiva->setCellValue('I'.$fila, $row['otpv_descripcion']);
            $hojaActiva->setCellValue('J'.$fila, $row['otpv_kmrealiza']);
            $hojaActiva->setCellValue('K'.$fila, $row['otpv_hmotor']); 
            $hojaActiva->setCellValue('L'.$fila, $row['otpv_sistema']); // NO EXISTE
            $hojaActiva->setCellValue('M'.$fila, $row['otpv_codfalla']); // NO EXISTE
            $hojaActiva->setCellValue('N'.$fila, $row['otpv_check']); // NO EXISTE 
            $hojaActiva->setCellValue('O'.$fila, $row['otpv_inicio']);
            $hojaActiva->setCellValue('P'.$fila, $row['otpv_fin']);
            $hojaActiva->setCellValue('Q'.$fila, $row['otpv_duracion_actividad']);
            $hojaActiva->setCellValue('R'.$fila, $row['otpv_acciontomada']); // NO EXISTE 
            $hojaActiva->setCellValue('S'.$fila, $row['otpv_obs_as']);
            $hojaActiva->setCellValue('T'.$fila, $row['otpv_tecnico']); // NO EXISTE 
            $hojaActiva->setCellValue('U'.$fila, $row['otpv_montado']); // NO EXISTE 
            $hojaActiva->setCellValue('V'.$fila, $row['otpv_dmontado']); // NO EXISTE 
            $hojaActiva->setCellValue('W'.$fila, $row['otpv_busmont']); // NO EXISTE 
            $hojaActiva->setCellValue('X'.$fila, $row['otpv_busdmont']); // NO EXISTE 
            $hojaActiva->setCellValue('Y'.$fila, $row['otpv_motivo']); // NO EXISTE 
            $hojaActiva->setCellValue('Z'.$fila, $row['otpv_date_cierre_tecnico']); // otpv_fin
            $hojaActiva->setCellValue('AA'.$fila, $row['otpv_cgm_cierra']);
            $hojaActiva->setCellValue('AB'.$fila, $row['otpv_obs_cgm']);
            $hojaActiva->setCellValue('AC'.$fila, $row['otpv_date_cierra_ad']);
            $hojaActiva->setCellValue('AD'.$fila, $row['otpv_cierra_ad']);
            $hojaActiva->setCellValue('AE'.$fila, $row['otpv_obs_cierre_ad']);
            $hojaActiva->setCellValue('AF'.$fila, $row['otpv_semana']);
            $hojaActiva->setCellValue('AG'.$fila, $row['otpv_turno']);
            $hojaActiva->setCellValue('AH'.$fila, $row['otpv_date_genera']);
            $fila++;    
        }
    break;
}

// redirect output to client browser

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.$file_excel.'"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
unlink("../../../Services/Json/".$filename.".json");
exit();