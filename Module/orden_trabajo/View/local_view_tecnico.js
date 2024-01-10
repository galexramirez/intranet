///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: LISTADO TECNICO POR ASOCIADO v 1.0 FECHA: 2024-01-09 ::::::::::::::::::::::::::::::::///
///:: CREAR EDITAR BORRAR TECNICO POR ASOCIADO:::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::: DECLARACION DE VARIABLES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
let tecnico_asociado_id, ta_dni, ta_apellidos_nombres, ta_nombre_corto, ta_ruc, ta_razon_social;
let tabla_tecnico, opcion_tecnico, fila_tecnico, select_tecnico;

///:: JS DOM TECNICO POR ASOCIADO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    $("#ta_razon_social").on("change", function(){
        ta_razon_social = $("#ta_razon_social").val();
        ta_ruc = f_buscar_dato("manto_proveedores","prov_ruc","`prov_razonsocial`='"+ta_razon_social+"'");
        $("#ta_ruc").val(ta_ruc);
    });

    div_tabla = f_CreacionTabla("tabla_tecnico","");
    $("#div_tabla_tecnico").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_tecnico","");

    $('#tabla_tecnico thead tr')
        .clone(true)
        .addClass('filters_tecnico')
        .appendTo('#tabla_tecnico thead');

    Accion = 'leer_tecnico';
    tabla_tecnico = $('#tabla_tecnico').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filters_tecnico th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filters_tecnico th').eq($(api.column(colIdx).header()).index()) )
                .off('keyup change').on('keyup change', function (e) {e.stopPropagation();
                    // Get the search value
                    $(this).attr('title', $(this).val());
                    var regexr = '({search})'; //$(this).parents('th').find('select').val();
                    var cursorPosition = this.selectionStart;
                    // Search the column for that value
                    api.column(colIdx).search(this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))'): '',this.value != '',this.value == '').draw();
                    $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
                });
            });
        },
        language    : idioma_espanol,
        responsive  : "true",
        dom         : 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons     : [
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success'
            },
        ],
        "ajax"  : {
            "url"       : "Ajax.php", 
            "method"    : 'POST', //usamos el metodo POST
            "data"      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc"   :""
        },
        "columns"       : columnas_tabla,
        "columnDefs"      : [
            {
              "targets"     : [6],
              "orderable"   : false
            },
            { 
              "className"   : "text-center",
              "targets"     : [0,1,4]
            },
          ],    
        "order"         : [[0, 'asc']]
    });     

    ///:: INICIO DE BOTONES TECNICO POR ASOCIADO ::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_tecnico", function(){
        opcion_tecnico = "CREAR";
        $("#form_tecnico").trigger("reset");
        limpia_tecnico();

        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta Técnico");
        $('#modal_crud_tecnico').modal('show');	    
    });
    ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_editar_tecnico", function(){
        opcion_tecnico = "EDITAR";
        limpia_tecnico();
        fila_tecnico = $(this).closest("tr");	        
        tecnico_asociado_id = fila_tecnico.find('td:eq(0)').text();
        ta_dni = fila_tecnico.find('td:eq(1)').text();
        ta_nombre_corto = fila_tecnico.find('td:eq(2)').text();
        ta_apellidos_nombres = fila_tecnico.find('td:eq(3)').text();
        ta_ruc = fila_tecnico.find('td:eq(4)').text();
        ta_razon_social = fila_tecnico.find('td:eq(5)').text();

        $("#tecnico_asociado_id").val(tecnico_asociado_id);
        $("#ta_dni").val(ta_dni);
        $("#ta_nombre_corto").val(ta_nombre_corto);
        $("#ta_apellidos_nombres").val(ta_apellidos_nombres);
        $("#ta_ruc").val(ta_ruc);
        $("#ta_razon_social").val(ta_razon_social);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Técnico");		
    
        $('#modal_crud_tecnico').modal('show');		   
    });
    ///:: FIN BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


    ///:: CREA Y EDITA TECNICO POR ASOCIADO :::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_tecnico').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        tecnico_asociado_id = $('#tecnico_asociado_id').val();
        ta_dni = $.trim($('#ta_dni').val());
        ta_nombre_corto = $.trim($('#ta_nombre_corto').val());
        ta_apellidos_nombres = $.trim($('#ta_apellidos_nombres').val());
        ta_ruc = $.trim($('#ta_ruc').val());    
        ta_razon_social = $.trim($('#ta_razon_social').val());    
    
        let t_validar_tecnico = validar_tecnico(ta_dni, ta_nombre_corto, ta_apellidos_nombres, ta_ruc, ta_razon_social);

        if(t_validar_tecnico!="invalido") {   
            $("#btn_guardar_tecnico").prop("disabled",true);
            if(opcion_tecnico == "CREAR"){ Accion='crear_tecnico'; }
            if(opcion_tecnico == "EDITAR"){ Accion='editar_tecnico'; }    
            $.ajax({
                url     : "Ajax.php",
                type    : "POST",
                datatype: "json",    
                data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tecnico_asociado_id:tecnico_asociado_id, ta_dni:ta_dni, ta_nombre_corto:ta_nombre_corto, ta_apellidos_nombres:ta_apellidos_nombres, ta_ruc:ta_ruc, ta_razon_social  },    
                success: function(data) {
                    tabla_tecnico.ajax.reload(null, false);
                }
            });
            $('#modal_crud_tecnico').modal('hide');
            $("#btn_guardar_tecnico").prop("disabled",false);
        } 
    });
    ///:: FIN CREA Y EDITA TECNICO POR ASOCIADO :::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_borrar_tecnico", function(){
        fila_tecnico = $(this);
        tecnico_asociado_id = fila_tecnico.closest('tr').find('td:eq(0)').text();
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminará el registro "+tecnico_asociado_id+"!",
            icon                : 'warning',
            showCancelButton    : true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            confirmButtonText   : 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Accion = 'borrar_tecnico';
                $.ajax({
                    url     : "Ajax.php",
                    type    : "POST",
                    datatype: "json",
                    async   : false,    
                    data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tecnico_asociado_id:tecnico_asociado_id },
                        success: function(data) {
                            tabla_tecnico.row(fila_tecnico.parents('tr')).remove().draw();
                        }
                });
                Swal.fire(
                    'Eliminado!',
                    'El registro se ha sido eliminado.',
                    'success'
                )
            }
        });
    });
    ///:: FIN BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: TERMINO DE BOTONES TECNICO POR ASOCIADO :::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM TECNICO POR ASOCIADO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES PARA TECNICO POR ASOCIADO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function validar_tecnico(p_ta_dni, p_ta_nombre_corto, p_ta_apellidos_nombres, p_ta_ruc, p_ta_razon_social){
    limpia_tecnico();
    let rpta_tecnico="";
    if(p_ta_dni == "" || p_ta_dni == null){
        $("#ta_dni").addClass("color-error");
        rpta_tecnico="invalido";
    }
    if(p_ta_nombre_corto == "" || p_ta_nombre_corto == null){
        $("#ta_nombre_corto").addClass("color-error");
        rpta_tecnico="invalido";
    }
    if(p_ta_apellidos_nombres == "" || p_ta_apellidos_nombres == null){
        $("#ta_apellidos_nombres").addClass("color-error");
        rpta_tecnico="invalido";
    }
    if(p_ta_ruc == "" || p_ta_ruc == null){
        $("#ta_ruc").addClass("color-error");
        rpta_tecnico="invalido";
    }
    if(p_ta_razon_social == "" || p_ta_razon_social == null){
        $("#ta_razon_social").addClass("color-error");
        rpta_tecnico="invalido";
    }
    return rpta_tecnico; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: REESTABLECE EL FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::::::::::///
function limpia_tecnico(){
    $("#ta_dni").removeClass("color-error");
    $("#ta_nombre_corto").removeClass("color-error");
    $("#ta_apellidos_nombres").removeClass("color-error");
    $("#ta_ruc").removeClass("color-error");
    $("#ta_razon_socail").removeClass("color-error");

    select_tecnico = f_select_combo("manto_proveedores","NO","prov_razonsocial","","`prov_estado`='ACTIVO'","prov_razonsocial ASC");
    $("#ta_razon_social").html(select_tecnico);

}
///:: FIN REESTABLECE EL FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES PARA TECNICO POR ASOCIADO :::::::::::::::::::::::::::::::::::::::::::::::///