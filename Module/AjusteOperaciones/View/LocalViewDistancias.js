///:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: DISTANCIAS v 1.0 :::::::::::::::::::::///
///::::::::::::: CREAR, EDITAR, BORRAR TABLA DISTANCIAS ::::::///
///:::::::::::: FECHA: 2022-02-24 12:50 ::::::::::::::::::::::///

///::::::::::::::::::::::::::::::: Declaracion de Variables :::::::::::::::::::::::::::::::///
var Distancias_Id, Dist_Operacion, Dist_Orden, Dist_Sentido, Dist_Servicio, Dist_LugarOrigen, Dist_LugarDestino, Dist_Kilometros;
var opcionDistnacias, filaDistancias, tablaDistancias;

///::::::::::::::::::::::::: DOM CALENDARIO :::::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    let selectHtml="";
    Prog_Operacion='LIMABUS';
    
    Tipo='OPERACION';
    selectHtml = f_TipoTabla(Prog_Operacion,Tipo);
    $("#Dist_Operacion").html(selectHtml);
    
    selectHtml="";
    Tipo='SENTIDO';
    selectHtml = f_TipoTabla(Prog_Operacion,Tipo)
    $("#Dist_Sentido").html(selectHtml);

    $("#Dist_Operacion").on('change', function () {
        Prog_Operacion = $("#Dist_Operacion").val();
        Tipo="SERVICIO";
        selectHtml = "";
        selectHtml = f_TipoTabla(Prog_Operacion,Tipo);
        $("#Dist_Servicio").html(selectHtml);
        Tipo="LUGAR";
        selectHtml = "";
        selectHtml = f_TipoTabla(Prog_Operacion,Tipo);
        $("#Dist_LugarOrigen").html(selectHtml);
        $("#Dist_LugarDestino").html(selectHtml);
    });
    
    // Setup - add a text input to each footer cell
    $('#tablaDistancias thead tr')
        .clone(true)
        .addClass('filtersDistancias')
        .appendTo('#tablaDistancias thead');
   
    Accion='LeerDistancias';
    tablaDistancias = $('#tablaDistancias').DataTable({
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
                    var cell = $('.filtersDistancias th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filtersDistancias th').eq($(api.column(colIdx).header()).index())
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
                className:  'btn btn-success',
                title       : 'MATRIZ DE DISTANCIAS'
            },
        ],
        "ajax":{            
            "url": "Ajax.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{MoS:MoS,NombreMoS:NombreMoS,Accion:Accion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "Distancias_Id"},
            {"data": "Dist_Operacion"},
            {"data": "Dist_Orden"},
            {"data": "Dist_Sentido"},
            {"data": "Dist_Servicio"},
            {"data": "Dist_LugarOrigen"},
            {"data": "Dist_LugarDestino"},
            {"data": "Dist_Kilometros"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarDistancias'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btnBorrarDistancias'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>"}
        ]
    });     

    /// ::::::::::::::: CREAR Y EDITAR CALENDARIO :::::::::::::///
    $('#formDistancias').submit(function(e){                         
        let validacionDistancias="";
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        Distancias_Id = $.trim($('#Distancias_Id').val());    
        Dist_Operacion = $.trim($('#Dist_Operacion').val());
        Dist_Orden = $.trim($('#Dist_Orden').val());
        Dist_Sentido = $.trim($('#Dist_Sentido').val());
        Dist_Servicio = $.trim($('#Dist_Servicio').val());
        Dist_LugarOrigen = $.trim($('#Dist_LugarOrigen').val());
        Dist_LugarDestino = $.trim($('#Dist_LugarDestino').val());    
        Dist_Kilometros = $.trim($('#Dist_Kilometros').val());
        validacionDistancias=validarDistancias(Dist_Operacion,Dist_LugarOrigen,Dist_LugarDestino,Dist_Kilometros);
  
        /// CREAR
        if(opcionDistancias == 1) {
            if(validacionDistancias!="invalido") {   
                Accion='CrearDistancias';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Dist_Operacion:Dist_Operacion,Dist_Orden:Dist_Orden,Dist_Sentido:Dist_Sentido,Dist_Servicio:Dist_Servicio,Dist_LugarOrigen:Dist_LugarOrigen,Dist_LugarDestino:Dist_LugarDestino,Dist_Kilometros:Dist_Kilometros },    
                    success: function(data) {
                        tablaDistancias.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDDistancias').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionDistancias == 2) {
            if(validacionDistancias!="invalido") {   
                Accion='EditarDistancias';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Distancias_Id:Distancias_Id,Dist_Operacion:Dist_Operacion,Dist_Orden:Dist_Orden,Dist_Sentido:Dist_Sentido,Dist_Servicio:Dist_Servicio,Dist_LugarOrigen:Dist_LugarOrigen,Dist_LugarDestino:Dist_LugarDestino,Dist_Kilometros:Dist_Kilometros },    
                    success: function(data) {
                        alert(data);
                        tablaDistancias.ajax.reload(null, false);
                    }
                });
            $('#modalCRUDDistancias').modal('hide');
            } 
        }
    });
});

