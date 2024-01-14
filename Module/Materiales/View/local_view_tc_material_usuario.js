///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tc_material_id_usuario, material_cat1_usuario, material_cat2_usuario, material_cat3_usuario;
var tabla_tc_material_usuario, opcion_tc_material_usuario, fila_tc_material_usuario;

///:: DOM JS TIPO TABLA INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tabla_tc_material_usuario","");
    $("#div_tabla_tc_material_usuario").html(div_tabla);
    columnas_tabla = f_ColumnasTabla("tabla_tc_material_usuario","");

    $('#tabla_tc_material_usuario thead tr')
        .clone(true)
        .addClass('filters_tc_material_usuario')
        .appendTo('#tabla_tc_material_usuario thead');

    Accion='leer_tc_material_usuario';
    tabla_tc_material_usuario = $('#tabla_tc_material_usuario').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            api.columns().eq(0).each(function (colIdx) {
                var cell = $('.filters_tc_material_usuario th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                $('input',$('.filters_tc_material_usuario th').eq($(api.column(colIdx).header()).index()) )
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
                title       : 'VARIABLES USUARIO INSPECCION'
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
    $(document).on("click", ".btn_nuevo_tc_material_usuario", function(){
        opcion_tc_material_usuario = "CREAR";
        f_limpia_tc_material_usuario();
        $("#form_tc_material_usuario").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta Variables de Usuario");
        $('#modal_crud_tc_material_usuario').modal('show');	    
    });

    ///:: BOTON EDITAR TC INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btn_editar_tc_material_usuario", function(){
        opcion_tc_material_usuario = "EDITAR";
        f_limpia_tc_material_usuario();
        $("#tc_material_id_usuario").prop('disabled', true);
        fila_tc_material_usuario = $(this).closest("tr");	        
        tc_material_id_usuario = fila_tc_material_usuario.find('td:eq(0)').text();
        material_cat1_usuario = fila_tc_material_usuario.find('td:eq(1)').text();
        material_cat2_usuario = fila_tc_material_usuario.find('td:eq(2)').text();
        material_cat3_usuario = fila_tc_material_usuario.find('td:eq(3)').text();

        $("#tc_material_id_usuario").val(tc_material_id_usuario);
        $("#material_cat2_usuario").val(material_cat2_usuario);
        $("#material_cat1_usuario").val(material_cat1_usuario);
        $("#material_cat3_usuario").val(material_cat3_usuario);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Variables de Usuario");		
    
        $('#modal_crud_tc_material_usuario').modal('show');		   
    });


    ///:: CREA Y EDITA TC INSPECCION ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#form_tc_material_usuario').submit(function(e){                   
        let validar_tc_material_usuario="";      
        e.preventDefault();

        tc_material_id_usuario = $.trim($('#tc_material_id_usuario').val());    
        material_cat1_usuario = $.trim($('#material_cat1_usuario').val());    
        material_cat2_usuario = $.trim($('#material_cat2_usuario').val());
        material_cat3_usuario = $.trim($('#material_cat3_usuario').val());
    
        validar_tc_material_usuario = f_validar_tc_material_usuario(tc_material_id_usuario, material_cat1_usuario, material_cat2_usuario, material_cat3_usuario);

        if(validar_tc_material_usuario=="invalido") {

        }else{
            if(opcion_tc_material_usuario == "CREAR") {
                Accion = 'crear_tc_material_usuario';
            }
            if(opcion_tc_material_usuario == "EDITAR") {
                Accion = 'editar_tc_material_usuario';
            }
            $.ajax({
                url         : "Ajax.php",
                type        : "POST",
                datatype    : "json",    
                data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, tc_material_id:tc_material_id_usuario, tc_categoria1:material_cat1_usuario, tc_categoria2:material_cat2_usuario,tc_categoria3:material_cat3_usuario },    
                success: function(data) {
                    tabla_tc_material_usuario.ajax.reload(null, false);
                }
            });
            $('#modal_crud_tc_material_usuario').modal('hide');
        }
    });
        
    ///:: BOTON BORRAR REGISTRO TC INSPECCION :::::::::::::::::::::::::::::::::::::::::::::///  
    $(document).on("click", ".btn_borrar_tc_material_usuario", function(){
        fila_tc_material_usuario = $(this);           
        tc_material_id_usuario = $(this).closest('tr').find('td:eq(0)').text();     
        rpta_tc_ot = 0;
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminará el registro "+tc_material_id_usuario+"!",
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
                Accion='borrar_tc_material_usuario';
                if (rpta_tc_ot == 1) {            
                    $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",
                    async       : false,    
                    data        : { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,tc_material_id:tc_material_id_usuario },   
                        success: function(data) {
                            tabla_tc_material_usuario.row(fila_tc_material_usuario.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validar_tc_material_usuario(p_tc_material_id_usuario, p_material_cat1_usuario, p_material_cat2_usuario, p_material_cat3_usuario){
    f_limpia_tc_material_usuario();
    let rpta_validar_tc_material_usuario="";    

    if(p_material_cat1_usuario==""){
        $("#material_cat1_usuario").addClass("color-error" );
        rpta_validar_tc_material_usuario = "invalido";    
    }
    if(p_material_cat2_usuario==""){
        $("#material_cat2_usuario").addClass("color-error" );
        rpta_validar_tc_material_usuario = "invalido";    
    }
    if(p_material_cat3_usuario==""){
        $("#material_cat3_usuario").addClass("color-error" );
        rpta_validar_tc_material_usuario = "invalido";    
    }

    return rpta_validar_tc_material_usuario; 
}

///:: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::::::::::::::::::::::::::::::::///
function f_limpia_tc_material_usuario(){
    $("#tc_material_id_usuario").removeClass("color-error" );
    $("#material_cat1_usuario").removeClass("color-error" );
    $("#material_cat2_usuario").removeClass("color-error" );
    $("#material_cat3_usuario").removeClass("color-error" );
}