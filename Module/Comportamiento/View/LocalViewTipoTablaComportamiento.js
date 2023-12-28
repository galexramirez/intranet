///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: AJUSTES DE COMPORTAMIENTO v 2.0  ::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR AJUSTES DE COMPORTAMIENTO :::::::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaTipoTablaComportamiento, opcion_ajustes, fila_ajustes;

///:: JS DOM AJUSTES DE COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tablas = f_CreacionTabla("tablaTipoTablaComportamiento","");
    $('#div_tablaTipoTablaComportamiento').html(div_tablas);
    columnastabla = f_ColumnasTabla("tablaTipoTablaComportamiento","");

    // Setup - add a text input to each footer cell
    $('#tablaTipoTablaComportamiento thead tr')
        .clone(true)
        .addClass('filters_TipoTablaComportamiento')
        .appendTo('#tablaTipoTablaComportamiento thead');

    Accion='LeerTipoTablaComportamiento';
    tablaTipoTablaComportamiento = $('#tablaTipoTablaComportamiento').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filters_TipoTablaComportamiento th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filters_TipoTablaComportamiento th').eq($(api.column(colIdx).header()).index()) )
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
        language            : idiomaEspanol,
        responsive          : "true",
        dom                 : 'Blfrtip',
        buttons             : [
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'AJUSTES DE COMPORTAMIENTO'
            },
        ],
        "ajax":{            
            "url"       : "Ajax.php", 
            "method"    : 'POST', //usamos el metodo POST
            "data"      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc"   : ""
        },
        "columns"       : columnastabla
    });     

    ///:: INICIO BOTONES DE AJUSTES DE COMPORTAMIENTO :::::::::::::::::::::::::::::::::::::///
    
    ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnNuevoTipoTablaComportamiento", function(){
        $("#formTipoTablaComportamiento").trigger("reset");
        opcion_ajustes = "CREAR";
        f_limpia_ajustes();
        $("#btnGuardarTipoTablaComportamiento").prop("disabled",false);

        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Ajustes");
        $('#modalCRUDTipoTablaComportamiento').modal('show');	    
    });
    ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON EDITAR AJUSTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarTipoTablaComportamiento", function(){
        opcion_ajustes = "EDITAR";
        f_limpia_ajustes();
        $("#btnGuardarTipoTablaComportamiento").prop("disabled",false);

        fila_ajustes = $(this).closest("tr");	        
        TtablaComportamiento_Id = fila_ajustes.find('td:eq(0)').text();
        TtablaComportamiento_Operacion = fila_ajustes.find('td:eq(1)').text();
        TtablaComportamiento_Tipo = fila_ajustes.find('td:eq(2)').text();
        TtablaComportamiento_Detalle = fila_ajustes.find('td:eq(3)').text();

        $("#TtablaComportamiento_Id").val(TtablaComportamiento_Id);
        $("#TtablaComportamiento_Tipo").val(TtablaComportamiento_Tipo);
        $("#TtablaComportamiento_Operacion").val(TtablaComportamiento_Operacion);
        $("#TtablaComportamiento_Detalle").val(TtablaComportamiento_Detalle);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Ajustes");		
    
        $('#modalCRUDTipoTablaComportamiento').modal('show');		   
    });
    ///:: FIN BOTON EDITAR AJUSTES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: CREA Y EDITA AJUSTES DE COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::///
    $('#formTipoTablaComportamiento').submit(function(e){
        e.preventDefault();
        let validacionTablaComportamiento = "";
        TtablaComportamiento_Id = $.trim($('#TtablaComportamiento_Id').val());    
        TtablaComportamiento_Tipo = $.trim($('#TtablaComportamiento_Tipo').val());
        TtablaComportamiento_Operacion = $.trim($('#TtablaComportamiento_Operacion').val());    
        TtablaComportamiento_Detalle = $.trim($('#TtablaComportamiento_Detalle').val());
    
        validacionTablaComportamiento = f_validart_ajustes(TtablaComportamiento_Id,TtablaComportamiento_Tipo,TtablaComportamiento_Operacion,TtablaComportamiento_Detalle);

        /// CREAR
        if(opcion_ajustes == "CREAR") {
            Accion='CrearTipoTablaComportamiento';
        }
        if(opcion_ajustes == "EDITAR") {
            Accion='EditarTipoTablaComportamiento';
        }

        if(validacionTablaComportamiento!="invalido") {
            $("#btnGuardarTipoTablaComportamiento").prop("disabled",true);
            $.ajax({
                url     : "Ajax.php",
                type    : "POST",
                datatype: "json",
                async   : false,    
                data    : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, TtablaComportamiento_Id:TtablaComportamiento_Id, TtablaComportamiento_Tipo:TtablaComportamiento_Tipo, TtablaComportamiento_Operacion:TtablaComportamiento_Operacion, TtablaComportamiento_Detalle:TtablaComportamiento_Detalle },    
                success: function(data) {
                    tablaTipoTablaComportamiento.ajax.reload(null, false);
                }
            });
            $('#modalCRUDTipoTablaComportamiento').modal('hide'); 
        }
    });
    ///:: FIN CREA Y EDITA AJUSTES DE COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::///
    
    ///:: BOTON BORRAR REGISTRO DE AJUSTES DE COMPORTAMIENTO ::::::::::::::::::::::::::::::/// 
    $(document).on("click", ".btnBorrarTipoTablaComportamiento", function(){
        fila_ajustes = $(this);           
        TtablaComportamiento_Id = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaComportamiento = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+TtablaComportamiento_Id+"!",
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
                respuestaTablaComportamiento = 1;
                Accion='BorrarTipoTablaComportamiento';
                if (respuestaTablaComportamiento == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaComportamiento_Id:TtablaComportamiento_Id },   
                        success: function(data) {
                            tablaTipoTablaComportamiento.row(fila_ajustes.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });
    ///:: FIN BOTON BORRAR REGISTRO DE AJUSTES DE COMPORTAMIENTO ::::::::::::::::::::::::::/// 
    
    ///:: TERMINO BOTONES DE AJUSTES DE COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM AJUSTES DE COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE AJUSTES DE COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function f_validart_ajustes(TtablaComportamiento_Id,TtablaComportamiento_Tipo,TtablaComportamiento_Operacion,TtablaComportamiento_Detalle){
    f_limpia_ajustes();

    let respuestaComportamiento="";

    if(TtablaComportamiento_Tipo==""){
        $("#TtablaComportamiento_Tipo").addClass("color-error");
        respuestaComportamiento = "invalido";
    }

    if(TtablaComportamiento_Operacion==""){
        $("#TtablaComportamiento_Operacion").addClass("color-error");
        respuestaComportamiento = "invalido";
    }

    if(TtablaComportamiento_Detalle==""){
        $("#TtablaComportamiento_Detalle").addClass("color-error");
        respuestaComportamiento = "invalido";
    }

    return respuestaComportamiento; 
}

///:: ESTABLECE EL COLOR NORMAL DE LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::::/// 
function f_limpia_ajustes(){
    $("#TtablaComportamiento_Tipo").removeClass("color-error");
    $("#TtablaComportamiento_Operacion").removeClass("color-error");
    $("#TtablaComportamiento_Detalle").removeClass("color-error");
}
///:: FIN ESTABLECE EL COLOR NORMAL DE LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::/// 

///:: TERMINO FUNCIONES DE AJUSTES DE COMPORTAMIENTO ::::::::::::::::::::::::::::::::::::::///