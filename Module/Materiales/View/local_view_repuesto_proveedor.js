///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: REPUESTO PROVEEDORES v 1.0 FECHA: 18-01-2023 ::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR TABLA DE REPUESTO POR PROVEEDOR :::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var repp_razon_social, prov_razon_social, repp_codigo, repp_descripcion, repp_moneda, repp_unidad, repp_estado, repp_log, repp_prov_ruc, repp_material_id, repp_material_descripcion;
var tabla_repuesto_proveedor, opcion_repuesto_proveedor, fila_repuesto_proveedor, select_repuesto_proveedor;

///:: DOM JS REPUESTO POR PROVEEDORES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    select_repuesto_proveedor = f_select_combo("manto_proveedores","NO", "prov_razonsocial", "", "`prov_estado`='ACTIVO'", "`prov_razonsocial` ASC");
    $("#repp_razon_social").html(select_repuesto_proveedor);

    $("#repp_material_id" ).on('change', function () {
        repp_material_id = $("#repp_material_id").val();
        repp_material_id = f_buscar_dato("manto_materiales", "material_id", "`material_id`='"+repp_material_id+"'");
        if(repp_material_id=="") { 
            repp_material_descripcion = "";
            $("#repp_material_descripcion").val(repp_material_descripcion); 
        }
    });    
  
    ///:: BOTONES DE REPUESTO PROVEEDOR :::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BUSCAR REPUESTO POR PROVEEDOR :::::::::::::::::::::::::::::::::::::::::::::///
    $("#btn_buscar_repuesto_proveedor").click(function(){
        repp_razon_social   = $("#repp_razon_social").val();
        repp_prov_ruc = f_buscar_dato("manto_proveedores", "prov_ruc", "`prov_razonsocial`='"+repp_razon_social+"'");
        div_tabla = f_CreacionTabla("tabla_repuesto_proveedor","");
        $("#div_tabla_repuesto_proveedor").html(div_tabla);
        columnas_tabla = f_ColumnasTabla("tabla_repuesto_proveedor","");
    
        Accion = 'leer_repuesto_proveedor';
        tabla_repuesto_proveedor = $('#tabla_repuesto_proveedor').DataTable({
            orderCellsTop       : true,
            fixedHeader         : true,
            pageLength          : 100,
            language            : idioma_espanol,
            responsive          : "true",
            dom                 : 'Blfrtip', // Con Botones Excel,Pdf,Print
            buttons             : [
                {
                    extend      : 'excelHtml5',
                    text        : '<i class="fas fa-file-excel"></i> ',
                    titleAttr   : 'Exportar a Excel',
                    className   : 'btn btn-success'
                },
            ],
            "ajax"              : {
                "url"           : "Ajax.php", 
                "method"        : 'POST',
                "data"          : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, repp_prov_ruc:repp_prov_ruc}, 
                "dataSrc"       : ""
            },
            "columns": columnas_tabla
        });         
    });
    ///:: FIN BOTON BUSCAR REPUESTO POR PROVEEDOR :::::::::::::::::::::::::::::::::::::::::///
    
    ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $("#btn_nuevo_repuesto_proveedor").click(function(){
        opcion_repuesto_proveedor = "CREAR"; 
        f_limpia_repuesto_proveedor();
        f_select_repuesto_proveedor();
        f_autocomplete_material_id();

        $("#prov_razon_social").prop('disabled', false);
        $("#repp_codigo").prop('disabled', false);
        $("#form_listado_repuesto_proveedor").trigger("reset");

        prov_razon_social = "";
        repp_codigo       = "";
        repp_descripcion  = "";
        repp_unidad       = "";
        repp_moneda       = "";
        repp_estado       = "ACTIVO";
        repp_material_id  = "";
        repp_material_descripcion = "";
        repp_log          = "";

        $("#prov_razon_social").val(prov_razon_social);
        $("#repp_codigo").val(repp_codigo);
        $("#repp_descripcion").val(repp_descripcion);
        $("#repp_unidad").val(repp_unidad);
        $("#repp_moneda").val(repp_moneda);
        $("#repp_estado").val(repp_estado);
        $("#repp_material_id").val(repp_material_id);
        $("#repp_material_descripcion").val(repp_material_descripcion);
        $("#div_repp_log").html(repp_log);

        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Repuesto por Proveedor");
        $('#modal_crud_listado_repuesto_proveedor').modal('show');
        $(".modal-dialog").draggable({
            cursor: "move",
            handle: ".dragable_touch",
        });   
    });
    ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_editar_repuesto_proveedor", function(){
        opcion_repuesto_proveedor = "EDITAR";
        f_limpia_repuesto_proveedor();
        f_select_repuesto_proveedor();
        f_autocomplete_material_id();

        $("#prov_razon_social").prop('disabled', true);
        $("#repp_codigo").prop('disabled', true);
        
        fila_repuesto_proveedor = $(this).closest("tr");	        
        
        prov_razon_social = $("#repp_razon_social").val();
        repp_codigo       = fila_repuesto_proveedor.find('td:eq(0)').text();
        repp_descripcion  = fila_repuesto_proveedor.find('td:eq(1)').text();
        repp_unidad       = fila_repuesto_proveedor.find('td:eq(2)').text();
        repp_moneda       = fila_repuesto_proveedor.find('td:eq(4)').text();
        repp_material_id  = fila_repuesto_proveedor.find('td:eq(5)').text();
        repp_material_descripcion = fila_repuesto_proveedor.find('td:eq(6)').text();
        repp_estado       = fila_repuesto_proveedor.find('td:eq(7)').text();
        repp_prov_ruc     = f_buscar_dato("manto_proveedores", "prov_ruc", "`prov_razonsocial`='"+prov_razon_social+"'");
        repp_log          = f_buscar_dato("manto_repuesto_proveedor", "repp_log", "`repp_prov_ruc`='"+repp_prov_ruc+"' AND `repp_codigo`='"+repp_codigo+"'");

        $("#prov_razon_social").val(prov_razon_social);
        $("#repp_codigo").val(repp_codigo);
        $("#repp_descripcion").val(repp_descripcion);
        $("#repp_unidad").val(repp_unidad);
        $("#repp_moneda").val(repp_moneda);
        $("#repp_estado").val(repp_estado);
        $("#repp_material_id").val(repp_material_id);
        $("#repp_material_descripcion").val(repp_material_descripcion);
        $("#div_repp_log").html(repp_log);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Repuesto por Proveedor");		
    
        $('#modal_crud_listado_repuesto_proveedor').modal('show');
        $(".modal-dialog").draggable({
            cursor: "move",
            handle: ".dragable_touch",
        });   	   
    });
    ///:: FIN BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: CREA Y EDITA REPUESTO POR PROVEEDOR :::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_listado_repuesto_proveedor').submit(function(e){
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        let validar_repuesto_proveedor = "";
        let repp_rpc_id = "0";
        prov_razon_social  = $('#prov_razon_social').val();
        repp_prov_ruc      = f_buscar_dato("manto_proveedores", "prov_ruc", "`prov_razonsocial`='"+prov_razon_social+"'");
        repp_codigo        = $.trim($('#repp_codigo').val());
        repp_descripcion   = $.trim($('#repp_descripcion').val());
        repp_unidad        = $('#repp_unidad').val();
        repp_moneda        = $('#repp_moneda').val();
        repp_estado        = $('#repp_estado').val();
        repp_material_id   = $('#repp_material_id').val();
        repp_material_descripcion = $('#repp_material_descripcion').val();
        repp_log           = $.trim($('#div_repp_log').html());

        validar_repuesto_proveedor = f_validar_repuesto_proveedor(prov_razon_social, repp_prov_ruc, repp_codigo, repp_descripcion, repp_unidad, repp_unidad, repp_estado, repp_material_id, repp_material_descripcion);

        if(opcion_repuesto_proveedor == "CREAR") { Accion = 'crear_repuesto_proveedor'; };
        if(opcion_repuesto_proveedor == "EDITAR") { Accion = 'editar_repuesto_proveedor'; };
        
        if(validar_repuesto_proveedor!="invalido") {   
            $("#btn_guardar_repuesto_proveedor").prop("disabled",true);
            $.ajax({
                url     : "Ajax.php",
                type    : "POST",
                datatype: "json",    
                data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, repp_prov_ruc:repp_prov_ruc, repp_codigo:repp_codigo, repp_descripcion:repp_descripcion, repp_unidad:repp_unidad, repp_moneda:repp_moneda, repp_estado:repp_estado, repp_material_id:repp_material_id, repp_material_descripcion:repp_material_descripcion,  repp_log:repp_log, repp_rpc_id:repp_rpc_id },
                success : function(data) {
                    tabla_repuesto_proveedor.ajax.reload(null, false);
                }
            });
            $("#btn_guardar_repuesto_proveedor").prop("disabled",false);
            $('#modal_crud_listado_repuesto_proveedor').modal('hide');
        } 
    });
    ///:: CREA Y EDITA PROVEEDOR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    
    ///:: TERMINO BOTONES DE PROVEEDORES ::::::::::::::::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO DOM JS PROVEEDORES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES EJECUTADAS AL CARGAR REPUESTO POR PROVEEDOR :::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_repuesto_proveedor(p_prov_razon_social, p_repp_prov_ruc, p_repp_codigo, p_repp_descripcion, p_repp_moneda,  p_repp_unidad, p_repp_estado, p_repp_material_id, p_repp_material_descripcion){
    f_limpia_repuesto_proveedor();
    let rpta_repuesto_proveedor="";    

    if(p_prov_razon_social=="" || p_repp_prov_ruc==""){
        $("#prov_razon_social").addClass("color-error");
        rpta_repuesto_proveedor="invalido";
    }

    if(p_repp_codigo==""){
        $("#repp_codigo").addClass("color-error");
        rpta_repuesto_proveedor="invalido";
    }

    if(p_repp_descripcion==""){
        $("#repp_descripcion").addClass("color-error");
        rpta_repuesto_proveedor="invalido";
    }

    if(p_repp_unidad==""){
        $("#repp_unidad").addClass("color-error");
        rpta_repuesto_proveedor="invalido";
    }

    if(p_repp_moneda==""){
        $("#repp_moneda").addClass("color-error");
        rpta_repuesto_proveedor="invalido";
    }

    if(p_repp_estado==""){
        $("#repp_estado").addClass("color-error");
        rpta_repuesto_proveedor="invalido";
    }

    if(p_repp_material_id==""){
        $("#repp_material_id").addClass("color-error");
        rpta_repuesto_proveedor="invalido";
    }

    if(p_repp_material_descripcion==""){
        $("#repp_material_descripcion").addClass("color-error");
        rpta_repuesto_proveedor="invalido";
    }

    return rpta_repuesto_proveedor; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::/// 
