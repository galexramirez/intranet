///:: INICIO JS CARGA DE DATA TABLE PERMISOS ::::::::::::::::::::::::::::::::::::::::::::::///
$(document).ready(function(){
    let PER_UsuarioId, PER_ModuloId, PER_ModInicio, nombre_corto, a_data;
    div_tabla       = f_CreacionTabla("tablaPermisos","");
    $("#div_tablaPermisos").html(div_tabla);
    columnastabla   = f_ColumnasTabla("tablaPermisos","");

    Accion='CargarPermisos';
    tablaPermisos = $('#tablaPermisos').DataTable({
        language            : idiomaEspanol,
        responsive          : "true",
        dom                 : 'Blfrtip', // Con Botones Excel,Pdf,Print
        buttons             : [
            {
                extend      : 'excelHtml5',
                text        : '<i class="fas fa-file-excel"></i> ',
                titleAttr   : 'Exportar a Excel',
                className   : 'btn btn-success',
                title       : 'PERMISOS'
            },
        ],
        "ajax":{            
            "url"           : "Ajax.php", 
            "method"        : 'POST', //usamos el metodo POST
            "data"          : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc"       : ""
            },
        "columns": columnastabla
    });     

    $("#PER_UsuarioId").on('change', function () {
        PER_UsuarioId   = $("#PER_UsuarioId").val();
        nombre_corto    = "";
        a_data = f_BuscarDataBD('colaborador','Colaborador_id', PER_UsuarioId);
        $.each(a_data, function(idx, obj){
            nombre_corto = obj.Colab_nombre_corto;
        });
        $("#nombre_corto").val(nombre_corto);
    });

    ///:: EVENTO DEL BOTON NUEVO PERMISO ::::::::::::::::::::::::::::::::::::::::::::::::::///
    $("#btnNuevoPermisos").click(function(){
        opcion = 1; // Alta 
        f_limpia_permisos();
        $("#formPermisos").trigger("reset");

        f_select_combos_permisos();
        $("#PER_UsuarioId").prop('disabled', false);
        $("#PER_ModuloId").prop('disabled', false);

        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Permisos");
        $('#modalCRUDPermisos').modal('show');	    
    });
    ///:: FIN EVENTO DEL BOTON NUEVO PERMISO ::::::::::::::::::::::::::::::::::::::::::::::///

    ///:: BOTON EDITAR PERMISO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::///       
    $(document).on("click", ".btnEditarPermisos", function(){
        opcion = 2;// Editar
        f_limpia_permisos();
        $("#formPermisos").trigger("reset");

        f_select_combos_permisos();    
        $("#PER_UsuarioId").prop('disabled', true);
        $("#PER_ModuloId").prop('disabled', true);

        fila = $(this).closest("tr");	        
        Permiso_Id      = fila.find('td:eq(0)').text();
        PER_UsuarioId   = fila.find('td:eq(1)').text();
        nombre_corto    = fila.find('td:eq(2)').text();
        PER_ModuloId    = fila.find('td:eq(3)').text();
        PER_ModInicio   = fila.find('td:eq(4)').text();

        $("#Permiso_Id").val(Permiso_Id);
        $("#PER_UsuarioId").val(PER_UsuarioId);
        $("#nombre_corto").val(nombre_corto);
        $("#PER_ModuloId").val(PER_ModuloId);
        $("#PER_ModInicio").val(PER_ModInicio);
    
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Permisos");		

        $('#modalCRUDPermisos').modal('show');		   
    });
    ///:: FIN BOTON EDITAR PERMISO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    
    ///:: BOTON CREA Y EDITA PERMISO ::::::::::::::::::::::::::::::::::::::::::::::::::::::///
    $('#formPermisos').submit(function(e){                         
        let validacion = "";
        let t_msg      = "";
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        Permiso_Id      = $.trim($('#Permiso_Id').val());    
        PER_UsuarioId   = $.trim($('#PER_UsuarioId').val());
        PER_ModuloId    = $.trim($('#PER_ModuloId').val());    
        PER_ModInicio   = $.trim($('#PER_ModInicio').val());
        validacion      = f_validar_permisos(Permiso_Id, PER_UsuarioId, PER_ModuloId, PER_ModInicio);

        if(PER_UsuarioId!="" && PER_ModuloId!="" && opcion==1){
            Accion = 'ValidarPermisos';
            $.ajax({
                url         : "Ajax.php",
                type        : "POST",
                datatype    : "json",
                async       : false,
                data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, PER_UsuarioId:PER_UsuarioId, PER_ModuloId:PER_ModuloId },    
                success     : function(data) {
                    if(data=="SI"){
                        t_msg       = "<br> Permiso Existe!!!";
                        validacion  = "invalido";
                        $("#PER_UsuarioId").addClass("color-error");
                        $("#PER_ModuloId").addClass("color-error");
                    }
                }
            });
        }

        if(validacion=="invalido"){
            Swal.fire({
                position            : 'center',
                icon                : 'error',
                title               : '*Falta Completar Información!!!'+t_msg,
                showConfirmButton   : false,
                timer               : 1500
            });
        }else{
            $("#btnGuardarPermisos").prop("disabled",true);
            if(opcion == 1) { // CREAR
                Accion = 'CrearPermisos';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, PER_UsuarioId:PER_UsuarioId, PER_ModuloId:PER_ModuloId, PER_ModInicio:PER_ModInicio },    
                    success     : function(data) {
                        tablaPermisos.ajax.reload(null, false);
                    }
                });
            }
            if(opcion == 2) { // EDITAR
                Accion = 'EditarPermisos';
                $.ajax({
                    url         : "Ajax.php",
                    type        : "POST",
                    datatype    : "json",    
                    data        : { MoS:MoS, NombreMoS:NombreMoS, Accion:Accion, Permiso_Id:Permiso_Id, PER_UsuarioId:PER_UsuarioId, PER_ModuloId:PER_ModuloId, PER_ModInicio:PER_ModInicio },    
                        success: function(data) {
                        tablaPermisos.ajax.reload(null, false);
                    }
                });
            }
            $('#modalCRUDPermisos').modal('hide');
            $("#btnGuardarPermisos").prop("disabled",false);
        }
    });
        
    ///:: BOTON BORRAR REGISTRO DE PERMISOS :::::::::::::::::::::::::::::::::::::::::::::::///
    $(document).on("click", ".btnBorrarPermisos", function(){
        fila = $(this);           
        Permiso_Id = $(this).closest('tr').find('td:eq(0)').text();     
        respuesta  = 0;
        Swal.fire({
            title: '¿Está seguro?',
            text: "Se eliminara el registro "+Permiso_Id+"!",
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
                respuesta = 1;
                Accion='BorrarPermisos';
                if (respuesta = 1) {            
                    $.ajax({
                    url: "Ajax.php",
                    type: "POST",
                    datatype:"json",    
                    data:  { MoS:MoS,NombreMoS:NombreMoS,Accion:Accion,Permiso_Id:Permiso_Id },   
                        success: function() {
                        tablaPermisos.row(fila.parents('tr')).remove().draw();
                        }
                    });
                }
            }
        });
    });
    ///:: FIN BOTON BORRAR REGISTRO DE PERMISOS :::::::::::::::::::::::::::::::::::::::::::///

});
///:: TERMINO JS CARGA DE DATA TABLE PERMISOS :::::::::::::::::::::::::::::::::::::::::::::///

