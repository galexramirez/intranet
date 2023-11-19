<?php
session_start();
class Logico
{
	var $Modulo="AjusteGenerales";
	// 1.0 CARGA DATOS DE BUSQUEDA DE PILOTO
	function Contenido($NombreDeModuloVista)    
	{		
		MView('AjusteGenerales','LocalView',compact('NombreDeModuloVista') );
	}

	public function SelectObjeto($cacces_nombremodulo)
	{

		$TablaBD = "Modulo";
        $CampoBD = "Mod_Nombre";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cacces_nombremodulo);
		
        foreach($Respuesta as $row){
			$cacces_moduloid = $row['Modulo_Id'];
		}

		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->SelectObjeto($cacces_moduloid);
	
		$html = '<option value="">Seleccione una opcion</option>';
		foreach ($Respuesta as $row) {
			$html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
		}
		echo $html;
	}

	public function SelectTipos($Prog_Operacion, $Ttabla_Tipo)
	{
			//Ejecuta Modelo
			MModel($this->Modulo, 'CRUD');
			$InstanciaAjax= new CRUD();
			$Respuesta=$InstanciaAjax->SelectTipos($Prog_Operacion, $Ttabla_Tipo);
	
			$html = '<option value="">Seleccione una opcion</option>';
			foreach ($Respuesta as $row) {
				$html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
			}
			echo $html;
	}

	public function SelectTiposUsuario($ttablausuario_operacion, $ttablausuario_tipo)
	{

		MModel($this->Modulo, 'CRUD');
		$InstanciaAjax = new CRUD();
		$Respuesta = $InstanciaAjax->SelectTiposUsuario($ttablausuario_operacion, $ttablausuario_tipo);

		$html = '<option value="">Seleccione una opcion</option>';
		foreach ($Respuesta as $row) {
			$html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
		}
		echo $html;
	}

	public function selectColaborador()
	{
			//Ejecuta Modelo
			MModel($this->Modulo, 'CRUD');
			$InstanciaAjax= new CRUD();
			$Respuesta=$InstanciaAjax->selectColaborador();
	
			$html = '<option value="">Seleccione una opcion</option>';
			foreach ($Respuesta as $row) {
				$html .= '<option value="'.$row['Colaborador'].'">'.$row['Colaborador'].'</option>';
			}
			echo $html;
	}

	public function buscarDNI($roles_apellidosnombres)
	{
			//Ejecuta Modelo
			MModel($this->Modulo, 'CRUD');
			$InstanciaAjax= new CRUD();
			$Respuesta=$InstanciaAjax->buscarDNI($roles_apellidosnombres);
	
			$html = '';
			foreach ($Respuesta as $row) {
				$html = $row['DNI'];
			}
			echo $html;
	}

	public function buscarNombreCorto($roles_dni)
		{
			//Ejecuta Modelo
			MModel($this->Modulo, 'CRUD');
			$InstanciaAjax= new CRUD();
			$Respuesta=$InstanciaAjax->buscarNombreCorto($roles_dni);
	
			$html = '';
			foreach ($Respuesta as $row) {
				$html = $row['NombreCorto'];
			}
			echo $html;
		}

	public function SelectUsuario()
		{
			//Ejecuta Modelo
			MModel($this->Modulo,'CRUD');
			$InstanciaAjax= new CRUD();
			$Respuesta=$InstanciaAjax->SelectUsuario();

			$html = '<option value="">Seleccione una opcion</option>';
			//$html = "";
			foreach ($Respuesta as $row)
			{
				$html .= '<option value="'.$row['Usuario'].'">'.$row['Usuario'].'</option>';
			}
			echo $html;	
		}

	public function SelectModulo()
	{
		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->SelectModulo();
		$html = '<option value="">Seleccione una opcion</option>';
		foreach ($Respuesta as $row)
		{
			$html .= '<option value="'.$row['Modulo'].'">'.$row['Modulo'].'</option>';
		}
		echo $html;	
	}

	public function SelectModuloControlAccesos()
	{
		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->SelectModuloControlAccesos();
		$html = '<option value="">Seleccione una opcion</option>';
		foreach ($Respuesta as $row)
		{
			$html .= '<option value="'.$row['Modulo'].'">'.$row['Modulo'].'</option>';
		}
		echo $html;	
	}

	public function ValidarPermisos($PER_UsuarioId,$PER_ModuloId)
	{
		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->ValidarPermisos($PER_UsuarioId,$PER_ModuloId);
		$validar = "";
		if($Respuesta==false){
			$validar = "NO";
		}else{
			$validar = "SI";
		}
		echo $validar;	
	}

	public function CrearControlAccesos($controlaccesos_id, $cacces_perfil, $cacces_nombremodulo, $cacces_nombreobjeto, $cacces_acceso)
	{
		$TablaBD = "Modulo";
        $CampoBD = "Mod_Nombre";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cacces_nombremodulo);
		
		foreach ($Respuesta as $row)
		{
			$cacces_moduloid = $row['Modulo_Id'];
		}

		$TablaBD = "glo_objetos";
        $CampoBD = "obj_nombre";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax = new CRUD();
        $Respuesta = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cacces_nombreobjeto);
		
		foreach ($Respuesta as $row)
		{
			$cacces_objetosid = $row['objetos_id'];
		}

		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->CrearControlAccesos($cacces_perfil, $cacces_moduloid, $cacces_objetosid, $cacces_acceso);

	}

	public function EditarControlAccesos($controlaccesos_id, $cacces_perfil, $cacces_nombremodulo, $cacces_nombreobjeto, $cacces_acceso)
	{

		$TablaBD = "Modulo";
        $CampoBD = "Mod_Nombre";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cacces_nombremodulo);
		
		foreach ($Respuesta as $row)
		{
			$cacces_moduloid = $row['Modulo_Id'];
		}

		$TablaBD = "glo_objetos";
        $CampoBD = "obj_nombre";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cacces_nombreobjeto);
		
		foreach ($Respuesta as $row)
		{
			$cacces_objetosid = $row['objetos_id'];
		}

		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->EditarControlAccesos($controlaccesos_id, $cacces_perfil, $cacces_moduloid, $cacces_objetosid, $cacces_acceso);

	}

	public function ValidarObjetos($obj_nombremodulo, $obj_nombreobjeto)
	{
		$TablaBD = "Modulo";
        $CampoBD = "Mod_Nombre";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$obj_nombremodulo);
		
		foreach ($Respuesta as $row)
		{
			$obj_moduloid = $row['Modulo_Id'];
		}

		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->ValidarObjetos($obj_moduloid, $obj_nombreobjeto);
		$validar = "";
		if($Respuesta==false){
			$validar = "NO";
		}else{
			$validar = "SI";
		}
		echo $validar;	
	}

	public function ValidarControlAccesos($cacces_perfil, $cacces_nombremodulo, $cacces_nombreobjeto)
	{
		$TablaBD = "Modulo";
        $CampoBD = "Mod_Nombre";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cacces_nombremodulo);
		
		foreach ($Respuesta as $row)
		{
			$cacces_moduloid = $row['Modulo_Id'];
		}

		$TablaBD = "glo_objetos";
        $CampoBD = "obj_nombre";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cacces_nombreobjeto);
		
		foreach ($Respuesta as $row)
		{
			$cacces_objetosid = $row['objetos_id'];
		}

		MModel($this->Modulo,'CRUD');
		$InstanciaAjax= new CRUD();
		$Respuesta=$InstanciaAjax->ValidarControlAccesos($cacces_perfil, $cacces_moduloid, $cacces_objetosid);
		$validar = "";
		if($Respuesta==false){
			$validar = "NO";
		}else{
			$validar = "SI";
		}
		echo $validar;	
	}

	public function CrearCargarTipoCambio($tipocambio_url, $tipocambio_fechainicio, $tipocambio_fechafin, $tipocambio_moneda)
	{
		// SE CONSEGUI LA DATA DEL URL DEL BCR TIPO DE CAMBIO INTERBANCARIO EN UN PERIODO DE TIEMPO
		$str_data = file_get_contents($tipocambio_url.$tipocambio_fechainicio."/".$tipocambio_fechafin);
		// SE FORMATEA LA DATA DEL BCR PARA QUE PUEDA SER DECODIFICADA COMO ARCHIVO JSON
		$inicio = stripos($str_data,'periods',0)+9;
		$largo = strlen($str_data);
		$data1 = substr($str_data,$inicio,$largo);
		$fin = strrpos($data1,'}',0);
		$data2 = substr($data1,0,$fin);
		$json_data = json_decode($data2,true);
		$inicio = "0";
		$tipocambio_valor = 0;
		foreach ($json_data as $row){
			switch (substr($row['name'],3,3)){
				case "Ene":
					$mes = "01";
				break;
				case "Feb":
					$mes = "02";
				break;
				case "Mar":
					$mes = "03";
				break;
				case "Abr":
					$mes = "04";
				break;
				case "May":
					$mes = "05";
				break;
				case "Jun":
					$mes = "06";
				break;
				case "Jul":
					$mes = "07";
				break;
				case "Ago":
					$mes = "08";
				break;
				case "Set":
					$mes = "09";
				break;
				case "Oct":
					$mes = "10";
				break;
				case "Nov":
					$mes = "11";
				break;
				case "Dic":
					$mes = "12";
				break;
			}
			$tipocambio_fecha = "20".substr($row['name'],-2)."-".$mes."-".substr($row['name'],0,2);
			if($inicio == "0"){
				$fecha_mas1dia = $tipocambio_fecha;
				$inicio = "1";
			}
			if($tipocambio_fecha != $fecha_mas1dia){
				while($tipocambio_fecha != $fecha_mas1dia){
					$tipocambio_tipo = "COMPRA";
					MModel($this->Modulo,'CRUD');
					$InstanciaAjax= new CRUD();
					$Respuesta=$InstanciaAjax->CrearTipoCambio($fecha_mas1dia, $tipocambio_moneda, $tipocambio_tipo, $tipocambio_valorcompra);
					$tipocambio_tipo = "VENTA";
					MModel($this->Modulo,'CRUD');
					$InstanciaAjax= new CRUD();
					$Respuesta=$InstanciaAjax->CrearTipoCambio($fecha_mas1dia, $tipocambio_moneda, $tipocambio_tipo, $tipocambio_valorventa);
					$fecha_mas1dia = date("Y-m-d",strtotime("+1 days",strtotime($fecha_mas1dia)));	
				}
			}
			if($tipocambio_fecha == $fecha_mas1dia){
				$tipocambio_tipo = "COMPRA";
				$tipocambio_valor = round($row['values'][0],4);
				$tipocambio_valorcompra = $tipocambio_valor; 
				MModel($this->Modulo,'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->CrearTipoCambio($tipocambio_fecha, $tipocambio_moneda, $tipocambio_tipo, $tipocambio_valor);
				$tipocambio_tipo = "VENTA";
				$tipocambio_valor = round($row['values'][1],4);
				$tipocambio_valorventa = $tipocambio_valor; 
				MModel($this->Modulo,'CRUD');
				$InstanciaAjax= new CRUD();
				$Respuesta=$InstanciaAjax->CrearTipoCambio($tipocambio_fecha, $tipocambio_moneda, $tipocambio_tipo, $tipocambio_valor);
				$fecha_mas1dia = date("Y-m-d",strtotime("+1 days",strtotime($tipocambio_fecha)));
			}
			
		}

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

}