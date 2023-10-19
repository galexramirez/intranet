<?php
class Accesos
{
	var $Modulo = "componentes";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "nav-tab-componentes":
				$tabshtml = '	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Listado</a>
								<a class="nav-item nav-link" id="nav-historial-tab" data-toggle="tab" href="#nav-historial" role="tab" aria-controls="nav-historial" aria-selected="false">Historial</a>
							';
			break;
		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tabla_componentes":
				MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_editar_componentes');

                $tablahtml = '	<table id="tabla_componentes" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>									
											<th>ID</th>
											<th>SISTEMA</th>
											<th>TIPO COMP.</th>
											<th>COD. COMP.</th>
											<th>ORIGEN</TH>
											<th>NRO. SERIE</th>
											<th>NRO. PARTE</th>
											<th>OBSERVACIONES</th>
											<th>TURNO</th>
											<th>USUARIO</th>
											<th>FECHA</th>';
                if($Respuesta=="SI"){
                    $tablahtml .=          '<th>ACCIONES</th>';
                }
				$tablahtml .=			'</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

			case "tabla_historial_componentes":
                $tablahtml = '	<table id="tabla_historial_componentes" class="table table-striped table-bordered table-condensed w-100">
									<thead class="text-center">
										<tr>
										<th>RUC</th>
										<th>RAZON_SOCIAL</th>
										<th>CONTACTO</th>
										<th>CUENTA_DETRACCION_SOLES</th> 
										<th>CUENTA_BANCARIA_SOLES</th> 
										<th>CUENTA_BANCARIA_DOLARES</th>
										<th>CUENTA_INTERBANCARIA_SOLES</th> 
										<th>CUENTA_INTERBANCARIA_DOLARES</th>
										<th>CONDICION DE PAGO</th>  
										<th>CORREO</th>
										<th>TELEFONO</th>
										<th>ESTADO</th>
										<th>ACCIONES</th>
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
            case "tabla_componentes":
				MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->Permisos($this->Modulo,'btn_editar_componentes');

				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btn_editar_componentes'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "componente_id"},
									{"data": "comp_sistema"},
									{"data": "comp_tipo_componente"},
									{"data": "comp_codigo_patrimonial"},
									{"data": "comp_origen"},
									{"data": "comp_nro_serie"},
									{"data": "comp_nro_parte"},
									{"data": "comp_observaciones"},
									{"data": "comp_turno"},
									{"data": "comp_nombres_usuario"},
									{"data": "comp_fecha"}';
				if($Respuesta=="SI"){
                    $columnashtml.= ' ,{"defaultContent": "'.$defaultContent1.'"}';
                }                
				$columnashtml .= ']';
			break;

			case "tabla_historial_componentes":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarProveedores'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "prov_ruc"},
									{"data": "prov_razonsocial"},
									{"data": "prov_contacto"},
									{"data": "prov_cta_detraccion_soles"},
									{"data": "prov_cta_banco_soles"},
									{"data": "prov_cta_banco_dolares"},
									{"data": "prov_cta_interbanco_soles"},
									{"data": "prov_cta_interbanco_dolares"},
									{"data": "prov_condicion_pago"},
									{"data": "prov_correo"},
									{"data": "prov_telefono"},
									{"data": "prov_estado"},
									{"defaultContent": " '.$defaultContent1.' "}
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
			case "":
				switch($NombreObjeto)
				{
					case "":
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