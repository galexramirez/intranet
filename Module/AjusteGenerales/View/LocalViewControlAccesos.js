///::::::::::::::::::::::::::: DECLARACION DE VARIABLES :::::::::::::::::::::::::::::::::::///
var controlacceso_id, cacces_perfil, cacces_nombremodulo, cacces_nombreobjeto, cacces_acceso;
var filaControlAccesos, opcionControlAccesos, validacionControlAccesos;
///:::::::::::::::::::::::::: JS DOM CONTROL ACCESOS ::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){

    selectHtml="";
    selectHtml=f_TipoTablaUsuario("USUARIO","PERFIL");
    $("#cacces_perfil").html(selectHtml);

    $("#cacces_nombremodulo").on('change', function () {
        cacces_nombremodulo = $("#cacces_nombremodulo").val();
        Accion='SelectObjeto'; 
        $.ajax({
          url: "Ajax.php",
          type: "POST",
          datatype:"json",    
          data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cacces_nombremodulo:cacces_nombremodulo},    
          success: function(data){
            $("#cacces_nombreobjeto").html(data);
          }
        });    
    });
    
    div_tabla = f_CreacionTabla("tablaControlAccesos","");
    $("#div_tablaControlAccesos").html(div_tabla);
    columnastabla = f_ColumnasTabla("tablaControlAccesos","");

    Accion='CargarControlAccesos';
    tablaControlAccesos = $('#tablaControlAccesos').DataTable({
        language: idiomaEspanol,
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
    $("#btnNuevoControlAccesos").click(function(){
        opcionControlAccesos = 1; // Alta 
        f_LimpiaControlAccesos();
        $("#formControlAccesos").trigger("reset");

        controlaccesos_id = "";
        cacces_perfil = "";
        cacces_nombremodulo = "";
        cacces_nombreobjeto = "";
        cacces_acceso = "";

        f_select_combos_control_accesos();

        $("#controlaccesos_id").val(controlaccesos_id);
        $("#cacces_perfil").val(cacces_perfil);
        $("#cacces_nombremodulo").val(cacces_nombremodulo);
        $("#cacces_nombreobjeto").val(cacces_nombreobjeto);
        $("#cacces_acceso").val(cacces_acceso);

        $("#controlaccesos_id").prop('disabled', true);
        $("#cacces_perfil").prop('disabled', false);
        $("#cacces_nombremodulo").prop('disabled', false);
        $("#cacces_nombreobjeto").prop('disabled', false);
        $("#btnGuardarControlAccesos").prop("disabled",false);
        
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Control de Accesos");
        $('#modalCRUDControlAccesos').modal('show');	    
    });

    ///::::::::: BOTON EDITAR ::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarControlAccesos", function(){
        $("#formControlAccesos").trigger("reset");
        opcionControlAccesos = 2;// Editar
        f_LimpiaControlAccesos();

        $("#controlaccesos_id").prop('disabled', true);
        $("#cacces_perfil").prop('disabled', true);
        $("#cacces_nombremodulo").prop('disabled', true);
        $("#cacces_nombreobjeto").prop('disabled', true);
        $("#btnGuardarControlAccesos").prop("disabled",false);

        filaControlAccesos = $(this).closest("tr");	        
        controlaccesos_id = filaControlAccesos.find('td:eq(0)').text();
        cacces_perfil = filaControlAccesos.find('td:eq(1)').text();
        cacces_nombremodulo = filaControlAccesos.find('td:eq(2)').text();
        cacces_nombreobjeto = filaControlAccesos.find('td:eq(3)').text();
        cacces_acceso = filaControlAccesos.find('td:eq(4)').text();

        f_select_combos_control_accesos();

        $("#controlaccesos_id").val(controlaccesos_id);
        $("#cacces_perfil").val(cacces_perfil);
        $("#cacces_nombremodulo").val(cacces_nombremodulo);
        $("#cacces_nombreobjeto").val(cacces_nombreobjeto);
        $("#cacces_acceso").val(cacces_acceso);
    
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Control de Acceso");		

        $('#modalCRUDControlAccesos').modal('show');		   
    });

    /// ::::::::::::::: CREA Y EDITA USUARIO :::::::::::::///
    $('#formControlAccesos').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        $("#btnGuardarControlAccesos").prop("disabled",true);
        controlaccesos_id = $.trim($('#controlaccesos_id').val());    
        cacces_perfil = $.trim($('#cacces_perfil').val());
        cacces_nombremodulo = $.trim($('#cacces_nombremodulo').val());    
        cacces_nombreobjeto = $.trim($('#cacces_nombreobjeto').val());
        cacces_acceso = $.trim($('#cacces_acceso').val());
        existeControlAccesos = "";
        validacionControlAccesos = f_validarControlAccesos(cacces_perfil,cacces_nombremodulo,cacces_nombreobjeto,cacces_acceso);
        /// CREAR
        if(opcionControlAccesos == 1) {
            Accion='ValidarControlAccesos';
            $.ajax({
                url: "Ajax.php",
                type: "POST",
                datatype:"json",
                async: false,
                data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, cacces_perfil:cacces_perfil, cacces_nombremodulo:cacces_nombremodulo, cacces_nombreobjeto:cacces_nombreobjeto},    
                success: function(data) {
                    existeControlAccesos = data;
                }
            });
            if(existeControlAccesos=="SI"){
                Swal.fire(
                    'Registro!',
                    'El registro ya existe ...',
                    'success'
                )
                $("#btnGuardarControlAccesos").prop("disabled",false);
            }else{
                if(validacionControlAccesos!="invalido" && existeControlAccesos=="NO") {
                    Accion='CrearControlAccesos';
                    $.ajax({
                        url: "Ajax.php",
                        type: "POST",
                        datatype:"json",    
                        data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, controlaccesos_id:controlaccesos_id, cacces_perfil:cacces_perfil, cacces_nombremodulo:cacces_nombremodulo, cacces_nombreobjeto:cacces_nombreobjeto, cacces_acceso:cacces_acceso },    
                        success: function(data) {
                            tablaControlAccesos.ajax.reload(null, false);
                        }
                    });
                    $('#modalCRUDControlAccesos').modal('hide');
                    $("#btnGuardarControlAccesos").prop("disabled",false);
                }
            }
        }
        /// EDITAR
        if(opcionControlAccesos == 2){
            if(validacionControlAccesos!="invalido") {   
                Accion='EditarControlAccesos';
                $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion, controlaccesos_id:controlaccesos_id, cacces_perfil:cacces_perfil, cacces_nombremodulo:cacces_nombremodulo,cacces_nombreobjeto:cacces_nombreobjeto, cacces_acceso:cacces_acceso },
                    success: function(data) {
                        tablaControlAccesos.ajax.reload(null, false);
                    }
                });
                $('#modalCRUDControlAccesos').modal('hide');
                $("#btnGuardarControlAccesos").prop("disabled",false);
            } 
        }
    });
        
    ///::::::::  BOTON BORRAR REGISTRO  
    $(document).on("click", ".btnBorrarControlAccesos", function(){
        filaControlAccesos = $(this);           
        controlaccesos_id = $(this).closest('tr').find('td:eq(0)').text();     

        respuestaControlAccesos = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminara el registro "+controlaccesos_id+"!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Eliminado!',
                    'El registro ha sido eliminado.',
                    'success'
                )
                respuestaControlAccesos = 1;
                Accion='BorrarControlAccesos';
                if (respuesta = 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,controlaccesos_id:controlaccesos_id },   
                        success: function() {
                        tablaControlAccesos.row(filaControlAccesos.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });

});

