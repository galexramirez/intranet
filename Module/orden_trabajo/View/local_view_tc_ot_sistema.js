///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tc_ot_id_sistema, ot_cat1_sistema, ot_cat2_sistema, ot_cat3_sistema;
var tabla_tc_ot_sistema, opcion_tc_ot_sistema, fila_tc_ot_sistema;

///:: DOM JS TIPO TABLA INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tabla_tc_ot_sistema","");
    $("#div_tabla_tc_ot_sistema").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_tc_ot_sistema","");

    $('#tabla_tc_ot_sistema thead tr')
        .clone(true)
        .addClass('filters_tc_ot_sistema')
        .appendTo('#tabla_tc_ot_sistema thead');

    Accion='leer_tc_ot_sistema';
    tabla_tc_ot_sistema = $('#tabla_tc_ot_sistema').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            api.columns().eq(0).each(function (colIdx) {
                var cell = $('.filters_tc_ot_sistema th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                $('input',$('.filters_tc_ot_sistema th').eq($(api.column(colIdx).header()).index()) )
                .off('keyup change').on('keyup change', function (e) {e.stopPropagation();
                    $(this).attr('title', $(this).val());
                    var regexr = '({search})';
                    var cursorPosition = this.selectionStart;
                    api.column(colIdx).search(this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))'): '',this.value != '',this.value == '').draw();
                    $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
                });
            });
        },
        
        language    : idioma_espanol,
        responsive  : "true",
        dom         : 'Blfrtip',
        buttons : [
            {
                extend:     'excelHtml5',
                text:       '<i class="fas fa-file-excel"></i> ',
                titleAttr:  'Exportar a Excel',
                className:  'btn btn-success',
                title       : 'VARIABLES SISTEMA CHECK LIST'
            },
        ],
        "ajax":{            
            "url"       : "Ajax.php", 
            "method"    : 'POST',
            "data"      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},
            "dataSrc"   : ""
        },
        "columns"       : columnas_tabla
    });     

    ///:: EVENTO DEL BOTON NUEVO TC INSPECCION ::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_nuevo_tc_ot_sistema", function(){
        opcion_tc_ot_sistema = "CREAR";
        f_limpia_tc_ot_sistema();
        $("#form_tc_ot_sistema").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta Variables de Sistema");
        $('#modal_crud_tc_ot_sistema').modal('show');	    
    });

    ///:: BOTON EDITAR TC INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_editar_tc_ot_sistema", function(){
        opcion_tc_ot_sistema = "EDITAR";
        f_limpia_tc_ot_sistema();
        $("#tc_ot_id_sistema").prop('disabled', true);
        fila_tc_ot_sistema = $(this).closest("tr");	        
        tc_ot_id_sistema = fila_tc_ot_sistema.find('td:eq(0)').text();
        ot_cat1_sistema = fila_tc_ot_sistema.find('td:eq(1)').text();
        ot_cat2_sistema = fila_tc_ot_sistema.find('td:eq(2)').text();
        ot_cat3_sistema = fila_tc_ot_sistema.find('td:eq(3)').text();

        $("#tc_ot_id_sistema").val(tc_ot_id_sistema);
        $("#ot_cat2_sistema").val(ot_cat2_sistema);
        $("#ot_cat1_sistema").val(ot_cat1_sistema);
        $("#ot_cat3_sistema").val(ot_cat3_sistema);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Varibales de Sistema");		
    
        $('#modal_crud_tc_ot_sistema').modal('show');		   
    });


    ///:: CREA Y EDITA TC INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_tc_ot_sistema').submit(function(e){                   
        let validar_tc_ot_sistema="";      
        e.preventDefault();

        tc_ot_id_sistema = $.trim($('#tc_ot_id_sistema').val());    
        ot_cat1_sistema = $.trim($('#ot_cat1_sistema').val());    
        ot_cat2_sistema = $.trim($('#ot_cat2_sistema').val());
        ot_cat3_sistema = $.trim($('#ot_cat3_sistema').val());
    
        validar_tc_ot_sistema = f_validar_tc_ot_sistema(tc_ot_id_sistema, ot_cat1_sistema, ot_cat2_sistema, ot_cat3_sistema);

        if(validar_tc_ot_sistema=="invalido") {

        }else{
            if(opcion_tc_ot_sistema == "CREAR") {
                Accion = 'crear_tc_ot_sistema';
            }
            if(opcion_tc_ot_sistema == "EDITAR") {
                Accion = 'editar_tc_ot_sistema';
            }
            $.ajax({
                url         : "Ajax.php",
                type        : "POST",
                datatype    : "json",    
                data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tc_ot_id:tc_ot_id_sistema, tc_categoria1:ot_cat1_sistema, tc_categoria2:ot_cat2_sistema,tc_categoria3:ot_cat3_sistema },    
                success: function(data) {
                    tabla_tc_ot_sistema.ajax.reload(null, false);
                }
            });
            $('#modal_crud_tc_ot_sistema').modal('hide');
        }
    });
        
    ///:: BOTON BORRAR REGISTRO TC INSPECCION :::::::::::::::::::::::::::::::::::::::::::::///  
    $(document).on("click", ".btn_borrar_tc_ot_sistema", function(){
        fila_tc_ot_sistema = $(this);           
        tc_ot_id_sistema = $(this).closest('tr').find('td:eq(0)').text();     
        rpta_tc_ot = 0;
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminará el registro "+tc_ot_id_sistema+"!",
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
                rpta_tc_ot = 1;
                Accion='borrar_tc_ot_sistema';
                if (rpta_tc_ot == 1) {            
                    $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",
                    async       : false,    
                    data        : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,tc_ot_id:tc_ot_id_sistema },   
                        success: function(data) {
                            tabla_tc_ot_sistema.row(fila_tc_ot_sistema.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_tc_ot_sistema(p_tc_ot_id_sistema, p_ot_cat1_sistema, p_ot_cat2_sistema,p_ot_cat3_sistema){
    f_limpia_tc_ot_sistema();
    let rpta_validar_tc_ot_sistema="";    

    if(p_ot_cat1_sistema==""){
        $("#ot_cat1_sistema").addClass("color-error" );
        rpta_validar_tc_ot_sistema = "invalido";    
    }
    if(p_ot_cat2_sistema==""){
        $("#ot_cat2_sistema").addClass("color-error" );
        rpta_validar_tc_ot_sistema = "invalido";    
    }
    if(p_ot_cat3_sistema==""){
        $("#ot_cat3_sistema").addClass("color-error" );
        rpta_validar_tc_ot_sistema = "invalido";    
    }

    return rpta_validar_tc_ot_sistema; 
}

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::///
function f_limpia_tc_ot_sistema(){
    $("#tc_ot_id_sistema").removeClass("color-error" );
    $("#ot_cat1_sistema").removeClass("color-error" );
    $("#ot_cat2_sistema").removeClass("color-error" );
    $("#ot_cat3_sistema").removeClass("color-error" );
}