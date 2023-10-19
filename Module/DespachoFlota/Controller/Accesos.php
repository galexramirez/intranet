<?php
class Accesos
{
	var $Modulo="DespachoFlota";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-DespachoFlota":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Salida</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Registro</a>
	    						<a class="nav-item nav-link" id="nav-despacho-tab" data-toggle="tab" href="#nav-despacho" role="tab" aria-controls="nav-despacho" aria-selected="false">Despacho</a>
								<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Llegada</a>';
			break;
		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tablaSalidaFlota":
                $tablahtml = '	<table id="tablaSalidaFlota" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>OPERACION</th>
											<th>CODIGO</th>
											<th>APELLIDOS Y NOMBRES</th>
											<th>TABLA</th>
											<th>H.ENTRE.MANT.</th>
											<th>H.ORIG</th>
											<th>H.DEST</th>
											<th>SERVICIO</th>
											<th>ID SB.</th>
											<th>BUS</th>
											<th>CAMB.BUS</th>
											<th>TAB.CORTA</th>
											<th>OBSERV.</th>
											<th>H.INICIO</th>
											<th>H.TERMINO</th>
											<th>KM.TOTAL</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

            case "tablaInformeDespacho":
                $tablahtml = '	<table id="tablaInformeDespacho" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
				   						<tr>
					 						<th>OPERACION</th>
											<th>CODIGO</th>
					 						<th>APELLIDOS Y NOMBRES</th>
					 						<th>TABLA</th>
					 						<th>H.ENTREGA</th>
											<th>H.ORIG</th>
					 						<th>H.DEST</th>
					 						<th>SERVICIO</th>
					 						<th>ID SB.</th>
					 						<th>BUS</th>
					 						<th>H. REAL</th>
					 						<th>ON TIME</th>
					 						<th>STATUS</th>
					 						<th>MOTIVO RETRASO</th>
					 						<th>CAMB.BUS</th>
				 						</tr>
									</thead>
									<tbody>                           
									</tbody>
		   						</table>';
            break;

			case "tablaInformeLlegada":
				$tablahtml = '	<table id="tablaInformeLlegada" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th>OPERACION</th>
											<th>CODIGO</th>
											<th>APELLIDOS Y NOMBRES</th>
											<th>TABLA</th>
											<th>H.ORIG</th>
											<th>H.DEST</th>
											<th>SERVICIO</th>
											<th>ID SB.</th>
											<th>BUS</th>
											<th>MANTO</th>
											<th>OBSERVACIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
		   						</table>';
			break;

        }
		echo $tablahtml;
	}

	public function ColumnasTabla($NombreTabla,$TipoTabla)
	{
		$columnashtml = "";
        switch ($NombreTabla) 
		{
            case "tablaSalidaFlota":
				$columnashtml = '[	{"data": "Prog_Id"},
									{"data": "Prog_Operacion"},
									{"data": "Prog_CodigoColaborador"},    
									{"data": "Prog_NombreColaborador"},
									{"data": "Prog_Tabla"},
									{"data": "Prog_HoraMantenimiento"},
									{"data": "Prog_HoraOrigen"},
									{"data": "Prog_HoraDestino"},
									{"data": "Prog_Servicio"},
									{"data": "Prog_IdManto"},
									{"data": "Prog_Bus"},
									{"data": "Prog_BusCambio"},
									{"data": "Prog_TablaCorta"},
									{"data": "Prog_BusManto"},
									{"data": "Prog_HoraInicio"},
									{"data": "Prog_HoraTermino"},
									{"data": "Prog_KmTotal"}
				  				]';
			break;

			case "tablaInformeDespacho":
				$columnashtml = '[	{"data": "Prog_Operacion"},    
									{"data": "Prog_CodigoColaborador"},    
									{"data": "Prog_NombreColaborador"},
									{"data": "Prog_Tabla"},
									{"data": "Prog_HoraMantenimiento"},
									{"data": "Prog_HoraOrigen"},
									{"data": "Prog_HoraDestino"},
									{"data": "Prog_Servicio"},
									{"data": "Prog_IdManto"},
									{"data": "Prog_Bus"},
									{"data": "Repo_HoraReal"},
									{"data": "Repo_OnTime"},
									{"data": "Repo_Status"},
									{"data": "Repo_Descripcion"},
									{"data": "Repo_BusCambio"}
				  				]';
            break;

			case "tablaInformeLlegada":
				$columnashtml = '[	{"data": "Prog_Operacion"},    
									{"data": "Prog_CodigoColaborador"},    					
									{"data": "Prog_NombreColaborador"},
									{"data": "Prog_Tabla"},
									{"data": "Prog_HoraOrigen"},
									{"data": "Prog_HoraDestino"},
									{"data": "Prog_Servicio"},
									{"data": "Prog_IdManto"},
									{"data": "Prog_Bus"},
									{"data": "Prog_BusManto"},
									{"data": "Prog_Observaciones"}
				  				]';
			break;

        }
		echo $columnashtml;
	}

	public function BotonesFormulario($NombreFormulario,$NombreObjeto)
	{
		$botonesformulario = "";
		switch($NombreFormulario)
		{
			case "formSeleccionSalidaFlota":
				switch($NombreObjeto)
				{
					case "btnGenerarSalidaFlota":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax= new CRUD();
						$Respuesta=$InstanciaAjax->Permisos($this->Modulo,$NombreObjeto);
						if ($Respuesta=="SI"){
							$botonesformulario = '<button type="button" id="btnGenerarSalidaFlota" class="btn btn-secondary btn-sm btnGenerarSalidaFlota">Generar</button>';
						}
					break;
				}
			break;
		}
		echo $botonesformulario;
    }

}