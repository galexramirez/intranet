///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var cod_resasoc,ra_nombres,ra_asociado,ttablaotcorrectivas_detalle;
var tablaAsociados, opcionTablaAsociados, filaTablaAsociados;

///::::::::::::: DOM Tipo Tabla OTPtreventivas ::::::::::::::::::::::::::::///
$(document).ready(function(){
    div_tabla = f_CreacionTabla("tablaAsociados","");
    $("#div_tablaAsociados").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaAsociados","");

    // Setup - add a text input to each footer cell
    $('#tablaAsociados thead tr')
        .clone(true)
        .addClass('filtersAsociados')
        .appendTo('#tablaAsociados thead');

    Accion='LeerAsociados';
    tablaAsociados = $('#tablaAsociados').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
            // For each column
            api.columns().eq(0).each(function (colIdx) {
                // Set the header cell to contain the input element
                var cell = $('.filtersAsociados th').eq($(api.column(colIdx).header()).index());
                var title = $(cell).text();
                $(cell).html('<input type="text" placeholder="' + title + '" />');
                // On every keypress in this input
                $('input',$('.filtersAsociados th').eq($(api.column(colIdx).header()).index()) )
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
        language    : idiomaEspanol,
        //Para usar los botones
        responsive  : "true",
        dom         : 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons:[
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'RESPONSABLE DE ASOCIADO'
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

    ///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
    $("#btnNuevoAsociados").click(function(){
        opcionTablaAsociados = 1; // Alta 
        LimpiaMsTablaAsociados();
        $("#cod_resasoc").prop('disabled', true);
        $("#formAsociados").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text( "Alta de Tabla Asociados");
        $('#modalCRUDAsociados').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarAsociados", function(){
        opcionTablaAsociados = 2;// Editar
        LimpiaMsTablaAsociados();
        $("#cod_resasoc").prop('disabled', true);
        filaTablaAsociados = $(this).closest("tr");	        
        cod_resasoc = filaTablaAsociados.find('td:eq(0)').text();
        ra_nombres = filaTablaAsociados.find('td:eq(1)').text();
        ra_ruc_asociado = filaTablaAsociados.find('td:eq(2)').text();
        ra_asociado = filaTablaAsociados.find('td:eq(3)').text();

        $("#cod_resasoc").val(cod_resasoc);
        $("#ra_nombres").val(ra_nombres);
        $("#ra_ruc_asociado").val(ra_ruc_asociado)
        $("#ra_asociado").val(ra_asociado);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Asociados");		
    
        $('#modalCRUDAsociados').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formAsociados').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        cod_resasoc = $.trim($('#cod_resasoc').val());    
        ra_nombres = $.trim($('#ra_nombres').val());
        ra_ruc_asociado = $.trim($('#ra_ruc_asociado').val());    
        ra_asociado = $.trim($('#ra_asociado').val());    
    
        validacionTablaAsociados=validarTablaAsociados(cod_resasoc,ra_nombres,ra_asociado);

        /// CREAR
        if(opcionTablaAsociados == 1) {
            if(validacionTablaAsociados!="invalido") {   
                // Nombre
                Accion='CrearAsociados';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_resasoc:cod_resasoc,ra_nombres:ra_nombres,ra_asociado:ra_asociado, ra_ruc_asociado:ra_ruc_asociado },    
                    success: function(data) {
                        tablaAsociados.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDAsociados').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTablaAsociados == 2) {
            if(validacionTablaAsociados!="invalido") {   
                // Nombre
                Accion='EditarAsociados';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_resasoc:cod_resasoc,ra_nombres:ra_nombres,ra_asociado:ra_asociado, ra_ruc_asociado:ra_ruc_asociado },    
                    success: function(data) {
                        tablaAsociados.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDAsociados').modal('hide');
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarAsociados", function(){
        fila = $(this);           
        cod_resasoc = $(this).closest('tr').find('td:eq(0)').text();     
        respuestaTablaAsociados = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminará el registro "+cod_resasoc+"!",
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
                respuestaTablaAsociados = 1;
                // Nombre
                Accion='BorrarAsociados';
                if (respuestaTablaAsociados == 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",
                    async: false,    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cod_resasoc:cod_resasoc },   
                        success: function(data) {
                            tablaAsociados.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarTablaAsociados(cod_resasoc,ra_nombres,ra_asociado){
    LimpiaMsTablaAsociados();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var respuestaAsociados="";    

    return respuestaAsociados; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsTablaAsociados(){
    $("#Mscod_resasoc").css("display", "none" );
    $("#Msra_nombres").css("display", "none" );
    $("#Msra_asociado").css("display", "none" );
}