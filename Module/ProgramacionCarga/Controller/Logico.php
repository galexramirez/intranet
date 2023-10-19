<?php
session_start();
class Logico
{
	var $Modulo = "ProgramacionCarga";

	// 1.0 CARGA DATOS DE BUSQUEDA DE PILOTO
	function Contenido($NombreDeModuloVista)    
	{		
		MView($this->Modulo,'LocalView',compact('NombreDeModuloVista') );
	}

	function CrearProgramacionCarga($inputFileName,$Semana)
	{
			require_once 'Services/Composer/vendor/autoload.php';
	  		/**  Identify the type of $inputFileName  **/
			$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
	 		/**  Create a new Reader of the type that has been identified  **/
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
	 		/**  Load $inputFileName to a Spreadsheet Object  **/
			$spreadsheet = $reader->load($inputFileName);
	 		/**  Hoja de trabajo de Excel  **/
			$worksheet = $spreadsheet->getActiveSheet();
	 		/**   Get the highest row number and column letter referenced in the worksheet   **/
			$highestRow = $worksheet->getHighestRow(); // e.g. 10

			$PrgRg_Operacion=$worksheet->getCell('A2')->getValue();
			$PrgRg_FechaProgramado=$worksheet->getCell('B2')->getValue();
			$UNIX_DATE = ($PrgRg_FechaProgramado - 25569) * 86400;
			$PrgRg_FechaProgramado =gmdate("Y-m-d", $UNIX_DATE);

			// COMPARAR QUE LA FECHA A REGISTRAR COINCIDA CON LA SEMANA SELECCIONADA
			MModel($this->Modulo,'CRUD');
			$InstanciaAjax1= new CRUD();
			$Respuesta1=$InstanciaAjax1->BuscarSemanaProgramacionCarga($PrgRg_FechaProgramado,$Semana);

			if($Respuesta1==false){
				echo "El registro no corresponde a la semana seleccionada ...!!!";
			}else{
                // BUSQUEDA Y CONDICION DE FECHA DE PROGRAMACION EN TABLA PROGRAMACIONCARGA
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax2= new CRUD();
                $Respuesta2=$InstanciaAjax2->BuscarProgramacionCarga($PrgRg_Operacion, $PrgRg_FechaProgramado);

                if ($Respuesta2==false) {
                    echo "El registro ya existe ...!!!";
                } else {
					$Prog_Codigo = substr($PrgRg_FechaProgramado, 0, 4).substr($PrgRg_FechaProgramado, 5, 2).substr($PrgRg_FechaProgramado, 8, 2).$PrgRg_Operacion;
                    $CantErrores=0;

                    for ($row = 2; $row <= $highestRow; $row++) {
                        $Prog_Operacion=$worksheet->getCell('A'.$row)->getValue();
                        $Prog_Fecha=$worksheet->getCell('B'.$row)->getValue();
                        $Prog_Dni=$worksheet->getCell('C'.$row)->getValue();
                        $Prog_CodigoColaborador=$worksheet->getCell('D'.$row)->getValue();
                        $Prog_NombreColaborador=$worksheet->getCell('E'.$row)->getValue();
                        $Prog_Tabla=$worksheet->getCell('F'.$row)->getValue();
                        $Prog_HoraOrigen=$worksheet->getCell('G'.$row)->getValue();
                        $Prog_HoraDestino=$worksheet->getCell('H'.$row)->getValue();
                        $Prog_Servicio=$worksheet->getCell('I'.$row)->getValue();
                        $Prog_ServBus=$worksheet->getCell('J'.$row)->getValue();
                        $Prog_Bus=$worksheet->getCell('K'.$row)->getValue();
                        $Prog_LugarOrigen=$worksheet->getCell('L'.$row)->getValue();
                        $Prog_LugarDestino=$worksheet->getCell('M'.$row)->getValue();
                        $Prog_TipoEvento=$worksheet->getCell('N'.$row)->getValue();
                        $Prog_Observaciones=$worksheet->getCell('O'.$row)->getValue();
                        $Prog_KmXPuntos=$worksheet->getCell('P'.$row)->getValue();
                        $Prog_TipoTabla=$worksheet->getCell('Q'.$row)->getValue();
                        $Prog_NPlaca=$worksheet->getCell('R'.$row)->getValue();
                        $Prog_NVid=$worksheet->getCell('S'.$row)->getValue();
						$Prog_IdManto=$worksheet->getCell('T'.$row)->getValue();
						$Prog_Sentido=$worksheet->getCell('U'.$row)->getValue();
						$Prog_BusManto=$worksheet->getCell('V'.$row)->getValue();
						$Prog_Viajes=$worksheet->getCell('W'.$row)->getValue();
						$Prog_Campo1=$worksheet->getCell('X'.$row)->getValue();
						$Prog_Campo2=$worksheet->getCell('Y'.$row)->getValue();
						$Prog_Campo3=$worksheet->getCell('Z'.$row)->getValue();

						$UNIX_DATE = ($Prog_Fecha - 25569) * 86400;
                        $Prog_Fecha =gmdate("Y-m-d", $UNIX_DATE);

                        $HoraConvertir=$Prog_HoraOrigen;
                        $UNIX_HOUR = ($HoraConvertir - 25569) * 86400;
                        $Horas=gmdate("H", $UNIX_HOUR);
                        if ($HoraConvertir>=1) {
                            $Horas=$Horas+24;
                        }
                        $UNIX_HOUR = ($HoraConvertir - 25569) * 86400;
                        $Minuto=gmdate("i", $UNIX_HOUR);
                        $Prog_HoraOrigen=$Horas.":".$Minuto;

                        $HoraConvertir=$Prog_HoraDestino;
                        $UNIX_HOUR = ($HoraConvertir - 25569) * 86400;
                        $Horas=gmdate("H", $UNIX_HOUR);
                        if ($HoraConvertir>=1) {
                            $Horas=$Horas+24;
                        }
                        $UNIX_HOUR = ($HoraConvertir - 25569) * 86400;
                        $Minuto=gmdate("i", $UNIX_HOUR);
                        $Prog_HoraDestino=$Horas.":".$Minuto;

                        if ($Prog_KmXPuntos=="") {
                            $Prog_KmXPuntos=0;
                        }
						
                        //Ejecuta Modelo
                        MModel($this->Modulo, 'CRUD');
                        $InstanciaAjax3= new CRUD();
                        $Respuesta3=$InstanciaAjax3->CrearProgramacion($Prog_Codigo, $Prog_Operacion, $Prog_Fecha, $Prog_Dni, $Prog_CodigoColaborador, $Prog_NombreColaborador, $Prog_Tabla, $Prog_HoraOrigen, $Prog_HoraDestino, $Prog_Servicio, $Prog_ServBus, $Prog_Bus, $Prog_LugarOrigen, $Prog_LugarDestino, $Prog_TipoEvento, $Prog_Observaciones, $Prog_KmXPuntos, $Prog_TipoTabla, $Prog_NPlaca, $Prog_NVid, $Prog_IdManto, $Prog_Sentido, $Prog_BusManto,$Prog_Viajes,$Prog_Campo1,$Prog_Campo2,$Prog_Campo3);
                        
                        if ($Respuesta3==false) {
                            $CantErrores=$CantErrores+1;
                            echo "No grabo linea ".$row." -> Fecha: ".$Prog_Fecha." - Tabla : ".$Prog_Tabla." - Hora Origen : ".$Prog_HoraOrigen."<hr>"  ;
                        }
                    }

                    MModel($this->Modulo, 'CRUD');
                    $InstanciaAjax4= new CRUD();
                    $Respuesta4=$InstanciaAjax4->CrearProgramacionCarga($PrgRg_Operacion, $PrgRg_FechaProgramado);
                
                    echo "Se cargaron ".($highestRow-$CantErrores-1)." de ".($highestRow-1);
                }
            }

	}