function f_limpia_repuesto_proveedor(){
    $("#prov_razon_social").removeClass("color-error");
    $("#repp_codigo").removeClass("color-error");
    $("#repp_descripcion").removeClass("color-error");
    $("#repp_unidad").removeClass("color-error");
    $("#repp_moneda").removeClass("color-error");
    $("#repp_estado").removeClass("color-error");
    $("#repp_material_id").removeClass("color-error");
    $("#repp_material_descripcion").removeClass("color-error");
}
///:: FIN INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::///

function f_select_repuesto_proveedor(){
    select_repuesto_proveedor = f_select_combo("manto_proveedores","NO", "prov_razonsocial", "", "`prov_estado`='ACTIVO'", "`prov_razonsocial` ASC");
    $("#prov_razon_social").html(select_repuesto_proveedor);

    select_repuesto_proveedor = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='SISTEMA' AND `tc_categoria1`='REPUESTO PROVEEDOR' AND `tc_categoria2`='ESTADO'", "`tc_categoria3` ASC");
    $("#repp_estado").html(select_repuesto_proveedor);

    select_repuesto_proveedor = f_select_unidad_medida();
    $("#repp_unidad").html(select_repuesto_proveedor);

    select_repuesto_proveedor = f_select_combo("manto_tc_material", "NO", "tc_categoria3", "", "`tc_variable`='SISTEMA' AND `tc_categoria1`='PRECIOS PROVEEDOR' AND `tc_categoria2`='MONEDA'", "`tc_categoria3` ASC");
    $("#repp_moneda").html(select_repuesto_proveedor);

}

