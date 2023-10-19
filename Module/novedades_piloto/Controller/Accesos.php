<?php
class Accesos
{
	var $Modulo="novedades_piloto";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-novedades_piloto":
				$tabshtml = '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Inasistencias</a>';
	    		$tabshtml .= '<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Comportamiento</a>';
				$tabshtml .= '<a class="nav-item nav-link" id="nav-accidentes-tab" data-toggle="tab" href="#nav-accidentes" role="tab" aria-controls="nav-accidentes" aria-selected="false">Accidentes</a>';
				$tabshtml .= '<a class="nav-item nav-link" id="nav-novedad_carga-tab" data-toggle="tab" href="#nav-novedad_carga" role="tab" aria-controls="nav-novedad_carga" aria-selected="false">Carga Novedad</a>';
				$tabshtml .= '<a class="nav-item nav-link" id="nav-novedad_detalle-tab" data-toggle="tab" href="#nav-novedad_detalle" role="tab" aria-controls="nav-novedad_detalle" aria-selected="false">Detalle Novedad</a>';
			break;
		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_inasistencias":
                $tablahtml = '	<table id="tabla_inasistencias" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
										<tr>
											<th></th>
											<th>ID</th>
											<th>PILOTO</th>
											<th>DNI</th>
											<th>FECHA</th>
											<th>H.INI.</th>
											<th>H.FIN.</th>
											<th>HORAS</th>
											<th>TIPO NOV.</th>
											<th>DETALLE NOV.</th>
											<th>DESCRIPCION DE LA NOVEDAD</th>
											<th>T.HOR.</th>
											<th>NOVEDAD GDH</th>
									 	</tr>
									</thead>
									<tbody>                           
									</tbody>
		   						</table> ';
            break;

			case "tabla_comportamiento":
				$tablahtml = '	<table id="tabla_comportamiento" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
				   						<tr>
										   	<th></th>	
											<th>ID</th>
											<th>PILOTO</th>
											<th>DNI</th>											
											<th>FECHA</th>
											<th>H.INI.</th>
											<th>TIPO NOV.</th>
											<th>DETALLE NOV.</th>
											<th>DESCRIPCION DE LA NOVEDAD</th>
											<th>FALT.</th>
											<th>A.BONO</th>
											<th>FALTA COMETIDA</th>
										</tr>
									</thead>
									<tbody>             
									</tbody>
		   						</table>';
			break;

            case "tabla_accidentes":
                $tablahtml = '  <table id="tabla_accidentes" class="table table-striped table-bordered table-condensed w-100"  >
                                    <thead class="text-center">
                                        <tr>
											<th></th>
											<th>ID</th>
                                            <th>FECHA</th>
                                            <th>HORA</th>
                                            <th>DNI</th>
                                            <th>PILOTO</th>
                                            <th>TIPO DE NOVEDAD</th>
											<th>DETALLE DE NOVEDAD</th>
											<th>DESCRIPCION DE LA NOVEDAD</th>
											<th>FACTOR DETERMINANTE</th>
											<th>FACTOR CONTRIBUTIVO</th>
											<th>RIT</th>
											<th>FALTA RIT</th>
											<th>R.RESP.</th>
											<th>A.BONO</th>
											<th>RESPONSABILIDAD</th>
                                        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_novedad_carga":
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax = new CRUD();
				$Respuesta = $InstanciaAjax->Permisos($this->Modulo,"btn_borrar_novedad_carga");
				$tablahtml = '	<table id="tabla_novedad_carga" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
				   						<tr>
					   						<th>CODIGO CARGA</th>
											<th>FECHA CARGA</th>
											<th>CANT. REGISTROS</th>
											<th>USUARIO QUE CARGA</th>';
				if($Respuesta=="SI"){
					$tablahtml .= '			<th>ACCIONES</th> ';
				}
				$tablahtml .= '			</tr>
									</thead>
									<tbody>                           
									</tbody>
		   						</table>';
            break;

			case "tabla_novedad_detalle":
                $tablahtml = '	<table id="tabla_novedad_detalle" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
				   						<tr>
					   						<th>CODIGO CARGA</th>
											<th>MES</th>
											<th>DNI</th>
											<th>COLABORADOR</th>
											<th>NOVEDAD</th>
											<th>FECHA INICIO</th> 
											<th>FECHA FIN</th>
											<th>DIAS</th> 
										</tr>
									</thead>
									<tbody>                           
									</tbody>
		   						</table>';
            break;

