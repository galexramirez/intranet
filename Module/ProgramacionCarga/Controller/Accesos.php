<?php
class Accesos
{
	var $Modulo="ProgramacionCarga";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-ProgramacionCarga":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Carga</a>
	    						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Publicación</a>
	    						<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Detalle</a>
								<a class="nav-item nav-link" id="nav-pdf-tab" data-toggle="tab" href="#nav-pdf" role="tab" aria-controls="nav-pdf" aria-selected="false">PDFs</a>
								<a class="nav-item nav-link" id="nav-descargapdf-tab" data-toggle="tab" href="#nav-descargapdf" role="tab" aria-controls="nav-descargapdf" aria-selected="false">Descarga PDFs</a>';
			break;
		}
		echo $tabshtml;
	}
	 
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tablaProgramacionCarga":
                $tablahtml = '	<table id="tablaProgramacionCarga" class="table table-striped table-bordered table-condensed w-100"  >
									<thead class="text-center">
				   						<tr>
					   						<th>ID_CARGA</th>
											<th>FECHA_PROGRAMADA</th>
											<th>FECHA_CARGA</th>
											<th>TIPO_OPERACION</th>
											<th>USUARIO_QUE_CARGA</th>
											<th>ACCIONES</th> 
										</tr>
									</thead>
									<tbody>                           
									</tbody>
		   						</table>';
            break;

            case "tablaPublicacionCarga":
                $tablahtml = '	<table id="tablaPublicacionCarga" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
					   					<tr>
							  				<th>ID</th>
											<th>SEMANA_PUBLICADA</th>
											<th>FECHA_GENERAR</th>
											<th>USUARIO_QUE_GENERA</th>
											<th>FECHA_PUBLICAR</th>
											<th>UUSUARIO_QUE_PUBLICA</th>
											<th>FECHA_ELIMINAR</th>
											<th>USUARIO_QUE_ELIMINA</th>
											<th>ESTADO</th>
						   					<th>ACCIONES</th> 
					   					</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>	';
            break;

			case "tablaDetalleProgramacion":
				$tablahtml = '	<table id="tablaDetalleProgramacion" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>CODIGO</th>
					 						<th>APELLIDOS_Y_NOMBRES</th>
					 						<th>DIA</th>
					 						<th>FECHA</th>
					 						<th>TABLA</th>
					 						<th>HORA_ORIGEN</th>
					 						<th>HORA_DESTINO</th>
					 						<th>SERVICIO</th>
					 						<th>BUS</th>
					 						<th>ORIGEN</th>
					 						<th>DESTINO</th>
					 						<th>EVENTO</th>
					 						<th>OBSERVACIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
			break;

			case "tablaPDF":
				$tablahtml = '	<table id="tablaPDF" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
					   					<tr>
						  					<th>ID</th>
											<th>SEMANA_PUBLICADA</th>
											<th>FECHA_PUBLICAR</th>
											<th>USUARIO_QUE_PUBLICA</th>
											<th>ESTADO</th>
											<th>ACCIONES</th> 
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
			break;

			case "tablaDescargaPdf":
				$tablahtml = '	<table id="tablaDescargaPdf" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
											<th>ID</th>
				 							<th>DNI</th>   
				 							<th>APELLIDOS_Y_NOMBRES</th>
				 							<th>FECHA</th>
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
            case "tablaProgramacionCarga":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btnBorrarProgramacionCarga'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "PrgRg_Id"},
									{"data": "PrgRg_FechaProgramado"},
									{"data": "PrgRg_FechaCargada"},
									{"data": "PrgRg_Operacion"},
									{"data": "PrgRg_UsuarioId"},
									{"defaultContent": "'.$defaultContent1.'"}
				  				]';
			break;

			case "tablaPublicacionCarga":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Publicar' class='btn btn-success btn-sm btnPublicarProgramacion'><i class='bi bi-cloud-download-fill'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-cloud-download-fill' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.5a.5.5 0 0 1 1 0V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0zm-.354 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V11h-1v3.293l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z'/></svg></i></button><button title='PDF' class='btn btn-primary btn-sm btnFilePDF'><i class='bi bi-file-earmark-pdf'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-pdf' viewBox='0 0 16 16'><path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/><path d='M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z'/></svg></i></button><button title='Eliminar' class='btn btn-danger btn-sm btnBorrarPublicacionCarga'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "PubRg_Id"},
                					{"data": "PubRg_SemanaPublicada"},
                					{"data": "PubRg_FechaGenerar"},
                					{"data": "PubRg_UsuarioId_Generar"},
                					{"data": "PubRg_FechaPublicar"},
                					{"data": "PubRg_UsuarioId_Publicar"},
                					{"data": "PubRg_FechaEliminar"},
                					{"data": "PubRg_UsuarioId_Eliminar"},
                					{"data": "PubRg_Estado"},
                					{"defaultContent": "'.$defaultContent1.'"}
      							]';
            break;

			case "tablaDetalleProgramacion":
				$columnashtml = '[	{"data": "Prog_CodigoColaborador"},
									{"data": "Prog_NombreColaborador"},
									{"data": "Dia"},
									{"data": "Prog_Fecha"},
									{"data": "Prog_Tabla"},
									{"data": "Prog_HoraOrigen"},                    
									{"data": "Prog_HoraDestino"},                    
									{"data": "Prog_Servicio"},                    
									{"data": "Prog_Bus"},                    
									{"data": "Prog_LugarOrigen"},
									{"data": "Prog_LugarDestino"},                    
									{"data": "Prog_TipoEvento"},
									{"data": "Prog_Observaciones"}
								]';
			break;

			case "tablaPDF":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnPDF_Individual'><i class='bi bi-file-earmark-pdf'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-pdf' viewBox='0 0 16 16'><path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/><path d='M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "PubRg_Id"},
                    				{"data": "PubRg_SemanaPublicada"},
                    				{"data": "PubRg_FechaPublicar"},
                    				{"data": "PubRg_UsuarioId_Publicar"},
                    				{"data": "PubRg_Estado"},
                    				{"defaultContent": "'.$defaultContent1.'"}
                  				]';
			break;

			case "tablaDescargaPdf":
				$columnashtml = '[	{"data": "RgDes_Id"},
                    				{"data": "RgDes_UsuarioId"},
                    				{"data": "Usua_Nombres"},
                    				{"data": "RgDes_FechaDescarga"}
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
			case "formSeleccionProgramacionCarga":
				switch($NombreObjeto)
				{
					case "btn-ProgramacionCarga":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax = new CRUD();
						$Respuesta = $InstanciaAjax->Permisos($this->Modulo,"btnNuevoProgramacionCarga");
						$botonesformulario = '<button type="button" id="btnBuscarProgramacion"class="btn btn-secondary btn-sm mr-1"> Buscar </button>';
						if($Respuesta=="SI"){
							$botonesformulario .= '<button id="btnNuevoProgramacionCarga" type="button" class="btn btn-secondary btn-sm mr-1" >+ Nuevo</button>';
						}
						
					break;
				}
			break;

			case "formSeleccionPublicacionCarga":
				switch($NombreObjeto)
				{
					case "btn-PublicacionCarga":
						MModel($this->Modulo, 'CRUD');
						$InstanciaAjax = new CRUD();
						$Respuesta = $InstanciaAjax->Permisos($this->Modulo,"btnNuevoPublicacionCarga");
						$botonesformulario = '<button type="button" id="btnBuscarPublicaciones" class="btn btn-secondary btn-sm mr-1">Buscar</button>';
						if($Respuesta=="SI"){
							$botonesformulario .= '<button type="button" id="btnNuevoPublicacionCarga" class="btn btn-secondary btn-sm mr-1">+ Nuevo</button>';
						}
						
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
		$color = "";
		switch($NombreFormulario)
		{
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
								$Mostrar_div = "";
							break;
						}
					break;

				}
			break;
		}
		echo $Mostrar_div;
    }


}