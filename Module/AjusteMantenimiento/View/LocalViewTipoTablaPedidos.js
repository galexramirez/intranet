///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var ttablapedidos_id,ttablapedidos_tipo,ttablapedidos_operacion,ttablapedidos_detalle;
var tablaTipoTablaPedidos, opcionTablaPedidos, filaTablaPedidos;

///::::::::::::: DOM Tipo Tabla OTPtreventivas ::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tablaTipoTablaPedidos","");
    $("#div_tablaTipoTablaPedidos").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaTipoTablaPedidos","");

    // Setup - add a text input to each footer cell
    $('#tablaTipoTablaPedidos thead tr')
        .clone(true)
        .addClass('filtersTipoTablaPedidos')
        .appendTo('#tablaTipoTablaPedidos thead');

    Accion='LeerTipoTablaPedidos';
    tablaTipoTablaPedidos = $('#tablaTipoTablaPedidos').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersTipoTablaPedidos th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersTipoTablaPedidos th').eq($(api.column(colIdx).header()).index()) )
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
        
        //Para cambiar el lenguaje a español
        language: idiomaEspanol,
        //Para usar los botones
        responsive: "true",
        dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons:[
            {
                extend:     'excelHtml5',
                text:       '<i class="fas fa-file-excel"></i> ',
                titleAttr:  'Exportar a Excel',
                className:  'btn btn-success'
            },
            {
                extend:     'pdfHtml5',
                text:       '<i class="fas fa-file-pdf"></i> ',
                titleAttr:  'Exportar a PDF',
                className:  'btn btn-danger'
            },
            {
                extend:     'print',
                text:       '<i class="fa fa-print"></i> ',
                titleAttr:  'Imprimir',
                className:  'btn btn-info'
            },
        ],
        "ajax":{            
            "url": "Ajax.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns": columnastabla
    });     

    ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
    $("#btnNuevoTipoTablaPedidos").click(function(){
        opcionTablaPedidos = 1; // Alta 
        LimpiaMsTablaPedidos();
        $("#ttablapedidos_id").prop('disabled', true);
        $("#formTipoTablaPedidos").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla Pedidos");
        $('#modalCRUDTipoTablaPedidos').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarTipoTablaPedidos", function(){
        opcionTablaPedidos = 2;// Editar
        LimpiaMsTablaPedidos();
        $("#ttablapedidos_id").prop('disabled', true);
        filaTablaPedidos = $(this).closest("tr");	        
        ttablapedidos_id = filaTablaPedidos.find('td:eq(0)').text();
        ttablapedidos_operacion = filaTablaPedidos.find('td:eq(1)').text();
        ttablapedidos_tipo = filaTablaPedidos.find('td:eq(2)').text();
        ttablapedidos_detalle = filaTablaPedidos.find('td:eq(3)').text();

        $("#ttablapedidos_id").val(ttablapedidos_id);
        $("#ttablapedidos_tipo").val(ttablapedidos_tipo);
        $("#ttablapedidos_operacion").val(ttablapedidos_operacion);
        $("#ttablapedidos_detalle").val(ttablapedidos_detalle);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Pedidos");		
    
        $('#modalCRUDTipoTablaPedidos').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formTipoTablaPedidos').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        ttablapedidos_id = $.trim($('#ttablapedidos_id').val());    
        ttablapedidos_tipo = $.trim($('#ttablapedidos_tipo').val());
        ttablapedidos_operacion = $.trim($('#ttablapedidos_operacion').val());    
        ttablapedidos_detalle = $.trim($('#ttablapedidos_detalle').val());
    
        validacionTablaPedidos=validarTablaPedidos(ttablapedidos_id,ttablapedidos_tipo,ttablapedidos_operacion,ttablapedidos_detalle);

        /// CREAR
        if(opcionTablaPedidos == 1) {
            if(validacionTablaPedidos!="invalido") {   
                // Nombre
                Accion='CrearTipoTablaPedidos';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablapedidos_id:ttablapedidos_id,ttablapedidos_tipo:ttablapedidos_tipo,ttablapedidos_operacion:ttablapedidos_operacion,ttablapedidos_detalle:ttablapedidos_detalle },    
                    success: function(data) {
                        tablaTipoTablaPedidos.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaPedidos').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTablaPedidos == 2) {
            if(validacionTablaPedidos!="invalido") {   
                // Nombre
                Accion='EditarTipoTablaPedidos';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablapedidos_id:ttablapedidos_id,ttablapedidos_tipo:ttablapedidos_tipo,ttablapedidos_operacion:ttablapedidos_operacion,ttablapedidos_detalle:ttablapedidos_detalle },    
                    success: function(data) {
                        tablaTipoTablaPedidos.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoTablaPedidos').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarTipoTablaPedidos", function(){
        fila = $(this);           
        ttablapedidos_id = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaPedidos = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+ttablapedidos_id+"!",
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
                respuestaTablaPedidos = 1;
                // Nombre
                Accion='BorrarTipoTablaPedidos';
                if (respuestaTablaPedidos == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,ttablapedidos_id:ttablapedidos_id },   
                        success: function(data) {
                            tablaTipoTablaPedidos.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarTablaPedidos(ttablapedidos_id,ttablapedidos_tipo,ttablapedidos_operacion,ttablapedidos_detalle){
    LimpiaMsTablaPedidos();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var respuestaPedidos="";    

    return respuestaPedidos; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsTablaPedidos(){
    $("#Msttablapedidos_id").css("display", "none" );
    $("#Msttablapedidos_tipo").css("display", "none" );
    $("#Msttablapedidos_operacion").css("display", "none" );
    $("#Msttablapedidos_detalle").css("display", "none" );
}