	function AniosProgramacionCarga()
	{
		//Ejecuta Modelo
		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->AniosProgramacionCarga();
		$html = '<option value="">Año</option>';
		foreach ($Respuesta as $row)
		{
			$html .= '<option value="'.$row['Anio'].'">'.$row['Anio'].'</option>';
		}
		echo $html;	
	}

	function SemanasProgramacionCarga($Calendario_Anio)
	{
		//Ejecuta Modelo
		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->SemanasProgramacionCarga($Calendario_Anio);
		$html = '<option value="">Semana</option>';
		foreach ($Respuesta as $row)
		{
			$html .= '<option value="'.$row['Semana'].'">'.$row['Semana'].'</option>';
		}
		echo $html;	
	}

	function AniosPublicacionCarga()
	{
		//Ejecuta Modelo
		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->AniosPublicacionCarga();
		$html = "";
		foreach ($Respuesta as $row)
		{
			$html .= '<option value="'.$row['Anio'].'">'.$row['Anio'].'</option>';
		}
		echo $html;	
	}

	function SemanasPublicacionCarga($AniosPublicados)
	{
		//Ejecuta Modelo
		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->SemanasPublicacionCarga($AniosPublicados);
		$html = "";
		foreach ($Respuesta as $row)
		{
			$html .= '<option value="'.$row['Semanas'].'">'.$row['Semanas'].'</option>';
		}
		echo $html;	
	}