///:: INICIO FUNCIONES DE PERMISOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::///

///: FUNCION PARA VALIDAR LOS DATOS INGRESADOS AL FORMULARIO ::::::::::::::::::::::::::::::///
function f_validar_permisos(Permiso_Id, PER_UsuarioId, PER_ModuloId, PER_ModInicio){
    f_limpia_permisos();
    let respuesta="";    
    if(PER_UsuarioId=="" || isNaN(PER_UsuarioId) || PER_UsuarioId.length<8){
        respuesta = "invalido";
        $("#PER_UsuarioId").addClass("color-error");
    }
    if(PER_ModuloId==""){
        respuesta = "invalido";
        $("#PER_ModuloId").addClass("color-error");
    }
    if(PER_ModInicio==""){
        respuesta = "invalido";
        $("#PER_ModInicio").addClass("color-error");
    }
    return respuesta; 
}

///::::::::: INVISIBILIZA LOS MENSAJE DE ALERTA DEL FORMULARIO :::::: /// 
function f_limpia_permisos(){
    $("#PER_UsuarioId").removeClass("color-error");
    $("#nombre_corto").removeClass("color-error");
    $("#PER_ModuloId").removeClass("color-error");
    $("#PER_ModInicio").removeClass("color-error");
}

function f_select_combos_permisos(){
    Accion = 'SelectModulo'; 
    $.ajax({
      url       : "Ajax.php",
      type      : "POST",
      datatype  : "json",
      async     : false,
      data      : {MoS:MoS,NombreMoS:NombreMoS,Accion:Accion},    
      success   : function(data){
        $("#PER_ModuloId").html(data);
      }
    });
}

///:: TERMINO FUNCIONES DE PERMISOS :::::::::::::::::::::::::::::::::::::::::::::::::::::::///