///:::::::::::::::::::::::::::: BOTONES CALENDARIO ::::::::::::::::::::::::::::::::::::::::::///

///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
$("#btnNuevoDistancias").click(function(){
    opcionDistancias = 1; // Alta 
    LimpiaMsDistancias();
    $("#Distancias_Id").prop('disabled', true);
    $("#formDistancias").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Alta de Distancias");
    $('#modalCRUDDistancias').modal('show');	    
});

///::::::::: EVENTO DEL BOTON EDITAR ::::::::::::::::::::::///       
$(document).on("click", ".btnEditarDistancias", function(){
    let selectHtml="";
    opcionDistancias = 2;// Editar
    LimpiaMsDistancias();
    $("#Distancias_Id").prop('disabled', true);
    $("#formDistancias").trigger("reset");

    filaDistancias = $(this).closest("tr");	        
    Distancias_Id = filaDistancias.find('td:eq(0)').text();
    Dist_Operacion = filaDistancias.find('td:eq(1)').text();
    Dist_Orden = filaDistancias.find('td:eq(2)').text();
    Dist_Sentido = filaDistancias.find('td:eq(3)').text();
    Dist_Servicio = filaDistancias.find('td:eq(4)').text();
    Dist_LugarOrigen = filaDistancias.find('td:eq(5)').text();
    Dist_LugarDestino = filaDistancias.find('td:eq(6)').text();
    Dist_Kilometros = filaDistancias.find('td:eq(7)').text();

    Tipo = 'SERVICIO';
    selectHtml = f_TipoTabla(Dist_Operacion,Tipo);
    $("#Dist_Servicio").html(selectHtml);
    selectHtml = "";
    Tipo = 'LUGAR';
    selectHtml = f_TipoTabla(Dist_Operacion,Tipo);
    alert(selectHtml);
    $("#Dist_LugarOrigen").html(selectHtml);
    $("#Dist_LugarDestino").html(selectHtml);

    $("#Distancias_Id").val(Distancias_Id);
    $("#Dist_Operacion").val(Dist_Operacion);
    $("#Dist_Orden").val(Dist_Orden);
    $("#Dist_Sentido").val(Dist_Sentido);
    $("#Dist_Servicio").val(Dist_Servicio);
    $("#Dist_LugarOrigen").val(Dist_LugarOrigen);
    $("#Dist_LugarDestino").val(Dist_LugarDestino);
    $("#Dist_Kilometros").val(Dist_Kilometros);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Distancias");		
    
    $('#modalCRUDDistancias').modal('show');		   
});

