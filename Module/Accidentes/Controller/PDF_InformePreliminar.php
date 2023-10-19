<?php

require('../../../Services/Resources/fpdf183/fpdf.php');

class PDF extends FPDF
{
    // Cargar los datos
    public function LoadData($Id_DateJS)
    {
        $JsProgramacion = file_get_contents("../../../Services/Json/".$Id_DateJS.".json");
		$DataProgramacion= json_decode($JsProgramacion, true);
        return $DataProgramacion;
    }

    public function GeneraProgramacion($pData_InformePreliminar, $pData_Imagen, $pData_Naturaleza, $pData_Reparacion)
    {
        $CodigoQR   = '../../../Module/Accidentes/View/Img/SinImagen.jpg';
        $Imagen1    = '../../../Module/Accidentes/View/Img/SinImagen.jpg';
        $Imagen2    = '../../../Module/Accidentes/View/Img/SinImagen.jpg';
        $Imagen3    = '../../../Module/Accidentes/View/Img/SinImagen.jpg';
        $Imagen4    = '../../../Module/Accidentes/View/Img/SinImagen.jpg';
        $Mapa       = '../../../Module/Accidentes/View/Img/SinImagen.jpg';
        $Bus        = '';
        
        $tipo_accidente         = "";
        $tipo_danos_materiales  = "";
        $clase_accidente        = "";
        $documentos_anexos      = "";

        $consecDanosMateriales  = false;
        $consecLesiones         = false;
        $consecFatalidad        = false;
        $consecOtro             = false;

        foreach ($pData_Imagen as $row){
            if($row['Acci_TipoImagen']=='CodigoQR'){
                $CodigoQR = 'data://text/plain;base64,'.$row['b64_Imagen'];
            }
            if($row['Acci_TipoImagen']=='Imagen1'){
                $Imagen1 = 'data://text/plain;base64,'.$row['b64_Imagen'];
            }
            if($row['Acci_TipoImagen']=='Imagen2'){
                $Imagen2 = 'data://text/plain;base64,'.$row['b64_Imagen'];
            }
            if($row['Acci_TipoImagen']=='Imagen3'){
                $Imagen3 = 'data://text/plain;base64,'.$row['b64_Imagen'];
            }
            if($row['Acci_TipoImagen']=='Imagen4'){
                $Imagen4 = 'data://text/plain;base64,'.$row['b64_Imagen'];
            }
            if($row['Acci_TipoImagen']=='Mapa'){
                $Mapa = 'data://text/plain;base64,'.$row['b64_Imagen'];
            }
            if($row['Acci_TipoImagen']=='Bus'){
                $Bus = 'data://text/plain;base64,'.$row['b64_Imagen'];
            }
        }

        foreach ($pData_InformePreliminar as $row)
        {
            // PAGINA 1    
            $this->SetAutoPageBreak(true);
            $this->AddPage('P','A4',0);
    
            // CODIGO QR, FRASE LIMABUS, CODIGO ACCIDENTE
            $this->Image($CodigoQR, 13,15,25,25,'png');

            $this->SetFont('Arial','B',12);
            $this->SetTextColor(255,0,0);
            $this->SetXY(149,5);
            $this->Cell(50,6,'IP '.$row['Accidentes_Id'],0,0,'C',false);

            // TITULO DEL INFORME
            $this->SetXY(35,18);
            $this->SetFont('Arial','B',12);
            $this->SetTextColor(0);
            $this->Cell(135,6,"INFORME DE NOVEDAD",0,0,'C',false);
            $this->SetFont('Arial','B',10);
            $this->Cell(30,6,"BUS",0,1,'C',false);
            
            // TIPO DE ACCIDENTE
            switch ($row['Acci_TipoAccidente']) {
                case 'ACCIDENTE_ESPECIAL':
                    $tipo_accidente = "ACCIDENTE ESPECIAL";
                    break;
                case "ACCIDENTE_TRANSITO":
                    $tipo_accidente = "ACCIDENTE DE TRANSITO";
                    break;
                case "VANDALISMO":
                    $tipo_accidente = "VANDALISMO";
                    break;
                case "DAÑO_EN_OPERACION":
                    $tipo_accidente = "DAÑO EN OPERACION";
                    break;
                default:
                    # code...
                    break;
            }
            $this->SetXY(35,23);
            $this->SetFont('Arial', 'B', 18);
            $this->SetTextColor(0);
            $this->Cell(135,10,utf8_decode($tipo_accidente),0,0,'C');
            $this->SetTextColor(42,209,148);
            $this->Cell(30,10,$row['Acci_Bus'],0,1,'C',false);

            // CONSECUENCIAS DEL EVENTO

            switch ($row['Acci_DanosMateriales']) {
                case 'CON_DAÑOS_MATERIALES':
                    $tipo_danos_materiales = "CON DAÑOS MATERIALES";
                    break;
                case "SIN_DAÑOS_MATERIALES":
                    $tipo_danos_materiales = "SIN DAÑOS MATERIALES";
                    break;
                default:
                    # code...
                    break;
            }

            switch ($row['Acci_ClaseAccidente']) {
                case 'CON_PERDIDA_KM':
                    $clase_accidente = "CON PERDIDA DE KM";
                    break;
                case "SIN_PERDIDA_KM":
                    $clase_accidente = "SIN PERDIDA DE KM";
                    break;
                default:
                    # code...
                    break;
            }
            $this->SetXY(35,31);
            $this->SetFont('Arial','B',6);
            $this->SetTextColor(255,0,0);
            $this->Cell(135,5,utf8_decode($row['Acci_Lesiones']).', '.utf8_decode($tipo_danos_materiales).', '.utf8_decode($clase_accidente),0,0,'C',false);
            $this->SetTextColor(0);
            $this->SetFont('Arial','B',10);
            $this->Cell(30,4,utf8_decode($row['Bus_NroPlaca']),0,1,'C',false);
            $this->Ln(10);

            // DATOS GENERALES
            $this->SetFont('Arial','B',8);
            $this->SetTextColor(255);
            $this->SetFillColor(42,209,148);
            $this->Cell(4);
            $this->Cell(180,5,"1. DATOS GENERALES",0,1,'L',true);
            $this->Ln(1);

            $this->SetFillColor(192,192,192);
            $this->SetTextColor(0);
            $this->SetFont('Arial','B',6);
            $this->Cell(4);
            $this->Cell(20 ,4,"TIPO DE EVENTO",1,0,'L',true);
            $this->SetFont('Arial','',6);
            $this->Cell(60,4,utf8_decode($row['Acci_TipoEvento']),1,0,'L',false);
            $this->SetFont('Arial','B',6);
            $this->Cell(19,4,"FECHA EVENTO",1,0,'L',true);
            $this->SetFont('Arial','',6);
            $this->Cell(15,4,date('d/m/Y',strtotime($row['Acci_Fecha'])),1,0,'C',false);
            $this->SetFont('Arial','B',6);
            $this->Cell(18,4,"HORA EVENTO",1,0,'L',true);
            $this->SetFont('Arial','',6);
            $this->Cell(15,4,date('H:i',strtotime($row['Acci_Hora'])),1,0,'C',false);
            $this->SetFont('Arial','B',6);
            $this->Cell(18,4,"FIN ATENCION",1,0,'L',true);
            $this->SetFont('Arial','',6);
            $this->Cell(15,4,date('H:i',strtotime($row['Acci_HoraFinAtencion'])),1,1,'C',false);

            $this->SetTextColor(0);
            $this->SetFont('Arial','',5);
            $this->SetFillColor(192,192,192);
            $this->SetLineWidth(0);
            $this->Cell(4);
            $this->Cell(20,4,"NOMBRE DE PILOTO",1,0,'L',true);
            $this->Cell(60,4,utf8_decode($row['Acci_NombreColaborador']),1,0,'L',false);
            $this->Cell(19,4,"CODIGO CAC",1,0,'L',true);
            $this->Cell(15,4,"12".$row['Acci_CodigoColaborador'],1,0,'L');
            $this->Cell(18,4,"DNI",1,0,'L',true);
            $this->Cell(15,4,$row['Acci_Dni'],1,0,'L');
            $this->Cell(18,4,"RECONOCE RESP.",1,0,'L',true);
            $this->Cell(15,4,utf8_decode($row['Acci_ReconoceResponsabilidad']),1,1,'L');

            $this->SetTextColor(0);
            $this->SetFont('Arial','',5);
            $this->SetFillColor(192,192,192);
            $this->SetLineWidth(0);
            $this->Cell(4);
            $this->Cell(20,4,"LUGAR DEL EVENTO",1,0,'L',true);
            $this->Cell(60,4,utf8_decode($row['Acci_Lugar']),1,0,'L');
            $this->Cell(19,4,"SENTIDO",1,0,'L',true);
            $this->Cell(15,4,utf8_decode($row['Acci_Sentido']),1,0,'L');
            $this->Cell(18,4,"TABLA",1,0,'L',true);
            $this->Cell(15,4,$row['Acci_Tabla'],1,0,'L');
            $this->Cell(18,4,"SERVICIO",1,0,'L',true);
            $this->Cell(15,4,$row['Acci_Servicio'],1,1,'L');
            
            $this->SetTextColor(0);
            $this->SetFont('Arial','',5);
            $this->SetFillColor(192,192,192);
            $this->SetLineWidth(0);
            $this->Cell(4);
            $this->Cell(20,4,utf8_decode("OBJ.CAUSANTE"),1,0,'L',true);
            $this->Cell(60,4,utf8_decode($row['Acci_Objeto']),1,0,'L');
            $this->Cell(19,4,"KM PERDIDOS",1,0,'L',true);
            $this->Cell(15,4,number_format($row['Acci_km_perdidos'],2,'.',' ').' KM.',1,0,'L');
            $this->Cell(18,4,utf8_decode("CONCILIACION"),1,0,'L',true);
            $this->Cell(15,4,utf8_decode($row['Acci_Conciliacion']),1,0,'L',false);
            $this->Cell(18,4,utf8_decode("MONTO SOLES"),1,0,'L',true);
            $this->Cell(15,4,$row['Acci_MontoConciliado'],1,1,'L',false);

            $this->SetTextColor(0);
            $this->SetFont('Arial','',5);
            $this->SetFillColor(192,192,192);
            $this->SetLineWidth(0);
            $this->Cell(4);
            $this->Cell(20,4,utf8_decode("COMISARÍA"),1,0,'L',true);
            $this->Cell(60,4,utf8_decode($row['Acci_Comisaria']),1,0,'L',false);
            $this->Cell(19,4,utf8_decode("CLÍNICA / HOSPITAL"),1,0,'L',true);
            $this->Cell(48,4,utf8_decode($row['Acci_Hospital']),1,0,'L');
            $this->Cell(18,4,utf8_decode("H.CONDUCCION"),1,0,'L',true);
            $this->Cell(15,4,date('H:i',strtotime($row['Acci_HorasTrabajadas'])),1,1,'L');

            $this->SetTextColor(0);
            $this->SetFont('Arial','',5);
            $this->SetFillColor(192,192,192);
            $this->SetLineWidth(0);
            $this->Cell(4);
            $this->Cell(20,4,"CGO DE TURNO",1,0,'L',true);
            $this->Cell(60,4,$row['Acci_NombreCGO'],1,0,'L');
            $this->Cell(19,4,"PERSONAL APOYO",1,0,'L',true);
            $this->Cell(81,4,utf8_decode($row['Acci_NombrePersonalApoyo']),1,1,'L',false);

            // DOCUMENTOS ANEXOS

            if($row['Acci_DocReporte']=="SI"){
                $documentos_anexos = 'REPORTE DE ACCIDENTE';
            }
            if($row['Acci_DocConciliacion']=="SI"){
                if($documentos_anexos!=""){
                    $documentos_anexos .= ', CONCILIACION';
                }else{
                    $documentos_anexos = 'CONCILIACION';
                }
            }
            if($row['Acci_DocPartePolicial']=="SI"){
                if($documentos_anexos!=""){
                    $documentos_anexos .= ', PARTE POLICIAL';
                }else{
                    $documentos_anexos = 'PARTE POLICIAL';
                }
            }
            if($row['Acci_DocOficioPeritaje']=="SI"){
                if($documentos_anexos!=""){
                    $documentos_anexos .= ', OFICIO PERITAJE';
                }else{
                    $documentos_anexos = 'OFICIO PERITAJE';
                }
            }
            if($row['Acci_DocReporteAtencion']=="SI"){
                if($documentos_anexos!=""){
                    $documentos_anexos .= ', REPORTE DE ATENCION RIMAC';
                }else{
                    $documentos_anexos = 'REPORTE DE ATENCION RIMAC';
                }
            }
            if($row['Acci_DocDenunciaPolicial']=="SI"){
                if($documentos_anexos!=""){
                    $documentos_anexos .= ', DENUNCIA POLICIAL';
                }else{
                    $documentos_anexos = 'DENUNCIA POLICIAL';
                }
            }
            if($row['Acci_DocCitacionManifestacion']=="SI"){
                if($documentos_anexos!=""){
                    $documentos_anexos .= ', CITACION A MANIFESTACION';
                }else{
                    $documentos_anexos = 'CITACION A MANIFESTACION';
                }
            }

            $this->SetFont('Arial','',4);
            $this->Cell(4);
            $this->Cell(180,4,"DOCUMENTOS ANEXOS : ".utf8_decode($documentos_anexos),0,0,'L',false);
            $this->Ln(2);
            if($row['Acci_DocOtro']=="SI"){
                $this->Cell(4);
                $this->Cell(180,4,utf8_decode('OTRO : '.$row['Acci_DocOtroDescripcion']),0,0,'L',false);
                $this->Ln(2);
            }
            $this->Cell(4);
            $this->Cell(180,4,'SUSCRITO POR: '.utf8_decode($row['CGOSuscribe']).' EL '.date('d/m/Y',strtotime($row['Acci_FechaEdicion'])).'  '.date('H:i',strtotime($row['Acci_FechaEdicion'])),0,0,'L',false);
            if($row['CGORevisado']!=""){
                $this->Ln(2);
                $this->Cell(4);
                $this->Cell(180,4,'REVISADO POR: '.utf8_decode($row['CGORevisado']).' EL '.date('d/m/Y',strtotime($row['fecha_revisado'])).'  '.date('H:i',strtotime($row['fecha_revisado'])),0,1,'L',false);
                $this->Ln(2);
            }else{
                $this->Ln(6);
            }

            // INFORMACION DISPONIBLE EN EL MOMENTO
            $this->SetFont('Arial','B',8);
            $this->SetDrawColor(0);
            $this->SetTextColor(255);
            $this->SetFillColor(42,209,148);
            $this->SetLineWidth(0);
            $this->Cell(4);
            $this->Cell(180,5,utf8_decode("2. INFORMACION DISPONIBLE EN EL MOMENTO"),0,1,'L',true);
            $this->Ln(1);

            $this->SetTextColor(0);
            $this->SetFont('Arial','',6);
            $this->Cell(4);
            $this->MultiCell(180,4,utf8_decode($row['Acci_Descripcion']),0,'J',false);
            $this->Ln(2);
 
            // DAÑOS PERSONALES

            $this->SetFont('Arial','B',8);
            $this->SetDrawColor(0);
            $this->SetTextColor(255);
            $this->SetFillColor(42,209,148);
            $this->SetLineWidth(0);
            $this->Cell(4);
            $this->Cell(180,5,utf8_decode("3. DAÑOS PERSONALES"),0,1,'L',true);
            $this->Ln(1);

            $this->SetTextColor(0);
            $n_contador = 0;
            foreach($pData_Naturaleza as $row2){
                if($row2['Acci_Tipo']=='DañosPersonales'){
                    $n_contador++;
                    $this->SetFont('Arial','',6);
                    $this->Cell(4);
                    $this->Cell(4,4,$n_contador.'.- ',0,0,'L',false);
                    $this->SetFont('Arial','B',6);
                    $this->MultiCell(172,4,utf8_decode($row2['Acci_Nombre']).', DNI: '.$row2['Acci_Dni'].', EDAD: '.$row2['Acci_Edad'].' '.utf8_decode('años').', GENERO: '.utf8_decode($row2['Acci_Genero']).', ORIGEN: '.utf8_decode($row2['acci_origen']),0,'J',false); 
                    $this->SetFont('Arial','',6);
                    $this->Cell(8);
                    $this->MultiCell(172,4,utf8_decode($row2['Acci_Descripcion']),0,'J',false);  
                }
            }
            $this->Ln(2);

            // DAÑOS A TERCEROS
            $this->SetFont('Arial','B',8);
            $this->SetDrawColor(0);
            $this->SetTextColor(255);
            $this->SetFillColor(42,209,148);
            $this->SetLineWidth(0);
            $this->Cell(4);
            $this->Cell(180,5,utf8_decode("4. DAÑOS MATERIALES A TERCEROS"),0,1,'L',true);
            $this->Ln(1);

            $this->SetTextColor(0);
            $n_contador = 0;
            foreach($pData_Naturaleza as $row3){
                if($row3['Acci_Tipo']=='DañosTerceros'){
                    $n_contador++;
                    $this->SetFont('Arial','',6);
                    $this->Cell(4);
                    $this->Cell(4,4,$n_contador.'.- ',0,0,'L',false);
                    $this->SetFont('Arial','B',6);
                    $this->MultiCell(172,4,utf8_decode($row3['Acci_Nombre']).', DNI: '.$row3['Acci_Dni'].', PLACA: '.$row3['Acci_Placa'],0,'J',false); 
                    $this->SetFont('Arial','',6);
                    $this->Cell(8);
                    $this->MultiCell(172,4,utf8_decode($row3['Acci_Descripcion']),0,'J',false);  
                }
            }
            $this->Ln(2);

            // CAUSAS POSIBLES
            $this->SetFont('Arial','B',8);
            $this->SetDrawColor(0);
            $this->SetTextColor(255);
            $this->SetFillColor(42,209,148);
            $this->SetLineWidth(0);
            $this->Cell(4);
            $this->Cell(180,5,utf8_decode("5. CAUSAS POSIBLES"),0,1,'L',true);
            $this->Ln(1);

            $this->SetTextColor(0);
            $n_contador = 0;
            foreach($pData_Naturaleza as $row4){
                if($row4['Acci_Tipo']=='CausasAccidentes'){
                    $n_contador++;
                    $this->SetFont('Arial','',6);
                    $this->Cell(4);
                    $this->Cell(4,4,$n_contador.'.- ',0,0,'L',false);
                    $this->MultiCell(172,4,utf8_decode($row4['Acci_Descripcion']),0,'J',false);  
                }
            }
            $this->Ln(2);

            // ACCIONES TOMADAS

            $this->SetFont('Arial','B',8);
            $this->SetDrawColor(0);
            $this->SetTextColor(255);
            $this->SetFillColor(42,209,148);
            $this->SetLineWidth(0);
            $this->Cell(4);
            $this->Cell(180,5,utf8_decode("6. ACCIONES TOMADAS EN EL MOMENTO DEL EVENTO"),0,1,'L',true);
            $this->Ln(1);

            $this->SetTextColor(0);
            $n_contador = 0;
            foreach($pData_Naturaleza as $row5){
                if($row5['Acci_Tipo']=='AccionesTomadas'){
                    $n_contador++;
                    $this->SetFont('Arial','',6);
                    $this->Cell(4);
                    $this->Cell(4,4,$n_contador.'.- ',0,0,'L',false);
                    $this->MultiCell(172,4,utf8_decode($row5['Acci_Descripcion']),0,'J',false);  
                }
            }
            $this->Ln();

            // PAGINA 2
            $this->SetAutoPageBreak(false);
            $this->AddPage('P','A4',0);
            $this->SetXY(14,16);

            $this->SetFont('Arial','B',8);
            $this->SetDrawColor(0);
            $this->SetTextColor(255);
            $this->SetFillColor(42,209,148);
            $this->SetLineWidth(0);
            $this->Cell(180,5,"7. IMAGENES DE LA NOVEDAD",0,1,'L',true);
            $this->Ln();

            $this->Cell(4);
            $this->SetFillColor(242,243,244);
            $this->SetTextColor(0);
            $this->Cell(85,6,"1",0,0,'C',true);
            $this->Cell(10);
            $this->Cell(85,6,"2",0,1,'C',true);
            $this->Image($Imagen1, 14,32,85,60,'jpg');
            $this->Image($Imagen2, 109,32,85,60,'jpg');
            $this->Ln(70);
            
            $this->Cell(4);
            $this->Cell(85,6,"3",0,0,'C',true);
            $this->Cell(10);
            $this->Cell(85,6,"4",0,1,'C',true);
            $this->Image($Imagen3, 14,107,85,60,'jpg');
            $this->Image($Imagen4, 109,107,85,60,'jpg');
            $this->Ln(70);

            $this->Cell(4);
            $this->SetFont('Arial','B',8);
            $this->SetDrawColor(0);
            $this->SetTextColor(255);
            $this->SetFillColor(42,209,148);
            $this->SetLineWidth(0);
            $this->Cell(180,5,"8. MAPA DE UBICACION",0,0,'L',true);
            $this->Ln();

            $this->Image($Mapa, 14,184,180,90,'jpg');
            $this->Ln(105);

            // PAGINA 3
            
            $this->SetAutoPageBreak(true);
            $this->AddPage('P','A4',0);
            $this->SetXY(14,16);

            $this->SetFont('Arial','B',8);
            $this->SetDrawColor(0);
            $this->SetTextColor(255);
            $this->SetFillColor(42,209,148);
            $this->SetLineWidth(0);
            $this->Cell(180,5,utf8_decode("8.- DETALLE DAÑOS DEL BUS"),0,1,'L',true);
            $this->Ln(1);

            $this->SetFillColor(192,192,192);
            $this->SetTextColor(0);
            $this->SetFont('Arial','B',6);
            $this->Cell(4);
            $this->Cell(20,4,"CGM TURNO",1,0,'L',true);
            $this->SetFont('Arial','',6);
            $this->Cell(70,4,$row['Acci_NombreCGM'],1,0,'L',false);
            $this->SetFont('Arial','B',6);
            $this->Cell(20,4,"BUS",1,0,'L',true);
            $this->SetFont('Arial','',6);
            $this->Cell(70,4,$row['Acci_Bus'],1,1,'L');
            $this->Cell(4);
            $this->SetFont('Arial','B',6);
            $this->Cell(20,4,"APOYO",1,0,'L',true);
            $this->SetFont('Arial','',6);
            $this->Cell(70,4,$row['Acci_NombrePersonalApoyoManto'],1,0,'L',false);
            $this->SetFont('Arial','B',6);
            $this->Cell(20,4,"IP",1,0,'L',true);
            $this->SetFont('Arial','',6);
            $this->Cell(70,4,$row['Accidentes_Id'],1,1,'L',false);
            
            // BUS
            if($Bus==""){
                if($row['Acci_Operacion']=='ALIMENTADOR'){
                    $Bus    = '../../../Module/Accidentes/View/Img/bus_alimentador.jpg';
                }else{
                    $Bus    = '../../../Module/Accidentes/View/Img/bus_troncal.jpg';
                }    
            }

            $this->Image($Bus, 14,35,180,65,'jpg');
            $this->Ln(75);

            // DETALLE DE REPARACION
            $this->SetFont('Arial','',6);
            $this->SetTextColor(0);
            $this->Cell(4);
            $this->Cell(26,5,utf8_decode("CÓDIGO DE COLORES : "),0,0,'L',false);
            $this->SetFillColor(125,206,160);
            $this->Cell(5,4,"P",0,0,'C',true);
            $this->Cell(25,4,utf8_decode("PINTADO / GRAFITIS"),0,0,"L",false);
            $this->SetFillColor(255,255,0);
            $this->Cell(5,4,"R",0,0,'C',true);
            $this->Cell(25,4,utf8_decode("RAYADO / RASPADO"),0,0,"L",false);
            $this->SetFillColor(255,195,0);
            $this->Cell(5,4,"G",0,0,'C',true);
            $this->Cell(28,4,utf8_decode("GOLPEADO / HUNDIDO"),0,0,"L",false);
            $this->SetFillColor(255,0,0);
            $this->Cell(5,4,"Q",0,0,'C',true);
            $this->Cell(25,4,utf8_decode("ROTO / QUEBRADO"),0,1,"L",false);
            $this->Line(15,110,195,110);
            $this->Ln(3);
            
            $this->SetDrawColor(0);
            $this->SetTextColor(0);
            $this->SetFillColor(0);
            $this->SetLineWidth(0);

            $n_contador = 0;
            foreach($pData_Reparacion as $row6){
                $n_contador++;
                $this->Cell(4);
                $this->SetFont('Arial','',6);
                $this->Cell(4,4,$n_contador.'.-',0,0,'L',false);
                $this->SetFont('Arial','B',6);
                $this->Cell(15,4,'COD.COLOR: ',0,0,'L',false);
                if($row6['Acci_CodigoColor']=="P"){
                    $this->SetFillColor(125,206,160);
                }
                if($row6['Acci_CodigoColor']=="R"){
                    $this->SetFillColor(255,255,0);
                }
                if($row6['Acci_CodigoColor']=="G"){
                    $this->SetFillColor(255,195,0);
                }
                if($row6['Acci_CodigoColor']=="Q"){
                    $this->SetFillColor(255,0,0);
                } 
                $this->Cell(5,4,utf8_decode($row6['Acci_CodigoColor']),0,0,'C',true); 
                $this->SetFillColor(0);
                $this->Cell(140,4,', POSICION (CODIGO DE SECCION DE BUS): '.utf8_decode($row6['Acci_SeccionBus']),0,1,'L',false); 
                $this->SetFont('Arial','',6);
                $this->Cell(8);
                $this->MultiCell(176,4,utf8_decode($row6['Acci_DescripcionReparacion']),0,'J',false); 
            }
        }
    }    
    