function f_autocomplete_material_id(){
    $( function() {
        let t_autocompletar = f_AutoCompletar("manto_materiales","material_id");
        $("#repp_material_id" ).autocomplete({
            source      : t_autocompletar,
            minLength   : 3,
            html        : true,
            _renderMenu : function( ul, items ) {
                var that = this;
                $.each( items, function( index, item ) {
                    that._renderItemData( ul, item );
                });
                $( ul ).find( "li" ).odd().addClass( "odd" );
            },
            select: function( event, ui ) {
                $( "#repp_material_id" ).val( ui.item.value );
                $( "#repp_material_descripcion" ).val( ui.item.material_descripcion );
                return false;
            }
        });
    });
}
///:: FUNCION para utilizar el label del autocomplete como html :::::::::::::::::::::::::::///
(function( $ ) {
    var proto = $.ui.autocomplete.prototype,
      initSource = proto._initSource;
    
    function filter( array, term ) {
      var matcher = new RegExp( $.ui.autocomplete.escapeRegex(term), "i" );
      return $.grep( array, function(value) {
        return matcher.test( $( "<div>" ).html( value.label || value.value || value ).text() );
      });
    }
    
    $.extend( proto, {
      _initSource: function() {
        if ( this.options.html && $.isArray(this.options.source) ) {
          this.source = function( request, response ) {
            response( filter( this.options.source, request.term ) );
          };
        } else {
          initSource.call( this );
        }
      },
    
      _renderItem: function( ul, item) {
        return $( "<li></li>" )
          .data( "item.autocomplete", item )
          .append( $( "<a class='text-decoration-none'></a>" )[ this.options.html ? "html" : "text" ]( item.label ) )
          .appendTo( ul );
      }
    });
})( jQuery );
///:: TERMINO FUNCIONES EJECUTADAS AL CARGAR PROVEEDORES ::::::::::::::::::::::::::::::::::///