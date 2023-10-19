///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
///:::::::::::::::::::: PROVEEDORES v 1.0 FECHA: 21-09-2022 ::::::::::::::::::::::::::::::::::///
//:::::::::::::::::: CREAR, EDITAR, ELIMINAR TABLA DE PROVEEDORES ::::::::::::::::::::::::::::///
///::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///


///:::::::::::::::::: DECLARACION DE VARIABLES ::::::::::::::::::::::::::::::///
var prov_ruc, prov_razonsocial, prov_contacto, prov_cta_detraccion_soles, prov_cta_banco_soles, prov_cta_banco_dolares, prov_cta_interbanco_soles, prov_cta_interbanco_dolares, prov_correo, prov_telefono, prov_estado, prov_log;
var tablaProveedores, opcionTablaProveedores, filaTablaProveedores;

///::::::::::::: DOM Tipo Tabla OTPtreventivas ::::::::::::::::::::::::::::///
$(document).ready(function(){
    selectHtml="";
    selectHtml=f_TipoTabla("PROVEEDORES","ESTADO");
    $("#prov_estado").html(selectHtml);

    selectHtml=f_TipoTabla("PROVEEDORES","CONDICION DE PAGO");
    $("#prov_condicion_pago").html(selectHtml);

    div_tabla = f_CreacionTabla("tablaProveedores","");
    $("#div_tablaProveedores").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaProveedores","");

    Accion='LeerProveedores';
    tablaProveedores = $('#tablaProveedores').DataTable({
        //Filtros por columnas
        orderCellsTop: true,
        fixedHeader: true,
       
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
    $("#btnNuevoProveedores").click(function(){
        opcionTablaProveedores = 1; // Alta 
        f_LimpiaMsTablaProveedores();
        $("#prov_ruc").prop('disabled', false);
        $("#formProveedores").trigger("reset");
        prov_ruc                    = "";
        prov_razonsocial            = "";
        prov_contacto               = "";
        prov_cta_detraccion_soles   = "";
        prov_cta_banco_soles        = "";
        prov_cta_banco_dolares      = "";
        prov_cta_interbanco_soles   = "";
        prov_cta_interbanco_dolares = "";
        prov_condicion_pago         = "";
        prov_correo                 = "";
        prov_telefono               = "";
        prov_estado                 = "";
        prov_log                    = "";

        $("#prov_ruc").val(prov_ruc);
        $("#prov_razonsocial").val(prov_razonsocial);
        $("#prov_contacto").val(prov_contacto);
        $("#prov_cta_detraccion_soles").val(prov_cta_detraccion_soles);
        $("#prov_cta_banco_soles").val(prov_cta_banco_soles);
        $("#prov_cta_banco_dolares").val(prov_cta_banco_dolares);
        $("#prov_cta_interbanco_soles").val(prov_cta_interbanco_soles);
        $("#prov_cta_interbanco_dolares").val(prov_cta_interbanco_dolares);
        $("#prov_condicion_pago").val(prov_condicion_pago);
        $("#prov_correo").val(prov_correo);
        $("#prov_telefono").val(prov_telefono);
        $("#prov_estado").val(prov_estado);
        $("#div_proveedor_log").html(prov_log);

        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Tabla Proveedores");
        $('#modalCRUDProveedores').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarProveedores", function(){
        let aData;
        opcionTablaProveedores = 2;// Editar
        f_LimpiaMsTablaProveedores();
        $("#prov_ruc").prop('disabled', true);
        filaTablaProveedores        = $(this).closest("tr");	        
        prov_ruc                    = filaTablaProveedores.find('td:eq(0)').text();
        prov_razonsocial            = filaTablaProveedores.find('td:eq(1)').text();
        prov_contacto               = filaTablaProveedores.find('td:eq(2)').text();
        prov_cta_detraccion_soles   = filaTablaProveedores.find('td:eq(3)').text();
        prov_cta_banco_soles        = filaTablaProveedores.find('td:eq(4)').text();
        prov_cta_banco_dolares      = filaTablaProveedores.find('td:eq(5)').text();
        prov_cta_interbanco_soles   = filaTablaProveedores.find('td:eq(6)').text();
        prov_cta_interbanco_dolares = filaTablaProveedores.find('td:eq(7)').text();
        prov_condicion_pago         = filaTablaProveedores.find('td:eq(8)').text();
        prov_correo                 = filaTablaProveedores.find('td:eq(9)').text();
        prov_telefono               = filaTablaProveedores.find('td:eq(10)').text();
        prov_estado                 = filaTablaProveedores.find('td:eq(11)').text();
        
        aData = f_BuscarDataBD("manto_proveedores","prov_ruc",prov_ruc);
        $.each(aData, function(idx, obj){ 
            prov_log = obj.prov_log;
        });

        $("#prov_ruc").val(prov_ruc);
        $("#prov_razonsocial").val(prov_razonsocial);
        $("#prov_contacto").val(prov_contacto);
        $("#prov_cta_detraccion_soles").val(prov_cta_detraccion_soles);
        $("#prov_cta_banco_soles").val(prov_cta_banco_soles);
        $("#prov_cta_banco_dolares").val(prov_cta_banco_dolares);
        $("#prov_cta_interbanco_soles").val(prov_cta_interbanco_soles);
        $("#prov_cta_interbanco_dolares").val(prov_cta_interbanco_dolares);
        $("#prov_condicion_pago").val(prov_condicion_pago);
        $("#prov_correo").val(prov_correo);
        $("#prov_telefono").val(prov_telefono);
        $("#prov_estado").val(prov_estado);
        $("#div_proveedor_log").html(prov_log);
   
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Tabla Proveedores");		
    
        $('#modalCRUDProveedores').modal('show');		   
    });


    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formProveedores').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página

        prov_ruc                    = $.trim($('#prov_ruc').val());    
        prov_razonsocial            = $.trim($('#prov_razonsocial').val());
        prov_contacto               = $.trim($('#prov_contacto').val());
        prov_cta_detraccion_soles   = $.trim($('#prov_cta_detraccion_soles').val());
        prov_cta_banco_soles        = $.trim($('#prov_cta_banco_soles').val());
        prov_cta_banco_dolares      = $.trim($('#prov_cta_banco_dolares').val());
        prov_cta_interbanco_soles   = $.trim($('#prov_cta_interbanco_soles').val());
        prov_cta_interbanco_dolares = $.trim($('#prov_cta_interbanco_dolares').val());
        prov_condicion_pago         = $.trim($('#prov_condicion_pago').val());
        prov_correo                 = $.trim($('#prov_correo').val());
        prov_telefono               = $.trim($('#prov_telefono').val());
        prov_estado                 = $.trim($('#prov_estado').val());
    
        validacionTablaProveedores = f_validarTablaProveedores(prov_ruc, prov_razonsocial, prov_contacto, prov_cta_detraccion_soles, prov_cta_banco_soles, prov_cta_banco_dolares, prov_cta_interbanco_soles, prov_cta_interbanco_dolares, prov_condicion_pago, prov_correo, prov_telefono, prov_estado);

        /// CREAR
        if(opcionTablaProveedores == 1) {
            if(validacionTablaProveedores!="invalido") {   
                $("#btnGuardarProveedores").prop("disabled",true);
                Accion='CrearProveedores';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, prov_ruc:prov_ruc, prov_razonsocial:prov_razonsocial, prov_contacto:prov_contacto, prov_cta_detraccion_soles:prov_cta_detraccion_soles, prov_cta_banco_soles:prov_cta_banco_soles, prov_cta_banco_dolares:prov_cta_banco_dolares, prov_cta_interbanco_soles:prov_cta_interbanco_soles, prov_cta_interbanco_dolares:prov_cta_interbanco_dolares, prov_condicion_pago:prov_condicion_pago,prov_correo:prov_correo, prov_telefono:prov_telefono, prov_estado:prov_estado, prov_log:prov_log },    
                    success: function(data) {
                        tablaProveedores.ajax.reload(null, false);
                    }
                });
                $("#btnGuardarProveedores").prop("disabled",false);
                $('#modalCRUDProveedores').modal('hide');
            } 
        }

        /// EDITAR
        if(opcionTablaProveedores == 2) {
            if(validacionTablaProveedores!="invalido") {   
                $("#btnGuardarProveedores").prop("disabled",true);
                Accion='EditarProveedores';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, prov_ruc:prov_ruc, prov_razonsocial:prov_razonsocial, prov_contacto:prov_contacto,prov_cta_detraccion_soles:prov_cta_detraccion_soles, prov_cta_banco_soles:prov_cta_banco_soles, prov_cta_banco_dolares:prov_cta_banco_dolares, prov_cta_interbanco_soles:prov_cta_interbanco_soles, prov_cta_interbanco_dolares:prov_cta_interbanco_dolares, prov_condicion_pago:prov_condicion_pago, prov_correo:prov_correo, prov_telefono:prov_telefono, prov_estado:prov_estado, prov_log:prov_log },    
                    success: function(data) {
                        tablaProveedores.ajax.reload(null, false);
                    }
                });
                $("#btnGuardarProveedores").prop("disabled",false);
                $('#modalCRUDProveedores').modal('hide');
            } 
        }
    });
        
});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validarTablaProveedores(pprov_ruc, pprov_razonsocial, pprov_contacto, p_prov_cta_detraccion_soles, p_prov_cta_banco_soles, p_prov_cta_banco_dolares, p_prov_cta_interbanco_soles, p_prov_cta_interbanco_dolares, p_prov_condicion_pago, pprov_correo, pprov_telefono, pprov_estado){
    f_LimpiaMsTablaProveedores();
    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    var rpta_Proveedores="";    

    if(pprov_ruc=="" || pprov_ruc.length>11){
        $("#prov_ruc").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    if(pprov_razonsocial==""){
        $("#prov_razonsocial").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    if(pprov_contacto==""){
        $("#prov_contacto").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    if(p_prov_cta_detraccion_soles==""){
        $("#prov_cta_detraccion_soles").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    if(p_prov_cta_banco_soles==""){
        $("#prov_cta_banco_soles").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    if(p_prov_cta_banco_dolares==""){
        $("#prov_cta_banco_dolares").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    if(p_prov_cta_interbanco_soles==""){
        $("#prov_cta_interbanco_soles").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    if(p_prov_cta_interbanco_dolares==""){
        $("#prov_cta_interbanco_dolares").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    if(p_prov_condicion_pago==""){
        $("#prov_condicion_pago").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    if(pprov_correo==""){
        $("#prov_correo").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    if(pprov_telefono==""){
        $("#prov_telefono").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    if(pprov_estado==""){
        $("#prov_estado").addClass("color-error");
        rpta_Proveedores="invalido";
    }

    return rpta_Proveedores; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaMsTablaProveedores(){
    $("#prov_ruc").removeClass("color-error");
    $("#prov_razonsocial").removeClass("color-error");
    $("#prov_contacto").removeClass("color-error");
    $("#prov_cta_interbanco_soles").removeClass("color-error");
    $("#prov_cta_banco_soles").removeClass("color-error");
    $("#prov_cta_banco_dolares").removeClass("color-error");
    $("#prov_cta_interbanco_soles").removeClass("color-error");
    $("#prov_cta_interbanco_dolares").removeClass("color-error");
    $("#prov_condicion_pago").removeClass("color-error");
    $("#prov_correo").removeClass("color-error");
    $("#prov_telefono").removeClass("color-error");
    $("#prov_estado").removeClass("color-error");
}