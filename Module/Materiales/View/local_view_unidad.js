///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: LISTADO UNIDAD DE MEDIDA v 1.0 FECHA: 2023-12-27 ::::::::::::::::::::::::::::::::::::///
///:: CREAR EDITAR BORRAR UNIDAD DE MEDIDA ::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///::: DECLARACION DE VARIABLES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
let unidad_medida, um_descripcion;
let tabla_unidad, opcion_unidad, fila_unidad, select_unidad;

///:: JS DOM UNIDAD MEDIDA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tabla_unidad","");
    $("#div_tabla_unidad").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_unidad","");

    $('#tabla_unidad thead tr')
        .clone(true)
        .addClass('filters_unidad')
        .appendTo('#tabla_unidad thead');

    Accion = 'leer_unidad';
    tabla_unidad = $('#tabla_unidad').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filters_unidad th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filters_unidad th').eq($(api.column(colIdx).header()).index()) )
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
              "targets"     : [2],
              "orderable"   : false
            },
            { 
              "className"   : "text-center",
              "targets"     : [0,2]
            },
          ],    
        "order"         : [[0, 'asc']]
    });     

    ///:: INICIO DE BOTONES UNIDAD MEDIDA ::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_unidad", function(){
        opcion_unidad = "CREAR";
        $("#form_unidad").trigger("reset");
        limpia_unidad();

        $("#unidad_medida").prop("disabled",false);
        
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta Unidad de Medida");
        $('#modal_crud_unidad').modal('show');	    
    });
    ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btn_editar_unidad", function(){
        opcion_unidad = "EDITAR";
        limpia_unidad();
        fila_unidad = $(this).closest("tr");	        
        unidad_medida = fila_unidad.find('td:eq(0)').text();
        um_descripcion = fila_unidad.find('td:eq(1)').text();

        $("#unidad_medida").val(unidad_medida);
        $("#um_descripcion").val(um_descripcion);
        
        $("#unidad_medida").prop("disabled",true);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Unidad de Medida");		
    
        $('#modal_crud_unidad').modal('show');		   
    });
    ///:: FIN BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


    ///:: CREA Y EDITA UNIDAD MEDIDA :::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_unidad').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        unidad_medida = $('#unidad_medida').val();    
        um_descripcion = $.trim($('#um_descripcion').val());
    
        let t_validar_unidad = validar_unidad(unidad_medida, um_descripcion);

        if(t_validar_unidad!="invalido") {   
            $("#btn_guardar_unidad").prop("disabled",true);
            if(opcion_unidad == "CREAR"){ Accion='crear_unidad'; }
            if(opcion_unidad == "EDITAR"){ Accion='editar_unidad'; }    
            $.ajax({
                url     : "Ajax.php",
                type    : "POST",
                datatype: "json",    
                data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, unidad_medida:unidad_medida, um_descripcion:um_descripcion },
                success: function(data) {
                    tabla_unidad.ajax.reload(null, false);
                }
            });
            $('#modal_crud_unidad').modal('hide');
            $("#btn_guardar_unidad").prop("disabled",false);
        } 
    });
    ///:: FIN CREA Y EDITA UNIDAD MEDIDA :::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_borrar_unidad", function(){
        fila_unidad = $(this);
        unidad_medida = fila_unidad.closest('tr').find('td:eq(0)').text();
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminará el registro "+unidad_medida+"!",
            icon                : 'warning',
            showCancelButton    : true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            confirmButtonText   : 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Accion = 'borrar_unidad';
                $.ajax({
                    url     : "Ajax.php",
                    type    : "POST",
                    datatype: "json",
                    async   : false,    
                    data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, unidad_medida:unidad_medida },
                        success: function(data) {
                            tabla_unidad.row(fila_unidad.parents('tr')).remove().draw();
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

    ///:: TERMINO DE BOTONES UNIDAD MEDIDA :::::::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM UNIDAD MEDIDA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES PARA UNIDAD MEDIDA :::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function validar_unidad(p_unidad_medida, p_um_descripcion){
    limpia_unidad();
    let rpta_unidad="";
    if(p_unidad_medida == "" || p_unidad_medida == null){
        $("#unidad_medida").addClass("color-error");
        rpta_unidad="invalido";
    }
    if(p_um_descripcion == "" || p_um_descripcion == null){
        $("#um_descripcion").addClass("color-error");
        rpta_unidad="invalido";
    }
    return rpta_unidad; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: REESTABLECE EL FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::::::::::///
function limpia_unidad(){
    $("#unidad_medida").removeClass("color-error");
    $("#um_descripcion").removeClass("color-error");
}
///:: FIN REESTABLECE EL FONDO DE LOS CAMPOS DEL FORMULARIO :::::::::::::::::::::::::::::::///

///:: TERMINO FUNCIONES PARA UNIDAD MEDIDA :::::::::::::::::::::::::::::::::::::::::::::::///