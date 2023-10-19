///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: AJUSTES DE CONTROL FACILITADOR v 2.0  :::::::::::::::::::::::::::::::::::::::::::::::///
///:: CREAR, EDITAR, ELIMINAR AJUSTES DE CONTROL FACILITADOR ::::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaTipoTablas, opcion_ajustes, fila_ajustes;

///:: JS DOM AJUSTES DE CONTROL FACILITADOR :::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tablas = f_CreacionTabla("tablaTipoTablas","");
    $('#div_tablaTipoTablas').html(div_tablas);
    columnastabla = f_ColumnasTabla("tablaTipoTablas","");

    // Setup - add a text input to each footer cell
    $('#tablaTipoTablas thead tr')
        .clone(true)
        .addClass('filters_tablaTipoTablas')
        .appendTo('#tablaTipoTablas thead');

    Accion = 'LeerTipoTablas';
    tablaTipoTablas = $('#tablaTipoTablas').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters_tablaTipoTablas th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters_tablaTipoTablas th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        
        language            : idiomaEspanol,
        responsive          : "true",
        dom                 : 'Blfrtip',
        buttons:[
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'AJUSTES DE CONTROL FACILITADOR'
            },
        ],
        "ajax":{            
                "url"       : "Ajax.php", 
                "method"    : 'POST',
                "data"      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},
                "dataSrc"   : ""
                },
        "columns": columnastabla
    });     

    ///:: INICIO BOTONES DE AJUSTES DE CONTROL FACILITADOR ::::::::::::::::::::::::::::::::///
    
    ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnNuevoTipoTablas", function(){
        $("#formTipoTablas").trigger("reset");
        opcion_ajustes = "CREAR"; 
        f_limpia_tablas();
        $("#btnGuardarTipoTablas").prop("disabled",false);
       
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Ajustes");
        $('#modalCRUDTipoTablas').modal('show');	    
    });
    ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnEditarTipoTablas", function(){
        opcion_ajustes = "EDITAR";
        f_limpia_tablas();
        $("#btnGuardarTipoTablas").prop("disabled",false);

        fila_ajustes = $(this).closest("tr");	        
        Ttabla_Id = fila_ajustes.find('td:eq(0)').text();
        Ttabla_Operacion = fila_ajustes.find('td:eq(1)').text();
        Ttabla_Tipo = fila_ajustes.find('td:eq(2)').text();
        Ttabla_Detalle = fila_ajustes.find('td:eq(3)').text();

        $("#Ttabla_Id").val(Ttabla_Id);
        $("#Ttabla_Tipo").val(Ttabla_Tipo);
        $("#Ttabla_Operacion").val(Ttabla_Operacion);
        $("#Ttabla_Detalle").val(Ttabla_Detalle);
        
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Ajustes");		
        
        $('#modalCRUDTipoTablas').modal('show');
    });
    ///:: FIN EVENTO DEL BOTON EDITAR :::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: CREA Y EDITA AJUSTES DE CONTROL FACILITADOR :::::::::::::::::::::::::::::::::::::///
    $('#formTipoTablas').submit(function(e){
        let validacion_ajustes = "";
        e.preventDefault();
        Ttabla_Id = $.trim($('#Ttabla_Id').val());    
        Ttabla_Tipo = $.trim($('#Ttabla_Tipo').val());
        Ttabla_Operacion = $.trim($('#Ttabla_Operacion').val());    
        Ttabla_Detalle = $.trim($('#Ttabla_Detalle').val());

        validacion = validarTablas(Ttabla_Id,Ttabla_Tipo,Ttabla_Operacion,Ttabla_Detalle);
  
        if(opcion_ajustes == "CREAR") {
            Accion='CrearTipoTablas';
        }
        if(opcion_ajustes == "EDITAR") {
            Accion='EditarTipoTablas';
        }
        if(validacion_ajustes!="invalido") {   
            $("#btnGuardarTipoTablas").prop("disabled",true);
            $.ajax({
                url         : "Ajax.php",
                type        : "POST",
                datatype    : "json",    
                data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Ttabla_Id:Ttabla_Id, Ttabla_Tipo:Ttabla_Tipo, Ttabla_Operacion:Ttabla_Operacion, Ttabla_Detalle:Ttabla_Detalle },    
                    success: function(data) {
                    tablaTipoTablas.ajax.reload(null, false);
                }
            });
            $('#modalCRUDTipoTablas').modal('hide');
        } 
    });
    ///:: FIN CREA Y EDITA AJUSTES DE CONTROL FACILITADOR :::::::::::::::::::::::::::::::::::::///
        
    ///:: BOTON BORRAR REGISTRO AJUSTES DE CONTROL FACILITADOR ::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnBorrarTipoTablas", function(){
        fila_ajustes = $(this);           
        Ttabla_Id = $(this).closest('tr').find('td:eq(0)').text();     

        let respuesta_borrar = 0;
        Swal.fire({
            title               : '¿Está seguro?',
            text                : "Se eliminara el registro "+Ttabla_Id+"!",
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
                respuesta_borrar = 1;
                Accion = 'BorrarTipoTablas';
    
                if (respuesta_borrar == 1) {            
                    $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    :"json",    
                    data        :  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Ttabla_Id:Ttabla_Id },   
                        success : function() {
                            tablaTipoTablas.ajax.reload(null, false);
                            //tablaTipoTablas.row(fila_ajustes.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });
    ///:: FIN BOTON BORRAR REGISTRO AJUSTES DE CONTROL FACILITADOR ::::::::::::::::::::::::///

    ///:: TERMINO BOTONES DE AJUSTES DE CONTROL FACILITADOR :::::::::::::::::::::::::::::::///
});
///:: TERMINO JS DOM AJUSTES DE CONTROL FACILITADOR :::::::::::::::::::::::::::::::::::::::///


///:: FUNCIONES DE AJUSTES DE CONTROL FACILITADOR :::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function validarTablas(Ttabla_Id,Ttabla_Tipo,Ttabla_Operacion,Ttabla_Detalle){
    f_limpia_tablas();
    let respuesta_ajustes="";

    if(Ttabla_Tipo===""){
        $("#Ttabla_Tipo").addClass("color-error");
        respuesta_ajustes = "invalido";    
    }
    if(Ttabla_Operacion===""){
        $("#Ttabla_Operacion").addClass("color-error");
        respuesta_ajustes = "invalido";    
    }
    if(Ttabla_Detalle===""){
        $("#Ttabla_Detalle").addClass("color-error");
        respuesta_ajustes = "invalido";    
    }

    return respuesta_ajustes; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: ESTABLECE EL COLOR POR DEFECTO DE LOS CAMPOS EDITADOS EN EL FORMULARIO ::::::::::::::/// 
function f_limpia_tablas(){
    $("#Ttabla_Tipo").removeClass("color-error" );
    $("#Ttabla_Operacion").removeClass("color-error" );
    $("#Ttabla_Detalle").removeClass("color-error" );
}
///:: FIN ESTABLECE EL COLOR POR DEFECTO DE LOS CAMPOS EDITADOS EN EL FORMULARIO ::::::::::///

///:: TERMINO FUNCIONES DE AJUSTES DE CONTROL FACILITADOR :::::::::::::::::::::::::::::::::///