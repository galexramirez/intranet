<?php
class Logico
{
	var $Modulo="DespachoFlota";
	// 1.0 CARGA DATOS DE BUSQUEDA DE PILOTO
	public function Contenido($NombreDeModuloVista)    
	{		
		MView($this->Modulo,'LocalView',compact('NombreDeModuloVista') );
	}
	
    public function BuscarProgramacion($Prog_Fecha,$turno_DespachoFlota)
    {
		MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarProgramacion($Prog_Fecha,$turno_DespachoFlota);
		$html = "";
		$colorHeader = "";
		$colorBorder = "";
		$styleBus = "";
		
        foreach ($Respuesta as $row) {
			if($row['Prog_Operacion']=="TRONCAL"){
				//$colorHeader = 'bg-secondary text-white';
				$colorBorder =  'border-secondary mb-3';
				$styleBus = 'font-size:42px;color:grey';
			}
			if($row['Prog_Operacion']=="ALIMENTADOR"){
				//$colorHeader = 'bg-warning text-white';
				$colorBorder =  'border-warning mb-3';
				$styleBus = 'font-size:42px;color:#f7bb07';
			}	
			if($row['Repo_Estado']==""){
				$estado = 'thumbs-up';
			}else{
				$estado = 'thumbs-down';
			}
			$html .=	'<div class="card '.$colorBorder.'">
							<div class="card-header '. $colorHeader .'">
								<div class="d-flex justify-content-between">
									<div class="p2" style="display: flex">
        								<i class="fas fa-user" style=" '. $styleBus .' "></i>
        								<div style="margin-left: 10px"><h2 class="card-title text-right">'. $row["Prog_CodigoColaborador"] . '</h2></div>
									</div>
									<div class="p2" style="display: flex">
										<i class="fa fa-bus" style=" '. $styleBus .'"></i>	
										<div style="margin-left: 10px"><h2 class="card-title text-right"> '. $row["Prog_Bus"] . '</h2></div>
									</div>
								</div>
							</div>
							<div class="card-body card-block">
								<ul class="list-inline">
									<div style="display: flex">
										<li><i class="fa fa-user" style="font-size:24"></i></li>
										<div style="margin-left: 10px"><h5><b>' . $row["Prog_NombreColaborador"] . '</b></h5></div>
									</div>
								</ul>
								<ul class="list-inline">
									<li>
										<div style="display: flex">
											<i class="fa fa-clock" style="font-size:24"></i>
											<div style="margin-left: 10px"><h5><b> DESTINO : ' . $row["Prog_HoraDestino"] .'</b></h5></div>
										</div>
									</li>
									<li> MANTENIMIENTO : ' . $row["Prog_HoraMantenimiento"] .'</li>
									<li> ORIGEN : ' . $row["Prog_HoraOrigen"] .'</li>
								</ul>
								<p class="card-text"> TABLA : ' . $row["Prog_Tabla"] . ' ' . $row["Prog_Servicio"] .'</p>
							</div>
							<div class="card-footer text-muted">
								<div class="d-flex justify-content-between">
									<div class="p2">
										<i class="fa fa-'. $estado .'"></i>
									</div>
									<div class="p2">
										<a href="#" class="btn btn-info" onclick="f_EditarReporteDespachoFlota('. $row["ControlFacilitador_Id"] .')">Editar</a>
									</div>
								</div>
							</div>
						</div>';
        }
		echo $html;
	}

	public function BuscarReporte($ControlFacilitador_Id)
	{
		MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarReporte($ControlFacilitador_Id);
	}
	
	public function ExisteDespachoFlotaTurno($Prog_Fecha,$turno_DespachoFlota)
	{
		$rptaExisteDespachoFlotaTurno="NO";
		MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->ExisteDespachoFlotaTurno($Prog_Fecha,$turno_DespachoFlota);

        if (count($Respuesta)>0) {
            $rptaExisteDespachoFlotaTurno = 'SI';
        }
		echo $rptaExisteDespachoFlotaTurno;
    }

	public function NuevoDespachoFlota($ControlFacilitador_Id,$Programacion_Id,$Repo_Descripcion,$Repo_BusCambio,$Repo_HoraSalida,$Repo_Motivo,$Repo_CFaRgId)
	{
		MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->NuevoDespachoFlota($ControlFacilitador_Id,$Programacion_Id,$Repo_Descripcion,$Repo_BusCambio,$Repo_HoraSalida,$Repo_Motivo,$Repo_CFaRgId);
	}