			case "":
                $tablahtml = '';
            break;

        }
		echo $tablahtml;
	}

	public function ColumnasTabla($NombreTabla,$TipoTabla)
	{
		$columnashtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_inasistencias":
				$defaultContent0 = "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btn_ver_inasistencias'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$columnashtml = '	[	{"defaultContent": " '.$defaultContent0.' "},
										{"data": "inasistencias_id"},
										{"data": "inas_nombrecolaborador"},
										{"data": "inas_dni"},
										{"data": "inas_fechaoperacion"},
										{"data": "inas_horainicio"},
										{"data": "inas_horafin"},
										{"data": "inas_totalhoras"},
										{"data": "inas_tiponovedad"},
										{"data": "inas_detallenovedad"},
										{"data": "inas_descripcion"},
										{"data": "inas_turno"},
										{"data": "noco_novedad"}
				  					]';	
            break;

			case "tabla_comportamiento":
				$defaultContent0 = "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btn_ver_comportamiento'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$columnashtml = '	[	{"defaultContent": " '.$defaultContent0.' "},
										{"data": "comportamiento_id"},
										{"data": "comp_nombrecolaborador"},
										{"data": "comp_dni"},
										{"data": "comp_fechaoperacion"},
										{"data": "comp_horainicio"},
										{"data": "comp_tiponovedad"},
										{"data": "comp_detallenovedad"},
										{"data": "comp_descripcion"},
										{"data": "comp_codigofalta"},
										{"data": "comp_afectapremio"},
										{"data": "comp_faltacometida"}
									] ';	
			break;

            case "tabla_accidentes":
				$defaultContent0 = "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btn_ver_accidentes'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
                $columnashtml = '[  {"defaultContent": " '.$defaultContent0.' "},
									{"data": "Accidentes_Id"},
                                    {"data": "Acci_Fecha"},
                                    {"data": "Acci_Hora"},
                                    {"data": "Acci_Dni"},
                                    {"data": "Acci_NombreColaborador"},
									{"data": "Acci_TipoAccidente"},
                                    {"data": "Acci_TipoEvento"},
									{"data": "Acci_Descripcion"},
									{"data": "Acci_FactorDeterminante"},
									{"data": "Acci_FactorContributivo"},
									{"data": "Acci_CodigoRIT"},
									{"data": "Acci_DescripcionRIT"},
                                    {"data": "Acci_ReconoceResponsabilidad"},
									{"data": "acci_afecta_premio"},
                                    {"data": "Acci_ResponsabilidadAccidente"}
                                ]';
            break;

			case "tabla_novedad_carga":
				MModel($this->Modulo, 'CRUD');
				$InstanciaAjax = new CRUD();
				$Respuesta = $InstanciaAjax->Permisos($this->Modulo,"btn_borrar_novedad_carga");
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btn_borrar_novedad_carga'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "noco_codigo_carga"},
									{"data": "noco_fecha"},
									{"data": "noco_registros"},
									{"data": "noco_nombres_usuario"}';
				if($Respuesta=="SI"){
					$columnashtml .= ',{"defaultContent": "'.$defaultContent1.'"}';
				}
				$columnashtml .=	']';
			break;

			case "tabla_novedad_detalle":
				$columnashtml = '[	{"data": "noco_codigo_carga"},
									{"data": "noco_mes"},
									{"data": "noco_colaborador_id"},
									{"data": "noco_nombres_colaborador"},
									{"data": "noco_novedad"},
									{"data": "noco_fecha_inicio"},
									{"data": "noco_fecha_fin"},
									{"data": "noco_dias"}
				  				]';
			break;

			case "":
				$columnashtml = '';
			break;

        }
		echo $columnashtml;
	}

	public function BotonesFormulario($NombreFormulario,$NombreObjeto)
	{
		$botonesformulario = "";
		switch($NombreFormulario)
		{
			case "form_seleccion_novedad_carga":
				switch($NombreObjeto)
				{
					case "btn_novedad_carga":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax = new CRUD();
						$Respuesta = $InstanciaAjax->Permisos($this->Modulo,"btn_nuevo_novedad_carga");
						$botonesformulario = '<button type="button" id="btn_buscar_novedad_carga" class="btn btn-secondary btn-sm btn_buscar_novedad_carga mr-1">Buscar</button>';
						if($Respuesta=="SI"){
							$botonesformulario .= '<button id="btn_nuevo_novedad_carga" type="button" class="btn btn-secondary btn-sm btn_nuevo_novedad_carga mr-1" >+ Nuevo</button>';
						}
						
					break;
				}
			break;

			case "":
				$botonesformulario	= '';
			break;
			
		}
		echo $botonesformulario;
    }

	public function DivFormulario($NombreFormulario,$NombreObjeto)
	{
		$divformulario = "";
		switch($NombreFormulario)
		{
			case "":
				switch($NombreObjeto)
				{
					case "":
					break;

					case "":
					break;

				}
			break;
		}
		echo $divformulario;
    }

	public function MostrarDiv($NombreFormulario,$NombreObjeto,$Dato)
	{
		$Mostrar_div = "";
		switch($NombreFormulario)
		{
			case "":
				switch($NombreObjeto)
				{
					case "":
						$Mostrar_div = '';
					break;

					case "":
						switch($Dato)
						{
							case "":
							break;

							case "":
							break;

						}
						$Mostrar_div = '';
					break;

				}
			break;


		}
		echo $Mostrar_div;
    }


}