///::::::: FUNCION PARA VALIDAR LOS DATSO INGRESADOS AL FORMULARIO :::::::::::::::::::///
function f_validarControlAccesos(pcacces_perfil,pcacces_nombremodulo,pcacces_nombreobjeto,pcacces_acceso){
    f_LimpiaControlAccesos();
    NoLetrasMayuscEspacio=/[^A-Z \Ñ]/;
    let rptaControlAccesos="";    

    if(pcacces_perfil==""){
        $("#cacces_perfil").addClass("color-error");
        rptaControlAccesos = "invalido";
    }
    if(pcacces_nombremodulo==""){
        $("#cacces_nombremodulo").addClass("color-error");
        rptaControlAccesos = "invalido";
    }
    if(pcacces_nombreobjeto==""){
        $("#cacces_nombreobjeto").addClass("color-error");
        rptaControlAccesos = "invalido";
    }
    if(pcacces_acceso==""){
        $("#cacces_acceso").addClass("color-error");
        rptaControlAccesos = "invalido";
    }
    return rptaControlAccesos; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_LimpiaControlAccesos(){
    $("#controlaccesos_id").removeClass("color-error");
    $("#cacces_perfil").removeClass("color-error");
    $("#cacces_nombremodulo").removeClass("color-error");
    $("#cacces_nombreobjeto").removeClass("color-error");
    $("#cacces_acceso").removeClass("color-error");
}

function f_select_combos_control_accesos(){
    Accion='SelectModuloControlAccesos'; 
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
      success: function(data){
        $("#cacces_nombremodulo").html(data);
      }
    });

    Accion='SelectObjeto'; 
    $.ajax({
      url: "Ajax.php",
      type: "POST",
      datatype:"json",
      async: false,    
      data: {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,cacces_nombremodulo:cacces_nombremodulo},    
      success: function(data){
        $("#cacces_nombreobjeto").html(data);
      }
    });    

}