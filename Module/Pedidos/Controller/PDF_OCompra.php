<?php

require('../../../Services/Resources/fpdf183/fpdf.php');

class PDF extends FPDF
{
    // Cargar los datos
    public function LoadData($Id_DateJS)
    {
        $JsOCompra = file_get_contents("../../../Services/Json/".$Id_DateJS.".json");
		$DataOCompra= json_decode($JsOCompra, true);
        return $DataOCompra;
    }

    public function GeneraOCompra($pData_pdfhead, $pData_pdfbody)
    {
        $this->SetAutoPageBreak(false,0.5);

        foreach ($pData_pdfhead as $row)
        {
            // PAGINA 1    
            // IMAGEN DE LIMABUS
            $this->AddPage('P','A4',0);  
            $this->SetTextColor(0);
            $this->Image('../../../Module/Pedidos/View/Img/logoefa3.png', 8, 10, 40);

            $nro_ordencompra = substr("000000".$row['ordencompra_id'],-6);
            $responsable = $row['usuario'];

            $this->SetFont('Arial', 'B', 8);
            $this->SetTextColor(42,209,148);
            $this->Cell(150);
            $this->Cell(10, 15, utf8_decode('O.COMPRA - '), 0, 0, 'L');
            $this->SetFont('Arial', 'B', 12);
            $this->SetTextColor(0);
            $this->Cell(10);
            $this->Cell(10, 15, utf8_decode($nro_ordencompra), 0, 0, 'L');
            $this->Ln(12);
            
            $this->Cell(65);
            $this->SetFont('Arial', 'B', 8);
            $this->SetTextColor(42,209,148);
            $this->Cell(60, 6, utf8_decode('"MOVILIZAMOS PERSONAS, ACERCAMOS SUEÑOS"'), 0, 0, 'C');
            $this->Ln(10);

            
            // CABECERA COTIZACION
            $this->SetDrawColor(0);
            $this->SetTextColor(0);

            $this->SetFont('Arial', '', 8);
            $this->Cell(10, 6, utf8_decode("SEÑORES : "), 0, 0, 'L');
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(10);
            $this->Cell(60, 6, utf8_decode($row['orco_razonsocial']), 0, 0, 'L');
            $this->Ln();

            $this->SetFont('Arial', '', 8);
            $this->Cell(10, 6, utf8_decode("ATENCION : "), 0, 0, 'L');
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(10);
            $this->Cell(60, 6, utf8_decode($row['prov_contacto']), 0, 0, 'L');
            $this->Ln();

            $fecha_ordencompra = date_format(date_create($row['orco_fecha']),"d/m/Y");
            $this->SetFont('Arial', '', 8);
            $this->Cell(10, 6, utf8_decode("FECHA : "), 0, 0, 'L');
            $this->SetFont('Arial', 'B', 8);
            $this->Cell(10);
            $this->Cell(60, 6, $fecha_ordencompra, 0, 0, 'L');
            $this->Ln(10);
        }

        // DETALLE COTIZACION
        $this->SetFont('Arial','B',8);
        $this->SetDrawColor(0);
        $this->SetTextColor(255);
        $this->SetFillColor(42,209,148);
        $this->SetLineWidth(0);
        
        $this->Cell(30,6,utf8_decode("CODIGO"),1,0,'C',true);
        $this->Cell(80,6,utf8_decode("DESCRIPCION"),1,0,'C',true);
        $this->Cell(10,6,utf8_decode("UNID."),1,0,'C',true);
        $this->Cell(10,6,utf8_decode("CANT."),1,0,'C',true);
        $this->Cell(10,6,utf8_decode("PREC."),1,0,'C',true);
        $this->Cell(10,6,utf8_decode("TOTAL"),1,0,'C',true);
        $this->Cell(35,6,utf8_decode("OBSERVACIONES"),1,1,'C',true);
        
        $this->SetFont('Arial','',6);
        $this->SetDrawColor(0);
        $this->SetTextColor(0);
        $this->SetLineWidth(0);
        $ncontador = 0;
        foreach($pData_pdfbody as $row1)
        {
            $ncontador++;
            if($ncontador < 25){
                $this->Cell(30,6,utf8_decode($row1['moc_material_id']),1,0,'C',false);
                $this->Cell(80,6,utf8_decode($row1['material_descripcion']),1,0,'L',false);
                $this->Cell(10,6,utf8_decode($row1['moc_unidad_medida']),1,0,'C',false);
                $this->Cell(10,6,utf8_decode($row1['moc_cantidad']),1,0,'C',false);
                $this->Cell(10,6,utf8_decode($row1['moc_precio_soles']),1,0,'C',false);
                $this->Cell(10,6,utf8_decode($row1['moc_precio_total']),1,0,'C',false);
                $this->Cell(35,6,utf8_decode($row1['moc_observaciones']),1,1,'L',false);
            }
        }
        $this->Ln(20);
        
        $this->SetFont('Arial','B',10);
        $this->SetDrawColor(0);
        $this->SetTextColor(0);
        $this->SetLineWidth(0);
        $this->Cell(140);
        $this->Cell(40,10,utf8_decode($responsable),'T',1,'C',false);
    }    
      
}

$Id_DateJS = $_GET['Id_DateJS'];
$pdf = new PDF();

$Data_pdfhead = $pdf->LoadData("pdfhead".$Id_DateJS);
$Data_pdfbody = $pdf->LoadData("pdfbody".$Id_DateJS);

foreach($Data_pdfhead as $row){
    $ordencompra_id = $row['ordencompra_id'];
    $orco_razonsocial = $row['orco_razonsocial'];
    $orco_fecha = $row['orco_fecha'];
}

$pdf->SetFont('Arial','',14);
$pdf->GeneraOCompra($Data_pdfhead, $Data_pdfbody);
$pdf->Output("OC NRO-".$ordencompra_id." ".$orco_razonsocial." - ".$orco_fecha.".pdf",'D');

unlink("../../../Services/Json/pdfhead".$Id_DateJS.".json");
unlink("../../../Services/Json/pdfbody".$Id_DateJS.".json");