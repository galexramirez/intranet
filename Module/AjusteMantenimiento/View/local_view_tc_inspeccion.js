///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tc_inspeccion_id, insp_ficha, insp_categoria1, insp_categoria2;
var tabla_tc_inspeccion, opcion_tc_inspeccion, fila_tc_inspeccion;

///:: DOM JS TIPO TABLA INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tabla_tc_inspeccion","");
    $("#div_tabla_tc_inspeccion").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_tc_inspeccion","");

    $('#tabla_tc_inspeccion thead tr')
        .clone(true)
        .addClass('filters_tc_inspeccion')
        .appendTo('#tabla_tc_inspeccion thead');

    Accion='leer_tc_inspeccion';
    tabla_tc_inspeccion = $('#tabla_tc_inspeccion').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            api.columns().eq(0).each(function (colIdx) {
                var cell = $('.filters_tc_inspeccion th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                $('input',$('.filters_tc_inspeccion th').eq($(api.column(colIdx).header()).index()) )
                .off('keyup change').on('keyup change', function (e) {e.stopPropagation();
                    $(this).attr('title', $(this).val());
                    var regexr = '({search})';
                    var cursorPosition = this.selectionStart;
                    api.column(colIdx).search(this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))'): '',this.value != '',this.value == '').draw();
                    $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
                });
            });
        },
        
        language    : idiomaEspanol,
        responsive  : "true",
        dom         : 'Blfrtip',
        buttons : [
            {
                extend:     'excelHtml5',
                text:       '<i class="fas fa-file-excel"></i> ',
                titleAttr:  'Exportar a Excel',
                className:  'btn btn-success',
                title       : 'TC INSPECCION'
            },
        ],
        "ajax":{            
            "url"       : "Ajax.php", 
            "method"    : 'POST',
            "data"      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},
            "dataSrc"   : ""
        },
        "columns"       : columnastabla
    });     

    ///:: EVENTO DEL BOTON NUEVO TC INSPECCION ::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_tc_inspeccion", function(){
        opcion_tc_inspeccion = "CREAR";
        f_limpia_tc_inspeccions();
        $("#form_tc_inspeccion").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Inspeccion");
        $('#modal_crud_tc_inspeccion').modal('show');	    
    });

    ///:: BOTON EDITAR TC INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_editar_tc_inspeccion", function(){
        opcion_tc_inspeccion = "EDITAR";
        f_limpia_tc_inspeccions();
        $("#tc_inspeccion_id").prop('disabled', true);
        fila_tc_inspeccion = $(this).closest("tr");	        
        tc_inspeccion_id    = fila_tc_inspeccion.find('td:eq(0)').text();
        insp_ficha          = fila_tc_inspeccion.find('td:eq(1)').text();
        insp_categoria1     = fila_tc_inspeccion.find('td:eq(2)').text();
        insp_categoria2     = fila_tc_inspeccion.find('td:eq(3)').text();

        $("#tc_inspeccion_id").val(tc_inspeccion_id);
        $("#insp_categoria1").val(insp_categoria1);
        $("#insp_ficha").val(insp_ficha);
        $("#insp_categoria2").val(insp_categoria2);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Inspeccion");		
    
        $('#modal_crud_tc_inspeccion').modal('show');		   
    });


    ///:: CREA Y EDITA TC INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_tc_inspeccion').submit(function(e){                   
        let validar_tc_inspeccion="";      
        e.preventDefault();

        tc_inspeccion_id    = $.trim($('#tc_inspeccion_id').val());    
        insp_ficha          = $.trim($('#insp_ficha').val());    
        insp_categoria1     = $.trim($('#insp_categoria1').val());
        insp_categoria2     = $.trim($('#insp_categoria2').val());
    
        validar_tc_inspeccion = f_validar_tc_inspeccion(tc_inspeccion_id, insp_ficha, insp_categoria1, insp_categoria2);

        if(validar_tc_inspeccion=="invalido") {

        }else{
            if(opcion_tc_inspeccion == "CREAR") {
                Accion = 'crear_tc_inspeccion';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tc_inspeccion_id:tc_inspeccion_id, tc_ficha:insp_ficha, tc_categoria1:insp_categoria1,tc_categoria2:insp_categoria2 },    
                    success: function(data) {
                        tabla_tc_inspeccion.ajax.reload(null, false);
                    }
                });
            } 
            if(opcion_tc_inspeccion == "EDITAR") {
                Accion = 'editar_tc_inspeccion';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tc_inspeccion_id:tc_inspeccion_id, tc_ficha:insp_ficha, tc_categoria1:insp_categoria1,tc_categoria2:insp_categoria2 },    
                    success: function(data) {
                        tabla_tc_inspeccion.ajax.reload(null, false);
                    }
                });
            }
            $('#modal_crud_tc_inspeccion').modal('hide');
        }
    });
        
    ///:: BOTON BORRAR REGISTRO TC INSPECCION :::::::::::::::::::::::::::::::::::::::::::::///  
    $(document).on("click", ".btn_borrar_tc_inspeccion", function(){
        fila_tc_inspeccion = $(this);           
        tc_inspeccion_id = $(this).closest('tr').find('td:eq(0)').text();     
        rpta_tc_inspeccion = 0;
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminará el registro "+tc_inspeccion_id+"!",
            icon                : 'warning',
            showCancelButton    : true,
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            confirmButtonText   : 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro se ha sido eliminado.',
                    'success'
                )
                rpta_tc_inspeccion = 1;
                Accion='borrar_tc_inspeccion';
                if (rpta_tc_inspeccion == 1) {            
                    $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",
                    async       : false,    
                    data        : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,tc_inspeccion_id:tc_inspeccion_id },   
                        success: function(data) {
                            tabla_tc_inspeccion.row(fila_tc_inspeccion.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_tc_inspeccion(tc_inspeccion_id,insp_ficha,insp_categoria1,insp_categoria2){
    f_limpia_tc_inspeccions();
    let rpta_validar_tc_inspeccion="";    

    return rpta_validar_tc_inspeccion; 
}

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::///
function f_limpia_tc_inspeccions(){
    $("#tc_inspeccion_id").removeClass("color-error" );
    $("#insp_ficha").removeClass("color-error" );
    $("#insp_categoria1").removeClass("color-error" );
    $("#insp_categoria2").removeClass("color-error" );
}