	public function EditarDespachoFlota($ControlFacilitador_Id,$Programacion_Id,$Repo_Descripcion,$Repo_BusCambio,$Repo_HoraSalida,$Repo_Motivo)
	{
		MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->EditarDespachoFlota($ControlFacilitador_Id,$Programacion_Id,$Repo_Descripcion,$Repo_BusCambio,$Repo_HoraSalida,$Repo_Motivo);
	}

	public function BuscarSalidaFlota($Prog_Fecha,$Prog_Operacion,$tipo_SalidaFlota)
	{
		MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarSalidaFlota($Prog_Fecha,$Prog_Operacion,$tipo_SalidaFlota);
	}

	public function BuscarInformeDespacho($Prog_Fecha,$Prog_Operacion,$turno_InformeDespacho)
	{
		MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarInformeDespacho($Prog_Fecha,$Prog_Operacion,$turno_InformeDespacho);
	}
	
	public function BuscarInformeLlegada($Prog_Fecha,$Prog_Operacion,$tipo_InformeLlegada)
	{
		MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarInformeLlegada($Prog_Fecha,$Prog_Operacion,$tipo_InformeLlegada);
		
	}

	public function SelectBus($Prog_Operacion)
    {
        //Ejecuta Modelo
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectBus($Prog_Operacion);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Bus'].'">'.$row['Bus'].'</option>';
        }
        echo $html;
    }

	public function SelectTipos($Prog_Operacion, $Ttabla_Tipo)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTipos($Prog_Operacion, $Ttabla_Tipo);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
        }
        echo $html;
    }

	public function CrearSalidaFlota($Prog_Fecha,$Prog_Operacion,$HoraInicio,$HoraTermino,$TurnoSalidaFlota)
	{
		$Prog_TipoEvento = "INICIO AUTOBUS";
		$TiempoMantenimiento = "00:20:00";
		$KmTablaCorta = "200";
		
		// Se asigna el siguiente Id de ope_despachoflotaregistrocarga
        // Se asigna el siguiente Id de ope_telemtriacarga
        $TablaBD = 'ope_despachoflotaregistrocarga';
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax = new CRUD;
        $Respuesta=$InstanciaAjax->TablaVacia($TablaBD);
    
        foreach ($Respuesta as $row) {
            if ($row['Contar']==0) {
                $dflo_dfrgid = '1';
            } else {
                $TablaBD="ope_despachoflotaregistrocarga";
                $CampoId="dfrg_id";
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $MaxId = $InstanciaAjax->MaxId($TablaBD, $CampoId);
                foreach ($MaxId as $row) {
                    $dflo_dfrgid = $row['MaxId']+1;
                }
            }
        }
		
		$dflo_turno = $TurnoSalidaFlota;

		$contador = 0;
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->TrabajoTablas($Prog_Fecha,$Prog_Operacion,$HoraInicio,$HoraTermino,$Prog_TipoEvento,$TiempoMantenimiento,$KmTablaCorta);

		foreach ($Respuesta as $row){
			//$despachoflota_id = $row['despachoflota_id'];
			$contador++;
			$ControlFacilitador_Id = $row['ControlFacilitador_Id'];
			$Programacion_Id = $row['Programacion_Id'];
			$Prog_Codigo = $row['Prog_Codigo'];
			$Prog_Operacion = $row['Prog_Operacion'];
			$Prog_Fecha = $row['Prog_Fecha'];
			$Prog_Dni = $row['Prog_Dni'];
			$Prog_CodigoColaborador = $row['Prog_CodigoColaborador'];
			$Prog_NombreColaborador = $row['Prog_NombreColaborador'];
			$Prog_Tabla = $row['Prog_Tabla'];
			$Prog_HoraOrigen = $row['Prog_HoraOrigen'];
			$Prog_HoraDestino = $row['Prog_HoraDestino'];
			$Prog_Servicio = $row['Prog_Servicio'];
			$Prog_ServBus = $row['Prog_ServBus'];
			$Prog_Bus = $row['Prog_Bus'];
			$Prog_LugarOrigen = $row['Prog_LugarOrigen'];
			$Prog_LugarDestino = $row['Prog_LugarDestino'];
			$Prog_TipoEvento = $row['Prog_TipoEvento'];
			$Prog_Observaciones = $row['Prog_Observaciones'];
			$Prog_KmXPuntos = $row['Prog_KmXPuntos'];
			$Prog_TipoTabla = $row['Prog_TipoTabla'];
			$Prog_NPlaca = $row['Prog_NPlaca'];
			$Prog_NVid = $row['Prog_NVid'];
			$Prog_IdManto = $row['Prog_IdManto'];
			$Prog_Sentido = $row['Prog_Sentido'];
			$Prog_BusManto = $row['Prog_BusManto'];
			$CFaRg_Id = $row['CFaRg_Id'];
			$CFaci_Estado = $row['CFaci_Estado'];
			$CFaci_UsuarioId = $row['CFaci_UsuarioId'];
			$CFaci_Novedad = $row['CFaci_Novedad'];
			$CFaci_ProcesoOrigen = $row['CFaci_ProcesoOrigen'];
			$CFaci_Version = $row['CFaci_Version'];
			$dflo_nrodespacho = $contador;
			$dflo_tablacorta = $row['Prog_TablaCorta'];
			$dflo_horainiciotabla = $row['Prog_HoraInicio'];
			$dflo_horaterminotabla = $row['Prog_HoraTermino'];
			$dflo_kmtotal = $row['Prog_KmTotal'];
			$dflo_obsmanto = $row['Prog_BusManto'];
			$dflo_horaentregamanto = $row['Prog_HoraMantenimiento'];

			MModel($this->Modulo, 'CRUD');
			$InstanciaAjax= new CRUD();
			$Respuesta=$InstanciaAjax->CrearSalidaFlota($ControlFacilitador_Id, $Programacion_Id, $Prog_Codigo, $Prog_Operacion, $Prog_Fecha, $Prog_Dni, $Prog_CodigoColaborador, $Prog_NombreColaborador, $Prog_Tabla, $Prog_HoraOrigen, $Prog_HoraDestino, $Prog_Servicio, $Prog_ServBus, $Prog_Bus, $Prog_LugarOrigen, $Prog_LugarDestino, $Prog_TipoEvento, $Prog_Observaciones, $Prog_KmXPuntos, $Prog_TipoTabla, $Prog_NPlaca, $Prog_NVid, $Prog_IdManto, $Prog_Sentido, $Prog_BusManto, $CFaRg_Id, $CFaci_Estado, $CFaci_UsuarioId, $CFaci_Novedad, $CFaci_ProcesoOrigen, $CFaci_Version, $dflo_nrodespacho, $dflo_tablacorta, $dflo_horainiciotabla, $dflo_horaterminotabla, $dflo_kmtotal, $dflo_turno, $dflo_obsmanto, $dflo_horaentregamanto, $dflo_dfrgid);
		}

		$dfrg_fecha = $Prog_Fecha;
		$dfrg_operacion = $Prog_Operacion;
		$dfrg_turno = $TurnoSalidaFlota;
		$dfrg_horainicio = $HoraInicio;
		$dfrg_horatermino = $HoraTermino;
		
		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax = new CRUD();
		$Respuesta = $InstanciaAjax->CrearDespachoFlotaCarga($dfrg_fecha, $dfrg_operacion, $dfrg_turno, $dfrg_horainicio, $dfrg_horatermino);
	}

	public function ExisteSalidaFlota($Prog_Fecha,$Prog_Operacion,$TurnoSalidaFlota)
    {
		$rptaExisteSalidaFlota = "NO";
		MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->ExisteSalidaFlota($Prog_Fecha,$Prog_Operacion,$TurnoSalidaFlota);

        if (count($Respuesta)>0) {
            $rptaExisteSalidaFlota = 'SI';
        }
		echo $rptaExisteSalidaFlota;
    }

	public function TurnoInformeDespacho($Prog_Fecha,$Prog_Operacion)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->TurnoInformeDespacho($Prog_Fecha,$Prog_Operacion);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['turno'].'">'.$row['turno'].' de '.$row['horainicio'].' a '.$row['horatermino'].'</option>';
        }
        echo $html;
    }

	public function TurnoDespachoFlota($Prog_Fecha)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->TurnoDespachoFlota($Prog_Fecha);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['turno'].'">'.$row['turno'].'</option>';
        }
        echo $html;
    }

}