///::::::::  BOTON BORRAR REGISTRO :::::::::::::::::::::::::///  
$(document).on("click", ".btnBorrarDistancias", function(){
    filaDistancias = $(this);           
    Distancias_Id = filaDistancias.closest("tr").find('td:eq(0)').text();     
    let rptaDistanciasBorrar = 0;
    Swal.fire({
        title: '¿Está seguro?',
        text: "Se eliminara el registro "+Distancias_Id+"!",
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
            rptaDistanciasBorrar = 1;
            Accion='BorrarDistancias';
            if (rptaDistanciasBorrar == 1) {            
                $.ajax({
                url: "Ajax.php",
                type: "POST",
                datatype:"json",    
                data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Distancias_Id:Distancias_Id },   
                    success: function() {
                        tablaDistancias.row(filaDistancias.parents('tr')).remove().draw();
                    }
                });
            }
        }
    });
});

///::::::::::::::::::::::::: FUNCIONES CALENDARIO ::::::::::::::::::::::::::::::::::::::::::///

///::::::: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO :::::::::::::::::::///
function validarDistancias(Dist_Servicio,Dist_LugarOrigen,Dist_Orden,Dist_Sentido,Dist_LugarDestino,Dist_Kilometros){
    LimpiaMsDistancias();
    let NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    let rptaValidarDistancias="";    

    if(Dist_Operacion=="") {
        $("#MsDist_Operacion").text("*No puede ser vacio");
        $("#MsDist_Operacion").css("display", "flex" );
        Swal.fire({
            icon: 'error',
            title: 'Servicio...',
            text: '*No puede ser vacio!'
        })
        rptaValidarDistancias="invalido";
    }

    if(Dist_Orden=="") {
        $("#MsDist_Orden").text("*No puede ser vacio");
        $("#MsDist_Orden").css("display", "flex" );
        Swal.fire({
            icon: 'error',
            title: 'Orden...',
            text: '*No puede ser vacio!'
        })
        rptaValidarDistancias="invalido";
    }

    if(Dist_Sentido=="") {
        $("#MsDist_Sentido").text("*No puede ser vacio");
        $("#MsDist_Sentido").css("display", "flex" );
        Swal.fire({
            icon: 'error',
            title: 'Sentido...',
            text: '*No puede ser vacio!'
        })
        rptaValidarDistancias="invalido";
    }

    if(Dist_LugarOrigen=="") {
        $("#MsDist_LugarOrigen").text("*No puede ser vacio");
        $("#MsDist_LugarOrigen").css("display", "flex" );
        Swal.fire({
            icon: 'error',
            title: 'Lugar Origen...',
            text: '*No puede ser vacio!'
        })
        rptaValidarDistancias="invalido";
    }
    
    if(Dist_LugarDestino=="") {
        $("#MsDist_LugarDestino").text("*No puede ser vacio");
        $("#MsDist_LugarDestino").css("display", "flex" );
        Swal.fire({
            icon: 'error',
            title: 'Lugar Destino...',
            text: '*No puede ser vacio!'
        })
        rptaValidarDistancias="invalido";
    }

    if(Dist_Kilometros=="") {
        $("#MsDist_Kilomtros").text("*No puede ser vacio");
        $("#MsDist_Kilomtros").css("display", "flex" );
        Swal.fire({
            icon: 'error',
            title: 'Distancia...',
            text: '*No puede ser vacio!'
        })
        rptaValidarDistancias="invalido";
    }
    
    return rptaValidarDistancias; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function LimpiaMsDistancias(){
    $("#MsDistancias_Id").css("display", "none" );
    $("#MsDist_Operacion").css("display", "none" );
    $("#MsDist_Orden").css("display", "none" );
    $("#MsDist_Sentido").css("display", "none" );
    $("#MsDist_Servicio").css("display", "none" );
    $("#MsDist_LugarOrigen").css("display", "none" );
    $("#MsDist_LugarDestino").css("display", "none" );
    $("#MsDist_Kilomtros").css("display", "none" );
}

function f_TipoTabla(Prog_Operacion,Tipo){
    let rptaSelect="";
    Accion='SelectTipos';
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Prog_Operacion:Prog_Operacion,Tipo:Tipo},    
      success: function(data){
        rptaSelect = data;
      }
    });
    return rptaSelect;
}