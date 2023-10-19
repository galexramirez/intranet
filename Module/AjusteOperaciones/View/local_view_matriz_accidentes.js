///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: MATRIZ DE ACCIDENTES v 1.0  FECHA: 2023-05-12 :::::::::::::::::::::::::::::::::::::::///
///:: CRUD MATRIZ DE ACCIDENTES :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tabla_matriz_accidentes, accidentesmatriz_id, acmt_campo, acmt_busqueda, acmt_respuesta, fila_matriz_accidentes, opcion_tabla_matriz_accidentes;

///:: JS DOM MATRIZ DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    // Setup - add a text input to each footer cell
    $('#tabla_matriz_accidentes thead tr')
        .clone(true)
        .addClass('filters_matriz_accidentes')
        .appendTo('#tabla_matriz_accidentes thead');

    Accion = 'leer_matriz_accidentes';
    tabla_matriz_accidentes = $('#tabla_matriz_accidentes').DataTable({
        //Filtros por columnas
        orderCellsTop   : true,
        fixedHeader     : true,
        initComplete    : function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filters_matriz_accidentes th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filters_matriz_accidentes th').eq($(api.column(colIdx).header()).index()) )
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
        language        : idiomaEspanol,
        responsive      : "true",
        dom             : 'Blfrtip',
        buttons         : [
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'MATRIZ DE ACCIDENTES'
            },
        ],
        "ajax"          : {
            "url"       : "Ajax.php", 
            "method"    : 'POST',
            "data"      : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion}, 
            "dataSrc"   : ""
        },
        "columns"       : [
            {"data"             : "accidentesmatriz_id"},
            {"data"             : "acmt_campo"},
            {"data"             : "acmt_busqueda"},
            {"data"             : "acmt_respuesta"},
            {"defaultContent"   : "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btn_editar_matriz_accidentes'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btn_borrar_matriz_accidentes'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>"}
        ]
    });     

    ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_matriz_accidentes", function(){
        opcion_tabla_matriz_accidentes = "CREAR";
        f_limpia_matriz_accidentes();
        $("#form_matriz_accidentes").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla Matriz Accidentes");
        $('#modal_crud_matriz_accidentes').modal('show');	    
    });
    ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    
    ///:: BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_editar_matriz_accidentes", function(){
        opcion_tabla_matriz_accidentes = "EDITAR";
        f_limpia_matriz_accidentes();
        fila_matriz_accidentes  = $(this).closest("tr");	        
        accidentesmatriz_id     = fila_matriz_accidentes.find('td:eq(0)').text();
        acmt_campo              = fila_matriz_accidentes.find('td:eq(1)').text();
        acmt_busqueda           = fila_matriz_accidentes.find('td:eq(2)').text();
        acmt_respuesta          = fila_matriz_accidentes.find('td:eq(3)').text();

        $("#accidentesmatriz_id").val(accidentesmatriz_id);
        $("#acmt_campo").val(acmt_campo);
        $("#acmt_busqueda").val(acmt_busqueda);
        $("#acmt_respuesta").val(acmt_respuesta);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Matriz Accidentes");		
    
        $('#modal_crud_matriz_accidentes').modal('show');		   
    });
    ///:: FIN BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON CREA Y EDITA MATRIZ DE ACCIDENTES :::::::::::::::::::::::::::::::::::::::::///
    $('#form_matriz_accidentes').submit(function(e){
        let validacion_matriz_accidentes="";
        e.preventDefault(); 
        accidentesmatriz_id = $.trim($('#accidentesmatriz_id').val());    
        acmt_campo          = $.trim($('#acmt_campo').val());
        acmt_busqueda       = $.trim($('#acmt_busqueda').val());    
        acmt_respuesta      = $.trim($('#acmt_respuesta').val());
    
        validacion_matriz_accidentes = f_validar_matriz_accidentes(acmt_campo, acmt_busqueda, acmt_respuesta);

        if(validacion_matriz_accidentes=="invalido") {
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '*Falta Completar Información!!!',
                showConfirmButton   : false,
                timer               : 1500
            })        
        }else{
            $("#btn_guardar_matriz_accidentes").prop("disabled",true);
            if(opcion_tabla_matriz_accidentes == "CREAR") {
                Accion = 'crear_matriz_accidentes';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        :  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, accidentesmatriz_id:accidentesmatriz_id, acmt_campo:acmt_campo,acmt_busqueda:acmt_busqueda, acmt_respuesta:acmt_respuesta },    
                    success     : function(data) {
                        tabla_matriz_accidentes.ajax.reload(null, false);
                    }
                });
                $('#modal_crud_matriz_accidentes').modal('hide');
            } 
            if(opcion_tabla_matriz_accidentes == "EDITAR") {
                Accion = 'editar_matriz_accidentes';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, accidentesmatriz_id:accidentesmatriz_id, acmt_campo:acmt_campo,acmt_busqueda:acmt_busqueda, acmt_respuesta:acmt_respuesta },
                    success     : function(data) {
                        tabla_matriz_accidentes.ajax.reload(null, false);
                    }
                });
                $('#modal_crud_matriz_accidentes').modal('hide');
            }
            $("#btn_guardar_matriz_accidentes").prop("disabled",false);
        }
    });
    ///:: FIN BOTON CREA Y EDITA MATRIZ DE ACCIDENTES :::::::::::::::::::::::::::::::::::::///

    ///:: BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_borrar_matriz_accidentes", function(){
        let rpta_borrar_matriz_accidentes = "";
        fila_matriz_accidentes  = $(this);           
        accidentesmatriz_id     = fila_matriz_accidentes.closest('tr').find('td:eq(0)').text();     
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminará el registro "+accidentesmatriz_id+"!",
            icon                : 'warning',
            showCancelButton    : true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            confirmButtonText   : 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                rpta_borrar_matriz_accidentes = "BORRAR";
                Accion = 'borrar_matriz_accidentes';
                if (rpta_borrar_matriz_accidentes == "BORRAR") {            
                    $.ajax({
                        url         : "Ajax.php",
                        type        : "POST",
                        datatype    : "json",
                        async       : false,
                        data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, accidentesmatriz_id:accidentesmatriz_id },   
                        success     : function(data) {
                            tabla_matriz_accidentes.row(fila_matriz_accidentes.parents('tr')).remove().draw();
                            Swal.fire(
                                'Eliminado!',
                                'El registro se ha sido eliminado.',
                                'success'
                            )            
                        }
                    });
                }
            }
        });
    });
    ///:: BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

});

///:: FUNCIONES DE CRUD MATRIZ DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_matriz_accidentes(p_acmt_campo, p_acmt_busqueda, p_acmt_respuesta){
    f_limpia_matriz_accidentes();
    let rpta_validar_matriz_accidentes = "";    
    if(p_acmt_campo==""){
        $("#acmt_campo").addClass("color-error")
        rpta_validar_matriz_accidentes = "invalido";
    }
    if(p_acmt_busqueda==""){
        $("#acmt_busqueda").addClass("color-error")
        rpta_validar_matriz_accidentes = "invalido";
    }
    if(p_acmt_respuesta==""){
        $("#acmt_respuesta").addClass("color-error")
        rpta_validar_matriz_accidentes = "invalido";
    }
    return rpta_validar_matriz_accidentes; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: LIMPIA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::::::/// 
function f_limpia_matriz_accidentes(){
    $("#acmt_campo").removeClass("color-error");
    $("#acmt_busqueda").removeClass("color-error");
    $("#acmt_respuesta").removeClass("color-error");
}
///:: FIN LIMPIA LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::::::::::::::::::::/// 

///:: TERMINO FUNCIONES DE CRUD MATRIZ DE ACCIDENTES ::::::::::::::::::::::::::::::::::::::///