	function ReportePDF_General($Semana)
	{
		MController($this->Modulo,'PDF');
		$pdf= new PDF();
		
		$Data_Programacion=$pdf->LoadData($Semana);
		$pdf->SetFont('Arial','',14);
		$pdf->GeneraProgramacionGeneral($Data_Programacion);
		
		$data_Pdf = $pdf->Output('S',$Semana.".pdf");
		$data_Pdf = base64_encode($data_Pdf);
		$data_Pdf = 'data:application/pdf;base64, '.$data_Pdf;
		echo json_encode($data_Pdf);
	}

	function ReportePDF_Individual($Semana,$Dni)
	{
		MController($this->Modulo,'PDF');
		$pdf = new PDF();
		$Data_Programacion=$pdf->LoadData($Semana);
		$pdf->SetFont('Arial','',14);
		if($Semana==""){ 
    		$pdf->GeneraProgramacionBlanco();
		}else{
    		$pdf->GeneraProgramacionIndividual($Data_Programacion, $Dni);
    	}
		$data_Pdf = $pdf->Output('S',$Semana."_".$Dni.".pdf");
		$data_Pdf = base64_encode($data_Pdf);
		$data_Pdf = 'data:application/pdf;base64,'.$data_Pdf;
		echo json_encode($data_Pdf);
	}

	function DocumentRoot()
	{
		$miCarpeta = '';
		$miHost = $_SERVER['HTTP_HOST'];
		$miReferer = $_SERVER['HTTP_REFERER'];
		$miCarpeta = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
		echo $miCarpeta;
	}

	function ValidarProgramacionCarga($PrgRg_FechaProgramado)
	{
		$rptavalidar = "NO";
		$PubRg_SemanaPublicada = "";
		$PubRg_Estado = "PUBLICADO";
		$TablaBD = "Calendario";
		$CampoBD = "Calendario_Id";
		$Calendario_Id = substr($PrgRg_FechaProgramado,0,10);

		MModel($this->Modulo,'CRUD');
		$InstanciaAjax = new CRUD();
		$Respuesta = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$Calendario_Id);
		foreach ($Respuesta as $row)
		{
			$PubRg_SemanaPublicada = $row['Calendario_Semana'];
		}

		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->ValidarProgramacionCarga($PubRg_SemanaPublicada, $PubRg_Estado);
		if($Respuesta==false)
		{
			$rptavalidar = "SI";
		}
		echo $rptavalidar;				
	}

	function ValidarControlFacilitador($PrgRg_FechaProgramado,$PrgRg_Operacion)
	{
		$rptavalidar = "NO";
		$CFaRg_FechaCargada = substr($PrgRg_FechaProgramado,0,10);
		$CFaRg_TipoOperacionCargada = $PrgRg_Operacion;
		$CFaRg_Estado = "GENERADO";
		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->ValidarControlFacilitador($CFaRg_FechaCargada, $CFaRg_TipoOperacionCargada ,$CFaRg_Estado);
		if($Respuesta==false)
		{
			$rptavalidar = "SI";
		}
		echo $rptavalidar;				

	}
}