///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: LISTADO TIPO DE ORIGENES v 1.0 FECHA: 2023-12-27 ::::::::::::::::::::::::::::::::::::///
///:: CREAR EDITAR BORRAR TIPO DE ORIGENES ::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::: DECLARACION DE VARIABLES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
let ot_origen_id,or_nombre, or_tipo_ot;
let tabla_origen, opcion_origen, fila_origen, select_origen;

///:: JS DOM TIPO DE ORIGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tabla_origen","");
    $("#div_tabla_origen").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_origen","");

    $('#tabla_origen thead tr')
        .clone(true)
        .addClass('filters_origen')
        .appendTo('#tabla_origen thead');

    Accion = 'leer_origen';
    tabla_origen = $('#tabla_origen').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filters_origen th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filters_origen th').eq($(api.column(colIdx).header()).index()) )
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
              "targets"     : [3],
              "orderable"   : false
            },
            { 
              "className"   : "text-center",
              "targets"     : [0,2]
            },
          ],    
        "order"         : [[0, 'asc']]
    });     

    ///:: INICIO DE BOTONES TIPO DE ORIGEN ::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_origen", function(){
        opcion_origen = "CREAR";
        $("#form_origen").trigger("reset");
        limpia_origen();

        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("ALTA ORIGEN");
        $('#modal_crud_origen').modal('show');	    
    });
    ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_editar_origen", function(){
        opcion_origen = "EDITAR";
        limpia_origen();
        fila_origen = $(this).closest("tr");	        
        ot_origen_id = fila_origen.find('td:eq(0)').text();
        or_nombre = fila_origen.find('td:eq(1)').text();
        or_tipo_ot = fila_origen.find('td:eq(2)').text();

        $("#ot_origen_id").val(ot_origen_id);
        $("#or_nombre").val(or_nombre);
        $("#or_tipo_ot").val(or_tipo_ot);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("EDITAR ORIGEN");		
    
        $('#modal_crud_origen').modal('show');		   
    });
    ///:: FIN BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


    ///:: CREA Y EDITA TIPO DE ORIGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_origen').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        ot_origen_id = $('#ot_origen_id').val();    
        or_nombre = $.trim($('#or_nombre').val());
        or_tipo_ot = $.trim($('#or_tipo_ot').val());
    
        let t_validar_origen = validar_origen(or_nombre, or_tipo_ot);

        if(t_validar_origen!="invalido") {   
            $("#btn_guardar_origen").prop("disabled",true);
            if(opcion_origen == "CREAR"){ Accion='crear_origen'; }
            if(opcion_origen == "EDITAR"){ Accion='editar_origen'; }    
            $.ajax({
                url     : "Ajax.php",
                type    : "POST",
                datatype: "json",    
                data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_origen_id:ot_origen_id, or_nombre:or_nombre, or_tipo_ot:or_tipo_ot },    
                success: function(data) {
                    tabla_origen.ajax.reload(null, false);
                }
            });
            $('#modal_crud_origen').modal('hide');
            $("#btn_guardar_origen").prop("disabled",false);
        } 
    });
    ///:: FIN CREA Y EDITA TIPO DE ORIGEN :::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_borrar_origen", function(){
        fila_origen = $(this);
        ot_origen_id = fila_origen.closest('tr').find('td:eq(0)').text();
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminará el registro "+ot_origen_id+"!",
            icon                : 'warning',
            showCancelButton    : true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            confirmButtonText   : 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Accion = 'borrar_origen';
                $.ajax({
                    url     : "Ajax.php",
                    type    : "POST",
                    datatype: "json",
                    async   : false,    
                    data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, ot_origen_id:ot_origen_id },
                        success: function(data) {
                            tabla_origen.row(fila_origen.parents('tr')).remove().draw();
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

    ///:: TERMINO DE BOTONES TIPO DE ORIGEN :::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM TIPO DE ORIGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES PARA TIPO DE ORIGEN :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function validar_origen(p_or_tipo_ot, p_or_nombre){
    limpia_origen();
    let rpta_origen="";
    if(p_or_tipo_ot == "" || p_or_tipo_ot == null){
        $("#or_tipo_ot").addClass("color-error");
        rpta_origen="invalido";
    }
    if(p_or_nombre == "" || p_or_nombre == null){
        $("#or_nombre").addClass("color-error");
        rpta_origen="invalido";
    }
    return rpta_origen; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: REESTABLECE EL FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::::::::::///
function limpia_origen(){
    $("#or_tipo_ot").removeClass("color-error");
    $("#or_nombre").removeClass("color-error");

    select_origen = f_select_combo("manto_tc_orden_trabajo","NO","tc_categoria3","","`tc_variable`='SISTEMA' AND `tc_categoria1`='ORDEN TRABAJO' AND `tc_categoria2`='TIPO'","tc_categoria3 ASC");
    $("#or_tipo_ot").html(select_origen);

}
///:: FIN REESTABLECE EL FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES PARA TIPO DE ORIGEN :::::::::::::::::::::::::::::::::::::::::::::::///