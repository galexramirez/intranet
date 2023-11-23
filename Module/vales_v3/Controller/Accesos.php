<?php
class Accesos
{
	var $Modulo="vales_v3";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-Vales":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><span id="idProcesar">Procesar</span></a>';
			break;
		}
		echo $tabshtml;
	}

	public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_vales":
                $tablahtml = '	<table id="tabla_vales" class="table table-striped table-bordered table-condensed w-80">
									<thead class="text-center">
										<tr>
											<th>VER</th>
											<th>CODIGO_VALE</th>
											<th>ESTADO</th>
											<th>CODIGO_OT</th>
											<th>BUS</th>
											<th>ORIGEN</th>
											<th>ASOCIADO</th>
											<th>RESPONSABLE</th>
											<th>APERTURA</th>
											<th>FECHA_APERTURA</th>
											<th>CIERRE_ADMINISTRATIVO</th>
											<th>FECHA_CIERRE_ADM.</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

            case "tablaDetalleRepuestos":
                $tablahtml = '  <table id="tablaDetalleRepuestos" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
											<th>ITEM</th>
											<th>CODIGO</th>
											<th>NRO.SERIE</th>
                                            <th>DESCRIPCION_REPUESTOS</th>
											<th>CANTIDAD</th>
											<th>UNIDAD</th>';
				if($TipoTabla=="SI"){
					$tablahtml .= '			<th>ACCIONES</th>';
				}
				$tablahtml .= '	        </tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_ver_detalle_repuestos":
                $tablahtml = '  <table id="tabla_ver_detalle_repuestos" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
                                        	<th>ITEM</th>    
											<th>CODIGO</th>
											<th>NRO.SERIE</th>
                                            <th>DESCRIPCION REPUESTOS</th>
											<th>CANTIDAD</th>
											<th>UNIDAD</th>
										</tr>
                                    </thead>
                                    <tbody>                           
                                    </tbody>
                                </table>';
            break;

			case "tabla_ver_procesar_detalle_repuestos":
                $tablahtml = '  <table id="tabla_ver_procesar_detalle_repuestos" class="table table-striped table-bordered table-condensed w-100">
                                    <thead class="text-center">
                                        <tr>
                                        	<th>ITEM</th>    
											<th>CODIGO</th>
											<th>NRO.SERIE</th>
                                            <th>DESCRIPCION REPUESTOS</th>
											<th>CANTIDAD</th>
											<th>UNIDAD</th>
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
            case "tabla_vales":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btn_ver_vales'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$defaultContent2 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_vales'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"defaultContent": " '.$defaultContent1.' "},
									{"data": "cod_vale"},
									{"data": "va_estado"},
									{"data": "va_ot_id"},
									{"data": "va_bus"},
									{"data": "va_origen"},
									{"data": "va_asociado"},
									{"data": "va_responsable"},
									{"data": "va_genera"},
									{"data": "va_date_genera"},
									{"data": "va_cierre_adm"},
									{"data": "va_date_cierre_adm"},
									{"defaultContent": " '.$defaultContent2.' "}
								]';
			break;

            case "tablaDetalleRepuestos":
				$columnashtml = ' [ {"data": "rv_id"},
									{"data": "rv_repuesto"},
									{"data": "rv_nroserie"},
                                    {"data": "rv_descripcion"},
									{"data": "rv_cantidad"},
									{"data": "rv_unidad"}';
				if($TipoTabla=="SI"){
					$defaultContent = "<div class='text-center'><div class='btn-group'><button tittle='Borrar' class='btn btn-danger btn-sm btnBorrarDetalleRepuestos'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
					$columnashtml .= ',{"defaultContent": " '.$defaultContent.' "}';	
				}
				$columnashtml .= ']';
            break;

			case "tabla_ver_detalle_repuestos":
				$columnashtml = ' [ {"data": "rv_id"},
									{"data": "rv_repuesto"},
									{"data": "rv_nroserie"},
                                    {"data": "rv_descripcion"},
									{"data": "rv_cantidad"},
									{"data": "rv_unidad"}
								]';
            break;

			case "tabla_ver_procesar_detalle_repuestos":
				$columnashtml = ' [ {"data": "rv_id"},
									{"data": "rv_repuesto"},
									{"data": "rv_nroserie"},
                                    {"data": "rv_descripcion"},
									{"data": "rv_cantidad"},
									{"data": "rv_unidad"}
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
			case "form_seleccion_vales":
				switch($NombreObjeto)
				{
					case "btn_seleccion_vales":
						$botonesformulario = '<button type="button" id="btn_buscar_vales" class="btn btn-secondary btn-sm btn_buscar_vales ml-1">Buscar</button>';
						$botonesformulario .= '<button type="button" id="btn_descargar_vales" class="btn btn-secondary btn-sm btn_descargar_vales ml-1">Descargar</button>';
					break;
				}
			break;
		}
		echo $botonesformulario;
    }

	public function DivFormulario($NombreFormulario,$NombreObjeto)
	{
		$divformulario = "";
		switch($NombreFormulario)
		{
			case "contenido":
				switch($NombreObjeto)
				{
					case "div_alertsDropdown_vales":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta		= $InstanciaAjax->buscar_estado("manto_vales", "va_estado", "OBSERVADO", "va_date_genera", "2022-12-31");

						$divformulario = '	<h6 class="dropdown-header">
												Alertas Vales Observados
											</h6>';
						
						foreach($Respuesta as $row){
							$divformulario .= '	<a class="dropdown-item d-flex align-items-center" href="javascript:f_editar_vales('.$row['cod_vale'].')">
													<div class="mr-3">
														<div class="icon-circle bg-primary">
															<i class="fas fa-file-alt text-white"></i>
														</div>
													</div>	
													<div>
														<div class="font-weight-bold">'.$row['cod_vale'].'</div>
														<span class="small text-gray-500">'.$row['vale_date_genera'].' - '.$row['va_ot_id'].' - '.$row['va_asociado'].'</span>
													</div>
												</a>';		
						}
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
			case "form_seleccion_procesar_vales":
				switch($NombreObjeto)
				{
					case "btn_seleccion_procesar_vales":
						$Mostrar_div = '<button type="button" id="btn_cargar_vales" class="btn btn-secondary btn-sm btn_cargar_vales ml-1" >Cargar</button>';
						$Mostrar_div .='<button type="button" title="Ver Vales" id="btn_procesar_ver_vales" class="btn btn-secondary btn-sm btn_procesar_ver_vales ml-1"><i class="bi bi-search"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></i></button>';
						switch($Dato)
						{
							case "vacio":
								$Mostrar_div = "";
							break;

							case "":
							break;

						}
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

			case "contenido":
				switch($NombreObjeto)
				{
					case "div_alertsDropdown_ayuda":
						$man_modulo_id = '';
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta	= $InstanciaAjax->BuscarDataBD("Modulo", "Mod_Nombre", $Dato );
						foreach($Respuesta as $row){
							$man_modulo_id = $row['Modulo_Id'];
						}

						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax	= new CRUD();
						$Respuesta	= $InstanciaAjax->BuscarDataBD("glo_manual", "man_modulo_id", $man_modulo_id );

						usort($Respuesta, function($a, $b) {
                            return $a['man_titulo'] <=> $b['man_titulo'];
                        });
						
						$Mostrar_div = '	<h5 class="dropdown-header">
												AYUDA
											</h5>';
						
						foreach($Respuesta as $row){
							$Mostrar_div .= '	<a class="dropdown-item d-flex align-items-center" href="javascript:f_ayuda_modulo('."'".$row['man_titulo']."'".')">
													<div>
														<div class="font-weight-ligth drop-titulo">'.$row['man_titulo'].'</div>
													</div>
												</a>'; 
						}
					break;

				}
			break;
		}
		echo $Mostrar_div;
    }


}