<?php
class Accesos
{
	var $Modulo="Maestro_uno";

	public function CreacionTabs($NombreTabs,$TipoTabs)    
	{		
		$tabshtml = '';
		switch($NombreTabs)
		{
			case "":
				$tabshtml = ' ';
			break;
		}
		echo $tabshtml;
	}
	
    public function CreacionTabla($NombreTabla,$TipoTabla)
    {
		$tablahtml = "";
        switch ($NombreTabla) 
		{
            case "tablaMaestroUno":
                $tablahtml = '	<table id="tablaMaestroUno" class="table table-striped table-bordered table-condensed w-80">
									<thead class="text-center">
										<tr>
											<th>ID</th>
											<th>APELLIDOS Y NOMBRES</th>
											<th>NOMBRE CORTO</th>
											<th>CARGO</th>
											<th>ESTADO</th>
											<th>FECHA INGRESO</th>
											<th>FECHA CESE</th>
											<th>E @ MAIL</th>
											<th>DIRECCION</th>
											<th>DISTRITO</th>
											<th>CODIGO ATU</th>
											<th>FOTO</th>
											<th>ACCIONES</th>
										</tr>
									</thead>
									<tbody>                           
									</tbody>
								</table>';
				//<th>PERFIL</th>
            break;

            case "":
                $tablahtml = ' ';
            break;

        }
		echo $tablahtml;
	}

	public function ColumnasTabla($NombreTabla,$TipoTabla)
	{
		$columnashtml = "";
        switch ($NombreTabla) 
		{
            case "tablaMaestroUno":
				$defaultContent = "<div class='text-center'><div class='btn-group'><button title='Editar' class='btn btn-primary btn-sm btnEditar'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button tittle='Borrar' class='btn btn-danger btn-sm btnBorrar'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>";
				$columnashtml = '[	{"data": "Colaborador_id"},
									{"data": "Colab_ApellidosNombres"},
									{"data": "Colab_nombre_corto"},
									{"data": "Colab_CargoActual"},
									{"data": "Colab_Estado"},
									{"data": "Colab_FechaIngreso"},
									{"data": "Colab_FechaCese"},
									{"data": "Colab_Email"},									
									{"data": "Colab_Direccion"},
									{"data": "Colab_Distrito"},
									{"data": "Colab_CodigoCortoPT"},
									{"data": "Colab_Foto"},
									{"defaultContent": " '.$defaultContent.' "}
								]';
				//{"data": "Colab_PerfilEvaluacion"},
			break;

            case "":
				$columnashtml = ' ';	
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