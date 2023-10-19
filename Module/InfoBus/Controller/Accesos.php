<?php
class Accesos
{
	var $Modulo="InfoBus";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "":
				$tabshtml = '';
			break;
		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tablaInfoBus":
                $tablahtml = '	<table id="tablaInfoBus" class="table table-striped table-bordered table-condensed ">
									<thead class="text-center">
										<tr>
											<th>VER OT</th>	
											<th>NRO_OT</th>
											<th>ESTADO</th>
											<th>BUS</th>
											<th>F_APERTURA F_PROGRAMADA</th>
											<th>RESP_APERTURA RESP_PROGRAMADA</th>
											<th>ORIGEN O FRECUENCIA</th>
											<th>ASOCIADO</th>
											<th>TECNICO RESPONSABLE</th>
											<th>DESCRIPCION_ACTIVIDAD_PROGRAMADA</th>
											<th>SISTEMA</th>
											<th>FECHA CIERRE_TECNICO</th>
											<th>RESPOSABLE CIERRE_TECNICO</th>
											<th>FECHA CIERRE ADM.</th>
											<th>RESPONSABLE CIERRE ADM.</th>
											<th>KILOMETRAJE</th>
											<th>VER VALES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
            break;

            case "":
                $tablahtml = '';
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
            case "tablaInfoBus":
				$defaultContent1 = "<div class='text-center'><div class='btn-group'><button title='Ver' class='btn btn-sm btnVerOTs'><i class='bi bi-search'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'><path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"defaultContent": "'.$defaultContent1.'"},
                    				{"data": "ib_nro_ot"},
									{"data": "ib_estado"},                    
									{"data": "ib_bus"},
                    				{"data": "ib_fecha_genera"},  
                    				{"data": "ib_cgm_genera"},                    
                    				{"data": "ib_orig_frec"},                    
                    				{"data": "ib_asociado"},
                    				{"data": "ib_tecn_resp"},                    
                    				{"data": "ib_desc_acti"},
									{"data": "ib_sistema"},
                    				{"data": "ib_fecha_cierre_tecnico"},
                    				{"data": "ib_cgm_cierre_tecnico"},
                    				{"data": "ib_fecha_cierre_adm"},
                    				{"data": "ib_resp_cierre_adm"},
                    				{"data": "ib_km"},
                    				{"data": "ib_cant_vales"}
                    			]';
			break;

            case "":
				$columnashtml = '';
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
						$botonesformulario = '';
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