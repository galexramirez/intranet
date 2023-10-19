<?php
session_start();
class Logico
{
	var $Modulo = "Pedidos";

	function Contenido($NombreDeModuloVista) {		
		MView('Pedidos','local_view',compact('NombreDeModuloVista') );
	}

    public function SelectTipos($ttablapedidos_operacion, $ttablapedidos_tipo)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->SelectTipos($ttablapedidos_operacion, $ttablapedidos_tipo);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Detalle'].'">'.$row['Detalle'].'</option>';
        }
        echo $html;
    }

    public function select_roles($roles_perfil)
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->select_roles($roles_perfil);

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['nombre_corto'].'">'.$row['nombre_corto'].'</option>';
        }
        echo $html;
    }

    public function CalculoFecha($inicio,$calculo)
    {
        $rptaFecha = "";
        switch ($inicio)
        {
            case "hoy":
                if($calculo=="0"){
                    $rptaFecha = date("Y-m-d");
                }
                if(strlen($calculo)>0 && $calculo!="0"){
                    if($calculo=="hora"){
                        $rptaFecha = date("Y-m-d H:i:s");
                    }else{
                        $f = strtotime($calculo);
                        $rptaFecha = date("Y-m-d",$f);
                    }
                }
            break;
            
            //default: ;
        }
        echo $rptaFecha;
    }

    public function DiferenciaFecha($inicio,$final)
    {
        $rpta_Diferencia = "NO";
        $firstDate  = new DateTime($inicio);
        $secondDate = new DateTime($final);
        $intvl = $firstDate->diff($secondDate);
        
        if($intvl->days < "366"){
            $rpta_Diferencia = "SI";
        }
        echo $rpta_Diferencia;
    }

    public function auto_completar_tipo($nombre_tabla, $nombre_campo, $nombre_tipo)
    {
        $rpta_autocompletar = [];

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->auto_completar_tipo($nombre_tabla, $nombre_campo, $nombre_tipo);
        foreach ($Respuesta as $row) {
            if($nombre_campo=="material_id"){
                $rpta_autocompletar[] = ["value" => $row['material_id'], "label" => "<strong>".$row['material_id']."</strong> ".$row['material_descripcion']];
            }else{
                $rpta_autocompletar[] = ["value" => $row['material_descripcion'], "label" => " <strong>".$row['material_id']."</strong>".$row['material_descripcion']];
            }
        }
		echo json_encode($rpta_autocompletar);
    }

    function DocumentRoot()
    {
        $miCarpeta = '';
        $miHost = $_SERVER['HTTP_HOST'];
        $miReferer = $_SERVER['HTTP_REFERER'];
        $miCarpeta = substr($miReferer,0,strpos($miReferer,$miHost)).$miHost.'/';
        echo $miCarpeta;
    }

    public function BuscarDataBD($TablaBD,$CampoBD,$DataBuscar)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$DataBuscar);

        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function select_proveedor()
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->select_proveedor();

        $html = '<option value="">Seleccione una opcion</option>';

        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['prov_razonsocial'].'">'.$row['prov_razonsocial'].'</option>';
        }
        echo $html;
    }

    public function buses_pedido()
    {
        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->buses_pedido();

        $html = '<option value="">Bus</option>';
        foreach ($Respuesta as $row) {
            $html .= '<option value="'.$row['Buses'].'">'.$row['Buses'].'</option>';
        }
        echo $html;
    }

    public function generar_pedido($pedido_id, $pedi_fechacreacion, $pedi_fecharequerimiento, $pedi_prioridad, $pedi_centrocosto, $pedi_proceso, $pedi_nombre_contacto, $pedi_direccion_entrega, $pedi_orden_compra_directa, $pedi_tipo, $pedi_estado, $pedi_log, $obs_log, $array_data)
	{
        $pedi_estado        = "PENDIENTE DE APROBACION";
        $pedi_fecha         = date("d-m-Y H:i:s");
        $pedi_log           = "";
        $mp_pedidoid        = "";

        $TablaBD            = "glo_roles";
        $CampoBD            = "roles_dni";
        $pedi_responsable   = $_SESSION['USUARIO_ID'];

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$pedi_responsable);
        foreach ($Respuesta as $row) {
            $nombre_usuario = $row['roles_nombrecorto'];
        }
        $pedi_log = "<strong>".$pedi_estado."</strong> ".$pedi_fecha." ".$nombre_usuario." CREACIÓN: ".$obs_log;	

        $TablaBD            = "glo_roles";
        $CampoBD            = "roles_nombrecorto";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$pedi_nombre_contacto);
        foreach ($Respuesta as $row) {
            $pedi_contacto_id = $row['roles_dni'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->generar_pedido($pedido_id, $pedi_fechacreacion, $pedi_fecharequerimiento, $pedi_prioridad, $pedi_centrocosto, $pedi_proceso, $pedi_contacto_id, $pedi_direccion_entrega, $pedi_orden_compra_directa, $pedi_tipo, $pedi_responsable, $pedi_estado, $pedi_log);

        foreach ($Respuesta as $row) {
            $mp_pedidoid = $row['pedido_id'];
        }

        if(count($array_data)>0){
            foreach ($array_data as $row){
                $mp_materialid      = $row['mp_materialid'];
                $mp_unidadmedida    = substr($row['mp_unidadmedida'],0,strpos($row['mp_unidadmedida'],'-')-1);
                $mp_cantidad        = $row['mp_cantidad'];
                $mp_bus             = $row['mp_bus'];
                $mp_observaciones   = strtoupper($row['mp_observaciones']);
                
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->crear_material_pedido($mp_pedidoid, $mp_materialid, $mp_unidadmedida, $mp_cantidad, $mp_bus, $mp_observaciones);
            }
        }

    }

    public function editar_pedido($pedido_id, $pedi_fechacreacion, $pedi_fecharequerimiento, $pedi_prioridad, $pedi_centrocosto, $pedi_proceso, $pedi_nombre_contacto, $pedi_direccion_entrega, $pedi_orden_compra_directa, $pedi_tipo, $pedi_estado, $pedi_log, $obs_log, $array_data)
	{
        $pedi_fecha = date("d-m-Y H:i:s");
        $pedi_log1 = "";
        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";
        $pedi_responsable = $_SESSION['USUARIO_ID'];
        $mp_pedidoid = $pedido_id;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$pedi_responsable);
        foreach ($Respuesta as $row) {
            $nombre_usuario = $row['roles_nombrecorto'];
        }
        $pedi_log1 = "<strong>".$pedi_estado."</strong> ".$pedi_fecha." ".$nombre_usuario." EDICIÓN: ".$obs_log."<br>".$pedi_log;	

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->editar_pedido($pedido_id, $pedi_fechacreacion, $pedi_fecharequerimiento, $pedi_prioridad, $pedi_bus, $pedi_centrocosto, $pedi_ordcompdirecta, $pedi_log1, $pedi_estado);

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->eliminar_material_pedido($mp_pedidoid);

        if(count($array_data)>0){
            foreach ($array_data as $row){
                $mp_materialid = $row['mp_materialid'];
                $mp_unidadmedida = $row['mp_unidadmedida'];
                $mp_cantidad = $row['mp_cantidad'];
                $mp_observaciones = strtoupper($row['mp_observaciones']);
                
                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->crear_material_pedido($mp_pedidoid, $mp_materialid, $mp_unidadmedida, $mp_cantidad, $mp_observaciones);
            }
        }

    }

    public function estado_pedido($pedido_id, $pedi_estado, $pedi_log, $obs_log, $pedi_estado_obs)
	{
        $pedi_fecha = date("d-m-Y H:i:s");
        $pedi_log1 = "";
        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";
        $pedi_responsable = $_SESSION['USUARIO_ID'];
        $mp_pedidoid = $pedido_id;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$pedi_responsable);
        foreach ($Respuesta as $row) {
            $nombre_usuario = $row['roles_nombrecorto'];
        }
        $pedi_log1 = "<strong>".$pedi_estado."</strong> ".$pedi_fecha." ".$nombre_usuario." EDICIÓN: ".$obs_log."<br>".$pedi_log;	

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->estado_pedido($pedido_id, $pedi_estado, $pedi_log1, $pedi_estado_obs);
    }

    public function buscar_material_id($mp_materialid)
    {
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $Respuesta      = $InstanciaAjax->buscar_material_id($mp_materialid);
        print json_encode($Respuesta, JSON_UNESCAPED_UNICODE);
    }

    public function buscar_material_descripcion($mp_descripcion)
    {
        $a_data = [];
        $TablaBD = "manto_materiales";
        $CampoBD = "material_descripcion";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$mp_descripcion);
        foreach ($Respuesta as $row) {
            $a_data[] = ["material_id" => $row['material_id']];
        }

        echo json_encode($a_data);
    }

    public function guardar_cotizacion($coti_pedidoid, $coti_fecha, $coti_razonsocial)
	{
        $coti_estado        = "PENDIENTE";
        $coti_fecharegistro = date("d-m-Y H:i:s");
        $coti_log           = "";
        $mc_cotizacionid    = "";
        $TablaBD            = "glo_roles";
        $CampoBD            = "roles_dni";
        $coti_responsable   = $_SESSION['USUARIO_ID'];

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$coti_responsable);
        foreach ($Respuesta as $row) {
            $nombre_usuario = $row['roles_nombrecorto'];
        }
        $coti_log = "<strong>".$coti_estado."</strong> ".$coti_fecharegistro." ".$nombre_usuario." CREACIÓN ";	

        $TablaBD = "manto_proveedores";
        $CampoBD = "prov_razonsocial";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$coti_razonsocial);
        foreach ($Respuesta as $row) {
            $coti_ruc = $row['prov_ruc'];
        }

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->guardar_cotizacion($coti_pedidoid, $coti_fecha, $coti_ruc, $coti_razonsocial, $coti_responsable, $coti_estado, $coti_log);

        foreach ($Respuesta as $row) {
            $mc_cotizacionid = $row['cotizacion_id'];
        }

        $TablaBD = "manto_materialespedidos";
        $CampoBD = "mp_pedidoid";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$coti_pedidoid);
        foreach ($Respuesta as $row) {
            $mc_materialid          = $row['mp_materialid'];
            $mc_unidadmedida        = $row['mp_unidadmedida'];
            $mc_cantidad            = $row['mp_cantidad'];
            $mc_cantidad_cotizacion = "0";
            $mc_cantidad_solicitada = "0";
            $mc_observaciones       = $row['mp_observaciones'];

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta2=$InstanciaAjax->precio_vigente($coti_ruc, $mc_materialid, $coti_fecha);

            $mc_precioprovid    = "0";
            $mc_codproveedor    = "";
            $mc_moneda          = "";
            $mc_precio          = "0";
            $mc_preciosoles     = "0";
            $mc_fechavigencia   = "";

            foreach ($Respuesta2 as $row2){
                $mc_precioprovid    = $row2['precioprov_id'];
                $mc_codproveedor    = $row2['precioprov_codproveedor'];
                $mc_moneda          = $row2['precioprov_moneda'];
                $mc_precio          = $row2['precioprov_precio'];
                $mc_preciosoles     = $row2['precioprov_preciosoles'];
                $mc_fechavigencia   = $row2['precioprov_fechavigencia'];
            }
               
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta3=$InstanciaAjax->crear_material_cotizacion($mc_cotizacionid, $mc_materialid, $mc_unidadmedida, $mc_cantidad, $mc_cantidad_cotizacion, $mc_cantidad_solicitada, $mc_precioprovid, $mc_codproveedor, $mc_moneda, $mc_precio, $mc_preciosoles, $mc_fechavigencia, $mc_observaciones);
        }

        $TablaBD        = "manto_pedidos";
        $CampoBD        = "pedido_id";
        $pedi_log       = "";
        $pedi_log1      = "";
        $pedi_estado    = "EN COTIZACION";
        $pedi_estado_obs= "";
        $obs_log        = "SOLICITAR COTIZACIÓN";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$coti_pedidoid);
        foreach ($Respuesta as $row) {
            $pedi_log = $row['pedi_log'];
        }

        $pedi_log1          = "<strong>".$pedi_estado."</strong> ".$coti_fecharegistro." ".$nombre_usuario." EDICIÓN: ".$obs_log."<br>".$pedi_log;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->estado_pedido($coti_pedidoid, $pedi_estado, $pedi_log1, $pedi_estado_obs);
    }

    public function cotizacion_pdf($cotizacion_id)
    {
        $micarpeta  = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date       = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date       = str_replace(".", "", $date);
        $id_date    = $cotizacion_id."_".$date;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $pdfhead    = $InstanciaAjax->cotizacion_pdf_head($cotizacion_id);
        $filename   = "pdfhead".$cotizacion_id."_".$date;
        $file_json  = $filename.".json";
        $data       = json_encode($pdfhead, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $pdfbody    = $InstanciaAjax->cotizacion_pdf_body($cotizacion_id);
        $filename   = "pdfbody".$cotizacion_id."_".$date;
        $file_json  = $filename.".json";
        $data       = json_encode($pdfbody, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);

        echo $id_date;
    }

    public function editar_cotizacion($cotizacion_id,$array_data)
	{
        $coti_fecha = date("d-m-Y H:i:s");
        $coti_estado = "RECIBIDA";
        $coti_log1 = "";
        $coti_responsable = $_SESSION['USUARIO_ID'];
        $mc_cotizacionid = $cotizacion_id;

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$coti_responsable);
        foreach ($Respuesta as $row) {
            $nombre_usuario = $row['roles_nombrecorto'];
        }

        $TablaBD = "manto_cotizaciones";
        $CampoBD = "cotizacion_id";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cotizacion_id);
        foreach ($Respuesta as $row) {
            $coti_log = $row['coti_log'];
        }

        $coti_log1 = "<strong>".$coti_estado."</strong> ".$coti_fecha." ".$nombre_usuario." EDICIÓN <br>".$coti_log;	

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->editar_cotizacion($cotizacion_id, $coti_log1, $coti_estado);

        if(count($array_data)>0){
            foreach ($array_data as $row){
                $mc_materialid          = $row['mc_materialid'];
                $mc_cantidad_cotizacion = $row['mc_cantidad_cotizacion'];
                $mc_preciocotizacion    = $row['mc_preciocotizacion'];
                
                if($mc_cantidad_cotizacion == ""){ $mc_cantidad_cotizacion="0"; }
                if($mc_preciocotizacion == "") { $mc_preciocotizacion="0"; }

                MModel($this->Modulo, 'CRUD');
                $InstanciaAjax= new CRUD();
                $Respuesta=$InstanciaAjax->editar_material_cotizacion($mc_cotizacionid, $mc_materialid, $mc_preciocotizacion, $mc_cantidad_cotizacion);
            }
        }
    }

    public function atencion_pedido($pedido_id, $array_data)
	{
        $rpta_atencion_pedido = "ATENCION TOTAL";
        $TablaBD = "manto_materialespedidos";
        $CampoBD = "mp_pedidoid";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$pedido_id);

        foreach ($Respuesta as $row) {
            $mp_materialid  = $row['mp_materialid'];
            $mp_cantidad    = $row['mp_cantidad'];
            $tmc_cantidad   = 0;
            foreach($array_data as $row2){
                if($row2["tmc_materialid"]==$mp_materialid && $row2['tmc_seleccion']=="SI"){
                    $tmc_cantidad = $tmc_cantidad + $row2['tmc_cantidad_solicitada'];
                }
            }
            if($mp_cantidad > $tmc_cantidad){
                $rpta_atencion_pedido = "ATENCION PARCIAL";
            }
        }
        echo $rpta_atencion_pedido;
    }

    public function validar_material_solicitado($tmc_materialid, $tmc_cantidad_pedido, $tmc_cantidad_solicitada, $tmc_cantidad_solicitada_anterior, $array_data)
	{
        $rpta_validar_material_solicitado   = "";
        $tmc_total_cantidad_solicitada      = 0;

        foreach($array_data as $row){
            if($row["tmc_materialid"]==$tmc_materialid && $row['tmc_seleccion']=="SI"){
                $tmc_total_cantidad_solicitada = $tmc_total_cantidad_solicitada + $row['tmc_cantidad_solicitada'];
            }
        }

        $tmc_total_cantidad_solicitada = $tmc_total_cantidad_solicitada + $tmc_cantidad_solicitada - $tmc_cantidad_solicitada_anterior;

        if($tmc_total_cantidad_solicitada > $tmc_cantidad_pedido){
            $rpta_validar_material_solicitado = "invalido";
        }

        echo $rpta_validar_material_solicitado;
    }

    public function valida_cerrar_cotizacion($pedi_estado, $coti_estado)
    {
        $rpta_valida_cerrar_cotizacion = "SI";
        switch ($pedi_estado)
        {
            case "CERRADO":
                $rpta_valida_cerrar_cotizacion = "NO";
            break;
            case "CANCELADO":
                $rpta_valida_cerrar_cotizacion = "NO";
            break;
        }
        switch ($coti_estado)
        {
            case "CERRADO":
                $rpta_valida_cerrar_cotizacion = "NO";
            break;
            case "RECIBIDA":
                $rpta_valida_cerrar_cotizacion = "NO";
            break;
        }
        echo $rpta_valida_cerrar_cotizacion;
    }

    public function generar_orden_compra($array_data, $atencion_pedido) 
    {
        $orco_fecha_registro= date("d-m-Y H:i:s");
        $orco_fecha         = date("Y-m-d H:i:s");
        $orco_estado        = "GENERADA";
        $orco_log           = "";
        $orco_responsable   = $_SESSION['USUARIO_ID'];
        $pedi_ordencompraid = "";
        $pedi_estado        = "CERRADO";
        $pedi_estado_obs    = $atencion_pedido;
        $coti_estado        = "CERRADO";
        $pedi_log           = "";
        $pedi_ordencompraid = "1";
        $valor_igv          = "18";

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$orco_responsable);
        foreach ($Respuesta as $row) {
            $nombre_usuario = $row['roles_nombrecorto'];
        }

        $xa_array = [];
        $xa_array = array_unique(array_column($array_data,'tmc_razonsocial'));
        $xb_array = [];
        foreach($xa_array as $row){
            $tmc_razonsocial    = $row;
            $tmc_seleccion      = "NO";
            $tmc_cotizacionid   = "";
            $tmc_subtotal       = 0;
            $tmc_igv            = 0;
            $tmc_total          = 0;
            foreach($array_data as $row2){
                if($row2['tmc_razonsocial']==$tmc_razonsocial && $row2['tmc_seleccion']=="SI"){
                    $tmc_seleccion      = $row2['tmc_seleccion'];
                    $tmc_pedidoid       = $row2['tmc_pedidoid'];
                    $tmc_cotizacionid   = $row2['tmc_cotizacionid'];
                    $tmc_subtotal       = $tmc_subtotal + round( (floatval($row2['tmc_preciocotizacion']) * floatval($row2['tmc_cantidad'])), 2) ;
                }
            }
            $tmc_igv    = $tmc_subtotal * round( (floatval($valor_igv)/100), 2);
            $tmc_total  = $tmc_subtotal + $tmc_igv;
            if($tmc_seleccion=="SI"){
                $xb_array[] = [ "tmc_razonsocial"=>$tmc_razonsocial, "tmc_seleccion"=>$tmc_seleccion, "tmc_pedidoid"=>$tmc_pedidoid, "tmc_cotizacionid"=>$tmc_cotizacionid, "tmc_subtotal"=>$tmc_subtotal, "tmc_igv"=>$tmc_igv, "tmc_total"=>$tmc_total ];
            }
        }
     
        foreach($xb_array as $row){
            $orco_pedidoid      = $row['tmc_pedidoid'];
            $orco_cotizacionid  = $row['tmc_cotizacionid'];
            $orco_subtotal      = $row['tmc_subtotal'];
            $orco_igv           = $row['tmc_igv'];
            $orco_total         = $row['tmc_total'];
            
            $TablaBD = "manto_cotizaciones";
            $CampoBD = "cotizacion_id";
            MModel($this->Modulo,'CRUD');
            $InstanciaAjax= new CRUD();
            $Respuesta1=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$orco_cotizacionid);
            foreach ($Respuesta1 as $row1) {
                $orco_ruc           = $row1['coti_ruc'];
                $orco_razonsocial   = $row1['coti_razonsocial'];
                $coti_log           = $row1['coti_log'];
            }
            
            $coti_log1 = "<strong>".$coti_estado."</strong> ".$orco_fecha_registro." ".$nombre_usuario." EDICIÓN <br>".$coti_log;	

            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta      = $InstanciaAjax->editar_cotizacion($orco_cotizacionid, $coti_log1, $coti_estado);
            
            $orco_log = "<strong>".$orco_estado."</strong> ".$orco_fecha_registro." ".$nombre_usuario." CREACION ";
            
            MModel($this->Modulo, 'CRUD');
            $InstanciaAjax  = new CRUD();
            $Respuesta2     = $InstanciaAjax->generar_orden_compra($orco_fecha, $orco_pedidoid, $orco_cotizacionid, $orco_ruc, $orco_razonsocial, $orco_subtotal, $orco_igv, $orco_total, $orco_responsable, $orco_estado, $orco_log);
            
            foreach ($Respuesta2 as $row2) {
                $ordencompra_id = $row2['ordencompra_id'];
            }
    
            foreach($array_data as $row3){
                if($row3['tmc_razonsocial']==$orco_razonsocial && $row3['tmc_seleccion']=="SI"){
                    $moc_orden_compra_id    = $ordencompra_id;
                    $moc_cotizacion_id      = $orco_cotizacionid;
                    $moc_pedido_id          = $orco_pedidoid;
                    $moc_material_id        = $row3['tmc_materialid'];
                    $moc_unidad_medida      = $row3['tmc_unidadmedida'];
                    $moc_cantidad           = $row3['tmc_cantidad_solicitada'];
                    $moc_moneda             = $row3['tmc_moneda'];
                    $moc_precio_soles       = $row3['tmc_preciocotizacion'];
                    $mc_seleccion           = $row3['tmc_seleccion'];

                    $TablaBD = "manto_materialespedidos";
                    $CampoBD = "mp_pedidoid";
                    MModel($this->Modulo,'CRUD');
                    $InstanciaAjax  = new CRUD();
                    $Respuesta4     = $InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$moc_pedido_id);
                    foreach ($Respuesta4 as $row4) {
                        if($moc_material_id == $row4['mp_materialid']){
                            $moc_observaciones = $row4['mp_observaciones'];
                        }
                    }

                    MModel($this->Modulo,'CRUD');
                    $InstanciaAjax  = new CRUD();
                    $Respuesta5     = $InstanciaAjax->crear_material_orden_compra($moc_orden_compra_id, $moc_cotizacion_id, $moc_pedido_id, $moc_material_id, $moc_unidad_medida, $moc_cantidad, $moc_moneda, $moc_precio_soles, $moc_observaciones);

                    MModel($this->Modulo,'CRUD');
                    $InstanciaAjax  = new CRUD();
                    $Respuesta6     = $InstanciaAjax->editar_cantidad_solicitada($moc_cotizacion_id, $moc_material_id, $moc_cantidad, $mc_seleccion);
                }

            }
        }

        $TablaBD = "manto_pedidos";
        $CampoBD = "pedido_id";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$orco_pedidoid);
        foreach ($Respuesta as $row) {
            $pedi_log1 = $row['pedi_log'];
        }
        
        $pedi_log = "<strong>".$pedi_estado."</strong> ".$orco_fecha_registro." ".$nombre_usuario." GENERAR ORDEN COMPRA ".$pedi_estado_obs." <br> ".$pedi_log1;

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->editar_pedido_orden_compra($orco_pedidoid, $pedi_ordencompraid, $pedi_estado, $pedi_estado_obs, $pedi_log);
    }

    public function estado_orden_compra($ordencompra_id, $orco_estado, $obs_log)
	{
        $orco_fecha         = date("d-m-Y H:i:s");
        $pedi_log1          = "";
        $orco_responsable   = $_SESSION['USUARIO_ID'];
        $orco_log1          = "";
        $pedi_estado        = "CERRADO";
        $pedi_estado_obs    = "ATENCION PARCIAL";

        $TablaBD            = "glo_roles";
        $CampoBD            = "roles_dni";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$orco_responsable);
        foreach ($Respuesta as $row) {
            $nombre_usuario = $row['roles_nombrecorto'];
        }

        $TablaBD            = "manto_ordencompra";
        $CampoBD            = "ordencompra_id";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$ordencompra_id);
        foreach ($Respuesta as $row) {
            $orco_pedidoid  = $row['orco_pedidoid'];
            $orco_log       = $row['orco_log'];
        }
        $orco_log1 = "<strong>".$orco_estado."</strong> ".$orco_fecha." ".$nombre_usuario." EDICIÓN: ".$obs_log."<br>".$orco_log;	
        
        $TablaBD            = "manto_pedidos";
        $CampoBD            = "pedido_id";
        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$orco_pedidoid);
        foreach ($Respuesta as $row) {
            $pedi_log = $row['pedi_log'];
        }
        $pedi_log1 = "<strong>".$pedi_estado."</strong> ".$orco_fecha." ".$nombre_usuario." EDICIÓN: ".$obs_log."<br>".$pedi_log;	

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->estado_orden_compra($ordencompra_id, $orco_estado, $orco_log1);

        MModel($this->Modulo, 'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->estado_pedido($orco_pedidoid, $pedi_estado, $pedi_log1, $pedi_estado_obs);
    }

    public function orden_compra_pdf($ordencompra_id)
    {
        $micarpeta  = $_SERVER['DOCUMENT_ROOT']."/Services/Json";
        $date       = date('d-m-Y-'.substr((string)microtime(), 1, 8));
        $date       = str_replace(".", "", $date);
        $id_date    = $ordencompra_id."_".$date;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $pdfhead        = $InstanciaAjax->orden_compra_pdf_head($ordencompra_id);
        $filename       = "pdfhead".$ordencompra_id."_".$date;
        $file_json      = $filename.".json";
        $data           = json_encode($pdfhead, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax  = new CRUD();
        $pdfbody        = $InstanciaAjax->orden_compra_pdf_body($ordencompra_id);
        $filename       = "pdfbody".$ordencompra_id."_".$date;
        $file_json      = $filename.".json";
        $data           = json_encode($pdfbody, JSON_UNESCAPED_UNICODE);
        file_put_contents($micarpeta."/".$file_json, $data);

        echo $id_date;
    }

    public function grabar_imagen($cotimag_cotizacionid, $cotimag_imagen)
    {
        $cotimag_fecha = date("Y-m-d H:i:s");
        $cotimag_tipoimagen = "PDF";
        $cotimag_usuarioid = $_SESSION['USUARIO_ID'];
        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cotimag_usuarioid);
		
        foreach($Respuesta as $row){
			$usuario = $row['roles_nombrecorto'];
		}

        $cotimag_log = "<strong>".$cotimag_fecha."</strong> ".$usuario." CREACION <br>";

        $TablaBD = "manto_cotizaciones";
        $CampoBD = "cotizacion_id";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cotimag_cotizacionid);
		
        foreach($Respuesta as $row){
			$cotimag_ruc = $row['coti_ruc'];
		}

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->grabar_imagen($cotimag_cotizacionid, $cotimag_ruc, $cotimag_tipoimagen, $cotimag_imagen, $cotimag_usuarioid, $cotimag_fecha, $cotimag_log);

    }

    public function editar_imagen($cotimag_cotizacionid, $cotimag_imagen)
    {
        $cotimag_fecha = date("Y-m-d H:i:s");
        $cotimag_tipoimagen = "PDF";
        $cotimag_usuarioid = $_SESSION['USUARIO_ID'];

        $TablaBD = "glo_roles";
        $CampoBD = "roles_dni";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cotimag_usuarioid);
		
        foreach($Respuesta as $row){
			$usuario = $row['roles_nombrecorto'];
		}

        $TablaBD = "manto_cotizaciones";
        $CampoBD = "cotizacion_id";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cotimag_cotizacionid);
		
        foreach($Respuesta as $row){
			$cotimag_ruc = $row['coti_ruc'];
		}

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->buscar_log_imagen($cotimag_cotizacionid, $cotimag_ruc, $cotimag_tipoimagen);
		
        foreach($Respuesta as $row){
			$cotimag_log1 = $row['cotimag_log'];
		}

        $cotimag_log = "<strong>".$cotimag_fecha."</strong> ".$usuario." EDICION <br>".$cotimag_log1;

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->editar_imagen($cotimag_cotizacionid, $cotimag_ruc, $cotimag_tipoimagen, $cotimag_imagen, $cotimag_log);
    }

    public function buscar_imagen($cotimag_cotizacionid, $cotimag_tipoimagen)
    {
        $TablaBD = "manto_cotizaciones";
        $CampoBD = "cotizacion_id";

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->BuscarDataBD($TablaBD,$CampoBD,$cotimag_cotizacionid);
		
        foreach($Respuesta as $row){
			$cotimag_ruc = $row['coti_ruc'];
		}

        MModel($this->Modulo,'CRUD');
        $InstanciaAjax= new CRUD();
        $Respuesta=$InstanciaAjax->buscar_imagen($cotimag_cotizacionid, $cotimag_ruc, $cotimag_tipoimagen);
    }

}