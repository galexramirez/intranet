<?php
class Logico
{
	var $Modulo = "informativos";
	// 1.0 CARGA DATOS DE BUSQUEDA DE PILOTO
	function Contenido($NombreDeModuloVista)    
	{		
		MView($this->Modulo,'local_view',compact('NombreDeModuloVista') );
	}

	public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

	public function buscar_dato($nombre_tabla, $campo_buscar, $condicion_where)
	{
		$rpta_buscar_dato = "";
        MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->buscar_dato($nombre_tabla, $campo_buscar, $condicion_where);

        foreach ($Respuesta as $row) {
			$rpta_buscar_dato = $row[$campo_buscar];
		}
		echo $rpta_buscar_dato;
	}

	public function Delete($comunicado_id, $comu_archivo)
    {
		$rpta_delete = True;
		$file_imagen = $_SERVER['DOCUMENT_ROOT']."/Services/image/comunicados/".$comu_archivo;
		if(unlink($file_imagen)){
			MModel($this->Modulo,'CRUD');
			$InstanciaAjax  = new CRUD();
			$Respuesta = $InstanciaAjax->Delete($comunicado_id);
	
			print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);	
		}else{
			$rpta_delete = False;
		}
		return $rpta_delete;
    }

	public function Create($comunicado_id, $comu_titulo, $comu_fecha_inicio, $comu_fecha_fin, $comu_proceso, $comu_destacado, $nombre_imagen, $comu_archivo)
	{
		$comu_estado = "ACTIVO";
		$imagen_nueva = $_SERVER['DOCUMENT_ROOT']."/Services/image/comunicados/".$nombre_imagen;
		if(move_uploaded_file($comu_archivo, $imagen_nueva)){
			MModel($this->Modulo,'CRUD');
        	$InstanciaAjax  = new CRUD();
        	$Respuesta = $InstanciaAjax->Create($comu_titulo, $comu_fecha_inicio, $comu_fecha_fin, $comu_proceso, $comu_destacado, $nombre_imagen, $comu_estado);
			print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
		}else{
			echo "err1";
		}

		

		

	}

}