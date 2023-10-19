///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: AJUSTES DE INASISTENCIAS v 2.0  :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR AJUSTES DE INASISTENCIAS ::::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaTipoTablaInasistencias, opcionTablaInasistencias, fila_ajustes;

///:: JS DOM AJUSTES DE INASISTENCIAS :::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tablas = f_CreacionTabla("tablaTipoTablaInasistencias","");
    $('#div_tablaTipoTablaInasistencias').html(div_tablas);
    columnastabla = f_ColumnasTabla("tablaTipoTablaInasistencias","");

    // Setup - add a text input to each footer cell
    $('#tablaTipoTablaInasistencias thead tr')
        .clone(true)
        .addClass('filtersTipoTablaInasistencias')
        .appendTo('#tablaTipoTablaInasistencias thead');

    Accion='LeerTipoTablaInasistencias';
    tablaTipoTablaInasistencias = $('#tablaTipoTablaInasistencias').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersTipoTablaInasistencias th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersTipoTablaInasistencias th').eq($(api.column(colIdx).header()).index()) )
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
                title       : 'AJUSTES DE INASISTENCIAS'
            },
        ],
        "ajax"          : {
            "url"       : "Ajax.php", 
            "method"    : 'POST',
            "data"      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},
            "dataSrc"   : ""
        },
        "columns"       : columnastabla
    });     

    ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
    $(document).on("click", ".btnNuevoTipoTablaInasistencias", function(){
        $("#formTipoTablaInasistencias").trigger("reset");
        opcionTablaInasistencias = "CREAR";
        f_limpia_ajustes();
        $("#btnGuardarTipoTablaInasistencias").prop("disabled",false);

        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Ajustes");
        $('#modalCRUDTipoTablaInasistencias').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarTipoTablaInasistencias", function(){
        opcionTablaInasistencias = "EDITAR";
        f_limpia_ajustes();
        fila_ajustes = $(this).closest("tr");	        
        TtablaInasistencias_Id = fila_ajustes.find('td:eq(0)').text();
        TtablaInasistencias_Operacion = fila_ajustes.find('td:eq(1)').text();
        TtablaInasistencias_Tipo = fila_ajustes.find('td:eq(2)').text();
        TtablaInasistencias_Detalle = fila_ajustes.find('td:eq(3)').text();

        $("#TtablaInasistencias_Id").val(TtablaInasistencias_Id);
        $("#TtablaInasistencias_Tipo").val(TtablaInasistencias_Tipo);
        $("#TtablaInasistencias_Operacion").val(TtablaInasistencias_Operacion);
        $("#TtablaInasistencias_Detalle").val(TtablaInasistencias_Detalle);
        $("#btnGuardarTipoTablaInasistencias").prop("disabled",false);

        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Ajustes");		
    
        $('#modalCRUDTipoTablaInasistencias').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formTipoTablaInasistencias').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        TtablaInasistencias_Id = $.trim($('#TtablaInasistencias_Id').val());    
        TtablaInasistencias_Tipo = $.trim($('#TtablaInasistencias_Tipo').val());
        TtablaInasistencias_Operacion = $.trim($('#TtablaInasistencias_Operacion').val());    
        TtablaInasistencias_Detalle = $.trim($('#TtablaInasistencias_Detalle').val());
    
        validacionTablaInasistencias=validarTablaInasistencias(TtablaInasistencias_Id,TtablaInasistencias_Tipo,TtablaInasistencias_Operacion,TtablaInasistencias_Detalle);

        /// CREAR
        if(opcionTablaInasistencias == "CREAR") {
            Accion='CrearTipoTablaInasistencias';
        }
        if(opcionTablaInasistencias == "EDITAR") {
            Accion='EditarTipoTablaInasistencias';
        }
        if(validacionTablaInasistencias!="invalido") {
            $("#btnGuardarTipoTablaInasistencias").prop("disabled",true);
            $.ajax({
                url: "Ajax.php",
                type: "POST",
                datatype:"json",    
                data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaInasistencias_Id:TtablaInasistencias_Id,TtablaInasistencias_Tipo:TtablaInasistencias_Tipo,TtablaInasistencias_Operacion:TtablaInasistencias_Operacion,TtablaInasistencias_Detalle:TtablaInasistencias_Detalle },    
                success: function(data) {
                    tablaTipoTablaInasistencias.ajax.reload(null, false);
                }
            });
            $('#modalCRUDTipoTablaInasistencias').modal('hide');
        } 
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarTipoTablaInasistencias", function(){
        fila_ajustes = $(this);           
        TtablaInasistencias_Id = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaInasistencias = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+TtablaInasistencias_Id+"!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro se ha sido eliminado.',
                    'success'
                )
                respuestaTablaInasistencias = 1;
                Accion='BorrarTipoTablaInasistencias';
                if (respuestaTablaInasistencias == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaInasistencias_Id:TtablaInasistencias_Id },   
                        success: function(data) {
                            tablaTipoTablaInasistencias.ajax.reload(null, false);
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarTablaInasistencias(TtablaInasistencias_Id,TtablaInasistencias_Tipo,TtablaInasistencias_Operacion,TtablaInasistencias_Detalle){
    f_limpia_ajustes();

    var respuesta_ajustes="";

    if(TtablaInasistencias_Tipo==""){
        $("#TtablaInasistencias_Tipo").addClass("color-error" );
        respuesta_ajustes = "invalido"
    }
    if(TtablaInasistencias_Operacion==""){
        $("#TtablaInasistencias_Operacion").addClass("color-error" );
        respuesta_ajustes = "invalido"
    }
    if(TtablaInasistencias_Detalle==""){
        $("#TtablaInasistencias_Detalle").addClass("color-error" );
        respuesta_ajustes = "invalido"
    }

    return respuesta_ajustes; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_limpia_ajustes(){
    $("#TtablaInasistencias_Tipo").removeClass("color-error" );
    $("#TtablaInasistencias_Operacion").removeClass("color-error" );
    $("#TtablaInasistencias_Detalle").removeClass("color-error" );
}