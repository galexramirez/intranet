var tipocambio_id, tipocambio_fecha, tipocambio_moneda, tipocambio_tipo, tipocambio_valor;
var tipocambio_url, tipocambio_fechainicio, tipocambio_fechafin, tipocambio_monedacarga;
var opcionTipoCambio;

$(document).ready(function(){

    Accion='LeerTipoCambio';
      
    tablaTipoCambio = $('#tablaTipoCambio').DataTable({
        //Para cambiar el lenguaje a español
        language: idiomaEspanol,
        //Para usar los botones
        responsive: "true",
        dom: 'Blfrtip', // Con Botones Excel,Pdf,Print
        //  dom: 'lfrtip', // Sin Botones Excel,Pdf,Print
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
        "columns":[
                    {"data": "tipocambio_id"},
                    {"data": "tipocambio_fecha"},
                    {"data": "tipocambio_moneda"},
                    {"data": "tipocambio_tipo"},
                    {"data": "tipocambio_valor"},
                    {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarTipoCambio'><i class='bi bi-pencil'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'><path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/></svg></i></button><button class='btn btn-danger btn-sm btnBorrarTipoCambio'><i class='bi bi-trash'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg></i></button></div></div>"}
                  ],
        "order": [[0, 'desc']]
    });     

    /// ::::::::::::::: CREA Y EDITA TIPO CAMBIO :::::::::::::///
    $('#formTipoCambio').submit(function(e){                         

        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        let tvalidacionTipoCambio = "";
        tipocambio_id = $.trim($('#tipocambio_id').val());    
        tipocambio_fecha = $.trim($('#tipocambio_fecha').val());
        tipoCambio_moneda = $.trim($('#tipocambio_moneda').val());    
        tipocambio_tipo = $.trim($('#tipocambio_tipo').val());
        tipocambio_valor = $.trim($('#tipocambio_valor').val());

        tvalidacionTipoCambio=f_validarTipoCambio(tipocambio_fecha,tipocambio_moneda,tipocambio_tipo,tipocambio_valor);

        /// CREAR
        if(opcionTipoCambio == 1) {
            if(tvalidacionTipoCambio!="invalido") {   
                Accion='CrearTipoCambio';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,tipocambio_fecha:tipocambio_fecha,tipocambio_moneda:tipocambio_moneda,tipocambio_tipo:tipocambio_tipo,tipocambio_valor:tipocambio_valor},
                    success: function(data) {
                        tablaTipoCambio.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoCambio').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTipoCambio == 2) {
            if(tvalidacionTipoCambio!="invalido") {   
                Accion='EditarTipoCambio';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,tipocambio_id:tipocambio_id,tipocambio_fecha:tipocambio_fecha,tipocambio_moneda:tipocambio_moneda,tipocambio_tipo:tipocambio_tipo,tipocambio_valor:tipocambio_valor},    
                    success: function(data) {
                        tablaTipoCambio.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDTipoCambio').modal('hide');
            } 
        }
    });

    /// ::::::::::::::: CREA CARGAR TIPO CAMBIO :::::::::::::///
    $('#formCargarTipoCambio').submit(function(e){        
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        let tvalidacionCargarTipoCambio = "";
        tipocambio_url = $.trim($('#tipocambio_url').val());    
        tipocambio_fechainicio = $.trim($('#tipocambio_fechainicio').val());
        tipocambio_fechafin = $.trim($('#tipocambio_fechafin').val());    
        tipocambio_monedacarga = $.trim($('#tipocambio_monedacarga').val());    

        tvalidacionCargarTipoCambio=f_validarCargarTipoCambio(tipocambio_url,tipocambio_fechainicio,tipocambio_fechafin,tipocambio_monedacarga);

        if(tvalidacionCargarTipoCambio!="invalido") {
            Accion='CrearCargarTipoCambio';
            $.ajax({
                url: "Ajax.php",
                type: "POST",
                datatype:"json",    
                data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, tipocambio_url:tipocambio_url, tipocambio_fechainicio:tipocambio_fechainicio, tipocambio_fechafin:tipocambio_fechafin, tipocambio_moneda:tipocambio_monedacarga},
                success: function(data) {
                    tablaTipoCambio.ajax.reload(null, false);
                }
            });
            $('#modalCRUDCargarTipoCambio').modal('hide');
        } 
    });

});

///::::::::: EVENTO DEL BOTON NUEVO ::::::::::::::///
$("#btnNuevoTipoCambio").click(function(){
    opcionTipoCambio = 1; // Alta 
    f_LimpiaMsTipoCambio();
    //$("#tipocambio_id").prop('disabled', true);
    $("#formTipoCambio").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text( "Alta de Tipo de Cambio");
    $("#modalCRUDTipoCambio").modal("show");	    
});

///::::::::: EVENTO DEL BOTON CARGAR URL ::::::::::::::///
$("#btnCargarTipoCambio").click(function(){
    
    tipocambio_url = "https://estadisticas.bcrp.gob.pe/estadisticas/series/api/PD04637PD-PD04638PD/json/";
    tipocambio_fechainicio = "";
    tipocambio_fechafin = "";
    tipocambio_monedacarga = "DOLARES";

    f_LimpiaMsCargarTipoCambio();
    $("#formCargartTipoCambio").trigger("reset");
    $("#tipocambio_url").val(tipocambio_url);
    $("#tipocambio_fechainicio").val(tipocambio_fechainicio);
    $("#tipocambio_fechafin").val(tipocambio_fechafin);
    $("#tipocambio_monedacarga").val(tipocambio_monedacarga);
    
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text( "Carga de Tipo de Cambio");
    
    $("#modalCRUDCargarTipoCambio").modal("show");	    
});

///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
$(document).on("click", ".btnEditarTipoCambio", function(){
    opcionTipoCambio = 2;// Editar
    f_LimpiaMsTipoCambio();
    $("#TipoCambio_id").prop('disabled', true);
    filaTipoCambio = $(this).closest("tr");	        
    tipocambio_id = filaTipoCambio.find('td:eq(0)').text();
    tipocambio_fecha = filaTipoCambio.find('td:eq(1)').text();
    tipocambio_moneda = filaTipoCambio.find('td:eq(2)').text();
    tipocambio_tipo = filaTipoCambio.find('td:eq(3)').text();
    tipocambio_valor = filaTipoCambio.find('td:eq(4)').text();

    $("#tipocambio_id").val(tipocambio_id);
    $("#tipocambio_fecha").val(tipocambio_fecha);
    $("#tipocambio_moneda").val(tipocambio_moneda);
    $("#tipocambio_tipo").val(tipocambio_tipo);
    $("#tipocambio_valor").val(tipocambio_valor);
   
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Tipo de Cambio");		
    
    $('#modalCRUDTipoCambio').modal('show');		   
});

///::::::::  BOTON BORRAR REGISTRO  
$(document).on("click", ".btnBorrarTipoCambio", function(){
    filaTipoCambio = $(this);           
    tipocambio_id = filaTipoCambio.closest('tr').find('td:eq(0)').text();     

    respuestaTipoCambio = 0;
    Swal.fire({
        title: '¿Está seguro?',
        text: "Se eliminara el ID "+tipocambio_id+"!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Eliminado!',
                'El Id ha sido eliminado.',
                'success'
            )
            respuestaTipoCambio = 1;
            Accion='BorrarTipoCambio';
    
            if (respuestaTipoCambio = 1) {            
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,tipocambio_id:tipocambio_id },   
                    success: function() {
                        tablaTipoCambio.row(filaTipoCambio.parents('tr')).remove().draw();
                    }
                });
            }
        }
    });
});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validarTipoCambio(tipocambio_fecha,tipocambio_moneda,tipocambio_tipo,tipocambio_valor){
    f_LimpiaMsTipoCambio();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var rptaTipoCambio="";    

    if(tipocambio_fecha=="" ){
  
        rptaTipoCambio="invalido";
    }
    
    if(tipocambio_moneda=="" || tipocambio_moneda.length>15  ){

        rptaTipoCambio="invalido";
    }

    if(tipocambio_tipo==""  ||  tipocambio_moneda.length>15  ){

        rptaTipoCambio="invalido";
    }

    if(tipocambio_valor==""  ){

        rptaTipoCambio="invalido";
    }
    return rptaTipoCambio; 
}

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validarCargarTipoCambio(ptipocambio_url,ptipocambio_fechainicio,ptipocambio_fechafin,ptipocambio_monedacarga){
    f_LimpiaMsCargarTipoCambio();

    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var rptaCargarTipoCambio="";    

    if(ptipocambio_url=="" ){
        $("#tipocambio_url").addClass("color-error");  
        rptaCargarTipoCambio="invalido";
    }
    
    if(ptipocambio_fechainicio==""  ){
        $("#tipocambio_fechainicio").addClass("color-error");  
        rptaCargarTipoCambio="invalido";
    }

    if(ptipocambio_fechafin==""  ){
        $("#tipocambio_fechafin").addClass("color-error");  
        rptaCargarTipoCambio="invalido";
    }

    if(ptipocambio_fechainicio=="" && ptipocambio_fechafin=="" ){
        $("#tipocambio_fechainicio").addClass("color-error");  
        $("#tipocambio_fechafin").addClass("color-error");  
        rptaCargarTipoCambio="invalido";
    }

    if(ptipocambio_monedacarga==""  ){
        $("#tipocambio_monedacarga").addClass("color-error");  
        rptaCargarTipoCambio="invalido";
    }

    return rptaCargarTipoCambio; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaMsTipoCambio(){

}

function f_LimpiaMsCargarTipoCambio(){
    $("#tipocambio_url").removeClass("color-error");
    $("#tipocambio_fechainicio").removeClass("color-error");
    $("#tipocambio_fechafin").removeClass("color-error");
    $("#tipocambio_monedacarga").removeClass("color-error");
}