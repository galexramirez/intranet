<?php

require('../../../Services/Resources/fpdf183/fpdf.php');

class PDF extends FPDF
{
    // Cargar los datos
    public function LoadData($Semana)
    {
        $JsProgramacion = file_get_contents("../../../Services/PdfPublicacion/".substr($Semana,0,4)."/".$Semana.".json");
		$DataProgramacion= json_decode($JsProgramacion, true);
        return $DataProgramacion;
    }



    // Tabla coloreada
    public function GeneraProgramacionBlanco()
        {
            $this->AddPage('P', 'A4', 0);
            $this->SetTextColor(0);
            $this->SetFont('Arial', '', 12);

            $this->Image('../../../Module/ProgramacionCarga/View/Img/logoefa3.png', 75, 100, 60);
            $this->SetY(125);
        
            $this->Cell(0, 4, utf8_decode('Programacion aun no disponible.'), 0, 2, 'C');
            $this->Ln();
            //$this->Cell(0, 4, utf8_decode('Si tiene problemas para descargar su programación'), 0, 2, 'C');
            //$this->Ln();
            //$this->Cell(0, 4, utf8_decode('Comuniquese al 95'), 0, 2, 'C');
        
         
        }    


    // Tabla coloreada
    public function GeneraProgramacion($data,$Dni)
    {
        $Prog_Dni="1";
        $Prog_Fecha="1";
        $Prog_HoraDestino="";
        $LineasPorPagina=0;
        $Total_Minutos=0;
        $filasDisponibles=0; 
     
        

        foreach ($data as $row)
        {
            if ($Dni==$row['Prog_Dni']) {
               
                $filasDisponibles=$filasDisponibles+1;

                if ($Prog_Dni<>$row['Prog_Dni'] || $LineasPorPagina>=30) {
                    $this->AddPage('P', 'A4', 0);
                    $this->SetTextColor(0);
                    $this->SetFont('Arial', '', 8);
                    $this->Image('../../../Module/ProgramacionCarga/View/Img/logoefa3.png', 0, 0, 40);
                    $this->Cell(60);
                    $this->Cell(30, 4, 'Sr. '.utf8_decode($row['Prog_NombreColaborador']), 0, 2, 'L');
                    $this->Cell(30, 4, 'DNI: '.$row['Prog_Dni'].'  Codigo: '.$row['Prog_CodigoColaborador'], 0, 2, 'L');
                    $this->Cell(30, 4, 'SEMANA: '.$row['Calendario_Semana'], 0, 0, 'L');
                    $this->Line(10, 23, 200, 23);
                    $this->SetY(25);
                    $LineasPorPagina=0;
                }
            
                if ($Prog_Fecha<>$row['Prog_Fecha'] || $Prog_Dni<>$row['Prog_Dni']) {
                    if ($LineasPorPagina>=28) {
                        $this->AddPage('P', 'A4', 0);
                        $this->SetTextColor(0);
                        $this->SetFont('Arial', '', 8);
                        $this->Image('../../../Module/ProgramacionCarga/View/Img/logoefa3.png', 0, 0, 40);
                        $this->Cell(60);
                        $this->Cell(30, 4, 'Sr. '.utf8_decode($row['Prog_NombreColaborador']), 0, 2, 'L');
                        $this->Cell(30, 4, 'DNI: '.$row['Prog_Dni'].'  Codigo: '.$row['Prog_CodigoColaborador'], 0, 2, 'L');
                        $this->Cell(30, 4, 'SEMANA: '.$row['Calendario_Semana'], 0, 0, 'L');
                        $this->Line(10, 23, 200, 23);
                        $this->SetY(25);
                        $LineasPorPagina=0;
                    }


                    $this->SetTextColor(0);
                    $this->SetFont('Arial', 'B', 8);

                    $diatexto = "";
                    switch (date("N", strtotime($row['Prog_Fecha']))) {
                        case 7: $diatexto = "Domingo "; break;
                        case 1: $diatexto = "Lunes "; break;
                        case 2: $diatexto = "Martes "; break;
                        case 3: $diatexto = "Miércoles "; break;
                        case 4: $diatexto = "Jueves "; break;
                        case 5: $diatexto = "Viernes "; break;
                        case 6: $diatexto = "Sábado "; break;
                    }
                    
                    $diatexto = utf8_decode($diatexto)." ".substr($row['Prog_Fecha'], 8, 2)."/".substr($row['Prog_Fecha'], 5, 2)."/".substr($row['Prog_Fecha'], 0, 4);

                    $this->Cell(0, 8, $diatexto, 0, 0, 'L', false);
                    $this->Ln();
                    $this->SetFillColor(42, 209, 148);
                    $this->SetLineWidth(.1);
                    $this->SetFont('', 'B');
                    $this->SetTextColor(255);
                    $this->SetFont('Arial', 'B', 8);
                    $this->Cell(9, 8, 'Tabla', 1, 0, 'C', true);
                    $this->Cell(9, 8, 'H/Ori', 1, 0, 'C', true);
                    $this->Cell(9, 8, 'H/Des', 1, 0, 'C', true);
                    $this->Cell(22, 8, 'Servicio', 1, 0, 'C', true);
                    $this->Cell(9, 8, 'Bus', 1, 0, 'C', true);
                    $this->Cell(25, 8, 'Origen', 1, 0, 'C', true);
                    $this->Cell(25, 8, 'Destino', 1, 0, 'C', true);
                    $this->Cell(25, 8, 'Evento', 1, 0, 'C', true);
                    $this->Cell(57, 8, 'Observaciones', 1, 0, 'C', true);
                    $this->Ln();
                    $LineasPorPagina=$LineasPorPagina+2;
                    
                }
            

                if ($Prog_Fecha==$row['Prog_Fecha'] and $Prog_Dni==$row['Prog_Dni'] and $Prog_HoraDestino<>$row['Prog_HoraOrigen']) {
                    /*
                    $cadena1 = $Prog_HoraDestino;
                    $cadena2 = $row['Prog_HoraOrigen'];
                    $horaInicio = new DateTime($cadena1);
                    $horaTermino = new DateTime($cadena2);
                    $interval = $horaInicio->diff($horaTermino);
                    $hora2 = strtotime( "00:45" );
                    $hora1 = strtotime ( $interval->format('%H:%i') );
                    */
            
                    $this->SetTextColor(0);
                    $this->SetFont('');
                    $this->SetFont('Arial', '', 6);
                
                    /*
                    if( $hora1 > $hora2 ) {
                        $this->Cell(0, 8,'DESCANSO',1, 0, 'C', false);
                    } else {
                        $this->Cell(0, 8,'RELEVO',1, 0, 'C', false);
                    }
                    */
                
                    $this->Cell(0, 8, 'DESCANSO', 1, 0, 'C', false);
                    $this->Ln();
                    $LineasPorPagina=$LineasPorPagina+1;
                }

                $Prog_Fecha=$row['Prog_Fecha'];
                $Prog_Dni=$row['Prog_Dni'];
                $Prog_HoraDestino=$row['Prog_HoraDestino'];

                $Prog_NombreColaborador=$row['Prog_NombreColaborador'];
                $Prog_CodigoColaborador=$row['Prog_CodigoColaborador'];
                $Calendario_Semana=$row['Calendario_Semana'];

                $this->SetTextColor(0);
                $this->SetFont('');
                $this->SetFont('Arial', '', 6);
                $this->Cell(9, 8, $row['Prog_Tabla'], 1, 0, 'C', false);
                $this->Cell(9, 8, $row['Prog_HoraOrigen'], 1, 0, 'C', false);
                $this->Cell(9, 8, $row['Prog_HoraDestino'], 1, 0, 'C', false);
                $this->Cell(22, 8, utf8_decode($row['Prog_Servicio']), 1, 0, 'C', false);
                $this->Cell(9, 8, $row['Prog_Bus'], 1, 0, 'C', false);
                $this->Cell(25, 8, utf8_decode($row['Prog_LugarOrigen']), 1, 0, 'C', false);
                $this->Cell(25, 8, utf8_decode($row['Prog_LugarDestino']), 1, 0, 'C', false);
                $this->Cell(25, 8, utf8_decode($row['Prog_TipoEvento']), 1, 0, 'C', false);
                $this->SetFont('Arial', '', 5);
                $this->Cell(57, 4, utf8_decode(substr($row['Prog_Observaciones'], 0, 49)), 'LRT', 2, 'C', false);
                $this->Cell(57, 4, utf8_decode(substr($row['Prog_Observaciones'], 50, 100)), 'LRB', 0, 'C', false);
                $this->Ln();
                $LineasPorPagina=$LineasPorPagina+1;
              
               
                //$horaInicio = new DateTime($row['Prog_HoraOrigen']);
                //$horaTermino = new DateTime($row['Prog_HoraDestino']);
                //$Total_Horas->add($horaInicio->diff($horaTermino));
           

                $porciones = explode(":",$row['Prog_HoraOrigen']);
                $Horas= $porciones[0]; // porción1
                $minutos= $porciones[1]; // porción2
                $horaInicio = $Horas*60+$minutos;

                $porciones = explode(":",$row['Prog_HoraDestino']);
                $Horas= $porciones[0]; // porción1
                $minutos= $porciones[1]; // porción2
                $horaTermino = $Horas*60+$minutos;
                
                $Diferencia=$horaTermino-$horaInicio;
             
                $Total_Minutos+= $Diferencia;



            }   
        }

       /* if ($LineasPorPagina>=28) {
            $this->AddPage('P', 'A4', 0);
            $this->SetTextColor(0);
            $this->SetFont('Arial', '', 8);
            $this->Image('../../../Module/ProgramacionCarga/View/Img/logoefa3.png', 0, 0, 40);
            $this->Cell(60);
            $this->Cell(30, 4, 'Sr. '.utf8_decode($Prog_NombreColaborador), 0, 2, 'L');
            $this->Cell(30, 4, 'DNI: '.$Prog_Dni.'  Codigo: '.$Prog_CodigoColaborador, 0, 2, 'L');
            $this->Cell(30, 4, 'SEMANA: '.$Calendario_Semana, 0, 0, 'L');
            $this->Line(10, 23, 200, 23);
            $this->SetY(25);
            $LineasPorPagina=0;
        }
       
        $hora=intval($Total_Minutos/60);
        $minuto=$Total_Minutos-$hora*60;
        $horasTexto = "Total Horas Programadas : ".substr('00'.$hora, -2).":".substr('00'.$minuto, -2);
        $horasTexto = "";
        $this->SetTextColor(0);
        $this->SetFont('Arial', 'B', 8);
        $this->Ln();
        $this->Cell(0, 8, $horasTexto, 0, 0, 'L', false);
        $this->Ln();*/

        if($filasDisponibles==0){
            $this->AddPage('P', 'A4', 0);
            $this->SetTextColor(0);
            $this->SetFont('Arial', '', 12);

            $this->Image('../../../Module/ProgramacionCarga/View/Img/logoefa3.png', 75, 100, 60);
            $this->SetY(125);
        
            $this->Cell(0, 4, utf8_decode('Programacion aun no disponible.'), 0, 2, 'C');
            $this->Ln();
            //$this->Cell(0, 4, utf8_decode('Si tiene problemas para descargar su programación'), 0, 2, 'C');
            //$this->Ln();
            //$this->Cell(0, 4, utf8_decode('Comuniquese al 95'), 0, 2, 'C');


         }



    }    

}




$Semana= $_GET['Semana'];

$Dni= $_GET['Dni'];
$pdf = new PDF();
$Data_Programacion=$pdf->LoadData($Semana);
$pdf->SetFont('Arial','',14);

if($Semana==""){ 
    $pdf->GeneraProgramacionBlanco();}
else{
    $pdf->GeneraProgramacion($Data_Programacion, $Dni);
    }

$pdf->Output('I',$Semana."_".$Dni.".pdf");


?>