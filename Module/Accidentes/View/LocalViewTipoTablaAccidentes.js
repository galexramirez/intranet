///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: AJUSTES DE INFORME DE NOVEDADES :::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:: CRUD TABLA AJUSTES DE INFORME DE NOVEDADES v 2.0 2023-09-13 :::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///:: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
var tablaTipoTablaAccidentes;

///:: JS DOM AJUSTES DE INFORME DE NOVEDADES ::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tablas = f_CreacionTabla("tablaTipoTablaAccidentes","");
    $('#div_tablaTipoTablaAccidentes').html(div_tablas);
    columnastabla = f_ColumnasTabla("tablaTipoTablaAccidentes","");

    // Setup - add a text input to each footer cell
    $('#tablaTipoTablaAccidentes thead tr')
        .clone(true)
        .addClass('filtersTipoTablaAccidentes')
        .appendTo('#tablaTipoTablaAccidentes thead');

    Accion='LeerTipoTablaAccidentes';
    tablaTipoTablaAccidentes = $('#tablaTipoTablaAccidentes').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersTipoTablaAccidentes th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersTipoTablaAccidentes th').eq($(api.column(colIdx).header()).index()) )
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
        language    : idiomaEspanol,
        responsive  : "true",
        dom         : 'Blfrtip',
        buttons     : [
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'AJUSTE ANALISIS DE NOVEDADES'
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

    ///:: INICIO BOTONES DE AJUSTES DE INFORME DE NOVEDADES :::::::::::::::::::::::::::::::///
    
    ///:: EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $("#btnNuevoTipoTablaAccidentes").click(function(){
        opcionTablaAccidentes = 1; // Alta 
        LimpiaMsTablaAccidentes();
        $("#TtablaAccidentes_Id").prop('disabled', true);
        $("#formTipoTablaAccidentes").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla Accidentes");
        $('#modalCRUDTipoTablaAccidentes').modal('show');	    
    });
    ///:: FIN EVENTO DEL BOTON NUEVO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnEditarTipoTablaAccidentes", function(){
        opcionTablaAccidentes = 2;// Editar
        LimpiaMsTablaAccidentes();
        $("#TtablaAccidentes_Id").prop('disabled', true);
        fila = $(this).closest("tr");	        
        TtablaAccidentes_Id = fila.find('td:eq(0)').text();
        TtablaAccidentes_Operacion = fila.find('td:eq(1)').text();
        TtablaAccidentes_Tipo = fila.find('td:eq(2)').text();
        TtablaAccidentes_Detalle = fila.find('td:eq(3)').text();

        $("#TtablaAccidentes_Id").val(TtablaAccidentes_Id);
        $("#TtablaAccidentes_Tipo").val(TtablaAccidentes_Tipo);
        $("#TtablaAccidentes_Operacion").val(TtablaAccidentes_Operacion);
        $("#TtablaAccidentes_Detalle").val(TtablaAccidentes_Detalle);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Accidentes");		
    
        $('#modalCRUDTipoTablaAccidentes').modal('show');		   
    });
    ///:: FIN BOTON EDITAR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: CREA Y EDITA AJUSTE DE INFORME DE NOVEDADES :::::::::::::::::::::::::::::::::::::///
    $('#formTipoTablaAccidentes').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        TtablaAccidentes_Id = $.trim($('#TtablaAccidentes_Id').val());    
        TtablaAccidentes_Tipo = $.trim($('#TtablaAccidentes_Tipo').val());
        TtablaAccidentes_Operacion = $.trim($('#TtablaAccidentes_Operacion').val());    
        TtablaAccidentes_Detalle = $.trim($('#TtablaAccidentes_Detalle').val());
    
        validacionTablaAccidentes=validarTablaAccidentes(TtablaAccidentes_Id,TtablaAccidentes_Tipo,TtablaAccidentes_Operacion,TtablaAccidentes_Detalle);
          
        if(opcionTablaAccidentes == 1) {Accion='CrearTipoTablaAccidentes';} /// CREAR 
        if(opcionTablaAccidentes == 2) {Accion='EditarTipoTablaAccidentes';} /// EDITAR
        
        if(validacionTablaAccidentes!="invalido") {   
            $.ajax({
                url: "Ajax.php",
                type: "POST",
                datatype:"json",    
                data:  { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, TtablaAccidentes_Id:TtablaAccidentes_Id, TtablaAccidentes_Tipo:TtablaAccidentes_Tipo, TtablaAccidentes_Operacion:TtablaAccidentes_Operacion,TtablaAccidentes_Detalle:TtablaAccidentes_Detalle },
                success: function(data) {
                    tablaTipoTablaAccidentes.ajax.reload(null, false);
                }
            });
            $('#modalCRUDTipoTablaAccidentes').modal('hide');
        } 
    });
    ///:: FIN CREA Y EDITA AJUSTE DE INFORME DE NOVEDADES :::::::::::::::::::::::::::::::::///    
    
    ///:: BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///  
    $(document).on("click", ".btnBorrarTipoTablaAccidentes", function(){
        fila = $(this);           
        TtablaAccidentes_Id = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaAccidentes = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+TtablaAccidentes_Id+"!",
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
                respuestaTablaAccidentes = 1;
                Accion='BorrarTipoTablaAccidentes';
                if (respuestaTablaAccidentes == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,TtablaAccidentes_Id:TtablaAccidentes_Id },   
                        success: function(data) {
                            tablaTipoTablaAccidentes.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });
    ///:: FIN BOTON BORRAR REGISTRO :::::::::::::::::::::::::::::::::::::::::::::::::::::::///  

    ///:: TERMINO BOTONES DE AJUSTES DE INFORME DE NOVEDADES ::::::::::::::::::::::::::::::///

});
///:: TERMINO JS DOM AJUSTES DE INFORME DE NOVEDADES ::::::::::::::::::::::::::::::::::::::///

///:: FUNCIONES DE AJUSTES DE INFORME DE NOVEDADES ::::::::::::::::::::::::::::::::::::::::///

///:: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::::::///
function validarTablaAccidentes(TtablaAccidentes_Id,TtablaAccidentes_Tipo,TtablaAccidentes_Operacion,TtablaAccidentes_Detalle){
    LimpiaMsTablaAccidentes();

    let rpta_valida_ajuste="";    

    if(TtablaAccidentes_Operacion==""){
        $("#TtablaAccidentes_Operacion").addClass("color-error");    
        rpta_valida_ajuste = "invalido"
    }
    if(TtablaAccidentes_Tipo==""){
        $("#TtablaAccidentes_Tipo").addClass("color-error");    
        rpta_valida_ajuste = "invalido"
    }
    if(TtablaAccidentes_Detalle==""){
        $("#TtablaAccidentes_Detalle").addClass("color-error");    
        rpta_valida_ajuste = "invalido"
    }

    return rpta_valida_ajuste; 
}
///:: FIN FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::::::::///

///:: REESTABLE DE COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::::::/// 
function LimpiaMsTablaAccidentes(){
    $("#TtablaAccidentes_Tipo").removeClass("color-error");
    $("#TtablaAccidentes_Operacion").removeClass("color-error");
    $("#TtablaAccidentes_Detalle").removeClass("color-error");
}
///:: FIN REESTABLE DE COLOR DE FONDO DE LOS CAMPOS DEL FORMULARIO ::::::::::::::::::::::::///

///:: TERMINO FUNCIONES DE AJUSTES DE INFORME DE NOVEDADES ::::::::::::::::::::::::::::::::///