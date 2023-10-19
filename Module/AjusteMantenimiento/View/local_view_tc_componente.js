///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tc_componente_id, comp_ficha, comp_categoria1, comp_categoria2;
var tabla_tc_componente, opcion_tc_componente, fila_tc_componente;

///:: DOM JS TIPO TABLA COMPONENTE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tabla_tc_componente","");
    $("#div_tabla_tc_componente").html(div_tabla);
    columnastabla = f_ColumnasTabla("tabla_tc_componente","");

    $('#tabla_tc_componente thead tr')
        .clone(true)
        .addClass('filters_tc_componente')
        .appendTo('#tabla_tc_componente thead');

    Accion='leer_tc_componente';
    tabla_tc_componente = $('#tabla_tc_componente').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            api.columns().eq(0).each(function (colIdx) {
                var cell = $('.filters_tc_componente th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                $('input',$('.filters_tc_componente th').eq($(api.column(colIdx).header()).index()) )
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
                title       : 'TC COMPONENTE'
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

    ///:: EVENTO DEL BOTON NUEVO TC COMPONENTE ::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_tc_componente", function(){
        opcion_tc_componente = "CREAR";
        f_limpia_tc_componentes();
        $("#form_tc_componente").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Componentes");
        $('#modal_crud_tc_componente').modal('show');	    
    });

    ///:: BOTON EDITAR TC COMPONENTE ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_editar_tc_componente", function(){
        opcion_tc_componente = "EDITAR";
        f_limpia_tc_componentes();
        $("#tc_componente_id").prop('disabled', true);
        fila_tc_componente = $(this).closest("tr");	        
        tc_componente_id    = fila_tc_componente.find('td:eq(0)').text();
        comp_ficha          = fila_tc_componente.find('td:eq(1)').text();
        comp_categoria1     = fila_tc_componente.find('td:eq(2)').text();
        comp_categoria2     = fila_tc_componente.find('td:eq(3)').text();

        $("#tc_componente_id").val(tc_componente_id);
        $("#comp_categoria1").val(comp_categoria1);
        $("#comp_ficha").val(comp_ficha);
        $("#comp_categoria2").val(comp_categoria2);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Compoenentes");		
    
        $('#modal_crud_tc_componente').modal('show');		   
    });


    ///:: CREA Y EDITA TC COMPONENTE ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_tc_componente').submit(function(e){                   
        let validar_tc_componente="";      
        e.preventDefault();

        tc_componente_id    = $.trim($('#tc_componente_id').val());    
        comp_ficha          = $.trim($('#comp_ficha').val());    
        comp_categoria1     = $.trim($('#comp_categoria1').val());
        comp_categoria2     = $.trim($('#comp_categoria2').val());
    
        validar_tc_componente = f_validar_tc_componente(tc_componente_id, comp_ficha, comp_categoria1, comp_categoria2);

        if(validar_tc_componente=="invalido") {

        }else{
            if(opcion_tc_componente == "CREAR") {
                Accion = 'crear_tc_componente';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tc_componente_id:tc_componente_id, tc_ficha:comp_ficha, tc_categoria1:comp_categoria1,tc_categoria2:comp_categoria2 },    
                    success: function(data) {
                        tabla_tc_componente.ajax.reload(null, false);
                    }
                });
            } 
            if(opcion_tc_componente == "EDITAR") {
                Accion = 'editar_tc_componente';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tc_componente_id:tc_componente_id, tc_ficha:comp_ficha, tc_categoria1:comp_categoria1,tc_categoria2:comp_categoria2 },    
                    success: function(data) {
                        tabla_tc_componente.ajax.reload(null, false);
                    }
                });
            }
            $('#modal_crud_tc_componente').modal('hide');
        }
    });
        
    ///:: BOTON BORRAR REGISTRO TC COMPONENTE :::::::::::::::::::::::::::::::::::::::::::::///  
    $(document).on("click", ".btn_borrar_tc_componente", function(){
        fila_tc_componente = $(this);           
        tc_componente_id = $(this).closest('tr').find('td:eq(0)').text();     
        rpta_tc_componente = 0;
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminará el registro "+tc_componente_id+"!",
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
                rpta_tc_componente = 1;
                Accion='borrar_tc_componente';
                if (rpta_tc_componente == 1) {            
                    $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",
                    async       : false,    
                    data        : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,tc_componente_id:tc_componente_id },   
                        success: function(data) {
                            tabla_tc_componente.row(fila_tc_componente.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_tc_componente(tc_componente_id,comp_ficha,comp_categoria1,comp_categoria2){
    f_limpia_tc_componentes();
    let rpta_validar_tc_componente="";    

    return rpta_validar_tc_componente; 
}

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::///
function f_limpia_tc_componentes(){
    $("#tc_componente_id").removeClass("color-error" );
    $("#comp_ficha").removeClass("color-error" );
    $("#comp_categoria1").removeClass("color-error" );
    $("#comp_categoria2").removeClass("color-error" );
}