    // Cabecera
    function Header()
    {
        $this->SetTextColor(0);
        $this->Image('../../../Module/Accidentes/View/Img/logoefa3.png', 10, 0, 40);
        $this->Ln();

    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        $this->SetTextColor(0);
        // Número de página
        $this->Cell(0,0,utf8_decode('Informe Preliminar de Accidente de Tránsito v4.0 ').date("d-m-Y H:i").utf8_decode(' Página ').$this->PageNo().' de {nb}',0,0,'R');
    }
}

$Id_DateJS = $_GET['Id_DateJS'];
$pdf = new PDF();
$pdf->AliasNbPages();

$Data_Imagen            = $pdf->LoadData("Imagen".$Id_DateJS);
$Data_InformePreliminar = $pdf->LoadData("InformePreliminar".$Id_DateJS);
$Data_Naturaleza        = $pdf->LoadData("Naturaleza".$Id_DateJS);
$Data_Reparacion        = $pdf->LoadData("Reparacion".$Id_DateJS);

foreach($Data_InformePreliminar as $row){
    $Accidentes_Id          = $row['Accidentes_Id'];
    $Acci_TipoAccidente     = $row['Acci_TipoAccidente'];
    $Acci_Bus               = $row['Acci_Bus'];
    $Bus_NroPlaca           = $row['Bus_NroPlaca'];
    $Acci_NombreColaborador = $row['Acci_NombreColaborador'];
}

$pdf->SetFont('Arial','',14);
$pdf->GeneraProgramacion($Data_InformePreliminar, $Data_Imagen, $Data_Naturaleza, $Data_Reparacion);
$pdf->Output("IP-".$Accidentes_Id." ".utf8_decode($Acci_TipoAccidente)." - BUS ".$Acci_Bus." - PLACA ".$Bus_NroPlaca."_".utf8_decode($Acci_NombreColaborador).".pdf",'D');

unlink("../../../Services/Json/Imagen".$Id_DateJS.".json");
unlink("../../../Services/Json/InformePreliminar".$Id_DateJS.".json");
unlink("../../../Services/Json/Naturaleza".$Id_DateJS.".json");
unlink("../../../Services/Json/Reparacion".$Id_DateJS.".json");